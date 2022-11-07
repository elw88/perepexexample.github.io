<?php
     //this links the php file with the database in phpmyadmin
     //database host
     //database username
     //database password
     //database name
 	 //include 'login.php';
	 include 'download.php';
	session_start();
	$_SESSION["fileupload"] = "";
	if(!isset($_SESSION["user"])){
	    header("Location:Login.php");
	    exit;
	}
	if(isset($_POST['submitAssignment'])) {
		submit();
	}
 	$db_host = 'localhost';
 	//$port = '3306';
 	$db_user = 'root';
 	$db_password = 'root';
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
     //starts session
     session_start();
	//gets student id
	   if ($result = $mysqli -> query("SELECT assignment_name, assignment_id FROM assignments WHERE fk_class_id in (SELECT fk_class_id FROM student_class_junction WHERE fk_student_id IN (SELECT student_id FROM student WHERE username='".$_SESSION["user"]."'));")){
		while($row = $result->fetch_assoc()){
		    $_SESSION["assignment"] = $row["assignment_name"];
		    $_SESSION["assignmentId"] = $row["assignment_id"];
		}
		$result -> free_result();
	    }
	    if($result = $mysqli -> query("SELECT student_id FROM student WHERE username='".$_SESSION["user"]."';")){
		while($row = $result->fetch_assoc()){
		    $_SESSION["studentId"] = $row["student_id"];
		}
		$result -> free_result();
	    }
	 $userID = $_SESSION["studentId"]; // I don't know how to get this from the session, will fix later
    function submit(){
        unset($_SESSION["fileupload"]);
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
            $port
            );

        //checks if there is an error in the database connection
        if ($mysqli->connect_error) {
            echo 'Errno: '.$mysqli->connect_errno;
            echo '<br>';
            echo 'Error: '.$mysqli->connect_error;
            exit();
        }


        //Need to create an "uploads" folder in the root directroy of 
        //the server for the target directory 
        $target_dir = "uploads/";
        $file_name = basename($_FILES["filename"]["name"]);
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        //doesn't actually check fiel type - needs fixing
        if(isset($_POST["submit"])) {
            $check = filesize($_FILES["filename"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                if(!isset($_SESSION["fileupload"])){
                    $_SESSION["fileupload"] = "Invalid File Type";
                }
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            if(!isset($_SESSION["fileupload"])){
                $_SESSION["fileupload"] = "Sorry, file already exists.";
            }
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["filename"]["size"] > 100000000) {
            if(!isset($_SESSION["fileupload"])){
                $_SESSION["fileupload"] = "Sorry, your file is too large.";
            }
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "pptx") {
                if(!isset($_SESSION["fileupload"])){
                    $_SESSION["fileupload"] = "Sorry, only PPTX, JPG, JPEG, PNG & GIF files are allowed.";
                }
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                if(!isset($_SESSION["fileupload"])){
                    $_SESSION["fileupload"] = "Sorry, your file was not uploaded.";
                }
                // if everything is ok, try to upload file
            } 
            else {
                //moves file to server folder 
                if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
                    //inserts file name into database
                    if ($result = $mysqli -> query("INSERT INTO `submissions` (`fk_student_id`, `fk_assignment_id`, `file_name`) VALUES ('".$_SESSION["studentId"]."','".$_POST["assignmentId"]."','".$file_name."');")) {
                        if(!isset($_SESSION["fileupload"])){
                            $_SESSION["fileupload"] = "The file: ". htmlspecialchars( basename( $_FILES["filename"]["name"])). " has been uploaded.";
                        }
                        /*$result -> free_result();*/
                    }
                } 
                else {
                    if(!isset($_SESSION["fileupload"])){
                        $_SESSION["fileupload"] = "$target_file";
                    }
                }
            }
    }
 ?>


<?php 
$conn = mysqli_connect('localhost','root','root','perepexdb');

if(!$conn)
{
	die(mysqli_error());
}

