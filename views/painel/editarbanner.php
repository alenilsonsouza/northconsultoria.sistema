<div class="row">
	<div class="col s12">
		<nav class="menu-interno">
			<ul>
				<li><a href="<?php echo BASE_URL;?>painelbanners">Voltar</a></li>
			</ul>
		</nav>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<h5>Editar Banner</h5>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Aviso!</span>
          <p>A dimensão ideal para o banner é <strong>1920px de largura</strong> e <strong>1080px de altura</strong>.</p>
        </div>
      </div>
	</div>
</div>
<div class="row">
	<div class="col s12 m6">
      <div class="card">
        <div class="card-image">
          <img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $banner['url_arquivo'];?>">
          <span class="card-title"><?php echo $banner['nome_banner'];?></span>
        </div>
        <div class="card-content">
			<p>Dimensão: <?php echo $banner['largura'];?>x<?php echo $banner['altura'];?></p>
        </div>
        
      </div>
    </div>
	<form class="col s12 m6" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="nome" id="nome" required="required" value="<?php echo $banner['nome_banner'];?>">
				<label for="nome">Nome:</label>
			</div>
			<div class="input-field col s12">
				<input type="url" name="url" id="url" value="<?php echo $banner['url'];?>">
				<label for="url">URL:</label>
			</div>
			<div class="input-field col s12">
				<input type="number" name="ordem" id="ordem" required="required" min="1" placeholder="1" value="<?php echo $banner['ordem'];?>">
				<label for="ordem">Ordem:</label>
			</div>
			<div class="input-field file-field col s12">
				<div class="btn">
			        <span>Trocar Imagem</span>
			        <input type="file" name="arquivo">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="hidden" value="<?php echo md5($banner['id_arquivo']);?>" name="id_arquivo">
				<input type="submit" value="Salvar" name="salvar" class="btn">
			</div>
		</div>
		
	</form>
</div>