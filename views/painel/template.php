<?php
$user = isset($_SESSION['plogin']) ? $_SESSION['plogin'] : 0;
$u = new Usuarios($user);
$nome = $u->getNome();
$s = new Site();
$site = $s->getArray();
$c = new Configuracoes();
$configuracoes = $c->getArray();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Painel - <?= $site['titulo']; ?></title>
  <meta name="description" content="<?= $site['descricao']; ?>">
  <meta name="keywords" content="<?= $site['palavra_chave']; ?>">
  <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/painel.css">
  <style type="text/css" media="screen,projection">
    <?php require 'assets/css/materialize.min.css'; ?>
  </style>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="<?= BASE_URL; ?>assets/images/favicon.png" sizes="16x16 32x32 64x64" type="image/x-icon">

  <!--Material Design-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="<?= BASE_URL; ?>assets/js/materialize.min.js"></script>
  <script src="<?= BASE_URL; ?>assets/js/Controllers/Loading.js" defer></script>
  <?php
  /**
   * Importação de JS de APIS */
  require 'views/includes/jsimport.php';
  ?>

<body>
  <div class="loading">
    <div class="loading-content">
      <div class="loading-text">Por favor, aguarde!<br>Estamos processando o seu pedido.</div>
      <div class="loading-effect"></div>
    </div>
  </div>
  <div class="topFixed">
    <div class="name">Olá <?= $nome; ?></div>
    <div class="logout">
      <a href="<?= BASE_URL; ?>login/sair">Sair</a>
    </div>
  </div>
  <div class=" container-fluid">
        <div class="menuLateral">
          <a href="<?= BASE_URL; ?>painel" class="brand-logo">
            <div class="imagem">
              <?php if (!empty($configuracoes['id_imagem'])) : ?>
                <img src="<?= BASE_URL; ?>assets/arquivos/<?= $configuracoes['url_arquivo']; ?>" alt="<?= $configuracoes['nome_arquivo']; ?>">
              <?php else : ?>
                SEM LOGO
              <?php endif; ?>
            </div>
          </a>
          <?php $p = $viewData['page']; ?>
          <div class="col s12">
            <div class="perfil">
              <a href="<?= BASE_URL; ?>menuperfil" class="linkPerfil <?= ($p == 'menuperfil') ? 'ativo' : ''; ?>"><i class="material-icons left">web</i>Meu Perfil</a>
              <a href="<?= BASE_URL; ?>painelconfiguracoes" class="linkPerfil <?= ($p == 'configuracoes') ? 'ativo' : ''; ?>"><i class="material-icons left">settings</i>Configurações</a>
            </div>
          </div>
          <nav class="menuVertical">
            <ul>
              <li><a href="<?= BASE_URL; ?>painel" class="<?= ($p == 'painel') ? 'ativo' : ''; ?>"><i class="material-icons left">dashboard</i>Dashbord</a></li>
              <li><a href="<?= BASE_URL; ?>painelcadastros/vendas" class="<?= ($p == 'vendas') ? 'ativo' : ''; ?>"><i class="material-icons left">content_paste</i>Vendas</a></li>
              <li><a href="<?= BASE_URL; ?>painelcadastros" class="<?= ($p == 'cadastros') ? 'ativo' : ''; ?>"><i class="material-icons left">person_pin</i>Vendedores</a></li>
              <li><a href="<?= BASE_URL; ?>painelcadastros/clientes" class="<?= ($p == 'clientes') ? 'ativo' : ''; ?>"><i class="material-icons left">person_pin</i>Clientes</a></li>
              <li><a href="<?= BASE_URL; ?>painelplanos" class="<?= ($p == 'planos') ? 'ativo' : ''; ?>"><i class="material-icons left">format_list_bulleted</i>Planos</a></li>
              <li><a href="<?= BASE_URL; ?>painelrelatorio" class="<?= ($p == 'relatorio') ? 'ativo' : ''; ?>"><i class="material-icons left">content_paste</i>Relatório</a></li>
              <li><a href="<?= BASE_URL; ?>painelredecredenciada" class="<?= ($p == 'redecredenciada') ? 'ativo' : ''; ?>"><i class="material-icons left">monetization_on</i>Rede Credenciada</a></li>
              <li><a href="<?= BASE_URL; ?>painelusuarios" class="<?= ($p == 'usuarios') ? 'ativo' : ''; ?>"><i class="material-icons left">supervised_user_circle</i>Usuarios</a></li>
              <li><a href="<?= BASE_URL; ?>login/sair"><i class="material-icons left">exit_to_app</i>Sair</a></li>
            </ul>
          </nav>
        </div>
        <div class="conteudoPrincipal">
          <?php $this->loadViewInPainel($viewName, $viewData); ?>
        </div>
    </div>
    <div class="both"></div>
    <div class="dev">
      <span>Desenvolvido por <a href="https://alenilsonsouza.com.br" target="_blank" title="Desenvolvedor Web desde 2010">Alenilson Souza</a></span>
    </div>
    <script src="<?= BASE_URL; ?>assets/js/jquery-3.4.1.min.js"></script>
    <script src="<?= BASE_URL; ?>assets/js/script_painel.js"></script>

</body>

</html>