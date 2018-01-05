<?php
include(session.php);
$array = json_decode($_GET["add"], true);
$list_id = $_GET["add1"];
$array2 = serialize($array);
include("config2.php");
$sql = "UPDATE words SET WORDS='$array2' WHERE id = '$list_id'";
if ($con->query($sql) === TRUE) {
    echo "De lijst is opgeslagen.";
} else {
    echo "Een error tijdens het updaten van de lijst: " . $con->error;
}
?>
