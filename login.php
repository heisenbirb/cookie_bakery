<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<h1> Login:</h1>
<a href="/" class="backlink"> back</a>
<form action="login.php" method="post">
username ~ %<input type="text" method="post" action="login.php" name="username"><br>
password ~ %<input type="password" method="post" action="login.php" name="password"><br>
<input type="submit" value="Log in">
</form>

<?php

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
require_once "handle_database_conn.php";
$username=$_POST["username"];
$password=$_POST["password"];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //yet another unsafe sql query. uhhhh dont do this?
    //this is like the definitive login bypass sql query
    $sql_query = "SELECT * FROM users WHERE username='$username' AND password='$password';";
    $result = mysqli_query($link,$sql_query);
    if(mysqli_num_rows($result)>0){
            //uhhh yeah to get the same thing to work as per the pecan ctf it needs to clear out admin messages if you log in with new user.
            $sql_clear_up_admin_messages = "DELETE FROM messages WHERE author='admin';";
            $res = mysqli_query($link,$sql_clear_up_admin_messages);
            //do stuff -- assign some kind of cookie idfk
            session_start();
            $_SESSION["loggedin"]= true;
            $_SESSION["id"]= $id;
            $_SESSION["username"]=$username;
            header("location:forum.php");
            }

}else{
    echo "hop off burp lil bro";
}

?>
</html>