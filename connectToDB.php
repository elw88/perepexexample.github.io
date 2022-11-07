<?php
	//This is just the part of Will's code that connects to the DB

    //this links the php file with the database in phpmyadmin
    //database host
    //database username
    //database password
    //database name
  $db_host = 'localhost';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'testing';
 
  //creates a new instance of the database connection
  $mysqli = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );
	
  //checks if there is an error in the database connection
  if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
  }

  //notifies if there is a successful connection
  echo 'Success: A proper connection to MySQL was made.';
  echo '<br>';
  echo 'Host information: '.$mysqli->host_info;
  echo '<br>';
  echo 'Protocol version: '.$mysqli->protocol_version;
  echo '<br>';
  ?>