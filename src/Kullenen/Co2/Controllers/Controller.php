<?php

namespace Kullenen\Co2\Controllers;

use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;

class Controller {
	protected $container;
	protected $em;

	public function __construct(ContainerInterface $container) {
		$this->container = $container;
		$this->em = $this->container->get(EntityManager::class);
	}
}
