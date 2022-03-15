<div class="row">
	<div class="col s12">
		<nav class="menuInterno">
			<ul>
                <li><a href="javascript:history.back()">Voltar</a></li>
                <li><a href="<?=BASE_URL;?>painelGerarBoleto/gerarBoleto/<?=md5($cliente['id_cliente']);?>">Gerar Boletos</a></li>
			</ul>
		</nav>
	</div>
</div>
<div class="row">
    <div class="col s12">
        <h5>Boletos do Cliente <?=$cliente['nome_cliente'];?></h5>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <?php if(count($boletos) > 0):?>
            <a href="<?=BASE_URL;?>painelcadastros/excluirTodosBoletosCliente/<?=$cliente['id_cliente'];?>" class="btn" onclick="return confirm('Deseja realmente excluir todas as faturas desse cliente?');">Excluir todas as faturas</a>
        <?php endif;?>
        <table class="striped">
            <tr>
                <th width="60"></th>
                <th width="120">Vencimento</th>
                <th>BOLETO</th>
                <th>valor</th>
                <th>Pago dia</th>
                <th>Situação</th>
                <th width="200">Ações</th>
            </tr>
            <?php foreach($boletos as $boleto):?>
                <tr>
                    <td>
                    <a href="<?=$boleto['url_boleto'];?>" target="_blank" title="clique para ver o seu boleto"><img src="<?=BASE_URL;?>assets/images/usuarios/boleto-logo.jpg" alt="" width="60"></a>
                    </td>
                    <td>
                        <?=date('d/m/Y', strtotime($boleto['data_vencimento']));?>
                    </td>
                    <td>
                        <a href="<?=$boleto['url_boleto'];?>" target="_blank" class="btn" title="clique para ver o seu boleto">Ver Boleto</a><br>
                        <a href="http://boletos.cobrancaporboleto.com.br/carne/<?=md5($boletoBarato['idSistema'].'-'.$boleto['id_parcelamento']);?>/capa" class="botao" target="_blank">Imprimir Carnê</a>
                    </td>
                    <td>
                        R$ <?=number_format($boleto['valor'],2,',','.');?>
                    </td>
                    <td>
                        <?=!empty($boleto['data_pagamento'])?date('d/m/Y',strtotime($boleto['data_pagamento'])):'-';?>
                    </td>
                    <td>
                        <?=$boleto['situacao'];?>
                    </td>
                    <td>
                        <a href="<?=BASE_URL;?>painelcadastros/excluirBoleto/<?=$boleto['id_faturamento'];?>" class="btn" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <ul class="pagination">
            <?php for($q=1;$q<=$paginas;$q++): ?>
            <?php if($paginaAtual == $q): ?>
            <li class="active"><a href="<?php echo BASE_URL;?>painelcadastros/boletosdocliente/<?=md5($cliente['id_cliente']);?>?p=<?php echo $q;?>"><strong><?php echo $q;?></strong></a></li>
            <?php else: ?>	
            <li class="waves-effect"><a href="<?php echo BASE_URL;?>painelcadastros/boletosdocliente/<?=md5($cliente['id_cliente']);?>?p=<?php echo $q;?>"><?php echo $q;?></a></li>
            <?php endif;?>
            <?php endfor;?>	
        </ul>
    </div>
</div>
