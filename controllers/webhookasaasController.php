<?php
class webhookasaasController extends controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_erros', 1);
        error_reporting(E_ALL);

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
        
        $response = $_POST;
        echo '<pre>';
        print_r($response);

        
    }
}