if(isset($_POST['submit']))
{
	$textareaValue = trim($_POST['r']);
	$resID = $_POST['responseID'];
	$sql = "update responses set text_response = '$textareaValue' where response_id = $resID"; //insert response text at response id (responses that are due already exist)
	
	
	
	if($conn->query($sql) === TRUE) 
	{
		echo "Record updated successfully";
	} else 
	{
		echo "Error updating record: " . $conn->error;
	}
}
$conn->close();
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head> 
     
 <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <link rel="stylesheet" type="text/css" href="easy-responsive-tabs.css " />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Lora">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/easyResponsiveTabs.js"></script>

<title>Student Page</title> 
<style type="text/css">

.bg {
  background-image: url("backgroundimage1.jpg");
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

}
.topnav {
  background-color: #ffffff;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav {
  float: right;
  color: black;
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

#logo { 
  float: left;
  display: inline-block;
  
}

/*buttons for inside tabs */
.button {
  background-color: #0000FF; /* Blue */
  border: solid;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button1 {border-radius: 2px;}
.button2 {border-radius: 4px;}
.button3 {border-radius: 8px;}
.button4 {border-radius: 12px;}
.button5 {border-radius: 50%;}


/* stlye for vertical tabs */

* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}


/* Style for new horizontal/vertical tabs */ 
     <style type="text/css" rel="stylesheet">
        body {
            background: white;
        }
        #container {
            width: 1100px;
            height: 700px;
            margin: 0 auto;
        }
        @media only screen and (max-width: 768px) {
            #container {
                width: 90%;
                margin: 0 auto;
            }
        }
    
    
    /*Download Button for Reviews Tabs*/
    /* Style buttons */
        .btn {
            background-color: DodgerBlue;
            border: none;
            color: white;
            padding: 12px 30px;
            cursor: pointer;
            font-size: 20px;
            }

/* Darker background on mouse-over */
        .btn:hover {
            background-color: RoyalBlue;
            }
    
    
    
/*CSS for respond button text box*/
    /* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #0000FF;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: relative;
  bottom: -5px;
  right: 0px;
  width: 280px;
    border-radius: 12px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: relative;
  bottom: -20px;
  right: 1px;
  /*border: 3px solid #f1f1f1;*/
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 800px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #0066ff;
  color: white;
  padding: 6px 6px;
  border: none;
  cursor: pointer;
  width: 25%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: #003d99;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
/*End of CSS for respond text box*/
    
   
    /*CSS for test respond review 2*/
#text {
  display: block;
  width: 100%;
  background-color: transparent;
  color: #021652;
  border: 2px solid #3ba9f4;
  border-radius: 2px;
  resize: none;
  margin-bottom: 35px;
  height: 200px;
  padding: 10px;
  font-size: 20px;
}

    #filename {
  width: calc(100% - 200px);
  border: 2px solid #3ba9f4;
  border-radius: 2px;
  background-color: transparent;
  color: #052a53;
  padding: 0 10px;
  height: 50px;
  line-height: 50px;
  font-size: 20px;
  margin-right: 20px;
}

    #download {
  background-color: #3ba9f4;
  color: #fff;
  font-size: 20px;
  height: 50px;
  border: none;
  border-radius: 2px;
  width: 174px;
  cursor: pointer;
}
    
  /* Respond review 3 */  
#text2 {
  display: block;
  width: 100%;
  background-color: transparent;
  color: #021652;
  border: 2px solid #3ba9f4;
  border-radius: 2px;
  resize: none;
  margin-bottom: 35px;
  height: 200px;
  padding: 10px;
  font-size: 20px;
}

    #filename2 {
  width: calc(100% - 200px);
  border: 2px solid #3ba9f4;
  border-radius: 2px;
  background-color: transparent;
  color: #052a53;
  padding: 0 10px;
  height: 50px;
  line-height: 50px;
  font-size: 20px;
  margin-right: 20px;
}

    #download2 {
  background-color: #3ba9f4;
  color: #fff;
  font-size: 20px;
  height: 50px;
  border: none;
  border-radius: 2px;
  width: 174px;
  cursor: pointer;
}


    
    /*CSS for response box*/
    
    body{
	font-family:verdana;
}

