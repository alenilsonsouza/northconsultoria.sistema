<?php
class cadastroController extends controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    // 1 - Cadastro - Pedido de Id do Patrocinador
    public function index()
    {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        /*echo '<pre>';
        print_r($_SESSION['infocad']);exit;*/

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();


        $this->loadTemplate('id_indicador', [
            'template' => $template,
            'flash' => $flash
        ]);
    }

    // 1.1 - Verificação do id informado
    public function verifyId()
    {

        $id_indicador = filter_input(INPUT_POST, 'id_indicator');

        if ($id_indicador) {
            $cliente = new Clientes();
            if ($cliente->idExistsConsultor($id_indicador) == false) {
                $_SESSION['flash'] = "O <strong>ID informado</strong> não consta em nosso Banco de Dados.";
                header('Location:' . BASE_URL . 'cadastro');
                exit;
            } else {
                header('Location:' . BASE_URL . 'cadastro/cadastroinicial/' . $id_indicador);
                exit;
            }
        }

        header('Location:' . BASE_URL . 'cadastro');
        exit;
    }

    // 2 - Cadastro Incial (Nome completo, E-mail e CPF)
    public function cadastroinicial($id = '')
    {

        if (empty($id)) {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }

        $clientes = new Clientes(md5($id));
        $cliente = $clientes->getArray();

        if (empty($cliente['nome_cliente'])) {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }

        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();

        $this->loadTemplate('cadastro_inicial', [
            'template' => $template,
            'flash' => $flash,
            'cliente' => $cliente
        ]);
    }

    // 2.1 - Verificação de CPF e E-mail se já existem no Banco
    public function verifyCPFEmail()
    {
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $email = filter_input(INPUT_POST, 'email');
        $id_indicador = filter_input(INPUT_POST, 'id_indicador');

        if ($cpf && $email) {
            $cliente = new Clientes();
            $_SESSION['flash'] = '';
            if ($cliente->verifyCPF($cpf)) {
                $_SESSION['flash'] .= 'O <strong>CPF Informado</strong> já foi cadastro em nosso sistema.<br>';
                header('Location:' . BASE_URL . 'cadastro/cadastroinicial/' . $id_indicador);
                exit;
            }

            if ($cliente->verifyEmail($email)) {
                $_SESSION['flash'] .= 'O <strong>E-mail informado</strong> já foi cadastrado em nosso sistema.';
                header('Location:' . BASE_URL . 'cadastro/cadastroinicial/' . $id_indicador);
                exit;
            }

            $_SESSION['infocad'] = [
                'nome' => $nome,
                'cpf' => $cpf,
                'email' => $email,
                'id_indicador' => $id_indicador
            ];
            $_SESSION['dependentes'] = [];
            header('Location:' . BASE_URL . 'cadastro/etapa2');
            exit;
            
        }

        header('Location:' . BASE_URL . 'cadastro');
        exit;
    }

    // 3 - Cadastro de Data de Nascimento
    public function etapa2()
    {
        $infocad = [];
        if (!empty($_SESSION['infocad'])) {
            $infocad = $_SESSION['infocad'];
        } else {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }

        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $clientes = new Clientes(md5($infocad['id_indicador']));
        $cliente = $clientes->getArray();

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();

        $this->loadTemplate('cadastrodata', [
            'infocad' => $infocad,
            'cliente' => $cliente,
            'template' => $template,
            'flash' => $flash
        ]);
    }

    // 3.1 - Verifica a idade pela data de nascimento se é maior que 18 anos
    public function verifyBothdate()
    {
        $dia = filter_input(INPUT_POST, 'dia');
        $mes = filter_input(INPUT_POST, 'mes');
        $ano = filter_input(INPUT_POST, 'ano');

        if ($dia && $mes && $ano) {
            $i = new Idade($ano . '-' . $mes . '-' . $dia);
            $idade = $i->getIdade();
            if ($idade >= 0) {
                if (!empty($_SESSION['infocad'])) {
                    $array = [
                        'nascimento' => $ano . '-' . $mes . '-' . $dia
                    ];
                    $_SESSION['infocad'] += $array;
                } else {
                    header('Location:' . BASE_URL . 'cadastro');
                    exit;
                }
                header('Location:' . BASE_URL . 'cadastro/etapa3');
                exit;
            } else {
                $_SESSION['flash'] = "Você ainda não tem idade para efetuar o cadastro.";
            }
        }
        header('Location:' . BASE_URL . 'cadastro/etapa2');
        exit;
    }

    // 4 - Cadastro de Nome da mãe, estado civil, RG, sexo, Telefon e celular
    public function etapa3()
    {
        $infocad = [];
        if (!empty($_SESSION['infocad'])) {
            $infocad = $_SESSION['infocad'];
        } else {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $clientes = new Clientes(md5($infocad['id_indicador']));
        $cliente = $clientes->getArray();

        $estadoCivil = new EstadoCivil();
        $estadoCivil = $estadoCivil->getEstadoCivil();

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();

        $this->loadTemplate('etapa3', [
            'infocad' => $infocad,
            'cliente' => $cliente,
            'template' => $template,
            'flash' => $flash,
            'estadoCivil' => $estadoCivil
        ]);
    }

    // 4.1 - Armazena as informações da página anterior em SESSION
    public function storageEt3()
    {
        $nome_mae = filter_input(INPUT_POST, 'nome_mae');
        $estado_civil = filter_input(INPUT_POST, 'estado_civil');
        $rg = filter_input(INPUT_POST, 'rg');
        $sexo = filter_input(INPUT_POST, 'sexo');
        $telefone = filter_input(INPUT_POST, 'telefone');
        $celular = filter_input(INPUT_POST, 'celular');
        $cartao_sus = filter_input(INPUT_POST, 'cartao_sus');

        if ($nome_mae && $estado_civil) {

            $array = [
                'nome_mae' => $nome_mae,
                'estado_civil' => $estado_civil,
                'rg' => $rg,
                'sexo' => $sexo,
                'telefone' => $telefone,
                'celular' => $celular,
                'cartao_sus' => $cartao_sus
            ];
            if (!empty($_SESSION['infocad'])) {
                $_SESSION['infocad'] += $array;
                header('Location:' . BASE_URL . 'cadastro/etapa4');
                exit;
            }
        }

        header('Location:' . BASE_URL . 'cadastro');
        exit;
    }

    // 5 - Cadastro de Inforamções de endereço
    public function etapa4()
    {
        $infocad = [];
        if (!empty($_SESSION['infocad'])) {
            $infocad = $_SESSION['infocad'];
        } else {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $clientes = new Clientes(md5($infocad['id_indicador']));
        $cliente = $clientes->getArray();

        $estado = new Estado();
        $estados = $estado->getEstados();

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();

        $this->loadTemplate('etapa4', [
            'infocad' => $infocad,
            'cliente' => $cliente,
            'template' => $template,
            'flash' => $flash,
            'estados' => $estados
        ]);
    }

    // 5.1 - Armazena as informações de endereço em SESSION
    public function storageEt4()
    {
        $cep = filter_input(INPUT_POST, 'cep');
        $logradouro = filter_input(INPUT_POST, 'logradouro');
        $numero = filter_input(INPUT_POST, 'numero');
        $complemento = filter_input(INPUT_POST, 'complemento');
        $bairro = filter_input(INPUT_POST, 'bairro');
        $cidade = filter_input(INPUT_POST, 'cidade');
        $estado = filter_input(INPUT_POST, 'estado');

        if ($cep && $logradouro) {
            $array = [
                'cep' => $cep,
                'logradouro' => $logradouro,
                'numero' => $numero,
                'complemento' => $complemento,
                'bairro' => $bairro,
                'cidade' => $cidade,
                'estado' => $estado
            ];
            if (!empty($_SESSION['infocad'])) {
                $_SESSION['infocad'] += $array;
                header('Location:' . BASE_URL . 'cadastro/etapa5');
                exit;
            }
        }
        header('Location:' . BASE_URL . 'cadastro');
        exit;
    }
    // 6 - Escolha do Plano
    public function etapa5()
    {
        $infocad = [];
        if (!empty($_SESSION['infocad'])) {
            $infocad = $_SESSION['infocad'];
        } else {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $clientes = new Clientes(md5($infocad['id_indicador']));
        $cliente = $clientes->getArray();

        $plano = new Plano();
        $planos = $plano->getPlanoPrimario();

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();

        $this->loadTemplate('etapa5', [
            'infocad' => $infocad,
            'cliente' => $cliente,
            'template' => $template,
            'flash' => $flash,
            'planos' => $planos
        ]);
    }

    // 6.1 - Armazena a escolha do plano em SESSION
    public function storageEt5()
    {
        $plano = filter_input(INPUT_POST, 'plano');

        if ($plano) {
            $array = [
                'plano' => $plano
            ];
            if (!empty($_SESSION['infocad'])) {
                $_SESSION['infocad'] += $array;
                header('Location:' . BASE_URL . 'cadastro/etapa5dependente');
                exit;
            }
        }

        header('Location:' . BASE_URL . 'cadastro');
        exit;
    }

    public function etapa5dependente()
    {
        $infocad = [];
        if (!empty($_SESSION['infocad'])) {
            $infocad = $_SESSION['infocad'];
        } else {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $clientes = new Clientes(md5($infocad['id_indicador']));
        $cliente = $clientes->getArray();

        $parentesco = new ParentescoHandler();
        $parentescos = $parentesco->getList();

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();

        //unset($_SESSION['dependentes'][0]);

        $this->loadTemplate('etapa5dependente', [
            'infocad' => $infocad,
            'cliente' => $cliente,
            'template' => $template,
            'flash' => $flash,
            'parentescos' => $parentescos

        ]);
    }

    public function storageDependente()
    {
        $nome_dependente = filter_input(INPUT_POST, 'nome_dependente');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $cartao_sus = filter_input(INPUT_POST, 'cartao_sus');
        $nome_mae = filter_input(INPUT_POST, 'nome_mae');
        $dia = filter_input(INPUT_POST, 'dia');
        $mes = filter_input(INPUT_POST, 'mes');
        $ano = filter_input(INPUT_POST, 'ano');
        $sexo = filter_input(INPUT_POST, 'sexo');
        $parentesco = filter_input(INPUT_POST, 'parentesco');

        if ($nome_dependente && $cpf) {
            $p = new ParentescoHandler();
            $item = $p->getById($parentesco);
            $nomeParentesco = $item->getNome();
            $key = count($_SESSION['dependentes']);
            $plano = new Plano();
            $total_plano = $plano->getSomaPlanoSecundario();
            $plano_item = $plano->getPlanoSecundario();
            $dependente[$key] = [
                'nome' => $nome_dependente,
                'cpf' => $cpf,
                'cartao_sus' => $cartao_sus,
                'nome_mae' => $nome_mae,
                'nascimento' => $ano . '-' . $mes . '-' . $dia,
                'sexo' => $sexo,
                'parentesco' => $parentesco,
                'nomeParentesco' => $nomeParentesco,
                'valor' => $total_plano,
                'idPlano' => $plano_item['id'],
                'plano' => $plano_item['nome']
            ];
            $_SESSION['dependentes'] += $dependente;
        }

        header('Location:' . BASE_URL . 'cadastro/etapa5dependente');
        exit;
    }

    public function delDependente($id)
    {
        if (!empty($_SESSION['dependentes'][$id])) {
            unset($_SESSION['dependentes'][$id]);
        }
        header('Location:' . BASE_URL . 'cadastro/etapa5dependente');
        exit;
    }

    // 7 - Revisão dos dados cadastrados nas etapas anteriores
    public function etapa6()
    {
        $infocad = [];
        if (!empty($_SESSION['infocad'])) {
            $infocad = $_SESSION['infocad'];
        } else {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }

        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        //echo '<pre>';
        //print_r($infocad);exit;
        $clientes = new Clientes(md5($infocad['id_indicador']));
        $cliente = $clientes->getArray();

        $plano = new Plano();
        $nome_plano = $plano->getPlanoById($infocad['plano']);

        $ec = new EstadoCivil();
        $estado_civil = $ec->getEstadoCivilById($infocad['estado_civil']);

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();

        $this->loadTemplate('etapa6', [
            'infocad' => $infocad,
            'cliente' => $cliente,
            'template' => $template,
            'flash' => $flash,
            'nome_plano' => $nome_plano,
            'estado_civil' => $estado_civil
        ]);
    }

    // 8 - Cadastrar dados bancários para transferência de depóstito.
    public function dadosBancarios()
    {
        $infocad = [];
        if (!empty($_SESSION['infocad'])) {
            $infocad = $_SESSION['infocad'];
        } else {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }

        $clientes = new Clientes(md5($infocad['id_indicador']));
        $cliente = $clientes->getArray();

        $plano = new Plano();
        $nome_plano = $plano->getPlanoById($infocad['plano']);

        $ec = new EstadoCivil();
        $estado_civil = $ec->getEstadoCivilById($infocad['estado_civil']);
        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();

        $this->loadTemplate('dadosBancarios', [
            'infocad' => $infocad,
            'cliente' => $cliente,
            'template' => $template,
            'nome_plano' => $nome_plano,
            'estado_civil' => $estado_civil
        ]);
    }

    // 8.1 - Armazena informações Bancarias do cliente
    public function storageBanco()
    {
        $nome_banco = filter_input(INPUT_POST, 'nome_banco');
        $agencia = filter_input(INPUT_POST, 'agencia');
        $conta = filter_input(INPUT_POST, 'conta');
        $tipo_conta = filter_input(INPUT_POST, 'tipo_conta');

        if ($nome_banco && $agencia && $conta && $tipo_conta) {
            $array = [
                'banco' => [
                    'nome_banco' => $nome_banco,
                    'agencia' => $agencia,
                    'conta' => $conta,
                    'tipo' => $tipo_conta // 1 - Corrente, 2 - Poupança 
                ]
            ];

            if (!empty($_SESSION['infocad'])) {
                $_SESSION['infocad'] += $array;
                header('Location:' . BASE_URL . 'cadastro/etapa7');
                exit;
            }
        }

        header('Location:' . BASE_URL . 'cadastro/dadosBancarios');
        exit;
    }

    // 9 - Definir senha para acesso do sistema
    public function etapa7()
    {
        $infocad = [];
        if (!empty($_SESSION['infocad'])) {
            $infocad = $_SESSION['infocad'];
        } else {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }

        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        //echo '<pre>';
        //print_r($infocad);exit;
        $clientes = new Clientes(md5($infocad['id_indicador']));
        $cliente = $clientes->getArray();

        $plano = new Plano();
        $nome_plano = $plano->getPlanoById($infocad['plano']);

        $ec = new EstadoCivil();
        $estado_civil = $ec->getEstadoCivilById($infocad['estado_civil']);

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();

        $this->loadTemplate('etapa7', [
            'infocad' => $infocad,
            'cliente' => $cliente,
            'template' => $template,
            'flash' => $flash,
            'nome_plano' => $nome_plano,
            'estado_civil' => $estado_civil
        ]);
    }

    // 9.1 - Armazena a senha em SESSION
    /* Caso as senhas estão corretas -> Armazena em SESSION e direciona para concluir. */
    public function storageEt7()
    {
        $senha = filter_input(INPUT_POST, 'senha');
        $confirmar_senha = filter_input(INPUT_POST, 'confirmar_senha');
        $aceito = filter_input(INPUT_POST, 'aceito');

        if ($aceito == 1) {
            if (!empty($senha) && !empty($confirmar_senha) && $senha == $confirmar_senha && strlen($senha) >= 6) {
                $array = [
                    'senha' => md5($senha)
                ];
                $_SESSION['infocad'] += $array;
                header('Location:' . BASE_URL . 'cadastro/concluir');
                exit;
            } else {
                $_SESSION['flash'] = "Senhas não conferetem ou naõ condiz a quantidade mínima.";
                header('Location:' . BASE_URL . 'cadastro/etapa7');
                exit;
            }
        }

        $_SESSION['flash'] = "Para concluir deve aceitar os termos";
        header('Location:' . BASE_URL . 'cadastro/etapa7');
        exit;
    }

    // 10 - Armazena as informações de SESSION no BD (cliente e Endereço)
    /* Gera as faturas para o Boleto Barato  e armazena no Banco de Dados (faturamento) */
    public function concluir()
    {

        $infocad = [];
        if (empty($_SESSION['infocad']['cpf'])) {
            header('Location:' . BASE_URL . 'cadastro');
            exit;
        }

        $infocad = $_SESSION['infocad'];

        //Cadastro do cliente
        $cliente = new Clientes();

        $infoClienteVendedor = $cliente->getClienteById(md5($infocad['id_indicador'])
    );

        $cliente->setNomeCliente($infocad['nome']);
        $cliente->setEmailCliente($infocad['email']);
        $cliente->setCpfCliente($infocad['cpf']);
        $cliente->setNomeMae($infocad['nome_mae']);
        $cliente->setNascimentoCliente($infocad['nascimento']);
        $cliente->setSexoCliente($infocad['sexo']);
        $cliente->setTelefone($infocad['telefone']);
        $cliente->setCelular($infocad['celular']);
        $cliente->setCartaoSus($infocad['cartao_sus']);
        $cliente->setIdIndicador($infocad['id_indicador']);
        $cliente->setRg($infocad['rg']);
        $cliente->setIdPlano($infocad['plano']);
        $cliente->setIdEstadoCivil($infocad['estado_civil']);
        $cliente->setTipoComissao($infoClienteVendedor['tipo_comissao']);
        $id_cliente = $cliente->salvar();


        //Cadastro de dependentes - Quando houver
        if (count($_SESSION['dependentes']) > 0) {
            foreach ($_SESSION['dependentes'] as $infoDep) {
                $cliente = new Clientes();
                $cliente->setNomeCliente($infoDep['nome']);
                $cliente->setCpfCliente($infoDep['cpf']);
                $cliente->setNomeMae($infoDep['nome_mae']);
                $cliente->setCartaoSus($infoDep['cartao_sus']);
                $cliente->setNascimentoCliente($infoDep['nascimento']);
                $cliente->setSexoCliente($infoDep['sexo']);
                $cliente->setParentesco($infoDep['parentesco']);
                $cliente->setIdIndicador($id_cliente);
                $cliente->setIdPlano($infoDep['idPlano']);
                $cliente->setTipo(2);
                $cliente->salvar();
            }
        }

        //Cadastro de informações de Endereço do Cliente
        $endereco = new Enderecos();
        $endereco->setCep($infocad['cep']);
        $endereco->setLogradouro($infocad['logradouro']);
        $endereco->setNumero($infocad['numero']);
        $endereco->setComplemento($infocad['complemento']);
        $endereco->setBairro($infocad['bairro']);
        $endereco->setCidade($infocad['cidade']);
        $endereco->setEstado($infocad['estado']);
        $endereco->setIdCliente($id_cliente);
        $endereco->salvar();

        //Cadastro dos documentos
        if (!empty($_FILES['arquivo1'])) {
            $arquivos = new Arquivos();
            $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo1']);
            if ($id_arquivo > 0) {
                $documentos = new Documentos();
                $documentosHandler = new DocumentosHandler();
                $documentos->setIdArquivo($id_arquivo);
                $documentos->setIdCliente($id_cliente);
                $documentos->setNome('RG ou CNH Frente');
                $documentos->setTipo(1);
                $documentosHandler->insert($documentos);
            }
        }
        if (!empty($_FILES['arquivo2'])) {
            $arquivos = new Arquivos();
            $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo2']);
            if ($id_arquivo > 0) {
                $documentos = new Documentos();
                $documentosHandler = new DocumentosHandler();
                $documentos->setIdArquivo($id_arquivo);
                $documentos->setIdCliente($id_cliente);
                $documentos->setNome('RG ou CNH Verso');
                $documentos->setTipo(2);
                $documentosHandler->insert($documentos);
            }
        }
        if (!empty($_FILES['arquivo3'])) {
            $arquivos = new Arquivos();
            $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo3']);
            if ($id_arquivo > 0) {
                $documentos = new Documentos();
                $documentosHandler = new DocumentosHandler();
                $documentos->setIdArquivo($id_arquivo);
                $documentos->setIdCliente($id_cliente);
                $documentos->setNome('Cartão SUS');
                $documentos->setTipo(3);
                $documentosHandler->insert($documentos);
            }
        }
        if (!empty($_FILES['arquivo4'])) {
            $arquivos = new Arquivos();
            $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo4']);
            if ($id_arquivo > 0) {
                $documentos = new Documentos();
                $documentosHandler = new DocumentosHandler();
                $documentos->setIdArquivo($id_arquivo);
                $documentos->setIdCliente($id_cliente);
                $documentos->setNome('Comprovante de Residência');
                $documentos->setTipo(4);
                $documentosHandler->insert($documentos);
            }
        }


        //Cadastro de Informações bancárias do cliente
        /*$banco = new DadosBancarios();
        $banco->setIdCliente($id_cliente);
        $banco->setBanco($infocad['banco']['nome_banco']);
        $banco->setTipo($infocad['banco']['tipo']);
        $banco->setAgencia($infocad['banco']['agencia']);
        $banco->setConta($infocad['banco']['conta']);
        $banco->setDataCadastro(date('Y-m-d H:i:s'));
        $bancoHandler = new DadosBancariosHandler();
        $bancoHandler->insert($banco);*/

        //Envio de Email de confirmação de cadastro
        /*o Formato de texto de envio dever em HTML*/
        $texto = '
            <p>Você recebeu este email porque houve um cadastro no site lifecartões.</p>
            <p>Seja bem vindo a nossa equipe.</p>
        ';
        $email = new Email();
        $email->setNome($infocad['nome']);
        $email->setEmail($infocad['email']);
        $email->setAssunto('Confirmação de Cadastro');
        $email->setMensagem($texto);
        $email->sendEmailTo();

        //Parcelas
        /**
         * Provável que o total de parcelas fica obsoleto
         */
        /*$totalParcelasHandeler = new TotalParcelasHandler();
        $total_parcela = $totalParcelasHandeler->getTotalParcelar();
        $nparcela = 1;
        $tparcela = $total_parcela->getTotal();*/

        /**
         * Pegar mês atual e calcular a quantidade até mês 12 do mesmo ano
         */
        $dia = date('d');
        $mes = date('m');
        $nparcela = 1;
        if($dia > 10) {
            $tparcela = (12 - $mes);
            $mesAno = date('Y-m', strtotime('+1 month'));
            $data_primeiro_vencimento = date('Y-m-d', strtotime($mesAno.'-15'));
        } else{
            $tparcela = (12 - $mes) + 1;
            $ano = date("Y");
            $data_primeiro_vencimento = date('Y-m-d', strtotime($ano.'-'.$mes.'-15'));
        }


        //Pegar o valor do plano
        $plano = new Plano();
        $item = $plano->getPlanoById($infocad['plano']);

        
        if ($tparcela >= $nparcela) {
            $hoje = date('Y-m-d');
            $diaHoje = 15;
            $data_vencimento = date('Y-m-d', strtotime($data_primeiro_vencimento));
            $dia_vendimento = date('15', strtotime($data_vencimento));
            //Se o dia de vencimento for maior que 28 então o vencimento será dia 1
            /*$dia_vendimento = 10;
            if ($diaHoje <= 15) {
                $proximo_mes = date('Y-m', strtotime("+1 month"));
                $data_vencimento = date('Y-m-d', strtotime($proximo_mes . '-' . $dia_vendimento));
            }else{
                $proximo_mes = date('Y-m', strtotime("+2 month"));
                $data_vencimento = date('Y-m-d', strtotime($proximo_mes . '-' . $dia_vendimento));
            }*/
            if ($dia_vendimento >= 1 && $dia_vendimento <= 28) {

                $c = new Clientes($id_cliente);
                $cliente = $c->getArray();

                $idParcelamento = new IdParcelamento();
                $id_parcelamento = $idParcelamento->salvar();

                $valorPlanoSecundario = 0;
                if (count($_SESSION['dependentes']) > 0) {
                    foreach ($_SESSION['dependentes'] as $dependente) {
                        $vlr[] = $dependente['valor'];
                    }
                    $valorPlanoSecundario = array_sum($vlr);
                }

                $soma = $valorPlanoSecundario + $item['valor'];

                
                $mora = '1,00';
                $multa = '2,00';
                $result = 0;
                $taxa_primeira_parcela = 25;
                for ($i = $nparcela; $i <= $tparcela; $i++) {
                    $m = new Moeda();
                    
                    //Inclui a taxa na primeira parcela
                    if($i == 1){
                        $valor_real = number_format($soma + $taxa_primeira_parcela, 2, ",", "."); //VAlor em real para o boleto barato
                        $m->setValorFloat($valor_real);
                        $valor = floatval($m->getValor());
                        
                    }else{
                        $valor_real = number_format($soma, 2, ",", "."); //VAlor em real para o boleto barato
                        $m->setValorFloat($valor_real);
                        $valor = floatval($m->getValor());
                        
                    }
                    
                    $m->setValorFloat($mora);
                    $valor_mora = $m->getValor();
                    $m->setValorFloat($multa);
                    $valor_multa = $m->getValor();

                    //Cadastrar no sistema parcela por parcela
                    $f = new Faturamento();
                    $f->setIdCliente($id_cliente);
                    $f->setIdParcelamento($id_parcelamento);
                    $f->setIdNegocio(0);
                    $f->setValor($valor);
                    $f->setTipo(1);
                    $f->setMora($valor_mora);
                    $f->setMulta($valor_multa);
                    $f->setNParcela($i);
                    $f->setTParcela($tparcela);
                    $f->setDataVencimento($data_vencimento);
                    $f->setIdFormaPagamento(1);
                    $f->setDescricao('Mensalidade Plano');
                    $id_faturamento = $f->salvar();

                    $b = new BoletoBarato();
                    $b->setNomeCliente($infocad['nome']);
                    $b->setEmailCliente($infocad['email']);
                    $b->setIdParcelamento($id_parcelamento);
                    $b->setCPFCNPJ($infocad['cpf']);

                    //Retirar os parenteses, traço e espaços para enviar somente números
                    $celular = str_replace('(', '', $infocad['celular']);
                    $celular = str_replace(')', '', $celular);
                    $celular = str_replace('-', '', $celular);
                    $celular = str_replace(' ', '', $celular);

                    $b->setCelularCliente($celular);
                    $b->setLogradouro($infocad['logradouro']);
                    $b->setNumero($infocad['numero']);
                    $b->setComplemento($infocad['complemento']);
                    $b->setBairro($infocad['bairro']);
                    $b->setCEP($infocad['cep']);
                    $b->setCidade($infocad['cidade']);
                    $b->setEstado($infocad['estado']);
                    $b->setValor($valor_real);
                    $b->setTipo(1);
                    $b->setMora($mora);
                    $b->setMulta($multa);
                    $b->setDataVencimento($data_vencimento);
                    $b->setAssuntoBoleto('Mensalidade Plano');
                    $b->setDescricao('Mensalidade Plano');
                    $b->setCodigoBoleto($id_faturamento);
                    $result = $b->pegarDados($i, $tparcela);

                    $data_vencimento = date("Y-m-d", strtotime('+1 month', strtotime($data_vencimento)));
                }
                if ($result == 0) {
                    unset($_SESSION['infocad']);
                    header('Location:' . BASE_URL . 'cadastro/gerarboleto/' . md5($id_cliente));
                    exit;
                }
            } else {
                $dados['flash'] = "Só são aceitos dias de vencimento entre 1 e 28";
            }
        } else {
            $dados['flash'] = "O total de parcela não pode ser menor que o número da parcela";
        }

        header('Location:' . BASE_URL . 'cadastro');
        exit;
    }

    // 11 - Tela gerada após o cadastro mostrando o id e a primeira fatura para pagamento.
    public function gerarboleto($id_cliente)
    {

        $dados = array();

        $faturamento = new Faturamento();
        $dados['fatura'] = $faturamento->getFaturamentoByIdCliente($id_cliente);

        $boletoBarato = new BoletoBarato();
        $dados['boleto'] = $boletoBarato->getArray();

        $cliente = new Clientes($id_cliente);
        $dados['cliente'] = $cliente->getArray();

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $this->loadTemplate('gerarboleto', $dados);
    }
}
