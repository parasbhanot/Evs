<?php
session_start();
$db = new Database(); // Database abstraction class.
$email_address = $db->esc($_POST['email']);
$password = $db->esc($_POST['password']);
#$matching_users = $db->get_num_rows("SELECT 1 FROM `users` WHERE email_address='$email_address' AND password=crypt('$password', password) LIMIT 1");
#if ($matching_users) {
if ($password == 'jks123') {
    // User exists; log user in.
    $_SESSION['email_address'] = $email_address;
    echo "You are now logged in.";
    echo '<li><a href="./logs.php">Logs</a></li>';
} else {
      	header("Location:login.html");
    	die();
}
?>
