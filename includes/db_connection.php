<?php
  // 1. Create a database connection
  // using constant instade of veriable for DB
  define("DB_SERVER", "localhost");
  define("DB_USER", "abcde");
  define("DB_PASS", "wxyz");
  define("DB_NAME", "experiment_abc");

  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection occurred.
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>