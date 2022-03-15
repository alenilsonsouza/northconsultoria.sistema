<div class="row">
    <div class="col s12">
        <h5>Níveis</h5>
        <a href="<?php echo BASE_URL;?>painelarvore" class="btn">Árvore</a>
        <p>Gerencie os níveis e seus valores para a sua rede.</p>
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
                <input type="number" required name="nivel">
                <label for="nivel">Nível:</label>
            </div>
            <div class="input-field col s4">
                <input type="tel" required name="valor_comissao">
                <label for="valor_comissao">Valor Comissão:</label>
            </div>
            <div class="input-field col s4">
                <input type="submit" value="Cadastrar">
                
            </div>
        </div>
    </form>
</div>
<div class="row">
    <div class="col s12">
        
        <table class="striped">
            <tr>
                <th width="60">Nível</th>
                <th width="100">Comissão</th>
                <th>Ações</th>
            </tr>
            <?php foreach($niveis as $nivel):?>
                <tr>
                    <td><?php echo $nivel['nivel'];?></td>
                    <td><?php echo number_format($nivel['valor_comissao'],2,",",".");?></td>
                    <td>
                        <a href="<?php echo BASE_URL;?>painelniveis/editar/<?php echo md5($nivel['id']);?>" class="btn">Editar</a>
                        <a href="<?php echo BASE_URL;?>painelniveis/excluir/<?php echo md5($nivel['id']);?>" class="btn" onclick="return confirm('Deseja realmente excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>