<?php
class esqueciminhasenhaController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        $u = new Usuarios();
        
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
        
        $this->loadViewInPainel('recuperarSenha', $dados);
    }

    public function recuperar() {
        
        $email = filter_input(INPUT_POST,'email');
        if($email) {
            $usuarios = new Usuarios();
            if($usuarios->verifyEmail($email)) {
                $item = $usuarios->getUsuarioByEmail($email);

                // Criação do Hash
                $id = md5($item['id']);
                
                // link para a recuperação
                $link = BASE_URL.'esqueciminhasenha/atualizarsenha/'.$id;
                // Montagem da mensagem para o e-mail
                $mensagem = '<p>Você solicitou a recuperação de senha de Acesso do Painel.</p>';
                $mensagem .= '<p>Clique no link abaixo e esolha a nova senha:</p>';
                $mensagem .= '<p><a href="'.$link.'">Clique aqui para recuperar a senha</a></p>';
                // Criação do objeto de envio de e-mail
                $email = new Email();
                $email->setNome($item['usuario']);
                $email->setEmail($item['email']);
                $email->setAssunto('Recuperação de Senha do Painel');
                $email->setMensagem($mensagem);
                $email->sendEmailTo();
                
                $_SESSION['flash'] = "Foi enviado para o seu e-mail as instruções de recuperação de senha.";
            }else {
                $_SESSION['flash'] = 'Este e-mail não consta cadastrado em nossa base de dados.';
            }
        }

        header('Location:'.BASE_URL.'esqueciminhasenha');
        exit;
    }

    public function atualizarsenha($id) {
        $dados = ['flash' => ''];
        if(!empty($_SESSION['flash'])) {
            $dados['flash'] = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        if(!empty($id)) {
            $usuario = new Usuarios();
            $dados['usuario'] = $usuario->getUsuarioById($id);

            $s = new Site();
            $dados['site'] = $s->getArray();
            $c = new Configuracoes();
            $dados['configuracoes'] = $c->getArray();

            $this->loadViewInPainel('atualizarSenha', $dados);
        }else{
            $_SESSION['flash'] = "Não foi possível identificar o cadastro";
        }
    }

    public function storageSenha() {
        $senha = filter_input(INPUT_POST,'senha');
        $confirmar_senha = filter_input(INPUT_POST,'confirmar_senha');
        $id = filter_input(INPUT_POST,'id');

        if($senha == $confirmar_senha && strlen($senha) >= 6) {
            $usuario = new Usuarios();
            $usuario->setSenha(md5($senha));
            $usuario->updatePass($id);
            $_SESSION['flash'] = "A sua senha foi alterada";
            header('Location:'.BASE_URL.'esqueciminhasenha/senhaalterada/'.$id);
            exit;
        }else{
            $_SESSION['flash'] = "Senhas não confere ou está menor que 6 caracteres.";
        }

        header('Location:'.BASE_URL.'esqueciminhasenha/atualizarsenha/'.$id);
        exit;
    }

    public function senhaalterada($id) {
        $dados = ['flash' => ''];
        if(!empty($_SESSION['flash'])) {
            $dados['flash'] = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $usuario = new Usuarios();
        $dados['usuario'] = $usuario->getUsuarioById($id);

        $s = new Site();
        $dados['site'] = $s->getArray();
        $c = new Configuracoes();
        $dados['configuracoes'] = $c->getArray();

        $this->loadViewInPainel('senhaalterada', $dados);
    }
}