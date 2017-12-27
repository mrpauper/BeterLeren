<?php
include("session.php");
$listname = $_GET["add"];
include("config2.php");
$sql = "SELECT * FROM words WHERE NAME = '$listname'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
$lang1 = $row["LANG1"];
$lang2 = $row["LANG2"];
}
?>
<script>
    var array = [];
    </script>

<!DOCTYPE html>
<html>
<head>
<title>WRTS-2 | bewerk lijst</title>
</head>
<body>
<h1><?php echo $listname; ?></h1>
<form id = "form1">
<input type = "text" name = "nederlands" id = "nederlands" placeholder = "<?php echo $lang1; ?>"/>
<input type = "text" name = "engels" id = "engels" placeholder = "<?php echo $lang2; ?>"/>
<input  type = "submit" name="submit" value = "toevoegen" id="button" onclick = "check(this.form); return false"/>
</form>
<p id = "nl"></p><p id = "eng"></p>
<input type = "button" name = "opslaan" value = "lijst opslaan" id = "opslaan" onclick="save();"/>
<br><br>
<table style = "width: 50vw;" id = "table">
    <tbody id = "table-body">
    <tr>
        <th style = "color: blue"><?php echo $lang1; ?></th>
        <th style = "color: blue"><?php echo $lang2; ?></th>
    </tr>
<?php 
$sql = "SELECT WORDS from words where NAME = '$listname'";
$result = $con->query($sql);
$boolean = true;
while($row = $result->fetch_assoc()) {
        $array = unserialize($row['WORDS']);
        if ($array != null) {
        for ($i = 0; $i < sizeof($array); $i++) {
            echo "<tr>";
            echo "<th>".$array[$i]['NEDERLANDS']."</th>";
            echo "<th>".$array[$i]['ENGELS']."</th>";
            echo "</tr>";
        }
        echo "<script>array = ". json_encode($array) ."</script>";
        }
    }
?>
</tbody>
</table>
<script>
function check(form) {
var nederlands = form.nederlands.value;
var engels = form.engels.value;
array.push({NEDERLANDS: form.nederlands.value, ENGELS: form.engels.value});
document.getElementById("form1").reset();
document.getElementById("nederlands").focus();
document.getElementById("table-body").innerHTML += "<tr><th>" + nederlands + "</th><th>" + engels + "</th></tr>";
}

function save () {
var listname = <?php echo json_encode($listname) ?>;
var array2 = JSON.stringify(array);
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       alert("lijst is opgeslagen");
    }
};
xhttp.open("GET", "edit2.php?add=" + array2 + "&add1=" + listname, true);
xhttp.send();
}
</script>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<a href = "home">terug naar home</a>
</body>
</html>