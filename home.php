<?php

session_start();
if (!$_SESSION['loggedin']){
    header("location: index.php");
    exit;
}

$alert= false;
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
    $title= $_POST['title'];
    $title= stripcslashes($title);
    $title= mysqli_real_escape_string($con, $title);
    
    $desc= $_POST['desc'];
    $desc= stripcslashes($desc);
    $desc= mysqli_real_escape_string($con, $desc);

    $sql= "INSERT INTO `diary` (`title`, `thought`) VALUES ('$title', '$desc');";
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php

        if($alert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> Your thoughts are safe. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if($error){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error</strong> Unable to save at this moment. Please try again later.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }


    ?>

    <div class="container">

        <div class="title">
            <h2>Secret Diary</h2>
        </div>

        <div class="logout">
            <button class="btn btn-primary item"><a style="color: white;" href="logout.php">Logout</a></button>
        </div>

    </div>



    <br><br>

    <div class="form2">
        <form action="home.php" method="post">
            <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="title" required>
            </div>
            <label for="Thought" class="form-label">Thought</label>
            <div class="mb-3">
                <textarea name="desc"
                    style="height: 200px; width: 80%; border: 2px solid black; border-radius: 5px;"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>

</body>

</html>