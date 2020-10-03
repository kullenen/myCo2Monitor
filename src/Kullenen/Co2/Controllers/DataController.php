<?php

namespace Kullenen\Co2\Controllers;

use Kullenen\Co2\Doctrine\Entities\Co2mon;
use Doctrine\ORM\EntityManager;

class DataController extends Controller {
	public function __invoke($request, $response, $args) {
		if (isset($args['from']) && isset($args['to'])) {
			$from = strtotime($args['from']);
			$to = strtotime($args['to']);
		} else {
			$from = strtotime('today');
			$to = strtotime('tomorrow - 1 sec');
		}

		$em = $this->container->get(EntityManager::class);
		$result = $em->getRepository(Co2mon::class)->getForPeriod($from, $to);
		$response->getBody()->write(json_encode($result));

		return $response->withHeader('Content-Type', 'application/json');
	}
}
