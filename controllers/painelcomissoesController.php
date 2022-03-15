    <?php
class painelcomissoesController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
        }
        
    }

    public function index() {

        $pagina = filter_input(INPUT_GET,'p');
        
        $clientes = new Clientes(); 

        $limit = 30;

        $total = $clientes->getTotalClienteVendedor(); 

        $paginas = ceil($total/$limit);

        $paginaAtual = 1;
        if($pagina)
        {
            $paginaAtual = intval($pagina);
        }
        
        $offset = ($paginaAtual * $limit) - $limit;

        $mes = date('m');
        
        $vendedores = $clientes->getClienteVendedor($offset, $limit, $mes);

        $dtBanco = new DadosBancariosHandler();
        $comissaoPagamento = new ComissoesPagamentoHandler();
        
        $mes = date('m');
        $ano = date('Y');
  
		
        $this->loadTemplateInPainel('comissoes', [
            'page' => 'comissoes',
            'vendedores' => $vendedores,
            'paginaAtual' => $paginaAtual,
            'paginas' => $paginas,
            'obCliente' => $clientes,
            'mes' => $mes,
            'ano' => $ano,
            'banco' => $dtBanco, 
            'comissaoPagamento' => $comissaoPagamento
            
        ]);
    }

    public function confirmarPagamento() 
    {
        $paginaAtual = filter_input(INPUT_GET,'paginaAtual');
        $valor = filter_input(INPUT_GET,'valor');
        $id_cliente = filter_input(INPUT_GET,'id_cliente');

        if($valor && $id_cliente) {
            $c = new ComissoesPagamento();
            $cHandler = new ComissoesPagamentoHandler();
            $c->setIdCliente($id_cliente);
            $c->setPrice($valor);
            $c->setDate(date('Y/m/d'));
            $cHandler->insert($c);
        }

        header("Location:".BASE_URL."painelcomissoes?p=".$paginaAtual);
        exit;
    }

    public function comissoesPagas() {

        $mes = filter_input(INPUT_GET,'mes');
        $ano = filter_input(INPUT_GET, 'ano');
        $pagina = filter_input(INPUT_GET, 'p');

        $mesRef = date('m');
        $anoRef = date('Y');
        if($mes && $ano) {
            $mesRef = $mes;
            $anoRef = $ano;
        }

        $pagamento = new ComissoesPagamentoHandler(); 

        $limit = 24;

        $total = $pagamento->totalPagoNoMes($mesRef, $anoRef); 

        $paginas = ceil($total/$limit);

        $paginaAtual = 1;
        if($pagina){
            $paginaAtual = intval($pagina);
        }
        
        $offset = ($paginaAtual * $limit) - $limit;
        $pagamentos = $pagamento->pagosNoMes($mesRef, $anoRef, $offset, $limit);
    
        
        $this->loadTemplateInPainel('comissoes_pagas', [
            'page' => 'comissoes_pagas',
            'pagamentos' => $pagamentos,
            'paginas' => $paginas,
            'paginaAtual' => $paginaAtual,
            'mes' => $mesRef,
            'ano' => $anoRef
            
        ]);
    }
}