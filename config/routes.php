<?php


use App\Response;
use App\Request;

use Controllers\ContactsController;
use Controllers\HomeController;


/** @var App\Router $router */


$router->get('/',                   [HomeController::class, 'index']);
$router->get('/contacts',           [ContactsController::class, 'index']);
$router->get('/contacts/{id}',      [ContactsController::class, 'show']);
$router->post('/contact/add',       [ContactsController::class, 'add']);
$router->post('/contact/delete',    [ContactsController::class, 'delete']);
$router->post('/contact/edit',      [ContactsController::class, 'edit']);