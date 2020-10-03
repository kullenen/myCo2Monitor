<?php

namespace Kullenen\Co2\Controllers;

class Routes {
	public static function register($container) {
		$app = $container->get('app');

		$app->redirect('/favicon.ico', '/static/i/favicon.ico');

		$app->get('/[{from:[0-9][^/]+}/{to:[0-9][^/]+}]', HomeController::class)->setName('home');
		$app->get('/data[/{from:[0-9][^/]+}/{to:[0-9][^/]+}]', DataController::class)->setName('data');
	}
}
