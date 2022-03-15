<?php
class PlanoBeneficios{

    private $id;
    private $id_plano;
    private $beneficio;

    public function getId()
    {
        return $this->id;
    }
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getIdPlano()
    {
        return $this->id_plano;
    }
    public function setIdPlano(int $id_plano)
    {
        $this->id_plano = $id_plano;
    }

    public function getBeneficio()
    {
        return $this->beneficio;
    }
    public function setBeneficio(string $beneficio)
    {
        $this->beneficio = $beneficio;
    }
}