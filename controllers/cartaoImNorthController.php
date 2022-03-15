<?php
class cartaoImNorthController extends controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = [];
        $dados['flash'] = '';
        if(!empty($_SESSION['flash']))
        {
            $dados['flash'] = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $config = new Config();
        $dados['config'] = $config->getArray();

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['menu'] = 1; 
        $dados['page'] = 'cartaoImNorth';
		
		
        $this->loadTemplate('cartaoImNorth', $dados);
    }

    

}