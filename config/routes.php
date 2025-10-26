<?php
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

// Landing page
$routes->add('landing', new Route('/', [
    '_controller' => 'App\Controllers\LandingController::index'
]));

// Auth routes
$routes->add('auth', new Route('/auth/{mode}', [
    '_controller' => 'App\Controllers\AuthController::index'
]));

$routes->add('auth_login', new Route('/auth', [
    '_controller' => 'App\Controllers\AuthController::redirectToLogin'
]));

$routes->add('auth_process', new Route('/auth/process/{mode}', [
    '_controller' => 'App\Controllers\AuthController::process'
]));

$routes->add('logout', new Route('/logout', [
    '_controller' => 'App\Controllers\AuthController::logout'
]));

// Protected routes
$routes->add('dashboard', new Route('/dashboard', [
    '_controller' => 'App\Controllers\DashboardController::index'
]));

$routes->add('tickets', new Route('/tickets', [
    '_controller' => 'App\Controllers\TicketsController::index'
]));

$routes->add('tickets_create', new Route('/tickets/create', [
    '_controller' => 'App\Controllers\TicketsController::create'
]));

$routes->add('tickets_edit', new Route('/tickets/edit/{id}', [
    '_controller' => 'App\Controllers\TicketsController::edit'
]));

$routes->add('tickets_delete', new Route('/tickets/delete/{id}', [
    '_controller' => 'App\Controllers\TicketsController::delete'
]));

// 404 catch-all
$routes->add('notfound', new Route('/{any}', [
    'any' => '.*',
    '_controller' => 'App\Controllers\LandingController::notFound'
], ['any' => '.+']));

return $routes;