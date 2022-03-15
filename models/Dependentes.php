<?php
class Dependentes extends model
{
    public function getDependente($id_Cliente)
    {
        $array = [];
        $sql = "SELECT * FROM clientes WHERE tipo = 2 AND id_indicador = :id_cliente";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $id_Cliente);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $list = $sql->fetchAll();
            foreach ($list as $item) {
                $plano = new Plano();
                $estadocivil = new EstadoCivil();
                $array = $item;
                $array['plano'] = $plano->getPlanoById($item['id_plano']);
                $array['estadoCivil'] = $estadocivil->getEstadoCivilById($item['id_estadocivil']);
            }
        }
        return $array;
    }

    public function valorTotalDependente($id_cliente) {
        
        $itens = $this->getDependente($id_cliente);
        $valor[] = 0;
        foreach($itens as $item) {
            $valor[] = isset($item['plano']['valor'])?$item['plano']['valor']:0;
        }
        return array_sum($valor);

    }
}
