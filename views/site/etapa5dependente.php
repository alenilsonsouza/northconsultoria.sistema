<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Cadastro de dependente</h1> 
            <p>Se houve depentende é só preencha as informações abaixo e clicar em adicionar.<br>Para cada Dependente adiciona será acrescentado o valor de <strong>R$ 29,90</strong> junto a mensalidade</p>
            <?php if(!empty($flash)):?>
            <p class="aviso"><?=$flash;?></p>
            <?php endif;?>
        </header>
        <div class="destaque">
            <p>Informações do Corretor</p>
            <p><strong>Nome:</strong><br>
            <?=$cliente['nome_cliente'];?></p>
            <p><strong>CPF:</strong><br>
            <?=$cliente['cpf_cliente'];?></p>
        </div>
        <article class="area-conteuto-texto"> 
            <form action="<?=BASE_URL;?>cadastro/storageDependente" method="post">
            <div class="grid grid4col">
                    <div>
                        <label for="nome_mae">Nome Dependente:</label>
                        <input type="text" name="nome_dependente" required autofocus>
                    </div>
                    <div>
                    <label for="cpf">CPF:</label>
                        <input type="tel" name="cpf" required id="cpf">
                        <div class="avisoTexto"></div>
                    </div>
                    <div>
                        <label for="cartao_sus">Cartão SUS:</label>
                        <input type="tel" name="cartao_sus" required maxlength="15">
                    </div>
                    <div>
                        <label for="nome_mae">Nome da mãe:</label>
                        <input type="text" name="nome_mae" required>
                    </div>
            </div>
            <div class="grid grid4col">
                <div>
                    <label for="data_nascimento">Nascimento:</label>
                    <div class="grid grid3col">
                        <select name="dia">
                            <option value="">DIA:</option>
                            <?php for($i=1;$i<=31;$i++):?>
                                
                                <option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?>"><?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?></option>
                            <?php endfor;?>
                        </select>
                        <select name="mes">
                        <option value="">MÊS:</option>
                                <?php $data = new Data();?>
                            <?php for($i=1;$i<=12;$i++):?>
                                <option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?>"><?php echo $data->getMes($i);?></option>
                            <?php endfor;?>
                        </select>
                        <select name="ano">
                        <option value="">ANO:</option>
                            
                            <?php $ano = date('Y'); $antigo = $ano - 85;?>    
                            <?php for($i=$ano;$i>=$antigo;$i--):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div>
                    <label for="parentesco">Parentesco:</label>
                    <select name="parentesco">
                        <?php foreach($parentescos as $parentesco):?>
                            <option value="<?=$parentesco->getId();?>"><?=$parentesco->getNome();?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div>
            <input type="hidden" name="id_indicador" value="<?=$cliente['id_cliente'];?>">
            <button class="bt btBackgroundVerde colorAzul">Adicionar Dependente</button>
            
            </div>
            </form>
            <hr>
            
            <table>
                <tr>
                    <th>Dependente</th>
                    <th>CPF</th>
                    <th>Plano</th>
                    <th>Parentesco</th>
                    <th>Valor</th>
                    <th width="100">Ações</th>
                </tr>
                <?php foreach($_SESSION['dependentes'] as $key => $dependente):?>
                    <tr>
                        <td><?=$dependente['nome'];?></td>
                        <td><?=$dependente['cpf'];?></td>
                        <td><?=$dependente['plano'];?></td>
                        <td><?=$dependente['nomeParentesco'];?></td>
                        <td>R$ <?=number_format($dependente['valor'],2,',','.');?></td>
                        <td>
                            <a href="<?=BASE_URL;?>cadastro/delDependente/<?=$key;?>">Excluir</a>
                        </td>
                    </tr>
                    <?php $valor[] = $dependente['valor'];?>
                <?php endforeach;?>
            </table>
            <?php if(count($_SESSION['dependentes'])==0):?>
                <p>Sem registros de dependentes</p>
            <?php endif;?>
            <p style="margin-bottom:15px">
            <?php if(isset($dependente['valor'])):?>
            Total: R$ <?=number_format(array_sum($valor),2,",",".");?>
            <?php endif;?>
            </p>
            <a href="<?=BASE_URL;?>cadastro/etapa6" class="botao bt btBackgroundVerde colorAzul inline-block">Avançar ></a>
        </article>
    </div>
</section>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
    let cpf = document.querySelector('#cpf');
    IMask(cpf,{
        mask:'000.000.000-00'
    });
</script>