<?php
ini_set('display_errors', '1');
include("session.php");
$listname = sanitize($_GET['add']);
$method = sanitize($_GET['method']);
include("config2.php");

$listarray = json_decode($_GET["add"]);
if ($listarray !== null) {
$array = array();
$array2 = array();
$count = 1;
$count2 = 0;

foreach ($listarray as $list) {
$sql = "SELECT WORDS FROM words WHERE NAME = '$list' AND USER = '".$_SESSION["login_user"]."'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
    $array3 = unserialize($row["WORDS"]);
}
$betweenvar = "order" . $count . "";
$count++;
$order2 = $_GET[$betweenvar];
foreach ($array3 as $key => $value) {
    if ($order2 == "RIGHT") {
    $array2[$count2]['WORD1'] = $array3[$key]['NEDERLANDS'];
    $array2[$count2]['WORD2'] = $array3[$key]['ENGELS'];
    } else {
    $array2[$count2]['WORD1'] = $array3[$key]['ENGELS'];
    $array2[$count2]['WORD2'] = $array3[$key]['NEDERLANDS']; 
    }
    $count2++;
}
$array = array_merge_recursive($array, $array2);
$array2 = array();
}
$order = "RIGHT";
}



else {
$count2 = 0;
$order = $_GET['order'];
$array = array();
$sql = "SELECT WORDS FROM words WHERE NAME = '$listname' AND USER = '".$_SESSION["login_user"]."'"; 
$result = $con->query($sql); 
while($row = $result->fetch_assoc()){
  $array3 = unserialize($row['WORDS']);
}
foreach ($array3 as $key => $value) {
    if ($order == "RIGHT") {
        $array[$count2]['WORD1'] = $array3[$key]['NEDERLANDS'];
        $array[$count2]['WORD2'] = $array3[$key]['ENGELS'];
    } else {
        $array[$count2]['WORD1'] = $array3[$key]['ENGELS'];
        $array[$count2]['WORD2'] = $array3[$key]['NEDERLANDS']; 
    }
    $count2++;
}
}

