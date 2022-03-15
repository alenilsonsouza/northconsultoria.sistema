<div class="row">
    <div class="col s12">
        <h5>Documentos</h5>
        <p>Envie seus documentos para validarmos o seu cadastro.</p>
        <p>Tire foto do seu documento como descrito abaixo e depois envie conforme sugere nos campos:</p>
        <p>
            - RG ou CNH (Frente)<br>
            - RG ou CNH (Verso)<br>
            - Cartão SUS (Verso)<br>
            - Comprovante de Residência  de até 90 dias vencida.
        </p>
    </div>
</div>
<div class="row">
    <form class="col s12" method="post" enctype="multipart/form-data" action="<?=BASE_URL;?>ardocumentos/storage">
        <div class="row">
            <?php if(isset($docs[0]) && $docs[0]->getTipo() == 1):?>
                <div class="row">
                    <div class="col s12">
                        <div class="card horizontal">
                            <div class="card-image">
                                <img src="<?=BASE_URL;?>assets/images/doc.svg" style="width:80px">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <p><?=$docs[0]->getNome();?></p>
                                </div>
                                <div class="card-action">
                                    <a href="<?=BASE_URL;?>assets/arquivos/<?=$docs[0]->getArquivo()['url_arquivo'];?>" target="_blank">Ver documento</a> | <a href="<?=BASE_URL;?>ardocumentos/del/<?=$docs[0]->getId();?>" class="btn" onclick="return confirm('Deseja realmente excluir?')">Excluir Documento</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else:?>
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>RG ou CNH (Frente)</span>
                    <input type="file" name="arquivo1">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($docs[1]) && $docs[1]->getTipo() == 2):?>
                <div class="row">
                    <div class="col s12">
                        <div class="card horizontal">
                            <div class="card-image">
                                <img src="<?=BASE_URL;?>assets/images/doc.svg" style="width:80px">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <p><?=$docs[1]->getNome();?></p>
                                </div>
                                <div class="card-action">
                                    <a href="<?=BASE_URL;?>assets/arquivos/<?=$docs[1]->getArquivo()['url_arquivo'];?>" target="_blank">Ver documento</a> | <a href="<?=BASE_URL;?>ardocumentos/del/<?=$docs[1]->getId();?>" class="btn" onclick="return confirm('Deseja realmente excluir?')">Excluir Documento</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else:?>
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>RG ou CNH (Verso)</span>
                    <input type="file" name="arquivo2">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($docs[2]) && $docs[2]->getTipo() == 3):?>
                <div class="row">
                    <div class="col s12">
                        <div class="card horizontal">
                            <div class="card-image">
                                <img src="<?=BASE_URL;?>assets/images/doc.svg" style="width:80px">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <p><?=$docs[2]->getNome();?></p>
                                </div>
                                <div class="card-action">
                                    <a href="<?=BASE_URL;?>assets/arquivos/<?=$docs[2]->getArquivo()['url_arquivo'];?>" target="_blank">Ver documento</a> | <a href="<?=BASE_URL;?>ardocumentos/del/<?=$docs[2]->getId();?>" class="btn" onclick="return confirm('Deseja realmente excluir?')">Excluir Documento</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else:?>
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>Cartão SUS (VERSO)</span>
                    <input type="file" name="arquivo3">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <?php endif;?>
            <?php if(isset($docs[3]) && $docs[3]->getTipo() == 4):?>
                <div class="row">
                    <div class="col s12">
                        <div class="card horizontal">
                            <div class="card-image">
                                <img src="<?=BASE_URL;?>assets/images/doc.svg" style="width:80px">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <p><?=$docs[3]->getNome();?></p>
                                </div>
                                <div class="card-action">
                                    <a href="<?=BASE_URL;?>assets/arquivos/<?=$docs[3]->getArquivo()['url_arquivo'];?>" target="_blank">Ver documento</a> | <a href="<?=BASE_URL;?>ardocumentos/del/<?=$docs[3]->getId();?>" class="btn" onclick="return confirm('Deseja realmente excluir?')">Excluir Documento</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else:?>
            <div class="file-field input-field col s12">
                <div class="btn">
                    <span>Comprovante de Residência de até 90 dias</span>
                    <input type="file" name="arquivo4">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <?php endif;?>
        </div>
        <?php if(count($docs) != 4):?>
        <div class="row">
            <div class="col s12">
                <button class="btn">Enviar Documentos</button>
            </div>
        </div>
        <?php endif;?>
    </form>
</div>