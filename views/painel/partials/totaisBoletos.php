(<?=$cliente['tipoCliente'];?>)<br>
<a href="<?= BASE_URL; ?>painelcadastros/boletosdocliente/<?= md5($cliente['id_cliente']); ?>">Ver Boletos</a> | <a href="<?= BASE_URL; ?>painelGerarBoleto/gerarBoleto/<?= md5($cliente['id_cliente']); ?>">Gerar Boleto</a><br>
<?php $faturamento = new Faturamento();
$item = $faturamento->pegarTotalDeBoletosPorCliente($cliente['id_cliente']); ?>
<small>Total: <?= $item['total_boletos']; ?> | Pagos: <?= $item['boletos_pagos']; ?></small>