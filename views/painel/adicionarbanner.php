<div class="row">
	<div class="col s12">
		<h5>Adicinar Banner</h5>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<nav class="menuInterno">
			<ul>
				<li><a href="<?php echo BASE_URL;?>painelbanners">Voltar</a></li>
			</ul>
		</nav>
	</div>
</div>

<div class="row">
	<div class="col s12">
		<div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Aviso!</span>
          <?php if(!empty($aviso)):?>
          	<p><?php echo $aviso;?></p>
          	<?php else:?>
          <p><strong>Desltop:</strong> A dimensão ideal para o banner é <strong>1920px de largura</strong> e <strong>1080px de altura</strong>.</p>
          <p><strong>Mobile:</strong> A dimensão ideal para o banner é <strong>600px de largura</strong> e <strong>800px de altura</strong>.</p>
          <p>Otimize a imagem antes de enviar <a href="https://imagecompressor.com/pt/" target="_blank">clicando aqui</a>.</p>
      		<?php endif;?>
        </div>
      </div>
	</div>
</div>
<div class="row">
	<form class="col s12" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s12 m3">
				<input type="text" name="nome" id="nome" required="required">
				<label for="nome">Nome:</label>
			</div>
			<div class="input-field col s12 m3">
				<input type="url" name="url" id="url">
				<label for="url">URL:</label>
			</div>
			<div class="input-field col s12 m2">
				<input type="number" name="ordem" id="ordem" required="required" min="1" placeholder="1">
				<label for="ordem">Ordem:</label>
			</div>
			<div class="input-field col s12 m2">
				<?php $b = new Banners();?>
				<select name="tela">
					<option value="1"><?php echo $b->textoTela(1);?></option>
					<option value="2"><?php echo $b->textoTela(2);?></option>
				</select>
				<label for="tela">Tela:</label>
			</div>
			<div class="input-field file-field col s12 m2">
				<div class="btn">
			        <span>Imagem</span>
			        <input type="file" name="arquivo" required="required">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="submit" value="Cadastrar Banner" name="cadastrar" class="btn">
			</div>
		</div>
		
	</form>
</div>