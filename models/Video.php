<?php
class Video extends model{


	private $id;
	private $id_arquivo;
	private $nome_video;
	private $array;

	public function __construct($id = ''){
		parent::__construct();
		if(!empty($id)){

			$this->array = array();
			$sql = "SELECT *, banner_video.id as id_video, arquivos.id as id_arq FROM banner_video LEFT JOIN arquivos ON banner_video.id_arquivo = arquivos.id WHERE MD5(banner_video.id) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();
			if($sql->rowCount()>0){
				$this->array = $sql->fetch();
			}

		}else{
			$this->array = array();
			$sql = "SELECT *, banner_video.id as id_video, arquivos.id as id_arq FROM banner_video LEFT JOIN arquivos ON banner_video.id_arquivo = arquivos.id LIMIT 1";
			$sql = $this->db->query($sql);
			if($sql->rowCount()>0){
				$this->array = $sql->fetchAll();
			}
		}
	}

	public function setNomeVideo($v){
		if(filter_var($v, FILTER_SANITIZE_STRING)){
			$v = strip_tags($v);
			$this->nome_video = $v;
			return true;
		}else{
			return false;
		}
	}
	public function setIdArquivo($v){
		if(filter_var($v, FILTER_VALIDATE_INT)){
			$this->id_arquivo = $v;
			return true;

		}else{
			return false;
		}
	}
	public function getArray(){
		return $this->array;
	}

	public function salvar($id = ''){

		if(!empty($id)){
			$sql = "UPDATE banner_video SET nome_video = :nome WHERE MD5(id) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome", $this->nome_video);
			$sql->bindValue(":id", $id);
			$sql->execute();

		}else{
			$sql = "INSERT INTO banner_video (nome_video, id_arquivo) VALUES (:nome, :id_arquivo)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome", $this->nome_video);
			$sql->bindValue(":id_arquivo", $this->id_arquivo);
			$sql->execute();
		}


	}
	public function verificarExisteVideo(){
		$sql = "SELECT * FROM banner_video";
			$sql = $this->db->query($sql);
			
			if($sql->rowCount()>=1){
				return true;
			}else{
				return false;
			}
	}

	public function excluirVideo($id){
		$sql = "DELETE FROM banner_video WHERE MD5(id) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
}