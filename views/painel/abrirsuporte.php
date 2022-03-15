<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelsuporte">Voltar</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
	<div class="col s12"><h5>Abrir Suporte</h5></div>
</div>
<div class="row">
	<form class="col s12" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="assunto" id="assunto" required="required">
				<label for="assunto">Assunto</label>
			</div>
			<div class="input-field col s12">
				<select name="tipo_suporte">
					<?php $s = new Suporte();?>
					<option value="1"><?php echo $s->tipoSuporte(1);?></option>
					<option value="2"><?php echo $s->tipoSuporte(2);?></option>
					<option value="3"><?php echo $s->tipoSuporte(3);?></option>
					
					
				</select>
				<label for="tipo_suporte">Tipo de Surpote:</label>
			</div>
			<div class="input-field col s12">
				<textarea name="descricao" id="corpo" rows="6"></textarea>
			</div>
			<div class="file-field input-field col s12">
		      <div class="btn">
		        <span>Arquivo de print</span>
		        <input type="file" name="arquivo">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
		    </div>
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