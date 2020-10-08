<?php

namespace Kullenen\Co2\DI;

use Slim\Factory\AppFactory;

class App {
	public static function register($container) {
		$container->set('app', AppFactory::createFromContainer($container));
		if (isset($container->get('settings')['basePath'])) {
			$container->get('app')->setBasePath($container->get('settings')['basePath']);
		}
	}
}
