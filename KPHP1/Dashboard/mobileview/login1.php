<?php
session_start();
include("connection.php");

$name= "";
$name2="";

if (isset($_POST['submit'])) {
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    $sql = "SELECT * FROM homeowners WHERE username = '$Username' && password = '$Password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $name = $_POST['username'];
    $name2 = $_POST['password'];

    if ($count == 1) {
        $_SESSION['username'] = $Username;
        header("Location: AFTERLOGIN.php?id=$name&&id2=$name2");
        exit();
    } 
    else {
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
    <style>
    /* Style the password input container */
    .password-input-container {
        position: relative;
        width:80%;
        margin-right: 20px;
    }

    /* Position the Font Awesome icon inside the placeholder */
    .password-input-container input::placeholder {
        padding-left: 10px; /* Adjust as needed */
    }

    /* Position the toggle icon */
    .toggle-password {
        position: absolute;
        right: 10px; /* Adjust as needed */
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    </style>
</head>
<body>
<div class="navbar">
        <a href="#" class="navbar-toggle" id="navbar-toggle"><i class="fas fa-bars"></i></a>
        <div class="navbar-links">
            <a href="index3.php" class="navbar-link">Home</a>
            <a href="about.php" class="navbar-link">About</a>
            <a href="contact1.php" class="navbar-link">Contact Us</a>
            <div class="login-link">
                <a href="#" id="login-toggle" class="navbar-link">Login</a>
            </div>
        </div>
</div>
    <div class="login-container show-login">
    <div class="logo-container positioned-logo">
        <img src="images/logo12.png" alt="Logo">
    </div>
        <h4 style="text-align: center;">KARLAVILLE PARKHOMES PHASE 1 <br> TRECE MARTIRES CAVITE</h4>
            <!-- Your form fields -->
            <form class="login-form"   method="post">
                <br>
                <div class="form-group">
                    <label for="username" class="invisible-label">Username:</label>
                    <span class="input-group-text"><i class="fas fa-user with-border"></i></span>
                    <div class="password-input-container">
                        <input placeholder="Enter username" type="text" id="username" name="username" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="invisible-label">Password:</label>
                    <span class="input-group-text"><i class="fas fa-key with-border"></i></span>
                    <div class="password-input-container">
                        <input placeholder="Enter password" type="password" id="password" name="password" required>
                        <i id="togglePassword" class="fas fa-eye-slash toggle-password"  onclick="togglePasswordVisibility()"></i>
                    </div>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label class="remember-label" for="remember-me">Remember Me</label>
                </div>
               
                <div class="button-container">
                  <div class="form-group">
                    <button class="button" type="submit" name="submit">Login</button>
                  </div>
                </div>
        </form>
        
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
    //password show
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const togglePasswordIcon = document.getElementById("togglePassword");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePasswordIcon.classList.remove("fa-eye-slash");
            togglePasswordIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            togglePasswordIcon.classList.remove("fa-eye");
            togglePasswordIcon.classList.add("fa-eye-slash");
        }
    }
</script>

</body>
</html>
