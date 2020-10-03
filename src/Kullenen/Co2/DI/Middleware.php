<?php

namespace Kullenen\Co2\DI;

class Middleware {
	public static function register($container) {
		$container->get('app')->add(new \Middlewares\TrailingSlash());

		$container->get('app')->add(new \Kullenen\Co2\Middleware\StaticFiles);

		$container->get('app')->addErrorMiddleware(false, true, true);
	}
}
