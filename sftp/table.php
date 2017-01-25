<?php
if(isset($_POST['passw']))
{
	if($_POST['passw']=='cropnew')
		setcookie("set_for", 'cropnew', time()+(60*60*24*30*6) );
}
if(!isset($_COOKIE['set_for']))
{
	{
		echo '	<form method="POST" action="" autocomplete="off">
					<input type="password" name="passw"/>
					<input type="submit" value="submit"/>
				</form>
			';
		die("Not Authorize");
	}
}
?>

<html>
<head>
<style>
h1 {
    border-bottom: 3px solid #cc9900;
    color: #996600;
    font-size: 30px;
}
table, th , td {
    border: 1px solid grey;
    border-collapse: collapse;
    padding: 5px;
}
table tr:nth-child(odd) {
    background-color: #f1f1f1;
}
table tr:nth-child(even) {
    background-color: #ffffff;
}
</style>
</head>
<body>

<div id="id01"></div>

<script>
var xmlhttp = new XMLHttpRequest();
var url = "MYSQL.php";

xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        myFunction(xmlhttp.responseText);
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send();

function myFunction(response) {
    var arr = JSON.parse(response);
    var i;
    var out = "<table><tr><td>ID</td><td>session</td><td>aff_sub</td><td>cname</td><td>remote</td><td>browser</td><td>reUrl</td><td>timestamp</td></tr>";
	
    for(i = 0; i < arr.length; i++) {
        out += "<tr><td>" +
        arr[i].ID +
        "</td><td>" +
        arr[i].session +
        "</td><td>" +
		arr[i].aff_sub +
        "</td><td>" +
		arr[i].cname +
        "</td><td>" +
		arr[i].remote +
        "</td><td>" +
		arr[i].browser +
        "</td><td>" +
		arr[i].reUrl +
        "</td><td>" +
		arr[i].timestamp +
        "</td></tr>";
    }
    out += "</table>"
    document.getElementById("id01").innerHTML = out;
}
</script>

</body>
</html>