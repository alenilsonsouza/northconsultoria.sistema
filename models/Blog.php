<?php
class Blog extends model{

	private $titulo_blog;
	private $slug_blog;
	private $data_cadastro_blog;
	private $data_atualizacao_blog;
	private $texto_blog;
	private $meta_description_blog;
	private $id_imagem;
	private $array;

	public function __construct($id = ''){
		parent:: __construct();
		$this->array = array();
		if(!empty($id)){

			$sql = "SELECT * FROM blog LEFT JOIN arquivos ON blog.id_imagem = arquivos.id WHERE MD5(blog.id_blog) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":id", $id);
			$sql->execute();
			if($sql->rowCount()>0){
				$this->array = $sql->fetch();
			}
		}


	}

	public function setTituloBlog($titulo){

		if(filter_var($titulo, FILTER_SANITIZE_STRING)){
			$this->titulo_blog = $titulo;
		}
	}

	public function setSlugBlog($slug){
		if(filter_var($slug, FILTER_SANITIZE_STRING)){
			$this->slug_blog = $slug;
		}
	}

	public function setDataCadastroBlog($data){
		if(filter_var($data, FILTER_SANITIZE_STRING)){
			$this->data_cadastro_blog = $data;
		}
	}

	public function setDataAtualizacao($data){
		if(filter_var($data, FILTER_SANITIZE_STRING)){
			$this->data_atualizacao_blog = $data;
		}
	}

	public function setTextoBlog($texto){
		if(filter_var($texto, FILTER_SANITIZE_STRING)){
			$this->texto_blog = $texto;
		}
	}

	public function setMetaDescriptionBlog($texto){
		if(filter_var($texto, FILTER_SANITIZE_STRING)){
			$this->meta_description_blog = $texto;
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

	public function getBlogs($offset, $limite){
		$array = array();
		$sql = "SELECT * FROM blog LEFT JOIN arquivos ON blog.id_imagem = arquivos.id ORDER BY blog.id_blog DESC LIMIT $offset, $limite";
		$sql = $this->db->query($sql);
		if($sql->rowCount()>0){
			$array = $sql->fetchAll();
		}
		return $array;

	}

	public function getTotal(){

		$sql = "SELECT COUNT(*) as t FROM blog";
		$sql = $this->db->query($sql);
		$sql = $sql->fetch();
		return $sql['t'];
	}

	public function salvar($id=''){

		if(!empty($id)){

			$sql = "UPDATE blog SET titulo_blog = :titulo_blog, slug_blog = :slug_blog, meta_description_blog = :meta_description_blog, data_atualizacao_blog = :data_atualizacao_blog, texto_blog = :texto_blog WHERE MD5(id_blog) = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":titulo_blog", $this->titulo_blog);
			$sql->bindValue(":slug_blog", $this->slug_blog);
			$sql->bindValue(":meta_description_blog", $this->meta_description_blog);
			$sql->bindValue(":data_atualizacao_blog", $this->data_atualizacao_blog);
			$sql->bindValue(":texto_blog", $this->texto_blog);
			$sql->bindValue(":id", $id);
			$sql->execute();

		}else{

			$sql = "INSERT INTO blog (titulo_blog, slug_blog, meta_description_blog, data_cadastro_blog, texto_blog, id_imagem) VALUES (:titulo_blog, :slug_blog, :meta_description_blog, :data_cadastro_blog, :texto_blog, :id_imagem)";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(":titulo_blog", $this->titulo_blog);
			$sql->bindValue(":slug_blog", $this->slug_blog);
			$sql->bindValue(":meta_description_blog", $this->meta_description_blog);
			$sql->bindValue(":data_cadastro_blog", $this->data_cadastro_blog);
			$sql->bindValue(":texto_blog", $this->texto_blog);
			$sql->bindValue(":id_imagem", $this->id_imagem);
			$sql->execute();
		}

	}

	public function excluirBlog($id){

		$sql = "DELETE FROM blog WHERE MD5(id_blog) = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
}