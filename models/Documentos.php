<?php 
class Documentos
{
    private $id;
    private $id_cliente;
    private $id_arquivo;
    private $nome;
    private $data;
    private $tipo;
    private $arquivo;

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setIdCliente(int $id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }
    public function setIdArquivo(int $id_arquivo)
    {
        $this->id_arquivo = $id_arquivo;
    }
    public function setNome(string $nome)
    {
        $this->nome = ucwords($nome);
    }
    public function setData(string $data)
    {
        $this->data = $data;
    }
    public function setTipo(int $tipo)
    {
        $this->tipo = $tipo;
    }
    public function setArquivo($arquivo = [])
    {
        $this->arquivo = $arquivo;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getIdCliente()
    {
        return $this->id_cliente;
    }
    public function getIdArquivo()
    {
        return $this->id_arquivo;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getData()
    {
        return $this->data;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getArquivo()
    {
        return $this->arquivo;
    }
}