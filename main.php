<?php
include("session.php");
$listname = $_GET['add'];
$method = $_GET['method'];
include("config2.php");

$listarray = json_decode($_GET["add"]);
if ($listarray !== null) {
$nederlands = array();
$engels = array();
$nederlands2 = array();
$engels2 = array();
$count = 1;


foreach ($listarray as $list) {
$sql = "SELECT WORDS FROM words WHERE NAME = '$list'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
    $array = unserialize($row["WORDS"]);
}
$betweenvar = "order" . $count . "";
$count++;
$order2 = $_GET[$betweenvar];
foreach ($array as $key => $value) {
    if ($order2 == "RIGHT") {
    $nederlands2[]['NEDERLANDS'] = $array[$key]['NEDERLANDS'];
    $engels2[]['ENGELS'] = $array[$key]['ENGELS'];
    } else {
    $nederlands2[]['NEDERLANDS'] = $array[$key]['ENGELS'];
    $engels2[]['ENGELS'] = $array[$key]['NEDERLANDS']; 
    }
}
$nederlands = array_merge_recursive($nederlands, $nederlands2);
$engels = array_merge_recursive($engels, $engels2);
$nederlands2 = array();
$engels2 = array();
}
$order = "RIGHT";
}



else {
$order = $_GET['order'];
$nederlands = array();
$engels = array();
$sql = "SELECT WORDS FROM words WHERE NAME = '$listname'"; 
$result = $con->query($sql); 
while($row = $result->fetch_assoc()){
$array = unserialize($row['WORDS']);
}
foreach ($array as $key => $value) {
    if ($order == "RIGHT") {
        $nederlands[]['NEDERLANDS'] = $array[$key]['NEDERLANDS'];
        $engels[]['ENGELS'] = $array[$key]['ENGELS'];
    } else {
        $nederlands[]['NEDERLANDS'] = $array[$key]['ENGELS'];
        $engels[]['ENGELS'] = $array[$key]['NEDERLANDS'];
    }
}
}
$count = count($nederlands, COUNT_RECURSIVE) / 2;
if (count($nederlands) == 0) {
    echo "<script>alert('Er zijn geen woorden in deze woordenlijst(en)'); window.location.href = 'home'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
<link rel="stylesheet" type="text/css" href="main.css">
  <title>WRTS-2</title>
</head>
<body onload = "start()">
<div class = 'oefening'>
  <h1 align = 'center'><?php $listarray = json_decode($_GET["add"]); if ($listarray !== null) { foreach($listarray as $value){echo $value; echo "  ";}} else { echo $listname; }?></h1>

    <h2 align = 'center' id="woord"></h2>

  <form id = 'form'>
<div class = 'input'>
  <input id='input' name='input' placeholder='vertaling' type='text'
autocapitalize='none' autocomplete='off'>
</div>
<br>
  <input type='submit' onclick='check(this.form);return false' value='confirm' id = 'button2'>
<input type='reset' value='wis' id = 'wis'>

    </form>

      <h2 align = 'center' id="woord2"></h2>
<p>voortgang: </p>
  <ul>
    <li id = 'goed'></li>
    <li id = 'fout'></li>
  </ul>  
<p>resterend: </p>
  <p id = 'resterend'></p>
<h2 align = 'center' id = "cijfer"></h2>
</div>
<input type="button" onclick="myFunction()" value="begin opnieuw">
<br>
<a href="home">terug naar home</a>
<script>
function myFunction(){
location.reload();
}
</script>
<script>
var mistakes = [];
var nederlands = <?php echo json_encode( $nederlands) ?>;
var engels = <?php echo json_encode( $engels) ?>;
var clicks = 0; 
var fouten = 0;
var goeden = 0;
var order = "<?php echo $order; ?>";
var method = "<?php echo $method; ?>";
  
//Normal method 
  if (method == "TOETSEN") {
      function start() {
          var m = nederlands.length, t, i;
                while (m) {
                    i = Math.floor(Math.random() * m--);
                    t = nederlands[m].NEDERLANDS;
                    nederlands[m].NEDERLANDS = nederlands[i].NEDERLANDS;
                    nederlands[i].NEDERLANDS = t;
                     t = engels[m].ENGELS;
                     engels[m].ENGELS = engels[i].ENGELS;
                     engels[i].ENGELS = t;
        }
            document.getElementById("woord").innerHTML= nederlands[clicks].NEDERLANDS;
            document.getElementById("input").focus();
             clicks++;
      }
      
      
  function check(form){
  
  var nederlands2 = 0
for (x in nederlands) {
    nederlands2++;
}
  var engels2 = 0
for (x in engels) {
    engels2++;
}

if (clicks > 0 && clicks < nederlands2) {
    document.getElementById("woord").innerHTML= nederlands[clicks].NEDERLANDS;

    if (form.input.value.toUpperCase() == engels[clicks - 1].ENGELS.toUpperCase()) {

      document.getElementById("woord2").innerHTML= "goed";
      goeden++;
    }

    else {

      document.getElementById("woord2").innerHTML= "fout,  " + engels[clicks - 1].ENGELS;
      if (mistakes.indexOf(engels[clicks - 1].ENGELS) == -1) {
            mistakes.push(engels[clicks - 1].ENGELS);
            engels.push({ENGELS: engels[clicks - 1].ENGELS});
            nederlands.push({NEDERLANDS: nederlands[clicks - 1].NEDERLANDS});
            engels.splice(clicks + 2,0,{ENGELS: engels[clicks - 1].ENGELS});
            nederlands.splice(clicks + 2,0,{NEDERLANDS: nederlands[clicks - 1].NEDERLANDS});
      } else {
      engels.splice(clicks + 2,0,{ENGELS: engels[clicks - 1].ENGELS});
      nederlands.splice(clicks + 2,0,{NEDERLANDS: nederlands[clicks - 1].NEDERLANDS});
      fouten++;
      }
    }

    clicks++;
    document.getElementById("form").reset();
    document.getElementById("input").focus();
  }

  
  
else if (clicks == nederlands2) {

if (form.input.value.toUpperCase() == engels[clicks - 1].ENGELS.toUpperCase()) {

document.getElementById("woord2").innerHTML= "klaar";

document.getElementById("woord").innerHTML= "klaar";
goeden++;
}

else {

document.getElementById("woord2").innerHTML= "fout,  " + engels[clicks - 1].ENGELS;

      document.getElementById("woord").innerHTML= "klaar";
fouten++;

}
var goed = nederlands2 - fouten;
var cijfer = goed / nederlands2 * 9 + 1;
document.getElementById("cijfer").innerHTML= Math.round(cijfer * 100) / 100;
clicks++;

}


else {
}
document.getElementById("goed").innerHTML = "aantal goed: " + goeden;
    document.getElementById("fout").innerHTML = "aantal fouten: " + fouten;
document.getElementById("resterend").innerHTML = nederlands2 - clicks + 1;
 

}
}
  </script>
</body>
</html>