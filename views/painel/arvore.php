<div class="row">
    <div class="col s12">
        <h5>Árvore</h5>
        <a href="<?php echo BASE_URL;?>painelniveis" class="btn">Níveis</a>
        <p>Rede Visualizada por nível</p>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <?php 
        $cliente = new Clientes();
        $cliente->exibir($lista);
        if(count($lista) == 0):?>
            <p>Ainda não há registros de indicados.</p>		
            <?php endif; ?>
    </div>
</div>