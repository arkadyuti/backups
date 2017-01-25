<style>
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
		width:140%;
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
<div class="account_head" style="margin: 30px 0 30px;">My Account</div>
<div class="account_menu allfont">
	<div class="account_float">
		<a href="/account">
			<div class="account_box selected">My Account</div>
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
			<div class="account_box">Missing Cashback?</div>
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
	<?php
		$email= $session;
		$conn_account	= mysql_connect("localhost","arka_cropmybill","9735525775");
		mysql_select_db("arka_cropmybill", $conn_account);
		$q = "SELECT signup_name,signup_phone FROM login WHERE signup_email = '$email'";
		$re = mysql_query($q);
		$qre = mysql_fetch_array($re, MYSQL_ASSOC);
		$original_name=$qre['signup_name'];
		$original_phone=$qre['signup_phone'];
		$temp = explode(" ",$qre['signup_name']);
		$signup_name = $temp[0];
		$success2='';
		if(isset($success1))
			$success2 = $success1;
		mysql_close($conn_account);
		echo '		
			<div style="background-color:white; width:750px;min-height: 600px;">
				<div class="myacc_body"  style="padding-bottom:50px;padding-top:25px;">
					<h2 align="left" style="font-size:2em; font-weight: normal;color:#1F68A5;margin-left:10px;font-family: Arial,Helvetica,sans-serif;">
						Welcome '.$signup_name.'
					</h2>
					<br>
					<table class="test" style="width:90%">
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
						<td><input type="password" name="update_pass" id="update_pass" value=""/></td>
						</tr>
						<tr>
						<td>Confirm Password</td>
						<td><input type="password" name="update_cPass" id="update_cPass"/></td>
						</tr>
						<tr>
						<td></td>
						<td><input onclick="sendupdate();" style="margin-left:91%; width:50%;height:160%;font-size:.8em;color:white;background-color:#194775;" type="button" name="update_account" id="update_account" value="Save Changes"/></td>
						</tr>
					</form>
					</table>
					'.$success2.
					'
					<div id="update_error" style="float:right;color:red;"></div>
				</div>
			</div>';
		?>
		
	
</div>
	<script type="text/javascript">
	function sendupdate(){
	var name = document.getElementById("update_name").value;
	var cpass = document.getElementById("update_cPass").value;
	var pass = document.getElementById("update_pass").value;
	if((pass=='')||(cpass=='')||(cpass==''))
	{
		alert("Please fill up the form");
		return false;
	}
	if(cpass!=pass)
	{
		alert("Password does not match");
		return false;
	}
	var p="update_name="+document.getElementById("update_name").value+"&update_phone="+document.getElementById("update_phone").value
			+"&update_cPass="+document.getElementById("update_cPass").value
			+"&update_eamil="+document.getElementById("update_eamil").value;
	var g="";
	var Li="/code.php";
	var el="update_error";
	lod(g,p,Li,el);
	}
	</script>
	