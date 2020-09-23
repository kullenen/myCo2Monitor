<?php

namespace Kullenen\Co2\DI;

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

class View {
	public static function register($container) {
		$container->set('view', Twig::create(APP_ROOT . '/templates', ['cache' => false]));
		$app = $container->get('app');
		$app->add(TwigMiddleware::createFromContainer($app));
	}
}
