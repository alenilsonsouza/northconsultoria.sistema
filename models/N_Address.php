<?php
class N_Address extends model
{

    private $id_people;
    private $cep;
    private $logradouro;
    private $numero = '';
    private $complemento = '';
    private $bairro;
    private $cidade;
    private $estado;

    public function setIdPeople(int $id)
    {
        $this->id_people = $id;
    }
    public function setCep(string $cep)
    {
        $this->cep = $cep;
    }
    public function setLogradouro(string $logradouro)
    {
        $this->logradouro = $logradouro;
    }
    public function setNumero(string $numero)
    {
        $this->numero = $numero;
    }
    public function setComplemento(string $complemento)
    {
        $this->complemento = $complemento;
    }
    public function setBairro(string $bairro)
    {
        $this->bairro = $bairro;
    }
    public function setCidade(string $cidade)
    {
        $this->cidade = $cidade;
    }
    public function setEstado(string $estado)
    {
        $this->estado = $estado;
    }



    public function getIdPeople()
    {
        return $this->id_people;
    }
    public function getCep()
    {
        return $this->cep;
    }
    public function getLogradouro()
    {
        return $this->logradouro;
    }
    public function getNumero()
    {
        return $this->numero;
    }
    public function getComplemento()
    {
        return $this->complemento;
    }
    public function getBairro()
    {
        return $this->bairro;
    }
    public function getCidade()
    {
        return $this->cidade;
    }
    public function getEstado()
    {
        return $this->estado;
    }
}