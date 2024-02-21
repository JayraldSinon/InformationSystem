<?php

	date_default_timezone_set("Asia/Manila");


	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "masterlist";;

	$currDate = date("Y-m-d");

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	
	$Address = $_GET['id'];
	$Month = mysqli_real_escape_string($conn, $_REQUEST['months']);
	$Year = mysqli_real_escape_string($conn, $_REQUEST['Year']);
	$Amount = mysqli_real_escape_string($conn, $_REQUEST['Amount']);
	$Receipt = mysqli_real_escape_string($conn, $_REQUEST['Receipt']);

	$sql = "UPDATE payment
            SET Amount = '$Amount', Receipt = '$Receipt', CurrDate = '$currDate', stat = 1
            WHERE Month = '$Month' AND Year = '$Year' AND Address = '$Address'";	
	if(mysqli_query($conn, $sql))
	{
  		echo '<script language="javascript">';
		echo 'alert("Information Added Successfully")
		window.location.replace("dashboard.php");';
		echo '</script>';
	} else{
    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
?>