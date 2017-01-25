<?php
session_start();
$admin="admin";
$password="admin";
$logout = getenv ("REQUEST_URI");
date_default_timezone_set("Asia/Kolkata");
$datestamp		= date('Y-m-d H:i:s');
?>


<?php
if(!isset($_SESSION['admin']))
{
	echo '
		<form method="post">
		<table  align="center" width="400px" style="margin-top:40px;">
			<tr>
				<td>Login ID</td>
				<td><input type="text" name="admin"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit_pass"/></td>
			</tr>
			<tr>
				<td></td>
				<td><div id="error_login"></div></td>
			</tr>
		</table>
		</form>
		';
}
else
{
	echo'
	<a style="float:right;" href="/logout.php?log='.$logout.'"> logout</a>
	<form method="post">
	<table align="center" width="400px" style="margin-top:40px;">
		<tr>
			<td>Enter The Offer Code: </td>
			<td><input type="text" name="offer_code"/></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Submit"/></td>
		</tr>
		<tr>
			<td></td>
			<td><div id="deal_id"></td>
		</tr>
		<tr>
			<td></td>
			<td><div id="others1"></td>
		</tr>
		<tr>
			<td></td>
			<td><div id="others2"></td>
		</tr>
		<tr>
			<td></td>
			<td><div id="others3"></td>
		</tr>
	</table>
	</form>
	';
}
?>
<?php
if(isset($_POST['submit_pass']))
{
	if(($_POST['admin']=='admin')&&($_POST['password']=='admin'))
	{
		$_SESSION['admin']='admin';
	}else
		echo '
		<script>
		document.getElementById("error_login").innerHTML = "Wrong Password"
		</script>
		
			
	';
}
?>
<?php
if(isset($_POST['submit']))
{
	// affiliate	cname	title	desc	couponcode	coupon_deal	url	category	date
	//echo 'suc';
	$offer_code	=$_POST['offer_code'];
	
	$mysql_user 	= "arka_cropmybill";
	$mysql_pass 	= "9735525775";
	$mysql_database	= "arka_cropmybill";
	
	$conn= mysql_connect("localhost",$mysql_user,$mysql_pass) or die ("connection error");
	mysql_select_db($mysql_database, $conn) or die ("database not selected");
	
	$result = mysql_query("select * from outlet where offer_code = '$offer_code'");
	$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
	$active = $dbarray['active'];
	$deactive_date = $dbarray['deactive_date'];
	$deal_2 = $dbarray['deal_details'];
	echo '<script>
		document.getElementById("deal_id").innerHTML = "Deal = '.$deal_2.'"
		</script>';
	if($active == '1')
	{
		echo '
		<script>
		document.getElementById("others1").innerHTML = "Status = Active"
		</script>
		 ';
		mysql_query("UPDATE `outlet` SET `active`= '0', `deactive_date` = '$datestamp' WHERE offer_code = '$offer_code'");
	}
	elseif($deactive_date=='')
	{
		echo '<script>
		document.getElementById("others2").innerHTML = "Invalid Code"
		</script>';
	}else
	{
		echo '<script>
		document.getElementById("others3").innerHTML = "Status = Deactivated since '.$deactive_date.'"
		</script>';
	}
	
	
	
	mysql_close($conn);
}
?>

<div width="100%">
	<div style="width: 1152px; margin-left: auto;  margin-right: auto; margin-top:400px;">
	<h3 align="center"> Powered by CropmyBill</h3>
	<div align="center"><img width="50px" height="50px" src="/img/logo_footer3.png"/></div>
	</div>
</div>






