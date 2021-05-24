<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "forpractice";

$connect = mysqli_connect($hostname,$username,$password,$dbname);
if(mysqli_connect_errno()){
    echo "Error:" .mysqli_connect_error();
}
?>