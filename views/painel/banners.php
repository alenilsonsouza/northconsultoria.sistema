<div class="row">
	<div class="col s12">
		<h5>Banners</h5>
	</div>
</div>
<form class="row" method="post">
	<div class="input-field col s12 m2">
		<?php $c = new Config();?>
		<select name="mostrar_banner">
	      <option value="<?php echo $config['mostrar_banner'];?>"  selected><?php echo $c->getTextoMostrarBanner($config['mostrar_banner']);?></option>
	      <option value="1">Banners</option>
	      <option value="2">Vídeos</option>
	     
	    </select>
	    <label>Mostrar no site:</label>
	</div>
	<div class="input-field col s12 m10">
		<input type="submit" name="Atualizar" value="Atualizar" class="btn">
	</div>
</form>
<form class="row" method="post">
	<div class="col s12 m6">
		<div class="row">
			<div class="col s12">
				<h5>Com Imagens</h5>
		
			</div>
			<div class="col s12">
				<nav class="menuInterno">
					<ul>
						<li><a href="<?php echo BASE_URL;?>painelbanners/adicionar">Adicionar</a></li>
						<li><a href="<?php echo BASE_URL;?>" target="pagina">Ver no site</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="row">
			<?php if(count($banners) == 0):?>
				
					<div class="col s12">
						<p>Nenhum banner cadastrado.</p>
					</div>
				
			<?php else:?>
				
					<?php foreach($banners as $banner):?>

						<div class="col s12 m6">
					      <div class="card">
					        <div class="card-image">
					          <img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $banner['url_arquivo'];?>">
					          <span class="card-title"><?php echo $banner['nome_banner'];?></span>
					        </div>
					        <div class="card-content">
								<p>Dimensão: <?php echo $banner['largura'];?>x<?php echo $banner['altura'];?></p>
								<p>Tamanho: <?php echo number_format((intval($banner['tamanho_mb'])/1024),2,",",".");?>KB</p>
								<p>Tela: <?php $b = new Banners(); echo $b->textoTela($banner['tela']);?></p>
								<div class="row">
									<div class="input-field col s6">
										<input type="number" value="<?php echo $banner['ordem'];?>" min="0" name="ordem[]">
										<label for="ordem">Ordem:</label>
										<input type="hidden" value="<?php echo md5($banner['id_banner']);?>" name="id_banner[]">
									</div>
								</div>
								
					        </div>
					        <div class="card-action">
					        	<?php if(!empty($banner['url'])):?>
						        	<a href="<?php echo $banner['url'];?>" target="_blank"><i class="material-icons">link</i></a>
						        <?php endif;?>
					          <a href="<?php echo BASE_URL;?>painelbanners/editar/<?php echo md5($banner['id_banner']);?>"><i class="material-icons" title="editar">edit</i></a>
					          <a href="<?php echo BASE_URL;?>painelbanners/excluir/<?php echo md5($banner['id_banner']);?>"><i class="material-icons" title="excluir">delete</i></a>
					        </div>
					      </div>
					    </div>
					    <?php endforeach;?>
					
				
				
			<?php endif;?>
			
		</div>
		
	</div>


	<div class="col s12 m6">
		<div class="row">
			<div class="col s12">
				<h5>Com Vídeo</h5>
			</div>
		
			<div class="col s12">
				<nav class="menuInterno">
					<ul>
						<li><a href="<?php echo BASE_URL;?>painelbanners/adicionarvideo" <?php echo $existe == 1?"class='disabled btn'":'';?>>Adicionar Vídeo</a></li>
						<li><a href="<?php echo BASE_URL;?>" target="pagina">Ver no site</a></li>
					</ul>
				</nav>
			</div>
			<?php if(count($videos) == 0):?>
				<div class="col s12">
					<p>Nenhum Vídeo Cadastrado.</p>
				</div>

				<?php else:?>
			<?php foreach($videos as $video):?>
			<div class="col s12"> 
				<div class="card">
			        <div class="card-image">
			          <video autoplay loop muted class="videoBanner">
			          	<source src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $video['url_arquivo'];?>" type="video/mp4">
			          </video>
			          <span class="card-title"><?php echo $video['nome_video'];?></span>
			        </div>
			        <div class="card-action">
			        	
			          <a href="<?php echo BASE_URL;?>painelbanners/editarvideo/<?php echo md5($video['id_video']);?>"><i class="material-icons" title="editar">edit</i></a>
			          <a href="<?php echo BASE_URL;?>painelbanners/excluirvideo/<?php echo md5($video['id_video']);?>"><i class="material-icons" title="excluir">delete</i></a>
			        </div>
			      </div>
			</div>
		<?php endforeach;?>
	<?php endif;?>
		</div>
		
	</div>
	<div class="col s12">
		<input type="submit" value="Atualizar Ordem" class="btn" name="atualizar">
	</div>
</form>