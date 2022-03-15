<?php 
class Config extends model{

	private $id;
	private $mostrar_banner;
	private $array;

	public function __construct(){
		parent::__construct();
		$this->array = array();
		$sql = "SELECT * FROM config WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", 1);
		$sql->execute();
		if($sql->rowCount()>0){
			$this->array = $sql->fetch();
		}
	}

	public function setId($v){
		if(filter_var($v, FILTER_VALIDATE_INT)){
			$this->id = $v;
		}
	}
	public function setMostrarbanner($v){
		if(filter_var($v, FILTER_VALIDATE_INT)){
			$this->mostrar_banner = $v;
		}
	}
	public function setArray($v){
		$this->array = $v;
	}

	public function getId(){return $this->id;}
	public function getMostrarBanner(){return $this->mostrar_banner;}
	public function getArray(){return $this->array;}

	public function getTextoMostrarBanner($id){
		if($id == 1){
			return "Banners";
		}else{
			return "Vídeo";
		}
	}
	public function atualizar(){
		$sql = "UPDATE config SET mostrar_banner = :mostrar_banner WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":mostrar_banner", $this->mostrar_banner);
		$sql->bindValue(":id", 1);
		$sql->execute();
	}
}