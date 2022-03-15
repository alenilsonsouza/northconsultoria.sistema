<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Falta pouco! Revise o seu cadastro para prosseguir.</h1> 
            
            <p>Olá <?=$infocad['nome'];?>, Revise seus dados antes de concluir.</p>
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
        
            <form action="<?=BASE_URL;?>cadastro/concluir" method="post" enctype="multipart/form-data" class="FormConcluir">
                <div class="grid grid4col">
                    <div>
                        <p><strong>Seu nome:</strong><br>
                        <?=$infocad['nome'];?></p>
                    </div>
                    <div>
                        <p><strong>Seu CPF:</strong><br>
                        <?=$infocad['cpf'];?></p>
                    </div>
                    <div>
                        <p><strong>Seu E-mail:</strong><br>
                        <?=$infocad['email'];?></p>
                    </div>
                    <div>
                        <p><strong>Data de Nascimento:</strong><br>
                        <?=date('Y-m-d',strtotime($infocad['nascimento']));?></p>
                    </div>
                    <div>
                        <p><strong>Nome da Mãe:</strong><br>
                        <?=$infocad['nome_mae'];?></p>
                    </div>
                    <div>
                        <p><strong>Estado Civil:</strong><br>
                        <?=$estado_civil['nome'];?></p>
                    </div>
                    <div>
                        <p><strong>RG:</strong><br>
                        <?=$infocad['rg'];?></p>
                    </div>
                    <div>
                        <p><strong>Sexo:</strong><br>
                        <?=$infocad['sexo'];?></p>
                    </div>
                    <div>
                        <p><strong>Telefone:</strong><br>
                        <?=$infocad['telefone'];?></p>
                    </div>
                    <div>
                        <p><strong>Celular:</strong><br>
                        <?=$infocad['celular'];?></p>
                    </div>
                    <div>
                        <p><strong>Plano:</strong><br>
                        <?=$nome_plano['nome'];?> - R$ <?=number_format($nome_plano['valor'],2,',','.');?></p>
                    </div>
                </div>
                <div class="grid grid4col">
                    <div>
                        <p><strong>CEP:</strong><br>
                        <?=$infocad['cep'];?></p>
                    </div>
                    <div>
                        <p><strong>Rua:</strong><br>
                        <?=$infocad['logradouro'];?></p>
                    </div>
                    <div>
                        <p><strong>Número:</strong><br>
                        <?=$infocad['numero'];?></p>
                    </div>
                    <div>
                        <p><strong>Complemento:</strong><br>
                        <?=$infocad['complemento'];?></p>
                    </div>
                    <div>
                        <p><strong>Cidade:</strong><br>
                        <?=$infocad['cidade'];?></p>
                    </div>
                    <div>
                        <p><strong>Bairro:</strong><br>
                        <?=$infocad['bairro'];?></p>
                    </div>
                    <div>
                        <p><strong>Estado:</strong><br>
                        <?=$infocad['estado'];?></p>
                    </div>
                </div>
                <hr>
                <div>
                    <p>Faça o upload dos documentos abaixo: (Tipos de arquivos: JPG, PNG e PDF)</p>
                </div>
                <div class="grid grid2col">
                    <div>
                        <p><strong>RG ou CNH (Frente)</strong></p>
                        <input type="file" name="arquivo1" required>
                    </div>
                    <div>
                        <p><strong>RG ou CNH (Verso)</strong></p>
                        <input type="file" name="arquivo2" required>
                    </div>
                    <div>
                        <p><strong>Cartão SUS (Verso)</strong></p>
                        <input type="file" name="arquivo3" required>
                    </div>
                    <div>
                        <p><strong>Comprovante de Residência</strong></p>
                        <input type="file" name="arquivo4" required>
                    </div>

                </div>
                <hr>
                <table>
                <tr>
                    <th>Dependente</th>
                    <th>CPF</th>
                    <th>Parentesco</th>
                    <th width="100">Ações</th>
                </tr>
                <?php foreach($_SESSION['dependentes'] as $key => $dependente):?>
                    <tr>
                        <td><?=$dependente['nome'];?></td>
                        <td><?=$dependente['cpf'];?></td>
                        <td><?=$dependente['nomeParentesco'];?></td>
                        <td>
                            <a href="<?=BASE_URL;?>cadastro/delDependente/<?=$key;?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
            <?php if(count($_SESSION['dependentes'])==0):?>
                <p>Sem registros de dependentes</p>
            <?php endif;?>
            <input type="hidden" name="id_indicador" value="<?=$cliente['id_cliente'];?>">
            <div class="grid grid2col">
                <button class="btCadastrar bt btBackgroundVerde colorAzul" type="submit">Tudo Certo e Prosseguir</button>
                <a href="<?=BASE_URL;?>" class="botao bt btBackgroundVerde colorAzul inlin-block">Reiniciar Cadastro</a>
            </div>
            
            </form>
        </article>
    </div>
</section>
<script>
    
</script>