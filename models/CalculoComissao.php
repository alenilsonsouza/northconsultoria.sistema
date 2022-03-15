<?php
class CalculoComissao extends model
{
    //Comissão 50% Primeira parcela
    public function comissao50($id_cliente, $mes)
    {
        //Seleciona todos os ids do filhos
      
        $valor[] = 0;
        $sql = "SELECT id_cliente FROM clientes WHERE id_indicador = :id_cliente";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $id_cliente);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll();
            foreach($list as $item) {
                $valor[] = $this->valorParcelaMesAtual($item['id_cliente'], $mes);
            }
        }
        $soma = array_sum($valor);
        return $soma;
    }

    //Comissão Vitalício
    public function comissaoVitalicio($id_cliente, $mes)
    {
        $valor[] = 0;
        $sql = "SELECT id_cliente, id_plano FROM clientes WHERE id_indicador = :id_cliente";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $id_cliente);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll();
            foreach($list as $item) {
                $parcela = $this->pegarParcelaPagaMesAtual($item['id_cliente'], $mes);
                $valor[] = $this->valorComissaoPlano($item['id_plano'], $parcela);
            }
        }
        return array_sum($valor);
    }

    private function pegarParcelaPagaMesAtual($id_cliente, $mes)
    {
        $sql = "SELECT SUM(valor) as total FROM faturamento WHERE id_cliente = :id_cliente AND MONTH(data_pagamento) = :mes AND nparcela = 1";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $id_cliente);
        $sql->bindValue(':mes', $mes);
        $sql->execute();
        $item = $sql->fetch();
        $total = $item['total'];
        
        
        return $total;
    }

    private function valorComissaoPlano($id_plano, $parcela)
    {
        $valor = 0;
        $sql = "SELECT comissao, tipo_comissao FROM plano WHERE id = :id_plano";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_plano', $id_plano);
        $sql->execute();
        if($sql->rowCount()>0) {
            $item = $sql->fetch();
            $tipo_comissao = $item['tipo_comissao'];
            if($tipo_comissao == "R") {
                $valor = $item['comissao'];
            }elseif($tipo_comissao == "P") {
                $valor = ($parcela * $item['comissao'])/100;
            }else{
                $valor = 0;
            }
        }
        return $valor;
    }

    private function valorParcelaMesAtual($id_cliente, $mes)
    {
      
        $total = 0;
        //Seleciona o valor e depois calcula 50% de cada fataura do mes atual da primeira parcela
        $sql = "SELECT (SUM(valor) / 2) as total FROM faturamento WHERE id_cliente = :id_cliente AND MONTH(data_pagamento) = :mes AND nparcela = 1";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $id_cliente);
        $sql->bindValue(':mes', $mes);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $total = $item['total'];
           
        }
        
        return $total;
    }
}
