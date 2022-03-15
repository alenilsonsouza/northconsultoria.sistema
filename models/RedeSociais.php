<?php
class RedeSociais extends model{
	private $nome_rede;
	private $link_rede;
	private $id_imagem;
	private $array;

	public function __construct($id =''){
		parent:: __construct();
		if(!empty($id)){
			$this->array = array();
			$sql = "SELECT * FROM redes_sociais 
			LEFT JOIN arquivos ON redes_sociais.id_imagem = arquivos.id 
			WHERE MD5(redes_sociais.id_rede) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();
			if($sql->rowCount()>0){
				$this->array = $sql->fetch();
			}
		}else{

			$this->array = array();
			$sql = "SELECT * FROM redes_sociais 
			LEFT JOIN arquivos ON redes_sociais.id_imagem = arquivos.id 
			ORDER BY redes_sociais.id_rede DESC";
			$sql = $this->db->query($sql);
			if($sql->rowCount()>0){
				$this->array = $sql->fetchAll();
			}
		}
		
		


	}

	public function setNomeRede($nome){
		if(filter_var($nome, FILTER_SANITIZE_STRING)){
			$this->nome_rede = $nome;
		}
	}
	public function setLinkRede($link){
		if(filter_var($link, FILTER_VALIDATE_URL)){
			$this->link_rede = $link;
		}
	}
	public function setIdImagem($id){
		if(filter_var($id, FILTER_VALIDATE_INT)){
			$this->id_imagem = $id;
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

	public function salvar($id = ''){
		if(!empty($id)){

			$sql = "UPDATE redes_sociais SET nome_rede = :nome_rede, link_rede = :link_rede WHERE MD5(id_rede) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_rede", $this->nome_rede);
			$sql->bindValue(":link_rede", $this->link_rede);
			$sql->bindValue(":id", $id);
			$sql->execute();

		}else{
			$sql = "INSERT INTO redes_sociais (nome_rede, link_rede, id_imagem) VALUES (:nome_rede, :link_rede, :id_imagem)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_rede", $this->nome_rede);
			$sql->bindValue(":link_rede", $this->link_rede);
			$sql->bindValue(":id_imagem", $this->id_imagem);
			$sql->execute(); 
		}
	}

	public function getTotal(){

		$sql = "SELECT COUNT(*) as t FROM redes_sociais";
		$sql = $this->db->query($sql);
		$sql = $sql->fetch();
		return $sql['t'];
	}

	public function excluirById($id){

		$sql = "DELETE FROM redes_sociais WHERE MD5(id_rede) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
}