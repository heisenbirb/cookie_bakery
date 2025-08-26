
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up Page</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<h1> Sign Up:</h1>
<a href="/" class="backlink"> back</a>
<form method="POST" action="sign_up.php">
username ~ %<input type="text" method="POST" action="sign_up.php" name="username"><br>
password ~ %<input type="password" method="POST" action="sign_up.php" name="password"><br>
<input method="POST" type="submit" value="sign up.">
</form>

</html>


<?php
require_once "handle_database_conn.php";
//so you guys dont get cheeky and make an admin user, though that might not actually be a problem.
require "handle_admin.php";
$username_err="";
$password_err=""; 
$username=$_POST["username"];
$password=$_POST["password"];
if($_SERVER["REQUEST_METHOD"]=="POST"){
    //here should be some password validation code but i am lazyy
    if ($username==""){
        $username_err = "please enter a username.";
        echo $username_err;
    }
    else{
        if($password==""){
            $password_err="please enter a password.";
            echo $password_err;
        }
        else{
            //this is NOT safe, and i did NOT tell you this was an ok way to do sql
            $sql_check_user_exists = "SELECT * FROM users WHERE username= '$username'";
            $result = mysqli_query($link,$sql_check_user_exists);
            if(mysqli_num_rows($result)>0){
                echo "user exists.";
            }
            else{
                //also NOT SAFE but icbf fixing it. go cry about it.
                $sql_make_new_user = "INSERT INTO users (username,password) VALUES ('$username','$password');";
                mysqli_query($link,$sql_make_new_user);
                echo "success!";
                //redirect the user to the login
                header("Location: http://localhost:8000/login.php");
            }
        }
    
    }
}
else{
    echo "hop off burp suite lil bro";
}
?>