if (count($array) == 0) {
    echo "<script>alert('Er zijn geen woorden in deze woordenlijst(en)'); window.location.href = 'home.php'</script>";
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


<div id = "toetsen">
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
</div>


<div id = "gedachten" style = "display: none;">
    <form id = 'form'>
<div style = "text-align: center;">
            <a href = "javascript:void(0);" style = "color: blue;" onclick = "show();">Laat antwoord zien</a>
</div>
<h2 align = 'center' id="woord22"></h2>
<div id = "goedfout" style = "display: none">
<div style = "display: -webkit-box; display: -moz-box; display: -ms-flexbox; display: -webkit-flex; display: flex; justify-content: center;">
<div style = "width: 49%; background-color: green; color: white; width: 100%; display: block; text-align: center; cursor: pointer;" onclick = "goed();"><span style = "font-size: 2vw;">Goed</span></div>
<div style = "width: 49%; background-color: red; color: white; width: 100%; display: block; text-align: center; cursor: pointer;" onclick = "fout();"><span style = "font-size: 2vw;">Fout</span></div>
</div>
</div>
    </form>
</div>


<p>voortgang: </p>
  <div style = "background-color: white;
  border-radius: 13px; /* (height of inner div) / 2 + padding */
  padding: 3px;">
    <div style = "background-color: green;
   height: 20px;
   border-radius: 10px; width: 0%;" id = "progressbar"></div>
  </div>
  <ul>
    <li id = 'goed'></li>
    <li id = 'fout'></li>
  </ul>  
  <p id = 'resterend'></p>
<h2 align = 'center' id = "cijfer"></h2>
</div>
<input type="button" onclick="myFunction()" value="begin opnieuw">
<br>
<a href="home.php">terug naar home</a>
<script>
function myFunction(){
location.reload();
}
</script>
<script>
  var mistake = mistake2 = "";
var mistakes = [];
var goeden = 0;
var fouten = 0;
var array = <?php echo json_encode($array); ?>;
var array_length_start = array.length; 
var method = <?php echo json_encode($method);?>;
var firstgood = [];

if (method == "TOETSEN") {

function start() {
  var currentIndex = array.length, temporaryValue, randomIndex;
    while (0 !== currentIndex) {

      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;

      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
  }
  document.getElementById("woord").innerHTML = array[0].WORD1;
  document.getElementById("input").focus();
}

function check(form){
  if (array.length == 1) {
    if (form.input.value.toUpperCase() == array[0].WORD2.toUpperCase()) {
      if (mistakes.indexOf(array[0].WORD2) == -1) {
        firstgood.push(array[0].WORD2);
      }
      array.splice(0, 1);
      document.getElementById("woord2").innerHTML = "klaar";
      document.getElementById("woord").innerHTML = "klaar";
      goeden++;
    } else {
      array.splice(0, 1);
      document.getElementById("woord2").innerHTML = "fout, " + array[0].WORD2;
      document.getElementById("woord").innerHTML = "klaar";
      fouten++;
    }
    var note = firstgood.length / array_length_start * 9 + 1;
    note = Math.round(note * 10) / 10
    document.getElementById("cijfer").innerHTML = note;
  } else {
  if (form.input.value.toUpperCase() == array[0].WORD2.toUpperCase()) {
    document.getElementById("woord2").innerHTML = "goed";
    if (mistakes.indexOf(array[0].WORD2) == -1) {
      firstgood.push(array[0].WORD2);
    }
    array.splice(0, 1);
    document.getElementById("woord").innerHTML = array[0].WORD1;
    goeden++;
  } else {
    document.getElementById("woord2").innerHTML = "fout, " + array[0].WORD2;
    mistake2 = array[0].WORD2;
    mistake1 = array[0].WORD1;
    array.splice(0, 1);
    array.splice(2, 0, {WORD1: mistake1, WORD2: mistake2});
    if (mistakes.indexOf(mistake2) == -1) {
      mistakes.push(mistake2);
      array.push({WORD1: mistake1, WORD2: mistake2});
    }
    document.getElementById("woord").innerHTML = array[0].WORD1;
    fouten++;
  } 
  }

  document.getElementById("goed").innerHTML = "aantal goed: " + goeden;
  document.getElementById("fout").innerHTML = "aantal fout: " + fouten;
  document.getElementById("resterend").innerHTML = "resterend: " + array.length;
  var betweenvar = array_length_start - array.length;
  betweenvar = betweenvar / array_length_start * 100;
  document.getElementById("progressbar").style.width = betweenvar + "%";
  document.getElementById("form").reset();
  document.getElementById("input").focus();
}

} else {

  function start() {
    var currentIndex = array.length, temporaryValue, randomIndex;
      while (0 !== currentIndex) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
      }
    document.getElementById("woord").innerHTML = array[0].WORD1;
    document.getElementById("gedachten").style.display = "inline";
    document.getElementById("toetsen").style.display = "none";
  }

  function show() {
    document.getElementById("woord22").innerHTML = array[0].WORD2;
    document.getElementById("goedfout").style.display = "inline";
  }

  function goed() {
    if (mistakes.indexOf(array[0].WORD2) == -1) {
      firstgood.push(array[0].WORD2);
    }
    array.splice(0, 1);
    goeden++;
    if (array.length < 1) {
      document.getElementById("goedfout").style.display = "none";
      document.getElementById("woord").innerHTML = "klaar";
      document.getElementById("woord22").innerHTML = "klaar";
      var note = firsgood.length / array_length_start * 9 + 1;
      note = Math.round(note * 10) / 10
      document.getElementById("cijfer").innerHTML = note;
    } else {
      document.getElementById("goedfout").style.display = "none";
      document.getElementById("woord22").innerHTML = "";
      document.getElementById("woord").innerHTML = array[0].WORD1;
    }
    document.getElementById("goed").innerHTML = "aantal goed: " + goeden;
    document.getElementById("fout").innerHTML = "aantal fout: " + fouten;
    document.getElementById("resterend").innerHTML = "resterend: " + array.length;
    var betweenvar = array_length_start - array.length;
    betweenvar = betweenvar / array_length_start * 100;
    document.getElementById("progressbar").style.width = betweenvar + "%";
  }

  function fout() {
    mistake2 = array[0].WORD2;
    mistake1 = array[0].WORD1;
    array.splice(0, 1);
    array.splice(2, 0, {WORD1: mistake1, WORD2: mistake2});
    if (mistakes.indexOf(mistake2) == -1) {
      mistakes.push(mistake2);
      array.push({WORD1: mistake1, WORD2: mistake2});
    }
    fouten++;
    if (array.length < 1) {
      document.getElementById("goedfout").style.display = "none";
      document.getElementById("woord").innerHTML = "klaar";
      document.getElementById("woord22").innerHTML = "klaar";
      var note = firstgood.length / array_length_start * 9 + 1;
      note = Math.round(note * 10) / 10
      document.getElementById("cijfer").innerHTML = note;
    } else {
      document.getElementById("goedfout").style.display = "none";
      document.getElementById("woord22").innerHTML = "";
      document.getElementById("woord").innerHTML = array[0].WORD1;
    }
    document.getElementById("goed").innerHTML = "aantal goed: " + goeden;
    document.getElementById("fout").innerHTML = "aantal fout: " + fouten;
    document.getElementById("resterend").innerHTML = "resterend: " + array.length;
    var betweenvar = array_length_start - array.length;
    betweenvar = betweenvar / array_length_start * 100;
    document.getElementById("progressbar").style.width = betweenvar + "%";
  }
}
</script>
</body>
</html>