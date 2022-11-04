<?php
class painelcontatoController extends controller {

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

        $contato = new Contato(); 

        $limit = 20;

        $total = $contato->getTotal(); 

        $dados['paginas'] = ceil($total/$limit);

        $dados['paginaAtual'] = 1;
        if(!empty($_GET['p'])){
            $dados['paginaAtual'] = intval($_GET['p']);
        }
        
        $offset = ($dados['paginaAtual'] * $limit) - $limit;
        $dados['contatos'] = $contato->getList($offset, $limit);

        $dados['page'] = "contato";
        
		
        $this->loadTemplateInPainel('painelcontato', $dados);
    }

    public function excluir($id){

        $contato = new Contato();
        $contato->excluir($id); 

        header('Location:'.BASE_URL.'painelcontato');
        exit;
    }

    

}