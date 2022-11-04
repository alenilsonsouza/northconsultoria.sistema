<?php
class arperfilController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Clientes();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."loginusuario");
        }
        
    }

    public function index() {
        $dados = array();

        $estado =new Estado();
        $dados['estados'] = $estado->getEstados();

        $estadoCivil = new EstadoCivil();
        $dados['estadoCivil'] = $estadoCivil->getEstadoCivil();

        $plano = new Plano();
        $dados['planos'] = $plano->getPlano();

        $cliente = new Clientes();
        $dados['cliente'] = $cliente->getClienteById($_SESSION['clogin']);

        $endereco = new Enderecos();
        $dados['endereco'] = $endereco->getEnderecoByIdCliente($dados['cliente']['id_cliente']);
        
        $dados['page'] = "perfil";
        
        $this->loadTemplateInUsuario('perfil', $dados);
    }

    public function storageAction() {

        $nome = filter_input(INPUT_POST, 'nome');
        $dia = filter_input(INPUT_POST, 'dia');
        $mes = filter_input(INPUT_POST, 'mes');
        $ano = filter_input(INPUT_POST, 'ano');
        $nome_mae = filter_input(INPUT_POST, 'nome_mae');
        $estado_civil = filter_input(INPUT_POST, 'estado_civil');
        $rg = filter_input(INPUT_POST, 'rg');
        $sexo = filter_input(INPUT_POST, 'sexo');
        $telefone = filter_input(INPUT_POST, 'telefone');
        $celular = filter_input(INPUT_POST, 'celular');
        $cep = filter_input(INPUT_POST, 'cep');
        $logradouro = filter_input(INPUT_POST, 'logradouro');
        $numero = filter_input(INPUT_POST, 'numero');
        $complemento = filter_input(INPUT_POST, 'complemento');
        $bairro = filter_input(INPUT_POST, 'bairro');
        $cidade = filter_input(INPUT_POST, 'cidade');
        $estado = filter_input(INPUT_POST, 'estado');
        $id_endereco = filter_input(INPUT_POST, 'id_endereco');
        $cpf = filter_input(INPUT_POST, 'cpf');


        if($nome && $cpf) {
            $c = new Clientes();
            $c->setNomeCliente($nome);
            $c->setNomeMae($nome_mae);
            $c->setNascimentoCliente($ano.'-'.$mes.'-'.$dia);
            $c->setIdEstadoCivil($estado_civil);
            $c->setRg($rg);
            $c->setSexoCliente($sexo);
            $c->setTelefone($telefone);
            $c->setCelular($celular);
            $c->salvar($cpf);

            /*$e = new Enderecos();
            $e->setLogradouro($logradouro);
            $e->setCep($cep);
            $e->setNumero($numero);
            $e->setComplemento($complemento);
            $e->setBairro($bairro);
            $e->setCidade($cidade);
            $e->setEstado($estado);
            $e->salvar($id_endereco);*/
        }

        header('Location:'.BASE_URL.'arperfil');
        exit;
    }

    

}