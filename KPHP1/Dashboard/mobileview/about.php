<?php
session_start();
include("connection.php");

if (isset($_POST['submit'])) {
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    $sql = "SELECT * FROM homeowners WHERE username = '$Username' AND password = '$Password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['username'] = $Username;
        header("Location: login1.php");
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
    <link rel="stylesheet" type="text/css" href="style1.css">
    <title>KARLAVILLE PARKHOMES PHASE 1 MONITORING AND INFORMATION SYSTEM</title>
</head>
<body>
<div class="navbar">
        <a href="#" class="navbar-toggle" id="navbar-toggle"><i class="fas fa-bars"></i></a>
        <div class="navbar-links">
            <a href="index3.php" class="navbar-link">Home</a>
            <a href="about.php" class="navbar-link about">About Us</a>
            <a href="contact1.php" class="navbar-link">Contact Us</a>
            <div class="login-link">
                <a href="login1.php" id="login-toggle" class="navbar-link">Login</a>
            </div>
        </div>
</div>
    <div id="about" class="about-section positioned-about">
        <h2>About Us</h2>
        <p>Welcome to Karlaville Parkhomes Phase 1! We are proud to introduce the dedicated team of officers who help manage and maintain our vibrant community.</p>
        <div class="officer-info" id="officer-info">
        <h3>Meet Our Officers</h3>
        <ul class="officer-list">
            <li><strong>Cristina G. Bello</strong> - President</li>
            <li><strong>Nixon F. Macanas</strong> - Vice President</li>
            <li><strong>Mylene D. Formaran</strong> - Secretary</li>
            <li><strong>Teodora C. Dumagan</strong> - Treasurer</li>
            <li><strong>Ernie S. Onofre</strong> - Auditor</li>
            <li><strong>Teodoro S. Vista</strong> - Board Of Directors</li>
            <li><strong>Jerry F. Mindanao</strong> - Board Of Directors</li>
            <li><strong>Vivian C. Dala</strong> - Board Of Directors</li>
            <li><strong>Santiago P. Nartates Jr.</strong> - Board Of Directors</li>
            <li><strong>Marvin G. Batino</strong> - Board Of Directors</li>
            <li><strong>Regie E. Egualan</strong> - Board Of Directors</li>
            <li><strong>Susan S. Aguilar</strong> - Board Of Directors</li>
            <li><strong>Benjie S. Garcia</strong> - Board Of Directors</li>
            <li><strong>Amador P. Esquivel</strong> - Board Of Directors</li>
            <li><strong>Daisy J. Raymundo</strong> - Board Of Directors</li>
            
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

