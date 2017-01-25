<script>
/*  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-66288571-1', 'auto');
  ga('send', 'pageview');
*/
</script>
<script src="/js.js"></script>
<style>
a, a:hover, a:visited, a:link
{
	text-decoration:none;
}
.headerback
{
	background-color:#1f4987;
	min-width:1152px;
}
.cont
{
	width:1000px;
	margin-left:auto;
	margin-right:auto;
	clear:both;
	background-color:#1f4987;
}
.header
{
	display:table;
	height:90px;
	width:1000px;
	background-color:#1f4987;
}
.joinus
{
	height:36px;
	padding-left:15px;
	padding-right:15px;
	line-height:36px;
	vertical-align:middle;
	margin-top:27px;
	background:#f5f5f5;
	border-radius:6px;
	color:#1f4987;
	font-weight:700;
}
.referbox
{
	height:36px;
	padding-left:15px;
	padding-right:15px;
	line-height:36px;
	vertical-align:middle;
	margin-top:27px;
	border:1px solid #fdd922;
	border-radius:6px;
	color:fdd922;
}
.links
{
	float:right;
}
.picture  a img
{
	border-radius:20px;
	margin-top:25px;
}
.ablock
{
	float:left;
	width:206px;
	padding-right:8px;
	margin-top:0px;
}
.ablock>a>img:hover
{
	opacity:0.7;
}
.allstores
{
	font-weight:500;
	font-size:14px;
	font-family:'Open Sans',Arial, Helvetica, sans-serif;
	float:left;
	margin-right:15px;
	margin-left:15px;
	line-height:90px;
	vertical-align:middle;
	color:white;
}
.refer
{
	font-weight:700;
	font-size:14px;
	font-family:'Open Sans',Arial, Helvetica, sans-serif;
	float:left;
	margin-right:20px;
	margin-left:20px;
	line-height:90px;
	vertical-align:middle;
	color:#fdd922;
}
.refer a
{
	color:#fdd922;
}
.allstores a:hover
{
	color:#fdd922;
}
.allstores a
{
	color:white;
}
.dropbutton
{
	padding-bottom:10px;
}
#picbutt div
{
	padding-bottom:10px;
}
#picdrop:hover
{
	display:block;
}
#picdrop
{
	display:none;
}
#picbutt:hover + #picdrop
{
	display:block;
}
#dropdiv:hover
{
	display:block;
}
#dropdiv
{
	display:none;
}
#dropdown-button:hover + #dropdiv
{
	display:block;
}
.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  font-size: 14px;
  text-align: left;
  list-style: none;
  background-color: #fff;
  -webkit-background-clip: padding-box;
          background-clip: padding-box;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, .15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
          box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}
