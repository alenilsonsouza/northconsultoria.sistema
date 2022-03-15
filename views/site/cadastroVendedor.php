<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
        <h1>Informe o seu CPF<br>para prosseguir<br>com o cadastro</h1>
            <p>Ganhe comissões nas parcelas<br>pagas pelos seus clientes</p>
        </header>
        <?php if(!empty($aviso)):?>
            <p><?php echo $aviso;?></p>
        <?php endif;?>
        <article class="area-conteuto-texto"> 
            <form action="<?=BASE_URL;?>cadastrovendedor/storageCPF" method="post">
                <div class="grid l4">
                    <div>
                       <label for="cpf">CPF*: <span class="avisoTexto"></span></label>
                        <input type="tel" name="cpf" id="cpf" required value="">
                    </div>
                </div>
                <div class="grid l4">
                    <div>
                        <input type="submit" value="Continuar" class="btCadastrar bt btBackgroundVerde colorBranco" style="display:none">
                    </div>
                </div>
            </form>
        </article>
    </div>
</section>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
var element = document.getElementById('cpf');
var maskOptions = {
  mask: '000.000.000-00'
};
var mask = IMask(element, maskOptions);
</script>
