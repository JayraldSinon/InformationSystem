<?php
$selectedBlock = $_GET['block'];
$selectedLot = $_GET['lot'];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "masterlist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the block and lot combination is occupied
$sql_check_occupancy = "SELECT COUNT(*) AS occupied FROM records WHERE Block = '$selectedBlock' AND Lot = '$selectedLot'";
$result_check_occupancy = $conn->query($sql_check_occupancy);
$row_check_occupancy = $result_check_occupancy->fetch_assoc();

$response = array('occupied' => ($row_check_occupancy['occupied'] > 0));
echo json_encode($response);

$conn->close();
?>
