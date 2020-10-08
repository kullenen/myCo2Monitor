<?php

namespace Kullenen\Co2\Middleware;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Middlewares\Reader;
use Kullenen\Co2\ContainerObject;
	
class StaticFiles extends ContainerObject implements MiddlewareInterface {
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
		$request = $this->removeBasePathFromRequest($request);

		$factory = $this->getFactory($request);

		return $this->getReader($factory)->process($request, $handler);
	}

	private function removeBasePathFromRequest($request) {
		$basePath = $this->container->get('app')->getBasePath();

		if ($basePath) {
			$uri = $request->getUri();
			$path = preg_replace(sprintf('/^%s/', preg_quote($basePath, '/')), '', $uri->getPath());
			$request = $request->withUri($request->getUri()->withPath($path));
		}

		return $request;
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
