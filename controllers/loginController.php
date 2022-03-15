<?php
class loginController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

    }

    

    public function index() {
        $dados = array();
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);
            
            $u = new Usuarios();
            if($u->fazerLogin($email, $senha)){
                header("Location: ".BASE_URL."painel");
            }else{
                $dados['aviso'] = "Usuário ou senha não conferem.<br>
                                Se você está tentando acessar<br>
                                a área do beneficiário. É esse link:<br>
                                <a href='".BASE_URL."ar'>-Área do Beneficário-</a>";
            }
            
        }


        $s = new Site();
        $dados['site'] = $s->getArray();
        $c = new Configuracoes();
        $dados['configuracoes'] = $c->getArray();
        
		
		
        $this->loadViewInPainel('login', $dados);
    }


    public function sair(){

        $u = new Usuarios();
        $u->isLogged();
        $u->logout();
        
        header("Location: ".BASE_URL."login");
        exit;
        

        
    }

    

}