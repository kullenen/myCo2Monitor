<?php

namespace Kullenen\Co2\Controllers;

class Routes {
	public static function register($container) {
		$app = $container->get('app');

		$app->redirect('/favicon.ico', $app->getBasePath() . '/static/i/favicon.ico');

		$app->get(
			'/static[/{params:.*}]',
			function ($request, $response, $args) {
				return $response;
			}
		)->add(new \Kullenen\Co2\Middleware\StaticFiles($container))->setName('static');

		$app->get('[/[{from:[0-9][^/]+}/{to:[0-9][^/]+}]]', HomeController::class)->setName('home');
		$app->get('/data[/{from:[0-9][^/]+}/{to:[0-9][^/]+}]', DataController::class)->setName('data');
	}
}
