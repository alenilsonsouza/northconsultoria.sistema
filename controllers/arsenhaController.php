<?php
/**
 * @author Alenilson souza <alenilson@aleevolucoes.com.br>
 * @copyright 2020
 */
class arsenhaController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Clientes();
        if(!$u->isLogged()){
            header("Location: ".BASE_URL."loginusuario");
        }
    }

    public function index() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash']='';
        }
        
        $this->loadTemplateInUsuario('senha', [
            'page'=> 'senha',
            'flash'=> $flash
        ]);
    }

    public function storeage() {

        $senha = filter_input(INPUT_POST,'senha');
        $repeti_senha = filter_input(INPUT_POST,'repeti_senha');

        if($senha && $repeti_senha) {
            if(strlen($senha) >= 6 && $senha == $repeti_senha) {
                $cliente = new Clientes();
                $cliente->setSenha(md5($senha));
                $cliente->updatePass($_SESSION['clogin']);
                $_SESSION['flash'] = "Senha alterada!";

                //Envio de e-mail de confirmação de alteração de senha
                $cliente = new Clientes();
                $infoCliente = $cliente->getClienteById($_SESSION['clogin']);
                $texto = '
                    <p>Estamos avisando que houve uma alteração de senha na sua conta.</p>
                ';
                $email = new Email();
                $email->setNome($infoCliente['nome_cliente']);
                $email->setEmail($infoCliente['email_cliente']);
                $email->setAssunto('Alteração de Senha');
                $email->setMensagem($texto);
                $email->sendEmailTo();
            }else{
                $_SESSION['flash'] = "A senha digitada não confere ou não condiz com o mínimo de 6 caracteres.";
            }
        }

        header('Location:'.BASE_URL.'arsenha');
        exit;
    }
}