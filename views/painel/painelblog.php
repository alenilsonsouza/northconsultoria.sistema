<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelblog/adicionar">Adicionar</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
	<div class="col s12"> 
		<h5>Blog</h5>
	</div>
</div>

<div class="row">
	<div class="col s12">
		<table class="striped">
			<tr>
				<th>Imagem Destaque</th>
				<th>Título</th>
				<th>Data Postagem</th>
				<th>Última atualização</th>
				<th>Ações</th> 
			</tr>
			<?php foreach($blogs as $blog):?>
				<tr>
					<td>
						<img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $blog['url_arquivo'];?>" width="120">
					</td>
					<td>
						<?php echo $blog['titulo_blog'];?>
					</td>
					<td>
						<?php echo date("d/m/Y",strtotime($blog['data_cadastro_blog']));?>
					</td>
					<td>
						<?php if(!empty($blog['data_atualizacao_blog'])):?>
							<?php echo date("d/m/Y",strtotime($blog['data_atualizacao_blog']));?>
						<?php endif;?>
					</td>
					<td>
						<a href="<?php echo BASE_URL;?>painelblog/editar/<?php echo md5($blog['id_blog']);?>" class="btn">Editar</a>
						<a href="<?php echo BASE_URL;?>painelblog/excluir/<?php echo md5($blog['id_blog']);?>" class="btn">Excluir</a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php if(count($blogs) == 0):?>
				<tr>
					<td colspan="5">Nenhum registro cadastrado.</td>
				</tr>
			<?php endif;?>
		</table>

		<ul class="pagination">
     <?php for($q=1;$q<=$paginas;$q++): ?>
	<?php if($paginaAtual == $q): ?>
	<li class="active"><a href="<?php echo BASE_URL;?>painelblog?p=<?php echo $q;?>"><strong><?php echo $q;?></strong></a></li>
	<?php else: ?>	
	<li class="waves-effect"><a href="<?php echo BASE_URL;?>painelblog?p=<?php echo $q;?>"><?php echo $q;?></a></li>
	<?php endif;?>
	<?php endfor;?>	
 </ul>
	</div>
</div>