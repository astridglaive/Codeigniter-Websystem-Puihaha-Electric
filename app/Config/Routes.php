<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('about', 'About::index');
$routes->get('services', 'Services::index');
$routes->match(['get', 'post'], 'contact', 'Contact::index');
$routes->get('register', 'Register::index');
$routes->post('register', 'Register::create');
$routes->match(['get', 'post'], 'setup', 'Setup::index');
$routes->get('login', 'Auth::login', ['as' => 'login']);
$routes->post('login', 'Auth::attemptLogin');
$routes->post('logout', 'Auth::logout', ['filter' => 'auth']);

$routes->group('', ['filter' => 'auth'], static function ($routes): void {
    $routes->get('dashboard', 'Customers::index');
    $routes->get('customers', 'Customers::index');
    $routes->get('customers/new', 'Customers::new');
    $routes->post('customers', 'Customers::create');
    $routes->get('customers/(:num)', 'Customers::show/$1');
    $routes->get('customers/(:num)/edit', 'Customers::edit/$1');
    $routes->post('customers/(:num)', 'Customers::update/$1');
    $routes->post('customers/(:num)/delete', 'Customers::delete/$1');
});
