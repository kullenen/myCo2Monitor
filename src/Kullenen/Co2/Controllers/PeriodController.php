<?php

namespace Kullenen\Co2\Controllers;

class PeriodController extends Controller {
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
