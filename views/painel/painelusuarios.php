<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelusuarios/adicionar">Adicionar Usuário</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<h5>Usuários</h5>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<table class="striped">
			<tr>
				<th>USUÁRIOS</th>
				<th>E-MAIL</th>
				<th>AÇÕES</th>
			</tr>
			<?php foreach($usuarios as $usuario):?>
				<tr>
					<td><?php echo $usuario['usuario'];?></td>
					<td><?php echo $usuario['email'];?></td>
					<td>
						<a href="<?php echo BASE_URL;?>painelusuarios/editar/<?php echo md5($usuario['id']);?>" class="btn">Editar</a>
						<a href="<?php echo BASE_URL;?>painelusuarios/excluir/<?php echo md5($usuario['id']);?>" class="btn">Excluir</a>
					</td>
				</tr>
			<?php endforeach;?>
		</table>
	</div>
</div>