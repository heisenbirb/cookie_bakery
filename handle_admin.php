<?php
// Your existing code to handle database connection and create a message
require_once "handle_database_conn.php";

$sql_query_if_admin_exists = "SELECT * FROM users WHERE username='admin';";
$result = mysqli_query($link,$sql_query_if_admin_exists);
if(mysqli_num_rows($result)==0){
    $sql_make_admin = "INSERT INTO users (username,password) VALUES ('admin','highentropy');";
    $result = mysqli_query($link,$sql_make_admin);
}

$potential_admin_messages = array(
    "I LOVE COOKIES!!!!!",
    "Cookies are GREAT! I wouldn't want anyone taking some from my private jar.",
    "Those cookies are labelled: NOT FOR PUBLIC.",
    "🍪🍪🍪🍪🍪🍪🍪🍪🍪🍪🍪🍪",
    "cookie."
);
$message = $potential_admin_messages[array_rand($potential_admin_messages)];

$message = mysqli_real_escape_string($link, $message);
$sql_create_new_message_by_admin = "INSERT INTO messages (author, message) VALUES ('admin', '$message');";
$result = mysqli_query($link, $sql_create_new_message_by_admin);

$forum_url = "http://localhost:8000/forum.php";

$js_script_path = "admin_actions.js";

$command = "node {$js_script_path} " . escapeshellarg($forum_url) . " > /dev/null 2>&1 &";

// Use exec() for background processes, which is generally more reliable than shell_exec()
exec($command);
?>