<?php
ini_set('session.cookie_lifetime', 24*60*60*30);
ini_set('session.gc-maxlifetime', 24*60*60*30);
session_start();
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
	$device_type = 'mobile';
}
else
	$device_type = 'web';
$conn= mysql_connect("localhost","arka_cropmybill","9735525775") or die ("connection error");
mysql_select_db("arka_cropmybill", $conn) or die ("database not selected");
if(isset($_COOKIE['cmb_r']) && ($_COOKIE['cmb_r'] != md5('0000')))
{
	$refer_code		=mysql_real_escape_string($_COOKIE['cmb_r']);
}else
	$refer_code 	='0000';
if(isset($_COOKIE['cmb_eml']) && isset($_COOKIE['cmb_vld']) && isset($_COOKIE['cmb_ssn']))
{
	$email_cookie = $_COOKIE['cmb_eml'];
	$id_cookie = $_COOKIE['cmb_vld'];
	$id_actual = $_COOKIE['cmb_ssn'];
	$id_actual = md5($id_actual+400);
	if($id_cookie == $id_actual)
	{
		$session = $email_cookie;
	}else
	{
		if (isset($_SERVER['HTTP_COOKIE'])) 
		{
			setcookie('cmb_vld', '', time()-1000, '/');
			setcookie('cmb_ssn', '', time()-1000, '/');
			/*
			$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			foreach($cookies as $cookie) 
			{
				$parts = explode('=', $cookie);
				$name = trim($parts[0]);
				setcookie($name, '', time()-1000);
				setcookie($name, '', time()-1000, '/');
				header("Location: /");
			}*/
		}
		$session = null;
	}
}else
{
	$session = null;
}
date_default_timezone_set("Asia/Kolkata");
$today = date("Y-m-d");
$aff_date = date("YmdHis");
//social login
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
		if(($refer_code != null)&&($refer_code != ''))
		{
			mysql_query("INSERT INTO refer(referral,referral_name,refer_code,client,forward,remote,browser,datestamp)
					VALUES('$email','$displayName','$refer_code','$client','$forward','$remote','$browser','$datestamp')");
		}
		$result = mysql_query("select ID from login where signup_email = '$email'");
		$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
		$signin_id_md5 = md5(420+$dbarray['ID']);
		$signin_id = ($dbarray['ID']+20);
		setcookie('cmb_eml', $email, time() + (24*60*60*30), "/");
		setcookie('cmb_vld',$signin_id_md5, time() + (24*60*60*30), "/");
		setcookie('cmb_ssn',$signin_id, time() + (24*60*60*30), "/");
		setcookie('cmb_nm', $given_name, time() + (24*60*60*30), "/");
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
		if ($email_fb == '')
		{
			echo '<script> alert("Your Facebook profile does not contain email address, please opt different login method");</script>';
			session_destroy();
		}
		else
		{
			mysql_query("INSERT INTO login(signup_email,signup_name,fname_fb,name_fb,id_fb,icon_fb,gender_fb,client,forward,remote,browser,datestamp)
					   VALUES('$email_fb','$name_fb','$fname_fb','$name_fb','$id_fb','$icon_fb','$gender_fb','$client','$forward','$remote','$browser','$datestamp')");
			if(($refer_code != null)&&($refer_code != ''))
			{
				mysql_query("INSERT INTO refer(referral,referral_name,refer_code,client,forward,remote,browser,datestamp)
						VALUES('$email_fb','$name_fb','$refer_code','$client','$forward','$remote','$browser','$datestamp')");
			}
			$result = mysql_query("select ID from login where signup_email = '$email_fb'");
			$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
			$signin_id_md5 = md5(420+$dbarray['ID']);
			$signin_id = ($dbarray['ID']+20);
			setcookie('cmb_eml', $email_fb, time() + (24*60*60*30), "/");
			setcookie('cmb_vld', $signin_id_md5, time() + (24*60*60*30), "/");
			setcookie('cmb_ssn', $signin_id, time() + (24*60*60*30), "/");
			setcookie('cmb_nm', $id_fb, time() + (24*60*60*30), "/");
			$_SESSION['signin_email']=$email_fb;
			$session=$email_fb;
			$fb_re = explode('?',getenv ("REQUEST_URI"));
			if(isset($fb_re[1]))
			{
			header("Location: http://cropmybill.com/contest/");
			}
		}
	}
}
?>