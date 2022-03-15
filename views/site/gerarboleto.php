<section class="area-conteudo">
    <div class="conteudo">
        <header class="area-titulo">
            <h2>Cadastro concluído</h2>
        </header>
        <article class="area-conteudo-texto">
            
            <div class="confirmArea" style='margin-bottom:20px'>
                <div>
                    <p>Olá <strong><?php echo $cliente['nome_cliente'];?></strong><br>
                O cadastro foi concluído. <br>
                Clique no botão abaixo para visualizar e imprimir o seu carnê.</p>
                <p>OBS: A taxa de cadastro deverá ser paga ao seu consultor.</p>
                </div>
            </div>
            <?php if(isset($fatura[0]['url_boleto'])):?>
                <div>
                    <a href="http://boletos.cobrancaporboleto.com.br/carne/<?=md5($boleto['idSistema'].'-'.$fatura[0]['id_parcelamento']);?>/capa" class="botao" target="_blank">Imprimir Carnê</a>
                </div>
            <?php else:?>
                <div>
                    <p>Ops! Houve algum problema na emissão do seu carnê!</p>
                </div>
            <?php endif;?>
                
            
        </article>
    </div>
</section>