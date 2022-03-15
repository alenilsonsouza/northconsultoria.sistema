<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelusuarios">Voltar</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<h5>Adicionar Usuários</h5>
		<p>Adicione usuário para acessar esse painel.</p>
	</div>
</div>
<?php if(!empty($aviso)):?>
	 <div class="row">
    <div class="col s12">
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
		<div class="row">
			<div class="input-field col s12 m4">
				<input type="text" name="usuario" required="required">
				<label for="usuario">Usuário:</label>
			</div>
			<div class="input-field col s12 m4">
				<input type="email" name="email" required="required">
				<label for="email">E-mail:</label>
			</div>
			<div class="input-field col s12 m2">
				<input type="password" name="senha" required="required">
				<label for="senha">Senha:</label>
			</div>
			<div class="input-field col s12 m2">
				<input type="submit" value="Cadastrar" class="btn">
				
			</div>
		</div>
	</form>
</div>