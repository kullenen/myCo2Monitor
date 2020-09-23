<?php

namespace Kullenen\Co2;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$container = require_once __DIR__ . '/bootstrap.php';

\Kullenen\Co2\DI\Doctrine::register($container);

return ConsoleRunner::createHelperSet($container->get(EntityManager::class));