label{
	font-weight:400;
	margin:10px 0px;
	display:block;
	color:#003d99;
}

textarea{
	border:1px solid #eeeeee;
}

input[type=submit]{
	background:#0000FF;
	border:1px solid #0000FF;
	color:#ffffff;
	height:30px;
	display:block;
	margin:10px 0px;
}

input[type=submit]:hover{
	background:#0066ff;
	border:1px solid #0066ff;
	cursor:pointer;
}

.success-msg{
	background:#003d99;
	border:1px solid #003d99;
	color:#ffffff;
	width:33%;
}
    
    
</style> 

<!-- link to css page -->
 <link rel="stylesheet" type="text/css" href="Studentcss.css">



</head> 
<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
    <a href="HomePage.html" class="w3-bar-item w3-button"class="pull-left"><img src="ppx logo1.png"> Perepex</a>
    <!-- Right-sided navbar links. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
        <a href="login.html" class="w3-bar-item w3-button">Student Login</a>
    <a href="InstructorLogin.html" class="w3-bar-item w3-button">Instructor Login</a>
        <a href="https://www.perepex.org/" class="w3-bar-item w3-button">About</a>
        <a href="Contacts.html" class="w3-bar-item w3-button">Contact</a>
    </div>
  </div>
</div>
     
     <?php 
		if(isset($successMsg))
		{
			echo "<div class='success-msg'>";
			print_r($successMsg);
			echo "</div>";
		}
	?>


</br>
</br>
</br><div class="bg"> 
<h1 align="center" style="color:#004fd6; font-size: 5em;
  font-family: Arial;
  letter-spacing: 5px;
  text-shadow: 2px 2px 2px gray;">PEREPEX Student Console</h1>
<?php 
    echo "Hello " . $_SESSION["name"];
