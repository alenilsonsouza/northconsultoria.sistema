<?php
class emailtesteController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $texto = '
            <p>Você recebeu este email porque se cadastrou no site Life Cartões</p>
        ';
        $email = new Email();
        $email->setNome('Alenilson Souza');
        $email->setEmail('alenilsonsouza@gmail.com');
        $email->setAssunto('Confirmação de E-mail');
        $email->setMensagem($texto);
        $email->sendEmailTo();
    }
}