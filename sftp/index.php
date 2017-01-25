<?php
include './main.php';
$throw='';
$requri = getenv ("REQUEST_URI");
$url = explode('/', $requri);
if(isset($url[1]))
{
	$throw='home';
	if($url[1]=='')
	{
		if(!isset($url[2]) || $url[2]=='')
			$throw='home';
	}
	elseif($url[1]=='coupons')
	{
		if(!isset($url[2]) || $url[2]=='')
		{
			$throw='coupons';
		}
		elseif(isset($url[2]) && $url[2]!='')
		{
			$q="SELECT OfferName FROM table11 WHERE ExpDate >= '$today' AND OfferName LIKE '".$url[2]."%' AND Type='Coupon'";
			$result = mysql_query($q) or die("query");
			if(!$result || (mysql_numrows($result) < 1))
			{
				echo 'no coupons name';
			}
			elseif(!isset($url[3]) || $url[3]=='')
			{
				$throw='coupons';
				$brand=$url[2];
			}
			else
				echo 'wrong offer name';
		}
		else 
			echo 'coupons error';	
	}
	elseif($url[1]=='deals')
	{
		if(!isset($url[2]) || $url[2]=='')
		{
			$throw='deals';
		}
		elseif(isset($url[2]) && $url[2]!='')
		{
			$q="SELECT OfferName FROM table11 WHERE ExpDate >= '$today' AND OfferName LIKE '".$url[2]."%' AND Type='Promotion'";
			$result = mysql_query($q) or die("query");
			if(!$result || (mysql_numrows($result) < 1))
			{
				echo 'no deals name';
			}
			elseif(!isset($url[3]) || $url[3]=='')
			{
				$throw='deals';
				$brand=$url[2];
			}
			else
				echo 'wrong offer name';
		}
		else 
			echo 'deals error';	
	}
	elseif($url[1]=='usearch')
	{
		if(isset($url[2]))
		{
			$usearch = $url[2];
			$throw='usearch';
			if(isset($url[3]) && $url[2]=='')
			echo 'search error';
		}
		else 
			echo 'usearch error';	
	}
	elseif($url[1]=='terms-conditions')
	{
		if(!isset($url[2]) || $url[2]=='')
			$throw='terms';
		else 
			echo 'terms error';	
	}
	elseif($url[1]=='about')
	{
		if(!isset($url[2]) || $url[2]=='')
			$throw='about';
		else 
			echo 'about error';	
	}
	elseif($url[1]=='faqs')
	{
		if(!isset($url[2]) || $url[2]=='')
			$throw='faqs';
		else 
			echo 'faqs error';	
	}
	elseif($url[1]=='allstore')
	{
		if(isset($url[2]))
		{
			$alpha = $url[2];
			$throw='allstore';
			if(isset($url[3]) && $url[2]=='')
			echo 'allstore error';
		}
		else 
			echo 'usearch error';	
	}
	elseif($url[1]=='missing-cashback')
	{
		if(!isset($url[2]) || $url[2]=='')
		{
			if($session!=null)
			{
				$throw='missing';
			}
			else
			{
				if (isset($_SERVER['HTTP_COOKIE'])) 
				{
					$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
					foreach($cookies as $cookie) 
					{
						$parts = explode('=', $cookie);
						$name = trim($parts[0]);
						setcookie('cmb_ssn', '', time()-1000, '/');
						setcookie('cmb_vld', '', time()-1000, '/');
						setcookie('cmb_nm', '', time()-1000, '/');
						setcookie('cmb_lk', '', time()-1000, '/');
						header("Location: /");
					}
				}
				$session = null;
				
			}
		}
		else 
			echo 'missing-cashback error';	
	}
	elseif($url[1]=='earning')
	{
		if(!isset($url[2]) || $url[2]=='')
		{
			if($session!=null)
			{
				$throw='earning';
			}
			else
			{
				if (isset($_SERVER['HTTP_COOKIE'])) 
				{
					$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
					foreach($cookies as $cookie) 
					{
						$parts = explode('=', $cookie);
						$name = trim($parts[0]);
						setcookie('cmb_ssn', '', time()-1000, '/');
						setcookie('cmb_vld', '', time()-1000, '/');
						setcookie('cmb_nm', '', time()-1000, '/');
						setcookie('cmb_lk', '', time()-1000, '/');
						header("Location: /");
					}
				}
				$session = null;
				
			}
		}
		else 
			echo 'about earning';	
	}
	elseif($url[1]=='account')
	{
		if(!isset($url[2]) || $url[2]=='')
		{
			if($session!=null)
			{
				$throw='account';
			}
			else
			{
				if (isset($_SERVER['HTTP_COOKIE'])) 
				{
					$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
					foreach($cookies as $cookie) 
					{
						$parts = explode('=', $cookie);
						$name = trim($parts[0]);
						setcookie('cmb_ssn', '', time()-1000, '/');
						setcookie('cmb_vld', '', time()-1000, '/');
						setcookie('cmb_nm', '', time()-1000, '/');
						setcookie('cmb_lk', '', time()-1000, '/');
						header("Location: /");
					}
				}
				$session = null;
				
			}
		}
		else 
			echo 'about account';	
	}
	elseif($url[1]=='redeem')
	{
		if(!isset($url[2]) || $url[2]=='')
		{
			if($session!=null)
			{
				$throw='redeem';
			}
			else
			{
				if (isset($_SERVER['HTTP_COOKIE'])) 
				{
					$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
					foreach($cookies as $cookie) 
					{
						$parts = explode('=', $cookie);
						$name = trim($parts[0]);
						setcookie('cmb_ssn', '', time()-1000, '/');
						setcookie('cmb_vld', '', time()-1000, '/');
						setcookie('cmb_nm', '', time()-1000, '/');
						setcookie('cmb_lk', '', time()-1000, '/');
						header("Location: /");
					}
				}
				$session = null;
				
			}
		}
		else 
			echo 'about redeem';	
	}
	
	
}
?>
<html>
<head>
<link rel="shortcut icon" href="/img/crop.ico">
<link rel="stylesheet" type="text/css" href="/styles.css">
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
<body class="body_class" style="margin:0px;">
<script>
	var x = navigator.cookieEnabled;
	if(x==false) {
		alert('Please enable Cookie to use our site');
	}
</script>
	<?php 
		include('./inc/h.php');
	?>
<div id="table_container_na" style="min-width:1152px;height:auto;">
<div>
	<table id="table_body">
		<tr>
			<td>
				<?php 
				if($throw=='home')
				{
					echo '</td></tr></table>';
					include('./inc/topmerchants.php');
				}
				elseif($throw=='terms')
					include('./inc/terms.php');
				elseif($throw=='about')
					include('./inc/about.php');
				elseif($throw=='faqs')
					include('./inc/faqs.php');
				elseif($throw=='deals')
					include('./inc/deal.php');
				elseif($throw=='coupons')
					include('./inc/coupons.php');
				elseif($throw=='usearch')
					include('./inc/usearch.php');
				elseif($throw=='allstore')
					include('./inc/allstore.php');
				elseif($throw=='missing')
					include('./inc/missing.php');
				elseif($throw=='earning')
					include('./inc/earning.php');
				elseif($throw=='account')
					include('./inc/account.php');
				elseif($throw=='redeem')
					include('./inc/redeem.php');
				else
					include('./inc/error.php');
				
				
				?>
			</td>
		</tr>
	</table>
</div>

	<?php include('./inc/footer.php') ?>
</div>
<?php
mysql_close($conn);
?>
</body>
</html>