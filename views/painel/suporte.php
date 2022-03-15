<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelsuporte/abrirsuporte">Abrir Novo Supore</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
	<div class="col s12"><h5>Suporte</h5></div>
</div>
<div class="row">
	<div class="col s12">
		<table class="striped">
			<tr>
				<th>Data</th>
				<th>Tipo Suporte</th>
				<th>Assunto</th>
				<th>Usuário</th>
				<th>Respostas</th>
				<th>Ações</th>
			</tr>
			<?php foreach($suportes as $suporte):?>
				<tr class="<?php echo ($suporte['situacao'] == 1)?"concluido":'';?>">
					<td>
						<?php $dia = date("w", strtotime($suporte['data_hora']));?>
						<strong><?php $d = new Data(); echo $d->getDiaSemana($dia);?></strong><br>
						<?php echo date("d-m-Y H:i:s", strtotime($suporte['data_hora']));?>
							
					</td>
					<td><?php $s = new Suporte(); echo $s->tipoSuporte($suporte['tipo_suporte']);?></td>
					<td>
						<?php echo $suporte['assunto_suporte'];?><br>
						<strong><?php echo ($suporte['situacao'] == 1)?"Concluído":'';?></strong>	
					</td>
					
					<td><?php echo $suporte['usuario'];?></td>
					<td>
						<?php $s= new Suporte(); echo count($s->getResposta($suporte['idsuporte']));?>
					</td>
					<td>
						<a href="<?php echo BASE_URL;?>painelsuporte/ver/<?php echo md5($suporte['idsuporte']);?>" class="btn">Ver</a>
					</td>
					
				</tr>
			<?php endforeach;?>
		</table>
	</div>
</div>

<div class="row">
	<div class="col s12">
		<ul class="pagination">
			<?php for($q=1;$q<=$paginas;$q++): ?>
				<?php if($paginaAtual == $q): ?>
					<li class="active"><a href="<?php echo BASE_URL;?>painelsuporte?p=<?php echo $q;?>"><?php echo $q;?></a></li>
				<?php else: ?>
		<li class="waves-effect"><a href="<?php echo BASE_URL;?>painelsuporte?p=<?php echo $q;?>"><?php echo $q;?></a></li>
		<?php endif;?>
		<?php endfor;?>	
      </ul>
 
	</div>
</div>

