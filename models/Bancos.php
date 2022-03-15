<?php
class Bancos
{
    private $cod;
    private $banco;

    public function setCod(int $cod)
    {
        $this->cod = $cod;
    }

    public function setBanco(string $banco)
    {
        $this->banco = strtoupper($banco);
    }

    public function getCod()
    {
        return $this->cod;
    }

    public function getBanco()
    {
        return $this->banco;
    }
}