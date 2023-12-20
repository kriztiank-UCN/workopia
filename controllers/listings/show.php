<?php

$config = require basePath('config/_db.php');
$db = new Database($config);

$id = $_GET['id'] ?? '';
// inspect($id);

$params = [
  // named params
  'id' => $id
];

$listing = $db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();
// inspect($listing);

// get the data from the database where that listing id matches the id in the url
// load view and pass in the listing from the database, access them in the view with $listings
loadView('listings/show', [
  'listing' => $listing
]);