.dropdown-menu
{
	top:60px;
	left:-25px;
}
.dropdown {
  position: relative;
}
.dropdown-menu:hover;
{
	display:block;
}
.dropdown-menu > li > a {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.42857143;
  color: #333;
  white-space: nowrap;
}
.dropdown-menu > li > a:hover,
.dropdown-menu > li > a:focus {
  color: #262626;
  text-decoration: none;
  background-color: #f5f5f5;
}
.dropdown-menu-right {
  right: 0;
  left: auto;
  top:70px;
}
.caret {
  display: inline-block;
  width: 0;
  height: 0;
  margin-left: 2px;
  vertical-align: middle;
  border-top: 4px solid;
  border-right: 4px solid transparent;
  border-left: 4px solid transparent;
}
</style>
<?php 
if ($session == null)
{
	if(isset($_GET['ref']))
	{
		echo '<script>SC("cmb_r", "'.$_GET['ref'].'", 1);</script>';
		$refer_cookie = 'yes';
		$refer_code = $_GET['ref'];
	}
	else
	{
		if(isset($_COOKIE['cmb_r']))
		{
			if($_COOKIE['cmb_r'] != md5('0000'))
			{	
				$refer_cookie_set = 'set';
				$refer_code = $_COOKIE['cmb_r'];
			}
			else
			{
				echo '<script>SC("cmb_r", "'.md5('0000').'", 30);</script>';
				$refer_code = '0000';
			}
		}
		else
		{
			echo '<script>SC("cmb_r", "'.md5('0000').'", 30);</script>';
			$refer_code = '0000';
		}
	}
}
?>
<?php
/*
$temp = explode(" ",$_COOKIE['cmb_nm']);
$name = $temp[0];
$name = str_replace("<script>","",$name); 
$name = str_replace("</script>","",$name); 
$name = preg_replace('/[^A-Za-z0-9\-]/', '', $name); 
$name = ($_COOKIE['cmb_nm']);*/
?>
		<div class="headerback">
			<div class="cont">
				<div class="header">
					<div id="logo-floater" class="ablock">
						<a href="/">
							<img src="/img/253.png" width=200px height=80px;/>
						</a>
					</div>
					<div class="links">
						<div class="allstores">
							<a href="/allstore/">
								ALLSTORES
							</a>
						</div>
						<div class="allstores">
							<div class="dropdown">
								<a class="dropdown-toggle dropbutton" style="cursor:pointer;" id="dropdown-button" data-toggle="dropdown" role="button" aria-expanded="false">
									CATEGORIES<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" id="dropdiv" role="menu">
									<li><a href="/usearch/Clothing & Accessories/">Clothing & Accessories</a></li>
									<li><a href="/usearch/Electronics/">Electronics</a></li>
									<li><a href="/usearch/Recharge & Top Up/">Recharge & Top Up</a></li>
									<li><a href="/usearch/Flowers & Gifts/">Flowers & Gifts</a></li>
									<li><a href="/usearch/Footwear/">Footwear</a></li>
									<li><a href="/usearch/Food & Drink/">Food & Drink</a></li>
									<li><a href="/usearch/Travel & Vacations/">Travel & Vacations</a></li>
									<li><a href="/usearch/Baby Products & Toy/">Baby Products & Toy</a></li>
									<li><a href="/usearch/Jewellery/">Jewellery</a></li>
									<li><a href="/usearch/Health & Beauty/">Health & Beauty</a></li>
									<li><a href="/usearch/Home & Kitchen/">Home & Kitchen</a></li>
									<li><a href="/usearch/Books & Stationary/">Books & Stationary</a></li>
									<li><a href="/usearch/Pets/">Pets</a></li>
									<li><a href="/usearch/Eyewear/">Eyewear</a></li>
									<li><a href="/usearch/Others/">Others</a></li>
								</ul>
							</div>
						</div>
						<div class="allstores">
							<a href="/deals/">
								DEALS
							</a>
						</div>
						<div class="allstores">
							<a href="/coupons/">
								COUPONS
							</a>
						</div>
						<div class="allstores refer">
							<a href="/refer">
								<div class="referbox">
									REFER & EARN
								</div>
							</a>
						</div>
						<?php
						if($session==null) {
						echo '
						<div class="allstores" style="margin-right:0px;">
							<a>
								<div class="joinus" onClick="joinus();" style="cursor:pointer;">
									JOIN US
								</div>
							</a>
						</div>
						 ';
						} 
						else
						{
						$logout = getenv ("REQUEST_URI");
						if(isset($_COOKIE['cmb_nm']) && is_numeric($_COOKIE['cmb_nm']))
						{
							$icon = 'https://graph.facebook.com/'.$_COOKIE['cmb_nm'].'/picture';
						}
						else
							$icon = '/img/dp.png';
						//copy("https://graph.facebook.com/782674271821636/picture","E:/DWD/xampp/htdocs/cropNew/img/100002372119019.jpg");
						echo '
						<div class="allstores" style="margin-right:0px;">
							<div class="dropdown">
								<div class="picture">
									<a class="dropdown-toggle" id="picbutt" data-toggle="dropdown" role="button" aria-expanded="false">
										<div><img src="'.$icon.'" width=40px height=40px style="cursor:pointer;"></div>
									</a>
									<ul class="dropdown-menu dropdown-menu-right" id="picdrop" role="menu">
										<li><a href="/account">My Account</a></li>
										<li><a href="/earning">Earning</a></li>
										<li><a href="/redeem">Redeem</a></li>
										<li><a href="/logout.php?log='.$logout.'" style="border-bottom:0px solid black;">Logout</a></li>
									</ul>
								</div>
							</div>
						</div>
						';
						}
						?>
					</div>
				</div>
			</div>
		</div>
