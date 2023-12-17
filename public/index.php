<?php
require '../helpers.php';

// require the router class
require basePath('Router.php');

// instantiate the router object
$router = new Router();

// bring in the routes file
$routes = require basePath('routes.php');

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// inspect($uri);
// inspect($method);

// call the route method, pass in the uri & the method of whatever page we are visiting
$router->route($uri, $method);