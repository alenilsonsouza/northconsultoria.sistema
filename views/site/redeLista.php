<?php foreach ($redes as $item) : ?>
    <div class="item">
        <div class="logo" style="background-image:url('<?= $item['arquivo']; ?>')"></div>
        <div class="right">
            <div class="name"><?= $item['nome']; ?></div>
            <div class="desc">
                <div class="city"><?= $item['cidade']; ?></div>
            </div>
            <div class="tel"><?= $item['telefone']; ?></div>
            <div class="discount"><?= $item['desconto']; ?></div>
        </div>
    </div>
<?php endforeach; ?>
<?php if (count($redes) == 0) : ?>
    <p>Nenhuma rede credenciada</p>
<?php endif; ?>