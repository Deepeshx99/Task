<?php
  session_start();
  $showerror= false;
    $server= "localhost";
    $user= "root";
    $password= "";
    $database= "task";

    $con= mysqli_connect($server, $user, $password, $database );

    if(!$con){
        die("Failed to connect to server due to ". mysqli_connect_errno());
    }

    $username = $_POST['username'];
    $username= stripcslashes($username);
    $username= mysqli_real_escape_string($con, $username);
    
    
    $pass = $_POST['pass'];
    $pass= stripcslashes($pass);
    $pass= mysqli_real_escape_string($con, $pass);
    

    if ($stmt = $con->prepare('SELECT pass FROM users WHERE username = ?')) {
      $stmt->bind_param('s', $_POST['username']);
      $stmt->execute();
      // Store the result so we can check if the account exists in the database.
      $stmt->store_result();
    
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($pass);
        $stmt->fetch();
        
        
        if (password_verify($_POST['pass'], $pass)){
          // Verification success! User has logged-in!
          // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
          session_regenerate_ID();
          $_SESSION['loggedin'] = TRUE;
          $_SESSION['username'] = $username;
          header('Location: home.php');
        }
      } 
      
      
      $stmt->close();
    }
    else{

    }
  
?>



<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <?php

      if($showerror){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error</strng> Invalid Credentials.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }

    ?>



    <div class="text">
        <h1>Secret Diary</h1>
        <p><b>Store your Thouhts Permanently And Securely</b></p>
        <p>Login using your username and password</p>
    </div>
    <br>
    <br>

    <!-- Submission Form -->
    <div class="form">
    <form action="index.php" method="post">
        <div class="mb-3">
            <label for="Username" class="form-label">Username</label>
            <input type="username" class="form-control" id="Email" aria-describedby="emailHelp" name="username" required>
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" name="pass" class="form-control" id="password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button><br>
      </form>
      <button class="btn btn-primary"><a href="signup.php" style="color: white;"><b>Signup</b></a></button>
      </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>


</body>

</html>