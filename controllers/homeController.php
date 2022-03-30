<?php
class homeController extends controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index($id = NULL)
  {
    $dados = [];

    // Verifica se o vendedor existe e cria sessão com informações do vendedor caso exista.
    if ($id) {
      $people = new N_PeopleHandler();
      $total = count($people->verifySenderExists($id));
      if ($total > 0) {
        $item = $people->verifySenderExists($id);
        $_SESSION['sender'] = [
          'id' => $item['id'],
          'name' => $item['name']
        ];
      } else {
        unset($_SESSION['sender']);
      }
    }

    $dados['flash'] = '';
    if (!empty($_SESSION['flash'])) {
      $dados['flash'] = $_SESSION['flash'];
      $_SESSION['flash'] = '';
    }

    $config = new Config();
    $dados['config'] = $config->getArray();

    $b = new Banners();
    $dados['banners'] = $b->getArray();

    $v = new Video();
    $dados['video'] = $v->getArray();

    $plans = new N_PlanHandler();
    $dados['plans'] = $plans->list('ACTIVE');

    //Informações para o template
    $template = new Template();
    $dados['template'] = $template->getInfo();

    $dados['menu'] = 1;
    $dados['page'] = 'home';


    $this->loadTemplate('home', $dados);
  }

  public function vendedor($id)
  {
    // URL amigável para usuários informar o id do vendedor
    Redirect::link('home/index/' . $id);
  }

  public function storageContato()
  {

    $nome = filter_input(INPUT_POST, 'nome');
    $email = filter_input(INPUT_POST, 'email');
    $telefone = filter_input(INPUT_POST, 'telefone');
    $mensagem = filter_input(INPUT_POST, 'mensagem');

    if ($nome && $email && $mensagem) {
      $contato = new Contato();
      $contato->setNome($nome);
      $contato->setEmail($email);
      $contato->setAssunto('Contato Life Cartões');
      $contato->setMensagem('Telefone: ' . $telefone . '<br>Mensagem: ' . $mensagem);
      $contato->salvar();

      $_SESSION['flash'] = "Recebemos a sua mensagem e em breve entraremos em contato.";
    }

    header('Location:' . BASE_URL);
    exit;
  }

  public function addClientAsaasInHome()
  {
    /**
     * - Cadastro de boleto no Asass
     * - Recebe as informações via POST vindas do formulário de cadastro
     * - É feita a requisição via POST para o Asaas
     */

    // Pega dados do formulário
    $cpf = filter_input(INPUT_POST, 'cpf');
    $email = filter_input(INPUT_POST, 'email');
    $fullName = filter_input(INPUT_POST, 'fullName');
    $tel_fixed = filter_input(INPUT_POST, 'tel_fixed');
    $tel_cel = filter_input(INPUT_POST, 'tel_cel');

    $cep = filter_input(INPUT_POST, 'cep');
    $logradouro = filter_input(INPUT_POST, 'logradouro');
    $numero = filter_input(INPUT_POST, 'numero');
    $complemento = filter_input(INPUT_POST, 'complemento');
    $bairro = filter_input(INPUT_POST, 'bairro');

    $id_client = filter_input(INPUT_POST, 'id_client');

    $planName = filter_input(INPUT_POST, 'planName');
    $planValue = filter_input(INPUT_POST, 'planValue');

    /*echo '<pre>';
      print_r($_POST);
      echo '</pre>';*/

    // Total de dependentes
    $n = 0;
    if (isset($_POST['depentent_name'][0])) {
      $names = $_POST['depentent_name'];
      foreach ($names as $name) {
        if ($name) {
          $n++;
        }
      }
    }
    $dependentTotal = $n;

    // Cálculo para dependentes
    $dependentValueUnique = $planValue - ($planValue * 0.10);
    $dependentValueTotal = $dependentValueUnique * $dependentTotal;

    // Soma do plano (Titular + Dependentes)
    $priceTotal = floatval($planValue + $dependentValueTotal);

    if ($fullName && $email && $planName) {
      // Prepara os dados do cliente para a Requisição no Asaas
      $data = "{
            \"name\": \"$fullName\",
            \"email\": \"$email\",
            \"phone\": \"$tel_fixed\",
            \"mobilePhone\": \"$tel_cel\",
            \"cpfCnpj\": \"$cpf\",
            \"postalCode\": \"$cep\",
            \"address\": \"$logradouro\",
            \"addressNumber\": \"$numero\",
            \"complement\": \"$complemento\",
            \"province\": \"$bairro\",
            \"externalReference\": \"$id_client\",
            \"notificationDisabled\": false,
            \"additionalEmails\": \"\",
            \"municipalInscription\": \"\",
            \"stateInscription\": \"\",
            \"observations\": \"\"
          }";

      // Chama a funcão addClient
      $asaas = new Asaas();
      $response = $asaas->addClient($data);

      // var_dump($response);

      if ($response->errors) {
        foreach ($response->errors as $k => $v) {
          $item = $response->errors[$k];
          echo $item['description'] . '</br>';
        }
        echo '<a href="' . BASE_URL . '">Voltar</a>';
        exit;
      }

      if ($response->id) {
        // Atualiza o id do Asaas no sistema
        $idAsaas = $response->id;
        $people = new N_PeopleHandler();
        $people->updateIdAsaas($idAsaas, $id_client);

        // Dia de vencimento dos boletos subsequentes
        $dueDay = 15;

        // Captura da data de hoje
        $today = date('d');
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Vencimento um dia após o cadastro (Valor Plano + Taxa)
        $dueDate = $currentYear . '-' . $currentMonth . '-' . date('d', strtotime('+ 1 day'));

        // Gera informações para o primeiro boleto com o valor do plano total + Taxa de Adesão (20 reais)
        $bulletValue = $priceTotal + 20;
        $bulletDesc = $planName." - {$dependentTotal} Dependentes + Taxa de Adesão (R$ 20,00)";

        $data = "{
                \"customer\": \"$idAsaas\",
                \"billingType\": \"BOLETO\",
                \"dueDate\": \"$dueDate\",
                \"value\": $bulletValue,
                \"description\": \"$bulletDesc\",
                \"externalReference\": \"\",
                \"discount\": {
                  \"value\": 0,
                  \"dueDateLimitDays\": 0
                },
                \"fine\": {
                  \"value\": 1
                },
                \"interest\": {
                  \"value\": 2
                },
                \"postalService\": false
              }";

        $asaas->createPayment($data);

        // Cadastra a assinatura  com o valor do plano
        // Verifica se o vencimento será no mesmo mês ou no mês posterior
        if ($today <= 5) {
          $dueDate = $currentYear . '-' . $currentMonth . '-' . $dueDay;
        } else {
          $currentMonth = date('m', strtotime('+1 month'));
          $currentYear = date('Y', strtotime('+1 month'));
          $dueDate = $currentYear . '-' . $currentMonth . '-' . $dueDay;
        }

        $descBullet = $planName." - {$dependentTotal} Dependentes";
        $data = "{
                \"customer\": \"$idAsaas\",
                \"billingType\": \"BOLETO\",
                \"nextDueDate\": \"$dueDate\",
                \"value\": $priceTotal,
                \"cycle\": \"MONTHLY\",
                \"description\": \"$descBullet\",
                \"discount\": {
                  \"value\": 0,
                  \"dueDateLimitDays\": 0
                },
                \"fine\": {
                  \"value\": 1
                },
                \"interest\": {
                  \"value\": 2
                }
              }";

        $asaas->createSubcription($data);
      }

      $_SESSION['flash'] = 'Cadastro realizado com sucesso!';

      Redirect::home();
    }
  }
}
