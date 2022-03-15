<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Escolha o seu plano.</h1> 
            <p>Olá <?=$infocad['nome'];?>, Preencha as informações abaixo.</p>
            <?php if(!empty($flash)):?>
            <p class="aviso"><?=$flash;?></p>
            <?php endif;?>
        </header>
        <div class="destaque">
            <p>Informações do Corretor</p>
            <p><strong>Nome:</strong><br>
            <?=$cliente['nome_cliente'];?></p>
            <p><strong>CPF:</strong><br>
            <?=$cliente['cpf_cliente'];?></p>
        </div>
        <article class="area-conteuto-texto"> 
            <form action="<?=BASE_URL;?>cadastro/storageEt5" method="post">
                <div class="grid grid4col">
                    <div>
                        <label for="plano">Escolha o seu Plano:</label>
                        <select name="plano" id="plano">
                            <?php foreach($planos as $plano):?>
                            <option value="<?php echo $plano['id'];?>"><?php echo $plano['nome'];?> - R$ <?php echo number_format($plano['valor'],2,',','.');?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                
            <input type="hidden" name="id_indicador" value="<?=$cliente['id_cliente'];?>">
            <button class="btCadastrar bt btBackgroundVerde colorAzul">Prosseguir</button>
            </form>
        </article>
    </div>
</section>
