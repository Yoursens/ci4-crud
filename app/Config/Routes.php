<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ─── Web Routes ───────────────────────────────────────────────────────────────
$routes->get('/', 'Students::index');

// Student CRUD
$routes->get('/students',                'Students::index');
$routes->get('/students/create',         'Students::create');
$routes->post('/students/store',         'Students::store');
$routes->get('/students/edit/(:num)',    'Students::edit/$1');
$routes->post('/students/update/(:num)', 'Students::update/$1');
$routes->get('/students/delete/(:num)',  'Students::delete/$1');

// ─── API Routes (REST) ────────────────────────────────────────────────────────
$routes->resource('api/students', ['controller' => 'Api\Students']);
