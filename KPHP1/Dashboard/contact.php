<?php
session_start();
include("connection.php");

if (isset($_POST['submit'])) {
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    $sql = "SELECT * FROM masterlist WHERE username = '$Username' AND password = '$Password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['username'] = $Username;
        header("Location: guest.php");
        exit();
    } else {
        echo '<script>alert("Login failed. Invalid username or password");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>KARLAVILLE PARKHOMES PHASE 1 MONITORING AND INFORMATION SYSTEM</title>
</head>
<body>
<div class="navbar">
        <a href="#" class="navbar-toggle" id="navbar-toggle"><i class="fas fa-bars"></i></a>
        <div class="navbar-links">
            <a href="index.php" class="navbar-link">Home</a>
            <a href="about.php" class="navbar-link about">About Us</a>
            <a href="contact.php" class="navbar-link">Contact Us</a>
            <div class="login-link">
                <a href="login.php" id="login-toggle" class="navbar-link">Login</a>
            </div>
        </div>
</div>
<div class="contact-section">
        <h2>Contact Us</h2>
        <div class="contact-info">
            <p>If you have any questions or inquiries, feel free to contact us:</p>
            <ul>
                <li>Email: karlavilleparkhomes@gmail.com</li>
                <li>Phone: (123) 456-7890</li>
                <li>Address: Brgy. Hugo Perez, Trece Martires, Cavite</li>
            </ul>
        </div>
    </div>
    <div class="background"></div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbarToggle = document.getElementById("navbar-toggle");
        const navbarLinks = document.querySelector(".navbar-links");

        navbarToggle.addEventListener("click", function() {
            navbarLinks.classList.toggle("show");
        });

        const loginToggle = document.getElementById("login-toggle");
        const loginContainer = document.querySelector(".login-container");

        loginToggle.addEventListener("click", function() {
            loginContainer.classList.toggle("show-login");
        });

        // Close navbar when a link is clicked
        const navbarLinksArray = Array.from(document.querySelectorAll(".navbar-link"));
        navbarLinksArray.forEach(link => {
            link.addEventListener("click", function() {
                navbarLinks.classList.remove("show");
            });
        });
    });
</script>
</body>
</html>

