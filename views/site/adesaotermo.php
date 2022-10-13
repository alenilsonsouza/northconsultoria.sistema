<section class="full">
    <div class="container">
        <h1 class="title1">Olá <?=$client['name'];?></h1>
        <p>Leia o termo abaixo e clique em <strong>aceitar</strong> para continuar com o serviço contratado.</p>
        <?php require('parts/term.php');?>
        <a href="<?=BASE_URL;?>adesaotermo/aceito/<?=$client['id'];?>" class="button">ACEITAR</a>
    </div>
</section>