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

          if ($result = $mysqli -> query("SELECT username, password, first_name, last_name FROM student")){
              while($row = $result->fetch_assoc()){
                  if($row["username"] == $_POST["username"]){
                      if($row["password"] == $_POST["password"]){
                          $_SESSION["user"] = $row["first_name"]. " " . $row["last_name"];
                          header("location:StudentPage.php");
                      }
                  }
              }
              echo("Invalid Login. Go back and try again");
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
        $username = $_POST["user"];
        $password = $_POST["psw"];
        $email = $_POST["email"];
        $firstname = $_POST["firstName"];
        $lastname = $_POST["lastName"];
        
        $atPattern = "/@/i";
        $comPattern = "/.com/i";
        $orgPattern = "/.org/i";
        $eduPattern = "/.edu/i";
        
        if(preg_match($atPattern, $email) == 1){
            if((preg_match($comPattern, $email) == 1) or (preg_match($orgPattern, $email) == 1) or (preg_match($eduPattern, $email) == 1)){
                //inserts login into database
                if ($result = $mysqli -> query("INSERT INTO student (username, password, first_name, last_name, email) VALUES ('".$username."','".$password."','".$firstname."','".$lastname."','".$email."');")) {
                    $_SESSION["user"] = $firstname . " " . $lastname;
                    header("location:StudentPage.php");
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
    
    <title>Conforming XHTML 1.0 Transitional Template</title>

    <style type="text/css">

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

    h1 {
        display: flex;
        justify-content: space-around;
        font-size: 50px;
    }

    /* NAV bar css */
    .topnav {
        background-color: #ffffff;
        overflow: hidden;
    }

    /* Style the links inside the navigation bar */
    .topnav {
        float: right;
        color: #000000;
        text-align: left;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 20px;
        width: 25%;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
        background-color: #ddd;
        color: grey;
    }

    /* Add a color to the active/current link */
    .topnav a.home {
        background-color: #ffffff;
        color: #000000;
    }

    .topnav a.contact {
        background-color: #ffffff;
        color: #000000;
    }

    .topnav a.about {
        background-color: #ffffff;
        color: #000000;
    }

    h3{
      font-size: 22px;
    }

    #logo {
        /* float: left; */
        display: inline-block;
    }

    .button {
        background-color: #006aff;
        border: none;
        color: white;
        padding: 10px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 6px 2px;
        cursor: pointer
    }

    .button4 {border-radius: 15px;}


    * {box-sizing: border-box}
/* Full-width input fields */
  input[type=text], input[type=password] {
  width: 30%;
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
  background-color: #04AA6D;
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
  padding: 16px;
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
  width: 80%;
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

    <link rel="stylesheet" type="text/css" href="Studentcss.css">
    </head>



<body>
    <!-- navigation bar and logo -->
    <img src="ppx logo.png" id="logo" alt="Perepex logo" width="50" height="50"  />
    <div class="topnav">
        <a class="home" href="HomePage.html">Home</a>
       <a class = "about" href="https://www.perepex.org/">The "About" site</a>
         <a class="contact" href="Contacts.html" >Contact</a>
    </div>

    <br></br>
    <br></br>
    <br></br>



    <!-- Log-in boxes -->
    <h1>
        PEREPEX Log-in
    </h1>
    <section>
        <?php echo $_SESSION["loginError"]; ?>
        <form action="" method="post" class="boxes">
            <input type="text" name="username" placeholder="username" required><br>
            <input type="text" name="password" placeholder="password" required><br>
            <button type="submit" name="loginButton" class="button4">Login</button>
        </form>
    </section>














<!-- Button to open the modal -->
<center>
  <button onclick="document.getElementById('id01').style.display='block'">Sign Up</button>
</center>


<!-- The Modal (contains the Sign Up form) -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">X</span>
  <form class="modal-content" method="post" action="">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="firstName"><b>First Name</b></label>
      <input type="text" placeholder="First Name" name="firstName" required>
	  
      <label for="lastName"><b>Last Name</b></label>
      <input type="text" placeholder="Last Name" name="lastName" required>
        
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>
        <span> <?php echo $emailErr;?></span>
        
      <label for="user"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="user" required>

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
