<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location:instructorlogin.php");
    exit;
}
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
    //gets the instructor id to use in creating classes and assignments - $_SESSION["instructor_id"]
    if($result = $mysqli -> query("SELECT instructor_id FROM instructors WHERE username='".$_SESSION["user"]."';")){
		while($row = $result->fetch_assoc()){
		    $_SESSION["instructorId"] = $row["instructor_id"];
		}
    }
 ?>

<?php 
$conn = mysqli_connect('localhost:3306','root','abcdefghj','perepexdb');

if(!$conn)
{
	die(mysqli_error());
}

if(isset($_POST['submit']))
{
	$textareaValue = trim($_POST['r']);
	
	$sql = "insert into review1 (textarea_content1) values ('".$textareaValue."')";
	$rs = mysqli_query($conn, $sql);
	
	
	if($affectedRows == 1)
	{
		$successMsg = "Record has been saved successfully";
	}
}



if(isset($_POST['submit2']))
{
	$textareaValue = trim($_POST['r2']);
	
	$sql = "insert into review2 (textarea_content2) values ('".$textareaValue."')";
	$rs = mysqli_query($conn, $sql);
	
	
	if($affectedRows == 1)
	{
		$successMsg = "Record has been saved successfully";
	}
}


if(isset($_POST['submit3']))
{
	$textareaValue = trim($_POST['r3']);
	
	$sql = "insert into review3 (textarea_content3) values ('".$textareaValue."')";
	$rs = mysqli_query($conn, $sql);
	
	
	if($affectedRows == 1)
	{
		$successMsg = "Record has been saved successfully";
	}
}
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head> 
     
 <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <link rel="stylesheet" type="text/css" href="easy-responsive-tabs.css " />
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/easyResponsiveTabs.js"></script>

<title>Faculty Page</title> 
<style type="text/css">

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
 <img src="ppx logo.png" id="logo"alt="Perepex logo" width="50" height="50"  />
<div class="topnav">
  <a class="home" href="HomePage.html">Home</a>
  <a class="about" href="https://www.perepex.org">The "About" site</a>
   <a class="contact" href="Contacts.html">Contact</a>
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
</br>
<h1 align="center" style="color:blue;">PEREPEX Faculty Console</h1>
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
                <li>Create Class</li>
                <li>Create Assignment</li>
                <li>Enrollment</li>
               <!-- <li>Class Information</li>-->
            </ul>
            <div class="resp-tabs-container hor_1">
                <div>
                    <p>
                        <!--vertical Tabs for Current Assignment-->

                        <div id="ChildVerticalTab_1">
                            <ul class="resp-tabs-list ver_1">
                                <li>Class Form</li>
                               <!-- <li>Assignment 2</li> -->
                               <!-- <li>Assignment 3</li> -->
                               <!-- <li>Long name Responsive Tab 4</li> -->
                            </ul>
                            <div class="resp-tabs-container ver_1">
                                <div>
                                     <form action="/action_page.php">
                                        <label for="fname">Class name:</label>
                                        <input type="text" id="fname" name="fname" value="">
                                        
                                        <input type="submit" value="Submit">
                                    </form>
                                </div>
                             
                               
                              
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
                                <li>Assignment Form</li>
                            <!--    <li>Review 2</li> -->
                              <!--  <li>Review 3</li> -->
                               <!-- <li>Long name Responsive Tab 4</li>-->
                            </ul>
                            <div class="resp-tabs-container ver_2">
                                <div>
                                    <form action="/action_page.php">
                                        <label for="fname">Assignment name:</label>
                                        <input type="text" id="fname" name="fname" value="">
                                        
                                        <label for="ddate">Due Date:</label>
                                        <input type="text" id="ddate" name="ddate" value="">
                                        
                                        <input type="submit" value="Submit">
                                    </form>
                                            
                                </div>
                                

                           
                             
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
                                <li>Class 1</li>
                                <li>Class 2</li>
                                <li>Class 3</li>
                               <!-- <li>Long name Responsive Tab 4</li>-->
                            </ul>
                            <div class="resp-tabs-container ver_3">
                                <div>
                                <?php
                                    $mysqli = NEW MySQLi('localhost','root','root','perepexdb');
                                    $resultSet = $mysqli->query("SELECT first_name FROM student");
                                ?>
                                    
                                    
                                    <label for="student-names">Select Name:</label>
                                    <select name="student-names" id="student-names">
                                    <?php
                                      while ($rows = $resultSet->fetch_assoc())
                                      {
                                          $first_name = $rows['first_name'];
                                          echo "<option value='$first_name'>$first_name</option>";
                                      }
                                    ?>    
                                    
                                    </select>
                                    <p>Completed Assignments x/y</p> 
                                    <p>Completed Reviews x/y</p> 
                                    
                                   
                                    
                                </div>
                                <div>
                                   <label for="student-names">Select Name:</label>
                                    <select name="student-names" id="student-names"></select>
                                    <p>Completed Assignments x/y</p> 
                                    <p>Completed Reviews x/y</p> 
                                   
                                </div>
                                <div>
                                    <label for="student-names">Select Name:</label>
                                    <select name="student-names" id="student-names"></select>
                                    <p>Completed Assignments x/y</p> 
                                    <p>Completed Reviews x/y</p> 
                                    
                                </div>
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

</html>
