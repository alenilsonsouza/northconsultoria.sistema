<?php
class painelconfiguracoesController extends controller {

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

        if(!empty($_POST['cor_padrao'])){

            $c = new Configuracoes();
            $c->setCorPadrao($_POST['cor_padrao']);

            if(isset($_FILES['arquivo'])){

                $arquivo = $_FILES['arquivo'];

                $a = new Arquivos();
                $id_imagem = $a->guardarImagem($arquivo);
                $c->setIdImagem($id_imagem);
                $c->salvar();

            }else{
                $id_imagem = $_POST['id_imagem'];
                $c->setIdImagem($id_imagem);
                $c->salvar();
            }
            
            header("Location:".BASE_URL."painelconfiguracoes");
            exit;
        }

        

        $c = new Configuracoes();
        $dados['config'] = $c->getArray();



        $dados['page'] = "configuracoes";
        
		
        $this->loadTemplateInPainel('painelconfiguracoes', $dados);
    }

    public function removerlogo($id){

        if(!empty($id)){

            $a =  new Arquivos();
            $a->excluirArquivo($id);

            $c = new Configuracoes();
            $c->deletarImagem();
            header("Location:".BASE_URL."painelconfiguracoes");
            exit;
        }
    }

    

}