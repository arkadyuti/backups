
<?php
	$q="SELECT * FROM allstore group by cname";
	$result = mysql_query($q) or die("query");
	WHILE($rows = mysql_fetch_array($result))
		{
			$cname = $rows['cname'];
			echo $cname.'<br>';
		}
?>