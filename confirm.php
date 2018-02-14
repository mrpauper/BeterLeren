<?php
include("config.php");
ini_set('display_errors', '1');
    $token = $_GET['token'];
        $query = "SELECT * FROM `login` WHERE `CONFIRM_TOKEN` = '{$token}'";
        if ($result = $con->query($query)) {
            $row = $result->fetch_assoc();
            if ($row["CONFIRMED"] == 0) {
                $query = "UPDATE `login` SET `CONFIRMED` = '1', `CONFIRM_TOKEN` = '' WHERE `USERNAME` = '{$row["USERNAME"]}'";
                if ($con->query($query)) {
                    header("Location: /");
                } else {
                    header("Location: /");
                }
            } else {
                header("Location: /");
            }
        } else {
            header("Location: /");
        }
?>
