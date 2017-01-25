<?php 
$home_path = $_SERVER['DOCUMENT_ROOT'];
$conn= mysql_connect("localhost","cropmybill","su4adu9ez") or die ("connection error");
mysql_select_db("suvankar_cropmybill", $conn) or die ("database not selected");
?>
<html>
<head>
<link rel="shortcut icon" href="/img/crop.ico">
<link rel="stylesheet" href="/styles.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<title>Best CashBack and Best Deals/Coupons at CropmyBill</title>
<meta name="Description" content="best cashback, latest deals & coupons on India's Best Online Shopping sites like Flipkart, Amazon, Myntra, Jabong, Snapdeal & more. Join us for free"/>
<meta name="keywords" content=" cropmybill.com, cropmybill,http://cropmybill.com, cashback, vouchers, coupons, discounts, offers, deals, promo codes, Best cashback site, flipkart deals, flipkart coupons, flipkart discounts"/>
<meta name="robots" CONTENT="INDEX, FOLLOW" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:title"  content ="Best CashBack and Best Deals/Coupons at CropmyBill"/>
<meta property="og:url" content="http://cropmybill.com/"/>
<meta property='og:image' content='http://cropmybil.com/img/logoBlue.png'/>
<meta property="og:site_name" content="cropmybil.com"/>
<meta property="og:description" content="best cashback, latest deals & coupons to on India's Best Online Shopping sites like Flipkart, Amazon, Myntra, Jabong, Snapdeal & more. Join us for free" />
<meta itemprop="name" content="Best CashBack and Best Deals/Coupons at CropmyBill">
<meta itemprop="description" content=" cropmybill.com, cropmybill,http://cropmybill.com, cashback, vouchers, coupons, discounts, offers, deals, promo codes">
<meta itemprop="image" content="http://cropmybil.com/img/logoBlue.png">
</head>

<body class="body_class" style="margin:0px;background-color: #f6f6f6;">
<script src="/jquery-1.11.0.min.js"></script>
<script>
	var x = navigator.cookieEnabled;
	if(x==false) {
		alert('Please enable Cookie to use our site');
	}
</script>
	<?php 

		include($home_path.'/inc/h.php');
	?>
<div id="table_container_ab">

			<?php
				include('./stores.php');
			?>
			
</div>
	<?php include($home_path.'/inc/footer.php') ?>
</body>
</html>