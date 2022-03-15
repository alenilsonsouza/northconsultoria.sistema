<?php
class painelredessociaisController extends controller {

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

        $r = new RedeSociais();
        $dados['redes'] = $r->getArray();

        $dados['page'] = "redes";

        $this->loadTemplateInPainel('painelredessociais', $dados);
    }

    public function adicionar() {
        $dados = array();

        if(!empty($_POST['nome_rede'])){

            $imagem = $_FILES['imagem'];
            


            $i = new Arquivos();
            $id_imagem = $i->guardarImagem($imagem);
            

            $r = new RedeSociais();
            $r->setNomeRede($_POST['nome_rede']);
            $r->setLinkRede($_POST['link_rede']);
            $r->setIdImagem($id_imagem);
            $r->salvar();
            header("Location:".BASE_URL."painelredessociais");
            exit;

        }

        $dados['page'] = "redes";

        $this->loadTemplateInPainel('adicionarredessociais', $dados);
    }

    public function excluir($id){

        if(!empty($id)){

            $r = new RedeSociais($id);
            $item = $r->getArray();
            $a = new Arquivos();
            $a->excluirArquivo($item['id_imagem']);
            $r->excluirById($id);

        }
        header("Location:".BASE_URL."painelredessociais");
        exit;
    }

    public function editar($id){
        $dados = array();

        if(!empty($_POST['nome_rede'])){

            $arquivo = $_FILES['imagem'];
            $id_arquivo = $_POST['id_imagem'];

            $a = new Arquivos();
            $a->atualizaArquivo($id_arquivo, $arquivo);

            $r = new RedeSociais();
            $r->setNomeRede($_POST['nome_rede']);
            $r->setLinkRede($_POST['link_rede']);
            $r->setIdImagem($_POST['id_imagem']);
            $r->salvar($id);
            header("Location:".BASE_URL."painelredessociais");
            exit;
        }

        $r = new RedeSociais($id);
        $dados['rede'] = $r->getArray();

        $dados['page'] = "redes";

        $this->loadTemplateInPainel('editarredesociais', $dados);
    }

    

}