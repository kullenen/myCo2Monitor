<?php

namespace Kullenen\Co2\Controllers;

use Kullenen\Co2\ContainerObject;

class PeriodController extends ContainerObject {
	protected $from;
	protected $to;

	public function __invoke($request, $response, $args) {
		if (isset($args['from']) && isset($args['to'])) {
			$this->from = strtotime($args['from']);
			$this->to = strtotime($args['to']);
		} else {
			$this->from = strtotime('today');
			$this->to = strtotime('tomorrow - 1 sec');
		}

		return $response;
	}
}
