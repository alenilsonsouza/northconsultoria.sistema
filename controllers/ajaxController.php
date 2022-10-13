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

    public function relatoriovendas() {
        
        $costumer = filter_input(INPUT_GET, 'costumer');
        $startDate = filter_input(INPUT_GET, 'startDate');
        $finalDate = filter_input(INPUT_GET, 'finalDate');

        if($costumer && $startDate && $finalDate) {

            $people = new N_PeopleHandler();
            $clientes = $people->listClientByConstumer($costumer, $startDate, $finalDate);

            $this->loadViewInPainel('cadastros_listClients', [
                'clientes' => $clientes
            ]);
        }
    }

    public function cadastroList()
    {
        $p = filter_input(INPUT_GET, 'pagina');
        $pesquisa = filter_input(INPUT_GET, 'pesquisa');
        $pessoa = new N_PeopleHandler();

        $limit = 20;
        $total = count($pessoa->list('T', '', '', ''));
        $paginas = ceil($total / $limit);

        $paginaAtual = 1;
        if ($p) {
            $paginaAtual = $p;
        }

        $offset = ($paginaAtual * $limit) - $limit;
        if ($pesquisa) {
            $pag = 0;
            $pessoas = $pessoa->search('C', $pesquisa);
        } else {
            $pag = 1;
            $pessoas = $pessoa->list('C', '', $offset, $limit);
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
            
            $people = new N_PeopleHandler();
            $clientes = $people->listIndicateds($id_cliente);
        } 

        $this->loadViewInPainel('cadastros_listIndicators', [
            'clientes' => $clientes
        ]);
    }

    public function cadastroListDepententes()
    {

        $id_cliente = filter_input(INPUT_GET, 'id_cliente');
        $pessoa = new N_PeopleHandler();
        $total = count($pessoa->list('D', $id_cliente));
        $pessoas = $pessoa->list('D', $id_cliente);

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
        $pesquisa = filter_input(INPUT_GET, 's');

        $rede = new RedeCredenciadaHandler();
        if ($pesquisa) {
            $redes = $rede->search($pesquisa);
        } 

        $this->loadViewInTemplate('redeLista', [
            'redes' => $redes
        ]);
    }

    public function listarTodosRedesSite()
    {

        $rede =  new RedeCredenciadaHandler();
        $redes = $rede->getListAll(); 

        $this->loadViewInTemplate('redeLista', [
            'redes' => $redes
        ]);
    }

    public function clientesTitular()
    {
        $p = filter_input(INPUT_GET, 'p');
        $pesquisa = filter_input(INPUT_GET, 'pesquisa');
        $pessoa = new N_PeopleHandler();

        $limit = 20;

        $total = count($pessoa->list('T', '', '', ''));

        $paginas = ceil($total / $limit);

        $paginaAtual = 1;
        if ($p) {
            $paginaAtual = $p;
        }

        $offset = ($paginaAtual * $limit) - $limit;
        if ($pesquisa) {
            $pag = 0;
            $pessoas = $pessoa->search('T', $pesquisa);
        } else {
            $pag = 1;
            $pessoas = $pessoa->list('T', '', $offset, $limit);
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

    /**
     * @param int
     * @return json
     */
    public function sendToConfirmTerm($id)
    {
        $array = ['erro' => ''];
        $people = new N_PeopleHandler();
        $item = $people->listOne($id, false);

        if (isset($item['name'])) {
            $e = new Email();
            $e->setNome($item['name']);
            $e->setEmail($item['email']);
            $e->setAssunto('Termos de aceite');
            $e->setLink(BASE_URL . 'adesaotermo/client/' . md5($item['id']));
            $e->sendLinkTermToClient();
            $array = [
                'name' => $item['name'],
                'email' => $item['email']
            ];
        } else {
            $array = ['erro' => 'Cliente inexistente!'];
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($array,JSON_FORCE_OBJECT);
    }
}
