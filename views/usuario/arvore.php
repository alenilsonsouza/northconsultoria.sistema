<div class="row">
	<div class="col s12">
		<h5>Árvore</h5>
	</div>
</div>
<div class="row">
    <div class="col s12">
		<?php 
        $cliente = new Clientes();
		$cliente->exibir($lista);
		if(count($lista) == 0):?>
		<p>Você ainda não tem indicados.</p>		
        <?php endif; ?>
    </div>
</div>
