<style>
.storelogo {
	position:absolute;
	width:190px;height:130px;background:red;
}
.get_percent {
	margin-left:100px;
	font-family: Arial,Helvetica,sans-serif;
	font-weight: bolder;
	line-height: 3.8;
	font-size: 21px;
	color:white;
	width: 550px;
	text-transform: uppercase;
}
.store_cashback {
	float:right;
	width:293px;
	height:40px;
	margin-top:17px;
}
.store_cashback a {
	display: block;
	box-shadow: inset 0 0 0 1px #6A9EC9;
	border-radius: 25px;
	border: 2px solid #fff;
	transition: all 0.15s ease-in-out;
	background: #2c3e50;
	height: 100%;
	text-align: center;
	text-decoration:none;
	line-height: 2.5;
	color:white;
	font-weight:bolder;
}
.store_cashback a:hover {
	background: #f8f8f8;
	color:black;
}
.store_scissor {
	float:left;
	background:url("./logo_footer.png") no-repeat;
	background-size: 100%;
	width:60px;
	height:60px;
	margin-top:5px;
}
.store_btn {
	float:left;
	width:75px;
	height:30px;
	margin-left: 70px;
}
.store_btn a {
	height:100%;
	display: block;
	text-align:center;
	border-radius: 5px;
	border: 2px solid #666666;
	background-color: #f8f8f8;
	color:black;
	text-decoration:none;
	line-height:1.7;
}
.store_btn a:hover {
	background: #666666;
	color:white;
}
.store_selected {
	display:block;
	border-radius: 5px;
	background: #666666;
	color:white;
}
.more_btn {
	float:right;font-size:15px;cursor:pointer;
	color:#1669B0;
}
#merchant_details {
	margin-left:57px;margin-top: 8px;overflow:hidden; height: 62px;text-align: justify;
	font-family: Arial,Helvetica,sans-serif;
	font-size: 17px;
	color:#555;
}
.merchant_name {
	font-family: Arial,Helvetica,sans-serif;  font-size: 30px;
	margin-left:57px;
}
.merchant_container {
	margin-left:100px;padding-top:20px;height:166px;width:600px;overflow:hidden;
}
.btn_container {
	margin: 20px 0 20px 94px; height: 40px;
}
.info_container {
	width:630px;background-color: white;margin-bottom: 63px;box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
	padding: 18px;
	font-family: Arial,Helvetica,sans-serif;
	font-size:16px;
	color:#555B61;
}
.rate_container {
	width: auto;min-height:20px;background-color: white;box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
	padding: 0 18px 18px 18px;
	margin-bottom:40px;
}
.cashback_rates {
	font-family: Arial,Helvetica,sans-serif;
	font-size: 25px;
	float: left;
	margin-left: 34px;
	margin-top: 12px;
}
.rates_logo {
	float:left;width:76px;height:68px;  background: url("/img/cashback_rate.png") no-repeat;
	background-size: 100%;
}
.rate_percent {
	width: auto;
	height: 42px;
	display: inline-block;
	font: normal 25px/40px 'Arial,Helvetica,sans-serif';
	font-weight: 700;
	text-align: center;
	padding: 2px 15px 0px 15px;
	background-origin: padding-box;
	background-color: #27be90;
	border-radius: 5px;
	color: white;
	
}
.rate_category {
	font-size:18px;
	font-family: Arial,Helvetica,sans-serif;
	color: #27be90;
	margin-left:30px;
	text-align: justify;
}
tr.spaceUnder > td
{
  padding-top: 2em;
}
.important_note li {
	margin-top:12px;
}
</style>
<?php
$requri = getenv ("REQUEST_URI");
$store_temp = explode('/', $requri);
if(isset($store_temp[1]))
{
	//if(isset($store_temp[2]) && $store_temp[2]=='')
		//echo '<script>window.location="/allstore/";</script>';
}
if(isset($store_temp[2]))
{
	$store_name = $store_temp[2];
}
if($session==null)
{
	$session= 'anonymous'; 
}
$aff_date = date("YmdHis");

$result = mysql_query("select * from allstore where cname = '$store_name'");
$array = mysql_fetch_array($result, MYSQL_ASSOC) or die("Error");
$url2 = $array['url'];
$brand = $array['cname'];
$desc = $array['description'];
$brand_lower = strtolower($brand);
if($brand_lower == 'flipkart')
	$url = '/crop.php?cname='.$brand.'&&ses='.$session.'&&urlo=http://dl.flipkart.com/dl/?affid=cropmybil&affExtParam1='.$aff_date.'';
elseif($brand_lower == 'amazon')
	$url = '/crop.php?cname=amazon&&ses='.$session.'&&urlo=http://www.amazon.in/?_encoding=UTF8&camp=3626&creative=24822&linkCode=ur2&tag=cropmybillcom-21&linkId=4OV42M2TGYTXT2BF';
else
	$url = '/crop.php?cname='.$brand.'&&ses='.$session.'&&urlo='.$url2.'&aff_sub='.$aff_date.''
