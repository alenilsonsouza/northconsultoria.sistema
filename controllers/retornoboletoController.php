<?php
class retornoboletoController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
        $jd = $_POST;

        $array = [];

        // DECIDE O SCRIPT QUE VAI PROCESSAR O PEDIDO

        if($jd['tipo'] == 'boleto.status'){ 

            $f = new Faturamento();

            $jd = $jd['dados'];

            $m = new Moeda();
            $m->setValorFloat($jd['valorpago']);
            $valor = $m->getValor();

            $data = $jd['datapagamento'];
            $data = explode('/', $data);
            $datapagemento = $data[2].'-'.$data[1].'-'.$data[0];

            $f->atualizarStatusBB($jd['status'], $valor, $datapagemento, $jd['meucodigo']);

            // Para verificação de resposta
            $array = [
                'error' => 0,
                'status' => $jd['status'],
                'code' => $jd['meucodigo'],
                'valor Pago' => $jd['valorpago'],
                'Data Pagamento' => $jd['datapagamento']
            ];

        }else{

            $array = [
                'error' => 0,
                'status' => 'Nenhuma Dado enviado!'
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($array);
        exit;
        
    }

}