<?php

use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use Api\Controllers\SubscriberController;
use Api\Http;

require __DIR__ . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder;
$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('POST', '/subscribers', [SubscriberController::class, 'create']);
    $r->addRoute('GET', '/subscribers', [SubscriberController::class, 'getAll']);
    $r->addRoute('GET', '/subscribers/{id}', [SubscriberController::class, 'getOne']);
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
    echo '404 Not Found';
    break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;

    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];

        $container->call($controller, $parameters);
        break;
}