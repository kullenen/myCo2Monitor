<?php

namespace Kullenen\Co2;

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Kullenen\Co2\Controllers\Routes;

$container = require __DIR__ . '/../bootstrap.php';

\Kullenen\Co2\DI\App::register($container);
\Kullenen\Co2\DI\View::register($container);

\Kullenen\Co2\Controllers\Routes::register($container);

$container->get('app')->run();
