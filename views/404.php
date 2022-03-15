<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não encontrada!</title>
    <style type="text/css">

	<?php require 'assets/css/geral.css';?>

    </style>
</head>
<body>
<section class="area-conteudo">
    <div class="conteudo">
        <header class="area-titulo">
            <h1>Ops! A página que está tentando acessar não existe.</h1>
        </header>
    
        <p>Pode ser que você tenha digitado a url errada.</p>

        <p>Pra onde você quer ir?</p>

        <p><a href="<?=BASE_URL;?>">- Quero Cadastrar</a></p>
        <p><a href="<?=BASE_URL;?>ar">- Acessar o painel</a></p>
    </div>
</section>
</body>
</html>