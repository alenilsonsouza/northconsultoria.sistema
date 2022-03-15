<?php 
class Configuracoes extends model{

	private $id_imagem;
	private $cor_padrao;
	private $array;

	public function __construct(){
		parent:: __construct();
		$this->array = array();
		$sql = "SELECT *, configuracoes.id as idconfig FROM configuracoes LEFT JOIN arquivos ON configuracoes.id_imagem = arquivos.id WHERE configuracoes.id = 1";
		$sql = $this->db->query($sql);
		if($sql->rowCount()>0){
			$this->array = $sql->fetch();
		}
	}

	public function setIdImagem($logo){
		if(filter_var($logo, FILTER_VALIDATE_INT)){
			$this->id_imagem = $logo;
		}
	}

	public function setCorPadrao($cor){
		if(filter_var($cor, FILTER_SANITIZE_STRING)){
			$this->cor_padrao = $cor;
		}

	}
	public function setArray($array){
		$this->array = $array;
	}

	public function getIdImagem(){
		return $this->id_logo;
	}
	public function getCorPadrao(){
		return $this->cor_padrao;
	}
	public function getArray(){
		return $this->array;
	}

	public function salvar(){

		$sql = "UPDATE configuracoes SET id_imagem = :id_imagem, cor_padrao = :cor_padrao WHERE id = 1";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_imagem", $this->id_imagem);
		$sql->bindValue(":cor_padrao", $this->cor_padrao);
		$sql->execute();
	}

	public function deletarImagem(){

		$sql = "UPDATE configuracoes SET id_imagem = NULL WHERE id = 1";
		$sql = $this->db->query($sql);
		
	}
}
