<?php
$cost = 11;
echo password_hash("kanonskogel", PASSWORD_DEFAULT, ["cost"=> $cost]);


?>
