<?php
class cadastrovendedorController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() 
    {

        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();
		
        $this->loadTemplate('cadastroVendedor', [
            'template' => $template
        ]);
    }

    public function storageCPF()
    {
        $cpf = filter_input(INPUT_POST,'cpf');

        if($cpf)
        {
            $c = new Clientes();
            if(!$c->verificarCpfExiste($cpf))
            {
                $_SESSION['vendedor'] = [
                    'cpf' => $cpf
                ];
                header('Location:'.BASE_URL.'cadastrovendedor/cadastroEmail');
                exit;
            }
        }

        header('Location:'.BASE_URL.'cadastrovendedor');
        exit;
    }

    public function cadastroEmail() 
    {
        $aviso = '';
        if(!empty($_SESSION['aviso']))
        {
            $aviso = $_SESSION['aviso'];
            $_SESSION['aviso']='';
        }
        if(isset($_SESSION['vendedor']['cpf']))
        {
            $cpf = $_SESSION['vendedor']['cpf'];
        }
        else
        {
            header('Location:'.BASE_URL.'cadastrovendedor');
            exit;
        }
        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();
		
        $this->loadTemplate('cadastroVendedorEmail', [
            'template' => $template,
            'cpf' => $cpf,
            'aviso' => $aviso
        ]);
    }

    public function storageEmail()
    {
        $email = filter_input(INPUT_POST,'email');

        if($email)
        {
            $c = new Clientes();
            if(!$c->verifyEmail($email))
            {
                $email = [
                    'email'=>$email
                ];
                $_SESSION['vendedor'] += $email;
                header('Location:'.BASE_URL.'cadastrovendedor/cadastroDadosPessoais');
                exit;
            }
            else
            {
                $_SESSION['aviso'] = "E-mail já cadastrado!";
            }
        }

        header('Location:'.BASE_URL.'cadastrovendedor/cadastroEmail');
        exit;
    }

    public function cadastroDadosPessoais() 
    {
        if(isset($_SESSION['vendedor']['email']))
        {
            $cpf = $_SESSION['vendedor']['cpf'];
            $email = $_SESSION['vendedor']['email'];
        }
        else
        {
            header('Location:'.BASE_URL.'cadastrovendedor');
            exit;
        }
        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();
		
        $this->loadTemplate('cadastroVendedorDadosPessoais', [
            'template' => $template,
            'cpf' => $cpf,
            'email'=> $email
        ]);
    }

    public function storageDadosPessoais()
    {
        $nome = filter_input(INPUT_POST,'nome');
        $dia = filter_input(INPUT_POST,'dia');
        $mes = filter_input(INPUT_POST,'mes');
        $ano = filter_input(INPUT_POST,'ano');
        $sexo = filter_input(INPUT_POST,'sexo');
        $telefone = filter_input(INPUT_POST,'telefone');
        $celular = filter_input(INPUT_POST,'celular');
        
        if($nome && $sexo)
        {
            $dados = [
                'nome' => $nome,
                'nascimento' => $ano.'-'.$mes.'-'.$dia,
                'sexo' => $sexo,
                'telefone' => $telefone,
                'celular' => $celular
            ];
            $_SESSION['vendedor'] += $dados;
            header('Location:'.BASE_URL.'cadastrovendedor/dadosBancarios');
            exit;
        }

        header('Location:'.BASE_URL.'cadastrovendedor/cadastroDadosPessoais');
        exit;

    }

    public function dadosBancarios()
    {
        $aviso = '';
        if(!empty($_SESSION['aviso']))
        {
            $aviso = $_SESSION['aviso'];
            $_SESSION['aviso']='';
        }
        if(isset($_SESSION['vendedor']['nome']))
        {
            $nome = $_SESSION['vendedor']['nome'];
        }
        else
        {
            header('Location:'.BASE_URL.'cadastrovendedor');
            exit;
        }

        $banco = new BancosHandler();
        $bancos = $banco->getList();
        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();
		
        $this->loadTemplate('cadastroVendedorDadosBancarios', [
            'template' => $template,
            'nome' => $nome,
            'aviso' => $aviso,
            'bancos' => $bancos
        ]);
    }

    public function storageDadosBanco()
    {
        $banco = filter_input(INPUT_POST,'banco');
        $outro_banco = filter_input(INPUT_POST,'outro_banco');
        $agencia = filter_input(INPUT_POST,'agencia');
        $conta = filter_input(INPUT_POST,'conta');
        $tipo = filter_input(INPUT_POST,'tipo');
        $nome_titular = filter_input(INPUT_POST,'nome_titular');
        $cpf_titular = filter_input(INPUT_POST,'cpf_titular');


        if($banco && $agencia && $conta && $tipo)
        {
            $banco = !empty($outro_banco)?$outro_banco:$banco;
            $dados = [
                'banco' => $banco,
                'agencia' => $agencia,
                'conta' => $conta,
                'tipo' => $tipo,
                'nome_titular' => $nome_titular,
                'cpf_titular' => $cpf_titular
                
            ];
            $_SESSION['vendedor'] += $dados;
            header('Location:'.BASE_URL.'cadastrovendedor/password');
            exit;
        }

        header('Location:'.BASE_URL.'cadastrovendedor/dadosBancarios');
        exit;
    }

    public function password()
    {
        $aviso = '';
        if(!empty($_SESSION['aviso']))
        {
            $aviso = $_SESSION['aviso'];
            $_SESSION['aviso']='';
        }
        if(isset($_SESSION['vendedor']['nome']))
        {
            $nome = $_SESSION['vendedor']['nome'];
        }
        else
        {
            header('Location:'.BASE_URL.'cadastrovendedor');
            exit;
        }
        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();
		
        $this->loadTemplate('cadastroVendedorSenha', [
            'template' => $template,
            'nome' => $nome,
            'aviso' => $aviso
        ]);
    }

    public function storageFinished()
    {
        $senha = filter_input(INPUT_POST,'senha');
        $confirma_senha = filter_input(INPUT_POST,'confirmar_senha');

        if($senha && $confirma_senha && strlen($senha) >= 6 && !empty($_SESSION['vendedor']))
        {
            $c = new Clientes();
            $c->setNomeCliente($_SESSION['vendedor']['nome']);
            $c->setCpfCliente($_SESSION['vendedor']['cpf']);
            $c->setEmailCliente($_SESSION['vendedor']['email']);
            $c->setNascimentoCliente($_SESSION['vendedor']['nascimento']);
            $c->setSexoCliente($_SESSION['vendedor']['sexo']);
            $c->setTelefone($_SESSION['vendedor']['telefone']);
            $c->setCelular($_SESSION['vendedor']['celular']);
            $c->setSenha(md5($senha));
            $c->setTipo(1); //Tipo 1 = Vendedor
            $id_cliente = $id_cadastro = $c->salvar();

            $dadosBancarios = new DadosBancarios();
            $dadosBancariosHandler = new DadosBancariosHandler();
            $dadosBancarios->setIdCliente($id_cadastro);
            $dadosBancarios->setBanco($_SESSION['vendedor']['banco']);
            $dadosBancarios->setAgencia($_SESSION['vendedor']['agencia']);
            $dadosBancarios->setConta($_SESSION['vendedor']['conta']);
            $dadosBancarios->setTipo($_SESSION['vendedor']['tipo']);
            $dadosBancarios->setDataCadastro(date('Y-m-d H:i:s'));
            $dadosBancarios->setNomeTitular($_SESSION['vendedor']['nome_titular']);
            $dadosBancarios->setCPFTitular($_SESSION['vendedor']['cpf_titular']);
            $dadosBancariosHandler->insert($dadosBancarios);

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

            $_SESSION['id_cadastro'] = $id_cadastro;
            header('Location:'.BASE_URL.'cadastrovendedor/confirm');
            exit;
        }

        header('Location:'.BASE_URL.'cadastrovendedor/password');
        exit;
    }

    public function confirm()
    {
        $aviso = '';
        $id_cadastro = '';
        if(!empty($_SESSION['aviso']))
        {
            $aviso = $_SESSION['aviso'];
            $_SESSION['aviso']='';
        }
        if(!empty($_SESSION['id_cadastro']))
        {
            $_SESSION['vendedor'] = '';
            $id_cadastro = $_SESSION['id_cadastro'];
        }

        $c = new Clientes();
        $cliente = $c->getClienteById(md5($id_cadastro));
        
        //Informações para o template
        $template = new Template();
        $template = $template->getInfo();
		
        $this->loadTemplate('cadastroVendedorConfirm', [
            'template' => $template,
            'cliente' => $cliente,
            'aviso' => $aviso
        ]);
    }

}