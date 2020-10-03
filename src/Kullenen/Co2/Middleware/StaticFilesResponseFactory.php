<?php

namespace Kullenen\Co2\Middleware;

use Slim\Psr7\Factory\ResponseFactory;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;

class StaticFilesResponseFactory extends ResponseFactory {
	private $contentType;

	public function __construct($contentType) {
		$this->contentType = $contentType;
	}

	public function createResponse(
		int $code = StatusCodeInterface::STATUS_OK,
		string $reasonPhrase = ''
	): ResponseInterface {
		return parent::createResponse($code, $reasonPhrase)
			->withHeader("Content-Type", $this->contentType);
	}
}
