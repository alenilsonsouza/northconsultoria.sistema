<?php 
class Imagens extends model{

	private $id;
	private $nome_imagem;
	private $tamanho_bytes;
	private $largura;
	private $altura;
	private $nome_url;
	private $id_produto;
	private $ordem;
	private $array;

	public function __construct($id_produto = ''){
		parent:: __construct();

		if(!empty($id_produto)){
			$this->array = array();
			$sql = 	"SELECT * FROM imagens WHERE MD5(id_produto) = :id_produto ORDER BY ordem ASC";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_produto", $id_produto);
			$sql->execute();
			if($sql->rowCount() > 0){
				$this->array = $sql->fetchAll();
			}
		}
		
	}

	public function setNomeImagem($nome){
		if(filter_var($nome, FILTER_SANITIZE_STRING)){
			$this->nome_imagem = $nome;
		}
	}
	public function setTamanhoBytes($t){
		if(filter_var($t, FILTER_VALIDATE_FLOAT)){
			$this->tamanho_bytes = $t;
		}
	}
	public function setLargura($largura){
		if(filter_var($largura, FILTER_VALIDATE_INT)){
			$this->largura = $largura;
		}
	}

	public function setAltura($altura){
		if(filter_var($altura, FILTER_VALIDATE_INT)){
			$this->altura = $altura;
		}
	}

	public function setNomeUrl($url){
		if(filter_var($url, FILTER_SANITIZE_STRING)){
			$this->nome_url = $url;
		}
	}
	public function setIdProduto($id){
		if(filter_var($id, FILTER_VALIDATE_INT)){
			$this->id_produto = $id;
		}
	}
	public function setOrdem($ordem){
		if(filter_var($ordem, FILTER_VALIDATE_INT)){
			$this->ordem = $ordem;
		}
	}

	public function setArray($array){
		$this->array = $array;
	}

	public function getNomeImagem(){
		return $this->nome_imagem;
	}
	public function getTamanhoBytes(){
		return $this->tamanho_bytes;
	}
	public function getLargura(){
		return $this->largura;
	}
	public function getAltura(){
		return $this->altura;
	}
	public function getNomeUrl(){
		return $this->nome_url;
	}
	public function getIdProduto(){
		return $this->id_produto;
	}
	public function getOrdem(){
		return $this->ordem;
	}
	public function getArray(){
		return $this->array;
	}

	public function salvar($imagem){

		

		if(count($imagem['tmp_name']) > 1){

			$total = count($imagem['tmp_name']);
			
		
			for($n = 0; $n < $total; $n++){


				if($imagem['type'][$n] == "image/png"){

					$extensao = "png";
					$status = true;
					
				}elseif($imagem['type'][$n] == "image/jpeg"){

					$extensao = "jpg";
					$status = true;
					
				}else{
					$status = false;
					
				}
				
				
				if($status == true){
					list($largura, $altura) = getimagesize($imagem['tmp_name'][$n]);
					$nomedoarquivo = md5(rand(0,999).time()).".".$extensao;
					move_uploaded_file($imagem['tmp_name'][$n], 'assets/arquivos/'.$nomedoarquivo);

					
					$this->setNomeUrl($nomedoarquivo);
					$this->setLargura($largura);
					$this->setAltura($altura);
					$this->setTamanhoBytes($imagem['size'][$n]);

					$sql = "INSERT INTO imagens (tamanho_bytes, largura, altura, nome_url, id_produto) VALUES (:tamanho_bytes, :largura, :altura, :nome_url, :id_produto)";
					$sql = $this->db->prepare($sql);
					$sql->bindValue(":tamanho_bytes", $this->tamanho_bytes);
					$sql->bindValue(":largura", $this->largura);
					$sql->bindValue(":altura", $this->altura);
					$sql->bindValue(":nome_url", $this->nome_url);
					$sql->bindValue(":id_produto", $this->id_produto);
					$sql->execute();
					$id_imagem = $this->db->lastInsertId();
					return $id_imagem;
				}else{
					return 0;
				}				
					
			}
			
		}else{

			if($imagem['type'] == "image/png"){

					$extensao = "png";
					$status = true;
					
				}elseif($imagem['type'] == "image/jpeg"){

					$extensao = "jpg";
					$status = true;
					
				}else{
					$status = false;
					
				}
				
				
				if($status == true){
					list($largura, $altura) = getimagesize($imagem['tmp_name']);
					$nomedoarquivo = md5(rand(0,999).time()).".".$extensao;
					move_uploaded_file($imagem['tmp_name'], 'assets/arquivos/'.$nomedoarquivo);

					
					$this->setNomeUrl($nomedoarquivo);
					$this->setLargura($largura);
					$this->setAltura($altura);
					$this->setTamanhoBytes($imagem['size']);

					$sql = "INSERT INTO imagens (tamanho_bytes, largura, altura, nome_url, id_produto) VALUES (:tamanho_bytes, :largura, :altura, :nome_url, :id_produto)";
					$sql = $this->db->prepare($sql);
					$sql->bindValue(":tamanho_bytes", $this->tamanho_bytes);
					$sql->bindValue(":largura", $this->largura);
					$sql->bindValue(":altura", $this->altura);
					$sql->bindValue(":nome_url", $this->nome_url);
					$sql->bindValue(":id_produto", $this->id_produto);
					$sql->execute();
					$id_imagem = $this->db->lastInsertId();
					return $id_imagem;
				}else{
					return 0;
				}

		}



	}

	public function alterarNomes($id){
		$sql = "UPDATE imagens SET nome_imagem = :nome_imagem, ordem = :ordem WHERE MD5(id) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":nome_imagem", $this->nome_imagem);
		$sql->bindValue(":ordem", $this->ordem);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function excluir($id){

		$sql = "DELETE FROM imagens WHERE MD5(id) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function getImagemById($id){
		$array = array();
		$sql = "SELECT * FROM imagens WHERE MD5(id) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
		if($sql->rowCount()>0){
			$array = $sql->fetch();
		}
		return $array;
	}

	public function excluirByIdProduto($id){
		$sql = "DELETE FROM imagens WHERE MD5(id_produto) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function totalImagensByIdProduto($id){

		$sql = "SELECT COUNT(*) as t FROM imagens WHERE id_produto = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
		$sql = $sql->fetch();
		return $sql['t'];
	}
}