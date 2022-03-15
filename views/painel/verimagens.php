<div class="row">
	<div class="col s12">
		<nav class="menu-interno">
    <div class="nav-wrapper">
      
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelprodutos">Voltar para Produtos</a></li>
        <li><a href="<?php echo BASE_URL;?>painelprodutos/inseririmagens/<?php echo md5($produto['idproduto']);?>">Adicionar Imagens</a></li>
        
        
      </ul>
    </div>
  </nav>
</div>
</div>
<div class="row">
	<div class="col s12">
		<h5>Imagens de <br><strong><?php echo $produto['nome_produto'];?></strong></h5>
	</div>
</div>
<div class="row">
	<form class="col s12" method="post">
		<table class="striped">
			<tr>
				<th width="150">Imagem</th>
				<th>Nome da Imagem</th>
				<th>Ordem</th>
				<th>Tamanho</th>
				<th>Dimensão</th>
				<th>Ações</th>
			</tr>
			<?php foreach($imagens as $imagem):?>
				<tr>
					<td><img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $imagem['nome_url'];?>" width="140"></td>

					<td>
						<input type="text" value="<?php echo $imagem['nome_imagem'];?>" name="nome_imagem[]">
						<input type="hidden" value="<?php echo md5($imagem['id']);?>" name="id[]">
					</td>
					<td><input type="number" value="<?php echo $imagem['ordem'];?>" name="ordem[]"></td>
					<td><?php echo number_format($imagem['tamanho_bytes']/1024,2,",",".");?>kb</td>
					<td><?php echo $imagem['largura'];?>x<?php echo $imagem['altura'];?></td>
					<td>
						<a href="<?php echo BASE_URL;?>painelprodutos/verimagens/<?php echo md5($produto['idproduto']);?>?idimg=<?php echo md5($imagem['id']);?>" class="btn">Excluir</a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php if(count($imagens) == 0):?>
				<tr>
					<td colspan="5">Nenhuma Imagem Cadastrada.</td>
				</tr>
			<?php endif;?>
		</table>
		<?php if(count($imagens) > 0):?>
			<input type="submit" value="Atualizar Nomes" name="atualizar" class="btn">
		<?php endif;?>
	</form>
</div>
