<style>
.ticket_input {
	font-size: 12px;
	background: #fff;
	border: 1px solid #979797;
	height: 29px;
	line-height: 29px;
	text-indent: 10px;
	margin-left: 20px;
	width: 200px;
	margin: 5px 0px 5px 0;
}
.trans_det {
	height: 180px;
	width: 200px;
	margin-left: 20px;
	margin: 5px 0px 5px 0;
	font-size: 13px;
	background: #fff;
	border: 1px solid #979797;
	line-height: 18px;
	padding: 13px;
	color: #555;
}
.ticket_terms {
	color: #555;
	line-height: 22px;
	font-size: 13px;
}
.ticket_td {
	color:#555;
}
.ticket_form {
	 margin:40px 0 0 20px;padding: 25px;width: 649px;border: 1px solid #dedede;
	 display:none;
}
#ticket_submit2 {
	display:none;
}
.missing_date {
	display:inline;
	font-size: 15px;
	background: #fff;
	border: 1px solid #979797;
	height: 29px;
	line-height: 28px;
	text-indent: 10px;
	margin-left: 20px;
	width: 200px;
	margin-left:30px;
}
.no_transaction {
	    margin: 40px 0 0 120px;
    font-size: 25px;
    color: red;
}
</style>
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
			<div class="account_box">Redeem</div>
		</a>
	</div>
	<div class="account_float">
		<a href="/missing-cashback">
			<div class="account_box selected">Missing Cashback?</div>
		</a>
	</div>
