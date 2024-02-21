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
	$Block = mysqli_real_escape_string($conn, $_REQUEST['Block']);
	$Lot = mysqli_real_escape_string($conn, $_REQUEST['Lot']);	

	$sql = "UPDATE records SET Firstname=('$Fname') WHERE ID=($id)";
	$sql2 = "UPDATE records SET Lastname=('$Lname') WHERE ID=($id)";
	$sql3 = "UPDATE records SET Block=('$Block') WHERE ID=($id)";
	$sql4 = "UPDATE records SET Lot=('$Lot') WHERE ID=($id)";

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
	if($Block != "")
	{
		$res = true;
		mysqli_query($conn, $sql3);
	}
	if($Lot != "")
	{
		$res = true;
		mysqli_query($conn, $sql4);
	}
	
	if($res == true){
		echo '<script language="javascript">';
		echo 'alert("Information Successfully Edited")
		window.location.replace("index.php");';
		echo '</script>';
	}
	 else{
    	echo '<script language="javascript">';
		echo 'alert("Failed to Edit the Information")
		window.location.replace("index.php");';
		echo '</script>';
	}
?>