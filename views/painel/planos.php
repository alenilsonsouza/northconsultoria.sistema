<div class="row">
    <div class="col s12">
        <h5>Planos</h5>
    </div>
</div>
<div class="row">
    <form method="post" class="col s12" action="<?= BASE_URL; ?>painelplanos/addAction" enctype="multipart/form-data">
        <div class="row">
            <div class="file-field input-field col s4">
                <div class="btn">
                    <span>UPLOAD LOGO</span>
                    <input type="file" name="file" required accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field col s4">
                <input type="text" required name="product">
                <label for="nome">Nome do Plano:</label>
            </div>
            <div class="input-field col s4">
                <input type="tel" required name="price">
                <label for="valor">Valor:</label>
            </div>
            <div class="input-field col s12">
                <input type="url" name="accredit_network">
                <label for="accredit_network">Rede Credenciada(URL):</label>
            </div>
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>O que cobre (PDF)</span>
                    <input type="file" name="filePDF">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="input-field col s12">
                <textarea id="textarea1" class="materialize-textarea" name="text"></textarea>
                <label for="textarea1">Obs:</label>
            </div>
            <div class="input-field col s12">
                <input type="submit" value="Cadastrar" class="btn">
            </div>
        </div>
    </form>
</div>
<div class="row">
    <div class="col s12">
        <table>
            <tr>
                <th width="150">Logo</th>
                <th>Plano</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($planos as $plano) : ?>
                <tr style="<?= $plano['active'] == 'Y' ? 'background-color:white' : 'background-color:#cbcbcb'; ?>">
                    <td>
                        <?php if (isset($plano['url'])) : ?>
                            <img src="<?= $plano['url']; ?>" alt="" width="120">
                        <?php endif; ?>
                    </td>

                    <td>
                        <?= $plano['product']; ?><br />
                        <small>Cadastros: <?= $plano['total_people'];?></small>
                    </td>
                    <td>
                        <?= $plano['price_real']; ?>
                    </td>
                    <td>
                        <?= $plano['active_text']; ?>
                    </td>
                    <td>
                        <a href="<?= BASE_URL; ?>painelplanos/editar/<?= $plano['id']; ?>" class="btn">Editar</a>
                        <a href="<?= BASE_URL; ?>painelplanos/change/<?= $plano['id']; ?>" class="btn"><?= ($plano['active'] == 'Y') ? 'Desativar' : 'Ativar'; ?></a>
                        <?php if($plano['total_people'] == 0):?>
                        <a href="<?= BASE_URL; ?>painelplanos/delete/<?= $plano['id']; ?>" class="btn" onclick="confirm('Deseja realmente excluir este plano?')">Excluir</a>
                        <?php endif;?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>