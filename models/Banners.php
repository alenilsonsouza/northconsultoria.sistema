<?php 
class Banners extends model{

	private $id;
	private $nome_banner;
	private $url;
	private $ordem;
	private $tela;
	private $id_arquivo;
	private $array;


	public function __construct($id=''){
		parent:: __construct();

		if(!empty($id)){
			$this->array = array();
			$sql = "SELECT *, banner_imagem.id as id_banner, arquivos.id as id_arq FROM banner_imagem LEFT JOIN arquivos ON banner_imagem.id_arquivo = arquivos.id WHERE MD5(banner_imagem.id) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();
			if($sql->rowCount()>0){
				$this->array = $sql->fetch();
			}
		}else{
			$this->array = array();
			$sql = "SELECT *, banner_imagem.id as id_banner, arquivos.id as id_arq FROM banner_imagem LEFT JOIN arquivos ON banner_imagem.id_arquivo = arquivos.id ORDER BY banner_imagem.tela ASC, banner_imagem.ordem ASC";
			$sql = $this->db->query($sql);
			if($sql->rowCount()>0){
				$this->array = $sql->fetchAll();
			}
		}

	}

	public function getId(){return $this->id;}
	public function getNomeBanner(){return $this->nome_banner;}
	public function getUrl(){return $this->url;}
	public function getOrdem(){return $this->ordem;}
	public function getTela(){return $this->tela;}
	public function getArray(){return $this->array;}

	public function setNomeBanner($v){
		if(filter_var($v, FILTER_SANITIZE_STRING)){
			$v = strip_tags($v);
			$this->nome_banner = $v;
			return true;
		}else{
			return false;
		}
	}

	public function setUrl($v){
		if(filter_var($v, FILTER_VALIDATE_URL)){
			$this->url = $v;
			return true;
		}else{
			return false;
		}
	}
	public function setOrdem($v){
		if(filter_var($v, FILTER_VALIDATE_INT)){
			$this->ordem = $v;
			return true;
		}else{
			return false;
		}
	}

	public function setTela($n){
		if(filter_var($n, FILTER_VALIDATE_INT)){
			$this->tela = $n;
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
	public function salvar($id = ''){
		if(!empty($id)){

			$sql = "UPDATE banner_imagem SET nome_banner = :nome_banner, url = :url, ordem = :ordem WHERE MD5(id) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":nome_banner", $this->nome_banner);
			$sql->bindValue(":url", $this->url);
			$sql->bindValue(":ordem", $this->ordem);
			$sql->bindValue(":id", $id);
			$sql->execute();

		}else{
			$sql = "INSERT INTO banner_imagem (id_arquivo, nome_banner, url, ordem, tela) VALUES (:id_arquivo, :nome_banner, :url, :ordem, :tela)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id_arquivo", $this->id_arquivo);
			$sql->bindValue(":nome_banner", $this->nome_banner);
			$sql->bindValue(":url", $this->url);
			$sql->bindValue(":ordem", $this->ordem);
			$sql->bindValue(":tela", $this->tela);
			$sql->execute();

		}


	}
	public function excluirBanner($id){
		$sql = 	"DELETE FROM banner_imagem WHERE MD5(id) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function atualizarOrdemBanner($ordem, $id_banner){

		$total = count($id_banner);

		for($i = 0; $i < $total; $i++){

			$sql = "UPDATE banner_imagem SET ordem = :ordem WHERE MD5(id) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":ordem", $ordem[$i]);
			$sql->bindValue(":id", $id_banner[$i]);
			$sql->execute();
		}
	}

	public function totalBanners(){

		$sql = "SELECT COUNT(*) AS total FROM banner_imagem";
		$sql = $this->db->query($sql);
		$sql = $sql->fetch();
		return $sql['total'];
	}

	public function textoTela($n){
		if($n == 1){
			return "Desktop";
		}elseif($n == 2){
			return "Mobile";
		}
	}


}