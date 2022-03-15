<?php if(!empty($aviso)):?>
	<div class="row">
    <div class="col s12 m6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Aviso</span>
          <p><?php echo $aviso;?></p>
        </div>
        
      </div>
    </div>
  </div>
<?php endif;?>
<div class="row">
    <form class="col s12" method="post">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Meu Perfil</span>
          <div class="row">
          	<div class="input-field s12">
          		<input type="text" name="usuario" required="required" value="<?php echo $usuario['usuario'];?>">
          		<label for="usuario">Meu nome:</label>
          	</div>
          	<div class="input-field s12">
          		<p><strong>E-mail</strong></p>
          		<p><?php echo $usuario['email'];?></p>
          		<input type="hidden" value="<?php echo $usuario['email'];?>" name="email">
          	</div>
          	<div class="input-field s12">
          		<p><strong>Troca de Senha</strong></p>
          		<p>Preencha caso deseja trocar a sua senha.</p>
          	</div>
          	<div class="input-field s12">
          		<input type="password" name="senha">
          		<label for="senha">Senha:</label>
          	</div>
          	<div class="input-field s12">
          		<input type="password" name="repetisenha">
          		<label for="repetisenha">Repetir Senha:</label>
          	</div>
          </div>
        </div>
        <div class="card-action">
        	<input type="submit" value="Salvar" class="btn">
          
          
        </div>
      </div>
    </form>
  </div>