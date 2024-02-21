	<?php
	$id=$_GET['id'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "masterlist";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
		
	$sql = "Delete from records where ID=('$id')";	

	if(mysqli_query($conn, $sql)){
  		echo '<script language="javascript">';
		echo 'window.location.replace("index.php");';
		echo '</script>';
	} else{
    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
 
?>