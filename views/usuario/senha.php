<div class="row">
	<div class="col s12">
		<h5>Alterar Senha</h5>
        <p>Altere a sua senha abaixo com no mínimo 6 caracteres</p>
	</div>
</div>
<?php if(!empty($flash)):?>
<div class="row">
    <div class="col s12">
        <div class="card-panel teal lighten-2"><?=$flash;?></div>
    </div>
</div>
<?php endif;?>
<div class="row">
    
	<form method="post" class="col s12" action="<?=BASE_URL;?>arsenha/storeage">
		<div class='row'>
            <div class="input-field col s12 m3">
                <input type="password" name="senha" required>
                <label for="senha">Nova Senha</label>
            </div>
            <div class="input-field col s12 m3">
                <input type="password" name="repeti_senha" required>
                <label for="repeti_senha">Repetir a senha</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button class="btn">Atualizar</button>
            </div>
        </div>
    </form>
</div>