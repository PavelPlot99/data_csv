<?php

require __DIR__ . '/vendor/autoload.php';
require (__DIR__.'/common/env.php');
use App\Router\Factory\MainRouterFactory;
use App\Controllers\IndexController;
use App\Request\Request;

$router = MainRouterFactory::createRouter(new Request());

$router->get('/', IndexController::class, 'create');
$router->post('/parseCsv', IndexController::class, 'parseCsv');
$router->get('/index/{page}', IndexController::class, 'index');


$router->run();


