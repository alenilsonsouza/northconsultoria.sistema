<?php 
class Estado extends model{

	public function getEstados(){
		$array = array();
		$sql = "SELECT * FROM estado ORDER BY id ASC";
		$sql = $this->db->query($sql);
		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}
		return $array;
	}
}