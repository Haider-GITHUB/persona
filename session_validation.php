<?php
//Make sure the parent page have started session

if(isset($_SESSION['username']) && isset($_SESSION['userEmail']))
{
    //Continue
}

else
{
    $_SESSION['loginPlz'] = "You Must Login First!";
    header('location:login.php');
    die();
}




?>