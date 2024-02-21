<?php
    session_start();
    include("connection.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $username = $_POST['username'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      if(!empty($email) && !empty($password) && !is_numeric($email)){

          $sql = "insert into login (username,name,email,password) values ('$username' , '$name' , '$email', '$password')";
          mysqli_query($conn, $sql);
          echo "<script type='text/javascript'>
          window.location.href = 'index.php';
          alert('Sucessfully Registered.')
      </script>";

      }
      else{
        echo '<script>
            window.location.href = "index.php";
            alert("login failed. Invalid username or password")
        </script>';
    }

    
  }
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>KARLAVILLE PARKHOMES PHASE 1 MONITORING AND INFORMATION SYSTEM</title>
</head>
<style>

</style>
<body>
  <div class="login-container">
    <h1>KARLAVILLE PARKHOMES PHASE 1<br> MONITORING AND INFORMATION SYSTEM</h1>
    <h1 style="font-family: 'Courier New', monospace;">ADMIN SIGNUP PAGE</h1>
    <form class="login-form" style="display: flex; justify-content: center; text-align: center;" action="signup.php" method="post">
    <div class="form-group">
      <label class="invisible-label" for="username">Username:</label>
      <input placeholder="Enter your username" type="username" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label class="invisible-label" for="name">Name:</label>
      <input placeholder="Enter your name" type="text" id="name" name="name" required>
    </div>
    <br>
    <div class="form-group">
      <label class="invisible-label" for="email">Email:</label>
      <input placeholder="Enter your email" type="email" id="email" name="email" required>
    </div>
    <br>
    <div class="form-group">
      <label class="invisible-label" for="password">Password:</label>
      <input placeholder="Enter your password" type="password" id="password" name="password" required>
    </div>
    <br>
    <div class="form-group">
      <button type="submit" name=""submit>Sign Up</button>
    </div>
  </form>
  <p style="text-align: center;">Already have an account? <a href="index.php">Login here</a></p>
  </div>
</body>

</html>
