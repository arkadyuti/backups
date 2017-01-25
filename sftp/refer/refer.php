<style>
.refer_bottom_container {
	width: 970px;
	margin-left: auto;
	margin-right: auto;
	margin-bottom:45px;
	margin-top: 25px;
	box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
}
.refer_body {
	min-height: 400px;
	background:#fff;
	padding-bottom: 30px;
}
.refer_text {
	padding:0 20px 0 0;
	color:#555;
	line-height: 20px;
	font-size: 14px;
}
.social_btn {
	margin-bottom:37px;
	width:170px;
	height:40px;
	margin-left:auto;
	margin-right:auto;
	cursor:pointer;
}
.social_text {
	text-align:center;
}
.social_share {
	height:115px;
	width:650px;
	border:1px solid black;
}
.share_wa_ico {
	width:40px;
	height:40px;
	background:url("/img/btn_wa.png") no-repeat;background-size:100%;
	float:left;
}
.share_twitter_ico {
	width:40px;
	height:40px;
	background:url("/img/btn_twitter.png") no-repeat;background-size:100%;
	float:left;
}
.share_trans_wa {
	width:130px;
	height:40px;
	background:#3EC032;
	float:right;
}

.share_trans_twi {
	width:130px;
	height:40px;
	background:#81CED2;
	float:right;
}
.share_trans_wa div:hover {
	background:#1C9910;
	width:130px;
	height:40px;
	float:right;
	transition: background-color 0.2s;
}

.share_trans_twi div:hover {
	background:#489FA3;
	width:130px;
	height:40px;
	float:right;
	transition: background-color 0.2s;
}


.refer_notice_container {
	min-width:200px;
	height:600px;
	border:1px solid black;
}
.refer_top {
	width:900px;
	height:235px;
	margin-left: auto;
	margin-right: auto;
}
.refer_top_left {
	float:left;
	width:650px;
	min-height:190px;

}
.refer_top_right {
	float:left;
	width:250px;
	min-height:190px;
	background:url("./ref3.png") no-repeat;background-size:93%;
}
.link_invite_wrap {
	height:55px;
	width:900px;
	margin-left:auto;
	margin-right:auto;
}
.link_invite {
	background:#fff;
	height:55px;
	width:900px;
	margin-left:auto;
	margin-right:auto;
	margin-bottom: 30px;
}

.trans_border {
	border:4px solid #DFDEDE;
}
.trans_div section:hover {
	transition: border-color 1s ease;
	border:4px solid #E5F1FA;
	display:block;
}

