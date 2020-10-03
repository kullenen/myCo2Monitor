<?php

namespace Kullenen\Co2\Controllers;

class HomeController extends PeriodController {
	public function __invoke($request, $response, $args) {
		$response = parent::__invoke($request, $response, $args);

		$from = date('Y-m-d H:i:s', $this->from);
		$to = date('Y-m-d H:i:s', $this->to);

		$routeParser = $this->container->get('app')->getRouteCollector()->getRouteParser();
		$dataUrl = $routeParser->urlFor('data', ['from' => $from, 'to' => $to]);

		return $this->container->get('view')->render(
			$response,
			'home.twig',
			[
				'from' => $from,
				'to' => $to,
				'dataUrl' => $dataUrl
			]
		);
	}
}
