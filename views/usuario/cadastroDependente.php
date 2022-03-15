<?php require 'partials/carregando.php';?>
<div class="row">
    <div class="col s12">
        <h5>Cadastre seus dependentes</h5>
        <p>Cadastre seus dependentes abaixo. Ao terminar clique em concluir</p>
    </div>
</div>
<div class="row">
    <form action="<?=BASE_URL;?>arcompraplano/storageDependente" method="post" class="col s12">
        <div class="row">
            <div class="input-field col s3">
                <input type="text" name="nome_dependente" required autofocus>
                <label for="nome_mae">Nome Dependente:</label>
            </div>
            <div class="input-field col s3">
                <input type="tel" name="cpf" required id="cpf">
                <label for="cpf">CPF:</label>
                <div class="avisoTexto"></div>
            </div>
            <div class="input-field col s3">
                
                <input type="tel" name="cartao_sus" required maxlength="15">
                <label for="cartao_sus">Cartão SUS:</label>
            </div>
            <div class="input-field col s3">
                <input type="text" name="nome_mae" required>
                <label for="nome_mae">Nome da mãe:</label>
            </div>
        </div>
        <div class="row">
            <div class="col s4">
                <div class="col s12">
                    <label>Data de Nascimento</label>
                </div>
                    <div class="col s4">
                        <select name="dia" class="browser-default">
                            <option value="">DIA:</option>
                            <?php for($i=1;$i<=31;$i++):?>
                                
                                <option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col s4">
                        <select name="mes" class="browser-default">
                        <option value="">MÊS:</option>
                                <?php $data = new Data();?>
                            <?php for($i=1;$i<=12;$i++):?>
                                <option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?>"><?php echo $data->getMes($i);?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col s4">
                        <select name="ano" class="browser-default">
                        <option value="">ANO:</option>
                            
                            <?php $ano = date('Y'); $antigo = $ano - 85;?>    
                            <?php for($i=$ano;$i>=$antigo;$i--):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                </div>
                <div class="col s4">
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="" class="browser-default">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div class="col s4">
                    <label for="parentesco">Parentesco:</label>
                    <select name="parentesco"  class="browser-default">
                        <?php foreach($parentescos as $parentesco):?>
                            <option value="<?=$parentesco->getId();?>"><?=$parentesco->getNome();?></option>
                        <?php endforeach;?>
                    </select>
                </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button class="btn">Cadastrar Dependente</button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    <div class="col s12">
        <table class="striped">
            <tr>
                <th>Dependente</th>
                <th>CPF</th>
                <th>Plano</th>
                <th>Parentesco</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
            <?php foreach($dependentes as $key => $dependente):?>
                <tr>
                    <td><?=$dependente['nome'];?></td>
                    <td><?=$dependente['cpf'];?></td>
                    <td><?=$dependente['plano'];?></td>
                    <td><?=$dependente['nomeParentesco'];?></td>
                    <td>R$ <?=number_format($dependente['valor'],2,',','.');?></td>
                    <td>
                        <a href="<?=BASE_URL;?>arcompraplano/delDependente/<?=$key;?>">Excluir</a>
                    </td>
                </tr>
                <?php $valor[] = $dependente['valor'];?>
            <?php endforeach;?>
        </table>
        <?php if(count($dependentes)==0):?>
                <p>Sem registros de dependentes</p>
            <?php endif;?>
            <p style="margin-bottom:15px">
            <?php if(isset($dependente['valor'])):?>
            Total: R$ <?=number_format(array_sum($valor),2,",",".");?>
            <?php endif;?>
            </p>
            <a href="<?=BASE_URL;?>arcompraplano/concluir" class="btn carregando">Concluir ></a>
    </div>
</div>
<script src="<?=BASE_URL;?>assets/js/script.js"></script>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
    var element = document.getElementById('cpf');
    var maskOptions = {
    mask: '000.000.000-00'
    };
    var mask = IMask(element, maskOptions);
    if(document.querySelector('.carregando')){
        let carregando = document.querySelector('.carregando');
        let uploading = document.querySelector('#uploading');
        carregando.addEventListener('click', ()=>{
            uploading.setAttribute('style', 'display:flex');
        });
    }
</script>