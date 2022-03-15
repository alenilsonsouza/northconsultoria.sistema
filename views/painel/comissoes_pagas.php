<div class="row">
    <div class="col s12">
        <h5>Comissões pagas</h5>
    </div>
</div>
<div class="row">
    <div class="col s4">
        <strong>Mês Referência:</strong> <?= Data::getMesCompleto($mes); ?> / <?= $ano; ?>
    </div>
    <form action="<?=BASE_URL;?>painelcomissoes/comissoesPagas" method="get" class="col s8">
        <div class="row">
            <div class="col s3">
                <label for="mes">Mês</label>
                <select name="mes" id="mes" class="browser-default">
                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                        <option value="<?=$i;?>" <?=($i == $mes)?'selected':'';?>><?=Data::getMesCompleto($i);?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col s3">
                <label for="ano">Ano</label>
                <select name="ano" id="ano" class="browser-default">
                    <?php for ($i = 2020; $i <= date('Y'); $i++) : ?>
                        <option value="<?=$i;?>" <?=($i == $ano)?'selected':'';?>><?=$i;?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col s2">
                <input type="hidden" name="p" value="<?=$paginaAtual;?>">        
                <button type="submit" class="btn">Ver</button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    
    <div class="col s12">
    <p><strong>Página: </strong><?=$paginaAtual;?></p>
        <table class="striped">
            <tr>
                <th>Data Pagamento</th>
                <th>Vendedor</th>
                <th>Valor</th>
            </tr>
            <?php foreach ($pagamentos as $p) : ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($p->getDate())); ?></td>
                    <td><?= $p->getCliente()['nome_cliente']; ?></td>
                    <td><?= Moeda::converterParaBr($p->getPrice()); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <div class="row">
            <div class="col s12">
                <ul class="pagination">
                    <?php for ($q = 1; $q <= $paginas; $q++) : ?>
                        <?php if ($paginaAtual == $q) : ?>
                            <li class="active"><a href="<?= BASE_URL; ?>painelcomissoes/comissoesPagas?p=<?= $q; ?>"><strong><?php echo $q; ?></strong></a></li>
                        <?php else : ?>
                            <li class="waves-effect"><a href="<?= BASE_URL; ?>painelcomissoes/comissoesPagas?p=<?= $q; ?>"><?php echo $q; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
    </div>
</div>