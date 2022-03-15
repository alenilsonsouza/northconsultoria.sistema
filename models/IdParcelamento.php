<?php 
class IdParcelamento extends model{

	private $id;
	private $data;
	private $id_faturamento;


	public function salvar(){
		$sql = "INSERT INTO idparcelamento (data) VALUES (NOW())";
		$sql = $this->db->query($sql);

		$id = $this->db->lastInsertId();

		return $id;
	}
}