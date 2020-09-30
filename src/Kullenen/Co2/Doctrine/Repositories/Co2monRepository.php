<?php

namespace Kullenen\Co2\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Kullenen\Co2\Doctrine\Entities\Co2mon;

class Co2monRepository extends EntityRepository {
	public function getForPeriod($from, $to, $maxResultsDensity = 100) {
		$step = intdiv(($to - $from) ,$maxResultsDensity);

		$rsm = new ResultSetMapping;
		$rsm->addEntityResult(Co2mon::class, 'c');
		foreach (['id', 'time', 'ppm', 'temp'] as $name) {
			$rsm->addFieldResult('c', $name, $name);
		}

		$query = $this->_em->createNativeQuery(
			'SELECT id, MIN(time) AS time, AVG(ppm) AS ppm, AVG(temp) AS temp FROM co2mon'
			. ' WHERE time BETWEEN :from AND :to'
			. ' GROUP BY UNIX_TIMESTAMP(time) DIV :step'
			. ' ORDER BY 1',
			$rsm
		);

		$query->setParameter('from', (new \DateTime)->setTimeStamp($from))
			  ->setParameter('to', (new \DateTime)->setTimeStamp($to))
			  ->setParameter('step', $step);

		return array_map(
			function ($item) {
				return array_map(
					function ($val) {
						return ($val instanceof \DateTime) ? $val->format('Y-m-d H:i:s') : $val;
					},
					$item
				);
			},
			$query->getArrayResult()
		);
	}
}

	
