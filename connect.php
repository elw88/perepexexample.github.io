<?php
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
  
  //runs query on database
  if ($result = $mysqli -> query("SELECT * FROM test_table")) {
      //prints number of rows in database
      echo "Returned rows are: " . $result -> num_rows;
      echo '<br>';
  
      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "id: " . $row["id_test"]. "<br>";
          }
      } 
      else {
          echo "0 results";
      }
      
      // Free result set
      $result -> free_result();
  }
  
  //tests a inserting data into database 
  if ($result = $mysqli -> query("INSERT INTO `test_table` (`id_test`, `test_1`, `test_2`, `test_3`) VALUES ('2', '3', '4', '5');")) {
      echo "Returned rows are: ";
      echo '<br>';
      $result -> free_result();
  }

  //close instance of the database connection
  $mysqli->close();
?>