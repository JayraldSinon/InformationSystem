<?php
	$id=$_GET['id'];

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "masterlist";;

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	if($id == ''){
		$id=1;
	}else {
		$id=$id+1;
	}

	$FirstName = mysqli_real_escape_string($conn, $_REQUEST['firstName']);
	$LastName = mysqli_real_escape_string($conn, $_REQUEST['lastName']);
	$Block = mysqli_real_escape_string($conn, $_REQUEST['Block']);
	$Lot = mysqli_real_escape_string($conn, $_REQUEST['Lot']);

	$sql = "INSERT INTO records VALUES ($id,'$FirstName', '$LastName', '$Block', '$Lot', NULL, NULL, NULL)";	
	if(mysqli_query($conn, $sql))
	{
  		echo '<script language="javascript">';
		echo 'alert("Information Added Successfully")
		window.location.replace("index.php");';
		echo '</script>';
	} else{
    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
?>