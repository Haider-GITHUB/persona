<?php

session_start();

if(isset($_SESSION['username']) && isset($_SESSION['userEmail']))
{
    
    header('location:dashboard.php');
    die();
}

else
{
    //continue
}




include('database/db_include.php'); //including db

$username = "";
$password ="";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $query = "Select * from users where username='".$username."'and password='".$password."'";

    $result = mysqli_query($connect,$query);

    if($rows = mysqli_fetch_assoc($result))
    {
        $_SESSION['userEmail'] =$rows['email'];
        $_SESSION['username']=$rows['username'];
        header("Location: dashboard.php");
        die();
    }
    else
    {
        echo "<script>
            alert('Invalid Credentials');
            </script>";
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Mojja</title>
    
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    
    <div class="center">
    <!-- Checker Msg -->
    <?php if(isset($_SESSION['loginPlz'])) { ?>
        <h3 style="color:red">
            <?php 
                echo $_SESSION['loginPlz'];
                unset($_SESSION['loginPlz']);
            
            ?>
        </h3>
    <?php }?>
    <!-- Checker Msg -->
        <form action="" method="post">
        <h2>Login Form</h2>
            <div class="inpux">
                <input value="<?php echo $username ?>" type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="inpux">
                <input value="<?php echo $password ?>" type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>

        <input type="submit" value="Login"></input>
        <a href="registration.php">CLick here to register</a>
    </form>
  
    </div>
 <!---   <div class="jhakanaka"><a href="">Shomossha?</a></div>
    <style>placeholder {
    padding-top: 10px;
    }
 </style>
 --->
</body>
</html>
