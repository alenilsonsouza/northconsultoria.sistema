<?php
class Clientes extends model
{

	private $id_indicador;
	private $nome_cliente;
	private $email_cliente;
	private $nome_mae;
	private $cpf_cliente;
	private $nascimento_cliente;
	private $sexo_cliente;
	private $telefone;
	private $celular;
	private $senha;
	private $rg;
	private $id_plano;
	private $id_estadocivil;
	private $tipo;
	private $cartao_sus;
	private $parentesco;
	private $tipo_comissao;
	private $array;

	public function __construct($id = '')
	{
		parent::__construct();
		$this->array = array();

		if (!empty($id)) {
			$sql = "SELECT *, clientes.id_cliente as id_cliente FROM clientes  
			WHERE MD5(clientes.id_cliente) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();
			if ($sql->rowCount() > 0) {
				$this->array = $sql->fetch();
			}
		} else {

			$sql = "SELECT * FROM clientes";
			$sql = $this->db->query($sql);
			if ($sql->rowCount() > 0) {
				$this->array = $sql->fetchAll();
			}
		}
	}

	public function setIdIndicador($id)
	{
		if (filter_var($id, FILTER_VALIDATE_INT)) {
			$this->id_indicador = $id;
		}
	}

	public function setNomeCliente($nome)
	{
		if (filter_var($nome, FILTER_SANITIZE_STRING)) {
			$minusculoName = strtolower($nome);
			$this->nome_cliente = ucwords($minusculoName);
		}
	}

