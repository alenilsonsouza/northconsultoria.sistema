<?php 
class Enderecos extends model{

	private $table = 'n_addresses';
	private $cep;
	private $id_cliente;
	private $logradouro;
	private $numero;
	private $complemento;
	private $bairro;
	private $cidade;
	private $estado;
	private $array;

	public function __contruct(){
		parent:: __contruct();
	}

	public function setIdCliente($id_cliente){
		if(filter_var($id_cliente, FILTER_VALIDATE_INT)){
			$this->id_cliente = $id_cliente;
		}
	}

	public function setCep($cep){
		if(filter_var($cep, FILTER_SANITIZE_STRING)){
			$this->cep = $cep;
		}
	}
	public function setLogradouro($e){
		if(filter_var($e, FILTER_SANITIZE_STRING)){
			$minusculoLogradouro = strtolower($e);
			$this->logradouro = ucwords($minusculoLogradouro);
		}
	}
	public function setNumero($n){
		if(filter_var($n, FILTER_VALIDATE_INT)){
			$this->numero = $n;
		}
	}
	public function setComplemento($complemento){
		if(filter_var($complemento, FILTER_SANITIZE_STRING)){
			$m = strtolower($complemento);
			$this->complemento = ucwords($m);
		}
	}
	public function setBairro($bairro){
		if(filter_var($bairro, FILTER_SANITIZE_STRING)){
			$m = strtolower($bairro);
			$this->bairro = ucwords($m);
		}
	}
	public function setCidade($cidade){
		
			
			$this->cidade = $cidade;
		
	}
	public function setEstado($estado){
		if(filter_var($estado, FILTER_SANITIZE_STRING)){
			
			$this->estado = $estado;
		}
	}
	public function setArray($array){
		if(is_array($array)){
			$this->array = $array;
		}
	}
	public function getArray(){
		return $this->array;
	}

	public function getEnderecoByIdCliente($id_cliente)
	{
		$array =[];
		$sql = "SELECT * FROM {$this->table} WHERE id_people = :id_cliente";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_cliente', $id_cliente);
		$sql->execute();
		if($sql->rowCount()>0)
		{
			$array = $sql->fetch();
		}
		return $array;
	}

	private function verificarEnderecoByIdCliente(){

		$sql = "SELECT id FROM {$this->table} WHERE id_people = :id_cliente";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_cliente", $this->id_cliente);
		$sql->execute();
		if($sql->rowCount()>0){
			return true;
		}else{
			return false;
		}

	}

	public function salvar($id=''){

		if(!empty($id)){

			$sql = "UPDATE {$this->table} SET
			cep = :cep, logradouro = :logradouro, numero = :numero, complemento = :complemento, bairro = :bairro, cidade = :cidade, estado = :estado
			WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":cep", $this->cep);
			$sql->bindValue(":logradouro", $this->logradouro);
			$sql->bindValue(":numero", $this->numero);
			$sql->bindValue(":complemento", $this->complemento);
			$sql->bindValue(":bairro", $this->bairro);
			$sql->bindValue(":cidade", $this->cidade);
			$sql->bindValue(":estado", $this->estado);
			$sql->bindValue(":id", $id);
			$sql->execute();

		}else{

			$sql = "INSERT INTO {$this->table} (cep, logradouro, numero, complemento, bairro, cidade, estado, id_people) 
			VALUES (:cep, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, :id_cliente)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":cep", $this->cep);
			$sql->bindValue(":logradouro", $this->logradouro);
			$sql->bindValue(":numero", $this->numero);
			$sql->bindValue(":complemento", $this->complemento);
			$sql->bindValue(":bairro", $this->bairro);
			$sql->bindValue(":cidade", $this->cidade);
			$sql->bindValue(":estado", $this->estado);
			$sql->bindValue(":id_cliente", $this->id_cliente);
			$sql->execute();
		}
	}

	public function excluir($id){

		$sql = "DELETE FROM {$this->table} WHERE MD5(id) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
}
