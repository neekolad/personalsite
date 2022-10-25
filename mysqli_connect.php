<?php

  // This file contains information about database connection
  // This file also connects to MySQL and chooses database

  // Setting variables
  define('DB_USER', 'despara');
  define('DB_PASSWORD', 'enigma11');
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'sitename');

  // Connecting to database

  $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or
  die('Could not connect to MySQL: ' . mysqli_connect_error());

  mysqli_set_charset($dbc, 'utf8');

 ?>
