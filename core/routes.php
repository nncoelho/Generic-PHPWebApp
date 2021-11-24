<?php

// Routes collection
$routes = [
    'home'      => 'Main@index',
    'store'     => 'Main@store',
    'shopcart'  => 'Store@shopCart',

];

// Set default action
$action = 'home';

// Checks if action exists in the query string
if (isset($_GET['a'])) {

    // Checks if action exists in the routes
    if (!key_exists($_GET['a'], $routes)) {
        $action = 'home';
    } else {
        $action = $_GET['a'];
    }
}

// Handles the definition of the route
$parts = explode('@', $routes[$action]);
$controller = 'core\\controllers\\' . ucfirst($parts[0]);
$method = $parts[1];

$ctrl = new $controller();
$ctrl->$method();
