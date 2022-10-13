<?php
class painelcadastrosController extends controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();

        $u = new Usuarios();
        if (!$u->isLogged()) {
            header("Location: " . BASE_URL . "login");
        }
    }

    public function index()
    {
        $dados = array();

        $clientes = new Clientes();

        $limit = 30;

        $total = $clientes->getTotalClienteVendedor();

        $dados['paginas'] = ceil($total / $limit);

        $dados['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $dados['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($dados['paginaAtual'] * $limit) - $limit;
        $dados['clientes'] = $clientes->getClienteVendedor($offset, $limit);
        $dados['total'] = $total;

        $dados['page'] = "cadastros";
        $this->loadTemplateInPainel('cadastros', $dados);
    }
    public function adicionar()
    {

        $plan = new N_PlanHandler();
        $planos = $plan->list();

        $est = new Estado();
        $estados = $est->getEstados();

        $civil = new EstadoCivil();
        $estado_civil = $civil->getEstadoCivil();

        /*echo '<pre>';
        print_r($cliente);
        exit;*/

        $this->loadTemplateInPainel('cadastros_ver', [
            'page' => 'cadastros',
            'planos' => $planos,
            'estados' => $estados,
            'estadoCivil' => $estado_civil,
            'linkToAction' => 'storageAddVendedor'
        ]);
    }

    public function storageAddVendedor()
    {
        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email');
        $nome_mae = filter_input(INPUT_POST, 'nome_mae');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $nascimento = filter_input(INPUT_POST, 'nascimento');
        $sexo = filter_input(INPUT_POST, 'sexo');
        $rg = filter_input(INPUT_POST, 'rg');
        $fixo = filter_input(INPUT_POST, 'fixo');
        $celular = filter_input(INPUT_POST, 'celular');
        $from = filter_input(INPUT_POST, 'from');
        $estado_civil = filter_input(INPUT_POST, 'estado_civil');
        $cep = filter_input(INPUT_POST, 'cep');
        $logradouro = filter_input(INPUT_POST, 'logradouro');
        $numero = filter_input(INPUT_POST, 'numero');
        $complemento = filter_input(INPUT_POST, 'complemento');
        $bairro = filter_input(INPUT_POST, 'bairro');
        $cidade = filter_input(INPUT_POST, 'cidade');
        $estado = filter_input(INPUT_POST, 'estado');

        if ($nome) {

            $people = new N_People();
            $peopleHandler = new N_PeopleHandler();
            $people->setIdPeople(NULL);
            $people->setIdPlan(NULL);
            $people->setName($nome);
            $people->setEmail($email);
            $people->setMotherName($nome_mae);
            $people->setCpf($cpf);
            $people->setBirthDate($nascimento);
            $people->setSexo($sexo);;
            $people->setRg($rg);
            $people->setTelFix($fixo);
            $people->setTelCel($celular);
            $people->setMaritalStatus($estado_civil);
            $people->setTypeReister('C');
            $people->setFrom($from);
            $id_people = $peopleHandler->insert($people);

            $address = new N_Address();
            $addressHandler = new N_AddressHandler();

            $address->setIdPeople($id_people);
            $address->setCep($cep);
            $address->setLogradouro($logradouro);
            $address->setNumero($numero);
            $address->setComplemento($complemento);
            $address->setBairro($bairro);
            $address->setCidade($cidade);
            $address->setEstado($estado);
            $addressHandler->insert($address);

            Redirect::link('painelcadastros');
            
        }
    }
    public function ver($id)
    {
        $pessoa = new N_PeopleHandler();
        $cliente = $pessoa->listOne($id);

        $plan = new N_PlanHandler();
        $planos = $plan->list();

        $est = new Estado();
        $estados = $est->getEstados();

        $civil = new EstadoCivil();
        $estado_civil = $civil->getEstadoCivil();

        $file = new N_FILE();
        $typeFiles = $file->listType();

        /*echo '<pre>';
        print_r($cliente);
        exit;*/

        $this->loadTemplateInPainel('cadastros_ver', [
            'page' => 'cadastros',
            'cliente' => $cliente,
            'planos' => $planos,
            'estados' => $estados,
            'estadoCivil' => $estado_civil,
            'typeFiles' => $typeFiles,
            'linkToAction' => 'storageCliente'
        ]);
    }

    public function storageCliente()
    {

        $nome = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email');
        $nome_mae = filter_input(INPUT_POST, 'nome_mae');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $nascimento = filter_input(INPUT_POST, 'nascimento');
        $sexo = filter_input(INPUT_POST, 'sexo');
        $rg = filter_input(INPUT_POST, 'rg');
        $fixo = filter_input(INPUT_POST, 'fixo');
        $celular = filter_input(INPUT_POST, 'celular');
        $plano = filter_input(INPUT_POST, 'plano');
        $from = filter_input(INPUT_POST, 'from');
        $estado_civil = filter_input(INPUT_POST, 'estado_civil');
        $cep = filter_input(INPUT_POST, 'cep');
        $logradouro = filter_input(INPUT_POST, 'logradouro');
        $numero = filter_input(INPUT_POST, 'numero');
        $complemento = filter_input(INPUT_POST, 'complemento');
        $bairro = filter_input(INPUT_POST, 'bairro');
        $cidade = filter_input(INPUT_POST, 'cidade');
        $estado = filter_input(INPUT_POST, 'estado');
        $id_cliente = filter_input(INPUT_POST, 'id_cliente');
        $id_endereco = filter_input(INPUT_POST, 'id_endereco');

        if ($nome) {

            $people = new N_People();
            $peopleHandler = new N_PeopleHandler();

            $people->setName($nome);
            
            $people->setMotherName($nome_mae);
            $people->setCpf($cpf);
            $people->setBirthDate($nascimento);
            $people->setSexo($sexo);;
            $people->setRg($rg);
            $people->setTelFix($fixo);
            $people->setTelCel($celular);
            $people->setIdPlan($plano);
            $people->setMaritalStatus($estado_civil);
            $people->setFrom($from);
            $peopleHandler->update($people, $id_cliente);

            $address = new N_Address();
            $addressHandler = new N_AddressHandler();

            $address->setIdPeople($id_cliente);
            $address->setCep($cep);
            $address->setLogradouro($logradouro);
            $address->setNumero($numero);
            $address->setComplemento($complemento);
            $address->setBairro($bairro);
            $address->setCidade($cidade);
            $address->setEstado($estado);
            if ($id_endereco) {
                $addressHandler->update($address, $id_endereco);
            } elseif ($cep && $logradouro) {
                
                $addressHandler->insert($address);
            }
        }

        header('Location:' . BASE_URL . 'painelcadastros/ver/' . $id_cliente);
        exit;
    }

    public function storageDocumentos()
    {
        $id_cliente = filter_input(INPUT_POST, 'id_cliente');
        $typeDocument = filter_input(INPUT_POST, 'type_document');
        $file = $_FILES['file'];

        $f = new N_File();
        $f->insert($file, $id_cliente, $typeDocument);

        header('Location:' . BASE_URL . 'painelcadastros/ver/' . $id_cliente);
        exit;
    }

    public function deleteDocument($id)
    {
        $id_people = filter_input(INPUT_GET, 'id_cliente');

        $file = new N_File();
        $file->delete($id);

        header('Location:' . BASE_URL . 'painelcadastros/ver/' . $id_people);
        exit;
    }

    public function faturas($id_cliente)
    {
        $dados = array();

        $clientes = new Clientes($id_cliente);
        $dados['cliente'] = $clientes->getArray();

        if (count($dados['cliente']) == 0) {
            header('Location:' . BASE_URL . 'painel');
            exit;
        }

        $faturamento = new Faturamento();
        $limit = 30;

        $total = $faturamento->getFaturamentoTotalByIdCliente($id_cliente);

        $dados['paginas'] = ceil($total / $limit);

        $dados['paginaAtual'] = 1;
        if (!empty($_GET['p'])) {
            $dados['paginaAtual'] = intval($_GET['p']);
        }

        $offset = ($dados['paginaAtual'] * $limit) - $limit;

        $dados['fatura'] = $faturamento->getFaturamentoByIdCliente($id_cliente, $offset, $limit);

        $dados['page'] = "cadastros";

        $this->loadTemplateInPainel('faturas', $dados);
    }

    public function indicados($id_cliente)
    {
        // Pega o vendedor
        $cliente = new N_PeopleHandler();
        $cliente = $cliente->listOne($id_cliente,false);

        $this->loadTemplateInPainel('cadastros_indicados', [
            'cliente' => $cliente,
            'page' => 'cadastros'
        ]);
    }

    public function clientesTitular()
    {
        $this->loadTemplateInPainel('cadastros_indicados', [
            'id_cliente' => 0,
            'page' => 'titulares',

        ]);
    }

    public function dependentes($id_cliente)
    {
        $cliente = new N_PeopleHandler();
        $cliente = $cliente->listOne($id_cliente);

        $this->loadTemplateInPainel('cadastros_dependentes', [
            'cliente' => $cliente,
            'page' => 'cadastros'
        ]);
    }

    public function boletosdocliente($id_cliente)
    {
        $faturamento = new Faturamento();
        $cliente = new Clientes();
        $cliente = $cliente->getClienteById($id_cliente);

        $limit = 24;

        $total = $faturamento->getFaturamentoTotalByIdCliente($id_cliente);

        $paginas = ceil($total / $limit);

        $paginaAtual = 1;
        if (!empty($_GET['p'])) {
            $paginaAtual = intval($_GET['p']);
        }

        $offset = ($paginaAtual * $limit) - $limit;
        $boletos = $faturamento->getFaturamentoByIdCliente($id_cliente, $offset, $limit);

        $boletoBarato = new BoletoBarato();
        $boleto = $boletoBarato->getArray();

        $fatura = $faturamento->getFaturamentoByIdCliente($id_cliente);

        $this->loadTemplateInPainel('cadastros_boletos', [
            'page' => 'boletos',
            'boletos' => $boletos,
            'paginas' => $paginas,
            'paginaAtual' => $paginaAtual,
            'total' => $total,
            'cliente' => $cliente,
            'boletoBarato' => $boleto,
            'fatura' => $fatura
        ]);
    }

    public function excluirBoleto($id_boleto)
    {
        $id_cliente = 0;
        if (!empty($id_boleto)) {
            $faturamento = new Faturamento();
            $item = $faturamento->getFaturamentoById($id_boleto);
            $id_cliente = $item['id_cliente'];

            $boletos = new BoletoBarato();
            $boletos->setCodigoBoleto($item['id_faturamento']);
            $boletos->setIdBoleto($item['idboleto']);
            $boletos->cancelarBoleto();
            $faturamento->delFaturamentoById($id_boleto);
        }

        header('Location:' . BASE_URL . 'painelcadastros/boletosdocliente/' . md5($id_cliente));
        exit;
    }

    public function excluirTodosBoletosCliente($id_cliente)
    {

        $faturamento = new Faturamento();
        $list = $faturamento->getFaturamentoByIdCliente(md5($id_cliente));
        //Excluir todos os boletos do cliente.
        foreach ($list as $item) {
            $boletos = new BoletoBarato();
            $boletos->setCodigoBoleto($item['id_faturamento']);
            $boletos->setIdBoleto($item['idboleto']);
            $boletos->cancelarBoleto();
            $faturamento->delFaturamentoById($item['id_faturamento']);
        }


        header('Location:' . BASE_URL . 'painelcadastros/boletosdocliente/' . md5($id_cliente));
        exit;
    }

    public function excluir($id)
    {

        $pagina = filter_input(INPUT_GET, 'pagina');
        $people = new N_PeopleHandler();
        $people->delete($id);

        if ($pagina) {
            header('Location:' . BASE_URL . 'painelcadastros/' . $pagina);
            exit;
        }
        header('Location:' . BASE_URL . 'painelcadastros');
        exit;
    }

    public function vendedores()
    {


        $this->loadTemplateInPainel('vendedores', [
            'page' => 'vendedores'
        ]);
    }

    public function clientes()
    {


        $this->loadTemplateInPainel('clientes', [
            'page' => 'clientes',

        ]);
    }
}
