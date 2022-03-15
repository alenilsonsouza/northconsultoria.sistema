<?php
class ardocumentosController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Clientes();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."loginusuario");
        }
        
    }

    public function index() 
    {
        $clientes = new Clientes();
        $item = $clientes->getClienteById($_SESSION['clogin']);
        $doc = new DocumentosHandler();
        $docs = $doc->getByIdCliente($item['id_cliente']);
        /*echo '<pre>';
        print_r($docs);
        exit;*/
     
        $this->loadTemplateInUsuario('documentos', [
            'page' => 'documentos',
            'docs' => $docs
        ]);
    }

    public function storage()
    {
        //Pega info Cliente
        $clientes = new Clientes();
        $item = $clientes->getClienteById($_SESSION['clogin']);

        //Cadastro dos documentos
        if(!empty($_FILES['arquivo1']['tmp_name']))
        {
            $arquivos = new Arquivos();
            $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo1']);
            
            $doc = new Documentos();
            $docHandler = new DocumentosHandler();
            $doc->setIdArquivo($id_arquivo);
            $doc->setIdCliente($item['id_cliente']);
            $doc->setNome($docHandler->getNomeDoc(1));
            $doc->setTipo(1);
            $docHandler->insert($doc);
        }

        if(!empty($_FILES['arquivo2']['tmp_name']))
        {
            $arquivos = new Arquivos();
            $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo2']);
            
            $doc = new Documentos();
            $docHandler = new DocumentosHandler();
            $doc->setIdArquivo($id_arquivo);
            $doc->setIdCliente($item['id_cliente']);
            $doc->setNome($docHandler->getNomeDoc(2));
            $doc->setTipo(2);
            $docHandler->insert($doc);
        }

        if(!empty($_FILES['arquivo3']['tmp_name']))
        {
            $arquivos = new Arquivos();
            $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo3']);
            
            $doc = new Documentos();
            $docHandler = new DocumentosHandler();
            $doc->setIdArquivo($id_arquivo);
            $doc->setIdCliente($item['id_cliente']);
            $doc->setNome($docHandler->getNomeDoc(3));
            $doc->setTipo(3);
            $docHandler->insert($doc);
        }

        if(!empty($_FILES['arquivo4']['tmp_name']))
        {
            $arquivos = new Arquivos();
            $id_arquivo = $arquivos->guardarImagem($_FILES['arquivo4']);
            
            $doc = new Documentos();
            $docHandler = new DocumentosHandler();
            $doc->setIdArquivo($id_arquivo);
            $doc->setIdCliente($item['id_cliente']);
            $doc->setNome($docHandler->getNomeDoc(4));
            $doc->setTipo(4);
            $docHandler->insert($doc);
        }

        header('Location:'.BASE_URL.'ardocumentos');
        exit;
    }

    public function del($id)
    {
        $doc = new DocumentosHandler();
        $item = $doc->getById($id);
        $arquivos = new Arquivos();
        $arquivos->excluirArquivo($item->getIdArquivo());
        $doc->delById($id);
        header('Location:'.BASE_URL.'ardocumentos');
        exit;
    }

    

}