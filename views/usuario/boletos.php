<div class="row">
    <div class="col s12">
        <h5>Seus Boletos</h5>
        <p>O pagamento é confirmado pelo sistema até 2 dias úteis.</p>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th width="60"></th>
                <th>Vencimento</th>
                <th>BOLETO</th>
                <th>Pago dia</th>
                <th width="200">Situação</th>
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
                        <a href="<?=$boleto['url_boleto'];?>" target="_blank" class="btn" title="clique para ver o seu boleto">Ver Boleto</a>
                    </td>
                    <td>
                        <?=!empty($boleto['data_pagamento'])?date('d/m/Y',strtotime($boleto['data_pagamento'])):'-';?>
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
            <li class="active"><a href="<?php echo BASE_URL;?>arboletos?p=<?php echo $q;?>"><strong><?php echo $q;?></strong></a></li>
            <?php else: ?>	
            <li class="waves-effect"><a href="<?php echo BASE_URL;?>arboletos?p=<?php echo $q;?>"><?php echo $q;?></a></li>
            <?php endif;?>
            <?php endfor;?>	
        </ul>
    </div>
</div>