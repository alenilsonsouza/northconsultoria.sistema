<?php
class ComissoesPagamentoHandler extends model
{
    public function insert(ComissoesPagamento $comissao)
    {
        $sql = "INSERT INTO comissoes_pagamentos (id_cliente, price, paid_date) VALUES (:id_cliente, :price, :paid_date)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_cliente", $comissao->getIdCliente());
        $sql->bindValue(':price', $comissao->getPrice());
        $sql->bindValue(':paid_date', $comissao->getDate());
        $sql->execute();
    }
    public function update(ComissoesPagamento $comissao)
    {
        $sql = "UPDATE comissoes_pagamentos SET price = :price, paid_date = paid_date WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':price', $comissao->getPrice());
        $sql->bindValue(':paid_date', $comissao->getDate());
        $sql->bindValue(":id", $comissao->getId());
        $sql->execute();
    }
    public function getById($id)
    {
        $array = [];
        $sql = "SELECT * FROM comissoes_pagamentos WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $item = $sql->fetch();
            $array = $this->montarObj($item);
        }
        return $array;
    }
    public function getComissoes($offset, $limit)
    {
        $array = [];
        $sql = "SELECT * FROM comissoes_pagamentos ORDER BY id ASC LIMIT $offset, $limit";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll();
            foreach ($list as $item) {
                $array[] = $this->montarObj($item);
            }
        }
        return $array;
    }
    public function getTotal()
    {
        $sql = "SELECT COUNT(*) as t FROM comissoes_pagamentos";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        return $sql['t'];
    }
    public function getByIdCliente($id_cliente, $offset, $limit)
    {
        $array = [];
        $sql = "SELECT * FROM comissoes_pagamentos WHERE id_cliente = :id_cliente ORDER BY id ASC LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_cliente", $id_cliente);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll();
            foreach ($list as $item) {
                $array[] = $this->montarObj($item);
            }
        }
        return $array;
    }
    public function getTotalByIdcliente($id_cliente)
    {
        $sql = "SELECT COUNT(*) as t FROM comissoes_pagamentos WHERE id_cliente = :id_cliente";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $id_cliente);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['t'];
    }

    public function SeFoiPagoNoMes($id_cliente, $mes)
    {
        $sql = "SELECT * FROM comissoes_pagamentos WHERE id_cliente = :id_cliente AND MONTH(paid_date) = :mes";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_cliente", $id_cliente);
        $sql->bindValue(":mes", $mes);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function pagosNoMes($mes, $ano, $offset, $limit) 
    {
        $array = [];
        $sql = "SELECT * FROM comissoes_pagamentos WHERE MONTH(paid_date) = :mes AND YEAR(paid_date) = :ano ORDER BY id DESC LIMIT $offset, $limit";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":mes", $mes);
        $sql->bindValue(":ano", $ano);
        $sql->execute();
        if($sql->rowCount()>0) {
            $list = $sql->fetchAll();
            foreach($list as $item) {
                $array[] = $this->montarObj($item);
            }
        }
        return $array;
    }

    public function totalPagoNoMes($mes, $ano)
    {
        $sql = "SELECT COUNT(*) AS t FROM comissoes_pagamentos WHERE MONTH(paid_date) = :mes AND YEAR(paid_date) = :ano";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":mes", $mes);
        $sql->bindValue(":ano", $ano);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['t'];
    }
    private function montarObj($item)
    {   
        $clientes = new Clientes();
        $newComissao = new ComissoesPagamento();
        $newComissao->setId($item['id']);
        $newComissao->setIdCliente($item['id_cliente']);
        $newComissao->setPrice($item['price']);
        $newComissao->setDate($item['paid_date']);
        $newComissao->setCliente($clientes->getClienteById(md5($item['id_cliente'])));
        return $newComissao;
    }
}

interface iComissoesPagamento
{
    public function insert(ComissoesPagamento $comissao);
    public function update(ComissoesPagamento $comissao);
    public function getById($id);
    public function getComissoes($offset, $limit);
    public function getTotal();
    public function getByIdCliente($id_cliente, $offset, $limit);
    public function getTotalByIdcliente($id_cliente);
}
