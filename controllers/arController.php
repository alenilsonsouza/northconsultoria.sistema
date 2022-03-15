<?php
class arController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Clientes();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."loginusuario");
        }
        
    }

    public function index() 
    {
        $cliente = new Clientes();
        $item = $cliente->getClienteById($_SESSION['clogin']);
        $totalIndicados = $cliente->getClienteTotalByIndicador($item['id_cliente']);

        $this->loadTemplateInUsuario('painel', [
            'page' => 'painel',
            'totalIndicados' => $totalIndicados
        ]);
    }

    

}