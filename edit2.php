<?php
include(session.php);
$array = json_decode($_GET["add"], true);
$listname = $_GET["add1"];
$array2 = serialize($array);
include("config2.php");
$sql = "UPDATE words SET WORDS='$array2' WHERE NAME='$listname'";
$result = $con->query($sql) or die("fout in de query");
$con->close();
echo "De lijst is bewerkt.";
?>