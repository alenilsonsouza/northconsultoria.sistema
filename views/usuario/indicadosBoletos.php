<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>arindicados">Voltar</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
    <div class="col s12">
        <h5>Boleto de <?=$cliente['nome_cliente'];?></h5>
        <p>Segue abaixo os boletos emitido desse cliente.</p>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th>ID</th>
                <th width="120">Valor</th>
                <th width="200">Vencimento</th>
                <th>Dt Pagamento</th>
                <th>Carnê</th>
                <th width="190">Situação</th>
                
            </tr>
            <?php foreach($boletos as $boleto):?>
                <tr>
                    <td><?=$boleto['id_faturamento'];?></td>
                    <td>R$ <?=number_format($boleto['valor'],2,",",".");?></td>
                    <td><?=date('d/m/Y', strtotime($boleto['data_vencimento']));?></td>
                    <td>
                        <?=!empty($boleto['data_pagamento'])?date('d/m/Y', strtotime($boleto['data_pagamento'])):'-';?>
                    </td>
                    <td>
                    <a href="http://boletos.cobrancaporboleto.com.br/carne/<?=md5($infoBoleto['idSistema'].'-'.$boleto['id_parcelamento']);?>/capa" class="btn" target="_blank">Imprimir Carnê</a>
                    </td>
                    <td>
                        <?=$boleto['situacao'];?>
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
            <li class="active"><a href="<?php echo BASE_URL;?>arindicados/boletos/<?=md5($cliente['id_cliente']);?>?p=<?php echo $q;?>"><strong><?php echo $q;?></strong></a></li>
            <?php else: ?>	
            <li class="waves-effect"><a href="<?php echo BASE_URL;?>arindicados/boletos/<?=md5($cliente['id_cliente']);?>?p=<?php echo $q;?>"><?php echo $q;?></a></li>
            <?php endif;?>
            <?php endfor;?>	
        </ul>
    </div>
</div>



