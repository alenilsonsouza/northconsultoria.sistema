<?php
class TotalParcelas
{
    private $id;
    private $total;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setTotal(int $total)
    {
        $this->total = $total;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTotal()
    {
        return $this->total;
    }

}