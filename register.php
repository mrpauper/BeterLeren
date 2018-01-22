<?php
include("config.php");
$stmt = $con->prepare("INSERT INTO login (USERNAME, PASSWORD, EMAIL) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $email);
$password = $_POST["password"];
$password = password_hash($password, PASSWORD_DEFAULT, ["cost"=>11]);
$email = $_POST["email"];
$username = $_POST["username"];
$stmt->execute();
echo "Het registreren is gelukt. klik <a href = '/'>hier</a> om in te loggen.";
?>
