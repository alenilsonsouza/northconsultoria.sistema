<?php
$s = new Site();
$site = $s->getArray();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title><?= $site['titulo']; ?></title>
	<meta property="og:url" content="https:<?= BASE_URL; ?>">
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?= $viewData['template']['site']['titulo']; ?>">
	<meta property="og:description" content="<?= $viewData['template']['site']['descricao']; ?>">
	<meta property="og:image" content="https:<?= BASE_URL; ?>assets/images/logo.jpeg">

	<meta name="description" content="<?= $viewData['template']['site']['descricao']; ?>">
	<meta name="keywords" content="<?= $viewData['template']['site']['palavra_chave']; ?>">
	<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="<?= AUTOR; ?>">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&display=swap" rel="stylesheet">
	<link rel="shortcut icon" href="<?= BASE_URL_IMAGE; ?>favicon.png" type="image/x-icon">
	<link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/north.css">
	<script src="<?= BASE_URL; ?>assets/js/mascara.min.js"></script>
	<?php
	/**
	 * Importação de JS de APIS */
	require 'views/includes/jsimport.php';
	?>
</head>

<body>
	<header class="header">
		<div class="container">
			<div class="left">
				<div class="logo">
					<a href="<?= BASE_URL; ?>">
						<img src="<?= BASE_URL_IMAGE; ?>logo.jpeg" alt="North Consultoria">
					</a>
				</div>
			</div>
			<div class="right no-print">
				<div class="menu menu1">
					<ul>
						<li>
							<a href="https://api.whatsapp.com/send?phone=5527999156105" target="_blank" class="icon">
								<img src="<?= BASE_URL_IMAGE; ?>whatsapp.png" alt="">
								<span>27 99915-6105</span>
							</a>
						</li>
						<li>
							<a href="https://www.asaas.com/segunda-via" target="_blank" class="icon">
								<img src="<?= BASE_URL_IMAGE; ?>invoice.png" alt="">
								<span>2ª via do boleto</span></a>
						</li>
						<li>
							<a href="<?= BASE_URL; ?>relatorio/documento" class="icon">
								<img src="<?= BASE_URL_IMAGE; ?>invoice.png" alt="">
								<span>Beneficiários</span></a>
						</li>
					</ul>
				</div>
				<div class="menu menu2">
					<ul>
						<li>
							<a href="<?= BASE_URL; ?>" class="<?= $viewData['page'] == 'home' ? 'active' : ''; ?>">Início</a>
						</li>
						<li>
							<a href="<?= BASE_URL; ?>quemsomos" class="<?= $viewData['page'] == 'quemsomos' ? 'active' : ''; ?>">Quem somos</a>
						</li>
						<li>
							<a href="<?= BASE_URL; ?>nossosprodutos" class="<?= $viewData['page'] == 'nossosprodutos' ? 'active' : ''; ?>">Nossos Produtos</a>
						</li>
						<li>
							<a href="<?= BASE_URL; ?>parceiros" class="<?= $viewData['page'] == 'parceiros' ? 'active' : ''; ?>">Cartão MedCard</a>
						</li>
						<li>
							<a href="<?= BASE_URL; ?>contato" class="<?= $viewData['page'] == 'contato' ? 'active' : ''; ?>">Contato</a>
						</li>
					</ul>
				</div>

			</div>
			<div class="btnMobile no-print" onclick="toggleMenu();">
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>
	</header>
	<?php if (isset($_SESSION['sender'])) : // verifica o vendedor pelo id informado no link 
	?>
		<div class="senderName">Vendedor(a): <?= $_SESSION['sender']['name']; ?> (Cód.: <?= $_SESSION['sender']['id']; ?>)</div>
	<?php endif; ?>

	<?php $this->loadViewInTemplate($viewName, $viewData); ?>
	<footer class="footer no-print">
		<div class="container">
			<div class="column menu3">
				<ul>
					<li>
						<a href="<?= BASE_URL; ?>" class="<?= $viewData['page'] == 'home' ? 'active' : ''; ?>">Home</a>
					</li>
					<li>
						<a href="<?= BASE_URL; ?>quemsomos" class="<?= $viewData['page'] == 'quemsomos' ? 'active' : ''; ?>">Quem somos</a>
					</li>
					<li>
						<!--  -->
						<a href="<?= BASE_URL; ?>nossosprodutos" class="<?= $viewData['page'] == 'nossosprodutos' ? 'active' : ''; ?>">Nossos Produtos</a>
					</li>
					<li>
						<a href="<?= BASE_URL; ?>contato" class="<?= $viewData['page'] == 'contato' ? 'active' : ''; ?>">Contato</a>
					</li>
					<li>
						<a href="<?= BASE_URL; ?>adesaotermo" class="<?= $viewData['page'] == 'contato' ? 'active' : ''; ?>">Termo de Adesão</a>
					</li>
				</ul>
			</div>
			<div class="column telephones">
				<a href="https://api.whatsapp.com/send?phone=5527999156105" target="_blank" class="telephone--item" title="Converse conosco via Whatsapp!">
					<img src="<?= BASE_URL_IMAGE; ?>whatsapp.png" alt="">
					<span>27 99915-6105</span>
				</a>
				<a href="tel:552737631927" class="telephone--item" title="Ligue pra gente">
					<img src="<?= BASE_URL_IMAGE; ?>tel.png" alt="">
					<span>27 3763-1927</span>
				</a>
			</div>
			<div class="column social-media">
				<a href="https://www.instagram.com/northcorretoradeplanosdesaude/" target="_blank" class="telephone--item" title="Visite o nosso Insta!">
					<img src="<?= BASE_URL_IMAGE; ?>instagram.png" alt="">
					<span>northcorretoradeplanosdesaude</span>
				</a>
				<a href="mailto:pianaseguros@gmail.com" class="telephone--item" title="Clique e envie um e-mail">
					<img src="<?= BASE_URL_IMAGE; ?>email.png" alt="">
					<span>pianaseguros@gmail.com</span>
				</a>
			</div>
		</div>
	</footer>

	<div class="whatsapp no-print">
		<a href="<?= WHATSAPP; ?>" target="_blank">
			<img src="<?= BASE_URL_IMAGE; ?>whatsapp_footer.png" alt="">
		</a>
	</div>
	<div class="modal">
		<div class="modal-area">
			<button class="modal-close" onclick="closeModal()">X</button>
			<div class="modal-content">
				<?php require_once 'parts/form_register.php'; ?>
			</div>
		</div>
	</div>
	<div class="loading">
		<div class="loading--content">
			<img src="<?= BASE_URL_IMAGE; ?>loading.gif" alt="">
		</div>
	</div>
	<div class="updateInfo">
		<div class="updateInfo-content">
			<h5>Atualizamos a aplicação!</h5>
			<p>Favor pressione as teclas abaixo no teclado<br>para atualizar todos os arquivos.</p>
			<div class="warning"><kbd>CTRL</kbd>+<kbd>F5</kbd></div>
			<p>Aviso de <a href="https://alenilsonsouza.com.br" target="_blank">Alenilson Souza (Dev Web)</a></p>
		</div>
	</div>
	<div class="dev">
		<span>Desenvolvido por <a href="https://alenilsonsouza.com.br" target="_blank" title="Desenvolvedor Web desde 2010">Alenilson Souza</a></span>
	</div>
	<aside class="cookieAccept">
		<div class="text">Nós coletamos cookies para trazer a melhor experiência pra você. Ao navegar no nosso site você aceita esse consentimento.</div>
		
		<button class="button acceptCookie">Ok! Entendi.</button>
	</aside>
	<script>
		const VERSION = "<?= VERSION; ?>";
	</script>
	<script src="<?= BASE_URL_SCRIPT; ?>verifyUpdate.js"></script>
	<script src="<?php echo BASE_URL_SCRIPT; ?>script.js" type="module"></script>
	<script src="<?php echo BASE_URL_SCRIPT; ?>modal.js"></script>
	<script src="<?= BASE_URL; ?>assets/js/Controllers/Loading.js"></script>
	<script src="<?= BASE_URL; ?>assets/js/Controllers/Menu.js"></script>
	<link rel="stylesheet" href="<?= BASE_URL_CSS; ?>vanillaSlideshow.css">
	<script language="JavaScript" type="text/javascript" src="<?php echo BASE_URL_SCRIPT; ?>MascaraValidacao.js"></script>
	<?= $site['scripts']; ?>
</body>

</html>