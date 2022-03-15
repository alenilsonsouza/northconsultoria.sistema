<?php
class PlanoBeneficiosHandler extends model implements InterfaceBeneficios
{
    public function insert(PlanoBeneficios $b)
    {
        $sql = "INSERT INTO plano_beneficios (id_plano, beneficio) VALUES (:id_plano, :beneficio)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_plano', $b->getIdPlano());
        $sql->bindValue(':beneficio', $b->getBeneficio());
        $sql->execute();
    }
    public function atualizar(PlanoBeneficios $b)
    {
        $sql = "UPDATE plano_beneficios SET beneficio = :beneficio WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':beneficio', $b->getBeneficio());
        $sql->bindValue(':id', $b->getId());
        $sql->execute();
    }
    public function pegarPorIdPlano($id_plano)
    {
        $array = [];
        $sql = "SELECT * FROM plano_beneficios WHERE id_plano = :id_plano";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_plano', $id_plano);
        $sql->execute();
        if($sql->rowCount()>0){
            $list = $sql->fetchAll();
            foreach($list as $item)
            {
                $newPlanoBeneficio = new PlanoBeneficios();
                $newPlanoBeneficio->setId($item['id']);
                $newPlanoBeneficio->setIdPlano($item['id_plano']);
                $newPlanoBeneficio->setBeneficio($item['beneficio']);
                $array[] = $newPlanoBeneficio;
            }
        }
        return $array;
    }
    public function pegarPorId($id)
    {
        $array = [];
        $sql = "SELECT * FROM plano_beneficios WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if($sql->rowCount()>0){
            $item = $sql->fetch();
            
            $newPlanoBeneficio = new PlanoBeneficios();
            $newPlanoBeneficio->setId($item['id']);
            $newPlanoBeneficio->setIdPlano($item['id_plano']);
            $newPlanoBeneficio->setBeneficio($item['beneficio']);
            $array = $newPlanoBeneficio;
            
        }
        return $array;
    }
    public function excluirPorId($id)
    {
        $sql = "DELETE FROM plano_beneficios WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
interface InterfaceBeneficios
{
    public function insert(PlanoBeneficios $b);
    public function atualizar(PlanoBeneficios $b);
    public function pegarPorIdPlano($id_plano);
    public function pegarPorId($id);
    public function excluirPorId($id);
}