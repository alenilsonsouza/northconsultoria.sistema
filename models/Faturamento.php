<?php 
class Faturamento extends model{
    private $id_faturamento;
    private $id_cliente;
    private $id_forma_pagamento;
    private $id_parcelamento;
    private $id_negocio;
    private $data_pagamento;
    private $data_vencimento;
    private $situacao;
    private $nparcela;
    private $tparcela;
    private $valor;
    private $tipo;
    private $mora;
    private $multa;
    private $descricao;
    private $array;
    private $a_receber;
    private $confirmados;
    private $vencidas;
    private $idboleto; 

    public function __construct($id = '')
    {
        parent:: __construct();

        if (!empty($id))
    {
            $this->array = array();
            $sql = "SELECT * FROM faturamento LEFT JOIN clientes ON faturamento.id_cliente = clientes.id_cliente LEFT JOIN forma_pagamento ON faturamento.id_forma_pagamento = forma_pagamento.id_forma_pagamento WHERE MD5(faturamento.id_faturamento) = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
            if ($sql->rowCount()>0)
    {
                $this->array = $sql->fetch(); 
            }
        }


    }

    public function setIdCliente($id)
    {
        if (filter_var($id, FILTER_VALIDATE_INT))
    {
            $this->id_cliente = $id;
        }
    }
    public function setIdFormaPagamento($id)
    {
        if (filter_var($id, FILTER_VALIDATE_INT))
    {
            $this->id_forma_pagamento = $id;
        }
    }
    public function setIdParcelamento($id)
    {
        if (filter_var($id, FILTER_VALIDATE_INT))
    {
            $this->id_parcelamento = $id;
        }
    }

    public function setIdNegocio($id)
    {
        if (filter_var($id, FILTER_VALIDATE_INT))
    {
            $this->id_negocio = $id;
        }
    }

    public function setDataPagamento($data)
    {
        $this->data_pagamento = $data;
    }
    public function setDataVencimento($data)
    {
        $this->data_vencimento = $data;
    }

    public function setSituacao($n)
    {
        if (filter_var($n, FILTER_VALIDATE_INT))
    {
            $this->situacao = $n;
        }
    }

    public function setNParcela($n)
    {
        if (filter_var($n, FILTER_VALIDATE_INT))
    {
            $this->nparcela = $n;
        }
    }
    public function setTParcela($n)
    {
        if (filter_var($n, FILTER_VALIDATE_INT))
    {
            $this->tparcela = $n;
        }
    }
    public function setValor($valor)
    {
        if (filter_var($valor, FILTER_VALIDATE_FLOAT))
    {
            $this->valor = $valor;
        }
    }
    public function setTipo($tipo)
    {
        if (filter_var($tipo, FILTER_VALIDATE_INT))
    {
            $this->tipo = $tipo;
        }
    }
    public function setMora($mora)
    {
        if (filter_var($mora, FILTER_VALIDATE_FLOAT))
    {
            $this->mora = $mora;
        }
    }
    public function setMulta($multa)
    {
        if (filter_var($multa, FILTER_VALIDATE_FLOAT))
    {
            $this->multa = $multa;
        }
    }
    public function setDescricao($texto)
    {
        if (filter_var($texto, FILTER_SANITIZE_STRING))
    {
            $this->descricao = $texto;
        }

    }
    public function setIdBoleto($idboleto)
    {
        if (filter_var($idboleto, FILTER_VALIDATE_INT))
    {
            $this->idboleto = $idboleto;
        }
    }


    public function getArray()
    {
        return $this->array;
    }
    public function getAReceber()
    {
        return $this->a_receber;
    }
    public function getConfirmados()
    {
        return $this->confirmados;
    }
    public function getVencidas()
    {
        return $this->vencidas;
    }

    public function totalMesAtual()
    {
        $mes = date('m');
        $ano = date("Y");
        $sql = "SELECT COUNT(*) as t FROM faturamento WHERE MONTH(data_vencimento) = $mes AND YEAR(data_vencimento) = $ano";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        return $sql['t'];
    }
    public function getFaturmantodoMes($offset, $limit, $ano, $mes)
    {

        
        $array = array();
        $sql = "SELECT * FROM faturamento 
        LEFT JOIN clientes ON faturamento.id_cliente = clientes.id_cliente 
        LEFT JOIN forma_pagamento ON faturamento.id_forma_pagamento = forma_pagamento.id_forma_pagamento 
        WHERE MONTH(data_vencimento) = $mes AND YEAR(data_vencimento) = $ano 
        ORDER BY data_vencimento DESC LIMIT $offset,$limit";
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0)
    {
            $negocio = new Negocio();
            foreach($sql->fetchAll() as $key => $item)
    {
                $array[] = $item;
                $array[$key]['negocio'] = $negocio->getNegociacaoById(md5($item['id_negocio']));
            }
        }

