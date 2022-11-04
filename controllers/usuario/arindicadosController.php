<?php
class arindicadosController extends controller {

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
        
        $clientes = new Clientes(); 
        $infoCliente = $clientes->getClienteById($_SESSION['clogin']);

        $vendaDireta = new NegocioVendaDireta();
        
        $limit = 12;

        $total = $vendaDireta->ListTotal($infoCliente['id_cliente']); 

        $paginas = ceil($total/$limit);

        $paginaAtual = 1;
        if(!empty($_GET['p']))
        {
            $paginaAtual = intval($_GET['p']);
        }
        
        $offset = ($paginaAtual * $limit) - $limit;
        $clientes = $vendaDireta->ListIndicator($infoCliente['id_cliente'], $offset, $limit);

        $c = new Clientes();
        $item = $c->getClienteById($_SESSION['clogin']);
        
        $this->loadTemplateInUsuario('indicados', [
            'page' => 'indicados',
            'paginas' => $paginas,
            'clientes' => $clientes
        ]);
    }

    public function boletos($id_cliente)
    {
        $faturamento = new Faturamento(); 

        $limit = 12;

        $total = $faturamento->getFaturamentoTotalByIdCliente($id_cliente); 

        $paginas = ceil($total/$limit);

        $paginaAtual = 1;
        if(!empty($_GET['p']))
        {
            $paginaAtual = intval($_GET['p']);
        }
        
        $offset = ($paginaAtual * $limit) - $limit;
        $boletos = $faturamento->getFaturamentoByIdCliente($id_cliente, $offset, $limit);

        $clientes = new Clientes();
        $cliente = $clientes->getClienteById($id_cliente);

        $boletoBarato = new BoletoBarato();
        $infoBoleto = $boletoBarato->getArray();

        $this->loadTemplateInUsuario('indicadosBoletos', [
            'page' => 'indicados',
            'boletos' => $boletos,
            'cliente' => $cliente,
            'paginas' => $paginas,
            'paginaAtual' => $paginaAtual,
            'infoBoleto' => $infoBoleto


        ]);
    }

    

}