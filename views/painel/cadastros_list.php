<div class="row">
    <div class="col s12">
        <p>Total: <?=$total;?></p>
        <table class="striped">
            <tr>
                <th width="50">ID</th>
                <th width="200">Dt Cadastro</th>
                <th>Nome</th>
                <th>Qtd Indicados</th>
                <th>E-mail</th>
                <th width="320">Ações</th>
            </tr>
            <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?= date('d/m/Y', strtotime($cliente['date_register'])); ?></td>
                    <td>
                        <?= $cliente['name']; ?><br>
                        
                    </td>
                    <td><a href="<?= BASE_URL; ?>painelcadastros/indicados/<?= $cliente['id']; ?>" class="btn"><?=$cliente['holders_total'];?></a></td>
                    <td><?=$cliente['email']; ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>painelcadastros/ver/<?=$cliente['id']; ?>" class="btn">Ver cadastro</a>
                        <?php if ($cliente['holders_total'] == 0) : ?>
                            <a href="<?php echo BASE_URL; ?>painelcadastros/excluir/<?=$cliente['id']; ?>" class="btn" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php if ($p == 0) : ?>
    <div class="row">
        <div class="col s12">
            <ul class="pagination">
                <?php for ($q = 1; $q <= $paginas; $q++) : ?>
                    <?php if ($paginaAtual == $q) : ?>
                        <li class="active"><a href="javascript:;" data-p="<?php echo $q; ?>" class="paginationLink"><strong><?php echo $q; ?></strong></a></li>
                    <?php else : ?>
                        <li class="waves-effect"><a href="javascript:;" data-p="<?php echo $q; ?>" class="paginationLink"><?php echo $q; ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>