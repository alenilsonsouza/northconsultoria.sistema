<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelredessociais">Voltar</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
	<div class="col s12"><h5>Adicionar Rede Social</h5></div>
</div>
<div class="row">
  <form method="post" class="col s12" enctype="multipart/form-data">
    <div class="row">
      <div class="file-field input-field col s12 m6">
      <div class="btn">
        <span>Imagem (jpg|png|gif|svg)</span>
        <input type="file" required="required" name="imagem">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field col s12 m6">
      <input type="text" name="nome_rede" required="required">
      <label for="nome_rede">Nome:</label>
    </div>
    <div class="input-field col s12 m12">
      <input type="url" name="link_rede" required="required">
      <label for="link_rede">URL:</label>
    </div>
    <div class="input-field col s12">
      <input type="submit" value="Cadastrar" class="btn">
    </div>

    </div>
  </form>
</div>