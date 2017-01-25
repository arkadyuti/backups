<?php 
session_start();

require_once( 'src/facebook.php');

$facebook = new Facebook(array(
  'appId'  => '1558391157733323',
  'secret' => 'c781744085fbfa14467c9a7eb1593f35',
));

$user = $facebook->getUser();


if ($user) {
  try {
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

if ($user) {	
    $logoutUrl = $facebook->getLogoutUrl();
	//die("t");
    } else {
      $loginUrl = $facebook->getLoginUrl( array('scope' => 'email'));
	  //die("login");
    }


//google
if(!$user)
{
	require_once( 'autoload.php' );

	$client_id = '804877435392-iaglqddvpqvm268ag48no56ovb5ha0do.apps.googleusercontent.com';
	$client_secret = 'qIJN80ryuToDDrmMuZXOEe2B';
	$redirect_uri = 'http://m.cropmybill.com/index.php'; 
	$simple_api_key = 'AIzaSyDnFy3CCQW0bsOmBsIIgXTt_CbMDJLRPiE';

	$client = new Google_Client();
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	$client->setRedirectUri($redirect_uri);
	$client->setDeveloperKey($simple_api_key);
	$client->addScope("https://www.googleapis.com/auth/userinfo.email","https://www.googleapis.com/auth/plus.login");

	$plus 			 = new Google_Service_Plus($client);
	$objOAuthService = new Google_Service_Oauth2($client);

	if (isset($_REQUEST['logout'])) {
	  unset($_SESSION['access_token']); 
	}
	 
	if (isset($_GET['code'])) {
	  $client->authenticate($_GET['code']);
	  $_SESSION['access_token'] = $client->getAccessToken();
	  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
	}


	if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	  $client->setAccessToken($_SESSION['access_token']);
	} elseif($client->isAccessTokenExpired()) {
		$authUrl = $client->createAuthUrl();
	}
	 else {
	  $authUrl = $client->createAuthUrl();
	}
	if ($client->getAccessToken()) {
	$userData = $objOAuthService->userinfo->get();
	$data['userData'] = $userData;
	$_SESSION['access_token'] = $client->getAccessToken();
	} else {
	$authUrl = $client->createAuthUrl();
	$data['authUrl'] = $authUrl;
	}

}

	$requri = getenv ("REQUEST_URI");
	$url = explode('/', $requri);
	if(isset($url[1]))
	{
		if($url[1]=='about')
			$through='about';
		elseif($url[1]=='faqs')
			$through='faqs';
		elseif($url[1]=='earning')
			$through='earning';
		elseif($url[1]=='account')
			$through='account';
		elseif($url[1]=='redeem')
			$through='redeem';
		elseif($url[1]=='moredeals')
			$through='moredeals';
		else
			$through='home';
	}
	if((isset($url[2]))&&($through=='moredeals'))
	{
		$through="true";
		$temp=$url[2];
		
		date_default_timezone_set("Asia/Kolkata");
		$today = date("Y-m-d");
		
		$con_brand= mysql_connect("localhost","arka_cropmybill","9735525775") or die ("connection error");
		mysql_select_db("arka_cropmybill", $con_brand) or die ("database not selected");
		$q="SELECT cname FROM coupons WHERE date >= '$today' AND cname='$temp'";
		$result = mysql_query($q) or die("query");
		if(!$result || (mysql_numrows($result) < 1))
			$through = 'home';
		else
			$brand = $temp;
		mysql_close($con_brand);
		
		 
		//die($through);
		
	}

?>


<html>
 
<head> 

    <!-- Latest compiled and minified CSS -->
    
    <link rel="stylesheet" href="http://m.cropmybill.com/css/lib.css">

	
	<link rel="stylesheet" href="http://m.cropmybill.com/css/style.css"> <!-- Gem style -->                                  
	<link rel="shortcut icon" href="http://cropmybill.com/img/crop.ico">
	<script src="http://cropmybill.com/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="http://cropmybill.com/js/slider/wb.slideshow.min.js"></script>
<script>
$(document).ready(function(){
    $("#contact-us-hide").click(function(){
        $("#contact-us-hide").hide();
		$("#contact-us-email").slideToggle(1500,"easeOutBounce");
		$("#contact-us-show").show();
    });
   
});
/*
$(document).ready(function(){
	$("#contact-us-show").click(function(){
		$("#contact-us-show").hide();
		$("#contact-us-email").slideToggle(1500,"easeOutBounce");
		$("#contact-us-hide").show();
	});
});*/
</script>
 
		<style>
		.ui-helper-center1{
    text-align: center;
	color:white;
}
.ui-helper-center2{
    text-align: center;
	color:red;
	display:none;
}
		</style>
	
 <script type="text/javascript">
(function(f,b){if(!b.__SV){var a,e,i,g;window.cropmybill=b;b._i=[];
b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="cropmybill";c.people=c.people||[];c.toString=function(b){var a="cropmybill";"cropmybill"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=f.createElement("script");a.type="text/javascript";a.async=!0;
e=f.getElementsByTagName("script")[0];e.parentNode.insertBefore(a,e)}})(document,window.cropmybill||[]);
</script>
<script>
	$(function(){

		$("dd.answer")
			.hide();
		
		$("dl.faq dt")
			.append("<br /><a href='#' title='Reveal Answer' class='answer-tab'>Answer</a>");
			
		$(".answer-tab")
			.click(function(){
				$(this)
					.parent().parent()
					.find("dd.answer")
					.slideToggle();
				return false;
			});
	});
</script>
<script>
function scrollWin() {
    window.scrollTo(0,600);
}
</script>

<style>
.dropdown-menu {
left: 0;
z-index: 1000;
display: block;
float: right;
min-width: 100px;
padding: 0px 0;
margin: 2px 10px 0;
font-size: 14px;
text-align: left;
list-style: none;
background-color: #red;
-webkit-background-clip: padding-box;
background-clip: padding-box;
border: 1px solid #ccc;
border: 1px solid rgba(0,0,0,.15);
border-radius: 4px;
-webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
box-shadow: 0 6px 12px rgba(0,0,0,.175);
box-sizing: border-box;
line-height: 1.42857143;
}
ol, ul {
margin-top: 0;
margin-bottom: 10px;
}
.dropdown-menu>li>a {
display: block;
padding: 4px 14px;
clear: both;
font-weight: 400;
line-height: 1.42857143;
color: #333;
white-space: nowrap;
text-decoration: none;
background-color: white;
font-family: latoregular,Arial,sans-serif;
}
.dropdown-menu .divider {
height: 1px;
margin: 0px 0;
overflow: hidden;
background-color: #b7c3c7;
}
#ddmenu {
	padding: 0;
	margin-top: 13;
	height:40px;
	cursor:pointer;
	text-align: center;
	border-radius: 4px;
	-webkit-transition: background .2s ease;
	-moz-transition: background .2s ease;
	-ms-transition: background .2s ease;
	-o-transition: background .2s ease;
	transition: background .2s ease;
}
#ddmenu2 {
	padding: 0;
	margin-top: 13;
	height:40px;
	cursor:pointer;
	text-align: center;
	border-radius: 4px;
	-webkit-transition: background .2s ease;
	-moz-transition: background .2s ease;
	-ms-transition: background .2s ease;
	-o-transition: background .2s ease;
	transition: background .2s ease;
}

</style>
<style>
			.crop_dialog_overlay
			{
			   position: fixed;
			   top: 0;
			   right: 0;
			   bottom: 0;
			   left: 0;
			   height: 100%;
			   width: 100%;
			   margin: 0;
			   padding: 0;
			   background: #000000;
			   opacity: .65;
			   filter: alpha(opacity=15);
			   -moz-opacity: .15;
			   z-index: 101;
			   display: none;
			   background: url("http://cropmybill.com/images/bs-overlay.png");
			   
			}
			.recharge_submit
			{
			   display: none;
			   position: fixed;
			   width: 100%;
			   height: 202px;
			   top:50%;
			   left:61%;
			   align:center;
			   margin-left: -190px;
			   margin-top: -100px;
			   background-color: #ffffff;
			   border: 1px solid #336699;
			   border-radius:5px;
			   padding: 0px;
			   z-index: 102;
			}

			.menu {
				
				height:10px;
				
			}
			.float{
				text-align:center;
				float:left;
				padding:5px; 
				cursor:pointer;
				background-color:#34495e;
				border-left: 2px solid #34495e;
				border-top: 2px solid #34495e;
				border-right: 2px solid #34495e;
				border-radius:2px 2px 0px 0px;
				margin:2px;
				width:70px;
			}

			.selected{
				background-color:rgba(243, 240, 255, 0.8);
				color:black;
				
			}
			.aboutus_body
			{
				width:670px;
				text-align:left;
				display:none;
			}
			.FAQs_body
			{
				width:100%;
				text-align:left;
				display:block;
				
			}
			.myacc_body
			{
				width:100%;
				text-align:left;
				display:block;
			}
			.earning_body
			{
				width:99-%;
				text-align:left;
				display:block;
				
			}
			.redeem_body
			{
				width:100%;
				text-align:left;
				
				display:block;
			}

			.afont
			{
				color:white;
				
				font-size: 12px;
				font-family: Arial,Helvetica,sans-serif;
			}
			.headerclass_a
			{
				display: block;
				padding: 10px 0;
				font-size:12px;
				font-weight:bold;
				color:#b7c3c7;
			}
			</style> 
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

<body style="margin:0px; width:100%;">
<style>
	.header_top {
		width:100%;
		position:relative;
		height:70px;
		background-color:#34495e;
		z-index:999;
	}
	.header_logo {
		width:50%;
		float:left;
	}
	.top_banner_div {
		position:relative;
		width:50%;
		float:right;
	}
	.nothing {
		margin-left:0px%;		
	}

