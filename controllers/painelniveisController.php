<?php
class painelniveisController extends controller {

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

        if(!empty($_POST['nivel'])){
            $niveis = new Niveis();

            if(!$niveis->verifyNivel($_POST['nivel'])){
                $niveis->setNivel($_POST['nivel']);
                $niveis->setValorComissao($_POST['valor_comissao']);
                $niveis->salvar();
                header('Location:'.BASE_URL.'painelniveis');
                exit;
            }else{
                $dados['aviso'] = "O nível informado já existe!";
            }
            
        }

        $niveis = new Niveis();
        $dados['niveis'] = $niveis->getNiveis();

        $dados['page'] = "niveis";
        
		
        $this->loadTemplateInPainel('niveis', $dados);
    }

    public function editar($id){
        $dados=array();

        if(!empty($_POST['valor_comissao'])){
            $niveis = new Niveis();
            $niveis->setValorComissao($_POST['valor_comissao']);
            $niveis->salvar($id);
            header('Location:'.BASE_URL.'painelniveis');
            exit;

        }

        $niveis = new Niveis();
        $dados['nivel'] = $niveis->getNivelById($id);

        $dados['page'] = "niveis";

        $this->loadTemplateInPainel('editarnivel', $dados);
    }

    public function excluir($id){

        if(!empty($id)){
            $niveis = new Niveis();
            $niveis->excluir($id);
        }
        header('Location:'.BASE_URL.'painelniveis');
        exit;
        

    }

    

}