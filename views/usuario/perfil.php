<div class="row">
	<div class="col s12">
		<h5>Perfil</h5>
	</div>
</div>
<div class="row">
	<div class="col s3">
		<p><strong>Olá <?=$cliente['nome_cliente'];?></strong></p>
	</div>
	<div class="col s3">
		<p><strong>Seu CPF:</strong> <?=$cliente['cpf_cliente'];?></p>
	</div>
	<div class="col s3">
		<p><strong>Seu e-mail:</strong> <?=$cliente['email_cliente'];?></p>
	</div>
	
</div>
<div class="row">
	<form action="<?=BASE_URL;?>arperfil/storageAction" method="post" class="col s12">
			<div class="row">
				<div class="input-field col s4">
					<input type="text" name="nome" required value="<?=$cliente['nome_cliente'];?>">
					<label for="nome">Nome:</label>
				</div>
				<div  class="col s4">
					<label for="data_nascimento">Nascimento:</label>
					<div class="row">
						<div class="col s4">
							<select name="dia" class="browser-default">
								<?php $data_n = explode('-',$cliente['nascimento_cliente']);?>
								<option value="">DIA:</option>
								<?php for($i=1;$i<=31;$i++):?>
									
									<option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?>" <?=$data_n[2] == str_pad($i, 2, 0, STR_PAD_LEFT)?'selected':'';?>><?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?></option>
								<?php endfor;?>
							</select>
						</div>
						<div class="col s4">
							<select name="mes" class="browser-default">
							<option value="">MÊS:</option>
									<?php $data = new Data();?>
								<?php for($i=1;$i<=12;$i++):?>
									<option value="<?php echo str_pad($i, 2, 0, STR_PAD_LEFT);?>" <?=$data_n[1] == str_pad($i, 2, 0, STR_PAD_LEFT)?'selected':'';?>><?php echo $data->getMes($i);?></option>
								<?php endfor;?>
							</select>
						</div>
						<div class="col s4">
							<select name="ano" class="browser-default">
							<option value="">ANO:</option>
								
								<?php $ano = date('Y'); $antigo = $ano - 85;?>    
								<?php for($i=$ano;$i>=$antigo;$i--):?>
									<option value="<?php echo $i;?>" <?=$data_n[0] == str_pad($i, 2, 0, STR_PAD_LEFT)?'selected':'';?>><?php echo $i;?></option>
								<?php endfor;?>
							</select>
						</div>
					</div>
				</div>
				<div  class="col s4">
					<label for="sexo">Sexo:</label>
					<select name="sexo" id="" class="browser-default">
						<option value="M" <?=($cliente['sexo_cliente']=='M')?'selected':'';?>>Masculino</option>
						<option value="F" <?=($cliente['sexo_cliente']=='F')?'selected':'';?>>Feminino</option>
					</select>
				</div>
				
			</div>
			<div class="row">
				<div class="input-field col s6">
					<input type="tel" name="telefone" required value="<?=$cliente['telefone'];?>" id="telefone">
					<label for="telefone">Telefone Fixo:</label>
				</div>
				<div class="input-field col s6">
					<input type="tel" name="celular" required value="<?=$cliente['celular'];?>" id="celular">
					<label for="celular">Celular:</label>
				</div>
			</div>
			
			<div class="row">
				<div class="col s12">
					<input type="hidden" name="id_endereco" value="<?=$endereco['id_endereco'];?>">

					<input type="hidden" name="cpf" value="<?=$cliente['cpf_cliente'];?>">
					<input type="submit" value="atualizar" class="btn">
				</div>
			</div>
		</form>
</div>
<script src="https://unpkg.com/imask"></script>
<script type="text/javascript">
	let telefone = document.querySelector('#telefone');
	let celular = document.querySelector('#celular');
    IMask(telefone,{
        mask:'(00) 0000-0000'
	});
	IMask(celular,{
        mask:'(00) 00000-0000'
    });
</script>
