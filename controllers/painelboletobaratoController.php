<?php
class painelboletobaratoController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
        }
        
    }

    public function index() {
        $dados = array(
            'aviso'=>''
        );

        

        if(!empty($_POST['email'])){
            $b = new BoletoBarato();
            
            $b->setEmail($_POST['email']);
            $b->setSenha($_POST['senha']);
            $b->setAssuntoBoleto($_POST['assuntoBoleto']);
            $b->setCorpoBoleto($_POST['corpoBoleto']);
            $b->setIdSistema($_POST['idSistema']);
            $b->salvar();
           
            $dados['aviso'] = "Dados alterados!";
        }

        $b = new BoletoBarato();
        $dados['boleto'] = $b->getArray();

        $dados['page'] = 'config';

       

        
        $dados['page'] = "boleotobarato";
        
		
        $this->loadTemplateInPainel('boleotobarato', $dados);
    }

    

}