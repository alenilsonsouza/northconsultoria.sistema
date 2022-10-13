<div class="row">
    <div class="col s12">
        Total: <?= count($clientes); ?>
    </div>
</div>
<pre>
<?php
//print_r($clientes);
?>
</pre>
<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th width="50">ID</th>
                <th width="200">Dt Cadastro</th>
                <th>Nome</th>
                <th>Plano</th>
                <th>E-mail</th>
                <th>Dependentes</th>
                
                <th width="200">Ações</th>
            </tr>
            <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td>
                        <?= date('d/m/Y', strtotime($cliente['date_register'])); ?><br>


                    </td>
                    <td>
                        <?php echo $cliente['name']; ?>
                    </td>
                    <td><?php 
                    if (isset($cliente['plan']['product'])):?>
                    <?php echo $cliente['plan']['product'] ?><br>
                    <small><?= $cliente['plan']['price_real']; ?></small>
                    <?php endif;?>
                </td>

                    <td><?php echo $cliente['email']; ?></td>
                    <td>
                        <a href="<?= BASE_URL; ?>painelcadastros/dependentes/<?= $cliente['id']; ?>" class="btn">(<?=$cliente['dependents'];?>) Dependentes</a>
                    </td>
                    
                    <td>
                        <a href="<?= BASE_URL; ?>painelcadastros/ver/<?= md5($cliente['id']); ?>" class="btn">Ver Cadastro</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if (count($clientes) == 0) : ?>
    <div class="row">
        <div class="col s12">
            Não há indicados
        </div>
    </div>
<?php endif; ?>