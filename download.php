<?php 

require_once 'connectToDB.php';
//we should have the code we use to connect with the DB in a seperate file so it's consistent everywhere in our project



$mysqli = @new mysqli($db_host, $db_user, $db_password, $db_db);
if($mysqli->connect_error) die("Fatal Error");

if(isset($_GET['fileID']))
{
	echo downloadFile($_GET['fileID'], $mysqli);
	exit();
}
//echo "Hello World";
//echo downloadFile("A0001", $mysqli);


function downloadFile($fileID, $sqli) //fileID should be given as an argument when calling this function
{
	
	$query = "SELECT * from files WHERE fileID = '$fileID'"; 
	$result = $sqli->query($query);
	if(!$result) die ("Database access failed");
	$row = mysqli_fetch_array($result);
	
	if($row['fileLocation']) {
		if(!file_exists($row['fileLocation']))
		{
			die('file not found');
		}
		else
		{
			$file = $row['fileLocation'];
			$fileName = $row['fileName'];
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header("Content-Disposition: attachment; filename= $fileName");
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();

			readfile($row['fileLocation']);
			
	}
	}
	else {
		echo "Failed";
}
}
 ?>

