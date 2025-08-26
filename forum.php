<?php
require_once "handle_database_conn.php";
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //make a new message
    $message_content = urlencode($_POST["message"]);
    $username = $_SESSION["username"];
    $sql_make_new_message = "INSERT INTO messages (author,message) VALUES ('$username','$message_content');";
    mysqli_query($link,$sql_make_new_message);
    //query all the already present messages.
    /*$sql_query_messages = "SELECT * FROM messages WHERE author = '$username' OR author='admin';";
    $result =  mysqli_query($link,$sql_query_messages);
    if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $username = $row["author"];
    $message = $row["message"];
    echo "$username: $message<br>";*/
  //}
    //}
    require "handle_admin.php";
}
?>
<!DOCTYPE html>
<head>
    <title>Cookie Bakery Forum</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="forum_header">Cookie Bakery Forums: 🍪🍪🍪 </h1>
    <p class="message_2">An 'admin' will check every message for quality control.</p>
    <div class="messaging">
<?php
    $username = $_SESSION["username"];
    //$sql_query_messages = "SELECT * FROM messages WHERE author = '$username' OR author='admin';";
    $sql_query_messages = "SELECT * FROM messages";
    $result =  mysqli_query($link,$sql_query_messages);
    if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $username = $row["author"];
    $message = urldecode($row["message"]);
    echo "$username: $message<br>";
  }
}
?>
        <form method="post" action="forum.php">
            <input type="text" placeholder="type a message here" method="post" action="forum.php" name="message">
            <input type="submit" action="forum.php" method="post" value="send">
        </form>
    </div>

</body>

