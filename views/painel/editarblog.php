<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelblog">Voltar</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
	<div class="col s12"> 
		<h5>Editar Blog <?php echo $blog['titulo_blog'];?></h5>
	</div>
</div>

<div class="row">
	<form class="col s12" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col s6 input-field">
				<input type="text" name="titulo_blog" required="required" value="<?php echo $blog['titulo_blog'];?>">
				<label for="titulo_blog">Título:</label>
			</div>
			<div class="col s2 input-field">
				<img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $blog['url_arquivo'];?>" style="width: 100%">
			</div>
			<div class="col s4 input-field file-field">
				<div class="btn">
			        <span>Trocar Imagem:</span>
			        <input type="file" name="imagem">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
				</div>
		</div>
		<div class="col s12 input-field">
			<textarea id="meta_description" class="materialize-textarea" name="meta_description"><?php echo $blog['meta_description_blog'];?></textarea>
          	<label for="meta_description">Breve Descrição (SEO):</label>
		</div>
		<div class="col s12 input-field">
			<textarea id="corpo" name="texto"><?php echo stripslashes($blog['texto_blog']);?></textarea>
		</div>
		<div class="row">
	      <div class="input-field col s12">
	      	<input type="hidden" name="id_imagem" value="<?php echo md5($blog['id_imagem']);?>">
	        <input type="submit" value="Atualizar" class="btn">
	        <input type="submit" value="Atualizar e concluir" class="btn" name="concluir">
	      </div>
	    </div>
	</form>
</div>
<script type="text/javascript" src="<?php echo BASE_URL;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  window.onload=function(){
    CKEDITOR.replace("corpo");
  }
</script>