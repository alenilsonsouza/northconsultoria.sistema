<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Escolha uma senha.</h1>
            <p><strong>Olá</strong> <?= $nome; ?><br>
                Escolha uma senha. Mínimo 6 dígitos</p>
        </header>
        <?php if (!empty($aviso)) : ?>
            <div class="aviso"><?php echo $aviso; ?></div>
        <?php endif; ?>

        <article class="area-conteuto-texto">
            <form action="<?= BASE_URL; ?>cadastrovendedor/storageFinished" method="post" enctype="multipart/form-data">
                <hr>
                <div>
                    <p>Faça o upload dos documentos abaixo: (Tipos de arquivos: JPG, PNG e PDF)</p>
                </div>
                <div class="grid grid2col">
                    <div>
                        <p><strong>RG ou CNH (Frente)</strong></p>
                        <input type="file" name="arquivo1" required>
                    </div>
                    <div>
                        <p><strong>RG ou CNH (Verso)</strong></p>
                        <input type="file" name="arquivo2" required>
                    </div>
                    <div>
                        <p><strong>Cartão SUS (Verso)</strong></p>
                        <input type="file" name="arquivo3" required>
                    </div>
                    <div>
                        <p><strong>Comprovante de Residência</strong></p>
                        <input type="file" name="arquivo4" required>
                    </div>

                </div>
                <hr>
                <div class="grid grid2col">
                    <div>
                        <label for="senha">Senha*: Mínimo 6 carateres</label>
                        <input type="password" name="senha" required id="senha">
                    </div>
                    <div>
                        <label for="senha">Confirmar Senha*:</label>
                        <input type="password" name="confirmar_senha" required id="confirmar_senha">
                    </div>
                </div>
                <div>
                    <div>
                        <input type="submit" value="Concluir Cadastro" class="bt btBackgroundVerde colorBranco">
                    </div>
                </div>
            </form>
        </article>
    </div>
</section>