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

	$Name = mysqli_real_escape_string($conn, $_REQUEST['Name']);

	$FirstName = mysqli_real_escape_string($conn, $_REQUEST['firstName']);
	$LastName = mysqli_real_escape_string($conn, $_REQUEST['lastName']);
	$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
	$Block = mysqli_real_escape_string($conn, $_REQUEST['Block']);
	$Lot = mysqli_real_escape_string($conn, $_REQUEST['Lot']);


	$sql = "INSERT INTO records VALUES ($id,'$FirstName', '$LastName', '$email', 1)";
	$sql1 = "INSERT INTO homeowners VALUES (NULL,'$FirstName', '$LastName')";	
	$sql2 = "INSERT INTO address VALUES (NULL, '$id','$Block','$Lot',1)";

	if($Name){
		$sql3 = "INSERT INTO address VALUES (NULL, '$id','$Block','$Lot',1)";
		if(mysqli_query($conn, $sql3))
		{  
			echo '<script language="javascript">';
			echo 'alert("Bought New Unit Successfully")
			window.location.replace("dashboard.php");';
			echo '</script>';
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		}
	}
	

	if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2))
	{  
		echo '<script language="javascript">';
		echo 'alert("Information Added Successfully")
		window.location.replace("dashboard.php");';
		echo '</script>';
	} else{
    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
?>