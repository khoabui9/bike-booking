
<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
 // $username = mysqli_real_escape_string($username);
 // $password = mysqli_real_escape_string($password);
// Selecting Database
$db = mysqli_select_db($connection, "bike") or die("Could not select examples");
// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($connection, "select * from user where password='$password' AND email='$username'");
$rows = mysqli_num_rows($query);

if ($rows == 1) {
$_SESSION['login_user']=$username;// Initializing Session
//header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($connection); // Closing Connection
}
// Send the email to the new user

$to = $email;
$subject = "Register Completed!";
$txt = "Hi, " . $email. " \nWelcome to our bike renting system! Now you can login with your email and password!";
$headers = "From: webmaster@example.com" . "\r\n";

mail($to,$subject,$txt,$headers);

include 'session.php';
}
?>