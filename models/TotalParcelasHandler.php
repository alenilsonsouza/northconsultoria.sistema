<?php
class TotalParcelasHandler extends model
{
    public function getTotalParcelar()
    {
        $sql = "SELECT total FROM total_parcelas WHERE id = 1";
        $sql = $this->db->query($sql);
        $item = $sql->fetch();
        $parcela = new TotalParcelas();
        $parcela->setTotal($item['total']);
        return $parcela;  
    }
}