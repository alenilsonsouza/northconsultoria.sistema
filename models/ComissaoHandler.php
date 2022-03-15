<?php
/**
 * @author Alenilson Souza <alenilson@aleevolucoes.com.br
 * @copyright 2020
 */
class ComissaoHandler extends model {

    /**
     * Ao chamar a função é carregada as informações de pagamento dos filhos quando pagas
     */
    public function ComissionCalculator($comissao) {
        $niveis = new Niveis();
        $tnivel = $niveis->getTotal();

        // Pega o id do cliente com hash md5()
        $id_cliente = $comissao->getIdCliente();

        $cliente = new Clientes();
        $infoCliente = $cliente->getClienteById($id_cliente);

        // carrega a árvore em array
        $lista = $cliente->listarArvore($infoCliente['id_cliente'],$tnivel);
    
        return $this->arvoreFaturamento($lista);
    }

    /**
     * 1 - Carrega a árvore com as informações de pagamento até o último nível definido
     * 2 - As informações de pagamento são carregadas quando pagas
     * 
     */
    private function arvoreFaturamento($arvore) {
        /**
         * @var array
         * Variável inicial para informar os valores e comissão
         */
        $numeros = [
            'valor' => 0,
            'percentual' => 0,
            'subtotal' => 0
        ];
        
        foreach($arvore as $item) {
            // Pegar inforamções de faturas pagas dentro do mes dos filhos 
            $faturamento = new Faturamento();
            $infoFatu = $faturamento->getFaturamentoPaidMonthByCliente($item['id_cliente'], date("m"));

            // O nível informado é contado a partir de zero, sendo o zero o primeiro nível, por isso soma-se +1
            $nivel = new Niveis();
            $infoNivel = $nivel->getNivelByNivel($item['nivel'] + 1);
            
            // Verifica se existe fatura para pagemento dentro do mês
            $totalGeral = 0;
            foreach($infoFatu as $infoFatu){
                if(!empty($infoFatu['valor'])) {
                    // Pega os valores
                    $valor = $infoFatu['valor'];
                    $comissao = $infoNivel['valor_comissao'];
                    $total = ($infoFatu['valor'] * $infoNivel['valor_comissao'])/100;

                    // Gera o array
                    $numeros['valor'] = $valor;
                    $numeros['percentual'] = $comissao;
                    $numeros['subtotal'] = floatval($total);
                    //$numeros['subTotal'] = array_sum($numeros['total']);

                    /*array_push($numeros['valores'], $valor);
                    $numeros['percentual'] = $comissao;
                    array_push($numeros['total'], $total);
                    $numeros['subTotal'] = array_sum($numeros['total']);*/

                    // Armazena o array
                    $resposta[] = $numeros;
                    
                }
            }            
            
            // Verificação do filhos
            if(count($item['filhos'])>0) {
                // Armazena o array do filho refazendo o método atual
                $resposta[] = $this->arvoreFaturamento($item['filhos']);
            }
        }
       
        // Retorno das lista em arvore (Níveis) com os dados de valor, comissão e total
        return $resposta;
    }

    // Faz o cálculo do total geral baseado na árvore Faturamento
    public function calculo($lista, $total = 0) {

        if(is_array($lista)) {
            foreach($lista as $key => $item) {
                if(isset($item['subtotal'])){
                    $total += $item['subtotal'];
                }  
                echo $key;
                /*if(is_array($item) && count($item)>0) {
                    $total += $this->calculo($item, $total);
                }  */
            }
        }
        return $total;
    }
}