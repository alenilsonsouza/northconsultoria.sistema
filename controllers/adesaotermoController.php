<?php
class adesaotermoController extends controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $config = new Config();
        $dados['config'] = $config->getArray();

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['menu'] = 1;
        $dados['page'] = 'termo';

        $this->loadTemplate('termo', $dados);
    }

    public function client($id)
    {
        $dados = [];
        $dados['client'] = [];
        if ($id) {
            $p = new N_PeopleHandler();
            $dados['client'] = $p->listOne($id, true);
            if (isset($dados['client']['id'])) {
                if ($p->verifyCheckedTerm($dados['client']['id'])) {
                    Redirect::link('adesaotermo/aceito/' . $dados['client']['id']);
                }
            }
        }

        $config = new Config();
        $dados['config'] = $config->getArray();

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['menu'] = 1;
        $dados['page'] = 'home';

        $this->loadTemplate('adesaotermo', $dados);
    }

    public function aceito($id)
    {
        $dados = [];
        $dados['client'] = [];
        $c = new N_PeopleHandler();
        if ($id) {
            $dados['client'] = $c->listOne($id);
            if (isset($dados['client']['id'])) {
                $c->aceitoTermo($id);
                if (ENVIRONMENT == 'production') {
                    $e = new Email();
                    $e->setNome($dados['client']['name'] . ' (' . $dados['client']['cpf'] . ')');
                    $e->setEmail($dados['client']['email']);
                    $e->setAssunto('Aceito Termo');
                    $e->setMensagem('Cliente aceitou o termo');
                    $e->sendToClient();
                    $e->sendToConfirmClient();
                }
            }
        }

        $config = new Config();
        $dados['config'] = $config->getArray();

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['menu'] = 1;
        $dados['page'] = 'home';

        $this->loadTemplate('adesaotermoaceito', $dados);
    }
}
