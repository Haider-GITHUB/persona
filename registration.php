<?php
    include('database/db_include.php'); //including db
    $error_name = "";
    $error_pass = "";
    $error_email = "";
    $successMsg = "";
    $username = $email = $password = $cfm_password = "";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $error_name = "";
        $error_pass = "";
        $error_email = "";
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $cfm_password = htmlspecialchars($_POST['cfm_password']);
        $is_valid = true;
        if($username == ''){
            $error_name = "Username des nai ken";
            $is_valid = false;
        }
       
        if($email == ''){
            $error_email = "Email des nai ken";
            $is_valid = false;
        }
        
        if($password == '' || $cfm_password == ''){
            $error_pass = "pass koi";
            $is_valid = false;
        }
        
        if($is_valid){
            if(strlen($username) < 4){
                $error_name = 'Username must be at least 4 char';
                $is_valid = false;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_email = "Invalid email format";
                $is_valid = false;
            }
            if(strlen($password) < 6){
                $error_pass = "boca micro pass";
                $is_valid = false;
            }
            elseif($password != $cfm_password){
                $error_pass = "mileni ki dili boca";
                $is_valid = false;
            }
            if($is_valid){
                $query1 = "select * from users where email = '$email'";
                $query2 =  "select * from users where username = '$username'";
                $result1 = mysqli_query($connect,$query1);
                $result2 = mysqli_query($connect,$query2);
                if(mysqli_num_rows($result1) >0){
                    $error_email = "Ar email nai?";
                    $is_valid = false;
                }
                if(mysqli_num_rows($result2) >0){
                    $error_name = "notun name de?";
                    $is_valid = false;
                }
                if($is_valid){
                    $successMsg = "WELL DONE";
                    $created_at = date('Y-m-d');
                    $insertQuery = "INSERT INTO users (username, email, password, created_at) VALUES ('$username', '$email', '$password', '$created_at')"; 
                    mysqli_query($connect, $insertQuery);
                    $username = $email = $password = $cfm_password = "";
                    header("Location: login.php");

                }


            }

        }
    }
 ?>

<!DOCTYPE html>
<html>
<head>

<title>Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="regis.css" rel="stylesheet" type="text/css" media="all" />
<!-- //Custom Theme files -->
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
<!-- //web font -->
<script>
    function check(){
        if(confirm('Shobkichu diyechish thikthak?')){
            return true;
        }
        else{
            return false;
        }
    }
</script>
</head>
<body>
	<!-- main -->
	<div class="main-w3layouts wrapper">
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form onsubmit="return check()" action="#" method="post">
					<input class="text" type="text" name="username" value="<?php echo $username ?>" placeholder="Username">
                    <p class="errormsg"><?=$error_name?></p>
					<input class="text email" type="text" name="email" value="<?=$email?>" placeholder="Email" >
                    <p class="errormsg"><?=$error_email?></p>
					<input class="text" type="password" name="password" placeholder="Password" >
					<input class="text w3lpass" type="password" name="cfm_password" placeholder="Confirm Password">
                    <p class="errormsg"><?=$error_pass?></p>
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="SIGN UP">
                    <p class="successMsg"><?=$successMsg?></p>
				</form>
				<p>Don't have an Account? <a href="index.php"> Login Now!</a></p>
			</div>
		</div>
		
	</div>
	<!-- //main -->
</body>
</html>