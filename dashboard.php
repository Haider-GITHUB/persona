<?php
 include('database/db_include.php'); //including db
$note_title = $note_body = "";
$successMsg = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $note_title = htmlspecialchars($_POST['note_title']);
    $note_body = htmlspecialchars($_POST['note_body']);
   
    $successMsg = "Added!";
    $created_at = date('Y-m-d');

    $insertQuery = "INSERT INTO notes (title, body, created_at) VALUES ('$note_title', '$note_body', '$created_at')"; 
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
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<header>
        <h1>Dashboard</h1>
        <nav>
            <a href="/notes.php">Notes</a>
            <a href="/schedules.php">Schedules</a>
            <a href="/work.php">Work</a>
            <a href="/finance.php">Finance</a>
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