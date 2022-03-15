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
	<div class="col s12"><h5>Editar Rede Social <?php echo $rede['nome_rede'];?></h5></div>
</div>
<div class="row">
  <form method="post" class="col s12" enctype="multipart/form-data">
    <div class="row">
      <div class="col s12 m1">
        <img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $rede['url_arquivo'];?>" style="width: 60px">
      </div>
      <div class="file-field input-field col s12 m2">
      <div class="btn">
        <span>Trocar</span>
        <input type="file" name="imagem">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field col s12 m3">
      <input type="text" name="nome_rede" required="required" value="<?php echo $rede['nome_rede'];?>">
      <label for="nome_rede">Nome:</label>
    </div>
    <div class="input-field col s12 m3">
      <input type="url" name="link_rede" required="required" value="<?php echo $rede['link_rede'];?>">
      <label for="link_rede">URL:</label>
    </div>
    <div class="input-field col s12 m3">
      <input type="hidden" name="id_imagem" value="<?php echo md5($rede['id_imagem']);?>">
      <input type="submit" value="Salvar" class="btn">
    </div>

    </div>
  </form>
</div>