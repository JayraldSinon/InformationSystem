<?php
    $host = "localhost";
    $Username = "root";
    $Password = "";
    $db_name = "masterlist";
    $conn = new mysqli($host, $Username, $Password, $db_name);
    if($conn->connect_error){
        die("Connection failed" . $conn->connect_error);
    }
    echo "";
?>