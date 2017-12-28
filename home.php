<?php
include("session.php");
?>
<!DOCTYPE html>

<html>
<head>
    <link rel = "icon" type = "image/x-icon" href = "favicon.ico">
    <link rel="stylesheet" type="text/css" href="/main.css">
    <meta name="viewport" content="width=device-width">
    <title>WRTS-2 | home</title>
    </head>
    <body>
<h1 align = 'center'><img src = "images/beterleren.png" style = ""/></h1>

<div style = "display: -webkit-box;display: -moz-box;display: -ms-flexbox;display: -webkit-flex;display: flex;justify-content: center;">

<div class = 'options'>
<a href = "add" >Niewe lijst aanmaken</a>
<br><br>
<a href = "account">Account</a>
<br><br>
<a href = "logout" >Uitloggen</a>
</div> 


<div id = 'lists'>
<form action = "methods" method = "post">
<input type = "input" id = "filter" onkeyup = "myFilter();" placeholder = "Zoek door je lijsten..."/>
<input type = "button" id = "btn" onclick = "myLists()" value = "overhoor alle geselecteerde lijsten" style = "font-size: 15px;"/>
</form>
<ul id = "myUl">
<?php
include("config2.php");
$sql = "SELECT * FROM words WHERE USER = '".$_SESSION['login_user']."'";
$result = $con->query($sql);
while($row = $result->fetch_assoc()) {
echo("<li style = 'text-align: left; padding-left: 15px; display: block'>");
echo("<input type = 'checkbox' value = '" . $row['NAME'] . "' id = 'checkbox' style = 'margin: 5px; display: inline;'/>");
echo("<a href = 'delete?add=" . $row['NAME'] . "' onclick='return confirm(&quot;Weet je zeker dat je " . $row['NAME'] . " wilt verwijderen?&quot;);'><img class = 'icons' src = 'images/delete-icon.png' alt = 'verwijderen' style = 'height: 100%; margin 0;' id =  'verwijderen'/></a>");
echo("<a href = 'edit?add=" . $row['NAME'] . "'> <img class = 'icons' src = 'images/edit-icon.png' alt = 'bewerken' style = 'height: 100%; margin-right: 10px;'/></a>");
echo("<span style = 'cursor: pointer;' onclick = 'window.location.href = &quot;methods?add=" . $row['NAME'] . "&quot;'>".$row['NAME']."<span>");
echo("</li>");
}
?>
</ul>
</div>
</div>
<style>
#lists {
    width: 79vw;
}
a {
  color: blue;
  text-decoration: none;
}
#filter {
  margin: 5px;
  width: 40%;
  height: 20px;
  font-size: 20px;
}
body {
    width: 100vw;
    height: 100vh;
    margin: 0px;
    padding: 0px;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 100%;
    background-color: #f1f1f1;
    display: block;
}

li {
    display: block;
    color: #000;
    text-decoration: none;
    text-align: center;
    height: 2vw;
    padding: 2px;
    vertical-align: middle;
    font-size: 1.8vw;
}
li a {
    text-decoration: none;
    display: inline;
}
li > * {
    vertical-align: middle;
}
li:hover {
    background-color: #555;
    color: white;
}
.icons:hover {
    filter: invert(100%);
}
body {
    width: 100%;
    height: 100%;
    margin: 0px;
    padding: 0px;
}
</style>
<script>

function myFilter() {

    var input, filter, ul, li, a, i;
    input = document.getElementById('filter');
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUl");
    li = ul.getElementsByTagName('li');

    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("span")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
function myLists() {
var listarray = [];
var ul = document.getElementById("myUl");
var li = ul.getElementsByTagName('li');

for (i = 0; i < li.length; i++) {
var input = li[i].getElementsByTagName("input")[0];
if (input.checked) {
listarray.push(input.value);
}
else {
}
}
var listarray2 = JSON.stringify(listarray);
window.location.href = "methods2?add=" + listarray2;
}
</script>
    </body>
</html>
