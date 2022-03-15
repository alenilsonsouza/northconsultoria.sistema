<?php
class DadosBancarios {
    private $id;
    private $id_cliente;
    private $banco;
    private $tipo;
    private $agencia;
    private $conta;
    private $data_cadastro;
    private $nome_titular;
    private $cpf_titular;
    private $tipoNome;

    public function setId($id) {
        $this->id = intval($id);
    }
    public function setIdCliente($id_cliente) {
        $this->id_cliente = intval($id_cliente);
    }
    public function setBanco($banco) {
        $this->banco = trim($banco);
    }
    public function setTipo($tipo) {
        $this->tipo = intval($tipo);
    }
    public function setAgencia($agencia) {
        $this->agencia = trim($agencia);
    }
    public function setConta($conta) {
        $this->conta = trim($conta);
    }
    public function setDataCadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }
    public function setNomeTitular($nome_titular) {
        $minusculo = strtolower($nome_titular);
        $this->nome_titular = ucwords($minusculo);
    }
    public function setCPFTitular($cpf_titular) {
        $this->cpf_titular = $cpf_titular;
    }
    public function setTipoNome($tipo) {
        switch($tipo) {
            case 1:
                $this->tipoNome = 'Corrente';
                break;
            case 2: 
                $this->tipoNome = 'Poupança';
                break;
            default:
                $this->tipoNome = 'Corrente';
            break;
        }
    }

    public function getId() {
        return $this->id;
    }
    public function getIdCliente() {
        return $this->id_cliente;
    }
    public function getBanco() {
        return $this->banco;
    }
    public function getTipo() {
        return $this->tipo;
    }
    public function getAgencia() {
        return $this->agencia;
    }
    public function getConta() {
        return $this->conta;
    }
    public function getDataCadastro() {
        return $this->data_cadastro;
    }
    public function getTipoNome() {
        return $this->tipoNome;
    }
    public function getNomeTitular() {
        return $this->nome_titular;
    }
    public function getCPFTitular() {
        return $this->cpf_titular;
    }
}