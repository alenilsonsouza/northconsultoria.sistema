<?php
class paineltrocacomissaoController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
        }
        
    }

    public function index() {

        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        
        $clientes = new Clientes();
        $vendedores = $clientes->getClienteVendedorTodos(date('m'));
		
        $this->loadTemplateInPainel('trocacomissao', [
            'page' => 'trocacomissao',
            'vendedores' => $vendedores,
            'flash' => $flash
            
        ]);
    }

    public function updateComissao()
    {
        $vendedor = filter_input(INPUT_POST,'vendedor');
        $tipo_comissao = filter_input(INPUT_POST,'tipo_comissao');

        if($vendedor && $tipo_comissao) {
            $clientes = new Clientes();
            $clientes->trocaDePlano($vendedor, $tipo_comissao);
            $_SESSION['flash'] = "A comissão do vendedor foi atualizada."; 
        }

        header('Location:'.BASE_URL.'paineltrocacomissao');
        exit;
    }
}