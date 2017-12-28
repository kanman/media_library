<?php
$name = $_POST["name"];
$email = $_POST["email"];
$details = $_POST["details"];
$email_body = "";
$email_body .= "Name: " . $name . "\n"; 
$email_body .= "Email: " . $email . "\n"; 
$email_body .= "Details: " . $details . "\n";
//To Do: Send Email
header("location: thanks.php");






