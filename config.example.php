<?php
require 'environment.php';
date_default_timezone_set('America/Sao_Paulo');
global $config;
global $db;

$config = [];
if(ENVIRONMENT == 'development') {

	define("BASE_URL", "http://localhost/aleEvolucoes/northconsultoria.com.br/");
	define("BASE_API",'http://127.0.0.1:8000/api');
	define('BASE_API_FILE','http://127.0.0.1:8000/storage/storage/');
	define("BASE_API_UPDLOAD_FILE", '../northconsultoria.api/storage/app/public/storage/');
	define("BASE_API_ASAAS", 'https://sandbox.asaas.com');
	define("APIKEY_ASAAS",'5d44ebee55257231bb846883e3d8759920a1e5a908384bce39d5a9528adf8658');
	$config['dbname'] = 'northconsultoria';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';

}elseif(ENVIRONMENT == 'preview'){

	define("BASE_URL", "//www.northconsultoria.net.br/preview/");
	define("BASE_API",'https://api.northconsultoria.net.br/api');
	define('BASE_API_FILE','https://api.northconsultoria.net.br/storage/storage/');
	define("BASE_API_UPDLOAD_FILE", '../api/storage/app/public/storage/');
	define("BASE_API_ASAAS", 'https://sandbox.asaas.com');
	define("APIKEY_ASAAS",'5d44ebee55257231bb846883e3d8759920a1e5a908384bce39d5a9528adf8658');
	$config['dbname'] = '';
	$config['host'] = '';
	$config['dbuser'] = '';
	$config['dbpass'] = '';

} elseif(ENVIRONMENT == 'production') {

	define("BASE_URL", "//www.northconsultoria.net.br/");
	define("BASE_API",'https://api.northconsultoria.net.br/api');
	define('BASE_API_FILE','https://api.northconsultoria.net.br/storage/storage/');
	define("BASE_API_UPDLOAD_FILE", '../api/storage/app/public/storage/');
	define("BASE_API_ASAAS", 'https://www.asaas.com');
	define("APIKEY_ASAAS",'5d44ebee55257231bb846883e3d8759920a1e5a908384bce39d5a9528adf8658');
	$config['dbname'] = '';
	$config['host'] = '';
	$config['dbuser'] = '';
	$config['dbpass'] = '';
}

//Define o Desenvolvedor do Projeto
define("AUTOR", "Agência Órbita, Ale Evoluções");

//Define o idoma Padrão caso tenha Multilinguagem
$config['defaut_lang'] = 'pt-br';

//Define a url Padrão de Imagems:
define("BASE_URL_IMAGE", BASE_URL.'assets/images/');
//Define a url Padraão de Arquivos:
define("BASE_URL_FILES", BASE_URL.'assets/arquivos/');
//Define a url Padrão de CSS
define("BASE_URL_CSS", BASE_URL.'assets/css/');
//Define a url Padrão de Script
define("BASE_URL_SCRIPT", BASE_URL.'assets/js/');


$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass'],array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

define('VERSAO','Versão: beta 1.0');