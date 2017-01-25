<?php
ini_set('session.cookie_lifetime', 24*60*60*30);
ini_set('session.gc-maxlifetime', 24*60*60*30);
session_start();
if(isset($_COOKIE['SD']) && isset($_SESSION['signin_email']))
{
	if(($_COOKIE['SD']) == $_SESSION['signin_email'])
	{
		$session = $_SESSION['signin_email'];
	}else
	{
		if (isset($_SERVER['HTTP_COOKIE'])) 
		{
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) 
			{
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
				header("Location: /");
			}
		}
		$session = null;
	}
}else
{
	$session = null;
}
//echo 'session='.($_SESSION['signin_email']).'<br>';
//echo 'cookie='.($_COOKIE['SD']).'<br>';
date_default_timezone_set("Asia/Kolkata");
$today = date("Y-m-d");
$aff_date = date("YmdHis");
$conn= mysql_connect("localhost","arka_cropmybill","9735525775") or die ("connection error");
mysql_select_db("arka_cropmybill", $conn) or die ("database not selected");
//social login
//require_once( '/src/facebook.php');
require_once '/home/arka/public_html/src/facebook.php';
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
	//define(ROOT, '/home/arka/public_html');
	require_once '/home/arka/public_html/autoload.php';
	//require_once( 'autoload.php' );
	$client_id = '804877435392-iaglqddvpqvm268ag48no56ovb5ha0do.apps.googleusercontent.com';
	$client_secret = 'qIJN80ryuToDDrmMuZXOEe2B';
	$redirect_uri = 'http://cropmybill.com/index.php'; 
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
if($session==null)
{
	if((isset($_SESSION['access_token']))&&($userData))
	{
		$me			= $plus->people->get('me');
		$displayName= $me['displayName'];
		$G_IMG_URL	= $me['image']['url'];
		$given_name	= $userData->given_name;
		$ID			= $userData->id;
		$gender		= $userData->gender;
		$email		= $userData->email;
		$client  		= @$_SERVER['HTTP_CLIENT_IP'];
		$forward 		= @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  		= $_SERVER['REMOTE_ADDR'];
		$browser		= $_SERVER['HTTP_USER_AGENT'];
		$datestamp		= date('Y-m-d H:i:s');
		mysql_query("INSERT INTO login(signup_email,signup_name,fname_google,name_google,ID_google,icon_google,gender_google,client,forward,remote,browser,datestamp)
			       VALUES('$email','$displayName','$given_name','$displayName','$ID','$G_IMG_URL','$gender','$client','$forward','$remote','$browser','$datestamp')");
		setcookie('SD', $email, time() + (24*60*60*30), "/");
		setcookie('name', $given_name, time() + (24*60*60*30), "/");
		$_SESSION['signin_email']=$email;
		$session=$email;
	}
	elseif(isset($user_profile))
	{
		//echo $loginUrl;
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
		mysql_query("INSERT INTO login(signup_email,signup_name,fname_fb,name_fb,id_fb,icon_fb,gender_fb,client,forward,remote,browser,datestamp)
			       VALUES('$email_fb','$name_fb','$fname_fb','$name_fb','$id_fb','$icon_fb','$gender_fb','$client','$forward','$remote','$browser','$datestamp')");
		setcookie('SD', $email_fb, time() + (24*60*60*30), "/");
		setcookie('name', $fname_fb, time() + (24*60*60*30), "/");
		$_SESSION['signin_email']=$email_fb;
		$session=$email_fb;
		$fb_re = explode('?',getenv ("REQUEST_URI"));
		if(isset($fb_re[1]))
		{
		header("Location: /");
		}
	}
}
$throw='';
$requri = getenv ("REQUEST_URI");
$url = explode('/', $requri);
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
<style>
#outlet_container{
	
	position: relative;
}
#outlet_container:after {
    content : "";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    background:url("/images/bs-overlay.png");
    width: 100%;
    height: 100%;
    opacity : 0.3;
    z-index: -1;
}
#outlet_top {
	height:400px;
	width:100%;
	background-color:gray;
}
#outlet_wrap {
	min-height:726px;
	width:1152px;
	background:blue;
	margin-left:auto;
	margin-right:auto;
	margin-top: 10px;
	margin-bottom: 10px;
}
#top_writeup {
	width:1152px;
	height:354px;
	margin-left:auto;
	margin-right:auto;
	position:relative;
	bottom:0px;
}
#writeup_bottom {
	bottom:0px;
	height:120px;
	width:300px;
	background:blue;
	position:absolute;
}
.outlet_box {
	width:352px;
	height:255px;
	background:red;
	float:left;
	margin-left:24px;
	margin-bottom: 24px;
	
}
.box_pic {
	background:gray;
	width:352px;
	height:160px;
	position:relative;
	bottom:0px;
}
.bar_specs {
	bottom:0px;
	position:absolute;
	width:218px;
	height:60px;
	background:green;
	
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
		include('/home/arka/public_html/inc/h.php');
		include('/home/arka/public_html/inc/m.php'); 
	?>
<div id="outlet_container">
	<div id="outlet_top">
		<div id="top_writeup">
			<div id="writeup_bottom">
				Hookah Bars
			</div>
		</div>
	</div>
	<div id="outlet_wrap">
		<div class="outlet_box">
			<div class="box_pic">
				<div class="bar_specs">
					<div>Bistro By The Park</div>
					<div>Park Street Area</div>
				</div>
			</div>
			<div>Italian, Continental, Cafe</div>
			<div>Cost for two: Rs. 1000</div>
			<div>122 reviews for 2 outlets</div>
		</div>
		<div class="outlet_box">
			<div class="box_pic">
				<div class="bar_specs">
					<div>Bistro By The Park</div>
					<div>Park Street Area</div>
				</div>
			</div>
			<div>Italian, Continental, Cafe</div>
			<div>Cost for two: Rs. 1000</div>
			<div>122 reviews for 2 outlets</div>
		</div>
		<div class="outlet_box">
			<div class="box_pic">
				<div class="bar_specs">
					<div>Bistro By The Park</div>
					<div>Park Street Area</div>
				</div>
			</div>
			<div>Italian, Continental, Cafe</div>
			<div>Cost for two: Rs. 1000</div>
			<div>122 reviews for 2 outlets</div>
		</div>
		<div class="outlet_box">
			<div class="box_pic">
				<div class="bar_specs">
					<div>Bistro By The Park</div>
					<div>Park Street Area</div>
				</div>
			</div>
			<div>Italian, Continental, Cafe</div>
			<div>Cost for two: Rs. 1000</div>
			<div>122 reviews for 2 outlets</div>
		</div>
	</div>
</div>
	<?php include('/home/arka/public_html/inc/footer.php') ?>
<?php
mysql_close($conn);
?>
</body>
</html>