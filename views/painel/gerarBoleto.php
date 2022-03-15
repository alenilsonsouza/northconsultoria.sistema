<div class="row">
	<div class="col s12">
		<nav class="menuInterno">
			<ul>
				<li><a href="javascript:history.back()">Voltar</a></li>
			</ul>
		</nav>
	</div>
</div>
<div class="row">
    <div class="col s12">
        <h5>Gerar Boleto</h5>
        <p>Escolha o cliente e gere o carnê.</p>
        <?php if(!empty($flash)):?>
            <div class="aviso"><?=$flash;?></div>
        <?php endif;?>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <p>Cliente: <?=$cliente['nome_cliente'];?><br>
    Plano: <?=isset($plano['nome'])?$plano['nome']:'Cliente não tem plano';?></p>
    </div>
</div>
<div class="row">
    <form class="col s12" action="<?=BASE_URL;?>painelGerarBoleto/gerarFaturasBoletoBarato" method="post" id="form-carrega">
        <div class="row">
            <div class="input-field col s3">
                <input type="tel" name="valor" required value="<?=isset($plano['valor'])?number_format($plano['valor'],2,',','.'):'';?>">
                <label for="valor">Valor (Valor do plano + Dependentes)</label>
            </div>
            <div class="input-field col s3">
                <input type="date" name="data_vencimento" required>
                <label for="data_vencimento" class="active">Data 1º Vencimento</label>
            </div>
            <div class="col s3">
                <label for="nparcela">Parcela Inicial</label>
                <select name="nparcela" class="browser-default">
                    <?php for ($i = 1; $i <= 24; $i++) : ?>
                        <option value="<?= $i; ?>"><?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col s3">
                <label for="tparcela">Total de Parcelas</label>
                <select name="tparcela" class="browser-default">
                    <?php for ($i = 1; $i <= 24; $i++) : ?>
                        <option value="<?= $i; ?>" <?= ($i == 24) ? 'selected' : ''; ?>><?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <input type="hidden" name="id_cliente" value="<?=$cliente['id_cliente'];?>">
                <button type="submit">Gerar Boleto</button>
            </div>
        </div>
    </form>
</div>