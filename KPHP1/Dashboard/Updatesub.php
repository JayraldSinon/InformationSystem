<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "masterlist";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	$id=$_GET['id'];
	$Fname = mysqli_real_escape_string($conn, $_REQUEST['firstName']);	
	$Lname = mysqli_real_escape_string($conn, $_REQUEST['lastName']);
	$Email = mysqli_real_escape_string($conn, $_REQUEST['email']);	

	$sql = "UPDATE records SET Firstname=('$Fname') WHERE ID=($id)";
	$sql2 = "UPDATE records SET Lastname=('$Lname') WHERE ID=($id)";
	$sql5 = "UPDATE records SET Email=('$Email') WHERE ID=($id)";

	$res = false;

	if($Fname != "")
	{
		$res = true;
		mysqli_query($conn, $sql);
	}
	if($Lname != "")
	{
		$res = true;
		mysqli_query($conn, $sql2);
	}
	
	if($Email != "")
	{
		$res = true;
		mysqli_query($conn, $sql5);
	}
	
	if($res == true){
		echo '<script language="javascript">';
		echo 'alert("Information Successfully Edited")
		window.location.replace("dashboard.php");';
		echo '</script>';
	}
	 else{
    	echo '<script language="javascript">';
		echo 'alert("Failed to Edit the Information")
		window.location.replace("dashboard.php");';
		echo '</script>';
	}
?>