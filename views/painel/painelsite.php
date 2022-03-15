<div class="row">
	<div class="col s12">
		<h5>Site</h5>
		<p>Configure o título, descrição, palavra-chave do site.</p>
	</div>
</div>
<div class="row">
	<form class="col s12" method="post">
		<div class="row">
			<div class="input-field col s12">
				<input type="text" name="titulo" value="<?php echo $site['titulo'];?>">
				<label for="titulo">Título:</label>
			</div>
			<div class="input-field col s12">
				<input type="text" name="emails" value="<?php echo $site['emails'];?>">
				<label for="emails">E-mails: se houve mais de um e-mail separe por vígula.</label>
			</div>
			<div class="input-field col s12">
				<textarea id="descricao" class="materialize-textarea" name="descricao"><?php echo $site['descricao'];?></textarea>
          		<label for="descricao">Descrição:</label>
			</div>
			<div class="input-field col s12">
				<textarea id="palavra_chaves" class="materialize-textarea" name="palavra_chaves"><?php echo $site['palavra_chave'];?></textarea>
          		<label for="palavra_chaves">Palavras-chaves:</label>
			</div>
			<div class="input-field col s12">
				<textarea id="scripts" class="materialize-textarea" name="scripts"><?php echo $site['scripts'];?></textarea>
          		<label for="scripts">Outros Scripts (Google analystic, Pixel Facebook, etc.):</label>
			</div>
			<div class="input-field col s12">
				<input type="submit" value="Atualizar" class="btn">
				
			</div>

		</div>
		
	</form>
</div>