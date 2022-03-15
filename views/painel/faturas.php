<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelcadastros">Voltar</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
    <div class="col s12">
        <h5>Fatura de <?php echo $cliente['nome_cliente'];?></h5>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th width="80">Boleto</th>
                <th width="120">Dt Vencimento</th>
                <th width="100">Nº Parcela</th>
                <th width="70">Valor</th>
                <th width="80">Pago dia</th>
                <th>Ações</th>
            </tr>
            <?php foreach($fatura as $fatura):?>
                <tr>
                    <td>
                        <a href="<?php echo $fatura['url_boleto'];?>" target="_blank">Imprimir</a>
                    </td>
                    <td><?php echo date('d/m/Y', strtotime($fatura['data_vencimento']));?></td>
                    <td><?php echo $fatura['nparcela'];?>/<?php echo $fatura['tparcela'];?></td>
                    <td><?php echo number_format($fatura['valor'],2,',','.');?></td>
                    <td><?php echo (!empty($fatura['data_pagamento']))?$fatura['data_pagamento']:'-';?></td>
                    <td>--</td>
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
        <li class="active"><a href="<?php echo BASE_URL;?>painelcadastros/faturas/<?php echo md5($cliente['id_cliente']);?>?p=<?php echo $q;?>"><strong><?php echo $q;?></strong></a></li>
        <?php else: ?>	
        <li class="waves-effect"><a href="<?php echo BASE_URL;?>painelcadastros/faturas/<?php echo md5($cliente['id_cliente']);?>?p=<?php echo $q;?>"><?php echo $q;?></a></li>
        <?php endif;?>
        <?php endfor;?>	
    </ul>
    </div>
</div>