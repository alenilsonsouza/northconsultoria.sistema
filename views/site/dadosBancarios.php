<section class="area-conteudo">
    <div class="conteudo">
        <header class="area-titulo">
            <h2>Vamos continuar com o seu cadastro.</h2> 
            <div class="destaque">
                <p>Informações do Corretor</p>
                <p><strong>Nome:</strong><br>
                <?=$cliente['nome_cliente'];?></p>
                <p><strong>CPF:</strong><br>
                <?=$cliente['cpf_cliente'];?></p>
            </div>
            <p>Olá <?=$infocad['nome'];?>, Preencha as informações abaixo.</p>
            <?php if(!empty($flash)):?>
            <p class="aviso"><?=$flash;?></p>
            <?php endif;?>
        </header>
        <article class="area-conteuto-texto"> 
            <form action="<?=BASE_URL;?>cadastro/storageBanco" method="post">
            <div class="grid l4">
                    <div>
                        <label for="nome_banco">Nome do Banco:</label>
                        <input type="text" name="nome_banco" required autofocus>
                    </div>
                    <div>
                        <label for="agencia">Agência:</label>
                        <input type="tel" name="agencia" required>
                    </div>
                    <div>
                        <label for="conta">Nº da Conta:</label>
                        <input type="tel" name="conta" required>
                    </div>
                    <div>
                        <label for="tipo_conta">Tipo:</label>
                        <select name="tipo_conta" id="">
                            <option value="1">Corrente</option>
                            <option value="2">Poupança</option>
                        </select>
                    </div>
                </div>
                
            <input type="hidden" name="id_indicador" value="<?=$cliente['id_cliente'];?>">
            <button class="btCadastrar">Prosseguir</button>
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