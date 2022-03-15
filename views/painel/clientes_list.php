<div class="row">
    <div class="col s12">
        Total: <?=$total; ?>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th width="50">ID</th>
                <th width="150">Dt Cadastro</th>
                <th>Nome</th>
                <th>Plano</th>
                <th>E-mail</th>
                <th>Depends.</th>
                <th width="320">Ações</th>
            </tr>
            <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td>
                        <?= $cliente['id']; ?>
                    </td>
                    <td>
                        <?= date('d/m/Y', strtotime($cliente['date_register'])); ?><br>
                    </td>
                    <td>
                        <?= $cliente['name']; ?><br>
                        <small><?= $cliente['cpf'];?></small>
                    </td>
                    <td>
                        <?php if(isset($cliente['plan']['product'])):?>
                        <?= $cliente['plan']['product'];?><br />
                        <small><?= $cliente['plan']['price_real'];?></small>
                        <?php endif;?>
                    </td>

                    <td><?php echo $cliente['email']; ?></td>
                    <td>
                        <?php if(isset($cliente['dependents'])):?>
                        <a href="<?= BASE_URL; ?>painelcadastros/dependentes/<?= $cliente['id']; ?>" class="btn"><?=$cliente['dependents'];?></a>
                        <?php endif;?>
                    </td>
                    <td>
                        <a href="<?= BASE_URL; ?>painelcadastros/ver/<?=$cliente['id']; ?>" class="btn">Ver Cadastro</a>
                        <?php if($cliente['dependents'] == 0):?>
                        <a href="<?= BASE_URL; ?>painelcadastros/excluir/<?=$cliente['id']; ?>?pagina=clientes" class="btn" onclick="return confirm('Deseja realmente excluir o titular e os seu dependentes?')">Excluir</a>
                        <?php endif;?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if (count($clientes) == 0) : ?>
    <div class="row">
        <div class="col s12">
            Não há Clientes registrados
        </div>
    </div>
<?php endif; ?>
<?php if ($pag == 1) : ?>
    <div class="row">
        <div class="col s12">
            <ul class="pagination">
                <?php for ($q = 1; $q <= $paginas; $q++) : ?>
                    <?php if ($paginaAtual == $q) : ?>
                        <li class="active"><a href="javascript:;" data-p="<?php echo $q; ?>"><strong><?php echo $q; ?></strong></a></li>
                    <?php else : ?>
                        <li class="waves-effect"><a href="javascript:;" data-p="<?php echo $q; ?>"><?php echo $q; ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>