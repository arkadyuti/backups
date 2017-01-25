<?php 
include('/home/arka/public_html/main.php');
$connection= mysql_connect("localhost","arka_cropmybill","9735525775") or die ("connection error");
mysql_select_db("arka_contest", $connection) or die ("database not selected");
if($session != null)
{
	mysql_query("INSERT INTO `arka_contest`.`user` (`user_email`) VALUES ('$session');");
	$_SESSION['contest'] = $session;
}
?>
<html>
<head>
<link rel="shortcut icon" href="/img/crop.ico">
<link rel="stylesheet" href="/styles.css">
<script src="./js.js"></script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Shopaholic</title>
<meta name="Description" content="Campus Ambassador Programme - CropmyBill, Campus Ambassador Programme, CropmyBill Campus Ambassador Programme"/>
<meta name="keywords" content=" cropmybill.com, cropmybill,cropmybill.com/ca,http://cropmybill.com/ca, cashback, vouchers, coupons, discounts, offers, deals, promo codes, Best cashback site, flipkart deals, flipkart coupons, flipkart discounts,Campus Ambassador Programme - CropmyBill, Campus Ambassador Programme, CropmyBill Campus Ambassador Programme"/>
<meta name="robots" CONTENT="INDEX, FOLLOW" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:title"  content ="Best CashBack and Best Deals/Coupons at CropmyBill"/>
<meta property="og:url" content="http://cropmybill.com/"/>
<meta property='og:image' content='http://cropmybill.com/img/logoBlue.png'/>
<meta property="og:site_name" content="cropmybil.com"/>
<meta property="og:description" content="Campus Ambassador Programme - CropmyBill, Campus Ambassador Programme, CropmyBill Campus Ambassador Programme"/>
<meta itemprop="name" content="Best CashBack and Best Deals/Coupons at CropmyBill">
<meta itemprop="description" content="cropmybill.com, cropmybill,http://cropmybill.com, cashback, vouchers, coupons, discounts, offers, deals, promo codes">
<meta itemprop="image" content="http://cropmybill.com/img/logoBlue.png">
</head>
<style>
#table_container{
	
	position: relative;
}
#table_container:after {
    content : "";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    background:url("/images/white-brick-wall-background-repeatable-vertically-horizontally-40961346.jpg");
    width: 100%;
    height: 100%;
    opacity : 0.5;
    z-index: -1;
}
</style>
<body class="body_class" style="margin:0px;background-color: #f6f6f6;">
<script>
	var x = navigator.cookieEnabled;
	if(x==false) {
		alert('Please enable Cookie to use our site');
	}
</script>
	<?php 
		require('./h.php');
		
	?>
<div id="table_container_ab">
	
			<?php
				include('./ca.php');
			?>
			
</div>
	<?php
	mysql_close($conn);
	mysql_close($connection);
	?>
</body>
</html>