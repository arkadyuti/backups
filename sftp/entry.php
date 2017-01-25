<?php
session_start();
$admin="admin";
$password="humlog";

?>

<?php
if(isset($_POST['submit_pass']))
{
	if(($_POST['admin']=='admin')&&($_POST['password']=='humlog'))
	{
		$_SESSION['admin']='admin';
	}else
		echo 'wrong pass';
}
?>
<?php
if(!isset($_SESSION['admin']))
{
	echo '
		<form method="post">
			user=<input type="text" name="admin"/>
			<br>
			pass=<input type="password" name="password"/>
			<input type="submit" name="submit_pass"/>
		</form>
		';
}else
	echo '
<form method="post">
<table>
<tr>
	<td>Affiliate</td>
	<td><select name="affiliate">
		<option value="icubes">icubes</option>
		<option value="vComission">vComission</option>
		<option value="payoom">payoom</option>
		</select>
	</td>
</tr>
<tr>
	<td>Cnompany in small letter</td>
	<td><textarea type="text" name="cname" rows="4" cols="50"></textarea></td>
</tr>
<tr>
	<td>Title</td>
	<td><textarea type="text" name="title" rows="4" cols="50"></textarea></td>
</tr>
<tr>
	<td>Description</td>
	<td><textarea type="text" name="description" rows="4" cols="50"></textarea></td>
</tr>
<tr>
	<td>Coupon Code</td>
	<td><textarea type="text" name="couponcode" rows="4" cols="50"></textarea></td>
</tr>
<tr>
	<td>Deals/Coupons</td>
	<td><select name="coupon_deal">
		<option value="deals">Deals</option>
		<option value="coupons">Coupons</option></select>
	</td>
</tr>

<tr>
	<td>url</td>
	<td><textarea type="text" name="url" rows="4" cols="50"></textarea></td>
</tr>

<tr>
	<td>Category</td>
	<td><textarea type="text" name="category" rows="4" cols="50"></textarea></td>
</tr>

<tr>
	<td>expiry date</td>
	<td><input type="date" name="date" rows="4" cols="50"/></td>
</tr>

<tr>
	<td></td>
	<td><input type="submit" name="submit" value="submit"/></td>
</tr>

</table>
</form>';
?>
<?php
if(isset($_POST['submit']))
{
	// affiliate	cname	title	desc	couponcode	coupon_deal	url	category	date
	//echo 'suc';
	$affiliate	=$_POST['affiliate'];
	$cname		=$_POST['cname'];
	$title		=$_POST['title'];
	$description=$_POST['description'];
	$couponcode	=$_POST['couponcode'];
	$coupon_deal=$_POST['coupon_deal'];
	$url		=$_POST['url'];
	$category	=$_POST['category'];
	$date		=$_POST['date'];
	$mysql_user 	= "arka_cropmybill";
	$mysql_pass 	= "9735525775";
	$mysql_database	= "arka_cropmybill";
	
	$con= mysql_connect("localhost",$mysql_user,$mysql_pass) or die ("connection error");
	mysql_select_db($mysql_database, $con) or die ("database not selected");
	mysql_query("CREATE TABLE IF NOT EXISTS coupons
		( 
			id int NOT NULL AUTO_INCREMENT,
			affiliate text,
			cname varchar(25),
			title text,
			description text,
			couponcode text,
			coupon_deal varchar(10),
			url text,
			category varchar(30),
			date date,
			
			active int NOT NULL DEFAULT '1',
			PRIMARY KEY (id)
		)") or die("Could not create table");
	
	mysql_query("INSERT INTO coupons(affiliate,cname,title,description,couponcode,coupon_deal,url,category,date)
			       VALUES('$affiliate','$cname','$title','$description','$couponcode','$coupon_deal','$url','$category','$date')") 
				   or die("not inserted");
		echo '<a style="color:red"> submitted</a>';
}
?>














