<?php
include('/home/arka/public_html/main.php');
$connection= mysql_connect("localhost","arka_cropmybill","9735525775") or die ("connection error");
mysql_select_db("arka_contest", $connection) or die ("database not selected");
if($session != null)
{
	mysql_query("INSERT INTO `arka_contest`.`user` (`user_email`) VALUES ('$session');");
	$_SESSION['contest'] = $session;
	$active = mysql_query("SELECT active FROM `user` WHERE user_email = '$session';");
	$db_active = mysql_fetch_array($active, MYSQL_ASSOC);
	if($db_active['active'] == 0)
		header('Location: /contest/error.php');
}else
	header('Location: /shopaholic/');
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			Checkout
		</title>
<link rel="shortcut icon" href="/img/crop.ico">
        <link href="./styles.css" rel="stylesheet" type="text/css"/>
		<script src="./js.js"></script>
       
	</head>
	
<body style="margin:0px;padding:0px;" id="mainbody">
	<?php
		require('./h.php');
	?>
	
	<style>
	.ca_bottom_container {
		width: 970px;
		margin-left: auto;
		margin-right: auto;
		margin-bottom:45px;
		margin-top: 25px;
		box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
	}
	.ca_body {
		min-height: 400px;
		background:#fff;
		padding: 1px 30px 30px 30px;
		line-height: 1.5;
		
		font-weight: normal;
		color: rgba(0,0,0,0.87);
		font-size: 15px;
	}
	.question {
		line-height: 1.5;
		color: rgba(0,0,0,0.87);
		font-size: 22px;
		font-style: italic;
		color:rgb(22, 105, 176);
	}
	table, td, th {
		margin:10px 0px 30px 0px;
		color:green;
	}
	table.final_table {
		border-collapse: separate;
		border-spacing: 10px;
		font-size:22px;
		font-weight: bold;
	}
	table.final_table, td,th {
		border-collapse: separate;
		border-spacing: 10px;
	}
	.submit {
		width: 100px;
		height: 33px;
		cursor: pointer;
		color:white;
		background: #3c5a98;
		font:normal 19px/29px 'Arial,Helvetica,sans-serif';
		font-family:Arial,Helvetica,sans-serif
	}
	</style>
	
	<div class="ca_bottom_container allfont">
		<div class="ca_body">
			<div id="hide_qs" style="display:block">
				<div style="text-align:center;font-size:26px;margin-bottom:20px;color:rgba(73, 146, 82, 0.87)">Welcome to Round 2! <br><span style="font-size:22px;">You may choose one or more than one option for every question.</span></div>
				<form method="post" id="form_qs_one">
					<div class="question">1. CropmyBill provides :-</div>
					<table>
						<tr>
							<td><input type="checkbox" id="1"/></td>
							<td>Cahsback</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="2"/></td>
							<td>Deals</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="3"/></td>
							<td>Coupons</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="4"/></td>
							<td>All of the above</td>
						</tr>
					</table>
					<div class="question">2. Founder of Flipkart :-</div>
					<table>
						<tr>
							<td><input type="checkbox" id="5"/></td>
							<td>Sachin Bansal</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="6"/></td>
							<td>Binny Bansal</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="7"/></td>
							<td>Brijay Bansal</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="8"/></td>
							<td>Sachin Agarwal</td>
						</tr>
					</table>
					<div class="question">3. Raajpal Yadav earns Rs.500 cahsback at CropmyBill. Ways to redeem his cahsback?</div>
					<table>
						<tr>
							<td><input type="checkbox" id="9"/></td>
							<td>Mobile Recharge</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="10"/></td>
							<td>Hand to hand cash</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="11"/></td>
							<td>Bank Transfer</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="12"/></td>
							<td>All of the above</td>
						</tr>
					</table>
					<div class="question">4. Sachin Tendulkar refers CropmyBill.com to MS Dhoni. Dhoni purchases clothing items &nbsp;&nbsp;&nbsp;&nbsp;worth Rs.10,000 from Amazon.in via CropmyBill. What Cashback will Sachin get from &nbsp;&nbsp;&nbsp;&nbsp;CropmyBill?<span style="font-size:16px;float:right;">(Hint: Refer & Earn)</span></div>
					<table>
						<tr>
							<td><input type="checkbox" id="13"/></td>
							<td>Rs.1350</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="14"/></td>
							<td>Rs.135</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="15"/></td>
							<td>Rs.1300</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="16"/></td>
							<td>No cashback</td>
						</tr>
					</table>
					<div class="question">5. Rahul gets a coupon code "AMS50" at CropmyBill.com. "AMS50" can be applied on &nbsp;&nbsp;&nbsp;&nbsp;"American Swan" to get 50% discount on any product. He purchases clothes worth &nbsp;&nbsp;&nbsp;&nbsp;Rs.1,000 from "American Swan". What will be his net savings?<span style="font-size:16px;float:right;">(Hint: American Swan : 12.6% cashback)</span></div>
					<table>
						<tr>
							<td><input type="checkbox" id="17"/></td>
							<td>Rs.0</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="18"/></td>
							<td>Rs.500</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="19"/></td>
							<td>Rs.437</td>
						</tr>
						<tr>
							<td><input type="checkbox" id="20"/></td>
							<td>Rs.563</td>
						</tr>
					</table>
					<table class="final_table allf">
						<tr>
							<td style="color: #1669B0;">Your Name</td>
							<td><input style="width: 260px;height: 30px;font-size: 22px;" type="text" id="name"/></td>
							<td><span style="color:red;font-size:14px;display:none" id="name_e">Please enter Name</span></td>
						</tr>
						<tr>
							<td style="color: #1669B0;">Your Phone number</td>
							<td><input style="width: 260px;height: 30px;font-size: 22px;" type="text" id="phone" maxlength="10" onkeypress="return isNumberKey(event)"/></td>
							<td><span style="color:red;font-size:14px;display:none" id="num_e">Please enter valid Phone Number</span></td>
						</tr>
						<tr>
							<td style="color: #1669B0;">College/University</td>
							<td><input style="width: 260px;height: 30px;font-size: 22px;" type="text" id="college"/></td>
							<td><span style="color:red;font-size:14px;display:none" id="cole_e">Please enter College/University name</span></td>
						</tr>
					</table>
					<input id="submit_qs" class="submit" onClick="send_bank();" type="button" value="Submit"/>
				</form>
				
				<script>
				document.getElementById("hide_cart").style.display="none";
				  window.fbAsyncInit = function() {
					FB.init({
					  appId      : '1558391157733323',
					  xfbml      : true,
					  version    : 'v2.4'
					});
				  };

				  (function(d, s, id){
					 var js, fjs = d.getElementsByTagName(s)[0];
					 if (d.getElementById(id)) {return;}
					 js = d.createElement(s); js.id = id;
					 js.src = "//connect.facebook.net/en_US/sdk.js";
					 fjs.parentNode.insertBefore(js, fjs);
				   }(document, 'script', 'facebook-jssdk'));
				
				function isNumberKey(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57))
						return false;
					return true;
				}

				function send_bank()
				{
					var name = document.getElementById("name").value;
					var phone = document.getElementById("phone").value;
					var college = document.getElementById("college").value;
					if( name == "" )
					{
						document.getElementById("name").focus();
						document.getElementById("name").select();
						document.getElementById("name_e").style.display="block";
						document.getElementById("num_e").style.display="none";
						document.getElementById("cole_e").style.display="none";
					}
					else if(phone < 999999999)
					{
						document.getElementById("phone").focus();
						document.getElementById("phone").select();
						document.getElementById("num_e").style.display="block";
						document.getElementById("name_e").style.display="none";
						document.getElementById("cole_e").style.display="none";
					}
					else if(college=="")
					{
						document.getElementById("college").focus();
						document.getElementById("college").select();
						document.getElementById("cole_e").style.display="block";
						document.getElementById("name_e").style.display="none";
						document.getElementById("num_e").style.display="none";
					}
					else
					{
						var out = 'questions=questions&' + "user_name=" + name + "&user_ph=" + phone + "&college=" + college +"&";	
						console.log(out);
						var checkbox = ''
						for(i = 1; i < 21; i++) 
						{
							checkbox = document.getElementById(i);
							if(checkbox.checked)
								checkbox= '1';
							else
								checkbox = '0';
							//console.log(checkbox);
							out += i +"="+ checkbox + "&";
						}
						out = out.substring(0, out.length - 1);
						var Li="./code.php";
						var g = ''
						var el="questions_ms";
						var done = lod(g,out,Li,el);
						console.log(done);
						if(done =="a")
						{
							document.getElementById("hide_qs").style.display="none";
							document.getElementById("fb_like").style.display="block";
							document.getElementById('mainbody').scrollIntoView();
						}
					}
				}
				</script>
			</div>
			<div id="fb_like" style="display:none;">
				<div style="text-align:center;font-size:22px;margin-bottom:20px;color:rgb(22, 105, 176)"><span style="font-weight:bold;font-size:30px;color:rgb(53, 176, 22)">THANK YOU FOR PARTICIPATING!</span> <br><br> Like our Facebook page. Winners will be announce there. Top 5 contestants will be updated at regular intervals, throughout the competetion. </div>
				<div align="center"><div class="fb-like" data-href="https://facebook.com/cropmybill" data-width="150" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
				<div style="text-align:center;font-size:22px;margin-bottom:20px;color:rgb(22, 105, 176)"><br><br>Please share our Facebook page with your valuable feedback with <span style="color:red">#CropmyBill...</span></div>
				<div class="fb-share-button" data-href="https://facebook.com/cropmybill" data-layout="button_count"></div></div>
				<div style="color:green"></div>
				<h2 id="questions_ms" style="display:none;"></h2>
			</div>
		</div>
	</div>
</body>
</html>
<?php
mysql_close($connection);
mysql_close($conn);
?>