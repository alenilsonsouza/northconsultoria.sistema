<div class="row">
    <div class="col s12">
        <h5>Seus Indicados</h5>
        <p>As comissões apresentadas abaixo são referentes ao mês atual</p>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th width="50">ID</th>
                <th width="200">Dt Cadastro</th>
                <th>Nome</th>
                <th>Plano</th>
                <th>E-mail</th>
                <th>Boletos</th>
                <th width="200">Comissão (Mês atual)</th>
            </tr>
            <?php foreach($clientes as $cliente):?>
            <tr>
                <td><?php echo $cliente['id_cliente'];?></td>
                <td><?=date('d/m/Y H:i:s', strtotime($cliente['data_cadastro']));?></td>
                <td><?php echo $cliente['nome_cliente'];?></td>
                <td><?php echo (isset($cliente['plano']['nome']))?$cliente['plano']['nome']:'';?></td>
                <td><?php echo $cliente['email_cliente'];?></td>
                <td>
                    <a href="<?=BASE_URL;?>arindicados/boletos/<?=md5($cliente['id_cliente']);?>" class="btn">Ver</a>
                </td>
                <td>R$ <?=number_format($cliente['comissao'],2,',','.');?></td>
                
            </tr>
            <?php $comissao[] = isset($cliente['comissao'])?$cliente['comissao']:0;?>
            <?php endforeach;?>
        </table>
    </div>
</div>
<?php if(count($clientes)==0):?>
    <div class="row">
        <div class="col s12">
            Não há indicados
        </div>
    </div>
<?php endif;?>
<div class="row">
    <div class="col s12">
        Total a pagar: R$ <?=isset($comissao)?number_format(array_sum($comissao),2,',','.'):number_format(0,2,',','.');?>
    </div>
</div>
