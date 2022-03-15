<?php foreach($redes as $rede):?>
<div class="redeItem">
    <div class="redeConteudo">
        <div class="imgArea">
            <?php if(isset($rede->getArquivo()['url_arquivo'])):?>
                <img src="<?=BASE_URL;?>assets/arquivos/<?=$rede->getArquivo()['url_arquivo'];?>" alt="">
            <?php else:?>
                <img src="<?=BASE_URL;?>assets/images/site/photo.svg" alt="">
            <?php endif;?>
        </div>
        <div class="nome"><div><?=$rede->getNome();?></div></div>
        <div class="cidade"><div><strong><?=$rede->getCidade();?></strong></div></div>
        <div class="telefone"><div><?=$rede->getTelefone();?></div></div>
        <div class="desconto"><div><?=$rede->getDesconto();?></div></div>

    </div>
</div>
<?php endforeach;?>
<?php if(count($redes) == 0):?>
    <p style="text-align:center">Nenhuma rede credenciada</p>
<?php endif;?>
