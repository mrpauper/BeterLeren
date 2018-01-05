<?php
include("session.php");
$list_id = $_GET['add'];
include("config2.php");
$sql = "SELECT * FROM words WHERE id = '$list_id'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()){
    $lang1 = $row['LANG1'];
    $lang2 = $row['LANG2'];
    $listname = $row['NAME'];
}
$con->close();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width">
  <title>WRTS-2 | methoden</title>
</head>
<body>
<h1 align = 'center'>methoden</h1>
<form style = 'font-size: 140%;
  margin-left: 20%;' action = "main.php" method = "POST">
<input type = 'radio' value = 'RIGHT' name = 'order' checked>
<?php  echo $lang1 . " naar ". $lang2; ?>
<br>
<input type = 'radio' value = 'LEFT' name = 'order'>
<?php  echo $lang2 . " naar ". $lang1; ?>
<br><br>
<input type = 'radio' value = 'TOETSEN' name = 'method' checked>toets
<br>
<input type = 'radio' value = 'GEDACHTEN' name = 'method'>gedachten
<br>
<input type = 'submit' value = 'submit'>
<input type = 'input' value = '<?php echo $listname; ?>' style = 'display: none' name = 'add'/>
</form>
<a href = "home.php">terug naar home</a>
</body>
</html>
