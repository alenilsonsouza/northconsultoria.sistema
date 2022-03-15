<?php
class NegocioHandler extends model implements iNegocio
{
    public function getNegocioById($id)
    {
        $array = [];
        $sql = "SELECT * FROM negocio WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $item = $sql->fetch();
            $newNegocio = new Negocio();
            $newNegocio->setId($item['id']);
            $newNegocio->setName($item['name']);
            $array = $newNegocio;
        }
        return $array;
    }
    public function getList()
    {
        $array = [];
        $sql = "SELECT * FROM negocio ORDER BY id ASC";
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0)
        {
            $list = $sql->fetch();
            foreach($list as $item)
            {
                $newNegocio = new Negocio();
                $newNegocio->setId($item['id']);
                $newNegocio->setName($item['name']);
                $array[] = $newNegocio;
            }
            
        }
        return $array;
    }
    /**
     * Verificação do tipo de Negócio para execução de cálculo
     * na soma dos valores de comissão
     */
    public function verifyNegocio($id_negocio, $id_cliente)
    {
        switch($id_negocio)
        {
            case 1:
                $n = new NegocioVendaDireta();
                $retorno = $n->ListIndicator($id_cliente);
            break;
            case 2:
                //Para o recurso multinível
            break;
            default:
                $n = new NegocioVendaDireta();
                $retorno = $n->ListIndicator($id_cliente);
        }
        return $retorno;
    }
}
interface iNegocio
{
    public function getNegocioById($id);
    public function getList();
    public function verifyNegocio($id_negocio, $id_cliente);
 
}