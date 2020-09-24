<?php
namespace Kullenen\Co2;

use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Kullenen\Co2\Controllers\Routes;

$container = require __DIR__ . '/../bootstrap.php';

DI\App::register($container);
DI\View::register($container);
DI\Doctrine::register($container);

Controllers\Routes::register($container);

$container->get('app')->run();
