<?php
/**
 * Motor de funcionalidade para Venda Direta no sistema
 */
class NegocioVendaDireta extends model
{
    public function ListIndicator($id_cliente, $offset, $limit)
    {
        $array = [];
        $sql = "SELECT * FROM clientes WHERE id_indicador = :id_indicador ORDER BY id_cliente DESC";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_indicador", $id_cliente);
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $list = $sql->fetchAll(PDO::FETCH_ASSOC);
            $mes = date("m");
            $ano = date('Y');
            foreach($list as $key => $item) 
			{
				$plano = new Plano();
				$estadocivil = new EstadoCivil();
                $negocio = new NegocioHandler();
                $faturamento = new Faturamento();
				$array[] = $item;
				$array[$key]['plano'] = $plano->getPlanoById($item['id_plano']); 
				$array[$key]['estadoCivil'] = $estadocivil->getEstadoCivilById($item['id_estadocivil']);
                $array[$key]['negocio'] = $negocio->getNegocioById($item['id_negocio']);
                // Resposta pode ser mais de uma - O indicado pode pagar uma atrasa junto com o mês atual
                $array[$key]['pagamentos'] = $faturamento->getFaturamentoPaidMonthByCliente($item['id_cliente'], $mes, $ano); 
                $pagamentosCompensados = count($array[$key]['pagamentos']);
                // Cálculo Da comissão
                $array[$key]['comissao'] = $array[$key]['plano']['comissao'] * $pagamentosCompensados;
                $array[$key]['tipoCliente'] = $this->getTipoCliente($item);
            }
            
        }
        return $array;
    }

    public function ListTotal($id_indicador)
    {
        $sql = "SELECT COUNT(*) as t FROM clientes WHERE id_indicador = :id_indicador";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_indicador', $id_indicador);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['t'];
    }

    private function getTipoCliente($cliente) {
        if(!empty($cliente['id_indicador']) && !empty($cliente['parentesco'])) {
            return 'Dependente';
        }elseif(empty($cliente['id_indicador']) && empty($cliente['parentesco'])) {
            return 'Vandedor';
        }else{
            return 'Titular';
        }
    }
}