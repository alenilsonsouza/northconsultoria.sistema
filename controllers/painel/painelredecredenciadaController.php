<?php
class painelredecredenciadaController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."login");
        }
        
    }

    public function index() {
        
		
        $this->loadTemplateInPainel('rede_credenciada', [
            'page' => 'redecredenciada',
            
        ]);
    }

    public function adicionar()
    {
        $this->loadTemplateInPainel('rede_credenciada_storage', [
            'title' => 'Adicionar Rede Credenciada',
            'page' => 'redecredenciada',
            'action' => 'storageAddAction'
            
        ]);
    }

    public function storageAddAction()
    {
        $nome = filter_input(INPUT_POST,'nome');
        $cidade = filter_input(INPUT_POST,'cidade');
        $desconto = filter_input(INPUT_POST,'desconto');
        $telefone = filter_input(INPUT_POST,'telefone');
        
        if($nome && $cidade)
        {
            $id_arquivo = 0;
            if(!empty($_FILES['arquivo']['tmp_name']))
            {
                $arquivos = new Arquivos();
                $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo']);
            }
            
            $rede = new RedeCredenciada();
            $redeHandler = new RedeCredenciadaHandler();
            $rede->setNome($nome);
            $rede->setCidade($cidade);
            $rede->setDesconto($desconto);
            $rede->setTelefone($telefone);
            $rede->setLogo($id_arquivo);
            $redeHandler->insert($rede);

        }

        header('Location:'.BASE_URL.'painelredecredenciada');
        exit;
    }

    public function editar($id)
    {
        $redeCredenciada = new RedeCredenciadaHandler();
        $rede = $redeCredenciada->getById($id);


        $this->loadTemplateInPainel('rede_credenciada_storage', [
            'title' => 'Editar Rede Credenciada '.$rede->getNome(),
            'page' => 'redecredenciada',
            'rede' => $rede,
            'action' => 'storageEditAction'
            
        ]);
    }

    public function storageEditAction()
    {
        $nome = filter_input(INPUT_POST,'nome');
        $cidade = filter_input(INPUT_POST,'cidade');
        $desconto = filter_input(INPUT_POST,'desconto');
        $telefone = filter_input(INPUT_POST,'telefone');
        $id_rede = filter_input(INPUT_POST,'id_rede');
        $id_arquivo = filter_input(INPUT_POST,'id_arquivo');
        
        if($nome && $cidade)
        {
            
            if(!empty($_FILES['arquivo']['tmp_name']))
            {
                if($id_arquivo)
                {
                    $arquivos = new Arquivos();
                    $arquivos->atualizaArquivo(md5($id_arquivo), $_FILES['arquivo']);
                }else{
                    $arquivos = new Arquivos();
                    $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo']);
                }
                
            }
            
            $rede = new RedeCredenciada();
            $redeHandler = new RedeCredenciadaHandler();
            $rede->setNome($nome);
            $rede->setCidade($cidade);
            $rede->setDesconto($desconto);
            $rede->setTelefone($telefone);
            $rede->setLogo($id_arquivo);
            $rede->setId($id_rede);
            $redeHandler->update($rede);

        }

        header('Location:'.BASE_URL.'painelredecredenciada');
        exit;
    }

    public function updateDestaque()
    {
        $destaque = isset($_POST['destaque'])?$_POST['destaque']:[];
        $id = isset($_POST['id'])?$_POST['id']:[];

        /*echo '<pre>';
        print_r($destaque);
        print_r($id);
        exit;*/

        $total = count($id);

        for($q = 0; $q < $total; $q++){
            $redeCredenciada = new RedeCredenciada();
            $redeCredenciadaHandler = new RedeCredenciadaHandler();
            if($destaque[$q] == 1){
                $redeCredenciadaHandler->updateDestaque(1, $id[$q]);
            }else{
                $redeCredenciadaHandler->updateDestaque(0, $id[$q]);
            }
        }

        header('Location:'.BASE_URL.'painelredecredenciada');
        exit;
    }

    public function excluir($id)
    {
        $rede = new RedeCredenciadaHandler();
        $item = $rede->getById($id);
        $arquivos = new Arquivos();
        $arquivos->excluirArquivo($item->getLogo());
        $rede->del($id);
        header('Location:'.BASE_URL.'painelredecredenciada');
        exit;
    }
}