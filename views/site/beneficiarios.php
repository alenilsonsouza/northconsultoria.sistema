<?php require 'partials/aviso.php'; ?>
<section class="full">
    <div class="container">
        <h1 class="title1">Beneficiários</h1>
        <p><strong>Titular:</strong> <?= $people['name']; ?></p>
        <p><strong>Plano:</strong> <?= $plan['product']; ?></p>

        <p><strong>Dependentes:</strong></p>
        <?php if (count($dependents) > 0) : ?>
        <table>
            <tr>
                <th>Nomes</th>
                <th>Valores</th>
            </tr>
            <?php foreach ($dependents as $item) : ?>
                <tr>
                    <td><?= $item['name']; ?></td>
                    <td><?= Moeda::converterParaBr($plan['price']) ;?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>Sem dependentes Cadastrados</p>
        <?php endif; ?>
    </div>
</section>
