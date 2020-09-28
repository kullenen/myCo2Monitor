<?php

namespace Kullenen\Co2\DI;

class Middleware {
	public static function register($container) {
		$container->get('app')->add(new \Middlewares\TrailingSlash());
	}
}
