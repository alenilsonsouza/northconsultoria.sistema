<?php
class painelsiteController extends controller {

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

        if(!empty($_POST['titulo'])){

            $titulo = addslashes($_POST['titulo']);
            $descricao = $_POST['descricao'];
            $palavra_chave = $_POST['palavra_chaves'];
            $scripts = $_POST['scripts'];
            $emails = $_POST['emails'];

           
            $s = new Site();
            $s->setTitulo($titulo);
            $s->setDescricao($descricao);
            $s->setPalavraChave($palavra_chave);
            $s->setScripts($scripts);
            $s->setEmails($emails);
            $s->atualizar();
            header("Location:".BASE_URL.'painelsite');
            exit;
        }

        $s = new Site();
        $dados['site'] = $s->getArray();

        
        $dados['page'] = "site";
		
        $this->loadTemplateInPainel('painelsite', $dados);
    }

    

}