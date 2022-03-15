<?php
class DadosBancariosHandler extends model {

    public function insert(DadosBancarios $dadosBancarios) {
        $sql = "INSERT INTO dados_bancarios (id_cliente, banco, tipo, agencia, conta, data_cadastro, nome_titular, cpf_titular) VALUES (:id_cliente, :banco, :tipo, :agencia, :conta, :data_cadastro, :nome_titular, :cpf_titular)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_cliente', $dadosBancarios->getIdCliente());
        $sql->bindValue(':banco', $dadosBancarios->getBanco());
        $sql->bindValue(':tipo', $dadosBancarios->getTipo());
        $sql->bindValue(':agencia', $dadosBancarios->getAgencia());
        $sql->bindValue(':conta', $dadosBancarios->getConta());
        $sql->bindValue(':data_cadastro', $dadosBancarios->getDataCadastro());
        $sql->bindValue(':nome_titular', $dadosBancarios->getNomeTitular());
        $sql->bindValue('cpf_titular', $dadosBancarios->getCPFTitular());
        $sql->execute();
    }

    public function getBancoByIdCliente($id_cliente) { 
        $array = [];
        $sql = "SELECT * FROM dados_bancarios WHERE id_cliente = :id_cliente";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_cliente", $id_cliente);
        $sql->execute();
        if($sql->rowCount()>0) {
            $lista = $sql->fetch();
            $newBanco = new DadosBancarios();
            $newBanco->setId($lista['id']);
            $newBanco->setIdCliente($lista['id_cliente']);
            $newBanco->setBanco($lista['banco']);
            $newBanco->setAgencia($lista['agencia']);
            $newBanco->setConta($lista['conta']);
            $newBanco->setTipo($lista['tipo']);
            $newBanco->setTipoNome($lista['tipo']);
            $newBanco->setDataCadastro($lista['data_cadastro']);
            $newBanco->setNomeTitular($lista['nome_titular']);
            $newBanco->setCPFTitular($lista['cpf_titular']);

            $array = $newBanco;
        }
        return $array;
    }

    public function update(DadosBancarios $banco) {
        $sql = "UPDATE dados_bancarios SET banco = :banco, tipo = :tipo, agencia = :agencia, conta = :conta, nome_titular = :nome_titular, cpf_titular = :cpf_titular WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':banco', $banco->getBanco());
        $sql->bindValue(':tipo', $banco->getTipo());
        $sql->bindValue(':agencia', $banco->getAgencia());
        $sql->bindValue(':conta', $banco->getConta());
        $sql->bindValue(':nome_titular', $banco->getNomeTitular());
        $sql->bindValue(':cpf_titular', $banco->getCPFTitular());
        $sql->bindValue(':id', $banco->getId());
        $sql->execute();
    }
}