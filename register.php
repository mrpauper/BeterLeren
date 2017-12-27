<?php
include(config.php);
$options = [
    'cost'=> 11
    ];
$password = $_POST["password"];
$password = password_hash($password, PASSWORD_DEFAULT, $options);
$email = $_POST["email"];
$username = $_POST["username"];
$stmt = $con->prepare("INSERT INTO login (USERNAME, EMAIL, PASSWORD) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $username, $email, $password);
$stmt->execute();
?>