<?php

namespace Kullenen\Co2\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Middlewares\Reader;
	
class StaticFiles implements MiddlewareInterface {
	private const TYPES = [
		'css' => 'text/css',
		'js' => 'text/javascript',
	];

	private $reader;
	private $factory;

	/**
	 * Process a request and return a response.
	 */
	public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
		$factory = $this->getFactory($request);

		return $this->getReader($factory)->process($request, $handler);
	}

	private function getFactory($request) {
		if (!$this->factory) {
			$this->factory = new StaticFilesResponseFactory($this->getContentType($request));
		}

		return $this->factory;
	}

	private function getReader(ResponseFactoryInterface $factory) {
		if (!$this->reader) {
			$this->reader = Reader::createFromDirectory(APP_ROOT . '/public', $factory)->continueOnError();
		}

		return $this->reader;
	}

	private function getContentType($request) {
		$ext = strtolower(pathinfo($request->getUri()->getPath(), PATHINFO_EXTENSION));

		return isset(self::TYPES[$ext]) ? self::TYPES[$ext] : "text/html";
	}
}
