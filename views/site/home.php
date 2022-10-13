<?php require 'partials/flash.php'; ?>
<section class="banner-full" style="background-image:url('<?=BASE_URL;?>assets/images/banner_home.jpg');">
<h1 class="title1">Planos Odontológicos<br /><small>Escolha e contrate online</small></h1>
</section>
<section class="full-wide">
	<div class="container">
		
		<div class="services">
			<div class="left">
				<?php foreach($plans as $item) :?>
				<div class="service--item">
					<div class="img">
						<img src="<?= BASE_API_FILE; ?><?=$item['image'];?>" alt="">
					</div>
					<div class="text">
						<h2><?=$item['product'];?></h2>
						<ul class="service--list">
							<?php if(!empty($item['accredited_network'])):?>
							<li>
								<a href="<?=$item['accredited_network'];?>" target="_blank">Rede credenciada</a>
							</li>
							<?php endif;?>
							<?php if(!empty($item['cover'])):?>
							<li>
								<a href="<?=$item['cover'];?>" target="_blank">O que cobre?</a>
							</li>
							<?php endif;?>
						</ul>
						<div class="price">R$ <?=Moeda::converterParaBr($item['price']);?>/mês</div>
						<a href="javascript:;" class="button" onclick="openModal('planos', <?=$item['id'];?>)">Contrate agora</a>
					</div>
				</div>
				<?php endforeach;?>
			</div>
			
		</div>
	</div>
</section>