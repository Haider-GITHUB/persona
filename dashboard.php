<?php

session_start();

include 'session_validation.php';

include('database/db_include.php'); //including db
$note_title = $note_body = "";
$successMsg = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $note_title = htmlspecialchars($_POST['note_title']);
    $note_body = htmlspecialchars($_POST['note_body']);
   
    $successMsg = "Added!";
    $created_at = date('Y-m-d');
    $username = $_SESSION['username'];
    $insertQuery = "INSERT INTO notes (title,username, body, created_at) VALUES ('$note_title','$username', '$note_body', '$created_at')"; 
    mysqli_query($connect, $insertQuery);
    $note_title = $note_body = "";


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<header>
        <h1>Dashboard</h1>
        <h2 align="center">Hello User,<?=$_SESSION['username']; ?> <a style="color:red;" href="logout.php"><i class="fas fa-sign-out-alt"></i> </a>  </h2>
        <nav>
            <a href="notes.php">Notes</a>
            <a href="schedules.php">Schedules</a>
            <a href="work.php">Work</a>
            <a href="finance.php">Finance</a>
        </nav>
    </header>
    <!--- Notes Section --->
    <div class="container">
        <form action="" method="post">
            <label>Title:</label><br>
            <input type="text" value="<?=$note_title?>" name="note_title" placeholder="Title"> <br> 
            <label>Note:</label><br>
            <textarea name="note_body" placeholder="..." rows="10" cols="50"></textarea>
            <br>
            <input type="submit" value="Save">       
            <p class=""><?=$successMsg?></p>

        </form>
    </div>
</body>
</html>