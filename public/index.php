<?php
require '../helpers.php';
require __DIR__ . '/../vendor/autoload.php';
// require the Router & Database classes, or autoload them and use namespaces
// require basePath('Framework/Router.php');
// require basePath('Framework/Database.php');

use Framework\Router;

// Instantiate the router 
$router = new Router();

// Get routes
$routes = require basePath('routes.php');

// Get current URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// inspect($uri);

// pass in the uri of whatever page we are visiting
$router->route($uri);