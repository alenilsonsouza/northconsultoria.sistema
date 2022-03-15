<section class="full">
    <div class="container">
        <div class="logoNorth">
            <img src="<?= BASE_URL; ?>assets/images/cartoes.jpeg" alt="">
        </div>
        <div class="parceiros_redes">
            <?php foreach($redes as $item):?>
            <div class="item">
                <div class="logo" style="background-image:url('<?=$item['arquivo'];?>')"></div>
                <div class="right">
                    <div class="name"><?=$item['nome'];?></div>
                    <div class="desc">
                        <div class="city"><?=$item['cidade'];?></div>
                    </div>
                    <div class="tel"><a href="tel:+5527998125006"><?=$item['telefone'];?></a></div>
                    <div class="discount"><?=$item['desconto'];?></div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</section>