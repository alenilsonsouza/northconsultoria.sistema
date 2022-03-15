<div class="row">
    <div class="col s12">
        <h5>Boleto Barato</h5>
    </div>
</div>
<?php if(!empty($aviso)):?>
<div class="row">
    <div class="col s12 m6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Aviso</span>
          <p><?php echo $aviso;?></p>
        </div>
        
      </div>
    </div>
  </div>
<?php endif;?>
<div class="row">
    <form method="POST" class="col s12">
        <div class="row">
            <div class="input-field col s12 m4">
                <input type="text" name="assuntoBoleto" id="assuntoBoleto" value="<?php echo $boleto['assuntoBoleto'];?>">
                <label for="assuntoBoleto">Assunto do Boleto:</label>
            </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m4">
            <textarea id="corpoBoleto" name="corpoBoleto" class="materialize-textarea"><?php echo $boleto['corpoBoleto'];?></textarea>
            <label for="corpoBoleto">Corpo do Boleto</label>
          </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m4">
                <input type="email" name="email" id="email" value="<?php echo $boleto['email'];?>">
                <label for="email">E-mail:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m4">   
                <input type="password" name="senha" id="senha" value="<?php echo $boleto['senha'];?>">
                <label for="senha">Senha:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 m4">   
                <input type="tel" name="idSistema" id="idSistema" value="<?php echo $boleto['idSistema'];?>">
                <label for="idSistema">Id do Sistema:(Não alterar)</label>
            </div>
            
        </div>
        <div class="row">
            <div class="input-field col s12 m4">
                <input type="submit" value="Atualizar" class="btn">
            </div>
        </div>
    </form>

</div>