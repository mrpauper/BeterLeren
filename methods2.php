<?php
include("session.php");
$listname = $_GET['add'];
include("config2.php");

$listarray = json_decode($listname);
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
  margin-left: 20%;' action = "/main" method = "GET">
    <?php 
    $count = 1;
        foreach ($listarray as $list) {
            echo "<h2>".$list."</h2>";
            $sql = "SELECT * FROM words WHERE NAME = '$list'";
            $result = $con->query($sql);
            while($row = $result->fetch_assoc()){
                $lang1 = $row['LANG1'];
                $lang2 = $row['LANG2'];
            }
            echo "<input type = 'radio' value = 'RIGHT' name = 'order";
            echo $count;
            echo "' checked>" .$lang1. " naar ".$lang2."<br><input type = 'radio' value = 'LEFT' name = 'order";
            echo $count;
            echo "'>".$lang2." naar ".$lang1. "<br><br>";
            $count++;
            
        }
    ?>
<input type = 'radio' value = 'TOETSEN' name = 'method' checked>toets
<br>
<input type = 'radio' value = 'GEDACHTEN' name = 'method'>gedachten
<br>
<input type = 'submit' value = 'submit'>
<input type = 'input' value = '<?php echo $listname; ?>' style = 'display: none' name = 'add'/>
</form>
<a href = "home">terug naar home</a>
</body>
</html>