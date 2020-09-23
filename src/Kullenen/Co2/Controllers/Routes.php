<?php

namespace Kullenen\Co2\Controllers;

class Routes {
	public static function register($container) {
		$app = $container->get('app');

		$app->get('/', HomeController::class)->setName('home');
	}
}
