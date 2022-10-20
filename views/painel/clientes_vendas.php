<div class="row">
    <div class="col s12">
        <h5>Vendas Realizadas</h5>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <form action="<?=BASE_URL;?>painelcadastros/updateArchived?p=<?=$paginaAtual;?>" method="POST" id="formCheck">
            <?php if(count($pessoas) > 0):?>
            <div class="bt-submit">
                <button type="submit">Arquivar</button>
            </div>
            <?php endif;?>
            <table class="striped">
                <tr>
                    <th width="80">
                    <input type="checkbox" id="checkall" />
                    <label for="checkall">Marcar</label>
                    </th>
                    <th>Titular</th>
                    <th>Plano</th>
                    <th width="200">Ações</th>
                </tr>
                <?php $i = 0;?>
                <?php foreach ($pessoas as $item) : ?>
                    
                    <tr>
                        <td>
                            <input type="checkbox" id="check<?=$i;?>" name="id_people[]" class="ckeckbox" value="<?=$item['id'];?>"/>
                            <label for="check<?=$i;?>"></label>
                        </td>
                        <td>
                            <?= $item['name']; ?><br>
                            <small><?=date('d/m/Y', strtotime($item['date_register']));?> - <?=$item['cpf'];?></small>
                        </td>
                        <td>
                            <?php if (isset($item['plan']['product'])) : ?>
                                <?= $item['plan']['product']; ?><br />
                                <small><?= $item['plan']['price_real']; ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL; ?>painelcadastros/ver/<?= $item['id']; ?>" class="btn">Ver Cadastro</a>
                        </td>
                    </tr>
                    <?php $i++;?>
                <?php endforeach; ?>
            </table>
            <?php if(count($pessoas) > 0):?>
            <div class="bt-submit">
                <button type="submit">Arquivar</button>
            </div>
            <?php endif;?>
        </form>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <ul class="pagination">
            <?php for ($q = 1; $q <= $paginas; $q++) : ?>
                <?php if ($paginaAtual == $q) : ?>
                    <li class="active"><a href="<?= BASE_URL; ?>painelcadastros/vendas?p=<?= $q; ?>"><strong><?= $q; ?></strong></a></li>
                <?php else : ?>
                    <li class="waves-effect"><a href="<?= BASE_URL; ?>painelcadastros/vendas?p=<?= $q; ?>"><?= $q; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>
        </ul>
    </div>
</div>
<script src="<?=BASE_URL;?>assets/js/Controllers/CheckBox.js"></script>