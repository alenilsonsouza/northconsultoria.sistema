<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Cadastro concluído com sucesso!</h1>
            
        </header>
        <?php if(!empty($aviso)):?>
            <div class="aviso"><?php echo $aviso;?></div>
        <?php endif;?>
        <article class="area-conteuto-texto"> 
            
            <div class="caixaId"><div>Seu Id:</div> <strong><?=$cliente['id_cliente'];?></strong></div>
            <p class="center"><?=$cliente['nome_cliente'];?>,<br>Guarde o seu ID para cadastrar os seus futuros clientes. Sucesso!</p>
            <p><a href="<?=BASE_URL;?>" class="bt btBackgroundVerde colorAzul" style="padding: 20px;margin-top:25px; display:inline-block">Voltar para Home</a></p>

        </article>
    </div>
</section>