</style>
<div class="header_top">
	<div class="header_logo">
		<div class="nothing">
			<a href="http://m.cropmybill.com/"><img style="padding-top:10px;" width="100%" height="70%" src="http://cropmybill.com/img/logo.png"/></a>
		</div>
	</div>
	

	
<?php
$_SESSION['a']='';
if ( (!isset($_SESSION['signin_email'])) && (!$_SESSION['access_token']) && (!$user))   {
	echo '
	<div id="ddmenu2" class="main-nav" style="float:right;"> <a class="headerclass_a" href="'.$loginUrl.'">
		Join Us</a></div></div>
	';
}
else
{
	$hi = array('Hi', 'Hello', 'Namaste','Swagat','Vannakam','Namaskar','Sasriakal','Hola!','Swagat-Ba');
	$number=rand(0,8);
	if((isset($_SESSION['access_token']))&&($userData))
	{
		$me			= $plus->people->get('me');
		$displayName= $me['displayName'];
		$G_IMG_URL	= $me['image']['url'];
		$given_name	= $userData->given_name;
		$ID			= $userData->id;
		$gender		= $userData->gender;
		$email		= $userData->email;
		//die("er");
		$client  		= @$_SERVER['HTTP_CLIENT_IP'];
		$forward 		= @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  		= $_SERVER['REMOTE_ADDR'];
		$browser		= $_SERVER['HTTP_USER_AGENT'];
		date_default_timezone_set("Asia/Kolkata");
		$datestamp		= date('Y-m-d H:i:s');
		//die($_SESSION['access_token']);
		$conn_google	= mysql_connect("localhost","arka_cropmybill","9735525775");
		mysql_select_db("arka_cropmybill", $conn_google) ;
		mysql_query("INSERT INTO login(signup_email,signup_name,fname_google,name_google,ID_google,icon_google,gender_google,client,forward,remote,browser,datestamp)
			       VALUES('$email','$displayName','$given_name','$displayName','$ID','$G_IMG_URL','$gender','$client','$forward','$remote','$browser','$datestamp')");
		
		mysql_close($conn_google);
	}
	elseif(isset($_SESSION['signin_email']))
	{
		
		$email=$_SESSION['signin_email'];
		//die("2");
		$conn_user	= mysql_connect("localhost","arka_cropmybill","9735525775") ;
		mysql_select_db("arka_cropmybill", $conn_user);
		$re = mysql_query("SELECT signup_name FROM login WHERE signup_email = '$email'");
		$qre = mysql_fetch_array($re, MYSQL_ASSOC);
		$temp = explode(" ",$qre['signup_name']);
		$given_name = $temp[0];
		mysql_close($conn_user);
	}
	else
	{
		$id_fb		=$user_profile['id'];
		$email_fb	=$user_profile['email'];
		$fname_fb	=$user_profile['first_name'];
		$gender_fb	=$user_profile['gender'];
		$name_fb	=$user_profile['name'];
		$icon_fb	="https://graph.facebook.com/$user/picture";
		$given_name	=$fname_fb;
		
		$client  		= @$_SERVER['HTTP_CLIENT_IP'];
		$forward 		= @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  		= $_SERVER['REMOTE_ADDR'];
		$browser		= $_SERVER['HTTP_USER_AGENT'];
		date_default_timezone_set("Asia/Kolkata");
		$datestamp		= date('Y-m-d H:i:s');
		//die($_SESSION['access_token']);
		$conn_fb	= mysql_connect("localhost","arka_cropmybill","9735525775");
		mysql_select_db("arka_cropmybill", $conn_fb) ;
		mysql_query("INSERT INTO login(signup_email,signup_name,fname_fb,name_fb,id_fb,icon_fb,gender_fb,client,forward,remote,browser,datestamp)
			       VALUES('$email_fb','$name_fb','$fname_fb','$name_fb','$id_fb','$icon_fb','$gender_fb','$client','$forward','$remote','$browser','$datestamp')");
		
		mysql_close($conn_fb);
	}
	
	echo '
	<div id="ddmenu" class="main-nav2" style="float:right;"> <a class="headerclass_a">
		'.$hi[$number].', '.$given_name.'</a></div>
		';
}
?>
</div>
<div id="ddmenu_show" style="position:absolute; width:100%; float:right;top:70px;height:0px;z-index:999;display:none;"> 
	<div style="float:right;">
		<ul class="dropdown-menu">
			<li><a href="http://m.cropmybill.com/account">My Account</a></li>
			<li class="divider"></li>
			<li><a href="http://m.cropmybill.com/earning">Earnings</a></li>
			<li class="divider"></li>
			<li><a href="http://m.cropmybill.com/redeem">Redeem</a></li>
			<li class="divider"></li>
			<li><a href="http://m.cropmybill.com/logout.php">Logout</a></li>
		</ul>			
	</div>
</div>
<script> 
$(document).ready(function(){
    $("#ddmenu").click(function(){
        $("#ddmenu_show").slideToggle("fast"); 
    });
});
</script>



<div id="container" style="width:100%; height:100%;">
<script type="text/javascript">
$(document).ready(function()
{
   $("#SlideShow1").slideshow(
   {
      interval: 4000,
      type: 'random',
      effect: 'fade',
      direction: '',
      effectlength: 2000
   });
});
</script>
<style>
.fixedmenu{
	float:left;
	width:90px;
	padding: 2.5px 2.5px 2.5px 0px;
	cursor:pointer;
}
.shopfixed{
	background-color:#34495e;
	width:83px;
	height:14px;
	padding: 4px 2px 0px 1px;
}

.shopfixedDD{
	background-color:white;
	width:82px;
	height:14px;
	border-bottom: 1px solid #a6a7a8;
	border-left: 1px solid #a6a7a8;
	border-right: 1px solid #a6a7a8;
	margin-top: 2px;
}
	
.a_fixed{
	color:#d0dde2;
	font-size:9px;
	text-decoration:none;
	font-family: latoregular,Arial,sans-serif;	
	
}

.a_deals{
	color:black;
	font-size:7px;
}

<!--
.shopfixedDD a:hover{
	color:red;
}
.shopfixedDD a:link{
    color: black;
    text-decoration: none;
    cursor: auto;
}
.shopfixedDD a:visited {
    color: red;
    text-decoration: none;
    cursor: auto;
}
-->

</style>
<script> 
$(document).ready(function(){
    $("#deals").click(function(){
        $("#deals_DD").slideToggle(500,"easeInCirc"); 
    });
});
</script>
<?php
$frontpage=' 
	<div style="position:fixed;background-color:transparent;top:150px;width:100px;height:50px;left:0px;z-index:4;">
	<div class="fixedmenu">
	<div class="shopfixed" align="center">
		<a class="a_fixed" href="http://m.cropmybill.com/">Shop for CashBack</a>
	</div>
	</div>
	
	<div class="fixedmenu">
		<div id="deals" class="shopfixed" align="center">
			<a class="a_fixed">Shop for Deals</a>
		</div>
		<div id="deals_DD" style="display:none;">
		<div class="shopfixedDD" align="center">
			<a class="a_deals" href="http://m.cropmybill.com/moredeals/flipkart">Flipkart</a>
		</div>
		<div class="shopfixedDD" align="center">
			<a class="a_deals" href="http://m.cropmybill.com/moredeals/jabong">Jabong</a>
		</div>
		<div class="shopfixedDD" align="center">
			<a class="a_deals" href="http://m.cropmybill.com/moredeals/yepme">YepMe</a>
		</div>
		<div class="shopfixedDD" align="center">
			<a class="a_deals" href="http://m.cropmybill.com/moredeals"> And many more</a>
		</div>
		</div>
	</div>
	</div>
	
	';
if($through=='home')
{
	echo $frontpage;
}
?>
<!-- FEATURES SECTION -->
    <section class="features">
<?php
if($through=='about')
{
	echo '
	<div style="padding: 0px 0px 14px 0px;">
		<div style="padding: 0px 0px 0px 10px;">
			<div style="background-color:white; width:100%;min-height: 600px;">
				<div class="FAQs_body" style="padding-bottom:75px;padding-top:25px;">
					<div align="center" style="font-family: Arial,Helvetica,sans-serif;font-size: 19px;color: #555;font-weight: bold;
                     text-align: left;
                     padding-left: 0px;">
					About Us
					</div>	
					<h2 align="left" style="font-size:16px; font-weight: normal;color:#888A8C;margin-left:0px;margin-right:10px;text-align: justify;text-justify: inter-word;font-family:latoregular,Arial,sans-serif;">
					CropmyBill is an online platform to revolutionize the online shopping experience.
					Our Partners includes the biggest and leading websites like Flipkart, Amazon, Snapdeal and many more.
					We provide you with best cashback and latest deals/coupons on extensive range of products.
					All you need to do is JOIN US and SHOP via us to get cashback.
					<br>
					<br>
					We help you to earn on your regular purchase and save maximum via best deals and 
                    exclusive coupons. 
					Unlike other cashback sites in India there is no minimum limit to redeem from us.
					<br>
					<br>
					<br>
					<span style="color:#555; font-weight: bold;"> Join Us</span>
					<br>
					<br>
					Sign up on CropmyBill.com to create your account. Browse through your preferred
                    online stores for the best cashback and deals/coupons.
					<br>
					<br>
					<span style="color:#555; font-weight: bold;"> Shop via us </span>
					<br>
					<br>
					Go to your preferred retailer through CropmyBill.com. Shop like you normally do 
                    and get cashback on your purchase.
					<br>
					<br>
					<span style="color:#555; font-weight: bold;"> Redeem </span>
					<br>
					<br>
					Your cashback is traced within 72 working hours and added as pending cash.
                    Once the return period of your product is over, your cashback then becomes 
                    confirmed cash.You can redeem your cash through the following options:
					<br>
					<br>
					Recharge your phone
					<br>
					Transfer to bank
					<br>
					<br>
					There is no minimum limit to redeem via "Recharge your phone". Your recharge 
                    is done within 48 working hours.
					<br>
					There must be a minimum of Rs.250 as confirmed cash in your account to redeem 
                    via "Transfer to bank". Your transfer is done within 12 working days. Rs.20 is 
                    deducted as transition cost.
					<br>
					<br>
					<br>
					<span style="color:#555; font-weight: bold;"> Why CropmyBill.com? </span>
					<br>
					<br>
					<span style="color:#555; font-weight: bold;"> 1.CropmyBill.com is free to join </span>
					<br>
					<br>
					CropmyBill is absolutely free! There are no registration fees, no annual fees 
                    and simply no hidden charges. You just JOIN US for free, shop and earn bucks 
                    from us.It is as simple as that.
				    <br>
					<br>
				    <span style="color:#555; font-weight: bold;"> 2.Earn extra bucks </span>
					<br>
					<br>
					We have partnered with all major websites in India. You shop from them anyways, 
                    but having account at cropmybill.com and shopping via us earns you extra bucks.
					<br>
					<br>
					<span style="color:#555; font-weight: bold;"> 3.Cashback on Deals and Coupons </span>
					<br>
					<br>
					We provide you with the best deals and exclusive coupons from top brands. Savings via
                    deals and coupons is topped with cashback at CropmyBill.com
					<br>
					<br>
					<span style="color:#555; font-weight: bold;"> 4.Redeem options </span>
					<br>
					<br>
					You can choose how you want your cashback. You can either recharge your phone or 
                    transfer the cashback to bank.
					<br>
					<br>
					<span style="color:#555; font-weight: bold;"> 5.Services </span>
					<br>
					<br>
					Unlike other cashback sites in India, there is no minimum limit to redeem from us.
                    Recharge your phone with any valid amount.
					<br>
					<br>
					<br>
					<br>
					<br>
					<h2 align="center" style="font-size:1.3em; font-weight: bold; padding-left:20px;color:#1F68A5;">
					HAPPY CROPPING!  </h2>
					</h2>
				</div>
			</div>
		</div>
    </div>
	';
}
?>

<?php
if($through=='faqs')
{
	echo '
	<div style="padding: 0px 0px 14px 0px;">
		<div style="padding: 0px 0px 0px 0px;">
			<div style="background-color:white; width:100%;min-height: 600px;">
				<div class="FAQs_body" style="padding-bottom:75px;padding-top:25px;">
					<div align="center" style="font-family: Arial,Helvetica,sans-serif;font-size: 2em;color: #1F68A5;">
					Frequently Asked Questions
					</div>
					<div id="page-wrap">

						<dl class="faq"> 
							<dt>What is cropmybill.com?</dt>
							<dd class="answer"><div>cropmybill.com is a platform to revolutionize the online shopping experience.We provide you with best cashback and latest deals/coupons.</div></dd>
						</dl>
						
						<dl class="faq">
							<dt>How can I earn cashback from your site?</dt>
							<dd class="answer"><div>
											Earn cashback in quick steps 1,2,3..:
											<ul>
											<li style="height: auto;margin: 8px 0px 8px 0px;"> Join Us</li>
											<li style="height: auto;margin: 8px 0px 8px 0px;">Shop from your preferred store via us.</li>
											<li style="height: auto;margin: 8px 0px 8px 0px">Redeem your cashback once it is confirmed in your cropmybill wallet.</li>
											</ul></div></dd>
						</dl>
						
						<dl class="faq">
							<dt>When do I get my cashback?</dt>
							<dd class="answer"><div>Once the return period of your product is over, your cashback then becomes ready to be redeemed. </div></dd>
						</dl>
						
						<dl class="faq">
							<dt>How to redeem my wallet cash?</dt>
							<dd class="answer"><div>To redeem your wallet cash you can either
												<ul>
												<li style="height: auto;margin: 8px 20px 8px 20px;width: 100%;">Recharge Your Phone - no minimum limit</li>
												<li style="height: auto;margin: 8px 20px 8px 20px;width: 100%;">Transfer to Bank - Rs.250 minimum in your wallet.</li>
												</ul></div></dd>
						</dl>
						
						
						<dl class="faq">
							<dt>Do I need to pay to use cropmybill.com?</dt>
							<dd class="answer"><div>No, cropmybill.com is a free cashback service provided to you. For using the site you do not have to pay anything.</div></dd>
						</dl>
						<dl class="faq">
							<dt>How to contact you?</dt>
							<dd class="answer"><div>You can mail us at care@cropmybill.com</div></dd>
						</dl>
						<dl class="faq">
							<dt>How long does it take for you to reply?</dt>
							<dd class="answer"><div> We respond to queries as soon as possible (usually within a few hours) but it may take upto 48 working hours to respond to your query.</div></dd>
						</dl>
						<dl class="faq">
							<dt>Why should I use cropmybill.com?</dt>
							<dd class="answer"><div> Unlike other cashback websites there is no minimum limit to redeem.</div></dd>
						</dl>
			
					</div>
				</div>
			</div>
		</div>
	</div>
	';
}
?>

<?php
if((isset($_SESSION['access_token'])) || (isset($_SESSION['signin_email'])) ||($user))
{
if(($through=='earning')||($through=='account')||($through=='redeem'))
{
	echo '
	<div style="padding: 0px 0px 14px 0px;">
		<div style="padding: 0px 0px 0px 0px;">
			<div id="menu" class="menu">
				<a class="afont" href="http://m.cropmybill.com/account"><div id="myacc" class="float">My Account</div></a>
				<a class="afont" href="http://m.cropmybill.com/earning"><div id="earning" class="float">Earnings</div></a>
				<a class="afont" href="http://m.cropmybill.com/redeem"><div id="redeem" class="float" >Redeem</div></a>
			</div>';
	if($through=='earning')
	{
		echo '
		<script>
		$("#earning").addClass("selected");
		</script>
		<style>
			table.earning tr:nth-child(odd) {
				
				background-color: #f1f1f1;
				border: 1px solid grey;
				border-collapse: collapse;
			}
			table.earning tr:nth-child(even) {
				
				background-color: #ffffff;
				border: 1px solid grey;
				border-collapse: collapse;
			}
			table.earning td:nth-child(odd) {
				border: 1px solid grey;
				border-collapse: collapse;
				padding: 15px 0px 10px 0px;
			}
			table.earning td:nth-child(even) {
				border: 1px solid grey;
				border-collapse: collapse;
				padding: 15px 0px 10px 0px;
			}
			table.earning {
				border: 1px solid grey;
				border-collapse: collapse;
				text-align:center;
				text-transform: uppercase;
				align:center;
				width:100%;
			}
			
		</style>';
		if(isset($_SESSION['access_token']))
		{
			$email		= $userData->email;
		}elseif(isset($_SESSION['signin_email']))
		{
			$email=$_SESSION['signin_email'];
		}
		else
		{
			$email= $user_profile['email'];
		}
		date_default_timezone_set("Asia/Kolkata");
		$today = date("Y-m-d");
		$conn_earning	= mysql_connect("localhost","arka_cropmybill","9735525775");
		mysql_select_db("arka_cropmybill", $conn_earning) ;
		$q = "SELECT pending,confirmed FROM login WHERE signup_email = '$email'";
		$re = mysql_query($q) ;
		$qre = mysql_fetch_array($re, MYSQL_ASSOC) ;
		//$temp = explode(" ",$qre['signup_name']);
		$confirmed = $qre['confirmed'];
		$pending = $qre['pending'];
		
		
		echo '
			<div style="background-color:white; width:100%;min-height: 600px;">
				<div class="earning_body" style="padding-bottom:50px;padding-top:6px;">';
					echo '
					<h2 align="left" style="font-weight: normal;margin-top: 15px;color:#1F68A5;margin-left:20px;font-family: Arial,Helvetica,sans-serif;">
					Your Earning Summary
					</h2>
					<h2 align="left" style="font-size:1.2em; font-style: italic;font-weight: normal;color:#5e7e9e;margin-left:40px;">
					<table>
					<tr>
					<td style="font-size:1.2em; font-weight: normal;color:#5e7e9e;margin-left:20px;font-family: latoregular,Arial,sans-serif;">Pending Cash</td><td style="padding-left: 30px; font-style: normal; font-size: 1.2em; color:#194775;font-family: sans-serif;">
						Rs. '.$pending.'</td></tr>
					<tr>
					<td style="font-size:1.2em; font-weight: normal;color:#5e7e9e;margin-left:20px;font-family: latoregular,Arial,sans-serif;">Confirmed Cash</td><td style="padding-left: 30px; font-style: normal; font-size: 1.2em; color:#194775;font-family: sans-serif;">
						Rs. '.$confirmed.'</td></tr></table>
					</h2>
					';
					$result = mysql_query("SELECT * FROM redirect3 WHERE session='$email' GROUP BY cname") or die("query1");
					$count=1;
					echo '
					<table class="earning">
					<tr>
					<td>ID</td>
					<td>Merchant</td>
					<td>Last Click</td>
					<td>Number of clicks</td>
					</tr>
					';
					WHILE($rows = mysql_fetch_array($result))
					{
						
						$product_name = $rows['cname'];
						$time = $rows['timestamp'];
						$result2=mysql_query("SELECT count(cname) as total from redirect3 WHERE cname='$product_name'");
						$data=mysql_fetch_assoc($result2);
						$clicks=$data['total'];
						echo '
						<tr>
						<td>'.$count.'</td>
						<td>'.$product_name.'</td>
						<td>'.$time.'</td>
						<td>'.$clicks.'</td></tr>
						';
						
						$count = $count+1;
					}
					echo '</table>';
					
					mysql_close($conn_earning);
					echo '
				</div>
			</div>';
	}	
	if($through=='account')
	{
		if(isset($_SESSION['access_token']))
		{
			$email		= $userData->email;
		}elseif(isset($_SESSION['signin_email']))
		{
			$email=$_SESSION['signin_email'];
		}
		else
		{
			$email= $user_profile['email'];
		}
		$conn_account	= mysql_connect("localhost","arka_cropmybill","9735525775");
		mysql_select_db("arka_cropmybill", $conn_account);
		$q = "SELECT signup_name,signup_phone FROM login WHERE signup_email = '$email'";
		$re = mysql_query($q);
		$qre = mysql_fetch_array($re, MYSQL_ASSOC);
		$original_name=$qre['signup_name'];
		$original_phone=$qre['signup_phone'];
		$temp = explode(" ",$qre['signup_name']);
		$signup_name = $temp[0];
		mysql_close($conn_account);
		echo '		
			<script>
			$("#myacc").addClass("selected");
			</script>
			<div style="background-color:white; width:100%;">
				<div class="myacc_body"  style="padding-bottom:50px;padding-top:6px;">
					<h2 align="left" style="font-size:1.5em; font-weight: normal;color:#1F68A5;margin-left:10px;font-family: Arial,Helvetica,sans-serif;">
						Welcome '.$signup_name.'
					</h2>
					<br>
					<table class="test">
					<form id="update" method="post">
						<tr>
						<td>Full Name</td>
						<td><input type="text" name="update_name" id="update_name" value="'.$original_name.'"/></td>
						</tr>
						<tr>
						<td>Email Address</td>
						<td><input type="text" name="update_eamil" id="update_eamil" value="'.$email.'" disabled/></td>
						</tr>
						<tr>
						<td>Phone Number</td>
						<td><input type="text" name="update_phone" id="update_phone" value="'.$original_phone.'"/></td>
						</tr>
						<tr>
						<td>New Password</td>
						<td><input type="password" name="update_pass" id="update_pass" value="ss"/></td>
						</tr>
						<tr>
						<td>Confirm Password</td>
						<td><input type="password" name="update_cPass" id="update_cPass"/></td>
						</tr>
						<tr>
						<td></td>
						<td><input style="height:160%;font-size:.8em;color:white;background-color:#194775;" type="button" name="update_account" id="update_account" value="Save Changes"/></td>
						</tr>
					</form>
					</table>
					
					<span id="update_error" style="float:left;color:red;display:none;">Please Provide Name</span>
					
					
					<script type="text/javascript">
					$(document).ready(function()
					{
						$("#update_account").click(function()
						{
							if($("#update_name").val()=="")
							{
								$("#update_error").show().html("Enter Name !").fadeOut( 2000 );
								$("#update_error").css("color","red");
								return false;
							} 
							else
							{
								var update_name = $("#update_name").val();
								
								
							}
							if($("#update_phone").val()=="")
							{
								$("#update_error").show().html("Enter Correct Phone Number!").fadeOut( 2000 );
								$("#update_error").css("color","red");
								return false;
							}
							else
							{
								var update_phone = $("#update_phone").val();
								
							}
							if($("#update_pass").val()=="")
							{
								$("#update_error").show().html("Enter Password!").fadeOut( 2000 );
								$("#update_error").css("color","red");
								return false;
							} 
							else
							{
								var update_pass = $("#update_pass").val();
								
								
							}
							if($("#update_cPass").val()=="")
							{
								$("#update_error").show().html("Re Enter Password!").fadeOut( 2000 );
								$("#update_error").css("color","red");
								return false;
							} 
							else
							{
								var update_cPass = $("#update_cPass").val();
								
								
							}
							if($("#update_cPass").val()!=$("#update_pass").val())
							{
								$("#update_error").show().html("Password Incorrect!").fadeOut( 2000 );
								$("#update_error").css("color","red"); 
								return false;
							} 
							var update_name = $("#update_name").val();
							var update_phone = $("#update_phone").val();
							var update_cPass = $("#update_cPass").val();
							var update_eamil = $("#update_eamil").val();
							jQuery.post("code.php", {update_name:update_name,update_phone: update_phone, update_cPass: update_cPass, update_eamil: update_eamil},
							function(data, textStatus)
							{
								if(data == 1)
								{
									window.location="http://m.cropmybill.com/account";
								}
								else
								{
									//window.location="error.php";
									$("#signup_error").html("this email already exists").show().fadeOut( 5000 );
									$("#signup_error").css("color","red");
									
								}
							});
						});
					});
					</script>
				</div>
			</div>';
	}
	if($through=='redeem')
	{
		if(isset($_SESSION['access_token']))
		{
			$email		= $userData->email;
		}elseif(isset($_SESSION['signin_email']))
		{
			$email=$_SESSION['signin_email'];
		}
		else
		{
			$email= $user_profile['email'];
		}
		$conn_redeem	= mysql_connect("localhost","arka_cropmybill","9735525775");
		mysql_select_db("arka_cropmybill", $conn_redeem);
		$q = "SELECT signup_name FROM login WHERE signup_email = '$email'";
		$re = mysql_query($q);
		$qre = mysql_fetch_array($re, MYSQL_ASSOC);
		$temp = explode(" ",$qre['signup_name']);
		$signup_name = $temp[0];
		mysql_close($conn_redeem);
		
		echo '	
		<script>
		$("#redeem").addClass("selected");
		</script>
		
		<div id="overlay" class="crop_dialog_overlay"></div>
		<div id="dialog" class="recharge_submit">
		<div style="width:100%;padding-left:20px;" align="left">
		<img width="70%" height="auto" align="center" src="http://cropmybill.com/img/logoPopup.png"/>
		<hr width="90%">
		
		</div>
		
		<div style="width:100%;" align="left">
		<p style="font-size: 1.4em;color: #34495e; font-weight:bold;">Congratulations '.$signup_name.'</p>
		</div>
		<div style="width:100%;" align="left">
		<p style="width:90%;font-size: 1.1em;color: #34495e;padding-left:20px;text-justify: inter-word;">We have received 
		your request. Your recharge will be processed within 48 working hours.</p>
		</div>
		</div>
		<!--bank transfer-->
		<div id="overlay2" class="crop_dialog_overlay"></div> 
		<div id="dialog2" class="recharge_submit">
		<div style="width:100%;padding-left:20px;" align="left">
		<img width="70%" height="auto" align="center" src="http://cropmybill.com/img/logoPopup.png"/>
		<hr width="90%">
		
		</div>
		
		<div style="width:100%;" align="left">
		<p style="font-size: 1.4em;color: #34495e; font-weight:bold;">Congratulations '.$signup_name.'</p>
		</div>
		<div style="width:100%;" align="left">
		<p style="width:90%;font-size: 1.1em;color: #34495e;padding-left:20px;text-justify: inter-word;">We have received 
		your request. Your transfer will be processed within 12 working days.</p>
		</div>
		</div>
				<div style="background-color:white; width:100%;">
					<div class="redeem_body" style="padding-bottom:50px;padding-top:0px;">
						<div style="margin-top: 40px;">
							<a id="phoneR" align="left" style="font-family: Arial,Helvetica,sans-serif;cursor:pointer;font-weight: normal;color:#1F68A5;float:left;">
								Recharge Phone
								<a style="cursor:pointer;margin-left:10%;"> | </a>
							</a>
							<a id="bankT" align="left" style="font-family: Arial,Helvetica,sans-serif;cursor:pointer;font-weight: normal;color:#1F68A5;float:right;">
								Transfer to Bank</a>
						</div>
						<div id="portal">
							<div style="height:20px;width:auto;">
								<span id="update_error"></span> 
							</div>
							<form id="recharge" name="recharge" class="phone_recharge" align="left">
						
								<input type="tel" name="re_phone" id="re_phone" placeholder="Enter Mobile Number" maxlength="10" onkeypress="return isNumberKey(event)"/>
								
								<select name="re_operator" id="re_operator">
								<option value="">Select Operator</option>
								<option value="Aircel">Aircel</option>
								<option value="Airtel">Airtel</option>
								<option value="BSLN">BSLN</option>
								<option value="Idea">Idea</option>
								<option value="MTNL">MTNL</option>
								<option value="MTS">MTS</option>
								<option value="Reliance CDMA">Reliance CDMA</option>
								<option value="Reliance GSM">Reliance GSM</</option>
								<option value="Tata Docomo">Tata Docomo</option>
								<option value="Tata Indicom">Tata Indicom</option>
								<option value="Uninor">Uninor</option>
								<option value="Videocon">Videocon</option>
								<option value="Virgin CDMA">Virgin CDMA</option>
								<option value="Virgin GSM">Virgin GSM</option>
								<option value="Vodafone">Vodafone</option></select>
								
								<input type="tel" name="re_amount" id="re_amount" placeholder="Enter Amount" maxlength="3" onkeypress="return isNumberKey(event)"/>
								<input type="hidden" name="re_email" id="re_email" value="'.$email.'"/>
								<br>
								<input style="margin-left:50%; width:100px;height:35px;font-size:1.1em;color:white;background-color:#194775;" type="button" name="recharge_submit" id="recharge_submit" value="Submit"/>
								<div id="hidden" style="display:none"> <input type="reset" value="reset"/></div>
								
							</form>
							
					<script type="text/javascript">
					$(document).ready(function()
					{
						$("#recharge_submit").click(function()
						{
							if($("#re_phone").val()<=999999999)
							{
								$("#update_error").show().html("Enter 10 digit Phone Number !").fadeOut( 2000 );
								$("#update_error").css("color","red");
								return false;
							} 
							else
							{
								var re_phone = $("#re_phone").val();
								
								
							}
							if($("#re_operator").val()=="")
							{
								$("#update_error").show().html("Enter Service Provider!").fadeOut( 2000 );
								$("#update_error").css("color","red");
								return false;
							}
							else
							{
								var re_operator = $("#re_operator").val();
								
							}
							if($("#re_amount").val()<=9)
							{
								$("#update_error").show().html("Enter Amount at least 10!").fadeOut( 2000 );
								$("#update_error").css("color","red");
								return false;
							} 
							else
							{
								var re_amount = $("#re_amount").val();
								
								document.getElementById("recharge").reset();
							}
							if($("#re_email").val()=="")
							{
								$("#update_error").show().html("Some Error Occurred").fadeOut( 2000 );
								$("#update_error").css("color","red");
								return false;
							} 
							else
							{
								var re_email = $("#re_email").val();
								
								
							}
							
							jQuery.post("code.php", {re_phone:re_phone,re_operator: re_operator, re_amount: re_amount, re_email:re_email},
							function(data, textStatus)
							{
								
								if(data == 1)
								{
									myFunction();
								}
								else if(data==2)
								{
									$("#update_error").html("Insufficient Balance").show().fadeOut( 15000 );
									
									
								}
								else
								{
									//window.location="error.php";
									$("#update_error").html("Unsuccessful").show().fadeOut( 5000 );
									$("#update_error").css("color","red");
									
								}
							});
						});
					});
					
						
						   
					  function myFunction (e)
					  {
						 ShowDialog(false);
						 e.preventDefault();
						 
					  }
						  
					   function ShowDialog(modal)
					   {
						  $("#overlay").show();
						  $("#dialog").fadeIn(300);

						  if (modal)
						  {
							 $("#overlay").unbind("click");
						  }
						  else
						  {
							 $("#overlay").click(function (e)
							 {
								HideDialog();
							 });
						  }
					   }

					   function HideDialog()
					   {
						  $("#overlay").hide();
						  $("#dialog").fadeOut(300);
					   } 
							
					</script>

						</div>
								
								
						<div id="portal_bank" style="display:none;">
						<div style="height:20px;width:auto;">
						<span id="update_error2"></span> </div>
							<form id="BankTransfer" class="bank_transfer" align="left">
								<input type="text" id="acc_holder" placeholder="Account Holders Name"/>
								<input type="tel" id="acc_number" placeholder="Account Number" onkeypress="return isNumberKey(event)"/>
								<input type="text" id="bank_name" placeholder="Bank Name"/>
								<input type="text" id="branch_name" placeholder="Branch Name"/>
								<input type="text" id="ifsc_code" placeholder="IFSC Code"/>
								<input type="tel" id="transfer_amount" placeholder="Amount" onkeypress="return isNumberKey(event)"/>
								<input type="hidden" id="bank_email" value="'.$email.'"/>
								<br>
								<input id="acc_submit" style="margin-left:45%; width:100px;height:35px;font-size:1.1em;color:white;background-color:#194775;" type="button" value="Submit"/>
								
							</form>
							<script type="text/javascript">
							$(document).ready(function()
							{
								$("#acc_submit").click(function()
								{
									if($("#acc_holder").val()=="")
									{
										$("#update_error2").show().html("Enter Correct Account Holder Name!").fadeOut( 2000 );
										$("#update_error2").css("color","red");
										return false;
									} 
									else
									{
										var acc_holder = $("#acc_holder").val();
										
										
									}
									if($("#acc_number").val()=="")
									{
										$("#update_error2").show().html("Enter Correct Account Numberr!").fadeOut( 2000 );
										$("#update_error2").css("color","red");
										return false;
									}
									else
									{
										var acc_number = $("#acc_number").val();
										
									}
									if($("#bank_name").val()=="")
									{
										$("#update_error2").show().html("Enter Bank Name!").fadeOut( 2000 );
										$("#update_error2").css("color","red");
										return false;
									} 
									else
									{
										var bank_name = $("#bank_name").val();
										
										
									}
									if($("#branch_name").val()=="")
									{
										$("#update_error2").show().html("Enter Branch Name").fadeOut( 2000 );
										$("#update_error2").css("color","red");
										return false;
									} 
									else
									{
										var branch_name = $("#branch_name").val();
										
										
									}
									if($("#ifsc_code").val()=="")
									{
										$("#update_error2").show().html("Enter IFSC code").fadeOut( 2000 );
										$("#update_error2").css("color","red");
										return false;
									} 
									else
									{
										var ifsc_code = $("#ifsc_code").val();
										
										
									}
									if($("#transfer_amount").val()<=249)
									{
										$("#update_error2").show().html("Enter Correct Amount").fadeOut( 2000 );
										$("#update_error2").css("color","red");
										return false;
									} 
									else
									{
										var transfer_amount = $("#transfer_amount").val();
										
										
									}
									if($("#bank_email").val()=="")
									{
										$("#update_error2").show().html("Some Error Occurred").fadeOut( 2000 );
										$("#update_error2").css("color","red");
										return false;
									} 
									else
									{
										var bank_email = $("#bank_email").val();
										
										document.getElementById("BankTransfer").reset();
									} 
									
									jQuery.post("code.php", {acc_holder:acc_holder,acc_number: acc_number, bank_name: bank_name, branch_name:branch_name,ifsc_code:ifsc_code,transfer_amount: transfer_amount,bank_email: bank_email},
									function(data, textStatus)
									{
										
										if(data == 1)
										{
											
											myFunction2(); 
											
										}
										else if(data==2)
										{
											$("#update_error2").html("Insufficient Balance").show().fadeOut( 15000 );
											
											$("#update_error2").css("color","red");
										}
										else
										{
											//window.location="error.php";
											$("#update_error2").html("Unsuccessful").show().fadeOut( 5000 );
											$("#update_error2").css("color","red");
											
										}
									});
								});
							});

							  function myFunction2 (e)
							  {
								 ShowDialog2(false);
								 e.preventDefault();
							  }
						   

							   function ShowDialog2(modal2)
							   {
								  $("#overlay2").show();
								  $("#dialog2").fadeIn(300);

								  if (modal2)
								  {
									 $("#overlay2").unbind("click");
								  }
								  else
								  {
									 $("#overlay2").click(function (e)
									 {
										HideDialog2();
									 });
								  }
							   }

							   function HideDialog2()
							   {
								  $("#overlay2").hide();
								  $("#dialog2").fadeOut(300);
							   } 
									
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>';
	}
}
}

?>
	<style>
		form.phone_recharge input {
		border-radius:4px;
		width:93%;
		height:40px;
		outline:none;
		margin:10px;
		font-size:1em;
		font-family:Cursive;
		
	}
	.phone_recharge input:focus{
	  border: solid 1px #34495e;
	  box-shadow: 0 0 5px 1px #5e7e9e;
	}
		</style>
	<style>
		form.bank_transfer input,select {
		border-radius:4px;
		width:93%;
		height:40px;
		outline:none;
		margin:10px;
		font-size:1.3em;
		font-family:Cursive;
		
		}
		.bank_transfer input:focus{
		  border: solid 1px #34495e;
		  box-shadow: 0 0 5px 1px #5e7e9e;
		}
	</style>
	<style>
		table.test td:nth-child(odd) {
			
			color :#5e7e9e;
			font-family: latoregular,Arial,sans-serif;
		}
		table.test td:nth-child(even) {
			margin: 0;
			
		}
		table.test input {
			border-radius:4px;
			height:132%;
			
			outline:none;
		}
		.test input:focus{
		  border: solid 1px #34495e;
		  box-shadow: 0 0 5px 1px #5e7e9e;
		  font-size:15px;
		}
		table.test {
			border-collapse: separate;
			*border-collapse: expression("separate", cellSpacing = "10px");
		}
	</style>
	<script>
		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
	</script>
	
						
	<script>
		$(document).ready(function()
			{
				$("#bankT").click(function()
				{
					$("#portal_bank").show();
					$("#portal").hide();
				});
				$("#phoneR").click(function()
				{
					$("#portal").show();
					$("#portal_bank").hide();
				});
			});
	</script>
	
	<!-- top row -->
<style>
	.circle_width {
		width:100%;
	}
	.circle_container {
		width: 100%;
		margin: 20px 0 0 0;
		min-height: 400px; 
	}
	.float_circle {
		float: right;

		position: relative;
		left: -50%; /* or right 50% */
		text-align: left;
		z-index:1;
	}
	.float_circle > .child_circle {
		position: relative;
		left: 50%;
	}
	
	.child_circle ul {
	  list-style-type: none;
	  margin:0;
	  padding:10px 0;
	}
	.child_circle ul {
	  float: left;
	  list-style-type: none;
	  margin: 0 6px;
	}
	.child_circle li {
	float: left;
	list-style-type: none;
	border-radius:50%;
	width: 50px;
	height: 50px;
	position:relative;
	margin: 0 10px 15px 10px;
	border:solid 5px #b8bbbc;
	-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;
	-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out;
	display:block;cursor:pointer;}
	  
	
	#img-1{background:url("http://cropmybill.com/img/circle/flipkart.png") 50% 50% no-repeat; 	background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-2{background:url("http://cropmybill.com/img/circle/snapdeal.png") 50% 50% no-repeat;	background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-3{background:url("http://cropmybill.com/img/circle/amazon.png") 50% 50% no-repeat;  	background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-4{background:url("http://cropmybill.com/img/circle/infibeam.png") 50% 50% no-repeat; 	background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-5{background:url("http://cropmybill.com/img/circle/jabong.png") 50% 50% no-repeat;   background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-6{background:url("http://cropmybill.com/img/circle/ebay.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-7{background:url("http://cropmybill.com/img/circle/paytm.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-8{background:url("http://cropmybill.com/img/circle/mobikwik.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-9{background:url("http://cropmybill.com/img/circle/lenskart.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-10{background:url("http://cropmybill.com/img/circle/printvenue.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-11{background:url("http://cropmybill.com/img/circle/yepme.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-12{background:url("http://cropmybill.com/img/circle/zivame.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-13{background:url("http://cropmybill.com/img/circle/zovi.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-14{background:url("http://cropmybill.com/img/circle/babyhugz.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-15{background:url("http://cropmybill.com/img/circle/fabfurnish.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-16{background:url("http://cropmybill.com/img/circle/homeshop18.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-17{background:url("http://cropmybill.com/img/circle/fashionara.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-18{background:url("http://cropmybill.com/img/circle/dogspot.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-19{background:url("http://cropmybill.com/img/circle/dailyobjects.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-20{background:url("http://cropmybill.com/img/circle/evok.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-21{background:url("http://cropmybill.com/img/circle/dominos.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-22{background:url("http://cropmybill.com/img/circle/airtel.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-23{background:url("http://cropmybill.com/img/circle/american-swan.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-24{background:url("http://cropmybill.com/img/circle/archies.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-25{background:url("http://cropmybill.com/img/circle/bewakoof.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-26{background:url("http://cropmybill.com/img/circle/biba.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-27{background:url("http://cropmybill.com/img/circle/book-my-flowers.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-28{background:url("http://cropmybill.com/img/circle/campus-sutra.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-29{background:url("http://cropmybill.com/img/circle/coke-2-home.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-30{background:url("http://cropmybill.com/img/circle/expedia.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-31{background:url("http://cropmybill.com/img/circle/fabindia.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-32{background:url("http://cropmybill.com/img/circle/giftalove.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-33{background:url("http://cropmybill.com/img/circle/gifts-by-meeta.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-34{background:url("http://cropmybill.com/img/circle/gifts-n-ideas.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-35{background:url("http://cropmybill.com/img/circle/healthkart.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-36{background:url("http://cropmybill.com/img/circle/indiatimes-shopping.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-37{background:url("http://cropmybill.com/img/circle/kapkids.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-38{background:url("http://cropmybill.com/img/circle/limeroad.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-39{background:url("http://cropmybill.com/img/circle/nykaa.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-40{background:url("http://cropmybill.com/img/circle/purplle.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-41{background:url("http://cropmybill.com/img/circle/foodpanda.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-42{background:url("http://cropmybill.com/img/circle/justeat.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-43{background:url("http://cropmybill.com/img/circle/koovs.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-44{background:url("http://cropmybill.com/img/circle/pepperfry.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-45{background:url("http://cropmybill.com/img/circle/shopclues.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-46{background:url("http://cropmybill.com/img/circle/travel-khana.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-47{background:url("http://cropmybill.com/img/circle/trend-in.png") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-48{background:url("http://cropmybill.com/img/circle/amar-chitra-katha.jpg") 50% 50% no-repeat; background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-49{background:url("http://cropmybill.com/img/circle/amzer.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-50{background:url("http://cropmybill.com/img/circle/artisan-gilt.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-51{background:url("http://cropmybill.com/img/circle/bag-it-today.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-52{background:url("http://cropmybill.com/img/circle/basics-life.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-53{background:url("http://cropmybill.com/img/circle/blue-stone.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-54{background:url("http://cropmybill.com/img/circle/shop-nineteen.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-55{background:url("http://cropmybill.com/img/circle/buy-n-brag.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-56{background:url("http://cropmybill.com/img/circle/candere.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-57{background:url("http://cropmybill.com/img/circle/crazy-florist.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-58{background:url("http://cropmybill.com/img/circle/creyate.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-59{background:url("http://cropmybill.com/img/circle/egle-shoes.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-60{background:url("http://cropmybill.com/img/circle/exciting-lives.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-61{background:url("http://cropmybill.com/img/circle/exclusively.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-62{background:url("http://cropmybill.com/img/circle/fab-alley.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-63{background:url("http://cropmybill.com/img/circle/freecultr.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-64{background:url("http://cropmybill.com/img/circle/floweraura.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-65{background:url("http://cropmybill.com/img/circle/ferns-n-petals.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-66{background:url("http://cropmybill.com/img/circle/flaberry.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-67{background:url("http://cropmybill.com/img/circle/flywidus.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-68{background:url("http://cropmybill.com/img/circle/gift-ease.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-69{background:url("http://cropmybill.com/img/circle/grab-more.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-70{background:url("http://cropmybill.com/img/circle/happily-unmarried.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}
	#img-71{background:url("http://cropmybill.com/img/circle/healthgenie.jpg") 50% 50% no-repeat; 		background-size:120%;-webkit-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;transition:all .4s ease-in-out}


</style>
<?php
if($through=='home')
{
//	<!--micro time-->

	if(isset($_SESSION['access_token']))
	{
		$session= $userData->email; 
	}elseif(isset($_SESSION['signin_email']))
	{
		$session=$_SESSION['signin_email'];
	}
	elseif($user)
	{
		$session= $user_profile['email'];
	}
	else
	{
		$session='anonymous';
	}
	
	$aff_date = date("YmdHis");
	
	echo '
	<div class="circle_width">
	<div class="circle_container">
	<div class="float_circle">
		<ul class="child_circle">
		<li id="img-1" >
			<!--Flipkart-->
			<a class="circle" href="crop.php?cname=flipkart&&ses='.$session.'&&url=http://dl.flipkart.com/dl/?affid=cropmybil&affExtParam1='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li> 
		<li id="img-2" > 
			<!--snapdeal V2D-->
			<a class="circle" href="crop.php?cname=snapdeal&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=110&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-3">
			<!--Amazon-->
			<a class="circle" href="crop.php?cname=amazon&&ses='.$session.'&&url=http://www.amazon.in/?_encoding=UTF8&camp=3626&creative=24822&linkCode=ur2&tag=cropmybillcom-21&linkId=4OV42M2TGYTXT2BF" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-5">
			<!--Jabong||V2D-->
			<a class="circle" href="crop.php?cname=jabong&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=126&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-11">
			<!--YepMe||V2D-->
			<a class="circle" href="crop.php?cname=yepme&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=102&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li> 
		<li id="img-7">
			<!--Paytm||V2D-->
			<a class="circle" href="crop.php?cname=paytm&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1022&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li> 
		<li id="img-6">
			<!--eBay||V2D-->
			<a class="circle" href="crop.php?cname=ebay&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1018&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li> 
		<li id="img-9">
			<!--Lenskart||V2D-->
			<a class="circle" href="crop.php?ts=cname=lenskart&&ses='.$session.'&&url=http://tracking.payoom.com/aff_c?offer_id=32&aff_id=8294&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li> 
		<li id="img-10">
			<!--PrintVenue||V2D-->
			<a class="circle" href="crop.php?cname=printvenu&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=228&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-4">
			<!--Infibeam-->
			<a class="circle" href="crop.php?cname=infibeam&&ses='.$session.'&&url=http://www.infibeam.com/?trackId=cropmybill" target="_blank"> 
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-21">
			<!--Dominos||V2D-->
			<a class="circle" href="crop.php?cname=dominos&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=180&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-41">
			<!--foodpanda||V2D-->
			<a class="circle" href="crop.php?cname=foodpanda&&ses='.$session.'&&url=http://tracking.payoom.com/aff_c?offer_id=101&aff_id=8294&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-42">
			<!--justeat||V2D-->
			<a class="circle" href="crop.php?cname=justeat&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=188&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-46">
			<!--travelkhana||V2D-->
			<a class="circle" href="crop.php?cname=travelkhana&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1016&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-22">
			<!--airtel||V2D-->
			<a class="circle" href="crop.php?cname=airtel&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1342&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-24">
			<!--archies||V2D-->
			<a class="circle" href="crop.php?cname=archies&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=727&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-27">
			<!--bookmyflowers||payoom-->
			<a class="circle" href="crop.php?cname=bookmyflowers&&ses='.$session.'&&url=http://tracking.payoom.com/aff_c?offer_id=110&aff_id=8294&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-32">
			<!--giftalove||V2D-->
			<a class="circle" href="crop.php?cname=giftalove&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1292&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-33">
			<!--giftsbymeeta ||V2D-->
			<a class="circle" href="crop.php?cname=giftsbymeeta&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1274&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-34">
			<!--giftsNideas||V2D-->
			<a class="circle" href="crop.php?cname=giftsNideas&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1346&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-12">
			<!--Zivame||V2D-->
			<a class="circle" href="crop.php?cname=zivame&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=100&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li> 
		<li id="img-13">
			<!--Zovi||V2D-->
			<a class="circle" href="crop.php?cname=zovi&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=480&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-16">
			<!--HomeShop18||V2D-->
			<a class="circle" href="crop.php?cname=homeshop18&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=402&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-45">
			<!--shopclues||V2D-->
			<a class="circle" href="crop.php?cname=shopclues&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=122&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-25">
			<!--bewakoof||V2D-->
			<a class="circle" href="crop.php?cname=bewakoof&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=879&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-35">
			<!--healthkart||V2D-->
			<a class="circle" href="crop.php?cname=healthkart&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1480&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-15">
			<!--Fabfurnish||V2D-->
			<a class="circle" href="crop.php?cname=fabfurnish&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1070&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-44">
			<!--pepperfry||V2D-->
			<a class="circle" href="crop.php?cname=pepperfry&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=52&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-17">
			<!--Fashionara||V2D-->
			<a class="circle" href="crop.php?cname=fashionara&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=386&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-19">
			<!--Dailyobjects||V2D-->
			<a class="circle" href="crop.php?cname=dailyobjects&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=542&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-47">
			<!--trendin||V2D-->
			<a class="circle" href="crop.php?cname=trendin&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=637&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-20">
			<!--Evok||V2D-->
			<a class="circle" href="crop.php?cname=evok&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1460&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-36">
			<!--indiatimesshopping||V2D-->
			<a class="circle" href="crop.php?cname=indiatimesshopping&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1060&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-23">
			<!--american swan||Payoom-->
			<a class="circle" href="crop.php?cname=american-swan&&ses='.$session.'&&url=http://tracking.payoom.com/aff_c?offer_id=28&aff_id=8294&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-26">
			<!--biba||V2D-->
			<a class="circle" href="crop.php?cname=biba&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1490&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-31">
			<!--fabindia||V2D-->
			<a class="circle" href="crop.php?cname=fabindia&&ses='.$session.'&&url=http://tracking.payoom.com/aff_c?offer_id=518&aff_id=8294&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-40">
			<!--purplle||V2D-->
			<a class="circle" href="crop.php?cname=purplle&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=236&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-43">
			<!--koovs||V2D-->
			<a class="circle" href="crop.php?cname=koovs&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=659&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-38">
			<!--limeroad||V2D-->
			<a class="circle" href="crop.php?cname=limeroad&&ses='.$session.'&&url=http://tracking.payoom.com/aff_c?offer_id=74&aff_id=8294&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-39">
			<!--nykaa||V2D-->
			<a class="circle" href="crop.php?cname=nykaa&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=232&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-14">
			<!--BabyHugz||V2D-->
			<a class="circle" href="crop.php?babyhugz&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1186&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-37">
			<!--kapkids||V2D-->
			<a class="circle" href="crop.php?cname=kapkids&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1078&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>	
		<li id="img-18">
			<!--DogSpot||V2D-->
			<a class="circle" href="crop.php?cname=dogspot&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1294&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2> 
			</a>
		</li>
		<li id="img-30">
			<!--expedia||V2D-->
			<a class="circle" href="crop.php?cname=expedia&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=779&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		
		<li id="img-48">
			<!--amar-chitra-katha||V2D-->
			<a class="circle" href="crop.php?cname=amar-chitra-katha&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=991&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-49">
			<!--Amzer||V2D-->
			<a class="circle" href="crop.php?cname=Amzer&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1236&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-50">
			<!--artisan-gilt||V2D-->
			<a class="circle" href="crop.php?cname=artisan-gilt&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1080&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-51">
			<!--bag-it-today||V2D-->
			<a class="circle" href="crop.php?cname=bag-it-today&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=871&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-52">
			<!--basics-life||V2D-->
			<a class="circle" href="crop.php?cname=basics-life&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=314&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-53">
			<!--blue-stone||V2D-->
			<a class="circle" href="crop.php?cname=blue-stone&&ses='.$session.'&&url=http://tracking.payoom.com/aff_c?offer_id=480&aff_id=8294&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-54">
			<!--Shopnineteen||V2D-->
			<a class="circle" href="crop.php?cname=Shopnineteen&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=985&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-55">
			<!--buy-n-brag||V2D-->
			<a class="circle" href="crop.php?cname=buy-n-brag&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=148&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-56">
			<!--Candere||V2D-->
			<a class="circle" href="crop.php?cname=Candere&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=504&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-57">
			<!--crazy-florist||V2D-->
			<a class="circle" href="crop.php?cname=crazy-florist&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=355&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-58">
			<!--Creyate||V2D-->
			<a class="circle" href="crop.php?cname=Creyate&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=1368&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-59">
			<!--Egle-Shoes||V2D-->
			<a class="circle" href="crop.php?cname=Egle-Shoes&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=848&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-60">
			<!--ExcitingLives||V2D-->
			<a class="circle" href="crop.php?cname=ExcitingLives&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1006&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-61">
			<!--Exclusively||V2D-->
			<a class="circle" href="crop.php?cname=Exclusively&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=513&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-62">
			<!--Fab-alley||V2D-->
			<a class="circle" href="crop.php?cname=Fab-alley&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=28&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-63">
			<!--FreeCultr||V2D-->
			<a class="circle" href="crop.php?cname=FreeCultr&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=66&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-64">
			<!--Floweraura||V2D-->
			<a class="circle" href="crop.php?cname=Floweraura&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=787&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-65">
			<!--Ferns-and-petals||V2D-->
			<a class="circle" href="crop.php?cname=Ferns-and-petals&&ses='.$session.'&&url=http://tracking.payoom.com/aff_c?offer_id=52&aff_id=8294&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-66">
			<!--flaberry||V2D-->
			<a class="circle" href="crop.php?cname=flaberry&&ses='.$session.'&&url=http://tracking.payoom.com/aff_c?offer_id=78&aff_id=8294&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-67">
			<!--flywidus||V2D-->
			<a class="circle" href="crop.php?cname=flywidus&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=228&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-68">
			<!--giftease||V2D-->
			<a class="circle" href="crop.php?cname=giftease&&ses='.$session.'&&url=http://tracking.vcmr.in/aff_c?offer_id=1126&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-69">
			<!--grabmore||V2D-->
			<a class="circle" href="crop.php?cname=grabmore&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=677&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-70">
			<!--Happily-unmarried||V2D-->
			<a class="circle" href="crop.php?cname=Happily-unmarried&&ses='.$session.'&&url=http://tracking.vcommission.com/aff_c?offer_id=1108&aff_id=36716&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		<li id="img-71">
			<!--Healthgenie||V2D-->
			<a class="circle" href="crop.php?cname=Healthgenie&&ses='.$session.'&&url=http://tracking.icubeswire.com/aff_c?offer_id=170&aff_id=9080&aff_sub='.$aff_date.'" target="_blank">
				<h2 style="width:50px;height:50px;margin-top: 0px;"></h2>
			</a>
		</li>
		
		</ul>
		</div>
		</div>
		</div>
		';
}
?>


    </section>
	<style>
	.main_container_deals {
		width: 70%;
		margin: 20px auto 0 auto;
		min-height: 400px;
	}
	.float_center {
		float: right;

		position: relative;
		left: -50%; /* or right 50% */
		text-align: left;
		z-index:1;
	}
	.float_center > .child_deals {
		position: relative;
		left: 50%;
	}
	.clear {
		clear:both;
	}
	.child_deals ul {
	  list-style-type: none;
	  margin:0;
	  padding:10px 0;
	}
	.child_deals ul {
	  float: left;
	  list-style-type: none;
	  margin: 0 6px;
	}
	.child_deals li {
	  float: left;
	  list-style-type: none;
	  margin: 10 25px;
	  
	  
	}
	.child_deals a {
		text-align:center;
		height: 26px;
		color:ffa319;
		line-height: 26px;
		font-family: Arial,Helvetica,sans-serif;
		text-decoration: none;
		text-transform: uppercase;
		background-color: transparent;
	}
	.dealsBox {
		width:150px;
		height:150px;
	}
	.textdiv {
		padding-top:100px;
		background-color:white;
		border: 2px solid #d0dde2;
	}
	</style>
	<?php
	if($through=='moredeals')
	{
		echo $frontpage;
		
		date_default_timezone_set("Asia/Kolkata");
		$today = date("Y-m-d");
		
		$con= mysql_connect("localhost","arka_cropmybill","9735525775") or die ("connection error");
		mysql_select_db("arka_cropmybill", $con) or die ("database not selected");
		$result=mysql_query("SELECT count(id) as total from coupons WHERE date >= '$today'");
		$data=mysql_fetch_assoc($result);
		$count=$data['total'];
		$count2 = $count;
		$q="SELECT cname,id,date FROM coupons WHERE date >= '$today' GROUP BY cname";
		$result = mysql_query($q) or die("query");
		
		WHILE(($rows = mysql_fetch_array($result))&&($count2>=0))
		{
			$id = $rows['id'];
			$product_name = $rows['cname'];
			
			echo '
			<style>
			#deaimg'.$id.'{ background:url("http://cropmybill.com/img/circle/'.$product_name.'.png") 100% 40%	 no-repeat transparent; background-size:100%;}
			</style>
			';
			$count2=$count2-1;
		}
		echo '
		
		
		<div class="main_container_deals">
			<div class="float_center">
			<ul class="child_deals">
		';
		$result = mysql_query($q) or die("query");
		WHILE(($rows = mysql_fetch_array($result))&&($count>=0))
		{
			$product_name = $rows['cname'];
			$id = $rows['id'];
			$date = $rows['date'];
			$count=$count-1;
			echo '
			<li>
				<a href="http://m.cropmybill.com/moredeals/'.$product_name.'">
					<div class="dealsBox">
						<div id="deaimg'.$id.'" class="textdiv"></div>Show Deals
					</div>
				</a>
			</li> ';
			}
		//echo $product_name[2];
		mysql_close($con);
		echo '
			
			</ul>
			<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div> ';
	}
	?>
	
	
	
	
	<!--website deals-->

	<style>
	#website_deals{
		overflow:hidden;
		width:100%;
		min-height:700px;
		background-color:#f2f2f2;
		z-index:3;
		
	}
	.deals1 {
		width:100%;
		min-height:150px;
		margin-left:1%;
		z-index:1;
		margin-bottom: 20px;
		display:table;
		background-color:white;
		box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
	
	}
	.deals_title{
		font-family:antialiased;
		font-family: Arial,Helvetica,sans-serif;
		font-weight:bold;
		font-size: 1em;
		padding: 6px 0px 10px 7px;
	}
	.deals_desc {
		padding: 0px 0px 15px 20px;
		font-size:1em;
		color:#888A8C;
	}
	.deals_click {
		float:left;
		display:none;
		height:15px;
		font-size:1em;
		margin: 0px 0px 15px 90px;
		background-color:#e47f31;
		border-radius:2px;
		padding: 5px 10px 5px 10px;
		font-family: latoregular,Arial,sans-serif;
	}
	.deals_click2 {
		float:left;
		display:block;
		height:20px;
		font-size:1em;
		margin: 0px 0px 15px 90px;
		background-color:#e47f31;
		border-radius:2px;
		padding: 5px 10px 5px 10px;
		font-family: latoregular,Arial,sans-serif;
	}
	.deals_discount {
		float:left;
		height:20px;
		color:#e47f31;
		font-size:0.9em;
		margin: 0px 0px 15px 90px;
		background-color:transparent;
		border: 1px dashed #e47f31;
		padding: 4px 10px 4px 10px;
		font-family: latoregular,Arial,sans-serif;
	}
	.deals_expire {
		float:right;
		margin: 10px 20px;
		font-size:0.8em;
		color:#ff1a35;
		font-family: latoregular,Arial,sans-serif;
	}
	.hoverdeals{
		text-decoration:none;
		color:white;
	}
	.headerdeals{
		margin-left:17%;
		font-size:1.8em;
		font-family: Arial,Helvetica,sans-serif;
		margin-bottom:30px;
		padding-top:10px;
		color:#585858;
		text-transform: uppercase;
	}
	
	#headerdeals_float {
		
		float:left;
	}
	.rightdiv {
		width:300px;
		height:auto;
		float:right;
		margin-right:1%;
		margin-bottom:20px;
	}
	.cname_image {
		background-color:white;
		width:150px;
		height:170px;
		border: 2px solid #d0dde2;
		box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
	}
	
	.notice_float {
		background-color:white;
		width:150px;
		height:170px;
		float:right;
		margin-right:10%;
		border: 2px solid #d0dde2;
		box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
	}
	
	.a_cname_image {
		text-decoration:none;
	}
	.cname_color {
		color:green;
		font-weight:bold;
		font-family: Arial,Helvetica,sans-serif;
		text-align:center;
		padding-top:8px;
	}
	
	
	.notice_right {
		width:300px;
		height:auto;
		background-color:white;
		margin-top:10px;
		font-family: Arial,Helvetica,sans-serif;
		font-style:italic;
		text-align: justify;
		text-justify: inter-word;
		border: 2px solid #d0dde2;
		box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
		color: #555;
		padding-bottom:15px;
	}
	
	.steps_right {
		width:300px;
		height:auto;
		background-color:white;
		margin-top:10px;
		font-family: Arial,Helvetica,sans-serif;
		text-align: justify;
		text-justify: inter-word;
		border: 2px solid #d0dde2;
		box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
		color: #555;
		padding-bottom:15px;
	}
	
	.notice_text {
		padding:15px 15px 0 15px;
	}
	
	.steps_text {
		padding:0px 15px 15px 15px;
	}
	
	.steps_bold {
		font-weight:bold;
		padding-left:15px;
	}
	</style> 
