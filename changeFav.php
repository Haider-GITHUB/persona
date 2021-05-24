<?php

include('database/db_include.php'); //including db

$noteId = $_GET['noteId'];

$state;

$getQuery = "Select favorite from notes where id = '$noteId'";

$result = mysqli_query($connect,$getQuery);

if($row=mysqli_fetch_assoc($result))
{
    $state= $row['favorite'];
}

if($state)
{
    $query = "Update notes set favorite= 0 where id ='$noteId'";
}
else
{
    $query = "Update notes set favorite= 1 where id ='$noteId'";
}

mysqli_query($connect,$query);

