<div class="row">
    <div class="col s12">
        <nav class="menuInterno">
            <ul>
                <li><a href="<?= BASE_URL; ?>painelcadastros">Voltar</a></li>
            </ul>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <?php if (isset($cliente['name'])) : ?>
            <h5>Informações Cadastrais de <strong><?= $cliente['name']; ?> (<?= $cliente['type_register_text']; ?>)</strong>
            </h5>
        <?php else : ?>
            <h5>Cadastre um vendedor abaixo</h5>
        <?php endif; ?>
        <?php if (isset($cliente['type_register'])) : ?>
            <?php if ($cliente['type_register'] == 'D') : ?>
                <p><strong>Titular:</strong> <?= $cliente['holder']['name']; ?></p>
                <p><strong>Plano:</strong> <?= $cliente['plan']['product']; ?> - <?= $cliente['plan']['price_real']; ?></p>
            <?php elseif ($cliente['type_register'] == 'T') : ?>
                <p><strong>Vendedor:</strong> <?= $cliente['sender']['name'] ?? 'Nenhum'; ?></p>
                <p><strong>Plano:</strong> <?= $cliente['plan']['product']; ?> - <?= $cliente['plan']['price_real']; ?></p>
            <?php endif; ?>
        <?php endif; ?>

        <p>
            <strong>Termos aceito: </strong> <?= $cliente['termo'] == 'S' ? 'SIM' : 'NÃO'; ?>
            <?php if ($cliente['termo'] == 'N') : ?>
                <br><a href="#contrato">Enviar o contrato<br>para aceite do termo</a>
            <?php endif; ?>
        </p>
        <p><strong>Documentos: </strong><?=count($cliente['files']);?></p>

    </div>
