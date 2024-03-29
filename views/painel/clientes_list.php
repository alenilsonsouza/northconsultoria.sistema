<div class="row">
    <div class="col s12">
        Total: <?= $total; ?>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th width="30">ID</th>
                <th width="200">Resp. Finan.</th>
                <th width="250">Nome</th>
                <th>Plano</th>
                <th>E-mail</th>
                <th>Depends.</th>
                <th width="340">Ações</th>
            </tr>
            <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td>
                        <?= $cliente['id']; ?>
                    </td>
                    <td>
                        <?= date('d/m/Y', strtotime($cliente['date_register'])); ?><br>
                        <small><strong>Responsável Financeiro:</strong><br>
                        <?php if (is_array($cliente['responsavel_financeiro'])) : ?>
                            <?php $RF = $cliente['responsavel_financeiro']; ?>
                            <?= $RF['name']; ?><br>
                            CPF: <?= $RF['cpf']; ?><br>
                            E-mail: <?= $RF['email']; ?>
                        <?php else : ?>
                            Titular
                        <?php endif; ?>
                        </small>
                    </td>
                    <td>
                        <?= $cliente['name']; ?><br>
                        <small><?= $cliente['cpf']; ?></small><br>
                        <small><strong>Aceito Termo:</strong> <?= $cliente['termo_aceito']; ?></small>
                        <?php if ($cliente['termo'] == 'N') : ?>
                            <br><a href="javascript:;" data-url="<?= BASE_URL; ?>ajax/sendToConfirmTerm/<?= $cliente['id']; ?>" onclick=" sendEmailTerm(this);"><small>Reenviar o termo por e-mail para o cliente</small></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (isset($cliente['plan']['product'])) : ?>
                            <?= $cliente['plan']['product']; ?><br />
                            <small><?= $cliente['plan']['price_real']; ?></small>
                        <?php endif; ?>
                    </td>

                    <td><?php echo $cliente['email']; ?></td>
                    <td>
                        <?php if (isset($cliente['dependents'])) : ?>
                            <a href="<?= BASE_URL; ?>painelcadastros/dependentes/<?= $cliente['id']; ?>" class="btn"><?= $cliente['dependents']; ?></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= BASE_URL; ?>painelcadastros/ver/<?= $cliente['id']; ?>" class="btn">Ver Cadastro</a>
                        <?php if ($cliente['dependents'] == 0) : ?>
                            <a href="<?= BASE_URL; ?>painelcadastros/excluir/<?= $cliente['id']; ?>?pagina=clientes" class="btn" onclick="return confirm('Deseja realmente excluir o titular e os seu dependentes?')">Excluir</a>
                        <?php endif; ?>
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