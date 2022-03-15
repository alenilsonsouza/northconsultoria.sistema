<?php if(!empty($flash)):?>
<div class="flash">
	<div class="conteudoFlash">
		<div class="texto"><?=$flash;?></div>
		<button class="bt btBackgroundAzul colorVerde btFlashFechar" onclick="closeFlash();">Fechar</button>
	</div>
</div>
<?php endif;?>