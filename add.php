<?php
include("session.php");
?>
<html>
<head>
<title>WRTS-2 | nieuwe lijst</title>
<meta name="viewport" content="width=device-width">
</head>
<body>
<style>
#lang1, #lang2 {
width: 175px;
}
</style>
<form method = "post">
<input type = 'text' id = 'input' name = 'input' placeholder = 'naam van woordenlijst'/>
<select id = "lang1" name = "lang1">
<option value = "Nederlands">Nederlands</option>
<option value = "Duits">Duits</option>
<option value = "Engels">Engels</option>
<option value = "Grieks">Grieks</option>
<option value = "Latijn">Latijn</option>
<option value = "Frans">Frans</option>
<option value = "Spaans">Spaans</option>
</select>
<select id = "lang2" name = "lang2">
<option value = "Nederlands">Nederlands</option>
<option value = "Duits">Duits</option>
<option value = "Engels">Engels</option>
<option value = "Grieks">Grieks</option>
<option value = "Latijn">Latijn</option>
<option value = "Frans">Frans</option>
<option value = "Spaans">Spaans</option>
</select>
<br>
<input type = 'submit' name = 'submit' id = 'submit' value = 'maak lijst'/>
  </form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
include("config2.php");
$naam = $_POST['input'];
$lang1 = $_POST['lang1'];
$lang2 = $_POST['lang2'];

$sql1 = "SELECT NAME FROM words WHERE NAME = '$naam'";
$result1 = $con->query($sql1); 
if ($result1->num_rows > 0) {
$error = "De naam van je lijst bestaat al.";
}
else {
$sql = "INSERT INTO words (USER, NAME, LANG1, LANG2, WORDS) VALUES ('".$_SESSION['login_user']."', '$naam', '$lang1', '$lang2', 0)";
$result = $con->query($sql);
if ($result) {
$error = "opgeslagen";
}
else {
$error = "Kan woordenlijst niet opslaan";
}
}
$con->close();
}
?>
<p><?php echo $error?></p>
<br>
<a href = "home.php">terug naar home</a>
</body>
</html>
