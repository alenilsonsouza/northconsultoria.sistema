<?php
class painelplanosController extends controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();

        $u = new Usuarios();
        if (!$u->isLogged()) {
            header("Location: " . BASE_URL . "login");
        }
    }

    public function index()
    {

        $planos = new N_PlanHandler();
        $planos = $planos->list();

        $this->loadTemplateInPainel('planos', [
            'page' => 'planos',
            'planos' => $planos
        ]);
    }

    public function addAction()
    {
        $product = filter_input(INPUT_POST, 'product');
        $price = filter_input(INPUT_POST, 'price');
        $text = filter_input(INPUT_POST, 'text');
        $file = $_FILES['file'];

        if (isset($file['tmp_name'])) {
            if ($product && $price) {
                $plan = new N_Plan();
                $planHandler = new N_PlanHandler();

                $plan->setProduct($product);
                $plan->setPrice(Moeda::setValorFloat($price));
                $plan->setText($text);
                $plan->setImage($file); // Arquivo enviado e configurado internamente
                $planHandler->insert($plan);
            }
        }

        header('Location:' . BASE_URL . 'painelplanos');
        exit;
    }

    public function change($id)
    {
        $plano = new N_PlanHandler();
        $plano->active($id);
        header('Location:' . BASE_URL . 'painelplanos');
        exit;
    }

    public function editar($id)
    {

        $planos = new N_PlanHandler();
        $plano = $planos->listOne($id);


        $this->loadTemplateInPainel('planos_edit', [
            'page' => 'planos',
            'plano' => $plano
        ]);
    }

    public function editAction()
    {
        $product = filter_input(INPUT_POST, 'product');
        $price = filter_input(INPUT_POST, 'price');
        $text = filter_input(INPUT_POST, 'text');
        $id = filter_input(INPUT_POST, 'id');
        $file = $_FILES['file'];

        /*echo '<pre>';
        print_r($_POST);
        exit;*/

        if ($product && $price) {

            $plan = new N_Plan();
            $planHandler = new N_PlanHandler();

            $plan->setProduct($product);
            $plan->setPrice(Moeda::setValorFloat($price));
            $plan->setText($text);
            if(isset($file['tmp_name'])) {
                $plan->setImage($file);
            } 
            $planHandler->update($plan, $id);
        }

        header('Location:' . BASE_URL . 'painelplanos');
        exit;
    }

    public function delete($id) {

        $planHandler = new N_PlanHandler();
        $planHandler->delete($id);

        header('Location:' . BASE_URL . 'painelplanos');
        exit;
    }

    public function addBeneficioAction()
    {
        $nome = filter_input(INPUT_POST, 'beneficio');
        $id_plano = filter_input(INPUT_POST, 'id_plano');

        if ($nome && $id_plano) {
            $beneficio =  new PlanoBeneficios();
            $beneficioHandler = new PlanoBeneficiosHandler();
            $beneficio->setBeneficio($nome);
            $beneficio->setIdPlano($id_plano);
            $beneficioHandler->insert($beneficio);
        }

        header('Location:' . BASE_URL . 'painelplanos/editar/' . $id_plano);
        exit;
    }

    public function excluirbeneficio($id)
    {
        $b = new PlanoBeneficiosHandler();
        $item = $b->pegarPorId($id);
        $id_plano = $item->getIdPlano();

        $b->excluirPorId($id);
        header('Location:' . BASE_URL . 'painelplanos/editar/' . $id_plano);
        exit;
    }
}
