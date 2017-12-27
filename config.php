<?php
$con = new mysqli("localhost", "id356344_12345", "kanonskogel", "id356344_login");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>