<div class="row">
    <div class="col s12">
        <h5>Escolha o seu plano:</h5>
    </div>
</div>
<div class="row">
    <form class="col s12" method="post" action="<?=BASE_URL;?>arcompraplano/storagePlano">
        <div class="row">
            <div class="col s12">
                <select name="plano" class="browser-default">
                    <?php foreach($planos as $plano):?>
                    <option value="<?=$plano['id'];?>"><?=$plano['nome'];?> - R$ <?=number_format($plano['valor'],2,',','.');?></option>
                    <?php endforeach;?>
                </select>
            </div>
            
        </div>
        <div class="row">
            <div class="col s12">
                <input type="hidden" value="<?=$cliente['id_cliente'];?>" name="id_cliente">
                <button class="btn">Adiquirir</button>
            </div>
        </div>
    </form>
</div>