<?php
include("session.php");
$listname = $_GET['add'];
include("config2.php");
$sql = "DELETE FROM words WHERE NAME = '$listname'";
$result = $con->query($sql);
if ($result) {
header("Location: home");
}
else {
$error = "Kan woordenlijst niet verwijderen.";
}
$con->close();
?>