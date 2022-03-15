<div class="row">
    <div class="col s12">
        <nav>
            <div class="nav-wrapper">
                <ul id="nav-mobile" class="hide-on-med-and-down">
                    <li><a href="<?php echo BASE_URL; ?>painelredecredenciada">Voltar</a></li>

                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <h5><?= $title; ?></h5>
    </div>
</div>
<div class="row">
    <form class="col s12" method="post" enctype="multipart/form-data" action="<?= BASE_URL; ?>painelredecredenciada/<?= $action; ?>">
        <div class="row">
            <div class="input-field col s6">
                <input type="text" name="nome" required value="<?= isset($rede) ? $rede->getNome() : ''; ?>">
                <label for='nome'>Nome:</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="cidade" required value="<?= isset($rede) ? $rede->getCidade() : ''; ?>">
                <label for="cidade">Cidade:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea name="desconto" class="materialize-textarea" required><?= isset($rede) ? $rede->getDesconto() : ''; ?></textarea>
                <label for="desconto">Desconto</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="telefone" required value="<?= isset($rede) ? $rede->getTelefone() : ''; ?>">
                <label for="telefone">Telefone:</label>
            </div>
        </div>
        <?php if (isset($rede)) : ?>
            <div class="row">
                <div class="col s12">
                    <img src="<?= BASE_URL; ?>assets/arquivos/<?= $rede->getArquivo()['url_arquivo']; ?>" alt="" width="200">
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="arquivo">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <?php if (isset($rede)) : ?>
                    <input type="hidden" value="<?= $rede->getId(); ?>" name="id_rede">
                <?php endif; ?>
                <?php if (isset($rede)) : ?>
                    <input type="hidden" value="<?= $rede->getArquivo()['id']; ?>" name="id_arquivo">
                <?php endif; ?>
                <button class="btn">Salvar</button>
            </div>
        </div>
    </form>
</div>