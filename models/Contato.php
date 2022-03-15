<?php
class Contato extends model{

	private $nome;
	private $email;
	private $assunto;
	private $mensagem;

	public function setNome($nome){
		if(filter_var($nome, FILTER_SANITIZE_STRING)){
			$this->nome = $nome;
		}
	}

	public function setEmail($email){
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$this->email = $email;
		}
	}

	public function setAssunto($assunto){
		if(filter_var($assunto, FILTER_SANITIZE_STRING)){
			$this->assunto = $assunto;
		}
	}

	public function setMensagem($mensagem){
		if(filter_var($mensagem, FILTER_SANITIZE_STRING)){
			$this->mensagem = $mensagem;
		}
	}

	public function salvar(){

		$sql = "INSERT INTO contato (nome, email, assunto, mensagem, data) VALUES (:nome, :email, :assunto, :mensagem, NOW())";
		$sql = $this->db->prepare($sql);

		$sql->bindValue(':nome', $this->nome);
		$sql->bindValue(':email', $this->email);
		$sql->bindValue(':assunto', $this->assunto);
		$sql->bindValue(':mensagem', $this->mensagem);
		$sql->execute();

		if(ENVIRONMENT == 'production'){
			$email = new Email();
			$email->setNome($this->nome);
			$email->setEmail($this->email);
			$email->setAssunto($this->assunto);
			$email->setMensagem($this->mensagem);
			$email->enviarContato();

		}
		
	}

	public function getList($offset, $limit){
		$array = array();
		$sql = "SELECT * FROM contato ORDER BY id_contato DESC LIMIT $offset, $limit";
		$sql = $this->db->query($sql);
		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}
		return $array;
	}

	public function getTotal(){
		$sql = "SELECT COUNT(*) AS t FROM contato";
		$sql = $this->db->query($sql);
		$sql = $sql->fetch();
		return $sql['t'];
	}

	public function excluir($id){

		$sql = "DELETE FROM contato WHERE MD5(id_contato) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
}