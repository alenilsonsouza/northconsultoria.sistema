<div class="row">
	<div class="col s12">
		<h5>Informações de Banco</h5>
        <p>Olá <?=$cliente['nome_cliente'];?>, a conta bancária deve deve ser sua (Vinculada ao seu CPF). <strong>Não pode ser conta bancária de terceiros.</strong><p>
	</div>
</div>
<div class="row">
	<form method="post" class="col s12" action="<?=BASE_URL;?>arbanco/storeage">
		<div class='row'>
            <div class="col s12 m3">
                <label for="banco">Banco</label>
                <select name="banco" class="browser-default">
                    <option value="<?=$banco->getBanco();?>"><?=$banco->getBanco();?></option>
                    <?php foreach($bancos as $b):?>
                        <option value="<?=$b->getBanco();?>"><?=$b->getBanco();?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="input-field col s12 m3">
                <input type="tel" name="agencia" value="<?=$banco->getAgencia();?>" required>
                <label for="agencia">Agência</label>
            </div>
            <div class="input-field col s12 m3">
                <input type="tel" name="conta" value="<?=$banco->getConta();?>" required>
                <label for="conta">Conta</label>
            </div>
            <div class="col s12 m3">
                <label>Tipo</label>
                <select class="browser-default" name="tipo">
                    <option value="1" <?=($banco->getTipo()==1)?'selected':'';?>>Corrente</option>
                    <option value="2" <?=($banco->getTipo()==2)?'selected':'';?>>Poupança</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m3">
                <input type="text" name="nome_titular" value="<?=$banco->getNomeTitular();?>" required>
                <label for="nome_titular">Nome do Titular</label>
            </div>
            <div class="input-field col s12 m3">
                <input type="tel" name="cpf_titular" value="<?=$banco->getCPFTitular();?>" required id="cpf_titular">
                <label for="cpf_titular">CPF do Titular</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="hidden" value="<?=$banco->getId();?>" name="id">
                <button class="btn">Atualizar</button>
            </div>
        </div>
    </form>
</div>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
var element = document.getElementById('cpf_titular');
var maskOptions = {
  mask: '000.000.000-00'
};
var mask = IMask(element, maskOptions);
</script>