<?php
class controller {

	protected $db;
	protected $lang;

	public function __construct() {
		global $config;
		$this->lang = new Language;
	}
	
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		include 'views/site/template.php';
	}

	public function loadTemplateInPainel($viewName, $viewData = array()) {
		include 'views/painel/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/site/'.$viewName.'.php';
	}

	public function loadViewInPainel($viewName, $viewData) {
		extract($viewData);
		include 'views/painel/'.$viewName.'.php';
	}

	public function loadTemplateInSistema($viewName, $viewData = array()) {
		include 'views/sistema/template.php';
	}

	public function loadViewInSistema($viewName, $viewData) {
		extract($viewData);
		include 'views/sistema/'.$viewName.'.php';
	}

	public function loadTemplateInUsuario($viewName, $viewData = array()) {
		include 'views/usuario/template.php';
	}

	public function loadViewInUsuario($viewName, $viewData) {
		extract($viewData);
		include 'views/usuario/'.$viewName.'.php';
	}

}