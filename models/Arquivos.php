<?php 
class Arquivos extends model{

	private $id;
	private $nome_arquivo;
	private $url_arquivo;
	private $data_cadastro;
	private $tamanho_mb;
	private $tipo;
	private $largura;
	private $altura;
	private $tmp_name;

	public function __construct(){
		parent:: __construct();
	}

	public function guardarImagem($arquivo){

		$this->SetNomeArquivo($arquivo['name']);
		$this->data_cadastro = date('Y-m-d');
		$this->tamanho_mb = $arquivo['size'];
		$this->tipo = $arquivo['type'];
		$this->tmp_name = $arquivo['tmp_name'];

		if(!empty($arquivo['tmp_name'])){
			$tamanho = getimagesize($this->tmp_name);
		}
		
		if($this->verificarTamanho($this->tamanho_mb) == false){
			$retorno = $this->upload();
			$upload = $retorno['upload'];
			$nome = $retorno['nome'];
		}else{
			$upload = 0;
		}
		

		if($upload == 1){
			
			$sql = "INSERT INTO arquivos (nome_arquivo, url_arquivo, data_cadastro, tamanho_mb, tipo, largura, altura) 
			VALUES (:nome_arquivo, :url_arquivo, :data_cadastro, :tamanho_mb, :tipo, :largura, :altura)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_arquivo", $this->nome_arquivo);
			$sql->bindValue(":url_arquivo", $nome);
			$sql->bindValue(":data_cadastro", $this->data_cadastro);
			$sql->bindValue(":tamanho_mb", $this->tamanho_mb);
			$sql->bindValue(":tipo", $this->tipo);
			$sql->bindValue(":largura", $tamanho[0]);
			$sql->bindValue("altura", $tamanho[1]);
			$sql->execute();

			$id = $this->db->lastInsertId();
			return $id;
		}else{
			return 0;
		}


	}

