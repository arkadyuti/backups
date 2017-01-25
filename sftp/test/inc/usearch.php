<?php
if(isset($usearch))
{
	$search = urldecode($usearch);
	$q="SELECT * FROM table11 WHERE Category LIKE '".$search."%' GROUP BY OfferName";
	$result = mysql_query($q) or die("query");
	WHILE($rows = mysql_fetch_array($result))
		{
			$url = $rows['url'];
			$desc = $rows['Desc'];
			$title = $rows['Title'];
			$date = $rows['ExpDate'];
			$coupon = $rows['Code'];
			$OfferName = $rows['OfferName'];
			echo $OfferName.'<br>';
		}
}
else
{
}
?>