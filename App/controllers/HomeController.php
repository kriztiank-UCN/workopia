<?php

namespace App\Controllers;

use Framework\Database;

// The HomeController is being autoloaded by composer.json
// It's then being extracted & instantiated in Framework/Router.php
class HomeController
{
  // Property of the class, accessible in all methods of the class with $this->db
  // Instantiante the database connection and save it in the $db property
  protected $db;

  public function __construct()
  {
    // load the database
    $config = require basePath('config/_db.php');
    $this->db = new Database($config);
  }

  public function index()
  {
    $listings = $this->db->query('SELECT * FROM listings LIMIT 2')->fetchAll();

    // load view and pass in the listings from the database, access them in the view with $listings
    loadView('home', [
      'listings' => $listings
    ]);
  }
}
