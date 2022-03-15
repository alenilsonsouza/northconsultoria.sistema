<?php
class EstadoCivil extends model{

    private $nome;

    public function getEstadoCivil(){
        $array = array();
        $sql = "SELECT * FROM estado_civil ORDER BY nome ASC";
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getEstadoCivilById($id){
        $array = array();
        $sql = "SELECT * FROM estado_civil WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount()>0){
            $array = $sql->fetch();
        }
        return $array;
    }
}