<div class="row">
    <div class="col s12">
        <h5>Relatório</h5>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <h5>Relatório de Vendas por Vendedores</h5>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <select name="costumers" id="costumers" class="browser-default">
            <?php foreach($costumers as $costumer):?>
            <option value="<?=$costumer['id'];?>"><?=$costumer['name'];?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="col s6">
        <input type="date" name="start_date" id="start_date">
    </div>
    <div class="col s6">
    <input type="date" name="final_date" id="final_date">
    </div>
</div>
<div class="result"></div>
<script src="<?=BASE_URL_SCRIPT;?>Controllers/Report.js"></script>