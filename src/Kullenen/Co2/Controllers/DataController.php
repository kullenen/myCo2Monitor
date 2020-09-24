<?php

namespace Kullenen\Co2\Controllers;

use Kullenen\Co2\Entities\Co2mon;

class DataController extends Controller {
	public function __invoke($request, $response, $args) {
		$qb = $this->em->createQueryBuilder();
		$qb->select('d')->from(Co2mon::class, 'd')
		   ->where('d.time >= ?1')
		   ->orderBy('d.time', 'ASC');
		//->setMaxResults(100);

		$result = array_map(					
			function ($item) {
				return array_map(
					function ($val) {
						return ($val instanceof \DateTime) ? $val->format('Y-m-d H:i:s') : $val;
					},
					$item
				);
			},
			$qb->getQuery()
			   ->setParameter(1, date('Y-m-d', strtotime('yesterday')))
			   ->getArrayResult()
		);

		$response->getBody()->write(json_encode($result));

		return $response->withHeader('Content-Type', 'application/json');
	}
}
