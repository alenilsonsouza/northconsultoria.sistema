<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th width="50">ID</th>
                <th width="200">Dt Cadastro</th>
                <th>Nome</th>
                <th>Plano</th>
                <th>E-mail</th>
                <th width="340">Ações</th>
            </tr>
            <?php foreach($clientes as $cliente):?>
            <tr>
                <td><?php echo $cliente['id'];?></td>
                <td><?=date('d/m/Y', strtotime($cliente['date_register']));?></td>
                <td>
                    <?=$cliente['name'];?><br />
                    <small><?=$cliente['cpf'];?></small>
                </td>
                <td>
                    <?php if(isset($cliente['plan']['product'])):?>
                    <?= (isset($cliente['plan']['product']))?$cliente['plan']['product']:'';?><br />
                    <small><?=$cliente['plan']['price_real'];?></small>
                    <?php endif;?>
                </td>
                <td><?=$cliente['email'];?></td>
                <td>
                    <a href="<?php echo BASE_URL;?>painelcadastros/ver/<?=$cliente['id'];?>" class="btn">Ver cadastro</a>
                    <a href="<?php echo BASE_URL;?>painelcadastros/excluir/<?=$cliente['id']; ?>?pagina=dependentes/<?=$cliente['holder']['id'];?>" class="btn">Excluir</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>

