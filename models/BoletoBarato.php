<?php
class BoletoBarato extends model
{

    private $email;
    private $senha;
    private $array;

    private $nome_cliente;
    private $email_cliente;
    private $cpfcnpj;
    private $celular_cliente;
    private $cep;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $estado;

    private $id_parcelamento;
    private $codigo_boleto;
    private $valor;
    private $tipo;
    private $mora;
    private $multa;
    private $data_vencimento;
    private $descricao;
    private $idboleto;

    private $assuntoBoleto;
    private $corpoBoleto;
    private $idSistema;

    public function __construct()
    {
        parent::__construct();
        $this->array = array();
        $sql = "SELECT * FROM boleto_barato WHERE id_boleto_barato = 1";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $this->array = $sql->fetch();
            $this->email = $this->array['email'];
            $this->senha = $this->array['senha'];
        }
    }

    public function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getArray()
    {
        return $this->array;
    }

    public function setNomeCliente($nome)
    {
        $this->nome_cliente = $nome;
    }
    public function setEmailCliente($email)
    {
        $this->email_cliente = $email;
    }
    public function setCPFCNPJ($cpfcnpj)
    {
        $this->cpfcnpj = $cpfcnpj;
    }
    public function setCelularCliente($celular)
    {
        $this->celular_cliente = $celular;
    }
    public function setCEP($cep)
    {
        $this->cep = $cep;
    }
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function setIdParcelamento($id)
    {
        if (filter_var($id, FILTER_VALIDATE_INT)) {
            $this->id_parcelamento = $id;
        }
    }
    public function setCodigoBoleto($codigo)
    {
        $this->codigo_boleto = $codigo;
    }
    public function setValor($valor)
    {
        $valor = substr($valor, 0, -3);
        $this->valor =  $valor;
    }
    public function setTipo($tipo)
    {
        if (filter_var($tipo, FILTER_VALIDATE_INT)) {
            $this->tipo = $tipo;
        }
    }
    public function setMora($mora)
    {
        $this->mora = $mora;
    }
    public function setMulta($multa)
    {
        $this->multa = $multa;
    }
    public function setDataVencimento($data)
    {
        $this->data_vencimento = $data;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setIdBoleto($idboleto)
    {
        if (filter_var($idboleto, FILTER_VALIDATE_INT)) {
            $this->idboleto = $idboleto;
        }
    }

    public function setAssuntoBoleto($assunto)
    {
        if (filter_var($assunto, FILTER_SANITIZE_STRING)) {
            $this->assuntoBoleto = $assunto;
        }
    }

    public function setCorpoBoleto($corpo)
    {
        if (filter_var($corpo, FILTER_SANITIZE_STRING)) {
            $this->corpoBoleto = $corpo;
        }
    }

    public function setIdSistema($idSistema)
    {
        if (filter_var($idSistema, FILTER_VALIDATE_INT)) {
            $this->idSistema = $idSistema;
        }
    }




    public function salvar()
    {

        $sql = "UPDATE boleto_barato SET email = :email, senha = :senha, assuntoBoleto = :assuntoBoleto, corpoBoleto = :corpoBoleto, idSistema = :idSistema WHERE id_boleto_barato = 1";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $this->email);
        $sql->bindValue(":senha", $this->senha);
        $sql->bindValue(":assuntoBoleto", $this->assuntoBoleto);
        $sql->bindValue(":corpoBoleto", $this->corpoBoleto);
        $sql->bindValue(":idSistema", $this->idSistema);
        $sql->execute();
    }



    public function pegarDados($nparcela, $tpacela)
    {


        $dados["tipo"] = "boleto.remessa";

        $boleto = array();

        // configuração para retorno dos gatilhos de pagamento
        if (ENVIRONMENT == 'production') {
            $boleto["config.urlretorno"] = 'https:' . BASE_URL . "retornoboleto";
        } else {
            $boleto["config.urlretorno"] = BASE_URL . "retornoboleto";
        }


        // configurações de notificação
        $boleto["config.enviaemail"] = 0;
        $boleto["config.enviasms"] = 0;
        $boleto["config.recobrar"] = 0;

        $boleto["cliente.atualizadados"] = "1";
        $boleto["cliente.nome"] = $this->nome_cliente;
        $boleto["cliente.cpfcnpj"] = $this->cpfcnpj;
        $boleto["cliente.celular"] = $this->celular_cliente;
        $boleto["cliente.email"] = $this->email_cliente;
        $boleto["cliente.fixo"] = "";

        // dados de endereço
        $boleto["cliente.logradouro"] = $this->logradouro;
        $boleto["cliente.numero"] = $this->numero;
        $boleto["cliente.complemento"] = $this->complemento;
        $boleto["cliente.bairro"] = $this->bairro;
        $boleto["cliente.cep"] = $this->cep;
        $boleto["cliente.cidade"] = $this->cidade;
        $boleto["cliente.uf"] = $this->estado;

        // se o formato do boleto vai ser carnê
        $boleto["boleto.carne"] = "0";

        $boleto["boleto.idparcelamento"] = $this->id_parcelamento;
        $boleto["boleto.idparcela"] = $nparcela;
        $boleto["boleto.numparcelas"] = $tpacela;

        // codigo numerico de indentificação do boleto no seu sistema (geralmente PK)
        $boleto["boleto.meucodigo"] = $this->codigo_boleto;

        // formato português mesmo
        $boleto["boleto.valor"] = $this->valor;

        //$hoje = date('Y-m-d');
        //$vencimento = date('d/m/Y', strtotime($hoje . ' +1 day'));

        $boleto["boleto.datavencimento"] = date('d/m/Y', strtotime($this->data_vencimento)); //hoje
        //$boleto["boleto.numerodoc"] = "Parc. ".$nparcela."/".$tpacela;
        $boleto["boleto.numerodoc"] = "000";

        // Assunto/Título do E-mail
        $boleto["boleto.assunto"] = $this->assuntoBoleto;

        // 1 é porcentagem, 2 é valor fixo
        $boleto["boleto.tipmora"] = $this->tipo;
        $boleto["boleto.mora"] = $this->mora;
        $boleto["boleto.tipmulta"] = $this->tipo;
        $boleto["boleto.multa"] = $this->multa;


        // descritivo que vai na parte de cima do boleto
        $boleto["boleto.descritivo"] = $this->descricao;

        // descritivo que vai na parte de baixo do boleto, para o caixa
        $boleto["boleto.corpoboleto"] = $this->descricao;

        // especie do Boleto, a maioria é Duplicata Mercantil (DM)
        $boleto["boleto.especie"] = "DM";



        // Adiciona Boleto ao lote de boletos
        $dados['dados'] = array();
        array_push($dados['dados'], $boleto);


        ///////////////////////////////
        // Consome a API do Boleto ////
        ///////////////////////////////
        $resposta = $this->curl_boleto($dados);
        $itemboleto = $resposta['dados'];
        /*echo "<pre>";
            print_r($resposta); 
            exit;*/

        $coderroGeral = $resposta['coderro'];
        $erroGeral = $resposta['erro'];

        if ($coderroGeral == 0) {
            $sql = "UPDATE faturamento SET url_boleto = :url_boleto, url_fatura = :url_fatura, codigodebarras = :codigodebarras, idboleto = :idboleto WHERE id_faturamento = :id";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":url_boleto", $itemboleto[0]['urlboleto']);
            $sql->bindValue(":url_fatura", $itemboleto[0]['urlfatura']);
            $sql->bindValue(":codigodebarras", $itemboleto[0]['codigodebarras']);
            $sql->bindValue(":idboleto", $itemboleto[0]['idboleto']);
            $sql->bindValue(":id", intval($itemboleto[0]['meucodigo']));
            $sql->execute();
        } else {

            echo '<p>Erro de Integração de sistema com boleto</p>';
            echo '<p>Erro de Integração' . $erroGeral . ' - ' . $coderroGeral . '</p>';
        }

        return $coderroGeral;
    }

    public function cancelarBoleto()
    {

        $dados["tipo"] = "boleto.cancelar";
        $dados["meucodigo"] = $this->codigo_boleto;
        $dados["idboleto"] = $this->idboleto;
        $resposta = $this->curl_boleto($dados);
    }

    private function curl_boleto($dados = array())
    {

        //global $bb_user, $bb_pass;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://cobrancaporboleto.com.br/api/v1/');

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . base64_encode($this->email . ':' . $this->senha)));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dados));

        $resposta = curl_exec($ch);

        //echo $resposta; // caso precise debugar utilize essa linha

        return json_decode($resposta, 1);
    }

    public function gerarBoleto($id_cliente, $nparcela, $tparcela, $data_vencimento, $valor)
    {

        if ($tparcela >= $nparcela) {

            $c = new Clientes();
            $cliente = $c->getClienteById(md5($id_cliente));

            $idParcelamento = new IdParcelamento();
            $id_parcelamento = $idParcelamento->salvar();

            $dependente = new Dependentes();
            $valorPlanoSecundario = $dependente->valorTotalDependente($id_cliente);
            
            $soma = $valorPlanoSecundario + $valor;

            $valor_real = number_format($soma, 2, ",", "."); //VAlor em real para o boleto barato
            $mora = '1,00';
            $multa = '2,00';
            $result = 0;
            for ($i = $nparcela; $i <= $tparcela; $i++) {
                $m = new Moeda();
                $m->setValorFloat($valor_real);
                $valor = $m->getValor();
                $m->setValorFloat($mora);
                $valor_mora = $m->getValor();
                $m->setValorFloat($multa);
                $valor_multa = $m->getValor();

                //Cadastrar no sistema parcela por parcela
                $f = new Faturamento();
                $f->setIdCliente($id_cliente);
                $f->setIdParcelamento($id_parcelamento);
                $f->setIdNegocio(0);
                $f->setValor($valor);
                $f->setTipo(1);
                $f->setMora($valor_mora);
                $f->setMulta($valor_multa);
                $f->setNParcela($i);
                $f->setTParcela($tparcela);
                $f->setDataVencimento($data_vencimento);
                $f->setIdFormaPagamento(1);
                $f->setDescricao('Mensalidade Plano');
                $id_faturamento = $f->salvar();

                $b = new BoletoBarato();
                $b->setNomeCliente($cliente['nome_cliente']);
                $b->setEmailCliente($cliente['email_cliente']);
                $b->setIdParcelamento($id_parcelamento);
                $b->setCPFCNPJ($cliente['cpf_cliente']);

                //Retirar os parenteses, traço e espaços para enviar somente números
                $celular = str_replace('(', '', $cliente['celular']);
                $celular = str_replace(')', '', $celular);
                $celular = str_replace('-', '', $celular);
                $celular = str_replace(' ', '', $celular);

                $b->setCelularCliente($celular);
                $b->setLogradouro(isset($cliente['endereco']['logradouro'])?$cliente['endereco']['logradouro']:'Rua Vicente de Carvalho');
                $b->setNumero(isset($cliente['endereco']['numero'])?$cliente['endereco']['numero']:'');
                $b->setComplemento(isset($cliente['endereco']['complemento'])?$cliente['endereco']['complemento']:'402');
                $b->setBairro(isset($cliente['endereco']['bairro'])?$cliente['endereco']['bairro']:'Boa Vista 2');
                $b->setCEP(isset($cliente['endereco']['cep'])?$cliente['endereco']['cep']:'29107358');
                $b->setCidade(isset($cliente['endereco']['cidade'])?$cliente['endereco']['cidade']:'Vila Velha');
                $b->setEstado(isset($cliente['endereco']['estado'])?$cliente['endereco']['estado']:'ES');
                $b->setValor($valor_real);
                $b->setTipo(1);
                $b->setMora($mora);
                $b->setMulta($multa);
                $b->setDataVencimento($data_vencimento);
                $b->setAssuntoBoleto('Mensalidade Plano');
                $b->setDescricao('Mensalidade Plano');
                $b->setCodigoBoleto($id_faturamento);
                $result = $b->pegarDados($i, $tparcela);
                $resposta_array[] = $result;

                $data_vencimento = date("Y-m-d", strtotime('+1 month', strtotime($data_vencimento)));
            }
        }
        
        if (array_sum($resposta_array) == 0) {
            return true;  
        }
        return false;
    }
}
