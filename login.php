<?php
session_start();
include("config.php");
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $con->prepare('SELECT * FROM login WHERE USERNAME = ?');
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $email = $row["EMAIL"];
        $hashed_password = $row["PASSWORD"];
    }
if(password_verify($password, $hashed_password)) {
    $_SESSION['email_user'] = $email;
    $_SESSION['login_user'] = $username;
    header("Location: home.php");
} 
else {
    die("wrong password or username");
}
}
else {
die("wrong password or username");
}
mysql_close($con);
?>
