<div class="row">
	<div class="col s12">
		<h5>Informações de Banco</h5>
        <p>A conta cadastrada abaixo é para Transferência do suas comissões e deve ser a mesma do titular cadastrado.
        </p>
	</div>
</div>
<div class="row">
	<div class="col s12">
        <table class="striped">
            <tr>
                <th width="200">BANCO:</th>
                <td><?=$banco->getBanco();?></td>
            </tr>
            <tr>
                <th>AGÊNCIA:</th>
                <td><?=$banco->getAgencia();?></td>
            </tr>
            <tr>
                <th>CONTA:</th>
                <td><?=$banco->getConta();?></td>
            </tr>
            <tr>
                <th>TIPO:</th>
                <td><?=$banco->getTipoNome();?></td>
            </tr>
            <tr>
                <th>NOME DO TITULAR:</th>
                <td><?=$banco->getNomeTitular();?></td>
            </tr>
            <tr>
                <th>CPF DO TITULAR:</th>
                <td><?=$banco->getCPFTitular();?></td>
            </tr>
        </table>
        <a href="<?=BASE_URL;?>arbanco/atualizar" class="btn">Atualizar informações Bancárias</a>
	</div>
</div>