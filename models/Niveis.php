<?php 
/**
 * @author Alenilson Souza <alenilson@aleevolucoes.com.br>
 * @copyright 2020
 */
class Niveis extends model{
    private $nivel;
    private $valor_comissao;

    public function setNivel($nivel){
        if(filter_var($nivel, FILTER_VALIDATE_INT)){
            $this->nivel = $nivel;
        }
    }

    public function setValorComissao($valor){
        if(filter_var($valor, FILTER_VALIDATE_FLOAT)){
            $this->valor_comissao = $valor;
        }
    }

    public function verifyNivel($nivel){
        $sql = "SELECT * FROM niveis WHERE nivel = :nivel";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nivel", $nivel);
        $sql->execute();
        if($sql->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }

    public function salvar($id=''){
        if(!empty($id)){
            $sql = "UPDATE niveis SET valor_comissao = :valor_comissao WHERE MD5(id) = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':valor_comissao', $this->valor_comissao);
            $sql->bindValue(':id', $id);
            $sql->execute();
        }else{
            $sql = "INSERT INTO niveis (nivel, valor_comissao) VALUES (:nivel, :valor_comissao)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(':nivel', $this->nivel);
            $sql->bindValue(':valor_comissao', $this->valor_comissao);
            $sql->execute();
        }
    }

    public function getNiveis(){
        $array = array();
        $sql = "SELECT * FROM niveis ORDER BY nivel ASC";
        $sql = $this->db->query($sql);
        if($sql->rowCount()>0){
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function getNivelById($id){
        $array = array();
        $sql = "SELECT * FROM niveis WHERE MD5(id) = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount()>0){
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function getNivelByNivel($nivel){
        $array = array();
        $sql = "SELECT * FROM niveis WHERE nivel = :nivel";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nivel", $nivel);
        $sql->execute();
        if($sql->rowCount()>0){
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function getTotal(){
        $sql = "SELECT COUNT(*) as t FROM niveis";
        $sql = $this->db->query($sql);
        $sql = $sql->fetch();
        return $sql['t'];
    }

    public function excluir($id){
        $sql = "DELETE FROM niveis WHERE MD5(id) = :id"; 
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}