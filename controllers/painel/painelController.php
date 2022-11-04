<?php
class painelController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
        }
        
    }

    public function index() {
        
        $people = new N_PeopleHandler();
        $totalPeople = $people->totalPeople();
        $totalTitulares = $people->totalPeople('T');
        $totalVendedores = $people->totalPeople('C');
        $totalMes = $people->totalMes(date('m'), date('Y'));

        $titulares = $people->list('T','', 0, 5);
        $vendedores = $people->list('C','', 0, 5);
        
		
        $this->loadTemplateInPainel('painel', [
            'page' => 'painel',
            'totalMes' => $totalMes,
            'totalPeople' => $totalPeople,
            'totalTitulares' => $totalTitulares,
            'totalVendedores' => $totalVendedores,
            'titulares' => $titulares,
            'vendedores' => $vendedores
        ]);
    }
}