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

    </div>
</div>
<div class="row">
    <?php if (isset($patrocinador['nome_cliente'])) : ?>
        <div class="col s6">
            <p><strong>Patrocinador:</strong>
                <?= isset($patrocinador['nome_cliente']) ? $patrocinador['nome_cliente'] : ''; ?></p>
        </div>
    <?php endif; ?>
    <form action="<?= BASE_URL; ?>painelcadastros/<?=$linkToAction;?>" method="post" class="col s12">
        <div class="row">
        <div class="input-field col s4">
                <input type="tel" name="cpf" id="cpf" value="<?= $cliente['cpf'] ?? ''; ?>" <?=isset($cliente['name'])?'readonly':'';?>>
                <label for="cpf">CPF:</label>
            </div>
            
            <div class="input-field col s4">
                <input type="text" name="email" id="email" value="<?= $cliente['email'] ?? ''; ?>">
                <label for="email">E-mail:</label>
            </div>
            
            <div class="input-field col s4">
                <input type="text" name="nome" id="nome" value="<?= $cliente['name'] ?? ''; ?>">
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
                <h4>Documentos anexados</h4>
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
                                    <img src="<?= $file['url']; ?>" alt="" />
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
            let fixoEl = document.querySelector('#fixo');
            let celularEl = document.querySelector('#celular');
            let cpfEl = document.querySelector('#cpf');
            let maskFixo = {
                mask: '(00) 0000-0000'
            };
            let maskCelular = {
                mask: '(00) 00000-0000'
            }
            let maskCPF = {
                mask: '000.000.000-00'
            }

            IMask(fixoEl, maskFixo);
            IMask(celular, maskCelular);
            IMask(cpfEl, maskCPF);
        </script>