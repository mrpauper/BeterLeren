<?php
include("session.php");
$list_id = $_GET['add'];
include("config2.php");
$sql = "DELETE FROM words WHERE id = '$list_id'";
$result = $con->query($sql);
if ($result) {
header("Location: home.php");
}
else {
$error = "Kan woordenlijst niet verwijderen.";
}
$con->close();
?>
