<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Vamos começar?</h1> 
            
            <p>Preencha os dados abaixo para prosseguirmos com o seu cadastro: </p>
            <?php if(!empty($flash)):?>
            <p class="aviso"><?=$flash;?></p>
            <?php endif;?>
        </header>
        <div class="destaque">
            <p>Informações do seu id de Parceiro</p>
            <p><strong>Nome:</strong> <?=$cliente['nome_cliente'];?></p>
            <p><strong>CPF:</strong> <?=$cliente['cpf_cliente'];?></p>
        </div>
        <article class="area-conteuto-texto"> 
            <form action="<?=BASE_URL;?>cadastro/verifyCPFEmail" method="post">
            <div class="grid grid4col">
                <div>
                    <label for="nome">Nome Completo:</label>
                    <input type="text" name="nome" required autofocus>
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label for="cpf">CPF:</label>
                    <input type="tel" name="cpf" required id="cpf">
                    <div class="avisoTexto"></div>
                </div>
                
            </div>
            <input type="hidden" name="id_indicador" value="<?=$cliente['id_cliente'];?>">
            <button class="btCadastrar bt btBackgroundVerde colorAzul" style="display:none">Prosseguir</button>
            </form>
        </article>
    </div>
</section>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
    let cpf = document.querySelector('#cpf');
    IMask(cpf,{
        mask:'000.000.000-00'
    });
</script>