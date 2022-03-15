<?php
class ComissoesPagamento 
{
    private $id;
    private $id_cliente;
    private $price;
    private $date;
    private $cliente;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setIdCliente(int $id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }
    public function setPrice(float $price)
    {
        $this->price = $price;
    }
    public function setDate(string $date)
    {
        $this->date = $date;
    }
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getId():int
    {
        return $this->id;
    }
    public function getIdCliente():int
    {
        return $this->id_cliente;
    }
    public function getPrice():float
    {
        return $this->price;
    }
    public function getDate():string
    {
        return $this->date;
    }
    public function getCliente()
    {
        return $this->cliente;
    }
}