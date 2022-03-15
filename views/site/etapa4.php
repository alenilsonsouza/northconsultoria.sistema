<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Agora informe o seu endereço.</h1> 
            
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
            <form action="<?=BASE_URL;?>cadastro/storageEt4" method="post">
                <div class="grid grid4col">
                    <div>
                        <label for="cep">CEP:</label>
                        <input type="tel" name="cep" id="cep" required maxlength="8" autofocus>
                    </div>
                    <div>
                        <label for="logradouro">Rua:</label>
                        <input type="text" name="logradouro" required id="rua">
                    </div>
                    <div>
                        <label for="numero">Número:</label>
                        <input type="tel" name="numero" required id="numero">
                    </div>
                    <div>
                        <label for="complemento">Complemento:</label>
                        <input type="text" name="complemento">
                    </div>
                </div>
                <div class="grid grid3col">
                    <div>
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" required id="bairro">
                    </div>
                    <div>
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" required id="cidade">
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <select name="estado" id="estado">
                            <?php foreach($estados as $estado):?>
                                <option value="<?php echo $estado['Uf'];?>"><?php echo $estado['Nome'];?></option>
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