?>

 <div id="container">

       
        <hr>
        <br/>
        <br/>

        
        <br/>
        <!--Horizontal Tab-->
        <div id="parentHorizontalTab">
            <ul class="resp-tabs-list hor_1">
                <li>Current Assignments</li>
                <li>Pending Reviews</li>
                <li>Statistics</li>
                <li>Class Information</li>
            </ul>
            <div class="resp-tabs-container hor_1">
                <div>
                    <p>
                        <!--vertical Tabs for Current Assignment-->

                        <div id="ChildVerticalTab_1">
                            <ul class="resp-tabs-list ver_1">
                            <?php
									$query = "SELECT * from submissions WHERE  fk_student_id = '".$_SESSION["studentId"]."' AND is_submitted = false"; //find all assignments for the current user, excluding completed ones.
									$result = $mysqli->query($query);
									if(!$result) die ("Database access failed");
									while($row = mysqli_fetch_array($result)){ //This allows us to make a tab for each assignment the User has due. We close this loop in a different php tag.
									
									$assignmentName = mysqli_fetch_array($mysqli->query("SELECT assignment_name from assignments WHERE assignment_id = '$row[fk_assignment_id]'")); //we do this to find the name from the other table
									$assignmentName = $assignmentName[0];
								?> <!-- close the php tag so we can show the assignments with HTML -->
                                <li><?php echo $assignmentName ?> </li> <!-- This will show each assignment name-->
                               <!-- <li>Long name Responsive Tab 4</li> -->
							   <?php }  //close the loop ?>
                            </ul>
							
                            <div class="resp-tabs-container ver_1">
								<?php //performing the query again to get the descriptions
									$query = "SELECT * from submissions WHERE fk_student_id = '".$_SESSION["studentId"]."' AND is_submitted = false"; //find all assignments for the current user, excluding completed ones.
									$result = $mysqli->query($query);
									if(!$result) die ("Database access failed");
									while($row = mysqli_fetch_array($result)){
									$assignmentDesc = mysqli_fetch_array($mysqli->query("SELECT assignment_desc from assignments WHERE assignment_id = '$row[fk_assignment_id]'"));
									$assignmentDesc = $assignmentDesc[0];
                                    $assignmentId = $row['fk_assignment_id'];
								?>
                                <div>
									<p>Due:<?php echo $row['due_date']; ?></p> <!-- Show each assignment Description -->
									</br>
                                    <p><?php echo $assignmentDesc; ?></p> <!-- Show each assignment Description -->
                                    </br> <!-- NOTE: There's definitely a better way to handle whatever this is for with CSS -->
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                     <form action="" method="post" enctype="multipart/form-data" align="right">
                                        Select a file to upload:
                                        <input type="file" name="filename" id="fileToUpload">
                                        <input type="hidden" name="assignmentId" value="<?php echo $assignmentId; ?>">
                                        <input type="submit" value="Upload File" name="submitAssignment">
                                        <?php echo $_SESSION["fileupload"]; ?>
                                    </form>
                                </div>
								<?php } ?>
                            </div>
                        </div>
                    </p>
                   <!--<p><button class="button button4">Respond</button>  </p>-->
                </div>
                

                    <!--Vertical tabs pending reviews-->
                    <div>
                    
                    <p>
                        <!--vertical Tabs-->

                        <div id="ChildVerticalTab_2">
                            <ul class="resp-tabs-list ver_2">
                                <?php
									$query = "SELECT * from responses WHERE fk_student_id = '".$_SESSION["studentId"]."'"; //find all responses /assigned/ to the current user
									$result = $mysqli->query($query);
									if(!$result) die ("Database access failed");
									while($row = mysqli_fetch_array($result)){ //This allows us to make a tab for each assignment the User has due. We close this loop in a different php tag.
									
									$assignmentName = mysqli_fetch_array($mysqli->query("SELECT assignment_name from assignments WHERE assignment_id = '$row[fk_assignment_id]'"));
									$assignmentName = $assignmentName[0];
								?> <!-- close the php tag so we can show the assignments with HTML -->
                                <li><?php echo $assignmentName?> </li>
                               <!-- <li>Long name Responsive Tab 4</li>-->
							   <?php }  //close the loop ?>
                            </ul>
                            <div class="resp-tabs-container ver_2">
							<?php
									$query = "SELECT * from responses WHERE fk_student_id = '".$_SESSION["studentId"]."'"; //find all responses /assigned/ to the current user
									$result = $mysqli->query($query);
									if(!$result) die ("Database access failed");
									while($row = mysqli_fetch_array($result)){ //This allows us to make a tab for each assignment the User has due. We close this loop in a different php tag.
									
									$assignmentsQuery =  "SELECT * from assignments WHERE assignment_id = '$row[fk_assignment_id]'";
									$assignmentsResult = $mysqli->query($assignmentsQuery);
									if(!$assignmentsResult) die ("Database access failed");
									$rowAssignments = $assignmentsResult->fetch_assoc();
									
									$submissionsQuery =  "SELECT * from submissions WHERE submission_id = '$row[fk_submission_id]'";
									$submissionsResult = $mysqli->query($submissionsQuery);
									if(!$submissionsResult) die ("Database access failed");
									$rowSubmissions = $submissionsResult->fetch_assoc();

									
									//we need to access the info in the assignment and submission tables in each tab.
									
								?> <!-- close the php tag so we can show the assignments with HTML -->
                                <div>
                                    <p>Status: <?php if($row['is_completed']) {echo "Completed";} else {echo "Not Completed";}?></p>
                                    <p>Due: <?php echo $row['due_date'] ?></p>
									</br>
									<p><?php echo $rowAssignments['assignment_desc'] ?></p>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    <a href ="download.php?fileID=<?php echo $row['fk_submission_id'] ?>"> <button class="btn" style="width:100%"><!--<i class="fa fa-download"></i>--><?php echo $rowSubmissions['file_name']; ?>: Click to Download </button></a>
                                        <button class="open-button" onclick="openForm()">Respond</button>
                                            <div class="chat-popup" id="myForm">
                                                <form class="form-container" method = "post">
   <!-- <h1>Chat</h1>-->

		<label>Response: 1</label>
		
		<div>
			<textarea rows="10" cols="60" name="r" required></textarea>
		</div>
		<input type="hidden" value="<?php echo $row['response_id']?>" id="responseID" name ="responseID">
		<input type="submit" name="submit" value="Submit">
		
	</form>
                                            
                                </div>
                            </div>

						<?php } ?>
						
                            </div>
                        </div>
                    </p>
                    <br>
                    <br>
                        <!--Respond Button-->
                        
                </div>
                
                        <!--Vertical Tabs Statistics-->
                <div>
                           <p>
                        <!--vertical Tabs-->

                        <div id="ChildVerticalTab_3">
                            <ul class="resp-tabs-list ver_3">
                                <li>Assignments</li>
                                <li>Reviews</li>
								<li>Other</li>
                                <!--<li>Performance Snapshot</li>-->
                               <!-- <li>Long name Responsive Tab 4</li>-->
                            </ul>
                            <div class="resp-tabs-container ver_3">
                                <div>
									<?php
									$query = "SELECT * from student_class_junction WHERE fk_student_id = '$userID'"; //find all classes student is in
									$result = $mysqli->query($query);
									if(!$result) die ("Database access failed");
									while($row = mysqli_fetch_array($result)){ 
									
									$className = mysqli_fetch_array($mysqli->query("SELECT class_name from classes WHERE class_id = '$row[fk_class_id]'")); //finds the class name from class table
									$className = $className[0];
									?>								
                                    <p align="center"><?php echo $className ?></p>
									<?php
									$classquery = "SELECT * from submissions WHERE fk_student_id = '$userID' AND fk_class_id = '$row[fk_class_id]";
									$classresult = $mysqli->query($classquery);
									if(!$classresult) die ("Database access failed");
									$x = 0; //completed assignments
									$y = 0; //total assignments
									while($classrow = mysqli_fetch_array($result)){
										if($classrow['is_submitted'] = true)
										{$x++;}
										$y++;
									}
									?>
                                    <p>Completed Assignments: <?php echo $x?>/<?php echo $y?></p> </br>
									<?php } ?> <!-- end loop for displaying classes -->
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    
                                </div>
                                <div>
								<?php
									$query = "SELECT * from student_class_junction WHERE fk_student_id = '$userID'"; //find all classes student is in
									$result = $mysqli->query($query);
									if(!$result) die ("Database access failed");
									while($row = mysqli_fetch_array($result)){ 
									
									$className = mysqli_fetch_array($mysqli->query("SELECT class_name from classes WHERE class_id = '$row[fk_class_id]'")); //finds the class name from class table
									$className = $className[0];
									?>								
                                    <p align="center"><?php echo $className ?></p>
									<?php
									$assignmentQuery = "SELECT *";// find assignments in class
									$assignmentsArray = []; //list of assignment IDs in class
									while($assignmentsRow =  mysqli_fetch_array($mysqli->query($assignmentQuery)))
									{
										$assignmentArray[] = $assignmentsRow['assignment_id'];
									}
									$classquery = "SELECT * from responses WHERE fk_student_id = '$userID' AND fk_assignment_id IN ('".implode(',',$assignmentArray). "')"; //finds all responses where the assignment is from this class
									$classresult = $mysqli->query($classquery);
									if(!$classresult) die ("Database access failed");
									$x = 0; //completed responses
									$y = 0; //total responses
									while($classrow = mysqli_fetch_array($result)){
										if($classrow['is_completed'] = true)
										{$x++;}
										$y++;
									}
									?>
                                    <p>Completed Assignments: <?php echo $x?>/<?php echo $y?></p> </br>
									<?php } ?> <!-- end loop for displaying classes -->
                                    
                                     </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                   
                                </div>
								<div>
									<a href ="Logout.php"> <button class="btn" style="width:100%">Log Out</button></a>
									</br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    
								</div>
								<!--
                                <div>
                                    <p>Snapshot displayed here</p>
                                     </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                    
                                </div>
								-->
                                <div>
                                    <p>Assignment 4 info</p>
                                </div>
                            </div>
                        </div>
                    </p>
                    <br>
                    <br>
                    <p>Tab 3 Container</p>
                </div>
                <div>
                    <h1>Class 1</h1></br>
                    <h1>Class 2</h1></br>
                    <h1>Class 3</h1></br>
                    <br>
                    <br>
                    <p>Tab 4 Container</p>
                </div>
            </div>
        </div>
        <!--<div id="nested-tabInfo">
            Selected tab: <span class="tabName"></span>
        </div>-->

