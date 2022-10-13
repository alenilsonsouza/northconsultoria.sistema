<?php
class painelrelatorioController extends controller {

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
            exit;
        }
        
    }

    public function index() {
        
        $people = new N_PeopleHandler();
        $costumers = $people->listCostumers();
		
        $this->loadTemplateInPainel('relatorio', [
            'page' => "relatorio",
            'costumers' => $costumers
        ]);
    }

    

}