</div>
<div class="account_body" style="position:relative;">
	<div class="acc_hover allfont" style="float:right;">
		<section class="acc_right" style="height: auto;">
			<h3 style="margin:0px 0 11px;color:#555;font-size:18px;">Frequently Asked Questions</h3>
			<div class="right_text"><strong>When do I get my cashback?</strong><br>Once the return period of your product is over, your cashback then becomes ready to be redeemed.</div>
			<div class="right_text"><strong>How to redeem my wallet cash?</strong><br>To redeem your wallet cash you can either 1)Recharge Your Phone - no minimum limit. 2)Transfer to Bank - Rs.250 minimum in your wallet.</div>
			<div class="right_text"><strong>How long does it take for you to reply?</strong><br>We respond to queries as soon as possible (usually within a few hours) but it may take upto 48 working hours to respond to your query.</div>
		</section>
	</div>
	<div class="account_head" style="font-size:24px;margin: 30px 30px 0;">Add Missing Cashback Ticket</div>
	<?php $start_date		= date('Y-m-d');?>
	<?php $end_date = date('Y-m-d',strtotime(''.$start_date.' - 10 days')); ?>
	<div style="font-size: 20px;margin: 30px 0 0 20px;color:#555;">
		<div class="allfont" style="display:inline;">Select Date of Transaction</div>
		<input class="missing_date" id="missing_date" type="date" min="<?php echo $end_date;?>" max="<?php echo $start_date;?>" onchange="dateselect();"/>
	</div>
	<div id="missing"></div>
	<div id="ticket_submit" class="ticket_terms allfont" style="color:#555;margin-left:20px;"></div>
	<div class="ticket_form" id="ticket_form">
		<div class="account_head" style="font-size:24px;margin: 0px 0px 30px 0;">Add Few Extra Details</div>
		<form method="post">
			<table>
				<tr>
					<td><span class="ticket_td allfont">Transaction ID*</span></td>
					<td><input type="text" id="ticket_id" class="ticket_input" disabled /></td>
				</tr>
				<tr>
					<td><span class="ticket_td allfont">Amount Paid*</span></td>
					<td><input type="text" id="ticket_amount" class="ticket_input"/></td>
				</tr>
				<tr>
					<td><span class="ticket_td allfont">Coupon (If Used)</span></td>
					<td><input type="text" id="ticket_coupon" class="ticket_input"/></td>
				</tr>
				<tr>
					<td><span class="ticket_td allfont">Transaction Details*</span></td>
					<td><textarea type="text" id="ticket_det" class="trans_det" maxlength="500"></textarea></td>
				</tr>
			</table>
			<ul class="ticket_terms allfont">
				<li>Retailers do not accept Missing Cashbacks older than 10 days</li>
				<li>As Missing Cashback is dealt with outside the usual payment process, tickets may take 30-45 days to get resolved and show in your Cashback Account. Consequently confirmation period of Missing Cashback can also take longer than 90 days. Rest assured we will try our best to get your Cashback approved as soon as possible. That’s when we earn too, so our incentives are always aligned with yours!</li>
				<li>Incorrect Information may lead to Cancellation of Cashback. Please do not raise multiple tickets for the same transaction. This may also lead to the Retailer declining the enquiry</li>
				<li>Please note that sometimes transactions initially track at lower/incorrect amounts and get updated to the right amount at the time of confirmation</li>
				<li>While we shall try our best to resolve and get your Missing Cashback approved, the retailer's decision is final in this regard</li>
			</ul>
			<input id="terms_conditions" value="Yes" type="checkbox"/>
			<span class="ticket_terms allfont">Have read and understood the terms and conditions.</span><br>
			<input onClick="transaction();" type="button" value="Submit" style="margin: 23px 0 0px 0px;font-size: 14px;color: #fff;background: #2066a1;line-height: 30px;padding: 0 18px;display: inline-block;cursor: pointer;">
			
			<span id="ticket_submit2" class="ticket_terms allfont" style="color:red;margin-left:20px;"></span>
			
		</form>
	</div>
	<!-- <div id="loading" style="position: absolute; width: 100%; height: 100%; background: url('/img/loading-blue.gif') no-repeat center center;"></div> -->
	<script>
	function clear_tick(a) {
		var pageDivs = document.getElementsByClassName("tick");
		for(i = 0; i < pageDivs.length;i++)
		{
			pageDivs[i].innerHTML="Create Ticket";
		}
		console.log("cleared");
		document.getElementById(a).innerHTML="Ticket Created &#10004";
		
	}
	function ticket(a) {
		clear_tick(a);
		console.log("ticket created");
		console.log(a);
		document.getElementById("ticket_id").value = a;
		document.getElementById("ticket_form").style.display = "block";
	}
	function transaction() {
		var terms_conditions = document.getElementById('terms_conditions').checked;
		var ticket_amount = document.getElementById("ticket_amount").value;
		var ticket_det = document.getElementById("ticket_det").value;
		if ( ticket_amount == "" ) {
			document.getElementById("ticket_amount").focus();
			document.getElementById("ticket_amount").select();
		}
		else if( ticket_det == "" ) {
			document.getElementById("ticket_det").focus();
			document.getElementById("ticket_det").select();
		}
		else if( terms_conditions == false ) {
			document.getElementById("ticket_submit2").innerHTML = 'Please Agree to our Terms & Condition';
			document.getElementById("ticket_submit2").style.display = 'inline';
		}
		else
		{
			document.getElementById("ticket_submit2").innerHTML = "Thank You";
			document.getElementById("ticket_submit2").style.display = "inline";
			var p="ticket_id="+document.getElementById("ticket_id").value
					+"&ticket_amount="+document.getElementById("ticket_amount").value
					+"&ticket_coupon="+document.getElementById("ticket_coupon").value
					+"&ticket_email="+"<?php echo $session; ?>"
					+"&ticket_det="+document.getElementById("ticket_det").value;
			var g="";
			var Li="/code.php";
			var el="ticket_submit";
			lod(g,p,Li,el);
			document.getElementById("ticket_form").style.display = "none";
		}
	}
	function dateselect() {
		document.getElementById("ticket_form").style.display = "none";
		var p="missing_date="+document.getElementById("missing_date").value+"&missing_email="+"<?php echo $session; ?>";
		var g="";
		var Li="/code.php";
		var el="missing";
		lod(g,p,Li,el);
	}
	</script>
</div>