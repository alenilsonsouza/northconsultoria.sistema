<?php
class menuperfilController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
        }
        
    }

    public function index() {
        $dados = array('aviso' => '');

        if(!empty($_POST['usuario'])){

            $u = new Usuarios($_SESSION['plogin']);
            $u->setUsuario(addslashes($_POST['usuario']));
            $u->setEmail($_POST['email']);

            if(!empty($_POST['senha']) && !empty($_POST['repetisenha'])){
                $senha = $_POST['senha'];
                $repetisenha = $_POST['repetisenha'];

                if($senha == $repetisenha){

                    $u->setSenha(md5($senha));
                }else{

                    $dados['aviso'] = "Senhas Não Conferem";
                }
            }

            $u->atualizar();
        }

        $u = new Usuarios($_SESSION['plogin']);
        $dados['usuario'] = $u->getUser();

        
        $dados['page'] = "menuperfil";
		
        $this->loadTemplateInPainel('menuperfil', $dados);
    }

    

}