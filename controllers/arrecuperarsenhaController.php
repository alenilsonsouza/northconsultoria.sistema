<?php
class arrecuperarsenhaController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Clientes();
        
    }

    public function index() {
        $dados = array('flash'=>'');

        if(!empty($_SESSION['flash'])){
            $dados['flash'] = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $s = new Site();
        $dados['site'] = $s->getArray();
        $c = new Configuracoes();
        $dados['configuracoes'] = $c->getArray();
        $dados['page'] = "painel";
        
        $this->loadViewInUsuario('recuperarSenha', $dados);
    }

    public function recuperar() {
        
        $email = filter_input(INPUT_POST,'email');
        if($email) {
            $cliente = new Clientes();
            if($cliente->verifyEmail($email)) {
                $item = $cliente->getClienteByEmail($email);

                // Criação do Hash
                $id = md5($item['id_cliente']);
                // link para a recuperação
                $link = BASE_URL.'arrecuperarsenha/atualizarsenha/'.$id;
                // Montagem da mensagem para o e-mail
                $mensagem = '<p>Você solicitou a recuperação de senha do Beneficiário.</p>';
                $mensagem .= '<p>Clique no link abaixo e esolha a nova senha:</p>';
                $mensagem .= '<p><a href="'.$link.'">Clique aqui para recuperar a senha</a></p>';
                // Criação do objeto de envio de e-mail
                $m = new Email();
                $m->setNome($item['nome_cliente']);
                $m->setEmail($email);
                $m->setAssunto('Recuperação de Senha do Beneficiário');
                $m->setMensagem($mensagem);
                $m->sendEmailTo();
                
                $_SESSION['flash'] = "Foi enviado para o seu e-mail as instruções de recuperação de senha.Se não estiver na caixa de entrada, verifique na caixa de spam ou lixo eletrônico.";
            }else {
                $_SESSION['flash'] = 'Este e-mail não consta cadastrado em nossa base de dados.';
            }
        }

        header('Location:'.BASE_URL.'arrecuperarsenha');
        exit;
    }

    public function atualizarsenha($id) {
        $dados = ['flash' => ''];
        if(!empty($_SESSION['flash'])) {
            $dados['flash'] = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        if(!empty($id)) {
            $cliente = new Clientes();
            $dados['cliente'] = $cliente->getClienteById($id);

            $s = new Site();
            $dados['site'] = $s->getArray();
            $c = new Configuracoes();
            $dados['configuracoes'] = $c->getArray();

            $this->loadViewInUsuario('atualizarSenha', $dados);
        }else{
            $_SESSION['flash'] = "Não foi possível identificar o cadastro";
        }
    }

    public function storageSenha() {
        $senha = filter_input(INPUT_POST,'senha');
        $confirmar_senha = filter_input(INPUT_POST,'confirmar_senha');
        $id = filter_input(INPUT_POST,'id');

        if($senha == $confirmar_senha && strlen($senha) >= 6) {
            $cliente = new Clientes();
            $cliente->setSenha(md5($senha));
            $cliente->updatePass($id);
            $_SESSION['flash'] = "A sua senha foi alterada";
            header('Location:'.BASE_URL.'arrecuperarsenha/senhaalterada/'.$id);
            exit;
        }else{
            $_SESSION['flash'] = "Senhas não confere ou está menor que 6 caracteres.";
        }

        header('Location:'.BASE_URL.'arrecuperarsenha/atualizarsenha/'.$id);
        exit;
    }

    public function senhaalterada($id) {
        $dados = ['flash' => ''];
        if(!empty($_SESSION['flash'])) {
            $dados['flash'] = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $cliente = new Clientes();
        $dados['cliente'] = $cliente->getClienteById($id);

        $s = new Site();
        $dados['site'] = $s->getArray();
        $c = new Configuracoes();
        $dados['configuracoes'] = $c->getArray();

        $this->loadViewInUsuario('senhaalterada', $dados);
    }

    

}