<?php
date_default_timezone_set("Asia/Kolkata");
$client  		= @$_SERVER['HTTP_CLIENT_IP'];
$forward 		= @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  		= $_SERVER['REMOTE_ADDR'];
$browser		= $_SERVER['HTTP_USER_AGENT'];
$datestamp		= date('Y-m-d H:i:s');
$today = date("Y-m-d");
$aff_date = date("YmdHis");
$t = microtime(true);
$micro = sprintf("%06d",($t - floor($t)) * 1000000);
$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
$mTime = $d->format("Y-m-d H:i:s");
session_start();
$conn= mysql_connect("localhost","cropmybill","su4adu9ez") or die ("connection error");
mysql_select_db("suvankar_cropmybill", $conn) or die ("database not selected");
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
			setcookie('cmb_vld', '', time()-1000);
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
if(isset($_COOKIE['cmb_r']))
	{
		$refer_code = mysql_real_escape_string($_COOKIE['cmb_r']);
	}
	else
		$refer_code = '0000';
if($session==null)
{
	
	echo '
	<script>
	  function statusChangeCallback(response) {
		if (response.status === "connected") {
		  // Logged into your app and Facebook.
		  testAPI();
		} else if (response.status === "not_authorized") {
		  // The person is logged into Facebook, but not your app.
		  document.getElementById("status").innerHTML = "Please log " +
			"into this app.";
		} else {
		  document.getElementById("status").innerHTML = "Please log " +
			"into Facebook.";
		}
	  }
	  function checkLoginState() {
		FB.getLoginStatus(function(response) {
		  statusChangeCallback(response);
		});
	  }
	  window.fbAsyncInit = function() {
	  FB.init({
		appId      : "1558391157733323",
		cookie     : true,  // enable cookies to allow the server to access 
							// the session
		xfbml      : true,  // parse social plugins on this page
		version    : "v2.2" // use version 2.2
	  });
	  FB.getLoginStatus(function(response) {
		statusChangeCallback(response);
	  });
	  };
	  // Load the SDK asynchronously
	  (function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	  }(document, "script", "facebook-jssdk"));
	  // Here we run a very simple test of the Graph API after login is
	  // successful.  See statusChangeCallback() for when this call is made.
	  function testAPI() {
		FB.api("/me", function(response) {
		var p="email_fb="+response.email
			+"&name_fb="+response.name
			+"&id_fb="+response.id
			+"&icon_fb="+ "https://graph.facebook.com/" + response.id + "/picture";
			+"&gender_fb="+ response.gender
			+"&refer_code="+ "'.$refer_code.'"
			+"&client="+ "'.$client.'"
			+"&forward="+"'.$forward.'"
			+"&remote="+"'.$remote.'"
			+"&browser="+"'.$browser.'"
			+"&datestamp="+"'.$datestamp.'";
		var g="";
		var Li="/code.php";
		var el="signup_error";
		lod(g,p,Li,el);
		});
	  }
	  function out() {
		  FB.logout(function(response) {
			// Person is now logged out
			location.assign(location.href);
			});
	  }
	</script>
	';
}
$host='';
$port='';
$query='';
$scheme='';
$path='';
$client  		= @$_SERVER['HTTP_CLIENT_IP'];
$forward 		= @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  		= $_SERVER['REMOTE_ADDR'];
$browser		= $_SERVER['HTTP_USER_AGENT'];
$url			= $_SERVER["REQUEST_URI"];
$uri			= $url;
if(strpos($url,"?")>-1){
$a=explode("?",$url,2);
$url=$a[0];
$query=$a[1];
}
if(strpos($url,"://")>-1){
$scheme=substr($url,0,strpos($url,"//")-1);
$url=substr($url,strpos($url,"//")+2,strlen($url));
}
if(strpos($url,"/")>-1){
$a=explode("/",$url,2);
$url=$a[0];
$path="/".$a[1];
}
if(strpos($url,":")>-1){
$a=explode(":",$url,2);
$url=$a[0];
$port=$a[1];
}
$host=$url;
$url=null;
foreach(array("url","scheme","host","port","path","query") as $var){
if(!empty($var)){
$return[$var]=$var;
}
}
array("url"=>$uri,"scheme"=>$scheme,"host"=>$host,"port"=>$port,"path"=>$path,"query"=>$query,"a"=>$url);
//echo 'url='.$uri .'<br>scheme='. $scheme.'<br>host='.$host.'<br>port='.$port.'<br>path='.$path.'<br>query='.$query.'<br>url='.$url;
$temp=explode('&&',$query);
$tmp=explode('cname=',$temp[0]);
$cname = $tmp[1];
$tmp=explode('ses=',$temp[1]);
$sessn = $tmp[1];
$tmp=explode('urlo=',$temp[2]);
$reUrl = $tmp[1];
$temp=explode('&',$reUrl);
$aff_date = date("YmdHis");
if(isset($temp[3]))
{
	$temp=explode('=',$temp[3]);
	if($temp[0]=='aff_sub')
		$aff_sub=$temp[1];
	else
		$aff_sub='0';
}elseif(isset($temp[2]))
{
	$temp=explode('=',$temp[2]);
	if($temp[0]=='aff_sub')
		$aff_sub=$temp[1];
	else
		$aff_sub='0';
}elseif(isset($temp[1]))
{
	$temp=explode('=',$temp[1]);
	if($temp[0]=='affExtParam1')
		$aff_sub=$temp[1];
	else
		$aff_sub='0';
}
else
	$aff_sub='0';
