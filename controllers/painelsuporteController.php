<?php
class painelsuporteController extends controller {

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

        $u = new Usuarios($_SESSION['plogin']);
        $user = $u->getUser();
        $id_usuario = $user['id'];

        $s = new Suporte();

        $limit = 20;

        $total = $s->getTotal($id_usuario); 

        $dados['paginas'] = ceil($total/$limit);

        $dados['paginaAtual'] = 1;
        if(!empty($_GET['p'])){
            $dados['paginaAtual'] = intval($_GET['p']);
        }
        
        $offset = ($dados['paginaAtual'] * $limit) - $limit;
        $dados['suportes'] = $s->getSuporte($id_usuario, $offset, $limit);
        

        $dados['page'] = "suporte";
        
		
        $this->loadTemplateInPainel('suporte', $dados);
    }

    public function abrirsuporte(){
        $dados = array();

        if(!empty($_POST['assunto'])){

            if(!empty($_FILES['arquivo']['tmp_name'])){
                $arquivo = $_FILES['arquivo'];
                $a = new Arquivos();
                $id_arquivo = $a->guardarImagem($arquivo);
            }else{
                $id_arquivo = NULL;
            }

            $u = new Usuarios($_SESSION['plogin']);
            $user = $u->getUser();
            $id_usuario = $user['id'];

            $s = new Suporte();
            $s->setAssuntoSuporte(addslashes($_POST['assunto']));
            $s->setDescricao(addslashes($_POST['descricao']));
            $s->setIdArquivo($id_arquivo);
            $s->setIdUsuario($id_usuario);
            $s->setIdSuporte(0);
            $s->setTipoSuporte($_POST['tipo_suporte']);
            $s->salvar();

            header("Location:".BASE_URL."painelsuporte");
            exit;
        }

        $dados['page'] = "suporte";

        $this->loadTemplateInPainel('abrirsuporte', $dados);
    }

    public function ver($id){
        $dados = array();

        if(!empty($_POST['descricao'])){

            $s = new Suporte();
            $s->setAssuntoSuporte($_POST['assunto_suporte']);
            $s->setDescricao(addslashes($_POST['descricao']));
            $s->setTipoSuporte($_POST['tipo_suporte']);
            $s->setIdSuporte($_POST['id_suporte']);
            $s->setIdUsuario($_POST['id_usuario']);
            $s->setIdArquivo($_POST['id_arquivo']);
            $s->salvar();
            header("Location:".BASE_URL."painelsuporte/ver/".$id);
            exit;
        }

        $u = new Usuarios($_SESSION['plogin']);
        $user = $u->getUser();
        $dados['id_usuario'] = $user['id'];

        $s = new Suporte($id);
        $dados['suporte'] = $s->getArray();



        $dados['respostas'] = $s->getResposta($dados['suporte']['idsuporte']);

        $dados['page'] = "suporte";

        $this->loadTemplateInPainel("versuporte", $dados);
    }

    

}