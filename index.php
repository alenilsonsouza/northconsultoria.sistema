<?php
session_start();
require 'config.php';

spl_autoload_register(function ($class){

        if(file_exists('controllers/'.$class.'.php')) {
                require_once 'controllers/'.$class.'.php';
        }elseif(file_exists('controllers/painel/'.$class.'.php')) {
                require_once 'controllers/painel/'.$class.'.php';
        }elseif(file_exists('controllers/site/'.$class.'.php')) {
                require_once 'controllers/site/'.$class.'.php';
        } elseif(file_exists('controllers/usuario/'.$class.'.php')) {
                require_once 'controllers/usuario/'.$class.'.php';
        }elseif(file_exists('models/'.$class.'.php')) {
                require_once 'models/'.$class.'.php';
        } elseif(file_exists('core/'.$class.'.php')) {
                require_once 'core/'.$class.'.php';
    }
});

$core = new Core();
$core->run();
?>
