<!Doctype html>
<html lang="pt-BR">
    <head>
    <meta charset="utf-8">
        <title>Painel Administrativo</title>
        <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
     
      <style type="text/css">
        <?php require 'assets/css/materialize.min.css';?> 
      </style>
       <link rel="stylesheet" href="<?=BASE_URL;?>assets/css/painel.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
       <!-- CSS do Banner -->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>assets/css/vanillaSlideshow.css">
    
    
    
    <!-- Google analystic-->
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88940669-9', 'auto');
  ga('send', 'pageview');

</script>
        
        
    </head>
    <body>
<div class="tudo">      
    <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/materialize.min.js"></script>
<div class="container"> 
  <div class="row">
    <div class="col s12">
      <p class="center"><img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $viewData['configuracoes']['url_arquivo'];?>" width="200"></p>
        

      
    </div>
  </div>

<div class="row">
  <div class="conteudo-menor">
  <?php if(!empty($flash)):?>
    <div class="card-panel">
      <span class="blue-text text-darken-2"><?php echo $flash;?></span>
    </div>  
<?php endif;?>
<form method="post" class="col s12 formLogin" action="<?=BASE_URL;?>esqueciminhasenha/storageSenha">

<div class="row">
    <div class="col s12">
        <p>Olá <strong><?=$usuario['usuario'];?></strong>,<br>Abaixo digite a nova senha:</p>
        <p>Critério para nova senha:<br>Mínimo 6 caracteres podendo ter letras e números.</p>
    </div>
  <div class="input-field col s12">
    <input type="password" name="senha" required autofocus />
    <label for="senha">Nova Senha:</label>
  </div>
  <div class="input-field col s12">
    <input type="password" name="confirmar_senha" required />

    <label for="senha_repete">Confirme a senha:</label>
  </div>
</div>
<div class="row">
  <div class="input-field col s12">
      <input type="hidden" value="<?=md5($usuario['id']);?>" name="id">
    <div class="center"><input type="submit" value="Alterar" class="btn waves-effect waves-light" /></div>
  </div>
</div>

</form>
</div>

</div>
</div>

</div>
</body>
</html>