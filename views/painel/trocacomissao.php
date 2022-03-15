<div class="row">
    <div class="col s12">
        <h5>Troca de comissões de Vendedores</h5>
    </div>
</div>
<?php if(!empty($flash)):?>
    <div class="row">
    <div class="col s12">
        <strong><?=$flash;?></strong>
    </div>
</div>
<?php endif;?>
<div class="row">
    <form method="post" class="col s12" action="<?= BASE_URL; ?>paineltrocacomissao/updateComissao" enctype="multipart/form-data">
        <div class="row">
            <div class="col s12">
                <label for="vendedor">Vendedor:</label>
                <select name="vendedor" id="vendedor" class="browser-default">
                    <option value="0">(Escolha um vendedor)</option>
                    <?php foreach ($vendedores as $vendedor) : ?>
                        <option value="<?= $vendedor['id_cliente']; ?>"><?= $vendedor['nome_cliente']; ?> - (<?= $vendedor['nome_tipo']; ?>)</option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="col s12">
                <label for="tipo_comissao">Tipo Comissão:</label>
                <select name="tipo_comissao" id="" class="browser-default">
                    <option value="V">Vitalício</option>
                    <option value="P">50% primeira Parcela</option>
                </select>
            </div>
            <div class="input-field col s12">
                <input type="submit" value="Atualizar" class="btn">
            </div>
        </div>
    </form>
</div>