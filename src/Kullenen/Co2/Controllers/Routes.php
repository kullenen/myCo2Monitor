<?php

namespace Kullenen\Co2\Controllers;

class Routes {
	public static function register($container) {
		$app = $container->get('app');

		$app->get('/', HomeController::class)->setName('home');
		$app->get('/data[/{from}/{to}]', DataController::class)->setName('data');
	}
}
