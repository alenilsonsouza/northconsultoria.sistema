<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Cadastre o seu E-mail</h1>
            <p><strong>Seu CPF:</strong> <?=$cpf;?></p>
        </header>
        <?php if(!empty($aviso)):?>
            <p class="aviso"><?php echo $aviso;?></p>
        <?php endif;?>
        <article class="area-conteuto-texto"> 
            <form action="<?=BASE_URL;?>cadastrovendedor/storageEmail" method="post">
                <div class="grid l4">
                    <div>
                        <label for="email">E-mail*:</label>
                        <input type="email" name="email" required>
                    </div>
                </div>
                <div class="grid l4">
                    <div>
                        <input type="submit" value="Continuar" class="bt btBackgroundVerde colorAzul">
                    </div>
                </div>
            </form>
        </article>
    </div>
</section>
