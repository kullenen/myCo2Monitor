<?php

namespace Kullenen\Co2\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Kullenen\Co2\Doctrine\Entities\Co2mon;

class Co2monRepository extends EntityRepository {
	const DEFAULT_LOCATION = 1;

	public function getForPeriod($from, $to, $maxResultsDensity = 100) {
		$to = $this->getAlignedTo($to, self::DEFAULT_LOCATION);

		$step = intdiv(($to - $from) ,$maxResultsDensity);

		if ($step <= 0) {
			return [];
		}

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

	private function getAlignedTo($to, $locationId) {
		$qb = $this->createQueryBuilder('c');

		$item = $qb->where('c.locationid = :locationId')
				   ->andWhere('c.time <= :time')
				   ->orderBy('c.time', 'DESC')
					->setParameters(
						[
							'locationId' => $locationId,
							'time' => (new \DateTime)->setTimeStamp($to)
						]
					)
				   ->setMaxResults(1)
				   ->getQuery()
				   ->getOneOrNullResult();

		return $item ? $item->getTime()->getTimestamp() : 0;
	}
}

	
