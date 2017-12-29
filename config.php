<?php
$con = new mysqli("localhost", "root", "Vlaflip43", "login");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>
