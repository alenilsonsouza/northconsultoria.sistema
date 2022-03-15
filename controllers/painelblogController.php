<?php
class painelblogController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
            exit;
        }
        
    }

    public function index() {
        $dados = array();

        $blog = new Blog(); 

        $limit = 6;

        $total = $blog->getTotal(); 

        $dados['paginas'] = ceil($total/$limit);

        $dados['paginaAtual'] = 1;
        if(!empty($_GET['p'])){
            $dados['paginaAtual'] = intval($_GET['p']);
        }
        
        $offset = ($dados['paginaAtual'] * $limit) - $limit;
        $dados['blogs'] = $blog->getBlogs($offset, $limit);

        
        $dados['page'] = "blog";
		
        $this->loadTemplateInPainel('painelblog', $dados);
    }

    public function adicionar(){
        $dados = array();

        if(!empty($_POST['titulo_blog'])){

            $a = new Arquivos();
            $id_imagem = $a->guardarImagem($_FILES['imagem']);

            $s = new Slug();
            $slug = $s->criar_slug(addslashes($_POST['titulo_blog']));

            $b = new Blog();
            $b->setTituloBlog(addslashes($_POST['titulo_blog']));
            $b->setMetaDescriptionBlog(addslashes($_POST['meta_description']));
            $b->setSlugBlog($slug);
            $b->setDataCadastroBlog(date('Y-m-d'));
            $b->setTextoBlog(addslashes($_POST['texto']));
            $b->setIdImagem($id_imagem);
            $b->salvar();

            header("Location:".BASE_URL."painelblog");
            exit;

        }

        $dados['page'] = "blog";


        $this->loadTemplateInPainel('adicionarblog', $dados);

    }

    public function editar($id){
        $dados = array();

        if(!empty($_POST['titulo_blog'])){

            if(!empty($_FILES['imagem']['name'])){

                $id_arquivo = $_POST['id_imagem'];
                $arquivo = $_FILES['imagem'];

                $a = new Arquivos();
                $a->atualizaArquivo($id_arquivo, $arquivo);

            }

            
            $s = new Slug();
            $slug = $s->criar_slug(addslashes($_POST['titulo_blog']));

            $b = new Blog();
            $b->setTituloBlog(addslashes($_POST['titulo_blog']));
            $b->setMetaDescriptionBlog(addslashes($_POST['meta_description']));
            $b->setSlugBlog($slug);
            $b->setDataAtualizacao(date('Y-m-d'));
            $b->setTextoBlog(addslashes($_POST['texto']));
            $b->salvar($id);

            if(isset($_POST['concluir'])){
                header("Location:".BASE_URL."painelblog");
                exit;
            }else{
                header("Location:".BASE_URL.'painelblog/editar/'.$id);
                exit;
            }
        }


        $b = new Blog($id);
        $dados['blog'] = $b->getArray();

        $dados['page'] = "blog";
        
        $this->loadTemplateInPainel('editarblog', $dados);
    }

    public function excluir($id){



        $b = new Blog($id);
        $blog = $b->getArray();

        $a = new Arquivos();
        $a->excluirArquivo($blog['id_imagem']);

        $b->excluirBlog($id);

        header("Location:".BASE_URL."painelblog");
        exit;


    }


}