        //Confirmadas
        $sql = "SELECT SUM(valor) as total FROM faturamento 
        WHERE MONTH(data_vencimento) = $mes AND YEAR(data_vencimento) = $ano AND data_pagamento > 0
        LIMIT $offset,$limit";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();

        $this->confirmados = $sql['total'];

        //A receber
        $sql = "SELECT SUM(valor) as total FROM faturamento 
        WHERE MONTH(data_vencimento) = $mes AND YEAR(data_vencimento) = $ano AND data_pagamento is NULL
        LIMIT $offset,$limit";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();

        $this->a_receber = $sql['total'];

        //Vencidas
        $sql = "SELECT SUM(valor) as total FROM faturamento 
        WHERE MONTH(data_vencimento) = $mes AND YEAR(data_vencimento) = $ano AND data_vencimento < NOW() AND data_pagamento is NULL
        LIMIT $offset,$limit";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();

        $this->vencidas = $sql['total'];

        return $array;
    }

    public function pesquisaFaturamento($texto)
    {
        $array = array();
        $sql = "SELECT * FROM faturamento 
        LEFT JOIN clientes ON faturamento.id_cliente = clientes.id_cliente 
        LEFT JOIN forma_pagamento ON faturamento.id_forma_pagamento = forma_pagamento.id_forma_pagamento 
        WHERE clientes.nome_cliente LIKE :nome 
        ORDER BY data_vencimento DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome", '%'.$texto.'%');
        $sql->execute();
        if($sql->rowCount()>0)
    {
            $array = $sql->fetchAll();
        }
        return $array;

    }

    public function getFaturamentoData($data_inicio, $data_fim)
    {
        $array = array();
        $sql = "SELECT * FROM faturamento 
        LEFT JOIN clientes ON faturamento.id_cliente = clientes.id_cliente 
        LEFT JOIN forma_pagamento ON faturamento.id_forma_pagamento = forma_pagamento.id_forma_pagamento 
        WHERE data_vencimento >= :data_inicio AND data_vencimento <= :data_fim 
        ORDER BY data_vencimento DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":data_inicio", $data_inicio);
        $sql->bindValue(":data_fim", $data_fim);
        $sql->execute();
        if($sql->rowCount()>0)
    {
            $array = $sql->fetchAll();
        }

        //Confirmados
        $sql = "SELECT SUM(valor) as total FROM faturamento 
        WHERE data_vencimento >= :data_inicio AND data_vencimento <= :data_fim AND data_pagamento > 0";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":data_inicio", $data_inicio);
        $sql->bindValue(":data_fim", $data_fim);
        $sql->execute();
        $sql = $sql->fetch();

        $this->confirmados = $sql['total'];

        //A receber
        $sql = "SELECT SUM(valor) as total FROM faturamento 
        WHERE data_vencimento >= :data_inicio AND data_vencimento <= :data_fim AND data_pagamento is NULL";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":data_inicio", $data_inicio);
        $sql->bindValue(":data_fim", $data_fim);
        $sql->execute();
        $sql = $sql->fetch();

        $this->a_receber = $sql['total'];

        //Vencidas
        $sql = "SELECT SUM(valor) as total FROM faturamento 
        WHERE data_vencimento >= :data_inicio AND data_vencimento <= :data_fim AND data_vencimento < NOW() AND data_pagamento is NULL";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":data_inicio", $data_inicio);
        $sql->bindValue(":data_fim", $data_fim);
        $sql->execute();
        $sql = $sql->fetch();

        $this->vencidas = $sql['total'];

        return $array;
    }

    public function salvar($id = '')
    {
        if (!empty($id))
    {
            $sql = "UPDATE faturamento SET id_forma_pagamento = :id_forma_pagamento, data_vencimento = :data_vencimento, valor = :valor, descricao = :descricao WHERE MD5(id_faturamento) = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':id_forma_pagamento', $this->id_forma_pagamento);
            $sql->bindValue(":data_vencimento", $this->data_vencimento);
            $sql->bindValue(":valor", $this->valor);
            $sql->bindValue(":descricao", $this->descricao);
            $sql->bindValue(":id", $id);
            $sql->execute();

        }else{
            $sql = "INSERT INTO faturamento (id_cliente, id_forma_pagamento, id_parcelamento, id_negocio, data_vencimento, situacao, nparcela, tparcela, valor, tipo, mora, multa, descricao) VALUES (:id_cliente, :id_forma_pagamento, :id_parcelamento, :id_negocio, :data_vencimento, :situacao, :nparcela, :tparcela, :valor, :tipo, :mora, :multa, :descricao)";

            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id_cliente", $this->id_cliente);
            $sql->bindValue(":id_forma_pagamento", $this->id_forma_pagamento);
            $sql->bindValue(":id_parcelamento", $this->id_parcelamento);
            $sql->bindValue(":id_negocio", $this->id_negocio);
            $sql->bindValue(":data_vencimento", $this->data_vencimento);
            $sql->bindValue(":situacao", $this->situacao);
            $sql->bindValue(":nparcela", $this->nparcela);
            $sql->bindValue(":tparcela", $this->tparcela);
            $sql->bindValue(":valor", $this->valor);
            $sql->bindValue(":tipo", $this->tipo);
            $sql->bindValue(":mora", $this->mora);
            $sql->bindValue(":multa", $this->multa);
            $sql->bindValue(":descricao", $this->descricao);
            $sql->execute();

            $id = $this->db->lastInsertId();
            return $id;
        }
    }

    public function status($data_vencimento)
    {
        $hoje = date("Y-m-d");
        
        if(strtotime($data_vencimento) > strtotime($hoje))
        { 
            return '<span class="a_vencer">À vencer</span>';
        }elseif (strtotime($data_vencimento) === strtotime($hoje))
        {
            return '<span class="vence_hoje">Vence hoje</span>';
        }elseif (strtotime($data_vencimento) < strtotime($hoje))
        {
            return '<span class="vencida">Vencida</span>';
        }
        
    }

    public function atualizarStatusBB($status, $valor_pago, $datapagemtno, $codigo)
    {

        $datapagemtno = date('Y-m-d', strtotime($datapagemtno));

        $sql = "UPDATE faturamento SET status_boleto = :status_boleto, valor_pago = :valor_pago, data_pagamento = :data_pagamento WHERE id_faturamento = :codigo";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":status_boleto", $status);
        $sql->bindValue(":valor_pago", $valor_pago);
        $sql->bindValue(":data_pagamento", $datapagemtno);
        $sql->bindValue(":codigo", $codigo);
        $sql->execute();

    
    }

    public function atualizarPagamento($data_pagamento, $id_faturamento)
    {

        $sql = "UPDATE faturamento SET data_pagamento = :data_pagamento WHERE MD5(id_faturamento) = :id_faturamento";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":data_pagamento", $data_pagamento);
        $sql->bindValue(":id_faturamento", $id_faturamento); 
        $sql->execute();
    }

    public function excluir($id)
    {
        
        $sql = "DELETE FROM faturamento WHERE MD5(id_faturamento) = :id"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getFaturamento($offset=0, $limit=30)
    {
        $array = array();
        $sql = "SELECT * FROM faturamento ORDER BY id_faturamento ASC LIMIT $offset, $limit"; 
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0)
        {
            $lista = $sql->fetchAll();
            foreach($lista as $key => $item)
            {
                $cliente = new Clientes();
                $array[] = $item;
                $array[$key]['situacao'] = $this->verifySituation($item['data_vencimento'], $item['data_pagamento']);
                $array[$key]['cliente'] = $cliente->getClienteById(md5($item['id_cliente']));
            }
            
        }
        return $array;
    }
    public function getFaturamentoTotal()
    {
        $sql = "SELECT COUNT(*) as t FROM faturamento";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        return $sql['t']; 
    }

    public function getFaturamentoByIdCliente($id_cliente, $offset=0, $limit=30)
    {
        $array = array();
        $sql = "SELECT * FROM faturamento  WHERE MD5(id_cliente) = :id ORDER BY id_faturamento ASC LIMIT $offset, $limit"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_cliente);
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $lista = $sql->fetchAll();
            foreach($lista as $key => $item)
            {
                //Verificação da Situação do boleto
                $array[] = $item;
                $array[$key]['situacao'] = $this->verifySituation($item['data_vencimento'], $item['data_pagamento']);
            }
            
        }
        return $array;
    }

    public function getFaturamentoTotalByIdCliente($id_cliente)
    {
        $sql = "SELECT COUNT(*) as t FROM faturamento  WHERE MD5(id_cliente) = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id',$id_cliente);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['t']; 
    }
    private function verifySituation($data_vencimento, $data_pagamento)
    {

        $retorno = "Á vencer";
        $class = "blue";
        $hoje = date('Y-m-d');
        if($data_vencimento == $hoje)
        {
            $class = "gray";
            $retorno = 'Vence hoje';
        }
        if($data_vencimento < $hoje)
        {
            $class = "red";
            $retorno = 'VENCIDA';
        }
        if(!empty($data_pagamento))
        {   
            $class = "green";
            $retorno = "PAGO";
        }
        return '<span class="btn" style="background-color:'.$class.'">'.strtoupper($retorno).'</span>';
    }

    public function totalPago($id_cliente)
    {
        $sql = "SELECT SUM(valor_pago) as total FROM faturamento WHERE data_pagamento > 0 AND MD5(id_cliente) = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_cliente);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['total'];
    }

    public function Inadimplidas($id_cliente)
    {

        $sql = "";
        $sql = $this->db->prepare($sql);

        
    }

    public function totalAPaga($id_cliente)
    {
        $sql = "SELECT SUM(valor) as total FROM faturamento WHERE data_pagamento is NULL AND MD5(id_cliente) = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_cliente);
        $sql->execute();
        $sql = $sql->fetch();
        return  $sql['total'];
    }

    public function parcelasPagas($id_cliente)
    {
        $sql = "SELECT COUNT(*) as total FROM faturamento WHERE data_pagamento > 0 AND MD5(id_cliente) = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_cliente);
        $sql->execute();
        $sql = $sql->fetch();
        return  $sql['total'];
    }

    public function parcelasAPagas($id_cliente)
    {
        $sql = "SELECT COUNT(*) as total FROM faturamento WHERE data_pagamento is NULL AND MD5(id_cliente) = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id_cliente);
        $sql->execute();
        $sql = $sql->fetch();
        return  $sql['total'];
    }

    public function parcelasInadimplidas($id_cliente)
    {
        $sql = "SELECT COUNT(*) AS t FROM faturamento WHERE data_pagamento is NULL AND data_vencimento < :hoje AND MD5(id_cliente) = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":hoje", date('Y-m-d'));
        $sql->bindValue(":id", $id_cliente);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['t'];
    }

    public function getFaturamentoByMonth($month='') {
        $mes = date('m');
        if(!empty($month)) {
            $mes = $month;
        }
        $sql = "SELECT SUM(valor_pago) as tvalor, COUNT(*) as tqtd FROM faturamento WHERE MONTH(data_pagamento) = :mes";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':mes', $mes);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql;

    }

    public function getFaturamentoById($id) {
        $array = [];
        $sql = "SELECT * FROM faturamento WHERE id_faturamento = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount()>0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function delFaturamentoById($id) {
        $sql = "DELETE FROM faturamento WHERE id_faturamento = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

    }

    /**
     * Pegar valores do mes atual do cliente de acordo com o vencimento
     */
    public function getFaturamentoMonthByCliente($id_cliente, $mes) {
        $array = [];
        $sql = "SELECT * FROM faturamento WHERE MONTH(data_vencimento) = :mes AND id_cliente = :id_cliente";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $id_cliente);
        $sql->bindValue(':mes',$mes);
        $sql->execute();
        if($sql->rowCount()>0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    /**
     * Pegar informações de faturamento de acordo com as fatura pagas dentro do mês selecionado
     */
    public function getFaturamentoPaidMonthByCliente($id_cliente, $mes , $ano) {
        $array = [];
        $sql = "SELECT * FROM faturamento WHERE MONTH(data_pagamento) = :mes AND YEAR(data_pagamento) = :ano AND id_cliente = :id_cliente";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':ano',$ano);
        $sql->bindValue(':mes',$mes);
        $sql->bindValue(':id_cliente', $id_cliente);
        $sql->execute();
        if($sql->rowCount()>0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function pegarTotalDeBoletosPorCliente($id_cliente) {

        $sql = "CALL sp_boletos_registro(:id_cliente)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_cliente", $id_cliente);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql;
    }
    
}