<div class="row">
	<div class="col s12">
		<nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="hide-on-med-and-down">
        <li><a href="<?php echo BASE_URL;?>painelredessociais/adicionar">Adicionar</a></li>
        
      </ul>
    </div>
  </nav>
	</div>
</div>
<div class="row">
	<div class="col s12"><h5>Redes Sociais</h5></div>
</div>
<div class="row">
  <div class="col s12">
    <table class="striped">
      <tr>
        <th>Imagem</th>
        <th>Rede Social</th>
        <th>URL</th>
        <th>Ações</th>
      </tr>
      <?php foreach($redes as $rede):?>
        <tr>
          <td>
            <img src="<?php echo BASE_URL;?>assets/arquivos/<?php echo $rede['url_arquivo'];?>" style="width: 150px">
          </td>
          <td>
            <?php echo $rede['nome_rede'];?>
          </td>
          <td>
            <a href="<?php echo $rede['link_rede'];?>" target="_blank"><?php echo $rede['link_rede'];?></a>
          </td>
          <td>
            <a href="<?php echo BASE_URL;?>painelredessociais/editar/<?php echo md5($rede['id_rede']);?>" class="btn">Editar</a>
            <a href="<?php echo BASE_URL;?>painelredessociais/excluir/<?php echo md5($rede['id_rede']);?>" class="btn">Excluir</a>
          </td>
        </tr>
      <?php endforeach;?>
      <?php if(count($redes) == 0):?>
        <tr>
          <td colspan="4">Nenhum registro encontrado.</td>
        </tr>
      <?php endif;?>
      
    </table>
  </div>
</div>