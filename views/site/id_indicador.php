<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Cadastre o seu cliente aqui</h1>
            <?php if(!empty($flash)):?>
            <p class="aviso"><?=$flash;?></p>
            <?php endif;?>
        </header>
        <article class="area-conteuto-texto">
            <div class="cadastroGridInicial">
                <div class="areaFom1">
                    <form action="<?=BASE_URL;?>cadastro/verifyId" method="post">
                        <div class="grid l1">
                            <div>
                                <label for="nome"><strong>Informe o seu ID</strong><br>para o cadastro do seu cliente:</label>
                                <input type="text" name="id_indicator" required autofocus>
                            </div>
                        </div>
                            
                        <button class="bt btBackgroundVerde colorAzul">Cadastrar</button>
                    </form>
                </div>
            </div>
            
        </article>
    </div>
</section>