$mysql_user 	= "cropmybill";
$mysql_pass 	= "su4adu9ez";
$mysql_database	= "suvankar_cropmybill";
$mysql_table 	= "redirect3";
$conn	=	mysql_connect("localhost",$mysql_user,$mysql_pass) or die ("connection error");
$query  = "create database if not exists $mysql_database";
mysql_query($query, $conn) or die ("database not created");
mysql_select_db($mysql_database, $conn) or die ("database not selected");
mysql_query("CREATE TABLE IF NOT EXISTS $mysql_table
		(
			ID int NOT NULL AUTO_INCREMENT,
			session varchar(50),
			cname varchar(20),
			aff_sub varchar(20),
			client varchar(20),
			remote varchar(20),
			forward varchar(300),
			browser varchar(300),
			reUrl varchar(300),
			timestamp varchar(20),
			PRIMARY KEY (ID)
		)") or die("Could not create table");
//header('Refresh: 0;url='.$reUrl.''); 
if($session!=null)
{
	header('Refresh: 0;url='.$reUrl.''); 
	mysql_query("INSERT INTO $mysql_table(session,cname,aff_sub,client,remote,forward,browser,reUrl,timestamp)
				   VALUES('$session','$cname','$aff_sub','$client','$remote','$forward','$browser','$reUrl','$mTime')") or die("not inserted into $mysql_table");
}else
{
	echo '
	<script src="/js.js"></script>
	<link rel="stylesheet" href="/styles.css">
	<div onclick="some2_2();" class="popup" id="popup_outer_2" style="display:block;">
	</div>
	<div style="background: transparent; display:block;" id="hide_total_2">
		<div onclick="some_2();" class="sign_container" id="sign_container_visible_2">
			<div class="sign_top_container">
				<div class="sign_in">
					<div class="sign_up_contain">
						<div onclick="vsbll_2(`sign_in_2`);" class="sign_in_left" id="sign_up_21">
							<div class="sign_margin">Sign In</div>
						</div>
						<div onclick="vsbll_2(`sign_up_2`);" class="sign_in_right" id="sign_in_21">
							<div class="sign_margin">Sign Up</div>
						</div>
					</div>
					<div class="sign_input_height" id="sign_in_2">
						<form method="POST">
							<input id="signin_email_2" class="sign_email ico_email" type="email" placeholder="&nbsp;&nbsp;&nbsp;E-mail"/>
							<input id="signin_password_2" class="sign_password ico_password" type="password" placeholder="&nbsp;&nbsp;&nbsp;Password"/>
								<a onclick="pass_hide1_2();" id="pass_hide11_2" style="color: #2f889a;text-decoration: none;cursor:pointer;" class="show_password">Show</a>
								<a onclick="pass_hide2_2();" id="pass_hide22_2" style="display:none;color: #2f889a;text-decoration: none;cursor:pointer;" class="show_password">Hide</a>
							<div>
							<input class="sign_remember" type="hidden" id="remember_me" checked=""/>
								<div id="sign_error_2" class="error_sign"></div>
							</div>
							<input id="signin_submit" onclick="sendin_2();" class="signin_submit" name="signin_submit" type="button" value="Login"/>
							<a onclick="vsbll_2(`popup_forgot_2`);" class="sign_forgot">forgot password?</a>
						</form>
						<div style="margin-left:40px;"><div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="false" data-auto-logout-link="false" scope="public_profile,email" onlogin="checkLoginState();"></div></div>
						
						<div id="signup_error" style="color:red;text-align: center;"></div>
						
					</div>
					<div class="signup_input_height" id="sign_up_2">
						<form method="post">
							<input id="signup_name_2" class="signup_name ico_name" type="text" placeholder="&nbsp;&nbsp;&nbsp;Name"/>
							<input id="signup_phone_2" class="signup_phone ico_phone" type="tel" placeholder="&nbsp;&nbsp;&nbsp;Phone"/>
							<input id="signup_email_2" class="sign_email ico_email" type="email" placeholder="&nbsp;&nbsp;&nbsp;E-mail"/>
							<input id="signup_password_2" class="sign_password ico_password" type="password" placeholder="&nbsp;&nbsp;&nbsp;Password"/>
								<a onclick="pass_hide11_2();" id="up_pass_hide11_2" style="color: #2f889a;text-decoration: none;cursor:pointer;" class="up_show_password">Show</a>
								<a onclick="pass_hide22_2();" id="up_pass_hide22_2" style="color: #2f889a;text-decoration: none;cursor:pointer;" class="up_hide_password">Hide</a>
								<div id="signup_error_2" class="error_sign"></div>
							<input onclick="sendup_2();" style="width: 153px;font-size: 18px;" class="signup_submit" id="signup_submit" name="signup_submit" type="button" value="Create Account"/>
						</form>
					</div>
					<div class="signup_forgot_height" id="popup_forgot_2">
						<div class="forgot_note">
							Lost your password? Please enter your email address. You will receive a link to create a new password.
						</div>
						<div id="forgot_errorl_2" class="error_forget"></div>
						<form method="post">
							<input id="reset_email_2" class="sign_email ico_email" type="email" placeholder="&nbsp;&nbsp;&nbsp;E-mail"/>
							<input onclick="sendforgot_2();" class="forgot_submit" id="forgot_submit" name="forgot_submit" type="button" value="Reset Password"/>
						</form>
						<a onclick="vsbll_2(`sign_in_2`);" class="sign_forgot">Back To Login</a>
					</div>
				</div>
				<div class="sign_welcome">
					<div class="welcome_head">
						Welcome at CropmyBill
					</div>
					<div class="welcome_note">
						Please <strong>login</strong> to earn <strong>cashback.</strong>
						<br>
						<br>
						Shop from over 500 online stores via <strong>CropmyBill.</strong>
						<br>
						<br>
						Get maximum <strong>cashback</strong> on every shopping.
						<br>
						<br>
						Get the <strong>best deals</strong> and <strong>latest coupons</strong> on exclusive range of products.
						<br>
						<br>
						<strong>CropmyBill.</strong> is 100% free to use.
					</div>
				</div>
			</div>
			<div class="popup_merchants" style="height:auto;" align="center">
				<a href="'.$reUrl.'" style="color:#fff;width:300px;text-align: center;background: #45a045;font-size: 13px;line-height: 32px;300px;display: block;" class="allfont">
				CONTINUE WITHOUT CASHBACK...
				</a>
			</div>
		</div>
	</div>
	';
	mysql_query("INSERT INTO $mysql_table(session,cname,aff_sub,client,remote,forward,browser,reUrl,timestamp)
				   VALUES('$sessn','$cname','$aff_sub','$client','$remote','$forward','$browser','$reUrl','$mTime')") or die("not inserted into $mysql_table");
}
mysql_close($conn);
?>
<script>
function clearAll_2() {
	document.getElementById('sign_in_2').style.display = "none";
	document.getElementById('sign_up_2').style.display = "none";
	document.getElementById('popup_forgot_2').style.display = "none";
}
function bgcolorl_2() {
	document.getElementById('sign_up_21').style.background = 'white';
	document.getElementById('sign_up_21').style.color = '#1669b0';
	document.getElementById('sign_in_21').style.background = 'white';
	document.getElementById('sign_in_21').style.color = '#1669b0';
}
function vsbll_2(a) {
	clearAll_2();
	bgcolorl_2();
	document.getElementById(a).style.display = "block";
	document.getElementById(a+'1').style.background = '#1669b0';
	document.getElementById(a+'1').style.color = 'white';
}
document.getElementById("sign_up_21").click();
function hide_popup_2() {
		document.getElementById('popup_outer_2').style.display = 'none';
}
function some_2() {
	document.getElementById('sign_container_visible_2').style.display = 'block';
}
function pass_hide1_2() {
	document.getElementById('signin_password_2').type = 'text';
	document.getElementById('pass_hide11_2').style.display = 'none';
	document.getElementById('pass_hide22_2').style.display = 'block';
}
function pass_hide2_2() {
	document.getElementById('signin_password_2').type = 'password';
	document.getElementById('pass_hide22_2').style.display = 'none';
	document.getElementById('pass_hide11_2').style.display = 'block';
} 
function pass_hide11_2() {
	document.getElementById('signup_password_2').type = 'text';
	document.getElementById('up_pass_hide11_2').style.display = 'none';
	document.getElementById('up_pass_hide22_2').style.display = 'block';
}
function pass_hide22_2() {
	document.getElementById('signup_password_2').type = 'password';
	document.getElementById('up_pass_hide22_2').style.display = 'none';
	document.getElementById('up_pass_hide11_2').style.display = 'block';
} 
function sendin_2(){
var p="signin_email="+document.getElementById("signin_email_2").value+"&signin_password="+document.getElementById("signin_password_2").value;
var g="";
var Li="/code.php";
var el="sign_error_2";
lod(g,p,Li,el);
}
function sendup_2(){
var p="signup_name="+document.getElementById("signup_name_2").value+"&signup_phone="+document.getElementById("signup_phone_2").value
		+"&signup_email="+document.getElementById("signup_email_2").value
		+"&signup_password="+document.getElementById("signup_password_2").value;
var g="";
var Li="/code.php";
var el="signup_error_2";
lod(g,p,Li,el);
}
function sendforgot_2(){
var p="reset_email="+document.getElementById("reset_email_2").value;
var g="";
var Li="/code.php";
var el="forgot_errorl_2";
lod(g,p,Li,el);
}
</script>