	public function atualizaArquivo($id_arquivo, $arquivo){

		

		if(!empty($arquivo['name'])){
			$sql = "SELECT * FROM arquivos WHERE MD5(id) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id",$id_arquivo);
			$sql->execute();
			if($sql->rowCount()>0){
				$sql= $sql->fetch();

				if(file_exists('assets/arquivos/'.$sql['url_arquivo'])){
					unlink('assets/arquivos/'.$sql['url_arquivo']);
				}
			}
			$this->SetNomeArquivo($arquivo['name']);
			$this->data_cadastro = date('Y-m-d');
			$this->tamanho_mb = $arquivo['size'];
			$this->tipo = $arquivo['type'];
			$this->tmp_name = $arquivo['tmp_name'];


			$tamanho = getimagesize($this->tmp_name);
			
			$retorno = $this->upload();
			$upload = $retorno['upload'];
			$nome = $retorno['nome'];

			if($upload == 1){
				$sql = "UPDATE arquivos SET nome_arquivo = :nome_arquivo, url_arquivo = :url_arquivo, tamanho_mb = :tamanho_mb, tipo = :tipo, largura = :largura, altura = :altura WHERE MD5(id) = :id";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":nome_arquivo", $this->nome_arquivo);
				$sql->bindValue(":url_arquivo", $nome);
				$sql->bindValue(":tamanho_mb", $this->tamanho_mb);
				$sql->bindValue(":tipo", $this->tipo);
				$sql->bindValue(":largura", $tamanho[0]);
				$sql->bindValue("altura", $tamanho[1]);
				$sql->bindValue(":id", $id_arquivo);
				$sql->execute();

			}
		}

	}

	public function guardavideo($arquivo){

		$this->SetNomeArquivo($arquivo['name']);
		$this->data_cadastro = date('Y-m-d');
		$this->tamanho_mb = $arquivo['size'];
		$this->tipo = $arquivo['type'];
		$this->tmp_name = $arquivo['tmp_name'];

		if($this->tipo == "video/mp4"){
			$nome = md5(rand(0,999).time()).".mp4";
			move_uploaded_file($this->tmp_name, "assets/arquivos/".$nome);
			$upload = 1;
		}else{
			$upload = 0;
		}

		if($upload == 1){
			$sql = "INSERT INTO arquivos (nome_arquivo, url_arquivo, data_cadastro, tamanho_mb, tipo) 
			VALUES (:nome_arquivo, :url_arquivo, :data_cadastro, :tamanho_mb, :tipo)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_arquivo", $this->nome_arquivo);
			$sql->bindValue(":url_arquivo", $nome);
			$sql->bindValue(":data_cadastro", $this->data_cadastro);
			$sql->bindValue(":tamanho_mb", $this->tamanho_mb);
			$sql->bindValue(":tipo", $this->tipo);
			$sql->execute();
			$id = $this->db->lastInsertId();
			return $id;
		}else{
			return 0;
		}



	}
	
	public function atualizaVideo($id_arquivo, $arquivo){

		$sql = "SELECT * FROM arquivos WHERE MD5(id) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id",$id_arquivo);
		$sql->execute();
		if($sql->rowCount()>0){
			$sql= $sql->fetch();

			if(file_exists('assets/arquivos/'.$sql['url_arquivo'])){
				unlink('assets/arquivos/'.$sql['url_arquivo']);
			}
		}

		if(!empty($arquivo['name'])){
			$this->SetNomeArquivo($arquivo['name']);
			$this->data_cadastro = date('Y-m-d');
			$this->tamanho_mb = $arquivo['size'];
			$this->tipo = $arquivo['type'];
			$this->tmp_name = $arquivo['tmp_name'];

			
			if($this->tipo == "video/mp4"){
				$nome = md5(rand(0,999).time()).".mp4";
				move_uploaded_file($this->tmp_name, "assets/arquivos/".$nome);
				$upload = 1;
			
			}else{
					$upload = 0;
			}

			if($upload == 1){
				$sql = "UPDATE arquivos SET nome_arquivo = :nome_arquivo, url_arquivo = :url_arquivo, tamanho_mb = :tamanho_mb, tipo = :tipo WHERE MD5(id) = :id";
				$sql = $this->db->prepare($sql);
				$sql->bindValue(":nome_arquivo", $this->nome_arquivo);
				$sql->bindValue(":url_arquivo", $nome);
				$sql->bindValue(":tamanho_mb", $this->tamanho_mb);
				$sql->bindValue(":tipo", $this->tipo);
				$sql->bindValue(":id", $id_arquivo);
				$sql->execute();

			}
		}

	}

	private function verificarTamanho($tamanho){
		$t = (intval($tamanho)/1024)/1024;
		if($t > 2){
			return true;
		}else{
			return false;
		}
	}

	public function SetNomeArquivo($v){
		
		if(filter_var($v, FILTER_SANITIZE_STRING)){
			$this->nome_arquivo = $v;
			return true;
		}else{
			return false;
		}
	}
	public function setUrlArquivo($v){
		if(filter_var($v, FILTER_SANITIZE_STRING)){
			$this->url_arquivo = $v;
			return true;
		}else{
			return false;
		}
	}

	public function excluirArquivo($id){
		$sql = "SELECT * FROM arquivos WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id",$id);
		$sql->execute();
		if($sql->rowCount()>0){
			$sql= $sql->fetch();

			if(file_exists('assets/arquivos/'.$sql['url_arquivo'])){
				unlink('assets/arquivos/'.$sql['url_arquivo']);
			}
		}

		$sql = "DELETE FROM arquivos WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id",$id);
		$sql->execute();

	}

	public function getArquivoById($id)
	{
		$array = [];
		$sql = "SELECT * FROM arquivos WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id",$id);
		$sql->execute();
		if($sql->rowCount()>0)
		{
			$array = $sql->fetch();
		}
		return $array;
	}

	private function upload()
	{
		$nome = '';
		if($this->tipo == "image/jpeg"){
			$nome = md5(rand(0,999).time()).".jpg";
			move_uploaded_file($this->tmp_name, "assets/arquivos/".$nome);
			$upload = 1;
		}elseif($this->tipo == "image/png"){
			$nome = md5(rand(0,999).time()).".png";
			move_uploaded_file($this->tmp_name, "assets/arquivos/".$nome);
			$upload = 1;
		}elseif($this->tipo == "image/gif"){
			$nome = md5(rand(0,999).time()).".gif";
			move_uploaded_file($this->tmp_name, "assets/arquivos/".$nome);
			$upload = 1;
		}elseif($this->tipo == "image/svg+xml"){
			$nome = md5(rand(0,999).time()).".svg";
			move_uploaded_file($this->tmp_name, "assets/arquivos/".$nome);
			$upload = 1;
		}elseif($this->tipo == "application/pdf"){
			$nome = md5(rand(0,999).time()).".pdf";
			move_uploaded_file($this->tmp_name, "assets/arquivos/".$nome);
			$upload = 1;
		}else{
			$upload = 0;
		}
		return  [
			'upload'=>$upload,
			'nome' => $nome
		];
	}
}