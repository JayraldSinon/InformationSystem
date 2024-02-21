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

$id = $_GET['id'];
if($_GET['id']){
    $sql_info = "SELECT CONCAT(Firstname, ' ', Lastname, ' | ', Block, '-', Lot) AS Info FROM `records` WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql_info);
    $row = mysqli_fetch_assoc($result);
    $info = $row['Info'];
    echo $info;
}else{
	echo "Name | Address";
}


?>