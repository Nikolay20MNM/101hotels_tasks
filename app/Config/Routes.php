<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'CommentController::index');
$routes->post('/store', 'CommentController::store');
$routes->post('/delete/(:segment)', 'CommentController::delete/$1');