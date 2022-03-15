<div class="row">
    <div class="col s12">
        <h5>Editar Níveis <?php echo $nivel['nivel'];?></h5>
    </div>
</div>
<?php if(!empty($aviso)):?>
<div class="row">
    <div class="col s12 m12">
        <div class="card blue-grey darken-1">
        <div class="card-content white-text">
            <span class="card-title">Aviso</span>
            <p><?php echo $aviso;?></p>
        </div>
        </div>
    </div>
</div>
<?php endif;?>
<div class="row">
    <form method="post" class="col s12">
        <div class="row">
            <div class="input-field col s4">
                <input type="number" required name="nivel" value="<?php echo $nivel['nivel'];?>" readonly>
                <label for="nivel">Nível:</label>
            </div>
            <div class="input-field col s4">
                <input type="tel" required name="valor_comissao" value="<?php echo $nivel['valor_comissao'];?>">
                <label for="valor_comissao">Valor Comissão:</label>
            </div>
            <div class="input-field col s4">
                <input type="submit" value="Atulizar">
                
            </div>
        </div>
    </form>
</div>