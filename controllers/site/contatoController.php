<?php
class contatoController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {


        $dados = array();
        $dados['flash'] = '';
        if(!empty($_SESSION['flash']))
        {
            $dados['flash'] = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }


        $config = new Config();
        $dados['config'] = $config->getArray();

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['menu'] = 1; 
        $dados['page'] = 'contato';
		
		
        $this->loadTemplate('contato', $dados);
    }

    public function storage(){

        $_SESSION['flash'] = '';

        $name = filter_input(INPUT_POST, 'nome');
        $email = filter_input(INPUT_POST, 'email');
        $tel = filter_input(INPUT_POST, 'celular');
        $subject = filter_input(INPUT_POST, 'assunto');
        $message = filter_input(INPUT_POST, 'mensagem');


        if($name && $email && $tel) {

            $e = new Email();
            $e->setNome($name);
            $e->setEmail($email);
            $e->setTelefone($tel);
            $e->setAssunto($subject);
            $e->setMensagem($message);
            $e->enviarContato();
            $_SESSION['flash'] = "Sua mensagem foi enviada!";


        }

        Redirect::link('contato');
    }

}