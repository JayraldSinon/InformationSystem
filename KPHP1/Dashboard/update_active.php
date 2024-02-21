<?php
// update_active.php

if (isset($_GET['id']) && isset($_GET['status'])) {
    $userId = $_GET['id'];
    $newStatus = $_GET['status'];

    // Perform the database update
    $update_status_sql = "UPDATE records SET Active = $newStatus WHERE ID = $userId";
    $result = mysqli_query($conn, $update_status_sql);

    if ($result) {
        // Update successful
        $response = array('success' => true);
        echo json_encode($response);
    } else {
        // Update failed
        $response = array('success' => false);
        echo json_encode($response);
    }
} else {
    // Invalid parameters
    $response = array('success' => false);
    echo json_encode($response);
}
?>
