<?php
// Connect to the database (similar to your existing code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "masterlist";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID and new status from the AJAX request
$userId = $_POST['userId'];
$newStatus = ($_POST['newStatus'] === 'Active') ? 0 : 1; // Toggle the status

// Update the status in the database
$updateStatusSQL = "UPDATE records SET Status = $newStatus WHERE ID = $userId";
if ($conn->query($updateStatusSQL) === TRUE) {
    // Successful update, you can send a response if needed
    echo 'Status updated successfully';
} else {
    // Handle errors if the update fails
    echo 'Error updating status: ' . $conn->error;
}

// Close the database connection
$conn->close();
?>