</div>
<div class="row">
    <?php if (isset($patrocinador['nome_cliente'])) : ?>
        <div class="col s6">
            <p><strong>Patrocinador:</strong>
                <?= isset($patrocinador['nome_cliente']) ? $patrocinador['nome_cliente'] : ''; ?></p>
        </div>
    <?php endif; ?>
    <form action="<?= BASE_URL; ?>painelcadastros/<?= $linkToAction; ?>" method="post" class="col s12">
        <?php if (is_array($cliente['responsavel_financeiro']) || $addRF == 1) : ?>
            <?php $RF = $cliente['responsavel_financeiro']; ?>
            <div class="row">
                <div class="col s12">
                    <?php if ($addRF == 1) : ?>
                        <p><strong>Adicione abaixo o Responsável Financeiro e depois salve as alterações:</strong></p>
                    <?php else : ?>
                        <p><strong>Responsável Financeiro:</strong></p>
                    <?php endif; ?>
                    <input type="hidden" name="fr_id" value="<?= $RF['id'] ?? ''; ?>">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <input type="text" name="fr_name" id="fr_name" value="<?= $RF['name'] ?? ''; ?>" required>
                    <label for="fr_name">Nome:</label>
                </div>
                <div class="input-field col s4">
                    <input type="tel" name="fr_cpf" id="fr_cpf" value="<?= $RF['cpf'] ?? ''; ?>" required>
                    <label for="fr_cpf">CPF:</label>
                </div>
                <div class="input-field col s4">
                    <input type="email" name="fr_email" id="fr_email" value="<?= $RF['email'] ?? ''; ?>" required>
                    <label for="fr_email">E-mail:</label>
                </div>
                <div class="input-field col s4">
                    <input type="date" name="fr_birthdate" id="fr_birthdate" value="<?= $RF['birthdate'] ?? ''; ?>" required>
                    <label for="fr_birthdate" class="active">Data Nascimento:</label>
                </div>
                <div class="col s4">
                    <label for="fr_sexo">Sexo:</label>
                    <select name="fr_sexo" id="fr_sexo" class="browser-default">
                        <option value="M" <?= isset($RF['sexo']) && $RF['sexo'] == 'M' ? 'selected' : ''; ?>>Masculino</option>
                        <option value="F" <?= isset($RF['sexo']) && $RF['sexo'] == 'F' ? 'selected' : ''; ?>>Feminino</option>
                    </select>
                </div>
                <div class="input-field col s4">
                    <input type="tel" name="fr_tel_cel" id="fr_tel_cel" value="<?= $RF['tel_cel'] ?? ''; ?>" required>
                    <label for="fr_tel_cel">Celular:</label>
                </div>
                <div class="col s4">
                    <label for="fr_kinship">Parentesco:</label>
                    <select name="fr_kinship" id="fr_kinship" class="browser-default">
                        <option value="Amigo(a)" <?= isset($RF['kinship']) && $RF['kinship'] == 'Amigo(a)' ? 'selected' : ''; ?>>Amigo(a)</option>
                        <option value="Vizinho(a)" <?= isset($RF['kinship']) && $RF['kinship'] == 'Vizinho(a)' ? 'selected' : ''; ?>>Vizinho(a)</option>
                        <option value="Cunhado(a)" <?= isset($RF['kinship']) && $RF['kinship'] == 'Cunhado(a)' ? 'selected' : ''; ?>>Cunhado(a)</option>
                        <option value="Pai" <?= isset($RF['kinship']) && $RF['kinship'] == 'Pai' ? 'selected' : ''; ?>>Pai</option>
                        <option value="Mãe" <?= isset($RF['kinship']) && $RF['kinship'] == 'Mãe' ? 'selected' : ''; ?>>Mãe</option>
                        <option value="Esposo(a)" <?= isset($RF['kinship']) && $RF['kinship'] == 'Esposo(a)' ? 'selected' : ''; ?>>Esposo(a)</option>
                        <option value="Irmão" <?= isset($RF['kinship']) && $RF['kinship'] == 'Irmão' ? 'selected' : ''; ?>>Irmão</option>
                        <option value="Irmã" <?= isset($RF['kinship']) && $RF['kinship'] == 'Irmã' ? 'selected' : ''; ?>>Irmã</option>
                        <option value="Primo(a)" <?= isset($RF['kinship']) && $RF['kinship'] == 'Primo(a)' ? 'selected' : ''; ?>>Primo(a)</option>
                        <option value="Tio(a)" <?= isset($RF['kinship']) && $RF['kinship'] == 'Tio(a)' ? 'selected' : ''; ?>>Tio(a)</option>
                        <option value="Filho(a)" <?= isset($RF['kinship']) && $RF['kinship'] == 'Filho(a)' ? 'selected' : ''; ?>>Filho(a)</option>
                    </select>
                </div>
            </div>
            <?php if ($addRF == 1) : ?>
                <div class="row">
                    <div class="col s12">
                        <a href="<?= BASE_URL; ?>painelcadastros/ver/19" class="btn">Cancelar o cadastro de Responsável Financeiro</a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (is_array($cliente['responsavel_financeiro'])) : ?>
                <div class="row">
                    <div class="col s12">
                        <a href="<?= BASE_URL; ?>painelcadastros/deleterf/<?= $RF['id']; ?>?idTitular=<?= $cliente['id']; ?>" class="btn" onclick="return confirm('Excluir o Responsável Financeiro?')">Remover o Responsável Financeiro e Atribuir ao Titular</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="row">
                <div class="col s12">
                    <p><strong>Responsável Financeiro: </strong>Titular</p>
                    <p><a href="<?= BASE_URL; ?>painelcadastros/ver/<?= $cliente['id']; ?>?fradd=1" class="btn">Adicionar outro Responsável Financeiro</a></p>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col s12">
                <p><strong>Dados do Titular:</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s4">
                <input type="tel" name="cpf" id="cpf" value="<?= $cliente['cpf'] ?? ''; ?>" <?= isset($cliente['name']) ? 'readonly' : ''; ?> required>
                <label for="cpf">CPF:</label>
            </div>

            <div class="input-field col s4">
                <input type="text" name="email" id="email" value="<?= $cliente['email'] ?? ''; ?>">
                <label for="email" required>E-mail:</label>
            </div>

            <div class="input-field col s4">
                <input type="text" name="nome" id="nome" value="<?= $cliente['name'] ?? ''; ?>" required>
                <label for="nome">Nome:</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="nome_mae" id="nome_mae" value="<?= $cliente['mother_name'] ?? ''; ?>">
                <label for="nome_mae">Nome da mãe:</label>
            </div>

            <div class="input-field col s6">
                <input type="text" name="from" id="from" value="<?= $cliente['from'] ?? ''; ?>">
                <label for="from">Natural de:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s4">
                <input type="date" name="nascimento" id="nascimento" value="<?= $cliente['birthdate'] ?? ''; ?>">
                <label for="nascimento" class="active">Data Nascimento:</label>
            </div>
            <div class="col s4">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo" class="browser-default">
                    <?php if ($cliente['sexo']) : ?>
                        <option value="M" <?= $cliente['sexo'] == 'M' ? 'selected' : ''; ?>>M</option>
                        <option value="F" <?= $cliente['sexo'] == 'F' ? 'selected' : ''; ?>>F</option>
                    <?php else : ?>
                        <option value="M">M</option>
                        <option value="F">F</option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="input-field col s4">
                <input type="text" name="rg" id="rg" value="<?= $cliente['rg'] ?? ''; ?>">
                <label for="rg">RG:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s4">
                <input type="tel" name="fixo" id="fixo" value="<?= $cliente['tel_fix'] ?? ''; ?>">
                <label for="fixo">Telefone Fixo:</label>
            </div>
            <div class="input-field col s4">
                <input type="tel" name="celular" id="celular" value="<?= $cliente['tel_cel'] ?? ''; ?>">
                <label for="celular">Celular:</label>
            </div>
            <div class="col s4">
                <label for="estado_civil">Estado Civil:</label>
                <select name="estado_civil" id="estado_civil" class="browser-default">
                    <?php foreach ($estadoCivil as $estadoCivil) : ?>
                        <?php if ($cliente['marital_status']) : ?>
                            <option value="<?= $estadoCivil['nome']; ?>" <?= $cliente['marital_status'] == $estadoCivil['nome'] ? 'selected' : ''; ?>>
                                <?= $estadoCivil['nome']; ?></option>
                        <?php else : ?>
                            <option value="<?= $estadoCivil['nome']; ?>"><?= $estadoCivil['nome']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s3">
                <input type="tel" name="cep" id="cep" value="<?= $cliente['address']['cep'] ?? ''; ?>" maxlength="8">
                <label for="cep">CEP:</label>
            </div>
            <div class="input-field col s3">
                <input type="text" name="logradouro" id="logradouro" value="<?= $cliente['address']['logradouro'] ?? ''; ?>">
                <label for="logradouro">Rua:</label>
            </div>
            <div class="input-field col s3">
                <input type="text" name="numero" id="numero" value="<?= $cliente['address']['numero'] ?? ''; ?>">
                <label for="numero">Número:</label>
            </div>
            <div class="input-field col s3">
                <input type="text" name="complemento" id="complemento" value="<?= $cliente['address']['complemento'] ?? ''; ?>">
                <label for="complemento" class="active">complemento:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s3">
                <input type="text" name="bairro" id="bairro" value="<?= $cliente['address']['bairro'] ?? ''; ?>">
                <label for="bairro" class="active">Bairro:</label>
            </div>
            <div class="input-field col s3">
                <input type="text" name="cidade" id="cidade" value="<?= $cliente['address']['cidade'] ?? ''; ?>">
                <label for="cidade" class="active">Cidade:</label>
            </div>
            <div class="col s3">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="browser-default">
                    <?php foreach ($estados as $estado) : ?>
                        <option value="<?= $estado['Uf']; ?>" <?= isset($cliente['address']['estado']) && $cliente['address']['estado'] == $estado['Uf'] ? 'selected' : ''; ?>>
                            <?= $estado['Nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col s12">
                <?php if (isset($cliente['id'])) : ?>
                    <input type="hidden" name="id_cliente" value="<?= $cliente['id']; ?>">
                    <input type="hidden" name="id_endereco" value="<?= $cliente['address']['id'] ?? ''; ?>">
                    <button type="submit">Salvar</button>
                <?php else : ?>
                    <button type="submit">Cadastrar</button>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col s12">
            <hr>
        </div>
    </div>
    <?php if (isset($cliente['files'])) : ?>
        <div class="row">
            <div class="col s12">
                <h4>Documentos anexados (Documentos Pessoais)</h4>
            </div>
        </div>
        <div class="row">
            <form class="col s12" method="post" enctype="multipart/form-data" action="<?= BASE_URL; ?>painelcadastros/storageDocumentos">
                <div class="row">
                    <?php foreach ($cliente['files'] as $file) : ?>

                        <div class="col s4">
                            <p><?= $file['type']; ?></p>
                            <div class="areaImageDoc">
                                <a href="<?= $file['url']; ?>" target="_blank">
                                    <?php
                                    $nameFile = explode('.', $file['name']);
                                    $ext = end($nameFile);
                                    if ($ext == 'pdf') : ?>
                                        <img src="<?= BASE_URL_IMAGE; ?>pdf.png" alt="" />
                                    <?php else : ?>
                                        <img src="<?= $file['url']; ?>" alt="" />
                                    <?php endif; ?>
                                </a>
                            </div>
                            <a href="<?= BASE_URL; ?>painelcadastros/deleteDocument/<?= $file['id']; ?>?id_cliente=<?= $cliente['id']; ?>" class="btn">Excluir</a>

                        </div>

                    <?php endforeach; ?>

                </div>
                <div class="row">
                    <div class="col s6 file-field input-field">
                        <div class="btn">
                            <span>Escolher documento</span>
                            <input type="file" name="file" required>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                    <div class="col s6">
                        <label>Tipo do documento</label>
                        <select class="browser-default" required name="type_document">
                            <option value="" disabled selected>Escolha o tipo de documento</option>
                            <?php foreach ($typeFiles as $k => $v) : ?>
                                <option value="<?= $v['type']; ?>"><?= $v['type_text']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <input type="hidden" value="<?= $cliente['id']; ?>" name="id_cliente">
                        <button type="submit">Enviar Documentos</button>
                    </div>
                </div>
            <?php endif; ?>
            </form>
        </div>
        <script src="<?= BASE_URL_SCRIPT; ?>Controllers/Cep.js"></script>
        <script src="<?= BASE_URL_SCRIPT; ?>Controllers/VerifyData.js"></script>
        <script src="https://unpkg.com/imask"></script>
        <script>
            let frCPF = document.querySelector('#fr_cpf');
            let frTelCel = document.querySelector('#fr_tel_cel');
            let fixoEl = document.querySelector('#fixo');
            let celularEl = document.querySelector('#celular');
            let cpfEl = document.querySelector('#cpf');

            let maskfrCPF = {
                mask: '000.000.000-00'
            };
            let maskFrTelCel = {
                mask: '(00) 00000-0000'
            };
            let maskFixo = {
                mask: '(00) 0000-0000'
            };
            let maskCelular = {
                mask: '(00) 00000-0000'
            }
            let maskCPF = {
                mask: '000.000.000-00'
            }

            IMask(frCPF, maskCPF);
            IMask(frTelCel, maskFrTelCel);
            IMask(fixoEl, maskFixo);
            IMask(celular, maskCelular);
            IMask(cpfEl, maskCPF);
        </script>