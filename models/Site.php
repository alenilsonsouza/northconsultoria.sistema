<?php
class Site extends model{

	private $titulo;
	private $descricao;
	private $palavra_chave;
	private $scripts;
	private $emails;
	private $array;

	public function __construct(){
		parent:: __construct();
		$this->array = array();
		$sql = "SELECT * FROM site WHERE id = 1";
		$sql = $this->db->query($sql);
		if($sql->rowCount()>0){
			$this->array = $sql->fetch();
		}
	}

	public function getArray(){
		return $this->array;
	}

	public function setTitulo($titulo){
		if(filter_var($titulo, FILTER_SANITIZE_STRING)){
			$this->titulo = $titulo;
		}else{
			$this->titulo = '';
		}
	}
	public function setDescricao($descricao){
		if(filter_var($descricao, FILTER_SANITIZE_STRING)){
			$this->descricao = $descricao;
			
		}else{
			$this->descricao = '';
		}
	}
	public function setPalavraChave($palavra_chave){
		if(filter_var($palavra_chave, FILTER_SANITIZE_STRING)){
			$this->palavra_chave = $palavra_chave;

		}else{
			$this->palavra_chave ='';
		}
	}
	public function setScripts($script){
		if(filter_var($script, FILTER_SANITIZE_STRING)){
			$this->scripts = $script;
		}else{
			$this->scripts = "";
		}
	}
	public function setEmails($email){
		$this->emails = $email;
	}

	public function atualizar(){

		$sql = "UPDATE site SET titulo = :titulo, descricao = :descricao, palavra_chave = :palavra_chave, scripts = :scripts, emails = :emails WHERE id = 1";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":titulo", $this->titulo);
		$sql->bindValue(":descricao", $this->descricao);
		$sql->bindValue(":palavra_chave", $this->palavra_chave);
		$sql->bindValue(":scripts", $this->scripts);
		$sql->bindValue(":emails", $this->emails);
		$sql->execute();

	}

}