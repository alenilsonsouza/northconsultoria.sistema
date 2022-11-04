<?php
class arbancoController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Clientes();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."loginusuario");
        }
    }

    public function index() {
        
        $cliente = new Clientes();
        $info = $cliente->getClienteById($_SESSION['clogin']);

        $banco = new DadosBancariosHandler();
        $banco = $banco->getBancoByIdCliente($info['id_cliente']);
		
        $this->loadTemplateInUsuario('banco', [
            'page'=> 'banco',
            'banco'=> $banco
        ]);
    }

    public function atualizar() {
        
        $cliente = new Clientes();
        $info = $cliente->getClienteById($_SESSION['clogin']);

        $banco = new DadosBancariosHandler();
        $banco = $banco->getBancoByIdCliente($info['id_cliente']);

        $bancos = new BancosHandler();
        $bancos = $bancos->getList();
		
        $this->loadTemplateInUsuario('banco_atualizar', [
            'page'=> 'banco',
            'banco'=> $banco,
            'cliente'=> $info,
            'bancos' => $bancos
        ]);
    }

    public function storeage() {

        $nomeBanco = filter_input(INPUT_POST,'banco');
        $agencia = filter_input(INPUT_POST,'agencia');
        $conta = filter_input(INPUT_POST,'conta');
        $tipo = filter_input(INPUT_POST,'tipo');
        $nome_titular = filter_input(INPUT_POST,'nome_titular');
        $cpf_titular = filter_input(INPUT_POST,'cpf_titular');
        $id = filter_input(INPUT_POST,'id');

        if($nomeBanco && $agencia && $conta && $tipo && $id) {
            $banco = new DadosBancarios();
            $banco->setId($id);
            $banco->setBanco($nomeBanco);
            $banco->setAgencia($agencia);
            $banco->setConta($conta);
            $banco->setNomeTitular($nome_titular);
            $banco->setCPFTitular($cpf_titular);
            $banco->setTipo($tipo);

            $b = new DadosBancariosHandler();
            $b->update($banco);

            header('Location:'.BASE_URL.'arbanco');
            exit;
        }

        header('Location:'.BASE_URL.'arbanco/atualizar');
        exit;
    }
}