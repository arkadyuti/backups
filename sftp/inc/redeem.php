<div class="account_head" style="margin: 30px 0 30px;">My Account</div>
<div class="account_menu allfont">
	<div class="account_float">
		<a href="/account">
			<div class="account_box">My Account</div>
		</a>
	</div>
	<div class="account_float">
		<a href="/earning">
			<div class="account_box">My Earning</div>
		</a>
	</div>
	<div class="account_float">
		<a href="/redeem">
			<div class="account_box selected">Redeem</div>
		</a>
	</div>
	<div class="account_float">
		<a href="/missing-cashback">
			<div class="account_box">Missing Cashback?</div>
		</a>
	</div>
</div>
<div class="account_body" style="position:relative;">
	<div class="acc_hover allfont" style="float:right;">
		<section class="acc_right">
			<h3 style="margin:0px 0 11px;color:#555;font-size:18px;">My Earnings</h3>
			<div class="right_text">Total Earnings<div style="float:right;">&#8377; <span id="total_earning"></span></div></div>
			<div class="right_text">Paid Earnings<div style="float:right;">&#8377; <span id="paid_earning"></span></div></div>
			<div class="right_text">Earnings Available<div style="float:right;">&#8377; <span id="available_earning"></span></div> for payment</div>
			<div class="right_text">Cashback waiting <div style="float:right;">&#8377; <span id="waiting_earning"></span></div>retailer approval</div>
			<div class="right_text">Referral Earnings<div style="float:right;">&#8377; <span id="refer_earning"></span></div></div>
		</section>
		<section class="acc_right" style="height: auto;">
			<h3 style="margin:0px 0 11px;color:#555;font-size:18px;">Frequently Asked Questions</h3>
			<div class="right_text"><strong>When do I get my cashback?</strong><br>Once the return period of your product is over, your cashback then becomes ready to be redeemed.</div>
			<div class="right_text"><strong>How to redeem my wallet cash?</strong><br>To redeem your wallet cash you can either 1)Recharge Your Phone - no minimum limit. 2)Transfer to Bank - Rs.250 minimum in your wallet.</div>
			<div class="right_text"><strong>How long does it take for you to reply?</strong><br>We respond to queries as soon as possible (usually within a few hours) but it may take upto 48 working hours to respond to your query.</div>
		</section>
	</div>
	<?php
	$total = 0;
	$email = $session;
	$q = "SELECT vcommision.id as id,vcommision.Offer_name as Offer_name, vcommision.status as status, vcommision.payout, vcommision.datetime as datetime, redirect3.aff_sub as session
			FROM vcommision
			INNER JOIN redirect3
			ON vcommision.`affiliate_info1`=redirect3.aff_sub and redirect3.session = '$email'
			GROUP BY vcommision.id;";
	$result = mysql_query($q) or die("query_v");
	$approved = 0;
	WHILE($rows = mysql_fetch_array($result))
	{
		$Offer_name = explode('.',$rows['Offer_name']);
		$payout = (number_format(($rows['payout']), 2, '.', ''));
		$datestamp = date_format(new DateTime($rows['datetime']), 'jS F Y');
		$approve_date = date('jS F Y');
		$datetime1 = date_create($approve_date);
		$datetime2 = date_create($datestamp);
		$interval = date_diff($datetime1, $datetime2);
		$d_dif = $interval->format('%a');
		$status = 'tentative';
		if(($rows['status'] == 'approved') && ($d_dif>90))
		{
			$approved = $approved + (number_format(($payout*(.9)), 2, '.', ''));
			$status = 'processed';
		}
		$total = $total + number_format(($payout*(.9)), 2, '.', '');
		$probable = date('jS F Y',strtotime(''.$datestamp.' + 90 days'));
	}
	$q = "SELECT flipkart.id as id,flipkart.Title as Offer_name, flipkart.status as status, flipkart.payout, flipkart.OrderDate as datetime, redirect3.session as session
			FROM flipkart
			INNER JOIN redirect3
			ON flipkart.`affiliate_info1`=redirect3.aff_sub and redirect3.session = '$email'
			GROUP BY flipkart.id;";
	$result = mysql_query($q) or die("query_flip");
	WHILE($rows = mysql_fetch_array($result))
	{
		$payout = (number_format(($rows['payout']), 2, '.', ''));
		$datestamp = date_format(new DateTime($rows['datetime']), 'jS F Y');
		$probable = date('jS F Y',strtotime(''.$datestamp.' + 90 days'));
		if($rows['status'] == 'processed')
			$approved = $approved + (number_format(($payout*(.9)), 2, '.', ''));
		$total = $total + number_format(($payout*(.9)), 2, '.', '');
	}
	$q 			= "SELECT signup_name,pending,confirmed,refer_code FROM login WHERE signup_email = '$email'";
	$re 		= mysql_query($q) ;
	$qre 		= mysql_fetch_array($re, MYSQL_ASSOC) ;
	$temp= explode(" ",$qre['signup_name']);
	$signup_name= $temp[0];
	$confirmed	= $qre['confirmed'];
	$pending 	= $qre['pending'];
	$refer_code = $qre['refer_code'];
	$query		= mysql_query("SELECT active,refer_code,referral_name from refer where refer_code = '$refer_code'");
	//$res		= mysql_fetch_array($query, MYSQL_ASSOC);
	$count_ref	= 0;
	$count_act	= 0;
	$name_pend	= array();
	$name_conf	= array();
	WHILE($res = mysql_fetch_array($query))
	{
		if($res['active'] == 1)
		{
			$count_act++;
			$name_conf[] = $res['referral_name'];
		}
		else
		{
			$count_ref++;
			$name_pend[] = $res['referral_name'];
		}
	}
	$count_ref	= $count_ref * 10;
	$count_act	= $count_act * 10;
		$count_id = 1;
		foreach ($name_conf as $value) 
		{
			$count_id++;
		}
		foreach ($name_pend as $value) 
		{
			$count_id++;
		}
	$result		= mysql_query("SELECT (SELECT SUM(transfer_amount) as tmp1 from BankTransfer where bank_email = '$email') as bank,
						(SELECT SUM(re_amount) as tmp2 from Recharge where re_email = '$email') as recharge
						FROM BankTransfer, Recharge ");
	if($result)
	{
		$paid 		= mysql_fetch_array($result, MYSQL_ASSOC);
		$bank 		= $paid['bank'];
		$recharge	= $paid['recharge'];
	}else
	{
		$bank 		= 0;
		$recharge	= 0;
	}
		
	?>
	<div class="account_head" style="font-size:24px;margin: 30px 30px 0;">Available Redeem Points : (&#8377; <span id="redeem_points"></span>)</div>
	<div style="margin: 30px 0 0 20px;">
	<a id="phoneR" align="left" onClick="showphone();" style="cursor:pointer;font-size:2em;color:#1F68A5;display:inline;">
		Recharge Phone
		<a style="cursor:pointer;font-size:2em;display:inline;"> | </a>
	</a>
	<a id="bankT" align="left" onClick="showbank();" style="cursor:pointer;font-size:2em;color:#1F68A5;display:inline;">
		Transfer to Bank
	</a>
	<div id="overlay" onClick="clear_overlay();" class="crop_dialog_overlay"></div>
	<div id="dialog" onClick="clear_overlay();" class="recharge_submit">
		<div style="width:100%;padding-left:20px;" align="left">
			<img width="70%" height="auto" align="center" src="img/logoPopup.png"/>
			<hr width="90%">
		</div>
		<div style="width:100%;padding:0px 20px 0px 20px;" align="left">
			<p style="font-size: 1.4em;color: #34495e; font-weight:bold;">Congratulations <?php echo $signup_name;?></p>
		</div>
		<div style="width:100%;" align="left">
			<p style="width:90%;font-size: 1.1em;color: #34495e;padding-left:20px;text-justify: inter-word;">We have received 
			your request. Your recharge will be processed within 48 working hours.</p>
		</div>
	</div>
		<form id="recharge" name="recharge" class="phone_recharge" align="left" style="width: 300px;">
			<input type="tel" name="re_phone" id="re_phone" placeholder="Enter Mobile Number" maxlength="10" onkeypress="return isNumberKey(event)"/>
			<select id="re_operator">
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
			<br>
			<input type="button" onClick="send_recharge();" id="recharge_submit" value="Submit" style="margin-left:45%; width:100px;height:35px;font-size:1.1em;color:white;background-color:#194775;" />
		</form>
	<div id="overlay2" onClick="clear_overlay();" class="crop_dialog_overlay"></div>
	<div id="dialog2" onClick="clear_overlay();" class="recharge_submit">
		<div style="width:100%;padding-left:20px;" align="left">
			<img width="70%" height="auto" align="center" src="img/logoPopup.png"/>
			<hr width="90%">
		</div>
		<div style="width:100%;padding:0px 20px 0px 20px;" align="left">
			<p style="font-size: 1.4em;color: #34495e; font-weight:bold;">Congratulations <?php $signup_name; ?></p>
		</div>
		<div style="width:100%;" align="left">
			<p style="width:90%;font-size: 1.1em;color: #34495e;padding-left:20px;text-justify: inter-word;">We have received 
			your request. Your transfer will be processed within 12 working days.</p>
		</div>
	</div>
		<form id="BankTransfer" class="bank_transfer" align="left" style="width: 300px;">
			<input type="text" id="acc_holder" placeholder="Account Holders Name"/>
			<input type="tel" id="acc_number" placeholder="Account Number" onkeypress="return isNumberKey(event)"/>
			<input type="text" id="bank_name" placeholder="Bank Name"/>
			<input type="text" id="branch_name" placeholder="Branch Name"/>
			<input type="text" id="ifsc_code" placeholder="IFSC Code"/>
			<input type="tel" id="transfer_amount" placeholder="Amount" onkeypress="return isNumberKey(event)"/>
			<br>
			<input id="acc_submit" onClick="send_bank();" style="margin-left:45%; width:100px;height:35px;font-size:1.1em;color:white;background-color:#194775;" type="button" value="Submit"/>
		</form>
		<div id="recharge_error"></div>
			<div id="recharge_error2"></div>
		<script>
		function clear_overlay() {
				console.log("1");
				location.assign(location.href);
			}
			document.onkeydown = function (evt) {
				evt = evt || window.event;
				if(evt.keyCode == 27)
				{
					clear_overlay();
				}
			}
			function isNumberKey(evt){
				var charCode = (evt.which) ? evt.which : event.keyCode
				if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;
				return true;
			}
			function showphone() {
				document.getElementById("recharge").style.display = "block";
				document.getElementById("BankTransfer").style.display = "none";
			}
			function showbank() {
				document.getElementById("recharge").style.display = "none";
				document.getElementById("BankTransfer").style.display = "block";
			}
		function send_bank() {
			document.getElementById("recharge_error2").innerHTML = "";
			if(document.getElementById("acc_holder").value=="") {
				document.getElementById("recharge_error2").innerHTML = "Provied Account Holders Name";
				document.getElementById("recharge_error").innerHTML = "";
				return false;
			}
			else if(document.getElementById("acc_number").value=="") {
				document.getElementById("recharge_error2").innerHTML = "Provied Account Number";
				document.getElementById("recharge_error").innerHTML = "";
				return false;
			}
			else if(document.getElementById("bank_name").value=="") {
				document.getElementById("recharge_error2").innerHTML = "Provied Bank Name";
				document.getElementById("recharge_error").innerHTML = "";
				return false;
			}
			else if(document.getElementById("branch_name").value=="") {
				document.getElementById("recharge_error2").innerHTML = "Provied Branch Name";
				document.getElementById("recharge_error").innerHTML = "";
				return false;
			}
			else if(document.getElementById("ifsc_code").value=="") {
				document.getElementById("recharge_error2").innerHTML = "Provied IFSC Code";
				document.getElementById("recharge_error").innerHTML = "";
				return false;
			}
			else if(document.getElementById("transfer_amount").value<=249) {
				document.getElementById("recharge_error2").innerHTML = "Minimum Transfer Amount is &#8377; 250";
				document.getElementById("recharge_error").innerHTML = "";
				return false;
			}
			if(document.getElementById("transfer_amount").value <= <?php echo (($approved+$count_act)-($bank + $recharge));?>)
			{
					var p="acc_holder="+document.getElementById("acc_holder").value
					+"&acc_number="+document.getElementById("acc_number").value
					+"&bank_name="+document.getElementById("bank_name").value
					+"&branch_name="+document.getElementById("branch_name").value
					+"&ifsc_code="+document.getElementById("ifsc_code").value
					+"&transfer_amount="+document.getElementById("transfer_amount").value
					+"&bank_email="+"<?php echo $session; ?>";
					var g="";
					var Li="/code.php";
					var el="recharge_error";
					lod(g,p,Li,el);
					console.log("done");
					document.getElementById("overlay2").style.display = "block";
					document.getElementById("dialog2").style.display = "block";
			}else
			{
					document.getElementById("recharge_error2").innerHTML = "Insufficient Balance";
					document.getElementById("recharge_error").innerHTML = "";
			}
		}
		function send_recharge() {
			document.getElementById("recharge_error2").innerHTML = "";
			if(document.getElementById("re_phone").value<=999999999) {
				document.getElementById("recharge_error2").innerHTML = "Invalid Phone Number";
				document.getElementById("recharge_error").innerHTML = "";
				return false;
			}
			else if(document.getElementById("re_operator").value=="") {
				document.getElementById("recharge_error2").innerHTML = "Select Operator";
				document.getElementById("recharge_error").innerHTML = "";
				return false;
			}
			else if(document.getElementById("re_amount").value<=9) {
				document.getElementById("recharge_error2").innerHTML = "Invalid Amount";
				document.getElementById("recharge_error").innerHTML = "";
				return false;
			}
			else if(document.getElementById("re_amount").value <= <?php echo (($approved+$count_act)-($bank + $recharge));?>)
			{
					var p="re_phone="+document.getElementById("re_phone").value
					+"&re_operator="+document.getElementById("re_operator").value
					+"&re_amount="+document.getElementById("re_amount").value
					+"&re_email="+"<?php echo $session; ?>";
					var g="";
					var Li="/code.php";
					var el="recharge_error";
					lod(g,p,Li,el);
					console.log("done");
					document.getElementById("overlay").style.display = "block";
					document.getElementById("dialog").style.display = "block";
			}else
			{
					document.getElementById("recharge_error2").innerHTML = "Insufficient Balance";
					document.getElementById("recharge_error").innerHTML = "";
			}
		}
		</script>
	</div>
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
   background: url("images/bs-overlay.png");
   cursor:pointer;
}
.recharge_submit
{
	cursor:pointer;
   display: none;
   position: fixed;
   width: 390px;
   height: 202px;
   top:50%;
   left:50%;
   align:center;
   margin-left: -190px;
   margin-top: -100px;
   background-color: #ffffff;
   border: 1px solid #336699;
   border-radius:5px;
   padding: 0px;
   z-index: 102;
}
	#BankTransfer {
		display:none;
	}
		form.phone_recharge input {
		border-radius:4px;
		width:100%;
		height:40px;
		outline:none;
		margin:10px;
		font-size:1.3em;
		font-family:Cursive;
	}
	.phone_recharge input:focus{
	  border: solid 1px #34495e;
	  box-shadow: 0 0 5px 1px #5e7e9e;
	}
	form.bank_transfer input,select {
		border-radius:4px;
		width:100%;
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
		table.test td:nth-child(odd) {
			margin: 12px 12px 12px 120px;
			padding: 12px 12px 12px 30px;
			color :#5e7e9e;
			font-size: 22px;
			font-family: latoregular,Arial,sans-serif;
		}
		table.test td:nth-child(even) {
			margin: 12px 12px 12px 120px;
			padding: 12px 12px 12px 140px;
		}
		table.test input {
			border-radius:4px;
			height:132%;
			width:170%;
			outline:none;
		}
		.test input:focus{
		}
		table.test {
			border-collapse: separate;
			border-spacing: 10px;
			*border-collapse: expression("separate", cellSpacing = "10px");
		}
	</style>
</div>
<script>
<?php 
if((($approved+$count_act)-($bank + $recharge))<0)
	$available_e = 0;
else
	$available_e = (($approved+$count_act)-($bank + $recharge))
?>		
document.getElementById("available_earning").innerHTML = "<?php echo $available_e;?>";
document.getElementById("redeem_points").innerHTML = "<?php echo $available_e;?>";
document.getElementById("total_earning").innerHTML = "<?php echo $total+$count_ref+$count_act;?>";
document.getElementById("paid_earning").innerHTML = "<?php echo $bank + $recharge;?>.00";
document.getElementById("waiting_earning").innerHTML = "<?php echo $total - $approved;?>";
document.getElementById("refer_earning").innerHTML = "<?php echo $count_ref+$count_act;?>";
</script>