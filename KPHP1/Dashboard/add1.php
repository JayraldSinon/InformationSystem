<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "masterlist";;

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	$Name = mysqli_real_escape_string($conn, $_REQUEST['Name']);
	$Block = mysqli_real_escape_string($conn, $_REQUEST['Block1']);
	$Lot = mysqli_real_escape_string($conn, $_REQUEST['Lot1']);

    $sql3 = "INSERT INTO address VALUES (NULL, '$Name','$Block','$Lot',1)";
    if(mysqli_query($conn, $sql3))
    {  
        echo '<script language="javascript">';
        echo 'alert("Bought New Unit Successfully")
        window.location.replace("dashboard.php");';
        echo '</script>';
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
	
?>