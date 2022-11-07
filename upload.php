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
        echo "File is of type - " . $imageFileType . $check["mime"];
        echo '<br>';
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        echo '<br>';
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    echo '<br>';
    $uploadOk = 0;
}

// Check file size
if ($_FILES["filename"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    echo '<br>';
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "pptx") {
        echo "Sorry, only PPTX, JPG, JPEG, PNG & GIF files are allowed.";
        echo '<br>';
        echo $imageFileType;
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        echo '<br>';
        // if everything is ok, try to upload file
    } 
    else {
        //moves file to server folder 
        if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["filename"]["name"])). " has been uploaded.";
            echo '<br>';
            //inserts file name into database
            if ($result = $mysqli -> query("INSERT INTO `store_file` (`file_name`) VALUES ('".$file_name."');")) {
                echo "uploaded to database";
                echo '<br>';
                /*$result -> free_result();*/
            }
        } 
        else {
            echo "$target_file";
        }
    }

?>

<html>
    <head>
    </head>
    <body>
        <form action="StudentPage.html" align="right">
            <input type="submit" value="Go Back">
        </form>
    </body>
</html>
