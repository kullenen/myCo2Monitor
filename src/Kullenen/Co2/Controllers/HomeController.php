<?php

namespace Kullenen\Co2\Controllers;

class HomeController extends Controller {
	public function __invoke($request, $response, $args) {
		return $this->container->get('view')->render($response, 'home.twig');
	}
}
