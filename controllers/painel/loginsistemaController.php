<?php
class loginsistemaController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array('aviso'=>'');


        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);
            
            $u = new Usuarios();
            if($u->fazerLogin($email, $senha)){
                header("Location: ".BASE_URL."sistema");
            }else{
                $dados['aviso'] = "Usuário ou senha não conferem.";
            }
            
        }

       

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();
		
		
        $this->loadViewInSistema('login', $dados);
    }

    public function sair(){

        $u = new Usuarios();
        $u->isLogged();
        $u->logout();
        
        header("Location: ".BASE_URL."loginsistema");
        exit;
        

        
    }

}