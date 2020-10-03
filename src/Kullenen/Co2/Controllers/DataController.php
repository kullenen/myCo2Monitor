<?php

namespace Kullenen\Co2\Controllers;

use Kullenen\Co2\Doctrine\Entities\Co2mon;
use Doctrine\ORM\EntityManager;

class DataController extends PeriodController {
	public function __invoke($request, $response, $args) {
		$response = parent::__invoke($request, $response, $args);

		$em = $this->container->get(EntityManager::class);
		$result = $em->getRepository(Co2mon::class)->getForPeriod($this->from, $this->to);
		$response->getBody()->write(json_encode($result));

		return $response->withHeader('Content-Type', 'application/json');
	}
}
