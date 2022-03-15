<section class="area-conteudo areaConteudoFundoAzul">
    <div class="conteudo">
        <header class="tituloArea">
            <h1>Informe sua data de Nascimento</h1>

            <p>Olá <?= $infocad['nome']; ?>, precisamos saber se você é maior de 18 anos.</p>
            <?php if (!empty($flash)) : ?>
                <p class="aviso"><?= $flash; ?></p>
            <?php endif; ?>
        </header>
        <div class="destaque">
            <p>Informações do seu id de Parceiro</p>
            <p><strong>Nome:</strong><br>
                <?= $cliente['nome_cliente']; ?></p>
            <p><strong>CPF:</strong><br>
                <?= $cliente['cpf_cliente']; ?></p>
        </div>
        <article class="area-conteuto-texto">
            <form action="<?= BASE_URL; ?>cadastro/verifyBothdate" method="post">
                <div class="areaFom1">
                    <div>
                        <label for="data_nascimento">Informe a sua Data de Nascimento:</label>
                        <div class="grid grid3col">
                            <select name="dia" required>
                                <option value="0">DIA:</option>
                                <?php for ($i = 1; $i <= 31; $i++) : ?>

                                    <option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?>"><?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?></option>
                                <?php endfor; ?>
                            </select>
                            <select name="mes" required>
                                <option value="0">MÊS:</option>
                                <?php $data = new Data(); ?>
                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                    <option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?>"><?php echo $data->getMes($i); ?></option>
                                <?php endfor; ?>
                            </select>
                            <select name="ano" required>
                                <option value="0">ANO:</option>

                                <?php $ano = date('Y');
                                $antigo = $ano - 85; ?>
                                <?php for ($i = $ano; $i >= $antigo; $i--) : ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="id_indicador" value="<?= $cliente['id_cliente']; ?>">
                    <button class="btCadastrar bt btBackgroundVerde colorAzul">Prosseguir</button>
                </div>
            </form>
        </article>
    </div>
</section>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
    let cpf = document.querySelector('#cpf');
    IMask(cpf, {
        mask: '000.000.000-00'
    });
</script>