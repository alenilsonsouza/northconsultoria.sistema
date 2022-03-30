<div class="register--title">
    <h2></h2>
</div>
<div class="search-corretor">
    <form class="form_default input-corretor" method="post" id="form_search_corretor">
        <label for="n_corretor">Digite o código do vendedor</label>
        <div class="inputs">
            <input type="tel" name="n_corretor" id="n_corretor" required>
            <button type="submit"><img src="<?= BASE_URL_IMAGE; ?>loupe.png" alt="" /></button>
        </div>
    </form>
    <div>
        <input type="checkbox" name="no-corretor" id="no-corretor">
        <label for="no-corretor">Cadastrar sem informar o vendedor</label>
    </div>
    <div class="result--corretor" id="result--corretor">

    </div>
    <form action="<?= BASE_URL; ?>home/addClientAsaasInHome" method="post" class="form_default" id="form-register" enctype="multipart/form-data">
        <div class="typeRegister">
            <label for="tipo_cadastro">Escolha o tipo de cadastro</label>
            <select name="tipo_cadastro" id="tipo_cadastro">
                <option value="1">Individual</option>
                <option value="2">Empresarial</option>
            </select>
        </div>
        <div class="bussinessInput">
            <h3>Dados empresariais</h3>
            <div class="grid grid-3">
                <div>
                    <label for="cnpj">CNPJ:*</label>
                    <input type="tel" name="cnpj" id="cnpj" onkeyup="mascara('##.###.###/####-##',this,event,true);">
                </div>
                <div>
                    <label for="razao_social">Razão Social:*</label>
                    <input type="text" name="razao_social" id="razao_social">
                </div>
                <div>
                    <label for="nome_fantasia">Nome Fantasia:*</label>
                    <input type="text" name="nome_fantasia" id="nome_fantasia">
                </div>
                <div>
                    <label for="data_abertura">Data Abertura da empresa:*</label>
                    <input type="date" name="data_abertura" id="data_abertura">
                </div>
            </div>
        </div>
        <h3>Dados pessoais</h3>
        <div class="grid grid-3">
            <div>
                <label for="cpf">CPF:*</label>
                <input type="tel" name="cpf" id="cpf" onkeyup="mascara('###.###.###-##',this,event,true);" required class="cpfInput" onfocus>
                <div class="warningCPF"></div>
            </div>
            <div>
                <label for="email">E-mail:*</label>
                <input type="email" name="email" id="email" required class="input-enableDisabled emailInput">
                <div class="warningEmail"></div>
            </div>
            <div>
                <label for="fullName">Nome Completo:*</label>
                <input type="text" name="fullName" id="fullName" required class="input-enableDisabled">
            </div>
            <div>
                <label for="nameMother">Nome da Mãe:*</label>
                <input type="text" name="nameMother" id="fullName" required class="input-enableDisabled">
            </div>
            <div>
                <label for="birthdate">Data Nascimento:*</label>
                <input type="date" name="birthdate" id="birthdate" required class="input-enableDisabled">
            </div>

            <div>
                <label for="rg">RG:*</label>
                <input type="tel" name="rg" id="rg" required class="input-enableDisabled">
            </div>
            <div>
                <label for="sexo">Sexo:*</label>
                <select name="sexo" id="sexo" required class="input-enableDisabled">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
            <div>
                <label for="from">Natural de:*</label>
                <input type="text" name="from" id="from" required class="input-enableDisabled">
            </div>
            <div>
                <label for="marital_status">Estado Civil:*</label>
                <select name="marital_status" id="marital_status" required class="input-enableDisabled">
                    <option value="Solteiro (a)">Solteiro (a)</option>
                    <option value="Casado(a)">Casado(a)</option>
                    <option value="Divorciado(a)">Divorciado(a)</option>
                    <option value="Viúvo(a)">Viúvo(a)</option>
                </select>
            </div>

            <div>
                <label for="tel_fixed">Telefone Fixo:</label>
                <input type="tel" name="tel_fixed" id="tel_fixed" onkeyup="mascara('(##) ####-####',this,event,true)" class="input-enableDisabled">
            </div>
            <div>
                <label for="tel_cel">Celular (Whatsapp):*</label>
                <input type="tel" name="tel_cel" id="tel_cel" onkeyup="mascara('(##) #####-####',this,event,true)" required class="input-enableDisabled">
            </div>
        </div>
        <h3>Endereço</h3>
        <div class="grid grid-3">
            <div>
                <label for="cep">CEP:*</label>
                <input type="tel" name="cep" id="cep" required class="input-enableDisabled">
            </div>
            <div>
                <label for="logradouro">Endereço:*</label>
                <input type="text" name="logradouro" id="logradouro" required class="input-enableDisabled">
            </div>
            <div>
                <label for="numero">Número:</label>
                <input type="tel" name="numero" id="numero" class="input-enableDisabled">
            </div>
            <div>
                <label for="complemento">Complemento:</label>
                <input type="text" name="complemento" id="complemento" class="input-enableDisabled">
            </div>
            <div>
                <label for="bairro">Bairro:*</label>
                <input type="text" name="bairro" id="bairro" required class="input-enableDisabled">
            </div>
            <div>
                <label for="cidade">Cidade:*</label>
                <input type="text" name="cidade" id="cidade" requred class="input-enableDisabled">
            </div>
            <div>
                <label for="estado">Estado:*</label>
                <select name="estado" id="estado" required class="input-enableDisabled">
                    <?php $e = new Estado();
                    $items = $e->getEstados(); ?>
                    <?php foreach ($items as $item) : ?>
                        <option value="<?= $item['Uf']; ?>"><?= $item['Nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <h3>Documentos</h3>
        <div class="grid grid-3">
            <div>
                <label for="file_rf">Foto do RG:</label>
                <input type="file" name="file_rg" id="file_rg" required accept="image/*" class="input-enableDisabled">
                <input type="hidden" name="file_rg_title" value="RG">
            </div>
            <div>
                <label for="file_cpf">Foto do CPF:</label>
                <input type="file" name="file_cpf" id="file_cpf" required accept="image/*" class="input-enableDisabled">
                <input type="hidden" name="file_cpf_title" value="CPF">
            </div>
            <div>
                <label for="file_cr">Foto do Comprovante de residência:</label>
                <input type="file" name="file_cr" id="file_cr" required accept="image/*" class="input-enableDisabled">
                <input type="hidden" name="file_cr_title" value="CR">
            </div>
        </div>
        <h3>Dependentes</h3>

        <div class="bt_dependentes area-dependentes-form">

        </div>
        <div class="areaAddDependentes">
            <button type="button" id="addDependente">+ Adicionar Dependentes</button>
        </div>
        <h3>Aviso de Vigência</h3>
        <p>A Vigência sempre é dia 15 para cadastros efetuados até dia 05 de cada mês.</p>
        <h3>Carteirinha</h3>
        <p>Você receberá sua carteirinha virtual no e-mail e whatsapp informado aqui no cadastro.</p>
        <h3>Termo e Adesão</h3>
        <div class="term">
            <div class="term-text"><?php require_once 'term.php'; ?></div>
            <div class="inputTerm">
                <input type="checkbox" name="aceito" id="aceito" required class="input-enableDisabled"> <label for="aceito">Concordo e aceito o termo.</label>
            </div>

        </div>
        <div>
            <input type="hidden" value="<?= isset($_SESSION['sender']['id']) ? $_SESSION['sender']['id'] : ''; ?>" name="id_corretor" id="id_corretor" />
            <input type="hidden" value="" name="id_plan" id="id_plan" />
            <input type="hidden" value="" name="id_client" id="id_client">
            <input type="hidden" value="" name="planValue" id="planValue">
            <input type="hidden" value="" name="planName" id="planName">
            <button type="submit" class="button input-enableDisabled" id="btSubmitForm">Finalizar Cadastro</button>
        </div>
    </form>
</div>
<script src="<?= BASE_URL; ?>assets/js/Controllers/Register.js" defer></script>
<script src="<?= BASE_URL; ?>assets/js/Controllers/Cep.js"></script>