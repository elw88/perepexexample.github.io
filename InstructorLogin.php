<?php
    session_start();
    $_SESSION["loginError"] = "";
    if(isset($_POST['loginButton'])) {
            login();
    }
    if(isset($_POST['signUpButton'])) {
            signUp();
    }

      function login(){
        //this links the php file with the database in phpmyadmin
        //database host
        //database username
        //database password
        //database name
        $db_host = 'localhost:3306';
        //$port = '3306';
        $db_user = 'root';
        $db_password = 'abcdefghj';
        $db_db = 'perepexdb';

        //creates a new instance of the database connection
        $mysqli = @new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_db,
            //$port
            );

          //checks if there is an error in the database connection
          if ($mysqli->connect_error) {
            echo 'Errno: '.$mysqli->connect_errno;
            echo '<br>';
            echo 'Error: '.$mysqli->connect_error;
            exit();
          }

          session_start();
          
          if ($result = $mysqli -> query("SELECT username, password, first_name, last_name FROM instructors")){
              while($row = $result->fetch_assoc()){
                  if($row["username"] == $_POST["username"]){
                      if($row["password"] == $_POST["password"]){
                          $_SESSION["name"] = $row["first_name"]. " " . $row["last_name"];
                          $_SESSION["user"] = $row["username"];
                          header("location:facultypage.php");
                      }
                  }
              }
              $_SESSION["loginError"] = "Invalid Login";
          }
      }
    function signUp(){
           //this links the php file with the database in phpmyadmin
            //database host
            //database username
            //database password
            //database name
        $db_host = 'localhost:3306';
        //$port = '3306';
        $db_user = 'root';
        $db_password = 'abcdefghj';
        $db_db = 'perepexdb';

        //creates a new instance of the database connection
        $mysqli = @new mysqli(
            $db_host,
            $db_user,
            $db_password,
            $db_db,
            //$port
            );
        /*$username = $_POST["user"];
        $password = $_POST["psw"];
        $email = $_POST["email"];
        $first = $_POST["First"];
        $last = $_POST["Last"];*/
        /*('".$username."','".$password."','".$first."','".$last."''".$email."')*/
        
        $username = $_POST["user"];
        $password = $_POST["psw"];
        $email = $_POST["email"];
        $first = $_POST["First"];
        $last = $_POST["Last"];
        
        $atPattern = "/@/i";
        $comPattern = "/.com/i";
        $orgPattern = "/.org/i";
        $eduPattern = "/.edu/i";
        
        if(preg_match($atPattern, $email) == 1){
            if((preg_match($comPattern, $email) == 1) or (preg_match($orgPattern, $email) == 1) or (preg_match($eduPattern, $email) == 1)){
                //inserts login into database
                if ($result = $mysqli -> query("INSERT INTO instructors (username, password, first_name, last_name, email) VALUES ('".$username."','".$password."','".$first."','".$last."','".$email."');")) {
                    $_SESSION["name"] = $first. " " . $last;
                    $_SESSION["user"] = $username;
                    header("location:facultypage.php");
                }
            }
        }
        $_SESSION["loginError"] = "Invalid Email";
  
    }
?>

<!DOCTYPE html html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="stylesheet1.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Perepex Log-in</title>

    <style type="text/css">
.bg-img {
  /* The image used */
  background-image: url("backgroundimage1.jpg");

  min-height: 600px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
   .boxes{
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px;
    }

    /* .placeholder{
        color: gray;
        width: 300px;
        height: 50px;
        text-align: center;
    } */
.container {
position: center;
  background-color: white;
}

    * {box-sizing: border-box}
/* Full-width input fields */
  input[type=text], input[type=password] {
  width: 70%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: flex;
  flex-direction: column;
  border: none;
  background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;

}

/* Set a style for all buttons */
button {
  position: relative;
  background-color: #004fd6;
  color: white;
  padding: 10px 32px;
  margin: 6px 2px;
  font-size: 20px;
  border: none;
  cursor: pointer;
  display: inline-block;
  opacity: 0.9;
  text-decoration: none;
  border-radius: 15px;
}


button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 30px;
  border-radius:25px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
  
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 60%;
  border-radius: 25px;
  /*Could be more or less, depending on screen size */
}

/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}

.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
    width: 100%;
  }
}

    </style>
    </head>



<body>
   <div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
    <a href="HomePage.html" class="w3-bar-item w3-button"class="pull-left"><img src="ppx logo1.png"> Perepex</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="login.php" class="w3-bar-item w3-button">Student Login</a>
	  <a href="InstructorLogin.php" class="w3-bar-item w3-button">Instructor Login</a>
      <a href="https://www.perepex.org/" class="w3-bar-item w3-button">About</a>
      <a href="Contacts.html" class="w3-bar-item w3-button">Contact</a>
    </div>
  </div>
</div>


    <!-- Log-in boxes -->
    <div class="bg-img">
      <br></br><br></br><br></br>
      <center>
    <h2 style= "font-size:50px;">
        PEREPEX Instructor Login
    </h2><br></br>
    <section>
        <?php echo $_SESSION["loginError"]; ?>
        <form method="post" id="loginform">
            <input type="text" name="username" placeholder="Enter Username" required><br>
            <input type="text" name="password" placeholder="Enter Password" required><br>
			
        </form>
            <button type="submit" class="button4" name="loginButton" form="loginform">Login</button></br><br>
   




<!-- Button to open the modal -->

  <button onclick="document.getElementById('id01').style.display='block'">Sign Up</button>
  <br></br><br></br>
</center>
<br></br>
</div>
 </section>
<!-- The Modal (contains the Sign Up form) -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">X</span>
  <form class="modal-content" method="post" action="">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
	  
	  
	  
	  <label for="First"><b>First Name</b></label>
      <input type="text" placeholder="First Name" name="First" required>
	  
	   <label for="Last"><b>Last Name</b></label>
      <input type="text" placeholder="Last Name" name="Last" required>
	  
	   <label for="user"><b>Username</b></label>
      <input type="text" placeholder="Username" name="user" required>
	  
	  
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="submit" name="signUpButton" class="signupbtn">Sign Up</button>
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </div>
  </form>
</div>






</body>


</html>
