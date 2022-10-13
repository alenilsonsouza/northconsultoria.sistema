<?php if(!empty($flash)):?>
<div class="popupAviso">
    <div class="conteudoAviso">
        <div class="fechar" id="btFechar">X</div>
            <?=$flash;?>
    </div>
</div>
<?php endif;?>
<script src="<?=BASE_URL_SCRIPT;?>Controllers/Warning.js" defer></script>