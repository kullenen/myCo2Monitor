<?php

namespace Kullenen\Co2;

use Psr\Container\ContainerInterface;

class ContainerObject {
	protected $container;

	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}
}