<!-- Javascipt link -->
<!--<script src="StudentScript.js">-->
<!-- JavaScript for new nested tabs -->
<script type="text/javascript">
    $(document).ready(function() {
        //Horizontal Tab
        $('#parentHorizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });

        // Child Tab 1
        $('#ChildVerticalTab_1').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
            tabidentify: 'ver_1', // The tab groups identifier
            activetab_bg: '#24C3EE', // background color for active tabs in this group
            inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
            active_border_color: '#c1c1c1', // border color for active tabs heads in this group
            active_content_border_color: '#24C3EE' // border color for active tabs contect in this group so that it matches the tab head border
        });
        
        // Child Tab 2
        $('#ChildVerticalTab_2').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
            tabidentify: 'ver_2', // The tab groups identifier
            activetab_bg: '#24C3EE', // background color for active tabs in this group
            inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
            active_border_color: '#c1c1c1', // border color for active tabs heads in this group
            active_content_border_color: '#24C3EE' // border color for active tabs contect in this group so that it matches the tab head border
        });
        
        
        //Child Tab 3
         // Child Tab 2
        $('#ChildVerticalTab_3').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true,
            tabidentify: 'ver_3', // The tab groups identifier
            activetab_bg: '#24C3EE', // background color for active tabs in this group
            inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
            active_border_color: '#c1c1c1', // border color for active tabs heads in this group
            active_content_border_color: '#24C3EE' // border color for active tabs contect in this group so that it matches the tab head border
        });
       

        //Vertical Tab
       $('#parentVerticalTab').easyResponsiveTabs({
            type: 'vertical', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            tabidentify: 'hor_1', // The tab groups identifier
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#nested-tabInfo2');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
    
    
    //Script for respond button functionality
    function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
    
    
//Script for saving textarea as file response 2
    
function downloadFile(filename, content) {
  // It works on all HTML5 Ready browsers as it uses the download attribute of the <a> element:
  const element = document.createElement('a');
  
  //A blob is a data type that can store binary data
  // "type" is a MIME type
  // It can have a different value, based on a file you want to save
  const blob = new Blob([content], { type: 'plain/text' });

  //createObjectURL() static method creates a DOMString containing a URL representing the object given in the parameter.
  const fileUrl = URL.createObjectURL(blob);
  
  //setAttribute() Sets the value of an attribute on the specified element.
  element.setAttribute('href', fileUrl); //file location
  element.setAttribute('download', filename); // file name
  element.style.display = 'none';
  
  //use appendChild() method to move an element from one element to another
  document.body.appendChild(element);
  element.click();
  
  //The removeChild() method of the Node interface removes a child node from the DOM and returns the removed node
  document.body.removeChild(element);
};

window.onload = () => {
  document.getElementById('download').
  addEventListener('click', e => {
    
    //The value of the file name input box
    const filename = document.getElementById('filename').value;
    
    //The value of what has been input in the textarea
    const content = document.getElementById('text').value;
    
    // The && (logical AND) operator indicates whether both operands are true. If both operands have nonzero values, the result has the value 1 . Otherwise, the result has the value 0 .
    
    if (filename && content) {
      downloadFile(filename, content);
    }
  });
};
    
    


</script>



<!-- Ok Button at Bottom -->
<button style="height:50px;width:100px">Ok</button>
</div>
</html>
