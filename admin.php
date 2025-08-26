<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
else if($_SESSION["username"]!='admin'){
    header("location: login.php");
    exit;
}
else{
    echo "<h1>Good job stealing the cookie! Here is a flag as promised: n0tpecan{valid4te_str1ng_input}</h1>";
}
?>
