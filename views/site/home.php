<?php require 'partials/flash.php'; ?>
<section class="full-wide">
	<div class="container">
		<h1 class="title1 center">Planos Odontológicos<br /><small>Escolha e contrate online</small></h1>
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
							<li>
								<a href="">Rede credencianda</a>
							</li>
							<li>
								<a href="">O que cobre?</a>
							</li>
						</ul>
						<div class="price">R$ <?=Moeda::converterParaBr($item['price']);?>/mês</div>
						<a href="javascript:;" class="button" onclick="openModal('planos', <?=$item['id'];?>)">Contrate agora</a>
					</div>
				</div>
				<?php endforeach;?>
			</div>
			<div class="right">
				<img src="<?=BASE_URL;?>assets/images/banner_home.jpg" alt="">
			</div>
		</div>
	</div>
</section>