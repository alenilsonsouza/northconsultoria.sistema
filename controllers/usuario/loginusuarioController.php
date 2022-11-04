<?php
class loginusuarioController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

    }

    public function index() {
        $dados = array();

        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email = $_POST['email'];
            $senha = md5($_POST['senha']);

            //echo 'Senha: '.$senha;exit;
            
            $c = new Clientes();
            if($c->fazerLogin($email, $senha)){
                header("Location: ".BASE_URL."ar");
                exit;
            }else{
                $dados['aviso'] = "Usuário ou senha não conferem.";
            }
            
        }
        
        $s = new Site();
        $dados['site'] = $s->getArray();
        $c = new Configuracoes();
        $dados['configuracoes'] = $c->getArray();
        
        $this->loadViewInUsuario('login', $dados);
    }


    public function sair(){

        $c = new Clientes();
        $c->isLogged();
        $c->logout();
        
        header("Location: ".BASE_URL."loginusuario");
        exit;
        

        
    }

    

}