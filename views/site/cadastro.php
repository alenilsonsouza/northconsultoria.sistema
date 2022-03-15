<section class="area-conteudo">
    <div class="conteudo">
        <header class="area-titulo">
            <h2>Cadastro</h2>
        </header>
        <div class="destaque">
                <p>Informações do seu id de Parceiro</p>
                <p><strong>Nome:</strong><br>
                <?=$cliente['nome_cliente'];?></p>
                <p><strong>CPF:</strong><br>
                <?=$cliente['cpf_cliente'];?></p>
            </div>
        <?php if(!empty($aviso)):?>
            <p><?php echo $aviso;?></p>
        <?php endif;?>
        <article class="area-conteuto-texto"> 
            <form action="" method="post">
                <div class="grid l4">
                    <div>
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" required>
                    </div>
                    <div>
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" required value="<?=$infocad['email'];?>" readonly>
                    </div>
                    <div>
                        <label for="cpf">CPF: <span class="avisoTexto"></span></label>
                        <input type="tel" name="cpf" id="cpf" required value="<?=$infocad['cpf'];?>" readonly>
                    </div>
                    <div>
                        <label for="data_nascimento">Nascimento:</label>
                        <div class="grid l3 gridselect">
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
                </div>
                <div class="grid l4">
                    <div>
                        <label for="nome_mae">Nome da mãe:</label>
                        <input type="text" name="nome_mae" required>
                    </div>
                    <div>
                        <label for="estado_civil">Estado Civil:</label>
                        <select name="estado_civil" id="estado_civil">
                            <?php foreach($estadoCivil as $estadoCivil):?>
                            <option value="<?php echo $estadoCivil['id'];?>"><?php echo $estadoCivil['nome'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div>
                        <label for="rg">RG:</label>
                        <input type="tel" name="rg" required>
                    </div>
                    <div>
                        <label for="plano">Plano:</label>
                        <select name="plano" id="plano">
                            <?php foreach($planos as $plano):?>
                            <option value="<?php echo $plano['id'];?>"><?php echo $plano['nome'];?> - R$ <?php echo number_format($plano['valor'],2,',','.');?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                
                <div class="grid l3">
                    <div>
                        <label for="sexo">Sexo:</label>
                        <select name="sexo" id="">
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                    <div>
                        <label for="telefone">Telefone:</label>
                        <input type="tel" name="telefone" required onkeyup="return MascaraTelefone(this);" maxlength="14">
                    </div>
                    <div>
                        <label for="celular">Celular:</label>
                        <input type="tel" name="celular" required onkeyup="return MascaraCelular(this);" maxlength="15">
                    </div>
                    
                </div>
                <div class="grid l4">
                    <div>
                        <label for="cep">CEP:</label>
                        <input type="tel" name="cep" id="cep" required maxlength="8">
                    </div>
                    <div>
                        <label for="logradouro">Rua:</label>
                        <input type="text" name="logradouro" required id="rua">
                    </div>
                    <div>
                        <label for="numero">Número:</label>
                        <input type="tel" name="numero" required id="numero">
                    </div>
                    <div>
                        <label for="complemento">Complemento:</label>
                        <input type="text" name="complemento">
                    </div>
                </div>
                <div class="grid l3">
                    <div>
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" required id="bairro">
                    </div>
                    <div>
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" required id="cidade">
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <select name="estado" id="estado">
                            <?php foreach($estados as $estado):?>
                                <option value="<?php echo $estado['Uf'];?>"><?php echo $estado['Nome'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    
                </div>
                <div class="grid l2">
                    <div>
                        <label for="senha">Senha: Mínimo 6 carateres</label>
                        <input type="password" name="senha" required id="senha">
                    </div>
                    <div>
                        <label for="senha">Confirmar Senha:</label>
                        <input type="password" name="confirmar_senha" required id="confirmar_senha">
                    </div>
                </div>
                <div class="grid l1">
                    <div>
                        <label for="aceito">Aceito os termos</label>
                        <input type="checkbox" name="aceito" id="aceito" required value="1">
                    </div>
                </div>
                <div class="grid l4">
                    <div>
                        <input type="submit" value="cadastrar">
                    </div>
                </div>
            </form>
        </article>
    </div>
</section>
