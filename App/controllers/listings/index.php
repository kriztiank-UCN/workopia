<?php

use Framework\Database;

$config = require basePath('config/_db.php');
$db = new Database($config);

$listings = $db->query('SELECT * FROM listings LIMIT 6')->fetchAll();

// inspect($listings);

// load view and pass in the listings from the database, access them in the view with $listings
loadView('listings/index', [
  'listings' => $listings
]);