.social_invite {
	background:#fff;
	height:358px;
	width:440px;
	float:right;
	margin-right: 30px;
}
.email_invite {
	background:#fff;
	min-height:340px;
	width:440px;
	margin-left: 30px;
	
}
.link_input_text {
	font: normal 23px/54px 'Arial,Helvetica,sans-serif';
	margin-left:20px;
	font-family: Arial,Helvetica,sans-serif;
}
.link_input {
	float:right;
	margin: 13px 66px 0 0;
	width: 537px;
	border-radius: 4px;
	height: 29px;
	line-height: 29px;
	text-indent: 10px;
	font-size: 15px;
	background: #fff;
	border: 1px solid #979797;
}
.email_i_h {
	color: #2066a1;
	font-size: 23px;
	line-height: 55px;
}
.friend_email {
	font-size: 12px;
	background: #fff;
	border: 1px solid #979797;
	height: 29px;
	line-height: 29px;
	text-indent: 10px;
	margin-left:20px;
	width:400px;
	margin-bottom:20px;
}
.invite_mssg {
	height: 180px;
	width:400px;
	margin-left:20px;
	font-size: 13px;
	background: #fff;
	border: 1px solid #979797;
	line-height: 18px;
	padding:13px;
	color:#555;
}
.invite_submit {
	float:right;
	font-size: 14px;
	color: #fff;
	background: #2066a1;
	line-height: 30px;
	padding: 0 18px;
	display: inline-block;
	cursor:pointer;
}
</style>
<?php
if($session != null)
{
	echo '<script>SC("cmb_r", "", -1000);</script>';
	if(!isset($_COOKIE['cmb_lk']))
	{
		$q = "SELECT ID,refer_code from login WHERE signup_email = '$session'";
		$result = mysql_query($q);
		$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
		if($dbarray['refer_code'] == null)
		{
			$refer_id = $_COOKIE['cmb_ssn'];
			$refer_id = $refer_id - 20;
			$refer_id_ori = $dbarray['ID'];
			$shf = rand(1,9);
			if($shf == 1)
				$refer_id += 111;
			if($shf == 2)
				$refer_id += 222;
			if($shf == 3)
				$refer_id += 333;
			if($shf == 4)
				$refer_id += 444;
			if($shf == 5)
				$refer_id += 555;
			if($shf == 6)
				$refer_id += 666;
			if($shf == 7)
				$refer_id += 777;
			if($shf == 8)
				$refer_id += 888;
			if($shf == 9)
				$refer_id += 999;
			$newstr = substr_replace($refer_id, $shf, 0, 0);
			$q = "update login set `refer_code` = COALESCE(`refer_code`, '$newstr') where  `ID`  = '$refer_id_ori'";
			$result = mysql_query($q);
			echo '<script>SC("cmb_lk", "'.$newstr.'", 30);</script>';
			$rcode = $newstr;
		}
		else
		{
			$rcode = $dbarray['refer_code'];
			echo '<script>SC("cmb_lk", "'.$rcode.'", 30);</script>';
		}
	}
	else
	{
		$rcode = $_COOKIE['cmb_lk'];
	}
	/*
	if(!isset($_COOKIE['cmb_lk']))
	{
		
		
		
		//$refer_id = substr($refer_id, 1);
		//$refer_id = substr_replace($refer_id, "", -1);
		//$refer_id = rtrim($refer_id);
		//$lastchar = substr($refer_id, -1);
		//$result = mb_substr($refer_id, 0, 1);
		
	}
	else
	{
		$rcode = $_COOKIE['cmb_lk'];
	}*/
}
if($session==null)
	$rcode = 'CropmyBill';
