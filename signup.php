<?php

$alert= false;
$alert1= false;
$error= false;
$server= 'localhost';
$password= "";
$user= 'root';
$db= 'task';

$con= new mysqli($server, $user, $password, $db);

if(!$con){
    echo "Unable to connect to a databse due to ". mysqli_connect_error();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username= $_POST['username'];
    $username= stripcslashes($username);
    $username= mysqli_real_escape_string($con, $username);
    
    $pass= $_POST['pass'];
    $pass= stripcslashes($pass);
    $pass= mysqli_real_escape_string($con, $pass);
    $hash= password_hash($pass, PASSWORD_DEFAULT);

    $sql= "INSERT INTO `users` (`username`, `pass`) VALUES ('$username', '$hash');";
    $res= mysqli_query($con, $sql);
    if($res==true){
        $alert= true;
    }
    else{
        $error= true;
    }
}




?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
      
      <?php

        if($alert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> Your Account has been created successfully. Click <a href="index.php">here</a> to go to the login page.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if($error){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> Unable to create account at this moment.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }


    ?>
  

  <div class="text">
        <h1>Secret Diary</h1>
        <p><b>Store your Thouhts Permanently And Securely</b></p>
        <p>Interseted? Signup Here.</p>
    </div>
    <br><br>

    <div class="form">
    <form action="signup.php" method="post">
        <div class="mb-3">
            <label for="Username" class="form-label">Username</label>
            <input type="text" class="form-control" aria-describedby="emailHelp" name="username" required>
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" name="pass" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <button class="btn btn-primary"><a href="index.php" style="color: white;"><b>Login</b></a></button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  </body>
</html>