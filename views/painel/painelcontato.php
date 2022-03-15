<div class="row">
	<div class="col s12">
		<h5>Contatos</h5>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<table class="striped responsible_table">
			<tr>
				<th>Data</th>
				<th>Nome</th>
				<th>E-mail</th>
				<th>Assunto</th>
				<th>Mensagem</th>
				<th>Ações</th>
			</tr>
			<?php foreach($contatos as $contato):?>
				<tr>
					<td width="80"><?php echo date('d/m/Y', strtotime($contato['data']));?></td>
					<td width="100"><?php echo $contato['nome'];?></td>
					<td width="120"><?php echo $contato['email'];?></td>
					<td width="130"><?php echo $contato['assunto'];?></td>
					<td width="250"><?php echo $contato['mensagem'];?></td>
					<td>
						<a href="<?php echo BASE_URL;?>painelcontato/excluir/<?php echo md5($contato['id_contato']);?>" class="btn">Excluir</a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
		<?php if(count($contatos)==0):?>
			<p>Nenhum Contato Cadastrado!</p>
		<?php endif;?>
	</div>
</div>
<div class="row">
	<div class="col s12">
	<ul class="pagination">
     <?php for($q=1;$q<=$paginas;$q++): ?>
	<?php if($paginaAtual == $q): ?>
	<li class="active"><a href="<?php echo BASE_URL;?>painelcontato?p=<?php echo $q;?>"><strong><?php echo $q;?></strong></a></li>
	<?php else: ?>	
	<li class="waves-effect"><a href="<?php echo BASE_URL;?>painelcontato?p=<?php echo $q;?>"><?php echo $q;?></a></li>
	<?php endif;?>
	<?php endfor;?>	
 </ul>
	</div>
</div>