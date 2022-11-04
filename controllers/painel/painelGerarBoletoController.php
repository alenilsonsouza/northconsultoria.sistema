<?php
class painelGerarBoletoController extends controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();

        $u = new Usuarios();
        if (!$u->isLogged()) {
            header("Location: " . BASE_URL . "login");
        }
    }

    public function index()
    {

        header('Location:' . BASE_URL . 'painel');
        exit;
    }

    public function gerarBoleto($id_cliente)
    {

        $flash = '';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $cliente = [];
        $plano = [];
        if (!empty($id_cliente)) {
            $clientes = new Clientes();
            $cliente = $clientes->getClienteById($id_cliente);

            $planos = new Plano();
            $plano = $planos->getPlanoById($cliente['id_plano']);
        } else {
            header('Location:' . BASE_URL . 'painelGerarBoletos');
            exit;
        }



        $this->loadTemplateInPainel('gerarBoleto', [
            'page' => 'gerarboleto',
            'cliente' => $cliente,
            'plano' => $plano,
            'flash' => $flash

        ]);
    }

    public function gerarFaturasBoletoBarato()
    {

        $valor = filter_input(INPUT_POST, 'valor');
        $data_vencimento = filter_input(INPUT_POST, 'data_vencimento');
        $nparcela = filter_input(INPUT_POST, 'nparcela');
        $tparcela = filter_input(INPUT_POST, 'tparcela');
        $id_cliente = filter_input(INPUT_POST, 'id_cliente');

        if ($valor && $data_vencimento && $nparcela && $tparcela && $id_cliente) {

            $valor = str_replace(',','.',$valor);
            $boletoBarato = new BoletoBarato();
            $resposta = $boletoBarato->gerarBoleto($id_cliente, $nparcela, $tparcela, $data_vencimento, $valor);

            if ($resposta == true) {
                header('Location:' . BASE_URL . 'painelcadastros/boletosdocliente/' . md5($id_cliente));
                exit;
            }
            $_SESSION['flash'] = "Desculpe houve uma falha na integração como o sistema de geração de boletos";
            header('Location:'.BASE_URL.'painelGerarBoleto/gerarBoleto/'.md5($id_cliente));
            exit;
        }
    }
}
