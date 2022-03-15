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
		<h5>Adicionar Blog</h5>
	</div>
</div>

<div class="row">
	<form class="col s12" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col s6 input-field">
				<input type="text" name="titulo_blog" required="required">
				<label for="titulo_blog">Título:</label>
			</div>
			<div class="col s6 input-field file-field">
				<div class="btn">
			        <span>Imagem Destaque:</span>
			        <input type="file" name="imagem" required="required">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
				</div>
		</div>
		<div class="col s12 input-field">
			<textarea id="meta_description" class="materialize-textarea" name="meta_description" required="required"></textarea>
          	<label for="meta_description">Breve Descrição (SEO):</label>
		</div>
		<div class="col s12 input-field">
			<textarea id="corpo" name="texto"></textarea>
		</div>
		<div class="row">
	      <div class="input-field col s12">
	        <input type="submit" value="Cadastrar" class="btn">
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