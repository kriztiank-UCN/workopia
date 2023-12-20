<?php
require '../helpers.php';
require __DIR__ . '/../vendor/autoload.php';
// require the Router & Database classes, or autoload them
// require basePath('Framework/Router.php');
// require basePath('Framework/Database.php');

// spl_autoload_register(function ($class) {
//     $path = basePath("Framework/{$class}.php");
//     if (file_exists($path)) {
//         require $path;
//     }
// });

// Instantiate the router 
$router = new Router();

// Get routes
$routes = require basePath('routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// inspect($uri);
// inspect($method);

// call the route method, pass in the uri & the method of whatever page we are visiting
$router->route($uri, $method);