<?php
class RedeCredenciada
{
    private $id;
    private $nome;
    private $cidade;
    private $desconto;
    private $telefone;
    private $logo;
    private $destaque;
    private $arquivo;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setNome(string $nome)
    {
        $this->nome = strtoupper($nome);
    }
    public function setcidade(string $cidade)
    {
        $this->cidade = strtoupper($cidade);
    }
    public function setDesconto(string $desconto)
    {
        $this->desconto = strtoupper($desconto);
    }
    public function setTelefone(string $telefone)
    {
        $this->telefone = $telefone;
    }
    public function setLogo($logo = 0)
    {
        $this->logo = $logo;
    }
    public function setDestaque($destaque = 0)
    {
        $this->destaque = $destaque;
    }
    public function setArquivo($arquivo = [])
    {
        $this->arquivo = $arquivo;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return strtoupper($this->nome);
    }
    public function getcidade()
    {
        return strtoupper($this->cidade);
    }
    public function getDesconto()
    {
        return strtoupper($this->desconto);
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function getLogo()
    {
        return $this->logo;
    }
    public function getDestaque()
    {
        return $this->destaque;
    }
    public function getArquivo()
    {
        return $this->arquivo;
    }
}