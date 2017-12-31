<?php
include(config.php);

$password = password_hash("bert", PASSWORD_DEFAULT);
$email = "bert@gmail.com";
$username = "bert";
$stmt = $con->prepare("INSERT INTO login (EMAIL, USERNAME, PASSWORD) VALUES (?, ?, ?)") or die("misstake in query");
$stmt->bind_param('sss', $email, $username, $password);
$stmt->execute();
?>
