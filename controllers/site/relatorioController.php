<?php
class relatorioController extends controller
{

    public function documento()
    {

        $config = new Config();
        $dados['config'] = $config->getArray();

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['menu'] = 1;
        $dados['page'] = 'home';

        $this->loadTemplate('documento', $dados);
    }

    public function verifyExists()
    {

        $cpf = filter_input(INPUT_POST, 'cpf');
        $gRecaptchaResponse = filter_input(INPUT_POST, 'g-recaptcha-response');

        $google = new ReCaptchaGoogle();
        $verify = $google->verify($gRecaptchaResponse);

        if ($verify['success']) {
            if ($cpf) {

                $people = new N_PeopleHandler();
                $people = $people->listOneByCPFTitular($cpf);

                if (isset($people['id'])) {
                    $_SESSION['cpf_people'] = $cpf;
                    Redirect::link('relatorio/beneficiario');
                } else {
                    $_SESSION['flash'] = 'Não encontramos esse CPF em nossa base de dados.';
                    Redirect::link('relatorio/documento');
                }
            } else {
                $_SESSION['flash'] = 'Favor digitar o nº do seu documento.';
                Redirect::link('relatorio/documento');
            }
        } else {
            $_SESSION['flash'] = 'Captcha não aprovado ou não marcado.';
            Redirect::link('relatorio/documento');
        }
    }

    public function beneficiario()
    {
        if (!isset($_SESSION['cpf_people'])) {
            Redirect::link('relatorio/documento');
        }

        $people = new N_PeopleHandler();
        $dados['people'] = $people->listOneByCPFTitular($_SESSION['cpf_people']);
        //$dados['dependents'] = $people->listDependentsFromTitular(84);
    
        $dados['dependents'] = $people->listDependentsFromTitular($dados['people']['id']);

        $plan = new N_PlanHandler();
        $dados['plan'] = $plan->listOne($dados['people']['id_plan']);

        $config = new Config();
        $dados['config'] = $config->getArray();

        //Informações para o template
        $template = new Template();
        $dados['template'] = $template->getInfo();

        $dados['menu'] = 1;
        $dados['page'] = 'home';

        $this->loadTemplate('beneficiarios', $dados);
    }
}
