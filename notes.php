<?php
session_start();
include 'session_validation.php';
include('database/db_include.php'); //including db


$username = $_SESSION['username'];

$query = "Select * from notes where username='$username';";
$result = mysqli_query($connect,$query);




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/notes.css">
    <title>User Notes</title>
</head>
<body>
    <h1 style="text-transform:uppercase;" align="center">User Notes of <?=$_SESSION['username']?> <a style="color:red;" href="logout.php"><i class="fas fa-sign-out-alt"></i> </a></h1>
    
    <?php if(mysqli_num_rows($result)>0){ ?>

    <table class="comicGreen">
        <thead>
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
        </thead>
        <tbody>
        
        <?php 
            while($rows=mysqli_fetch_assoc($result)){
        ?>

        <tr>
                <td><?=$rows['title']?></td>
                <td><?=$rows['body']?></td>
                <td><?=$rows['created_at']?></td>
        </tr>


        <?php }?>


        </tbody>
    </table>

    <?php }
    
    else {
    
    ?>

        <h2>No Notes Inserted Yet!</h2>

    <?php }?>

</body>
</html>

