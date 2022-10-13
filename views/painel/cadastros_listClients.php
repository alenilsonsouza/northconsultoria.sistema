<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th width="80">Dt Cadastro</th>
                <th>Nome</th>
                <th width="100">Valor</th>
                <th>Plano</th>
            </tr>
            <?php $subtotal = 0;?>
            <?php foreach ($clientes as $cliente) : ?>
                <tr>
                    <td width="100">
                        <?= date('d/m/Y', strtotime($cliente['date_register'])); ?><br>
                    </td>
                    <td>
                        <?= $cliente['name']; ?>
                    </td>
                    <td>
                        <?= $cliente['plan']['price_real']; ?>
                    </td>
                    <td>
                        <?php if (isset($cliente['plan']['product'])) : ?>
                            <?= $cliente['plan']['product']; ?>
                        <?php endif; ?>
                    </td>

                </tr>
                <?php $subtotal += $cliente['plan']['price'];?>
            <?php endforeach; ?>
        </table>
        <div>
            Total: R$ <?=Moeda::converterParaBr($subtotal);?>
        </div>
    </div>
</div>
<?php if (count($clientes) == 0) : ?>
    <div class="row">
        <div class="col s12">
            Não há Clientes registrados
        </div>
    </div>
<?php endif; ?>