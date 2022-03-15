<?php
class ParentescoHandler extends model implements iParentesco
{
    public function getList()
    {
        $array = [];
        $sql = "SELECT * FROM parentesco";
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0)
        {
            $list = $sql->fetchAll();
            foreach($list as $item)
            {
                $newParentesco = new Parentesco();
                $newParentesco->setId($item['id']);
                $newParentesco->setNome($item['nome']);
                $array[] = $newParentesco;
            }
        }
        return $array;
    }

    public function getById($id)
    {
        $array = [];
        $sql = "SELECT * FROM parentesco WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $item = $sql->fetch();
            $newParentesco = new Parentesco();
            $newParentesco->setId($item['id']);
            $newParentesco->setNome($item['nome']);
            $array = $newParentesco;
            
        }
        return $array;
    }
}
interface iParentesco
{
    public function getList();
    public function getById($id);
    
}