<?php
class BancosHandler extends model implements iBancos
{
    public function getList()
    {
        $array = [];
        $sql = "SELECT * FROM bancos ORDER BY banco";
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0)
        {
            $list = $sql->fetchAll();
            foreach($list as $item)
            {
                $newBanco = new Bancos();
                $newBanco->setCod($item['cod']);
                $newBanco->setBanco($item['banco']);
                $array[] = $newBanco;
            }
        }
        return $array;
    }
}
interface iBancos
{
    public function getList();
}