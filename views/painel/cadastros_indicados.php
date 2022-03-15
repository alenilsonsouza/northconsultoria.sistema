<div class="row">
    <div class="col s12">
        <nav class="menuInterno">
            <ul>
                <li><a href="javascript:window.history.back();">Voltar</a></li>
            </ul>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <h5>Indicados de <?= $cliente['nome_cliente'] ?></h5>

    </div>
</div>
<!--<div class="row">
    <div class="input-field col s12">
        <input type="search" name="search" id="serachCadastro">
        <label for="search">Pesquise por id, nome, ou CPF</label>
    </div>
</div>-->
<?php if (isset($id_cliente)) : ?>
    <div id="cadastrolistIndicadors" data-idindicado="0" data-idnegcio="0"></div>
<?php else : ?>
    <div id="cadastrolistIndicadors" data-idindicado="<?= $cliente['id_cliente']; ?>" data-idnegcio=<?= $cliente['id_negocio']; ?>></div>
<?php endif; ?>