
<?php
//error_reporting(E_ERROR | E_PARSE);
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '*YOUR PASS HERE*');
define('DB_NAME', 'cookie_bakery');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    echo "fail";
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>