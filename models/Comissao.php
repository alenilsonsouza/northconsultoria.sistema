<?php
/**
 * @author Alenilson Souza <alenilson@aleevolucoes.com.br>
 * @copyright 2020
 */

 class Comissao {
     /**
      * @var string
      */
     private $id_cliente;
     /**
      * @var float
      */
     private $valor_comissao;

     /**
      * getter and setter
      */

     public function setIdCliente($id_cliente) {
         $this->id_cliente = $id_cliente;
     }
     public function setValorComissao($valor_comissao) {
         $this->valor_comissao = floatval($valor_comissao);
     }

     public function getIdCliente() {
         return $this->id_cliente;
     }
     public function getValorComissao() {
         return $this->valor_comissao;
     }

 }