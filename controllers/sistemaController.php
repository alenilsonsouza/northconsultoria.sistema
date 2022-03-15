<?php
class sistemaController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios($_SESSION['plogin']);
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."loginsistema");
        }
        $this->user = $u->getUser();
    }

    public function index() {
        $dados = array();

       

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['user'] = $this->user;
		
		
        $this->loadTemplateInSistema('home', $dados);
    }

}