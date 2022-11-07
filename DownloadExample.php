<?php
	require_once 'connectToDB.php';
	include 'download.php';
?>
<!DOCTYPE html>
<html>
<body>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<meta charset= "utf-8"/>
	<link href= "css/bootstrap/bootstrap.min.css" rel = "stylesheet"/>


</head>
<body>

<div class = "container">
	<table class= "table table-bordered">
		<thead>
			<tr>
				<th>File Name</th>
				<th>User</th>
				<th>Download</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * from files"; 
			$result = $mysqli->query($query);
			if(!$result) die ("Database access failed");
			while($row = mysqli_fetch_array($result)){
			?> <!-- close the php tag so we can make table rows in HTML -->
			<tr>
			<td><?php echo $row['fileName'] ?> </td>
			<td><?php echo $row['userID'] ?> </td>
			<td class = "text-center"><a href ="download.php?fileID=<?php echo $row['fileID'] ?>" class = "btn btn-primary"> Download File </a> </td>

			</tr>
			<?php #reopen the php so it can continue running the loop
			}
			?>
		</tbody>
	</table>
</div>
<?php
#$button1File = "A0001";
#$button2File = "A0002";
#if(isset($_POST['button']))
#{
	#echo downloadFile($_POST['button'], $mysqli);
#}
#
?>
<!--<form method="post">
        <input type="submit" name="button"
                value="Button1"/>
          
        <input type="submit" name="button"
                value="Button2"/>
 </form> -->
<!--<button id="my_button" value="A0001">Download File 1</button>
<br>
<button id="my_button" value="A0002">Download File 2</button>
<br> -->
<!-- <script type="text/javascript">
$(document).ready(function() {
		alert("Alert");

	$("button").click(function(e) {
		e.preventDefault();
		var id = $(this).attr('value');
		alert(id);
		$.ajax({
		//method: 'post',
		url: 'download.php',
		type: 'post',
		data: {
			'fileID': id,
		},
		success: function(data) {
			//document.getElementById("output").innerHTML = data; //ohhhhhhh
			alert("Yes");
		}
		});
	
	});
});
</script>-->
<div id = "output"> </div> 

</body>
</html>