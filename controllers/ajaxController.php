<?php
class ajaxController extends controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dados = array();
    }

    public function consultar_cep()
    {

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        $dados['sucesso'] = 0;

        if ($method === 'post') {
            $cep = filter_input(INPUT_POST, 'cep');

            //$reg = simplexml_load_file("http://cep.republicavirtual.com.br/web_cep.php?formato=xml&cep=" . $cep);
            $reg = simplexml_load_file("https://viacep.com.br/ws/$cep/json/?callback=meu_callback");

            //$dados['sucesso'] = (string) $reg->resultado;
            $dados['rua']     = (string) $reg->logradouro;
            $dados['bairro']  = (string) $reg->bairro;
            $dados['cidade']  = (string) $reg->cidade;
            $dados['estado']  = (string) $reg->uf;
        }
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Content-Type: application/json");
        echo json_encode($dados);
    }

    public function verificarcpf()
    {

        $clientes = new Clientes();
        if (!empty($_GET['cpf'])) {
            if ($clientes->verificarCpfExiste($_GET['cpf']) == true) {
                $resposta = array(
                    'status' => 1,
                    'message' => 'CPF já cadastrado!'
                );
            } else {
                $resposta = array(
                    'status' => 0,
                    'message' => 'OK!'
                );
            }
            header('Content-Type:json');
            echo json_encode($resposta);
        }
    }

    public function cadastroList()
    {
        $p = filter_input(INPUT_GET,'pagina');
        $pesquisa = filter_input(INPUT_GET,'pesquisa');
        $pessoa = new N_PeopleHandler();

        $limit = 20;

        $total = count($pessoa->list('T','','','')); 

        $paginas = ceil($total/$limit);

        $paginaAtual = 1;
        if($p){
            $paginaAtual = $p;
        }
        
        $offset = ($paginaAtual * $limit) - $limit;
        if($pesquisa) {
            $pag = 0;
            $pessoas = $pessoa->search('C', $pesquisa);
        }else {
            $pag = 1;
            $pessoas = $pessoa->list('C','',$offset, $limit);
        }

        /*echo '<pre>';
        echo $pesquisa;
        print_r($pessoas);
        exit;*/


        $this->loadViewInPainel('cadastros_list', [
            'paginas' => $paginas,
            'paginaAtual' => $paginaAtual,
            'clientes' => $pessoas,
            'p' => $p,
            'obCliente' => new Clientes(),
            'total' => $total
        ]);
    }

    public function cadastroListIndicators()
    {
        $id_cliente = filter_input(INPUT_GET, 'id_cliente');

        if ($id_cliente) {
            $vendaDireta = new NegocioVendaDireta();

            $limit = 30;

            $total = $vendaDireta->ListTotal($id_cliente);

            $paginas = ceil($total / $limit);

            $paginaAtual = 1;
            if (!empty($_GET['p'])) {
                $paginaAtual = intval($_GET['p']);
            }

            $offset = ($paginaAtual * $limit) - $limit;
            $clientes = $vendaDireta->ListIndicator($id_cliente, $offset, $limit);
        } else {
            $clientes = new Clientes();

            $limit = 30;

            $total = $clientes->getTotalClienteTitular();

            $paginas = ceil($total / $limit);

            $paginaAtual = 1;
            if (!empty($_GET['p'])) {
                $paginaAtual = intval($_GET['p']);
            }

            $offset = ($paginaAtual * $limit) - $limit;
            $clientes = $clientes->getClienteTitular($offset, $limit);
        }



        $this->loadViewInPainel('cadastros_listIndicators', [
            'clientes' => $clientes,
            'paginas' => $paginas,
            'paginaAtual' => $paginaAtual,
            'obCliente' => new Clientes()
        ]);
    }

    public function cadastroListDepententes()
    {

        $id_cliente = filter_input(INPUT_GET, 'id_cliente');
        $pessoa = new N_PeopleHandler();
        $total = count($pessoa->list('D',$id_cliente)); 
        $pessoas = $pessoa->list('D',$id_cliente);
      
        /*echo '<pre>';
        echo $pesquisa;
        print_r($pessoas);
        exit;*/

        $this->loadViewInPainel('cadastros_dependenteslist', [
            'clientes' => $pessoas,
            'total' => $total,
            'obCliente' => new Clientes()
        ]);
    }

    public function listarRedeCredenciada()
    {


        $rede = new RedeCredenciadaHandler();

        $limit = 30;
        $total = $rede->getTotal();
        $paginas = ceil($total / $limit);
        $paginaAtual = 1;
        if (!empty($_GET['p'])) {
            $paginaAtual = intval($_GET['p']);
        }

        $offset = ($paginaAtual * $limit) - $limit;

        $redes = $rede->getList($offset, $limit);

        $this->loadViewInPainel('rede_credenciada_list', [
            'redes' => $redes,
            'paginas' => $paginas,
            'paginaAtual' => $paginaAtual,
            'total' => $total
        ]);
    }

    public function listarRedesSite()
    {
        $pesquisa = filter_input(INPUT_GET, 'pesquisa');

        $rede = new RedeCredenciadaHandler();
        $limit = 30;
        $total = $rede->getTotal();
        $paginas = ceil($total / $limit);
        $paginaAtual = 1;
        if (!empty($_GET['p'])) {
            $paginaAtual = intval($_GET['p']);
        }

        $offset = ($paginaAtual * $limit) - $limit;
        if ($pesquisa) {
            $redes = $rede->search($pesquisa);
        } else {
            $redes = $rede->getRedeByDestaque();
        }


        $this->loadViewInTemplate('redeLista', [
            'redes' => $redes,
            'paginas' => $paginas,
            'total' => $total
        ]);
    }

    public function clientesTitular() 
    {
        $p = filter_input(INPUT_GET,'p');
        $pesquisa = filter_input(INPUT_GET,'pesquisa');
        $pessoa = new N_PeopleHandler();

        $limit = 20;

        $total = count($pessoa->list('T','','','')); 

        $paginas = ceil($total/$limit);

        $paginaAtual = 1;
        if($p){
            $paginaAtual = $p;
        }
        
        $offset = ($paginaAtual * $limit) - $limit;
        if($pesquisa) {
            $pag = 0;
            $pessoas = $pessoa->search('T', $pesquisa);
        }else {
            $pag = 1;
            $pessoas = $pessoa->list('T','',$offset, $limit);
        }

        /*echo '<pre>';
        echo $pesquisa;
        print_r($pessoas);
        exit;*/
        

        $this->loadViewInPainel('clientes_list', [
            'clientes' => $pessoas,
            'total' => $total,
            'paginas' => $paginas,
            'paginaAtual' => $paginaAtual,
            'pag' => $pag
        ]);
    }
}
