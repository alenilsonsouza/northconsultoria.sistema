<?php
class arcompraplanoController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Clientes();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."loginusuario");
        }
        
    }

    public function index() 
    {

        $plano = new Plano();
        $planos = $plano->getPlano();

        $clientes = new Clientes();
        $cliente = $clientes->getClienteById($_SESSION['clogin']);
        
        $this->loadTemplateInUsuario('comprarplano', [
            'page' => 'comprarplano',
            'planos' => $planos,
            'cliente' => $cliente
            
        ]);
    }

    public function storagePlano()
    {
        $plano = filter_input(INPUT_POST,'plano');
        $id_cliente = filter_input(INPUT_POST,'id_cliente');
        if($plano)
        {
            $infocad = [
                'plano' => $plano,
                'id_cliente' => $id_cliente
            ];
            $_SESSION['caduser'] = $infocad;

        }else{

            header('Location:'.BASE_URL.'arcompraplano');
            exit;
        }
        
        header('Location:'.BASE_URL.'arcompraplano/cadastrodependente');
        exit;
    }

    public function cadastrodependente()
    {
        if(!empty($_SESSION['caduser']))
        {   
            $dependentes = [];
            if(!empty($_SESSION['dependentes_user']))
            {
                $dependentes = $_SESSION['dependentes_user'];
            }
            $parentesco = new ParentescoHandler();
            $parentescos = $parentesco->getList();
            $this->loadTemplateInUsuario('cadastroDependente', [
                'page' => 'comprarplano',
                'parentescos' => $parentescos,
                'dependentes' => $dependentes
            ]);
        }else{
            header('Location:'.BASE_URL.'arcompraplano');
            exit;
        }

        
        
    }

    public function storageDependente()
    {
        
        $nome_dependente = filter_input(INPUT_POST, 'nome_dependente');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $cartao_sus = filter_input(INPUT_POST, 'cartao_sus');
        $nome_mae = filter_input(INPUT_POST, 'nome_mae');
        $dia = filter_input(INPUT_POST, 'dia');
        $mes = filter_input(INPUT_POST, 'mes');
        $ano = filter_input(INPUT_POST, 'ano');
        $sexo = filter_input(INPUT_POST, 'sexo');
        $parentesco = filter_input(INPUT_POST, 'parentesco');

        if($nome_dependente && $cpf)
        {
            if(isset($_SESSION['dependentes_user']) && !empty($_SESSION['dependentes_user']))
            {

            }else{
                $_SESSION['dependentes_user'] = [];
            }
            
            $p = new ParentescoHandler();
            $item = $p->getById($parentesco);
            $nomeParentesco = $item->getNome();
            $key = count($_SESSION['dependentes_user']);
            $plano = new Plano();
            $total_plano = $plano->getSomaPlanoSecundario();
            $plano_item = $plano->getPlanoSecundario();
            $dependente[$key] = [
                'nome' => $nome_dependente,
                'cpf' => $cpf,
                'cartao_sus' => $cartao_sus,
                'nome_mae' => $nome_mae,
                'nascimento' => $ano.'-'.$mes.'-'.$dia,
                'sexo' => $sexo,
                'parentesco' => $parentesco,
                'nomeParentesco' => $nomeParentesco,
                'valor' => $total_plano,
                'idPlano' => $plano_item['id'],
                'plano' => $plano_item['nome']
            ];
            $_SESSION['dependentes_user'] += $dependente;
        }

        header('Location:'.BASE_URL.'arcompraplano/cadastrodependente');
        exit;
        
    }

    public function delDependente($id)
    {
        if(!empty($_SESSION['dependentes_user'][$id]))
        {
            unset($_SESSION['dependentes_user'][$id]);
        }
        header('Location:'.BASE_URL.'arcompraplano/cadastrodependente');
        exit;
    }

    public function concluir() {
        
        $infocad = [];
        if(empty($_SESSION['caduser']['plano'])){
            header('Location:'.BASE_URL.'arcompraplano');
            exit;
        }

        $infocad = $_SESSION['caduser'];

        //Cadastro de dependentes - Quando houver
        if(count($_SESSION['dependentes_user'])>0)
        {
            foreach($_SESSION['dependentes_user'] as $infoDep)
            {
                $cliente = new Clientes();
                $cliente->setNomeCliente($infoDep['nome']);
                $cliente->setCpfCliente($infoDep['cpf']);
                $cliente->setNomeMae($infoDep['nome_mae']);
                $cliente->setCartaoSus($infoDep['cartao_sus']);
                $cliente->setNascimentoCliente($infoDep['nascimento']);
                $cliente->setSexoCliente($infoDep['sexo']);
                $cliente->setParentesco($infoDep['parentesco']);
                $cliente->setIdIndicador($infocad['id_cliente']);
                $cliente->setIdPlano($infoDep['idPlano']);
                $cliente->setTipo(2);
                $cliente->salvar();
            }
        }

        //Envio de Email de confirmação de cadastro
        /*o Formato de texto de envio dever em HTML*/
        $texto = '
            <p>Você recebeu este email porque houve um cadastro no site lifecartões.</p>
            <p>Seja bem vindo a nossa equipe.</p>
        ';
        $email = new Email();
        $email->setNome($infocad['nome']);
        $email->setEmail($infocad['email']);
        $email->setAssunto('Confirmação de Cadastro de compra');
        $email->setMensagem($texto);
        $email->sendEmailTo();

        //Parcelas
        $totalParcelasHandeler = new TotalParcelasHandler();
        $total_parcela = $totalParcelasHandeler->getTotalParcelar();
        $nparcela = 1;
        $tparcela = $total_parcela->getTotal();

        //Pegar o valor do plano
        $plano = new Plano();
        $item = $plano->getPlanoById($infocad['plano']);

        //Falta fazer ajustes na integração
        if ($tparcela >= $nparcela){ 
            $hoje = date('Y-m-d');
            $data_vencimento = date('Y-m-d', strtotime("+1 day"));
            $dia_vendimento = date('d', strtotime($data_vencimento));
            //Se o dia de vencimento for maior que 28 então o vencimento será dia 1
            if($dia_vendimento > 28)
            {
                $dia_vendimento = 1;
                $proximo_mes = date('Y-m', strtotime("+1 month"));
                $data_vencimento = date('Y-m-d', strtotime($proximo_mes.'-'.$dia_vendimento));
            }
            if ($dia_vendimento >=1 && $dia_vendimento <= 28)
            {

                $c = new Clientes();
                $cliente = $c->getClienteById(md5($infocad['id_cliente']));

                $idParcelamento = new IdParcelamento();
                $id_parcelamento = $idParcelamento->salvar();

                $valorPlanoSecundario = 0;
                if(count($_SESSION['dependentes_user']) > 0)
                {
                    foreach($_SESSION['dependentes_user'] as $dependente)
                    {
                        $vlr[] = $dependente['valor'];
                    }
                    $valorPlanoSecundario = array_sum($vlr);
                }

                $soma = $valorPlanoSecundario + $item['valor'];

                $valor_real = number_format($soma,2,",","."); //VAlor em real para o boleto barato
                $mora = '1,00';
                $multa = '2,00';
                $result = 0;
                for ($i=$nparcela;$i<=$tparcela;$i++){
                    $m = new Moeda();
                    $m->setValorFloat($valor_real);
                    $valor = $m->getValor();
                    $m->setValorFloat($mora);
                    $valor_mora = $m->getValor();
                    $m->setValorFloat($multa);
                    $valor_multa = $m->getValor();

                    //Cadastrar no sistema parcela por parcela
                    $f = new Faturamento();
                    $f->setIdCliente($cliente['id_cliente']); 
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
                    $celular = str_replace('(','',$cliente['celular']);
                    $celular = str_replace(')','',$celular);
                    $celular = str_replace('-','',$celular);
                    $celular = str_replace(' ','',$celular);

                    $enderecos = new Enderecos();
                    $endereco = $enderecos->getEnderecoByIdCliente($cliente['id_cliente']);

                    $b->setCelularCliente($celular);
                    $b->setLogradouro($endereco['logradouro']);
                    $b->setNumero($endereco['numero']);
                    $b->setComplemento($endereco['complemento']);
                    $b->setBairro($endereco['bairro']);
                    $b->setCEP($endereco['cep']);
                    $b->setCidade($endereco['cidade']);
                    $b->setEstado($endereco['estado']);
                    $b->setValor($valor_real);
                    $b->setTipo(1);
                    $b->setMora($mora);
                    $b->setMulta($multa);
                    $b->setDataVencimento($data_vencimento);
                    $b->setAssuntoBoleto('Mensalidade Plano');
                    $b->setDescricao('Mensalidade Plano');
                    $b->setCodigoBoleto($id_faturamento);
                    $result = $b->pegarDados($i, $tparcela);
                    
                    $data_vencimento = date("Y-m-d", strtotime('+1 month', strtotime($data_vencimento))); 
                }
                if($result == 0) {
                    $clientes = new Clientes();
                    $clientes->atualizarTipo($cliente['id_cliente'],3);
                    unset($_SESSION['caduser']);
                    unset($_SESSION['dependentes_user']);
                    header('Location:'.BASE_URL.'arcompraplano/concluirCompraPlano/');
                    exit;
                }
            }else{
                $dados['flash'] = "Só são aceitos dias de vencimento entre 1 e 28";
            }

        }else{
            $dados['flash'] = "O total de parcela não pode ser menor que o número da parcela";
        }

        header('Location:'.BASE_URL.'arcompraplano');
        exit;
    
    } 

    public function concluirCompraPlano()
    {
        $this->loadTemplateInUsuario('concluirCompraPlano', [
            'page' => 'comprarplano',
        ]);
    }

}