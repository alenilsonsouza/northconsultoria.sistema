<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Vamos continuar com o seu cadastro.</h1> 
            
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
            <form action="<?=BASE_URL;?>cadastro/storageEt3" method="post">
            <div class="grid grid4col">
                    <div>
                        <label for="nome_mae">Nome da mãe:</label>
                        <input type="text" name="nome_mae" required autofocus>
                    </div>
                    <div>
                        <label for="estado_civil">Estado Civil:</label>
                        <select name="estado_civil" id="estado_civil">
                            <?php foreach($estadoCivil as $estadoCivil):?>
                            <option value="<?php echo $estadoCivil['id'];?>"><?php echo $estadoCivil['nome'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div>
                        <label for="rg">RG:</label>
                        <input type="tel" name="rg" required>
                    </div>
                    <div>
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="">
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid3col">
                    <div>
                        <label for="cartao_sus">Cartão SUS:</label>
                        <input type="tel" name="cartao_sus" required>
                    </div>
                    <div>
                        <label for="telefone">Seu Telefone:</label>
                        <input type="tel" name="telefone" required onkeyup="return MascaraTelefone(this);" maxlength="14">
                    </div>
                    <div>
                        <label for="celular">Seu Celular:</label>
                        <input type="tel" name="celular" required onkeyup="return MascaraCelular(this);" maxlength="15">
                    </div>
                    
                </div>
            <input type="hidden" name="id_indicador" value="<?=$cliente['id_cliente'];?>">
            <button class="btCadastrar bt btBackgroundVerde colorAzul">Prosseguir</button>
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