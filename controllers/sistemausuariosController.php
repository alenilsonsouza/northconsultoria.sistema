<?php
class sistemausuariosController extends controller {

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

       $usuarios = new Usuarios();
       $dados['usuarios'] = $usuarios->getUsuarios();

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['user'] = $this->user;
		
		
        $this->loadTemplateInSistema('sistemausuarios', $dados);
    }

    public function adicionar() {
        $dados = array('dados'=>'');

        $usuarios = new Usuarios();
        
        //Cadastra usuario e verifica as senhas
        if(!empty($_POST['usuario'])){
            if($_POST['senha'] == $_POST['repeti_senha']){
                $usuarios->setUsuario($_POST['usuario']);
                $usuarios->setEmail($_POST['email']);
                $usuarios->setSenha($_POST['senha']);
                $usuarios->inserirUsuario();
                header('Location:'.BASE_URL.'sistemausuarios');
                exit;
            }else{

                //Se as senha não conferir é mostrado essa mensagem no view
                $dados['aviso'] = "Senhas não conferem! Favor tente novamente!";
            }
        }
      

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['user'] = $this->user;
		
		
        $this->loadTemplateInSistema('adicionarusuarios', $dados);
    }
    
    public function editar($id){
        $dados = array();

        $usuarios = new Usuarios();
        //Cadastra usuario e verifica as senhas
        if(!empty($_POST['usuario'])){
            $usuarios->setUsuario($_POST['usuario']);
            $usuarios->setEmail($_POST['email']);
            $usuarios->atualizarbyId($id);
            $dados['aviso'] = "Usuario e email alterados!";
            if(!empty($_POST['senha ']) && $_POST['senha'] == $_POST['repeti_senha']){
                
                $usuarios->setSenha($_POST['senha']);
                $usuarios->atualizarbyId($id);
                header('Location:'.BASE_URL.'sistemausuarios');
                exit;
                
            }else{

                //Se as senha não conferir é mostrado essa mensagem no view
                $dados['aviso'] .= "<br>Senhas não conferem! Favor tente novamente!";
                
            }
           
            
            
        }


        $dados['usuario'] = $usuarios->getUsuarioById($id);


        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['user'] = $this->user;

        $this->loadTemplateInSistema('editarusuarios', $dados);
    }

    public function excluir($id){

        $usuarios = new Usuarios();
        $usuarios->excluir($id);
        header('Location:'.BASE_URL.'sistemausuarios');
        exit;
    }

}