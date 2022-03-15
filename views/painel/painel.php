<div class="row">
  <div class="col s12">
    <h5>Dashboard</h5>
  </div>
</div>
<div class="row">
  <div class="col s12">
    <h5>Últimos Cadastros</h5>
    <p><strong>Titulares</strong></p>
    <?php foreach($titulares as $item):?>
      <?=Data::convertDate($item['date_register']);?> - <?=$item['name'];?><br />
    <?php endforeach;?>

    <p><strong>Vendedores</strong></p>
    <?php foreach($vendedores as $item):?>
      <?=Data::convertDate($item['date_register']);?> - <?=$item['name'];?><br />
    <?php endforeach;?>
  </div>
</div>
<div class="row">
  <div class="col s12">
    <h5>Resumo</h5>
  </div>
  <div class="col s12 m4">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title">Cadastros neste mês</span>
        <p><?=$totalMes;?></p>
      </div>
      <div class="card-action">
        <a href="<?= BASE_URL; ?>painelcadastros">Acessar</a>
      </div>
    </div>
  </div>
  <div class="col s12 m4">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title">Total de Cadastros</span>
        <p><?=$totalPeople;?></p>
      </div>
      <div class="card-action">
        <a href="<?= BASE_URL; ?>painelcadastros">Acessar</a>
      </div>
    </div>
  </div>
  <div class="col s12 m4">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title">Vendedores</span>
        <p><?=$totalVendedores;?></p>
      </div>
      <div class="card-action">
        <a href="<?= BASE_URL; ?>painelcadastros">Acessar</a>
      </div>
    </div>
  </div>
  <div class="col s12 m4">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title">Clientes</span>
        <p><?=$totalTitulares;?></p>
      </div>
      <div class="card-action">
        <a href="<?= BASE_URL; ?>painelcadastros/clientes">Acessar</a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12">
      <hr>
    </div>
  </div>
  