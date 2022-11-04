<?php
class arcomissaoController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Clientes();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."loginusuario");
        }
        
    }

    public function index() {
        $dados = array();

        $comissao = new Comissao();
        $comissao->setIdCliente($_SESSION['clogin']);

        $comissaoHandler = new ComissaoHandler();
        $info = $comissaoHandler->ComissionCalculator($comissao);

        $resposta = $comissaoHandler->calculo($info, 0);
        
        $dados['page'] = "comissao";
        
        $this->loadTemplateInUsuario('comissao', $dados);
    }
}