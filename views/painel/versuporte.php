<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelsuporte">Voltar</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
	<div class="col s12"><h5>Suporte de <?php echo $suporte['assunto_suporte'];?></h5></div>
</div>
<div class="row">
	<div class="col s12">
		<table>
			<tr>
				<td>
					<?php $dia = date("w", strtotime($suporte['data_hora']));?>
					<strong><?php $d = new Data(); echo $d->getDiaSemana($dia);?></strong><br>
					<?php echo date("d-m-Y H:i:s", strtotime($suporte['data_hora']));?>
				</td>
				<td><strong>Tipo Suporte:</strong><br><?php $s = new Suporte(); echo $s->tipoSuporte($suporte['tipo_suporte']);?></td>
				<td><strong>Assunto:</strong><br><?php echo $suporte['assunto_suporte'];?></td>
			</tr>
			<tr>
				<td colspan="3">
					<?php echo $suporte['descricao'];?>
				</td>
			</tr>
			<?php if(!empty($suporte['url_arquivo'])):?>
				<tr>
					<td colspan="3">
						<img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $suporte['url_arquivo'];?>">
					</td>
				</tr>
			<?php endif;?>
		</table>
	</div>
</div>
<div class="row">
	<div class="col s12">
		<h6>Respostas:</h6>
		<table class="striped">
			<?php foreach($respostas as $resposta):?>
				<tr>
					<td>
						<strong><?php echo $resposta['usuario'];?></strong><br>
						<?php echo $resposta['descricao'];?>
					</td>
				</tr>
		<?php endforeach;?>
		</table>
		
	</div>
</div>
<?php if($suporte['situacao'] == 0):?>
<div class="row">
	<form class="col s12" method="post">
		<div class="row">
			<div class="input-field col s12">
				<textarea id="corpo" name="descricao"></textarea>
			</div>
			<div class="col s12">
				<input type="checkbox" id="test5" />
			      <label for="test5">Marcar como concluído</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="hidden" name="assunto_suporte" value="<?php echo $suporte['assunto_suporte'];?>">
				<input type="hidden" name="tipo_suporte" value="<?php echo $suporte['tipo_suporte'];?>">
				<input type="hidden" name="id_arquivo" value="<?php echo $suporte['id_arquivo'];?>">
				<input type="hidden" name="id_usuario" value="<?php echo $id_usuario;?>">
				<input type="hidden" name="id_suporte" value="<?php echo $suporte['idsuporte'];?>">
				<input type="submit" value="Responder" class="btn">
			</div>
		</div>
	</form>
</div>
<?php else:?>
<div class="row">
		<div class="col s12">
			<strong>Concluído</strong>
		</div>
	</div>	
<?php endif;?>	


<script type="text/javascript" src="<?php echo BASE_URL;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript">
ClassicEditor
    .create( document.querySelector( '#corpo' ),{
      cloudServices: {
        tokenUrl: 'https://33527.cke-cs.com/token/dev/fet7eiwYuxWF07g20fwJcudpMhKVGeoqBnfgtoCWRHRBFqXmBfo1fkoTTVmf',
            uploadUrl: '<?php echo BASE_URL;?>assets/arquivos/'
        },
        ckfinder: {
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        },
        image: {
      // You need to configure the image toolbar too, so it uses the new style buttons.
      toolbar: [ 'imageTextAlternative', '|', 'imageStyleAlignLeft', 'imageStyleFull', 'imageStyleAlignRight' ],

      styles: [
        // This option is equal to a situation where no style is applied.
        'imageStyleFull',

        // This represents an image aligned to left.
        'imageStyleAlignLeft',

        // This represents an image aligned to right.
        'imageStyleAlignRight'
      ]
    }
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

  </script>