<script>
function toggle() {
	toggle_visibility("dd_container");
}
function toggle_visibility(id) 
    {
        var e = document.getElementById(id);
        if ( e.style.display == 'block' )
            e.style.display = 'none';
        else
            e.style.display = 'block';
    }
function joinus() {
	document.getElementById('popup_outer').style.display = 'block';
	document.getElementById('sign_container_visible').style.display = 'block';
	document.getElementById('hide_total').style.display = 'block';
}
function clearAll() {
	document.getElementById('sign_in').style.display = "none";
	document.getElementById('sign_up').style.display = "none";
	document.getElementById('popup_forgot').style.display = "none";
}
function bgcolor() {
	document.getElementById('sign_up1').style.background = 'white';
	document.getElementById('sign_up1').style.color = '#1669b0';
	document.getElementById('sign_in1').style.background = 'white';
	document.getElementById('sign_in1').style.color = '#1669b0';
}
function vsbl(a) {
	clearAll();
	bgcolor();
	document.getElementById(a).style.display = "block";
	document.getElementById(a+'1').style.background = '#1669b0';
	document.getElementById(a+'1').style.color = 'white';
}
function hide_popup() {
		document.getElementById('popup_outer').style.display = 'none';
}
function some() {
	document.getElementById('sign_container_visible').style.display = 'block';
}
function some2() {
	document.getElementById('popup_outer').style.display = 'none';
	document.getElementById('sign_container_visible').style.display = 'none';
	document.getElementById('hide_total').style.display = 'none';
}
document.onkeydown = function (evt) {
	evt = evt || window.event;
	if(evt.keyCode == 27)
	{
		some2();
	}
}
function pass_hide1() {
	document.getElementById('signin_password').type = 'text';
	document.getElementById('pass_hide11').style.display = 'none';
	document.getElementById('pass_hide22').style.display = 'block';
}
function pass_hide2() {
	document.getElementById('signin_password').type = 'password';
	document.getElementById('pass_hide22').style.display = 'none';
	document.getElementById('pass_hide11').style.display = 'block';
} 
function pass_hide11() {
	document.getElementById('signup_password').type = 'text';
	document.getElementById('up_pass_hide11').style.display = 'none';
	document.getElementById('up_pass_hide22').style.display = 'block';
}
function pass_hide22() {
	document.getElementById('signup_password').type = 'password';
	document.getElementById('up_pass_hide22').style.display = 'none';
	document.getElementById('up_pass_hide11').style.display = 'block';
} 
function sendin(){
var p="signin_email="+document.getElementById("signin_email").value+"&signin_password="+document.getElementById("signin_password").value;
var g="";
var Li="/code.php";
var el="sign_error";
lod(g,p,Li,el);
}
function sendup(){
var p="signup_name="+document.getElementById("signup_name").value+"&signup_phone="+document.getElementById("signup_phone").value
		+"&signup_email="+document.getElementById("signup_email").value
		+"&refer_code="+document.getElementById("refer_code").value
		+"&signup_password="+document.getElementById("signup_password").value;
var g="";
var Li="/code.php";
var el="signup_error";
lod(g,p,Li,el);
}
function sendforgot(){
var p="reset_email="+document.getElementById("reset_email").value;
var g="";
var Li="/code.php";
var el="forgot_error";
lod(g,p,Li,el);
}
</script>
<div onclick="some2();" class="popup" id="popup_outer">
</div>
<div style="background: transparent;" id="hide_total">
	<div onclick="some();" class="sign_container allfont" id="sign_container_visible">
		<div class="sign_top_container">
			<div class="sign_in">
				<div class="sign_up_contain allfont">
					<div onclick="vsbl('sign_in');" class="sign_in_left" id="sign_up1">
						<div class="sign_margin">Sign In</div>
					</div>
					<div onclick="vsbl('sign_up');" class="sign_in_right" id="sign_in1">
						<div class="sign_margin">Sign Up</div>
					</div>
				</div>
				<div class="sign_input_height" id="sign_in">
					<form method="POST">
						<input id="signin_email" class="sign_email ico_email" type="email" value="<?php if(isset($_COOKIE['cmb_eml'])) {echo $_COOKIE['cmb_eml'];}?>" placeholder="&nbsp;&nbsp;&nbsp;E-mail"/>
						<input id="signin_password" class="sign_password ico_password" type="password" placeholder="&nbsp;&nbsp;&nbsp;Password"/>
							<a onclick="pass_hide1();" id="pass_hide11" style="color: #2f889a;text-decoration: none;cursor:pointer;" class="show_password noselect">Show</a>
							<a onclick="pass_hide2();" id="pass_hide22" style="display:none;color: #2f889a;text-decoration: none;cursor:pointer;" class="show_password noselect">Hide</a>
						<div>
						<input class="sign_remember" type="hidden" id="remember_me" checked=""/>
							<div id="sign_error" class="error_sign"></div>
						</div>
						<input id="signin_submit" onclick="sendin();return false;" class="signin_submit" name="signin_submit" type="submit" value="Login"/>
						<a onclick="vsbl('popup_forgot');" class="sign_forgot">forgot password?</a>
					</form>
					<a href="<?php echo $loginUrl; ?>">
						<div class="social_btn2">
							<div class="share_fb_ico"></div>
							<div class="share_trans_fb">
								<div style="width:130px;height:40px;">
									<span class="social_name">Facebook</span>
								</div>
							</div>
						</div>
					</a>
					<a href="<?php echo $authUrl; ?>">
						<div class="social_btn2">
							<div class="share_gp_ico"></div>
							<div class="share_trans_goo">
								<div style="width:130px;height:40px;">
									<span class="social_name">Google+</span>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="signup_input_height" id="sign_up">
					<form method="post">
						<input id="signup_name" class="signup_name ico_name" type="text" placeholder="&nbsp;&nbsp;&nbsp;Name"/>
						<input id="signup_phone" class="signup_phone ico_phone" type="tel" placeholder="&nbsp;&nbsp;&nbsp;Phone"/>
						<input id="signup_email" class="sign_email ico_email" type="email" placeholder="&nbsp;&nbsp;&nbsp;E-mail"/>
						<input id="signup_password" class="sign_password ico_password" type="password" placeholder="&nbsp;&nbsp;&nbsp;Password"/>
						<input id="refer_code" type="hidden" value="<?php echo $refer_code; ?>"/>
							<a onclick="pass_hide11();" id="up_pass_hide11" style="color: #2f889a;text-decoration: none;cursor:pointer;" class="up_show_password noselect">Show</a>
							<a onclick="pass_hide22();" id="up_pass_hide22" style="color: #2f889a;text-decoration: none;cursor:pointer;" class="up_hide_password">Hide</a>
						<input onclick="sendup();" style="width: 153px;font-size: 18px;" class="signup_submit" id="signup_submit" name="signup_submit" type="button" value="Create Account"/>
						<div id="signup_error" class="error_sign"></div>
					</form>
				</div>
				<div class="signup_forgot_height" id="popup_forgot">
					<div class="forgot_note">
						Lost your password? Please enter your email address. You will receive a link to create a new password.
					</div>
					<div id="forgot_error" class="error_forget"></div>
					<form method="post">
						<input id="reset_email" class="sign_email ico_email" type="email" placeholder="&nbsp;&nbsp;&nbsp;E-mail"/>
						<input onclick="sendforgot();" class="forgot_submit" id="forgot_submit" name="forgot_submit" type="button" value="Reset Password"/>
					</form>
					<a onclick="vsbl('sign_in');" class="sign_forgot">Back To Login</a>
				</div>
			</div>
			<div class="sign_welcome">
				<div class="welcome_head">
					Welcome to CropmyBill
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
		<style>
			#popupimg1 {background:url("/img/store/flipkart.png") no-repeat;  background-size: 120px 60px}
			#popupimg2 {background:url("/img/store/amazon.png") no-repeat;  background-size: 120px 60px}
			#popupimg3 {background:url("/img/store/snapdeal.png") no-repeat;  background-size: 120px 60px}
			#popupimg4 {background:url("/img/store/jabong.png") no-repeat;  background-size: 120px 60px}
			#popupimg5 {background:url("/img/store/paytm.png") no-repeat;  background-size: 120px 60px}
		</style>
		<div class="popup_merchants">
			<div id="popupimg1" class="popup_bottom"></div>
			<div id="popupimg2" class="popup_bottom"></div>
			<div id="popupimg3" class="popup_bottom"></div>
			<div id="popupimg4" class="popup_bottom"></div>
			<div id="popupimg5" class="popup_bottom"></div>
		</div>
	</div>
