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
		<h5>Adicionar Vídeo</h5>
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
          		<p>O vídeo deve ser no formato MP4.</p>
          	<?php endif;?>
        </div>
      </div>
	</div>
</div>
<div class="row">
	<form class="col s12" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s6">
				<input type="text" name="nome" required="required" id="nome">
				<label for="nome">Nome do Vídeo:</label>
			</div>
			<div class="input-field file-field col s6">
				<div class="btn">
			        <span>Vídeo</span>
			        <input type="file" name="arquivo" required="required">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			    </div>
				
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="submit" value="Cadastrar" name="cadastrar" class="btn">
			</div>
		</div>
		
	</form>
</div>