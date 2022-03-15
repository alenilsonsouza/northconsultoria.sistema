<?php
$u = new Clientes($_SESSION['clogin']);
$nome = $u->getNome();
$cliente = $u->getClienteById($_SESSION['clogin']);
$s = new Site();
$site = $s->getArray();
$c = new Configuracoes();
$configuracoes = $c->getArray();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Painel - <?php echo $site['titulo'];?></title>
    <meta name="description" content="<?php echo $site['descricao'];?>">
    <meta name="keywords" content="<?php echo $site['palavra_chave'];?>">
<style type="text/css" media="screen,projection">
<?php require 'assets/css/materialize.min.css';?>
</style>
<link rel="stylesheet" href="<?=BASE_URL;?>assets/css/painel.css">
		 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <link rel="icon" href="<?php echo BASE_URL;?>assets/images/favicon.ico" sizes="16x16 32x32 64x64" type="image/x-icon">
		
		<!--Material Design-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/materialize.min.js"></script>

    <!--CSS Próprio-->
    <link href="<?=BASE_URL;?>assets/css/painelusuario.css" rel="stylesheet">

<body>
<div class="container-fluid"> 
  <div class="menuLateral">
    <a href="<?php echo BASE_URL;?>painel" class="brand-logo">
        <div class="imagem">
         <?php if(!empty($configuracoes['id_imagem'])):?> 
            <img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $configuracoes['url_arquivo'];?>" alt="<?php echo $configuracoes['nome_arquivo'];?>" >
            <?php else:?>
                SEM LOGO
            <?php endif;?>
        </div>
      </a>
      <?php $p = $viewData['page'];?>
      <div class="col s12">
        <div class="perfil">
          <p>Olá <?php echo $nome;?><br>
          <strong>ID de Indicação:</strong><span class="balao"><?=$cliente['id_cliente'];?></span><br>
        <?=VERSAO;?></p>
        </div>    
      </div>
          <nav class="menuVertical">
      <ul>
        <li><a href="<?php echo BASE_URL;?>ar" class="<?php echo ($p == 'painel')?'ativo':'';?>"><i class="material-icons left">dashboard</i>Dashbord</a></li>
        <li><a href="<?php echo BASE_URL;?>arperfil" class="<?php echo ($p == 'perfil')?'ativo':'';?>"><i class="material-icons left">folder_shared</i>Perfil</a></li>
        <li><a href="<?php echo BASE_URL;?>arindicados" class="<?php echo ($p == 'indicados')?'ativo':'';?>"><i class="material-icons left">accessibility</i>Seus clientes</a></li>
        <li><a href="<?php echo BASE_URL;?>ardocumentos" class="<?php echo ($p == 'documentos')?'ativo':'';?>"><i class="material-icons left">description</i>Seus Documentos</a></li>
        <?php if($cliente['tipo'] == 3):?>
        <li><a href="<?php echo BASE_URL;?>arboletos" class="<?php echo ($p == 'boletos')?'ativo':'';?>"><i class="material-icons left">local_atm</i>Seus Boletos</a></li>
        <?php endif;?>
        <?php if($cliente['tipo'] == 1):?>
        <li><a href="<?php echo BASE_URL;?>arcompraplano" class="<?php echo ($p == 'comprarplano')?'ativo':'';?>"><i class="material-icons left">local_atm</i>Adiquira seu Clube de Benefícios</a></li>
        <?php endif;?>
        <!--<li><a href="<?php echo BASE_URL;?>ararvore" class="<?php echo ($p == 'arvore')?'ativo':'';?>"><i class="material-icons left">public</i>Árvore</a></li>-->
        <!--<li><a href="<?php echo BASE_URL;?>arcomissao" class="<?php echo ($p == 'comissao')?'ativo':'';?>"><i class="material-icons left">collections</i>Comissao</a></li>-->
        <li><a href="<?php echo BASE_URL;?>arbanco" class="<?php echo ($p == 'banco')?'ativo':'';?>"><i class="material-icons left">account_balance</i>Conta Depósito</a></li>
        <li><a href="<?php echo BASE_URL;?>arsenha" class="<?php echo ($p == 'senha')?'ativo':'';?>"><i class="material-icons left">vpn_key</i>Alterar senha</a></li>
        <li><a href="<?php echo BASE_URL;?>loginusuario/sair"><i class="material-icons left">exit_to_app</i>Sair</a></li>
      </ul>
    </nav>
  </div>
  <div class="conteudoPrincipal">
  	<?php $this->loadViewInUsuario($viewName, $viewData); ?> 
  </div>
</div> 
<div class="both"></div>

<script type="text/javascript">var BASE_URL = '<?php echo BASE_URL;?>';</script>
<script src="<?php echo BASE_URL;?>assets/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/script_painel.js"></script>

</body>
</html>