<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["officer_name"])) {
    $newOfficerName = $_POST["officer_name"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "masterlist";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $updateQuery = "UPDATE officers SET name = ? WHERE id = ?";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newOfficerName, $officerId); 

    if ($stmt->execute()) {
        echo '<script language="javascript">';
        echo 'alert("Information Successfully Edited")';
       
        echo '</script>';
    } else {
        echo "Error updating officer information: " . $conn->error;
    }
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
