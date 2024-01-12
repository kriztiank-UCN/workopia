<?php
// method, uri, action
$router->get('/', 'HomeController@index');
$router->get('/listings', 'ListingController@index');
$router->get('/listings/create', 'ListingController@create');

$router->get('/listing/{id}', 'ListingController@show');
