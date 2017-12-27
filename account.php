<!DOCTYPE html>
<?php
include("session.php");
include("config.php");
$sql = "SELECT PASSWORD FROM `login` where USERNAME = '".$_SESSION["login_user"]."'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
    $password = $row["PASSWORD"];
}
?>
<html>
<head>
<title>WRTS-2 | nieuwe lijst</title>
<meta name="viewport" content="width=device-width">
</head>
<body>
<p>Gebruikersnaam: <?php echo $_SESSION["login_user"]?></p>
<p>Wachtwoord veranderen?</p>
<form action = "password.php" method = "post">
    <input type = "input" placeholder = "oude wachtwoord"/>
    <input type = "input" placeholder = "nieuwe wachtwoord"/>
    <input type = "input" placeholder = "herhaling nieuwe wachtwoord"/>
</form>
<a href = "home">terug naar home</a>
</body>
</html>