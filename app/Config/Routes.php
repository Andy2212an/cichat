<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Desplegar la vista
$routes->get('websocket', 'WebSocketController::index');
$routes->get('/averias', 'AveriaController::index');
$routes->get('/averias/registrar', 'AveriaController::registrar');
$routes->get('/averias/solucionado', 'AveriaController::solucionado');

//Procesos
$routes->post('public/api/averias/registrar', 'AveriaController::agregarRegistro');
$routes->get('public/api/averias/listar', 'AveriaController::listarAverias');
$routes->get('public/api/averias/solucionados', 'AveriaController::listarSolucionados');
$routes->post('public/api/averias/marcar-solucionado/(:num)', 'AveriaController::marcarSolucionado/$1');