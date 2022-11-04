<?php
class painelbannersController extends controller {

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

        $dados = array(
            'existe' =>''
        );

        if(isset($_POST['atualizar'])){
            $ordem = $_POST['ordem'];
            $id_banner = $_POST['id_banner'];

            $b = new Banners();
            $b->atualizarOrdemBanner($ordem, $id_banner);
            header("Location:".BASE_URL."painelbanners");
        }

        if(isset($_POST['mostrar_banner'])){
            $mostrar_banner = addslashes($_POST['mostrar_banner']);

            $c = new Config();
            $c->setMostrarBanner($mostrar_banner);
            $c->atualizar();
            header("Location:".BASE_URL."painelbanners");
            exit;
        }

        $b = new Banners();
        $dados['banners'] = $b->getArray();
        $v = new Video();
        $dados['videos'] = $v->getArray();

        $c= new Config();
        $dados['config'] = $c->getArray();


        if($v->verificarExisteVideo() == true){
            $dados['existe'] = 1;
        }

        
        $dados['page'] = "banners";
		
        $this->loadTemplateInPainel('banners', $dados);
    }

    public function adicionar(){
        $dados = array(
            'aviso'=>''
        );

        if(!empty($_POST['nome'])){

            $nome = addslashes($_POST['nome']);
            $url = $_POST['url'];
            $ordem = addslashes($_POST['ordem']);
            $arquivo = $_FILES['arquivo'];
            $tela = addslashes($_POST['tela']);

            $a = new Arquivos();
            $id_arquivo = $a->guardarImagem($arquivo);
            if($id_arquivo != 0){
                $b = new Banners();
                $b->setNomeBanner($nome);
                $b->setUrl($url);
                $b->setOrdem($ordem);
                $b->setIdArquivo($id_arquivo); 
                $b->setTela($tela);
                $b->salvar();
                header("Location:".BASE_URL."painelbanners");
                exit;
            }else{
                $dados['aviso'] = "Formato não aceito. Somente imagens JPEG e PNG."; 
            }
            
        }

        $dados['page'] = "banners";

        $this->loadTemplateInPainel('adicionarbanner',$dados);
    }

    public function editar($id){
        $dados = array();

        if(!empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $url = $_POST['url'];
            $ordem = $_POST['ordem'];
            $id_arquivo = $_POST['id_arquivo'];
            $arquivo = $_FILES['arquivo'];

            $a = new Arquivos();
            $a->atualizaArquivo($id_arquivo, $arquivo); 
            $b = new Banners();
            $b->setNomeBanner($nome);
            $b->setUrl($url);
            $b->setOrdem($ordem);
            $b->salvar($id);
            header("Location:".BASE_URL."painelbanners");
            exit;
        }

        $b = new Banners($id);
        $dados['banner'] = $b->getArray();

        $dados['page'] = "banners";

        $this->loadTemplateInPainel('editarbanner',$dados);
    }

    public function excluir($id){
        if(!empty($id)){
            $b = new Banners($id);
            $banner = $b->getArray();

            $id_arquivo = $banner['id_arquivo'];

            $b->excluirBanner($id);
            $a = new Arquivos();
            $a->excluirArquivo($id_arquivo);
        }
        
        header("Location:".BASE_URL."painelbanners");
        exit;
    }

    public function adicionarvideo(){

        $vi = new Video();
        if($vi->verificarExisteVideo() == true){
            header("Location:".BASE_URL."painelbanners");
            exit;
        }
        $dados = array(
            'aviso' => ''
        );

        if(!empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $arquivo = $_FILES['arquivo'];

            

            $a = new Arquivos();
            $id_arquivo = $a->guardavideo($arquivo);
            if($id_arquivo != 0){
                $v = new Video();
                $i = $v->setNomeVideo($nome);
                if($i == true){
                    $ok = 1;
                    }else{
                        $dados['aviso'] = 'Isso não é um texto';
                } 
                $i = $v->setIdArquivo($id_arquivo);
                if($i == true){
                        $ok = 1;
                    }else{
                        $dados['aviso'] = 'Isto não é um vídeo mp4. Só é aceito vídeo mp4';
                        
                } 
                if($ok == 1){
                    $v->salvar();
                    header("Location:".BASE_URL."painelbanners");
                    exit;
                }
                

            }
        }

        $dados['page'] = "banners";

        $this->loadTemplateInPainel('adicionarvideo', $dados);
    }

    public function editarvideo($id){
        $dados = array();

        if(!empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $id_arquivo = $_POST['id_arquivo'];
            $arquivo = $_FILES['arquivo'];

            $a = new Arquivos();
            $a->atualizaVideo($id_arquivo, $arquivo);
            $v = new Video();
            $v->setNomeVideo($nome);
            $v->salvar($id);
            header("Location:".BASE_URL."painelbanners");

        }

        $v = new Video($id);
        $dados['video'] = $v->getArray();


        $dados['page'] = "banners";

        $this->loadTemplateInPainel('editarvideo', $dados);
    }

    public function excluirvideo($id){

        if(!empty($id)){
            $v = new Video($id);
            $video = $v->getArray();
            $id_arquivo = $video['id_arquivo'];

            $v->excluirVideo($id);
            $a = new Arquivos();
            $a->excluirArquivo($id_arquivo);
        }
        
        header("Location:".BASE_URL."painelbanners");
        exit;

    }

    

}