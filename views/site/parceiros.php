<div class="banner-card">
    <img src="<?= BASE_URL; ?>assets/images/cartaomedcard/frente.jpg" alt="">
    <img src="<?= BASE_URL; ?>assets/images/cartaomedcard/verso.jpg" alt="">
</div>
<section class="full">
    <div class="container">

        <div class="parceiro_pesquisa">
            <input type="search" name="searchPartner" id="searchPartner" placeholder="Digite o nome da sua cidade">
        </div>
        <div class="parceiros_redes">
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
        </div>
    </div>
</section>

<script src="<?= BASE_URL_SCRIPT; ?>Controllers/Partners.js"></script>