	public function setEmailCliente($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->email_cliente = strtolower($email);
		}
	}

	public function setNomeMae($nome)
	{
		$minusculoMotherName = strtolower($nome);
		$this->nome_mae = ucwords($minusculoMotherName);
	}

	public function setCpfCliente($cpf)
	{
		if (filter_var($cpf, FILTER_SANITIZE_STRING)) {
			$this->cpf_cliente = $cpf;
		}
	}
	public function setNascimentoCliente($data)
	{
		if (filter_var($data, FILTER_SANITIZE_STRING)) {
			$data = date("Y-m-d", strtotime($data));
			//echo $data;exit;
			$this->nascimento_cliente = $data;
		}
	}
	public function setSexoCliente($sexo)
	{
		if (filter_var($sexo, FILTER_SANITIZE_STRING)) {
			$this->sexo_cliente = $sexo;
		}
	}
	public function setTelefone($tel)
	{
		if (filter_var($tel, FILTER_SANITIZE_STRING)) {
			$this->telefone = $tel;
		}
	}
	public function setCelular($cel)
	{
		if (filter_var($cel, FILTER_SANITIZE_STRING)) {
			$this->celular = $cel;
		}
	}

	public function setSenha($senha)
	{
		$this->senha = $senha;
	}

	public function setRg($rg)
	{
		if (filter_var($rg, FILTER_SANITIZE_STRING)) {
			$this->rg = $rg;
		}
	}

	public function setIdPlano($id)
	{
		$this->id_plano = $id;
	}

	public function setIdEstadoCivil($estadocivil)
	{
		if (filter_var($estadocivil, FILTER_VALIDATE_INT)) {
			$this->id_estadocivil = $estadocivil;
		}
	}

	public function setTipo($tipo)
	{
		$this->tipo = $tipo;
	}

	public function setCartaoSus($cartao)
	{
		$this->cartao_sus = $cartao;
	}

	public function setParentesco($parentesco)
	{
		$this->parentesco = $parentesco;
	}

	public function setTipoComissao($tipo = 'P')
	{
		$this->tipo_comissao = $tipo;
	}

	public function setArray($array)
	{
		if (is_array($array)) {
			$this->array = $array;
		}
	}

	public function getArray()
	{
		return $this->array;
	}

	public function getClientes($offset, $limite)
	{
		$array = array();
		$sql = "SELECT * FROM clientes 
		ORDER BY id_cliente DESC LIMIT $offset, $limite";
		$sql = $this->db->query($sql);
		if ($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach ($list as $item) {
				$array[] = $this->montarObj($item);
			}
		}
		return $array;
	}

	public function getClienteVendedor($offset, $limit, $mes = '')
	{
		$array = array();
		$sql = "SELECT * FROM clientes WHERE isNull(id_indicador)
		ORDER BY id_cliente DESC LIMIT $offset, $limit";
		$sql = $this->db->query($sql);
		if ($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach ($list as $key => $item) {
				$array[] = $this->montarObj($item);
				if (!empty($mes)) {
					$tipo_comissao = $item['tipo_comissao'];
					$calculo = new CalculoComissao();
					if ($tipo_comissao == 'V') {
						$array[$key]['comissao'] = $calculo->comissaoVitalicio($item['id_cliente'], $mes);
					} elseif ($tipo_comissao == 'P') {
						$array[$key]['comissao'] = $calculo->comissao50($item['id_cliente'], $mes);
					} else {
						$array[$key]['comissao'] = 0;
					}
				}
			}
		}
		return $array;
	}

	public function getTotalClienteVendedor()
	{
		$sql = "SELECT COUNT(*) as t FROM clientes WHERE isNull(id_indicador)";
		$sql = $this->db->query($sql);
		$sql = $sql->fetch();
		return $sql['t'];
	}

	public function getTotalCliente()
	{
		$sql = "SELECT COUNT(*) as t FROM clientes WHERE id_indicador > 0";
		$sql = $this->db->query($sql);
		$sql = $sql->fetch();
		return $sql['t'];
	}

	public function getClienteVendedorTodos($mes = '')
	{
		$array = array();
		$sql = "SELECT * FROM clientes WHERE isNull(id_indicador)
		ORDER BY nome_cliente ASC";
		$sql = $this->db->query($sql);
		if ($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach ($list as $key => $item) {
				$array[] = $this->montarObj($item);
				if (!empty($mes)) {
					$tipo_comissao = $item['tipo_comissao'];
					$calculo = new CalculoComissao();
					if ($tipo_comissao == 'V') {
						$array[$key]['comissao'] = $calculo->comissaoVitalicio($item['id_cliente'], $mes);
						$array[$key]['nome_tipo'] = "Vitalício";
					} elseif ($tipo_comissao == 'P') {
						$array[$key]['comissao'] = $calculo->comissao50($item['id_cliente'], $mes);
						$array[$key]['nome_tipo'] = "50% Primeira Parcela";
					} else {
						$array[$key]['comissao'] = 0;
						$array[$key]['nome_tipo'] = "Não definido";
					}
				}
			}
		}
		return $array;
	}

	
	public function getUltimosVendedores()
	{
		$array = [];
		$sql = "SELECT * FROM clientes WHERE isNull(id_indicador) ORDER BY id_cliente DESC LIMIT 5";
		$sql = $this->db->query($sql);
		if ($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach ($list as $item) {
				$array[] = $this->montarObj($item);
			}
		}
		return $array;
	}

	public function getUltimosClientes()
	{
		$array = [];
		$sql = "SELECT * FROM clientes WHERE id_indicador > 0 ORDER BY id_cliente DESC LIMIT 5";
		$sql = $this->db->query($sql);
		if ($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach ($list as $item) {
				$array[] = $this->montarObj($item);
			}
		}
		return $array;
	}

	public function getSearchByIdOrNameOrCPF($search)
	{
		$array = array();
		$sql = "SELECT * FROM clientes WHERE id_cliente LIKE :id OR nome_cliente LIKE :nome OR cpf_cliente LIKE :cpf";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", '%' . $search . '%');
		$sql->bindValue(":nome", '%' . $search . '%');
		$sql->bindValue(":cpf", '%' . $search . '%');
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach ($list as $item) {
				$array[] = $this->montarObj($item);
			}
		}
		return $array;
	}

	public function idExists($id)
	{
		$sql = "SELECT * FROM clientes WHERE id_cliente = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		if ($sql->rowCount() > 0) {

			return true;
		}

		return false;
	}

	public function idExistsConsultor($id)
	{
		$sql = "SELECT * FROM clientes WHERE id_cliente = :id AND tipo IN (1,3)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		if ($sql->rowCount() > 0) {

			return true;
		}

		return false;
	}

	public function getClienteById($id)
	{
		$array = [];
		$sql = "SELECT * FROM clientes WHERE MD5(id_cliente) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$item = $sql->fetch(PDO::FETCH_ASSOC);
			$array = $this->montarObj($item);
		}
		return $array;
	}

	public function pesquisarClienteTitular($pesquisa)
	{
		$array = [];
		$sql = "SELECT * FROM clientes WHERE id_indicador > 0 AND isNULL(tipo) AND nome_cliente LIKE :pesquisa";
		$sql = $this->db->prepare($sql);
		$sql->execute([
			':pesquisa' => '%'.$pesquisa.'%'
		]);
		if ($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach($list as $item) {
				$array[] = $this->montarObj($item);
			}
			
		}
		return $array;
	}

	public function getClienteTitular($offset, $limit)
	{
		$array = [];
		$sql = "SELECT * FROM clientes WHERE id_indicador > 0 AND isNULL(tipo) LIMIT $offset, $limit";
		$sql = $this->db->query($sql);
		if ($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach($list as $item) {
				$array[] = $this->montarObj($item);
			}
			
		}
		return $array;
	}

	public function getTotalClienteTitular()
	{
		$array = [];
		$sql = "SELECT COUNT(*) AS t FROM clientes WHERE id_indicador > 0 AND isNULL(tipo)";
		$sql = $this->db->query($sql);
		$sql = $sql->fetch();
		return $sql['t'];
	}

	public function verifyCPF($cpf)
	{
		$sql = "SELECT * FROM clientes WHERE cpf_cliente = :cpf";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':cpf', $cpf);
		$sql->execute();
		if ($sql->rowCount() > 0) {

			return true;
		}

		return false;
	}
	public function verifyEmail($email)
	{
		$sql = "SELECT email_cliente FROM clientes WHERE email_cliente = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return true;
		}

		return false;
	}

	public function getTotal()
	{

		$sql = "SELECT COUNT(*) as t FROM clientes";
		$sql = $this->db->query($sql);
		$sql = $sql->fetch();
		return $sql['t'];
	}

	public function getClienteByEmail($email)
	{
		$array = [];
		$sql = "SELECT * FROM clientes WHERE email_cliente = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}
		return $array;
	}

	public function verificarCpfExiste($cpf)
	{

		$sql = "SELECT * FROM clientes WHERE cpf_cliente = :cpf";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":cpf", $cpf);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function update($id)
	{
		$sql = "UPDATE clientes 
			SET nome_cliente = :nome_cliente, nome_mae = :nome_mae,nascimento_cliente = :nascimento_cliente, sexo_cliente = :sexo_cliente, telefone = :telefone, celular = :celular, rg = :rg, id_plano = :id_plano, id_estadocivil = :id_estadocivil, cartao_sus = :cartao_sus
			WHERE id_cliente = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_cliente", $this->nome_cliente);
			$sql->bindValue(":nome_mae", $this->nome_mae);
			$sql->bindValue(":nascimento_cliente", $this->nascimento_cliente);
			$sql->bindValue(":sexo_cliente", $this->sexo_cliente);
			$sql->bindValue(":telefone", $this->telefone);
			$sql->bindValue(":celular", $this->celular);
			$sql->bindValue(":rg", $this->rg);
			$sql->bindValue(":id_plano", $this->id_plano);
			$sql->bindValue(":id_estadocivil", $this->id_estadocivil);
			$sql->bindValue(":cartao_sus", $this->cartao_sus);
			$sql->bindValue(':id', $id);
			$sql->execute();
	}
	public function salvar($cpf = '')
	{

		if (!empty($cpf)) {

			$sql = "UPDATE clientes 
			SET nome_cliente = :nome_cliente, nome_mae = :nome_mae,nascimento_cliente = :nascimento_cliente, sexo_cliente = :sexo_cliente, telefone = :telefone, celular = :celular, rg = :rg, id_plano = :id_plano, id_estadocivil = :id_estadocivil, cartao_sus = :cartao_sus, parentesco = :parentesco 
			WHERE cpf_cliente = :cpf";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_cliente", $this->nome_cliente);
			$sql->bindValue(":nome_mae", $this->nome_mae);
			$sql->bindValue(":nascimento_cliente", $this->nascimento_cliente);
			$sql->bindValue(":sexo_cliente", $this->sexo_cliente);
			$sql->bindValue(":telefone", $this->telefone);
			$sql->bindValue(":celular", $this->celular);
			$sql->bindValue(":cpf", $cpf);
			$sql->bindValue(":rg", $this->rg);
			$sql->bindValue(":id_plano", $this->id_plano);
			$sql->bindValue(":id_estadocivil", $this->id_estadocivil);
			$sql->bindValue(":cartao_sus", $this->cartao_sus);
			$sql->bindValue(":parentesco", $this->parentesco);
			$sql->execute();

			$sql = "SELECT id_cliente FROM clientes WHERE cpf_cliente = :cpf";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":cpf", $cpf);
			$sql->execute();
			$sql = $sql->fetch();
			return $sql['id_cliente'];
		} else {
			$sql = "INSERT INTO clientes 
			(id_indicador, nome_cliente, email_cliente, nome_mae, cpf_cliente, nascimento_cliente, sexo_cliente, telefone, celular, senha, rg, id_plano, id_estadocivil, data_cadastro, tipo, cartao_sus, parentesco, tipo_comissao) 
			VALUES (:id_indicador, :nome_cliente, :email_cliente, :nome_mae, :cpf_cliente, :nascimento_cliente, :sexo_cliente, :telefone, :celular, :senha, :rg, :id_plano, :id_estadocivil, :data_cadastro, :tipo, :cartao_sus, :parentesco, :tipo_comissao)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_indicador", $this->id_indicador);
			$sql->bindValue(":nome_cliente", $this->nome_cliente);
			$sql->bindValue(":email_cliente", $this->email_cliente);
			$sql->bindValue(":nome_mae", $this->nome_mae);
			$sql->bindValue(":cpf_cliente", $this->cpf_cliente);
			$sql->bindValue(":nascimento_cliente", $this->nascimento_cliente);
			$sql->bindValue(":sexo_cliente", $this->sexo_cliente);
			$sql->bindValue(":telefone", $this->telefone);
			$sql->bindValue(":celular", $this->celular);
			$sql->bindValue(":senha", $this->senha);
			$sql->bindValue(":rg", $this->rg);
			$sql->bindValue(":id_plano", $this->id_plano);
			$sql->bindValue(":id_estadocivil", $this->id_estadocivil);
			$sql->bindValue(":data_cadastro", date('Y-m-d H:i:s'));
			$sql->bindValue(":tipo", $this->tipo);
			$sql->bindValue(":cartao_sus", $this->cartao_sus);
			$sql->bindValue(":parentesco", $this->parentesco);
			$sql->bindValue(":tipo_comissao", $this->tipo_comissao);
			$sql->execute();
			$id = $this->db->lastInsertId();
			return $id;
		}
	}

	public function atualizarTipo($id_cliente, $tipo)
	{
		$sql = "UPDATE clientes SET tipo = :tipo WHERE id_cliente = :id_cliente";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':tipo', $tipo);
		$sql->bindValue(':id_cliente', $id_cliente);
		$sql->execute();
	}
	public function excluir($id)
	{

		$sql = "DELETE FROM clientes WHERE MD5(id_cliente ) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function excluirByIdIndicador($id)
	{
		$sql = "DELETE FROM clientes WHERE MD5(id_indicador) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function updatePass($id)
	{
		$sql = "UPDATE clientes SET senha = :senha WHERE MD5(id_cliente) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':senha', $this->senha);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	public function isLogged()
	{
		if (isset($_SESSION['clogin']) && !empty($_SESSION['clogin'])) {

			$sql = "SELECT * FROM clientes WHERE MD5(id_cliente) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $_SESSION['clogin']);

			$sql->execute();
			if ($sql->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function logout()
	{
		if (!empty($_SESSION['clogin'])) {
			unset($_SESSION['clogin']);
		}
	}

	public function fazerLogin($email, $senha)
	{
		//tipo 1 - Vendedor, tipo 3 - Vendedor e cliente
		$sql = "SELECT * FROM clientes WHERE (email_cliente = :email AND senha = :senha AND tipo = 1) OR (email_cliente = :email AND senha = :senha AND tipo = 3)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":senha", $senha);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$id = $sql['id_cliente'];
			$_SESSION['clogin'] = md5($id);
			return true;
		} else {
			return false;
		}
	}

	public function getNome()
	{

		$sql = "SELECT * FROM clientes WHERE MD5(id_cliente) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $_SESSION['clogin']);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['nome_cliente'];
		} else {
			return '';
		}
	}

	public function getTotalClientesByIdVendedor($idVendedor)
	{
		$sql = "SELECT COUNT(*) AS t FROM clientes WHERE id_indicador = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $idVendedor);
		$sql->execute();
		$sql = $sql->fetch();
		return $sql['t'];
	}

	public function trocaDePlano($id_cliente, $tipo_comissao)
	{
		$sql = "UPDATE clientes SET tipo_comissao = :tipo_comissao WHERE id_cliente = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":tipo_comissao", $tipo_comissao);
		$sql->bindValue(":id", $id_cliente);
		$sql->execute();

		$sql = "UPDATE clientes SET tipo_comissao = :tipo_comissao WHERE id_indicador = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":tipo_comissao", $tipo_comissao);
		$sql->bindValue(":id", $id_cliente);
		$sql->execute();
	}

	public function pegarComissaoMes($id_vendedor, $mes, $ano)
	{

		$array = [];
		$sql = "CALL sp_clientes_relatorio(:id_vendedor, :mes, :ano)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_vendedor', $id_vendedor);
		$sql->bindValue(':mes', $mes);
		$sql->bindValue(':ano', $ano);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function montarObj($item)
	{

		$plano = new Plano();
		$estadocivil = new EstadoCivil();
		$negocio = new NegocioHandler();
		$banco = new DadosBancariosHandler();
		$enderecos = new Enderecos();
		$array = $item;
		$array['plano'] = $plano->getPlanoById($item['id_plano']);
		$array['estadoCivil'] = $estadocivil->getEstadoCivilById($item['id_estadocivil']);
		$array['negocio'] = $negocio->getNegocioById($item['id_negocio']);
		$array['banco'] = $banco->getBancoByIdCliente($item['id_cliente']);
		$array['endereco'] = $enderecos->getEnderecoByIdCliente($item['id_cliente']);
		$array['tipoCliente'] = $this->getTipoCliente($item);
		return $array;
	}

	/**
	 * Carrega a árvore até o nível setado a partir do 1º filho do cliente selecionado
	 */
	public function listarArvore($id, $limite, $subtotal = 0)
	{

		$array = array();

		$sql = "SELECT * FROM clientes WHERE id_indicador = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$niveis = new Niveis();
			$tniveis = $niveis->getTotal();
			$nivel = floatval($tniveis - $limite); // Soma-se - 1 por ser array
			$infoNivel = $niveis->getNivelByNivel($nivel);
			$array = $sql->fetchAll(PDO::FETCH_ASSOC);
			/** 
			 *  - lista as informações do cliente com os filhos e seu faturamento no mês pago. 
			 */
			foreach ($array as $key => $cliente) {
				// Chama o faturamento do cliente dentro do nível
				$faturamento = new Faturamento();
				$infoFatu = $faturamento->getFaturamentoPaidMonthByCliente($cliente['id_cliente'], date("m"));

				// Variável inicial de informações de comissao
				$listaFatu = [
					'valor' => 0,
					'comissao' => 0,
					'subtotal' => 0
				];
				$v_subtotal = 0;
				// Se houver informações de faturamento
				if (count($infoFatu) > 0) {
					$v_subtotal = number_format(($infoFatu[0]['valor'] * $infoNivel['valor_comissao']) / 100, 2);
					$listaFatu = [
						'valor' => $infoFatu[0]['valor'],
						'comissao' => $infoNivel['valor_comissao'],
						'subtotal' => $v_subtotal
					];
				}
				//Montagem complementar do arrya com informações de níveis, filhos e faturamento
				$subtotal += $v_subtotal;
				$array[$key]['nivel'] = $nivel;
				$array[$key]['filhos'] = [];
				$array[$key]['faturamento'] = $listaFatu;
				if ($limite > 0) {
					// Se houver filhos faz a lista
					$array[$key]['filhos'] = $this->listarArvore($cliente['id_cliente'], $limite - 1, $subtotal);
				}
			}
		}
		return $array;
	}

	/**
	 * Exibi a lista da árvore em html
	 */
	public function exibir($array)
	{

		echo '<ul class="arvore">';
		foreach ($array as $usuario) {
			$comissao = 'R$ ' . number_format($usuario['faturamento']['subtotal'], 2, ",", ".");
			$nivel = intval($usuario['nivel']);
			echo '<li><div class="usuario"><i class="material-icons">account_circle</i><strong>' . $usuario['id_cliente'] . '-' . $usuario['nome_cliente'] . '</strong> - (' . count($usuario['filhos']) . ' diretos) - ' . $nivel . ' - <span class="comission">' . $comissao . '</span></div>';
			if (count($usuario['filhos']) > 0) {
				$this->exibir($usuario['filhos']);
			}
			echo '</li>';
		}
		echo '</ul>';
	}

	public function calculo($array, $subtotal = 0)
	{

		foreach ($array as $key => $item) {
			$subtotal += $item['faturamento']['subtotal'];
			if (count($item['filhos']) > 0) {
				$this->calculo($item['filhos'], $subtotal);
			}
		}
		echo $subtotal . '<br>';
		return $subtotal;
	}

	// Clientes cadastrados no mes atual
	public function getTotalClientesByMonth($month = '')
	{
		$mes = date('m');
		if (!empty($month)) {
			$mes = $month;
		}
		$sql = "SELECT COUNT(*) as t FROM clientes WHERE MONTH(data_cadastro) = :mes";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':mes', $mes);
		$sql->execute();
		$sql = $sql->fetch();
		return $sql['t'];
	}
	/**
	 * Pegas os clientes pelo id_indicador
	 */
	public function getClienteByIdIndicador($id_indicador, $offset, $limit)
	{
		$array = [];
		$sql = "SELECT * FROM clientes WHERE id_indicador = :id_indicador ORDER BY id_cliente DESC LIMIT $offset, $limit";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_indicador", $id_indicador);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$list = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach ($list as $key => $item) {
				$plano = new Plano();
				$estadocivil = new EstadoCivil();
				$negocio = new NegocioHandler();
				$array[] = $item;
				$array[$key]['plano'] = $plano->getPlanoById($item['id_plano']);
				$array[$key]['estadoCivil'] = $estadocivil->getEstadoCivilById($item['id_estadocivil']);
				$array[$key]['negocio'] = $negocio->getNegocioById($item['id_negocio']);
			}
		}
		return $array;
	}

	public function getClienteTotalByIndicador($id_indicador)
	{
		$sql = "SELECT COUNT(*) as t FROM clientes WHERE id_indicador = :id_indicador";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_indicador", $id_indicador);
		$sql->execute();
		$sql = $sql->fetch();
		return $sql['t'];
	}

	private function getTipoCliente($cliente)
	{
		if (!empty($cliente['id_indicador']) && !empty($cliente['parentesco'])) {
			return 'Dependente';
		} elseif (empty($cliente['id_indicador']) && empty($cliente['parentesco'])) {
			return 'Vandedor';
		} else {
			return 'Titular';
		}
	}
}
