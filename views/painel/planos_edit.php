<div class="row">
    <div class="col s12">
        <nav>
            <div class="nav-wrapper">
                <ul id="nav-mobile" class="hide-on-med-and-down">
                    <li><a href="<?php echo BASE_URL; ?>painelplanos">Voltar</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <h5>Plano <?= $plano['product']; ?></h5>
    </div>
</div>
<div class="row">
    <form method="post" class="col s12" action="<?= BASE_URL; ?>painelplanos/editAction" enctype="multipart/form-data">
        <div class="row">
            <div class="col s3">
                <?php if (isset($plano['url'])) : ?>
                    <img src="<?= $plano['url']; ?>" alt="" width="150">
                <?php else : ?>
                    Sem logo
                <?php endif; ?>
            </div>
            <div class="file-field input-field col s3">
                <div class="btn">
                    <span>TROCAR LOGO</span>
                    <input type="file" name="file" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field col s3">
                <input type="text" required name="product" value="<?= $plano['product']; ?>" required>
                <label for="nome">Nome:</label>
            </div>
            <div class="input-field col s3">
                <input type="tel" required name="price" value="<?= $plano['price_real_number']; ?>" required>
                <label for="valor">Valor:</label>
            </div>
            <div class="input-field col s12">
                <input type="url" name="accredited_network" value="<?= $plano['accredited_network']; ?>">
                <label for="accredited_network">Rede Credenciada (URL):</label>
            </div>
            <div class="col s6">
                <?php if (!empty($plano['cover'])) : ?>
                    <a href="<?=$plano['cover'];?>" target="_blank" download="download">Baixar PDF</a>
                <?php endif; ?>
            </div>
            <div class="file-field input-field col s6">
                <div class="btn">
                    <span>TROCAR O que cobre (PDF)</span>
                    <input type="file" name="filePDF">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field col s6">
                <input type="number" name="due_day" min="1" max="30" required value="<?=$plano['due_day'];?>">
                <label for="due_day">Dia de Vencimento:</label>
            </div>
            <div class="input-field col s6">
                <input type="number" name="effective_day" min="1" max="30" required value="<?=$plano['effective_day'];?>">
                <label for="effective_day">Dia da Vigência:</label>
            </div>
            <div class="input-field col s12">
                <textarea id="textarea1" class="materialize-textarea" name="text"><?= $plano['text']; ?></textarea>
                <label for="textarea1">Obs:</label>
            </div>
            <div class="input-field col s4">
                <input type="hidden" name="id" id="" value="<?= $plano['id']; ?>">
                <input type="hidden" name="imageName" value="<?= $plano['image']; ?>">
                <input type="submit" value="Atualizar" class="btn">

            </div>
        </div>
    </form>
</div>