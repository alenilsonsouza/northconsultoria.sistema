<?php
class painelboletosController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
        }
        
    }

    public function index() 
    {

        $faturamento = new Faturamento(); 

        $limit = 24;

        $total = $faturamento->getFaturamentoTotal(); 

        $paginas = ceil($total/$limit);

        $paginaAtual = 1;
        if(!empty($_GET['p'])){
            $paginaAtual = intval($_GET['p']);
        }
        
        $offset = ($paginaAtual * $limit) - $limit;
        $boletos = $faturamento->getFaturamento($offset, $limit);
        
        $this->loadTemplateInPainel('boletos', [
            'page' => 'boletos',
            'boletos' => $boletos,
            'paginas' => $paginas,
            'paginaAtual' => $paginaAtual,
            'total' => $total
        ]);
    }
}