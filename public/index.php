<?php
require '../helpers.php';
// require the router class
require basePath('Router.php');
require basePath('Database.php');

// Instantiate the router 
$router = new Router();

// Get routes
$routes = require basePath('routes.php');

// Get current URI and HTTP method
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// inspect($uri);
// inspect($method);

// call the route method, pass in the uri & the method of whatever page we are visiting
$router->route($uri, $method);