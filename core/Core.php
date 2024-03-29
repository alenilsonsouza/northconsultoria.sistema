<?php
class Core {

	public function run() {
        $url = '/'.(isset($_GET['q'])?$_GET['q']:'');

		$params = array();
		if(!empty($url) && $url != '/') {
			$url = explode('/', $url);
			array_shift($url);

			$currentController = $url[0].'Controller';
			array_shift($url);

			if(isset($url[0]) && $url[0] != '/') {
				$currentAction = $url[0];
				array_shift($url);
			} else {
				$currentAction = 'index';
			}

			if(count($url) > 0) {
				$params = $url;
			}

		} else {
			$currentController = 'homeController';
			$currentAction = 'index';
		}

		if(!file_exists('controllers/'.$currentController.'.php') 
		&& !file_exists('controllers/painel/'.$currentController.'.php')
		&& !file_exists('controllers/site/'.$currentController.'.php')
		&& !file_exists('controllers/usuario/'.$currentController.'.php')) {
			$currentController = 'notFoundController';
			$currentAction = 'index';
		}

		$c = new $currentController();

		if(!method_exists($c, $currentAction)) {
			$currentAction = 'index';
		}

		call_user_func_array(array($c, $currentAction), $params);

	}

}