?>
<div style="min-height:80px;width:100%;margin-top:10px;margin-bottom:10px;">
	<div style="width: 1152px; margin-left: auto; margin-right: auto;  padding-left: 35px;">
		<a href ="<?php echo $url;?>" target="_blank">
			<style>
			.merchant_logo {
				float:left;width:190px;height:115px;
				background:url("/img/store/<?php echo $brand_lower;?>.png") no-repeat;
				margin-top:30px;box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
			}
			</style>
			<div class="merchant_logo"></div>
		</a>
		<div id="more_height" class="merchant_container">
		<div class="merchant_name"><?php echo $brand; ?></div>
			<div id="merchant_details">
				<?php echo $desc;?>
			</div>
			<a onclick="more_hide()" id="more_hide" class="more_btn allfont">more</a>
		<a onclick="more_show()" id="more_show" class="more_btn" style="display:none;">less</a>
		</div>
		
	</div>
</div>
<script>
function more_hide() {
    document.getElementById('merchant_details').style.overflow = 'visible';
    document.getElementById("merchant_details").style.height = "auto";
    document.getElementById('more_hide').style.display = 'none';
    document.getElementById('more_show').style.display = 'block';
    document.getElementById('more_height').style.height = '200px';
}
function more_show() {
	document.getElementById("merchant_details").style.overflow = "hidden";
	document.getElementById("merchant_details").style.height = "62px";
	document.getElementById('more_hide').style.display = 'block';
    document.getElementById('more_show').style.display = 'none';
	document.getElementById('more_height').style.height = '166px';
                    
}
</script>

<div style="min-height:60px;min-width:1152px;background:rgba(22, 105, 176, 0.59);margin-top:10px;">
	<div style="width: 1152px; margin-left: auto; margin-right: auto;">
	<div class="store_scissor"></div>
	<div class="store_cashback">
		<a href="<?php echo $url;?>" target="_blank">GET CASHBACK</a>
	</div>
	<div class="get_percent">
		GET <?php echo $array['rate'];?> CASHBACK @ <?php echo $brand; ?>
	</div>
	</div>
</div>
<div style="width:100%;background-color:#F6F6F6">
	<div style="width: 1152px; margin-left: auto; margin-right: auto;">
		<table style="border-spacing: 0px;">
			<tr>
				<td>
				<div class="btn_container">
					<!--<div class="store_btn">
						<a style="background-color:#666666;color:white;" href="#">Info</a>
					</div>
					<div class="store_btn">
						<a href="#">Coupons</a>
					</div>
					<div class="store_btn">
						<a href="#">Deals</a>
					</div>-->
				</div>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: -webkit-baseline-middle;">
					<div style="width:700px;">
						<div class="info_container allfont">
							<div class="important_note">
								<div style="font-size:18px;color:#2C3E50;">Important:</div>
								<ol>
									<li>All cashback are paid by CropmyBill. Any queries/complaints should be sent directly to us and not to the merchant.</li>
									<li>Using a Coupon, Gift Voucher, Gift Card, Gift Certificate or Store Credit may void your cashback. Shopping done through Cashback links and using only the coupons listed on our website only will be eligible for cashback. </li>
									<li>Please take into account that under certain circumstances, your transaction may not get tracked or qualify for a cashback. Under any circumstances, we cannot be held responsible for the same. We can only pay you once your transition is tracked by the merchant and is approved for cashback.</li>
									<li>If your order is cancelled, exchanged or returned, it may not be eligible for cashback.</li>
									<li>Cashback is paid only on the final amount paid to the merchant.</li>
									<li>Do not visit any other coupon, deal or price comparison site once you are redirected from CropmyBill.com. It may result in your cashback getting cancelled.</li>
									<li>Cashback approval may take up to 90 days in some cases.</li>
									<li>Cashback rates are subject to change at any time without prior notification.</li>
								</ol>
							</div>
						</div>
					</div>
				</td>
				<td style="vertical-align: baseline;">
					<div class="rate_container">
					<div style="height:68px;">
						<div class="rates_logo"></div>
						<div class="cashback_rates">Cashback Rates</div>
					</div>
					<table>
					<?php
					$str = $array['rate_2'];
					if($str == null)
						$str = $array['rate_1'];
					if($str == null)
						$str = '0.0%;No Cashback';
					$table = explode(";",$str);
					$count = substr_count($str, ';');
					$rr = 0;
					for ($x = 0; $x < $count/2; $x++) {
					echo '
						<tr class="spaceUnder">
							<td style="vertical-align: top;">
								<div class="rate_percent">'.$table[$rr].'</div>
							</td>
							';
							$rr = $rr+1;
							if($table[$rr] == '')
							{
								$temp = 'On All Order';
							}else
								$temp = $table[$rr];
					echo '
							<td>
								<div class="rate_category">
									'.$temp.'
								</div>
							</td>
						</tr>';
					$rr = $rr+1;
					}
					?>
					</table>
					</div>
					<div class="rate_container" style="font-family: Arial,Helvetica,sans-serif;text-align: justify;color: #555;">
						
							<div class="notice_text" style="font-weight:bold;font-style:normal;font-size:1.1em;text-align:center;">Steps for cashback</div>
							<hr style="width:90%;">
							<div class="steps_bold">Join Us</div>
								<div class="steps_text">Sign up on CropmyBill.com to create your account.</div>
							<div class="steps_bold">Shop via us </div>
								<div class="steps_text">Go to your preferred retailer through CropmyBill.com and shop like you normally do.</div>
							<div class="steps_bold">Redeem </div>
								<div class="steps_text">Once your cashback is confirmed either recharge your phone or transfer the money to your account</div>
						
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>