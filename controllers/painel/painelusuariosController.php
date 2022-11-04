<?php
class painelusuariosController extends controller {

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

        $u = new Usuarios();
        $dados['usuarios'] = $u->getUsuarios();

        $dados['page'] = "usuarios";
        
		
        $this->loadTemplateInPainel('painelusuarios', $dados);
    }

    public function adicionar(){
        $dados = array('aviso'=>'');

        if(!empty($_POST['usuario']) && !empty($_POST['email'])){

            $usuario = addslashes($_POST['usuario']);
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);

            $u = new Usuarios();
            if($u->setUsuario($usuario) && $u->setEmail($email) && $u->setSenha($senha)){

                if(!$u->usuarioExiste($email)){
                    if($u->getTotal() <= 20){
                        $u->inserirUsuario();
                        header("Location:".BASE_URL."painelusuarios");
                        exit;
                    }else{
                        $dados['aviso'] = "Não é possível adionar mais usuario.";
                    }
                    
                }else{
                    $dados['aviso'] = "E-mail já cadastrado. Favor cadastrar outro e-mail";
                }
            }
        }

        $dados['page'] = "usuarios";

        $this->loadTemplateInPainel('adicionarusuario', $dados);
    }

    public function editar($id){
        $dados = array();

        if(!empty($_POST['usuario']) && !empty($_POST['email'])){
            $usuario = addslashes($_POST['usuario']);
            $email = addslashes($_POST['email']);
            if(!empty($_POST['senha'])){
                $senha = md5($_POST['senha']);
            }else{
                $senha ='';
            }

            $u = new Usuarios($id);
            $u->setUsuario($usuario);
            $u->setEmail($email);
            $u->setSenha($senha);
            $u->atualizar();
            header("Location:".BASE_URL."painelusuarios");
            exit;
        }


        $u = new Usuarios($id);
        $dados['usuario'] = $u->getUser();

        $dados['page'] = "usuarios";

        $this->loadTemplateInPainel('editarusuario', $dados);
    }

    public function excluir($id){

        if(!empty($id)){
            $u = new Usuarios();
            $u->excluir($id);
        }
        header("Location:".BASE_URL."painelusuarios");
        exit;
    }

    

}