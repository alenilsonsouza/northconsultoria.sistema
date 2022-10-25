<div class="register--title">
    <h2></h2>
</div>
<div class="search-corretor">
    <form class="form_default input-corretor" method="post" id="form_search_corretor">
        <label for="n_corretor">Digite o código do vendedor e ENTER</label>
        <div class="inputs">
            <input type="number" min="1" name="n_corretor" id="n_corretor" required placeholder="Ex.: 69">
            <button type="submit"><img src="<?= BASE_URL_IMAGE; ?>loupe.png" alt="" /></button>
        </div>
    </form>
    <div class="checkBoxChoose">
        <input type="checkbox" name="no-corretor" id="no-corretor">
        <label for="no-corretor">Cadastrar sem informar o vendedor</label>
    </div>
    <div class="result--corretor" id="result--corretor">

    </div>
</div>
<div>
    <form action="<?= BASE_URL; ?>home/addClientAsaasInHome" method="post" class="form_default" id="form-register" enctype="multipart/form-data">
        
        <div class="typeRegister">
            <label for="financial_responsible">Quem é o Responsável Financeiro?</label>
            <select name="financial_responsible" id="financial_responsible">
                <option value="1">Titular</option>
                <option value="2">Outro</option>
            </select>
        </div>
        <div class="financialResponsibleInput">
            <h3>Resposável Financeiro</h3>
            <div class="grid grid-3">
                <div>
                    <label for="fr_cpf">CPF:*</label>
                    <input type="tel" name="fr_cpf" id="fr_cpf" onkeyup="mascara('###.###.###-##',this,event,true);">
                </div>
                <div>
                    <label for="fr_name">Nome Responsável Financeiro:*</label>
                    <input type="text" name="fr_name" id="fr_name">
                </div>
                <div>
                    <label for="fr_email">E-mail:*</label>
                    <input type="email" name="fr_email" id="fr_email">
                </div>
                <div>
                    <label for="fr_birthdate">Data Nascimento:*</label>
                    <input type="date" name="fr_birthdate" id="fr_birthdate">
                </div>
                <div>
                <label for="fr_sexo">Sexo:*</label>
                <select name="fr_sexo" id="fr_sexo">
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
            <div>
                <label for="fr_tel_cel">Celular:*</label>
                <input type="tel" name="fr_tel_cel" id="fr_tel_cel" onkeyup="mascara('(##) #####-####',this,event,true)">
            </div>
            <div>
                <label for="fr_parentesco">Perentesco:</label>
                <select name="fr_parentesco" id="fr_parentesco">
                    <option value="Amigo(a)">Amigo(a)</option>
                    <option value="Vizinho(a)">Vizinho(a)</option>
                    <option value="Cunhado(a)">Cunhado(a)</option>
                    <option value="Pai">Pai</option>
                    <option value="Mãe">Mãe</option>
                    <option value="Esposo(a)">Esposo(a)</option>
                    <option value="Irmão">Irmão</option>
                    <option value="Irmã">Irmã</option>
                    <option value="Primo(a)">Primo(a)</option>
                    <option value="Tio(a)">Tio(a)</option>
                    <option value="Filho(a)">Filho(a)</option>
                </select>
            </div>
            </div>
            
        </div>
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
        <h3>Dados pessoais (Titular)</h3>
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
        <h3>Documentos (JPG, PNG, GIF, PDF)</h3>
        <div class="grid grid-3">
            <div>
                <label for="file_rg">Foto do RG (FRENTE):</label>
                <input type="file" name="file_rg" id="file_rg" required accept=".jpg, .jpeg, .png, .pdf, .gif" class="input-enableDisabled">
                <input type="hidden" name="file_rg_title" value="RG">
            </div>
            <div>
                <label for="file_rg_verso">Foto do RG (VERSO):</label>
                <input type="file" name="file_rg_verso" id="file_rg_verso" required accept=".jpg, .jpeg, .png, .pdf, .gif" class="input-enableDisabled">
                <input type="hidden" name="file_rg_title_verso" value="RG">
            </div>
            <div>
                <label for="file_cpf">Foto do CPF:</label>
                <input type="file" name="file_cpf" id="file_cpf" required accept=".jpg, .jpeg, .png, .pdf, .gif" class="input-enableDisabled">
                <input type="hidden" name="file_cpf_title" value="CPF">
            </div>
            <div>
                <label for="file_cr">Foto do Comprovante de residência:</label>
                <input type="file" name="file_cr" id="file_cr" required accept=".jpg, .jpeg, .png, .pdf, .gif" class="input-enableDisabled">
                <input type="hidden" name="file_cr_title" value="CR">
            </div>
            <div>
                <label for="file_co">Contrato (Opcional):</label>
                <input type="file" name="file_co" id="file_co" accept=".jpg, .jpeg, .png, .pdf, .gif" class="input-enableDisabled">
                <input type="hidden" name="file_co_title" value="CO">
            </div>
        </div>
        <h3>Dependentes</h3>

        <div class="bt_dependentes area-dependentes-form">

        </div>
        <div class="areaAddDependentes">
            <button type="button" id="addDependente">+ Adicionar Dependentes</button>
        </div>
        <h3>Taxa de Adesão</h3>
        <p>O valor é <strong>R$ 20,00</strong> que vem incluído no <strong>primeiro boleto</strong>.</p>
        <h3>Como vem a minha cobrança?</h3>
        <p>A cobrança é por boleto enviada por e-mail cadastrado nesse formulário.<br>
        O valor da fatura será:<br>
        Valor do Plano <strong>(Titular)</strong> + 10% de desconto sobre o valor do plano por cada <strong>Dependente</strong>.<br>
        <em>OBS: Somente na primeira parcela terá a taxa de adesão acrescida na fatura no valor de R$ 20,00.</em>
        </p>
        <h3>Valor por Dependente</h3>
        <p>Cada Dependente tem <strong>10% de desconto</strong> sobre o valor do plano escolhido.</p>
        <h3>Dia de Vigência do plano</h3>
        <p>A Vigência sempre é dia <strong id="effective_day">15</strong> de cada mês. Dia em que o plano começar a valer.</p>
        <h3>Dia de corte do plano</h3>
        <p>Para cadastros efetuados até dia <strong id="cutting_day">05</strong>, a parcela do plano será cobrado no mesmo mês,<br>caso o cadastro seja realizado após esse dia será cobrado no mês seguinte.</p>
        <h3>Dia de Vencimento do plano</h3>
        <p>O vencimento é sempre dia <strong id="due_day">1</strong> de cada mês.</p>
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