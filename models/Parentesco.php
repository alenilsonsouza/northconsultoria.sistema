<?php
class Parentesco
{
    private $id;
    private $nome;

    public function setId($id)
    {
        $this->id = intval($id);
    }
    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }
}