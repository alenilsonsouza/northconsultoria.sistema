<div class="row">
    <div class="col s12">
        <h5>Comissões no mês</h5>
        <p>Comissões de 50% da primeira parcela compensada dentro do mês atual. Referente <strong><?= date('m'); ?>/<?= date('Y'); ?></strong></p>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th width="200">Vendedor</th>
                <th></th>
                <th width="180">Comissão</th>
                <th>Informações Bancárias</th>
                <th width="300">Ações</th>
            </tr>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?= $vendedor['nome_cliente']; ?></td>
                    <td><a href="<?= BASE_URL; ?>painelcadastros/indicados/<?= $vendedor['id_cliente']; ?>" class="btn">Indicados (<?= $obCliente->getTotalClientesByIdVendedor($vendedor['id_cliente']); ?>)</a></td>
                    <td>
                        <?= Moeda::converterParaBr($vendedor['comissao']); ?>
                    </td>
                    <td>
                        <?php if (!is_array($banco->getBancoByIdCliente($vendedor['id_cliente']))) : ?>
                            <?php $iBanco = $banco->getBancoByIdCliente($vendedor['id_cliente']); ?>
                            <strong>Banco:</strong> <?= $iBanco->getBanco(); ?><br>
                            <strong>Agência:</strong> <?= $iBanco->getAgencia(); ?> | <strong>Conta: </strong> <?= $iBanco->getConta(); ?> | <strong>Tipo:</strong> <?= $iBanco->getTipoNome(); ?><br>
                            <strong>Favorecido:</strong> <?= $iBanco->getNomeTitular(); ?> | <?= $iBanco->getCPFTitular(); ?>
                        <?php else : ?>
                            Sem informações bancárias
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($vendedor['comissao'] > 0) : ?>
                            <?php if($comissaoPagamento->SeFoiPagoNoMes($vendedor['id_cliente'],date('m'))==true):?>
                                Pago
                            <?php else:?>
                            <a href="<?=BASE_URL;?>painelcomissoes/confirmarPagamento?paginaAtual=<?=$paginaAtual;?>&valor=<?=$vendedor['comissao'];?>&id_cliente=<?=$vendedor['id_cliente'];?>" class="btn btConfirmarPagamento">Confirmar o pagamento</a>
                            <?php endif;?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <ul class="pagination">
            <?php for ($q = 1; $q <= $paginas; $q++) : ?>
                <?php if ($paginaAtual == $q) : ?>
                    <li class="active"><a href="<?php echo BASE_URL; ?>painelcomissoes?p=<?php echo $q; ?>"><strong><?php echo $q; ?></strong></a></li>
                <?php else : ?>
                    <li class="waves-effect"><a href="<?php echo BASE_URL; ?>painelcomissoes?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>
        </ul>
    </div>
</div>