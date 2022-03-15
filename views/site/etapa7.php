<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="area-titulo">
            <h1>Para concluir escolha a senha e aceite os termos.</h1> 
            
            <p>Olá <?=$infocad['nome'];?>, Defina a sua senha: Mínimo de 6 caracteres e no máximo 12</p>
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
            <form action="<?=BASE_URL;?>cadastro/storageEt7" method="post" class="FormConcluir">
                <div class="grid grid2col">
                    <div>
                        <label for="senha">Senha: Mínimo 6 carateres</label>
                        <input type="password" name="senha" required id="senha" autofocus>
                    </div>
                    <div>
                        <label for="senha">Confirmar Senha:</label>
                        <input type="password" name="confirmar_senha" required id="confirmar_senha">
                    </div>
                </div>
                <div class="grid ">
                    <div>
                        <label for="aceito">Aceito os termos</label>
                        <input type="checkbox" name="aceito" id="aceito" required value="1">
                    </div>
                </div>
                
            <input type="hidden" name="id_indicador" value="<?=$cliente['id_cliente'];?>">
            <button class="btCadastrar">Concluir Cadastro</button>
            </form>
        </article>
    </div>
</section>
