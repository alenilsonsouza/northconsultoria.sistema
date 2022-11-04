<?php
class arboletosController extends controller {

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
        $id_cliente = $_SESSION['clogin'];
        $faturamento = new Faturamento(); 

        $limit = 12;

        $total = $faturamento->getFaturamentoTotalByIdCliente($id_cliente); 

        $paginas = ceil($total/$limit);

        $paginaAtual = 1;
        if(!empty($_GET['p'])){
            $paginaAtual = intval($_GET['p']);
        }
        
        $offset = ($paginaAtual * $limit) - $limit;
        $boletos = $faturamento->getFaturamentoByIdCliente($id_cliente, $offset, $limit);

        $this->loadTemplateInUsuario('boletos', [
            'page' => 'boletos',
            'boletos' => $boletos,
            'paginas' => $paginas,
            'paginaAtual' => $paginaAtual,
            'total' => $total
        ]);
    }

    

}