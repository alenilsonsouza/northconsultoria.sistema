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
		<h5>Editar Vídeo</h5>
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
	<div class="col s6"> 
				<div class="card">
			        <div class="card-image">
			          <video autoplay loop class="videoBanner">
			          	<source src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $video['url_arquivo'];?>" type="video/mp4">
			          </video>
			          <span class="card-title"><?php echo $video['nome_video'];?></span>
			        </div>
			       
			      </div>
			</div>
	<form class="col s6" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="nome" required="required" id="nome" value="<?php echo $video['nome_video'];?>">
				<label for="nome">Nome do Vídeo:</label>
			</div>
			<div class="input-field file-field col s12">
				<div class="btn">
			        <span>Trocar Vídeo</span>
			        <input type="file" name="arquivo">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			    </div>
				
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="hidden" name="id_arquivo" value="<?php echo md5($video['id_arq']);?>">
				<input type="submit" value="Salvar" name="cadastrar" class="btn">
			</div>
		</div>
		
	</form>
</div>