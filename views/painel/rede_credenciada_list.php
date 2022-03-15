<div class="row">
    <div class="col s12">
        <form action="<?= BASE_URL; ?>painelredecredenciada/updateDestaque" method="post">
            <table class="striped">
                <tr>
                    <th width="100">Destaque</th>
                    <th>Nome</th>
                    <th>Cidade</th>
                    <th>Desconto</th>
                    <th>Telefone</th>
                    <th>Logo</th>
                    <th width="300">Ações</th>
                </tr>
                <?php foreach ($redes as $rede) : ?>
                    <tr>
                        <td>
                            <select name="destaque[]" class="browser-default">
                                <option value="1" <?=($rede->getDestaque() == 1)?'selected':'';?>>SIM</option>
                                <option value="0" <?=($rede->getDestaque() == 0)?'selected':'';?>>NÃO</option>
                            </select>
                            <input type="hidden" value="<?= $rede->getId(); ?>" name="id[]">
                        </td>
                        <td><?= $rede->getNome(); ?></td>
                        <td><?= $rede->getCidade(); ?></td>
                        <td><?= $rede->getDesconto(); ?></td>
                        <td><?= $rede->getTelefone(); ?></td>
                        <td>
                            <?php if (isset($rede->getArquivo()['url_arquivo'])) : ?>
                                <img src="<?= BASE_URL; ?>assets/arquivos/<?= $rede->getArquivo()['url_arquivo']; ?>" alt="" width="150">
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL; ?>painelredecredenciada/editar/<?= $rede->getId(); ?>" class="btn">Editar</a>
                            <a href="<?= BASE_URL; ?>painelredecredenciada/excluir/<?= $rede->getId(); ?>" class="btn" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <button type="submit">Atualizar</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <ul class="pagination">
            <?php for ($q = 1; $q <= $paginas; $q++) : ?>
                <?php if ($paginaAtual == $q) : ?>
                    <li class="active"><a href="javascript:;" data-p="<?php echo $q; ?>" class="linkP"><strong><?php echo $q; ?></strong></a></li>
                <?php else : ?>
                    <li class="waves-effect"><a href="javascript:;" data-p="<?php echo $q; ?>" class="linkP"><?php echo $q; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>
        </ul>
    </div>
</div>