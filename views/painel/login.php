<!Doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <title>Painel Administrativo</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->

  <style type="text/css">
    <?php require 'assets/css/materialize.min.css'; ?>
  </style>
  <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/painel.css">

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS do Banner -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/vanillaSlideshow.css">



  <!-- Google analystic-->
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-88940669-9', 'auto');
    ga('send', 'pageview');
  </script>


</head>

<body>
  <div class="tudo">
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/materialize.min.js"></script>

    <div class="areaImage">
      <img src="<?php echo BASE_URL; ?>assets/arquivos/<?php echo $viewData['configuracoes']['url_arquivo']; ?>" width="200">
    </div>
    <div class="row formArea">
      <div class="conteudo-menor">
        <?php if (!empty($aviso)) : ?>
          <div class="card-panel">
            <span class="blue-text text-darken-2"><?php echo $aviso; ?></span>
          </div> <?php endif; ?>
        <form method="post" class="col s12 formLogin">
          <div class="row">
            <div class="col s12">
              <p>Digite o seu e-mail e senha para acessar.</p>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="email" name="email" required autofocus id="email" class="validate" />
              <label for="email">E-mail:</label>
            </div>
            <div class="input-field col s12">
              <input type="password" name="senha" id="senha" required class="validate" />
              <label for="senha">Senha:</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <p class="center"><a href="<?php echo BASE_URL; ?>esqueciminhasenha">Esqueci minha Senha</a></p>
              <div class="center"><input type="submit" value="Entrar" class="btn waves-effect waves-light" /></div>
            </div>
          </div>

        </form>
      </div>

    </div>
  </div>
</body>

</html>