?>
<div class="refer_bottom_container">
	<div class="refer_body">
		<div class="refer_top">
			<div class="refer_top_left allfont">
				<div class="email_i_h">Refer friends - Earn 10% Cashback forever!</div>
				<div class="refer_text">Invite your friends and earn 10% of their cashback everytime they shop! Wow! Isn't it amazing. For example, say your friend earned
					Rs. 5000 cashback, you would get Rs. 500 as referral money from us. Imagine how much you can earn if you refer 100s of your friends to join CropmyBill. Help your friends to save money and earn money for yourself also!
					<br>
					<br>
					Below is your unique referral link. When your friends click on this link and join they are automatically added to your referral network. Once your friends shop successfully, 10% of their cashback can be redeemed by you plus Rs. 10 referral point bonus.
				</div>
			</div>
			<div class="refer_top_right"></div>
		</div>
		<div class="trans_div">
			<section class="link_invite trans_border">
				<div class="link_input_text allfont email_i_h">
					Your unique referral link:
					<input class="link_input allfont" type="text" onClick="this.select();<?php if($session==null) echo 'joinus();'?>"  value="http://cropmybill.com/?ref=<?php echo $rcode;?>" />
				</div>
				
			</section>
		</div>
		<div class="trans_div">
			<section class="social_invite trans_border">
				<div class="email_i_h" style="  margin-left: 20px;">
					Or invite via Social Media
				</div>
				<?php
				$title=urlencode('Cropmybill - Refral');
				$url=urlencode('http://cropmybill.com/?ref='.$rcode.'');
				$summary=urlencode("Great site for earning huge #caskback. You can find amazing deals and exclusive coupons @CropmyBill.");
				$image=urlencode('http://cropmybill.com/img/fb_refer2.jpg');
				$re_uri=urlencode('http://cropmybill.com/refer');
				$twitter = urlencode('Great website for #cashback Join @cropmybill and save huge bucks http://cropmybill.com/?ref='.$rcode.'');
				?>
				<?php
				if($session!=null)
				{
				echo '
				<a href = "http://cropmybill.com/refer/wa.php?wa_url='.$url.'&wa_s='.$summary.'" target="_blank">
					<div class="social_btn">
						<div class="share_wa_ico"></div>
						<div class="share_trans_wa">
							<div style="width:130px;height:40px;">
								<span class="social_name">Whatsapp</span>
							</div>
						</div>
					</div>
				</a>
				<a onClick="fb_share();" href="javascript: void(0)">
					<div class="social_btn">
						<div class="share_fb_ico"></div>
						<div class="share_trans_fb">
							<div style="width:130px;height:40px;">
								<span class="social_name">Facebook</span>
							</div>
						</div>
					</div>
				</a>
				<a href="https://plus.google.com/share?url=http://cropmybill.com/refer/share.php?ref='.$url.'" target="_blank">
					<div class="social_btn">
						<div class="share_gp_ico"></div>
						<div class="share_trans_goo">
							<div style="width:130px;height:40px;">
								<span class="social_name">Google+</span>
							</div>
						</div>
					</div>
				</a>
				<a  href="http://twitter.com/home?status='.$twitter.'" class="r_twiter" target="_blank">
					<div class="social_btn">
						<div class="share_twitter_ico"></div>
						<div class="share_trans_twi">
							<div style="width:130px;height:40px;">
								<span class="social_name">Twitter</span>
							</div>
						</div>
					</div>
				</a>
				';
				}else
				{
				echo '
				<a onClick="joinus();">
					<div class="social_btn">
						<div class="share_wa_ico"></div>
						<div class="share_trans_wa">
							<div style="width:130px;height:40px;">
								<span class="social_name">Whatsapp</span>
							</div>
						</div>
					</div>
				</a>
				<a onClick="joinus();" href="javascript: void(0)">
					<div class="social_btn">
						<div class="share_fb_ico"></div>
						<div class="share_trans_fb">
							<div style="width:130px;height:40px;">
								<span class="social_name">Facebook</span>
							</div>
						</div>
					</div>
				</a>
				<a onClick="joinus();">
					<div class="social_btn">
						<div class="share_gp_ico"></div>
						<div class="share_trans_goo">
							<div style="width:130px;height:40px;">
								<span class="social_name">Google+</span>
							</div>
						</div>
					</div>
				</a>
				<a onClick="joinus();">
					<div class="social_btn">
						<div class="share_twitter_ico"></div>
						<div class="share_trans_twi">
							<div style="width:130px;height:40px;">
								<span class="social_name">Twitter</span>
							</div>
						</div>
					</div>
				</a>
				';
				}
				?>
			</section>
		</div>
		<div class="trans_div">
			<section class="email_invite trans_border">
				<div class="email_i_h" style="  margin-left: 20px;">
					Invite by Email
				</div>
				<input class="friend_email" id="friend_email" type="text" placeholder="Friends Email"/>
				<textarea id="your_message" name="your_message" class="invite_mssg allfont ajustfy" maxlength="500">Hi,I've been using CropmyBill.com to save money on every shopping I do. It's so easy.. All you do is click through their site before shopping online just like you normally would. &#13;&#10;&#10;You can get cashback from loads of well known stores and you can easily save Rs 10,000 every year. </textarea>
				<div style="height:34px;padding:20px;">
				<div id="invite_error" style="color:red;float:left;"></div>
				<?php
				if($session == null)
				{
					echo '
					<input class="invite_submit" onClick="joinus();" type="button" value="Send Invite"/>
					';
				}else
				{
					echo'
					<input class="invite_submit" onClick="send_invite();" type="button" value="Send Invite"/>
					';
				}
				?>
				</div>
				
			</section>
		</div>
	</div>
</div>

<script>
function fb_share() {
	window.open('https://www.facebook.com/dialog/feed?app_id=1558391157733323&link=<?php echo $url; ?>&picture=<?php echo $image;?>&caption=<?php echo $title;?>&description=<?php echo $summary;?>&redirect_uri=<?php echo $re_uri;?>&display=popup','toolbar=0,status=0,width=548,height=325');
}
function send_invite(){
var input = document.getElementById("friend_email").value;
if( input == "" )
{
	document.getElementById("friend_email").focus();
	document.getElementById("friend_email").select();
}
else
{
	document.getElementById("invite_error").innerHTML = "";
	var p="friend_email="+document.getElementById("friend_email").value+"&your_message="+document.getElementById("your_message").value
			+"&yourlink="+"http://cropmybill.com/?ref=<?php echo $rcode;?>";
	var g="";
	var Li="/code.php";
	var el="invite_error";
	lod(g,p,Li,el);
}
}
if (window.location.hash == '#_=_') window.close();
</script>






