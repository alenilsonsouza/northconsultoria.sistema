<?php
class painelperfilController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
        }
        
    }

    public function index() {
        $dados = array();

       

        
        $dados['page'] = "perfil";
        
		
        $this->loadTemplateInPainel('perfil', $dados);
    }

    

}