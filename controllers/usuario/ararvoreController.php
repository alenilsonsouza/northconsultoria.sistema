<?php
class ararvoreController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        header('Location:'.BASE_URL.'ar');
        exit;

        $u = new Clientes();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."loginusuario");
        }
    }

    public function index() {
        $dados = array();

        $niveis = new Niveis();
        $total = $niveis->getTotal();

        //Lista a árvore pelo id do cliente
        $cliente = new Clientes();
        $info = $cliente->getClienteById($_SESSION['clogin']);
        $dados['lista'] = $cliente->listarArvore($info['id_cliente'], $total - 1 );


        $dados['page'] = "arvore";
        
        $this->loadTemplateInUsuario('arvore', $dados);
    }

    

}