</div>

<?php
if(!isset($_COOKIE['cmb_fb']))
{
	echo '
	<script type="text/javascript">
	function setToRed ()
	{
		setTimeout ( "setToBlack()", 5000 );
	}
	function setToBlack ()
	{
		document.getElementById("fb_like_black").style.display = "block";
		document.getElementById("force_like").style.display = "block";
	}
	setToRed ();
	</script>
	<div id="fb-root"></div>
	<script>
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1558391157733323";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, "script", "facebook-jssdk"));
	function fb_hide() {
		document.getElementById("fb_like_black").style.display = "none";
		document.getElementById("force_like").style.display = "none";
		SC("cmb_fb","1549670345281224",1);
	}
	</script>
	<div class="popup" id="fb_like_black" onClick="fb_hide();" style="display:none;"></div>
	<div class="force_like" id="force_like" style="display:none;">
		<a class="cross_btn" onClick="fb_hide();"><img src="/img/cross.png"/></a>
		<div style="margin-left:auto;margin-right:auto;width:188px;"><img src="/img/logo_blue.png" style="height: auto;width: 188px;"/></div>
		<div class="fb-like" data-href="https://facebook.com/cropmybill" data-width="350" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
	</div>
	<style>
	.fb-like {
		margin:35px 0 0 25px;
	}
	.cross_btn {
		cursor:pointer;
		font-family: Garamond, "Apple Garamond";
		font-size:29px;
		position:absolute;
		top:1px;
		left:379px;
		height: 20px;
		width: 17px;
		line-height: 22px;
		border-radius:50%;
		font-weight: bold;
	}
	.force_like {
		position: fixed;
		z-index: 101;
		width: 400px;
		height:200px;
		margin: -150px 0 0 -200px;
		top: 50%;
		left: 50%;
		background: #FFF;
		cursor: auto;
		border-radius: 0.25em;
	}
	</style>
	';
}
?>
<script>
document.getElementById("sign_up1").click();
<?php 
if(isset($refer_cookie) && ($refer_cookie == 'yes'))
{
	echo '
	joinus();
	document.getElementById("sign_in1").click();
	';
}
if(isset($refer_cookie_set) && ($refer_cookie_set == 'set'))
{
	echo '
	document.getElementById("sign_in1").click();
	';
}
?>
</script>