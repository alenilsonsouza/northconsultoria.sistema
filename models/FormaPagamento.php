<?php
class FormaPagamento extends model{
    private $id_forma_pagamento;
    private $nome_forma_pagamento;
    private $array;

    public function __construct($id =''){
        parent:: __construct();
        $this->array = array();
        if(!empty($id)){
            $sql = "SELECT * FROM forma_pagamento WHERE MD5(id_forma_pagamento) = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":id", $id);
            $sql->execute();
            if ($sql->rowCount()>0){
                $this->array = $sql->fetch();
            }
        }else{

            $sql = "SELECT * FROM forma_pagamento ORDER BY nome_forma_pagamento ASC";
            $sql = $this->db->query($sql);
            if ($sql->rowCount()>0){
                $this->array = $sql->fetchAll();
            }

        }


    }


    public function setNomeFormaPagamento($nome){
        if (filter_var($nome, FILTER_SANITIZE_STRING)){
            $this->nome_forma_pagamento = $nome;
        }
    }
    public function getArray(){
        return $this->array;
    }

    public function salvar($id = ''){
        if (!empty($id)){
            $sql = "UPDATE forma_pagamento SET nome_forma_pagamento = :nome_forma_pagamento WHERE MD5(id_forma_pagamento) = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":nome_forma_pagamento", $this->nome_forma_pagamento);
            $sql->bindValue(":id", $id);
            $sql->execute();
        }else{
            $sql = "INSERT INTO forma_pagamento (nome_forma_pagamento) VALUES (:nome_forma_pagamento)";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":nome_forma_pagamento", $this->nome_forma_pagamento);
            $sql->execute();

        }
    }
}