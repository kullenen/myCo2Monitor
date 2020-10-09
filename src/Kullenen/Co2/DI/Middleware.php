<?php

namespace Kullenen\Co2\DI;

class Middleware {
	public static function register($container) {
		$app = $container->get('app');

		$app->add(new \Middlewares\TrailingSlash());

		$app->addErrorMiddleware(false, true, true);
	}
}
