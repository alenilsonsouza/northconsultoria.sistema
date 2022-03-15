<?php
class Suporte extends model{

	private $assunto_suporte;
	private $descricao;
	private $id_suporte;
	private $id_arquivo;
	private $tipo_suporte;
	private $data_hora;
	private $id_usuario;
	private $array;

	public function __construct($id = ''){
		parent:: __construct();
		$this->array = array();
		if(!empty($id)){
			$sql = "SELECT *, suporte.id as idsuporte FROM suporte 
			LEFT JOIN usuarios ON suporte.id_usuario = usuarios.id 
			LEFT JOIN arquivos ON arquivos.id = suporte.id_arquivo 
			WHERE MD5(suporte.id) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();
			if($sql->rowCount()>0){
				$this->array = $sql->fetch();
			}
		}
	}

	public function setAssuntoSuporte($a){
		if(filter_var($a, FILTER_SANITIZE_STRING)){
			$this->assunto_suporte = $a;
		}
	}
	public function setDescricao($d){
		if(filter_var(FILTER_SANITIZE_STRING)){
			$this->descricao = $d;
		}
	}
	public function setIdSuporte($suporte){
		if(filter_var($suporte, FILTER_VALIDATE_INT)){
			$this->id_suporte = $suporte;
		}else{
			$this->id_suporte = 0;
		}
	}
	public function setIdArquivo($arquivo){
		if(filter_var($arquivo, FILTER_VALIDATE_INT)){
			$this->id_arquivo = $arquivo;
		}
	}
	public function setTipoSuporte($tipo){
		if(filter_var($tipo, FILTER_VALIDATE_INT)){
			$this->tipo_suporte = $tipo;
		}
	}
	public function setDataHora($datahora){
		$this->datahora = $datahora;
	}
	public function setIdUsuario($idusuario){
		if(filter_var($idusuario, FILTER_VALIDATE_INT)){
			$this->id_usuario = $idusuario;
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

	public function salvar(){


		$datahora = date("Y-m-d H:i:s");
		

		$sql = "INSERT INTO suporte (assunto_suporte, descricao, tipo_suporte, data_hora, id_suporte, id_arquivo, id_usuario) 
		VALUES (:assunto_suporte, :descricao, :tipo_suporte, :data_hora, :id_suporte, :id_arquivo, :id_usuario)";

		$sql = $this->db->prepare($sql);
		$sql->bindValue(":assunto_suporte", $this->assunto_suporte);
		$sql->bindValue(":descricao", $this->descricao);
		$sql->bindValue(":tipo_suporte", $this->tipo_suporte);
		$sql->bindValue(":data_hora", $datahora);
		$sql->bindValue(":id_suporte", $this->id_suporte);
		$sql->bindValue(":id_arquivo", $this->id_arquivo);
		$sql->bindValue(":id_usuario", $this->id_usuario);
		$sql->execute();
	}

	public function getSuporte($id_usuario, $offset, $limit){
		$array = array();
		if($id_usuario != 1){
			$sql = "SELECT *, suporte.id as idsuporte FROM suporte 
			LEFT JOIN usuarios ON suporte.id_usuario = usuarios.id 
			LEFT JOIN arquivos ON arquivos.id = suporte.id_arquivo 
			WHERE suporte.id_usuario = :id_usuario AND suporte.id_suporte = 0
			ORDER BY suporte.id DESC LIMIT $offset, $limit";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_usuario", $id_usuario);
			$sql->execute();
			if($sql->rowCount()>0){
				$array = $sql->fetchAll();
			}
		}else{
			$sql = "SELECT *, suporte.id as idsuporte FROM suporte 
			LEFT JOIN usuarios ON suporte.id_usuario = usuarios.id
			LEFT JOIN arquivos ON arquivos.id = suporte.id_arquivo 
			WHERE suporte.id_suporte = 0
			ORDER BY suporte.id DESC LIMIT $offset, $limit";
			$sql = $this->db->query($sql);
			if($sql->rowCount()>0){
				$array = $sql->fetchAll();
			}

		}

		return $array;
		
	}
	public function getTotal($id_usuario){
		if($id_usuario != 1){
			$sql = "SELECT COUNT(*) as t FROM suporte 
			WHERE suporte.id_usuario = :id_usuario AND suporte.id_suporte = 0";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_usuario", $id_usuario);
			$sql->execute();
			$sql = $sql->fetch();
			return $sql['t'];
		}else{
			$sql = "SELECT COUNT(*) as t FROM suporte 
			WHERE suporte.id_suporte = 0";
			$sql = $this->db->query($sql);
			$sql = $sql->fetch();
			return $sql['t'];

		}
	}

	public function getResposta($id_suporte){

		$array = array();

		$sql = "SELECT *, suporte.id as idsuporte FROM suporte 
			LEFT JOIN usuarios ON suporte.id_usuario = usuarios.id 
			LEFT JOIN arquivos ON arquivos.id = suporte.id_arquivo 
			WHERE suporte.id_suporte = :id_suporte
			ORDER BY suporte.id DESC";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_suporte", $id_suporte);
		$sql->execute();
		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function tipoSuporte($n){
		/*
		1- Relatar um erro
		2- Sugestão
		3- Crítica
		4- Solução
		5- Resolvido
		*/

		switch ($n) {
			case 1:
				return "Relatar um erro";
				break;
			case 2:
				return "Sugestão";
				break;
			case 3:
				return "Crítica";
				break;
			case 4:
				return "Solução";
				break;
			case 5:
				return "Resolvido";
				break;
		}
	}
}