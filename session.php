<?php
   include('config.php');
   session_start();
   $user_check = $_SESSION['login_user'];
   $sql = "SELECT USERNAME FROM login where USERNAME = '$user_check'";
$result = $con->query($sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $login_session = $row['USERNAME'];
   if(!isset($_SESSION['login_user'])){
      header("location:index.html");
   }
?>
