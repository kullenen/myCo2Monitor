<?php

namespace Kullenen\Co2;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/constants.php';

use DI\ContainerBuilder;

if (!file_exists(APP_ROOT . '/settings.php')) {
	copy(APP_ROOT . '/settings.php.dist', APP_ROOT . '/settings.php');
}

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(require APP_ROOT . '/settings.php');

return $containerBuilder->build();
