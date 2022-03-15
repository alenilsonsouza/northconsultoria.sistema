<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Preencha suas informações Pessoais.</h1>
            <p><strong>Seu CPF:</strong> <?=$cpf;?><br><strong>Seu E-mail:</strong> <?=$email;?></p>
        </header>
        <?php if(!empty($aviso)):?>
            <div class="aviso"><?php echo $aviso;?></div>
        <?php endif;?>
        <article class="area-conteuto-texto"> 
            <form action="<?=BASE_URL;?>cadastrovendedor/storageDadosPessoais" method="post">
                <div class="grid grid4col">
                    <div>
                        <label for="nome">Nome*:</label>
                        <input type="text" name="nome" required>
                    </div>                   
                    <div>
                        <label for="data_nascimento">Nascimento*:</label>
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
                        <label for="sexo">Sexo*:</label>
                        <select name="sexo" id="">
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>
                    <div>
                        <label for="telefone">Telefone*:</label>
                        <input type="tel" name="telefone" required onkeyup="return MascaraTelefone(this);" maxlength="14">
                    </div>
                </div>                
                <div class="grid grid3col">
                    <div>
                        <label for="celular">Celular*:</label>
                        <input type="tel" name="celular" required onkeyup="return MascaraCelular(this);" maxlength="15">
                    </div>
                </div>
                <div class="grid grid4col">
                    <div>
                        <input type="submit" value="Continuar" class="bt btBackgroundVerde colorAzul">
                    </div>
                </div>
            </form>
        </article>
    </div>
</section>
