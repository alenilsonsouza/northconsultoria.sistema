 <div class="row">
    <form class="col s12" method="post" enctype="multipart/form-data">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Configurações</span>
          <div class="row">
			<div class="file-field input-field col s4">
			<?php if($config['id_imagem']==0):?>
				<div class="btn">
		        <span>Adicionar Logo</span>
		        <input type="file" name="arquivo">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
			<?php else:?>
				<img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $config['url_arquivo'];?>" width="180" class="imgLogo"><br>
				<a href="<?php echo BASE_URL;?>painelconfiguracoes/removerlogo/<?php echo $config['id_imagem'];?>" class="linkLina">Remover Logo</a>
			<?php endif;?>	
		      
		    </div>
		    <div class="input-field col s4">
		    	<input type="text" name="cor_padrao" maxlength="7" value="<?php echo $config['cor_padrao'];?>">
		    	<label for="cor_padrao">Cor Padrão (Hexadecimal): Ex: #000000</label>
		    </div>
		</div>
        </div>
        <div class="card-action">
        	<div class="row">
	          <div class="input-field col s12">
					<input type="hidden" value="<?php echo $config['id_imagem'];?>" name="id_imagem">
					<input type="submit" value="Salvar" class="btn">
				</div>
			</div>
        </div>
      </div>
    </form>
  </div>



