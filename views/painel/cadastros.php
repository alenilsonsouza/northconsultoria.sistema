<div class="row">
    <div class="col s12">
        <h5>Cadastros</h5>
        <p>Procure por Vendedores, nos indicados os clientes e nos clientes os seus dependentes</p>

    </div>
</div>
<?php if ($page == 'cadastros') : ?>
    <div class="row">
        <div class="col s12">
            <a href="<?=BASE_URL;?>painelcadastros/adicionar" class="btn">Adicionar Vendedor</a>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="input-field col s12">
        <input type="search" name="search" id="serachCadastro">
        <label for="search">Pesquise por id, nome, ou CPF do Titular ou Vendedor</label>
    </div>
</div>
<div id="cadastrolist"></div>