<?php
if($through=='true')
{
	
	echo $frontpage;
	
	
	date_default_timezone_set("Asia/Kolkata");
	$today = date("Y-m-d");
	
	$con= mysql_connect("localhost","arka_cropmybill","9735525775") or die ("connection error");
	mysql_select_db("arka_cropmybill", $con) or die ("database not selected");
	
	$q="SELECT * FROM coupons WHERE date >= '$today' AND cname='$brand' ";
	$result = mysql_query($q) or die("query");
	
	echo '
	<div id="website_deals">
		<div class="headerdeals"> '.$brand.' Deals</div>
		<div id="headerdeals_float">
		';
		
		WHILE($rows = mysql_fetch_array($result))
		{
			$url = $rows['url'];
			$desc = $rows['description'];
			$title = $rows['title'];
			$date = $rows['date'];
			
			echo '
			<div class="deals1">
				<div class="deals_title"> 
					'.$title.'
				</div>
				<div class="deals_desc">
				'.$desc.'
				</div>
				<div class="deals_click">
					<a class="hoverdeals" href="#"> Join Us to get offer</a>
				</div>
				<div class="deals_click2">
					<a class="hoverdeals" href="'.$url.'" target="_blank"> Click to activate offer</a>
				</div>
				<div class="deals_discount">
					Discount added automatically
				</div>
				<div class="deals_expire">
					Expire on '.$date.'
				</div>
			</div>
			';
		}
		echo '
		</div>
		<div class="rightdiv">
			
			<div class="notice_right">
				<div class="notice_text" style="font-weight:bold;font-style:normal;font-size:1.1em;text-align:center;">Please Note</div>
				<hr style="width:90%;">
				<div class="notice_text">Do not forget to login before purchasing and purchase in the same session.</div>
				<div class="notice_text">Do not visit any other coupon or price comparison site after clicking-out from CropmyBill.com.This ensures you get your cashback.</div>
				<div class="notice_text">Only use coupon codes available on CropmyBill(not those emailed or SMS`ed to you by '.$brand.' directly).</div>
			</div>
			<div class="steps_right">
				<div class="notice_text" style="font-weight:bold;font-style:normal;font-size:1.1em;text-align:center;">Steps for cashback</div>
				<hr style="width:90%;">
				<div class="steps_bold">Join Us</div>
					<div class="steps_text">Sign up on CropmyBill.com to create your account.</div>

				<div class="steps_bold">Shop via us </div>
					<div class="steps_text">Go to your preferred retailer through CropmyBill.com and shop like you normally do.</div>

				<div class="steps_bold">Redeem </div>
					<div class="steps_text">Once your cashback is confirmed either recharge your phone or transfer the money to your account</div>
			</div>
				
		</div>
	</div>
	';
}
?>
	
	
			<div id="complete" style="padding-right:5px;float:right;"></div>
			<div id="contact-us-email" style="float:right;padding-right:5px;display:none;background-color: #f2f2f2;position: relative;" align="right">
			<?php
			if(isset($_SESSION['access_token']))
			{
				$email		= $userData->email;
			}elseif(isset($_SESSION['signin_email']))
			{
				$email=$_SESSION['signin_email'];
			}
			else
			{
				$email= $user_profile['email'];
			}
			echo '
			
			<div style="height:20px;width:auto;">
			<label id="email_error" style="padding:0px 20px 0px 0px;float:right;"></label>
			<label id="text_error"></label>
			</div>
			<form  id="footer-contact-us" method="POST" class="cd-form" class="cd-form" style="width:166px; padding:0px;">		
			<input style="padding:6px 0px 6px 6px;width: 165px;" class="full-width has-border" id="footer_email" name="footer_email" type="email" value="'.$email.'" placeholder="E-mail"/>
			<textarea style="padding:6px 0px 6px 6px;" rows="6" class="full-width has-border" id="footer_text" name="footer_text" type="text" placeholder="Your Comments"></textarea>
			<input style="padding:6px 0px 6px 6px;background-color: #b7c3c7;" class="full-width has-border" id="footer_submit" name="footer_submit" value="submit" type="button" placeholder="Submit"/>
			</form>
			';
			?>
			<script type="text/javascript">
			$(document).ready(function()
			{
				$('#footer_submit').click(function()
				{
					if($('#footer_email').val()=="")
					{
						$('#email_error').show().html("Enter Email!").fadeOut( 2000 );
						$('#email_error').css('color','red');
						return false;
					} 
					else
					{
						var footer_email = $('#footer_email').val();
					}
					if($('#footer_text').val()=="")
					{
						$('#text_error').show().html("Please Give Comments!").fadeOut( 2000 );
						$('#text_error').css('color','red');
						return false;
					}
					else
					{
						var footer_text = $('#footer_text').val();
					}
					jQuery.post("code.php", {footer_email:footer_email,footer_text: footer_text},
					function(data, textStatus)
					{
						if(data == 1)
						{
							$('#complete').html("Thanks For Sharing!!").fadeOut( 5000 );
							$('#complete').css('color','green');
							$('#contact-us-email').hide();
							$('#contact-us-hide').show();
						}
						else
						{
							$('#complete').show().html("Network Error");
							$('#complete').css('color','red');
						}
					});
				});
			});
			</script>

		</div>
<style>
.footerclass {
	color: #b7c3c7;
	font-size: 12px;
	font-family: Arial,Helvetica,sans-serif;
	cursor:pointer;
	text-decoration: none;
	<!-- float:left; -->
}
#footer {
	
	background-color:#34495e;
	width:100%;float:left;
	height:100px;
	z-index:990;

}
</style>
</div>
<div id="footer">
	<div align="left" style="width:33%;float:left; margin-top:20px;">
		<a class="footerclass" href="http://m.cropmybill.com/">Home</a>
		<br>
		<a class="footerclass" href="http://m.cropmybill.com/about">About Us</a>
		<br>
		<a class="footerclass" href="http://m.cropmybill.com/faqs">FAQs</a></td>
	</div>
	
	<div align="center" style="width:33%;float:left; margin-top:20px;">
		<a class="footerclass" style="cursor:default;">Connect With Us</a>
		<div style="margin-top:5px">		
		<a href="http://facebook.com/cropmybill/" target="_blank" style="padding:5px;"><img width="20px" height="20px" src="http://cropmybill.com/img/footer_fb.png"/></a>
	<!--	<a href="http://facebook.com/cropmybill/" target="_blank" style="padding:5px;"><img width="20px" height="20px" src="http://cropmybill.com/img/footer_g+.png"/></a>
		<a href="http://facebook.com/cropmybill/" target="_blank" style="padding:5px;"><img width="20px" height="20px" src="http://cropmybill.com/img/footer_twitter.png"/></a>
	-->
		</div>
	</div>
	
	<div align="right" style="width:33%;float:right; margin-top:20px;">
		<div id="contact-us-hide"> <a class="footerclass" >Contact Us</a>
			</div>
			<br>
			<div style="color:#b7c3c7;margin-right:10px;font-size:10px;">or mail us : <span style="color:rgb(179, 216, 44);font-size:10px;">care@cropmybill.com</span></div>
			
	</div>
	
</div>

<script src="http://cropmybill.com/js/cropmybill.js"></script>
<script>
require("app/lib/js/snap"); 
require("app/js/mobile_snapper");
require("app/js/layout_manager");
require("app/js/slider");

</script>




</body>
</html>