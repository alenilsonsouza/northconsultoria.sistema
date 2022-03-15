<?php
class painelarvoreController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        header('Location:'.BASE_URL.'painel');
        exit;

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
        }
        
    }

    public function index() {
        $dados = array();

        $niveis = new Niveis();
        $total = $niveis->getTotal();

        $cliente = new Clientes();
        $dados['lista'] = $cliente->listarArvore(0, $total);

         
        /*echo "<pre>";
        print_r($dados['lista']);
        exit;*/
        
        $dados['page'] = "arvore";
        
		
        $this->loadTemplateInPainel('arvore', $dados);
    }

    

}