<?php

namespace App\Controllers;

class HomeController extends Controller {
	
	function index ($request, $response, $args) {
		// Render index view
		return $this->render($response, 'index.phtml', $args);
	}
}