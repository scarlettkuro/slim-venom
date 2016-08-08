<?php

namespace App\Controllers;

class Controller {
	
	private $app;
	
	public function __construct ($app) {
		$this->app = $app;
	}
	
	function render($response, $template, $args) {
		return $this->app->getContainer()->renderer->render($response, $template, $args);
	}
}