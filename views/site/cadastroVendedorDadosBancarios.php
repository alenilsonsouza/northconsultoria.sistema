<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Olá <?=$nome;?>,<br>Informe seus dados bancário.</h1>
            <p></p>
        </header>
        <?php if(!empty($aviso)):?>
            <div class="aviso"><?php echo $aviso;?></div>
        <?php endif;?>
        <article class="area-conteuto-texto"> 
            <form action="<?=BASE_URL;?>cadastrovendedor/storageDadosBanco" method="post">               
                <div class="grid grid4col">
                    <div>
                        <label for="banco">Banco</label>
                        <select name="banco" id="banco">
                            <?php foreach($bancos as $banco):?>
                                <option value="<?=$banco->getBanco();?>"><?=$banco->getBanco();?></option>
                                
                            <?php endforeach;?>
                            <option value="outro">Outro Banco</option>
                        </select>
                        <input type="text" name="outro_banco" placeholder="Informe no nome do banco" style="display:none" id="outro_banco">
                    </div>
                    <div>
                        <label for="agencia">Agência</label>
                        <input type="tel" name="agencia" required maxlength="6">
                    </div>
                    <div>
                        <label for="conta">Conta com Dígito</label>
                        <input type="tel" name="conta" required maxlength="13">
                    </div>
                    <div>
                        <label for="tipo">Tipo</label>
                        <select name="tipo">
                            <option value="1">Conta Corrente</option>
                            <option value="2">Conta Poupança</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid4col">
                    <div>
                        <label for="nome_titular">Nome completo do titular</label>
                        <input type="text" name="nome_titular" required>
                    </div>
                    <div>
                        <label for="cpf_titular">CPF do titular</label>
                        <input type="tel" name="cpf_titular" required id="cpf_titular">
                    </div>
                </div>
                <div class="grid grid4col">
                    <div>
                        <input type="submit" value="Prosseguir" class="bt btBackgroundVerde colorAzul">
                    </div>
                </div>
            </form>
        </article>
    </div>
</section>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
var element = document.getElementById('cpf_titular');
var maskOptions = {
  mask: '000.000.000-00'
};
var mask = IMask(element, maskOptions);

let banco = document.querySelector('#banco');
let outro_banco = document.querySelector('#outro_banco');
banco.addEventListener('change', function(){
    if(banco.value == 'outro'){
        outro_banco.setAttribute('style','display:block');
    }else{
        outro_banco.value = '';
        outro_banco.setAttribute('style','display:none');
        
    }
});
</script>
