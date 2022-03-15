<div class="row">
	<div class="col s12">
		<nav class="menu-interno">
    <div class="nav-wrapper">
      
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelprodutos">Voltar para Produtos</a></li>
        <li><a href="<?php echo BASE_URL;?>painelprodutos/verimagens/<?php echo md5($produto['idproduto']);?>">Imagens Cadastradas</a></li>
        
        
      </ul>
    </div>
  </nav>
</div>
</div>
<div class="row">
	<div class="col s12">
		<h5>Inserir Imagens para<br><strong><?php echo $produto['nome_produto'];?></strong></h5>
	</div>
</div>
<div class="row">
	<form class="col s12" method="post" enctype="multipart/form-data">
		<div class="row">
			<p>Escolha as imagens no botão abaixo.
			<br>O tamanho ideal para cada imagem é <strong>600x650px</strong>.<br>
			As imagens aceita são <strong>JPG</strong> e <strong>PNG</strong>,<br>
			arquivo em outro formato não será carregado.</p> 
		</div>
		<div class="row">
			<div class="file-field input-field">
				<div class="btn">
		        <span>Imagens</span>
		        <input type="file" name="imagens[]" multiple="multiple">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text">
		      </div>
			</div>
		</div>
		<div class="row">
			<div class="input-field">
				<input type="hidden" value="<?php echo $produto['idproduto'];?>" name="id_produto"> 
				<input type="submit" value="Cadastrar Imagens" class="btn">
			</div>
		</div>
	</form>
</div>