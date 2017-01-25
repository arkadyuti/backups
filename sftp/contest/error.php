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
	if($db_active['active'] == 1)
		header('Location: /shopaholic/');
}
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			CropmyBill
		</title>
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
	<script>
				
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
	</script>
	<div class="ca_bottom_container allfont">
		<div class="ca_body">
			<div id="fb_like" style="display:block;">
				<div style="text-align:center;font-size:22px;margin-bottom:20px;color:rgb(22, 105, 176)"><span style="font-weight:bold;font-size:30px;color:rgb(53, 176, 22)">You had already submitted your response!</span> <br><br> Like our Facebook page. Winners will be announce there. Top 5 contestants will be updated at regular intervals, throughout the competetion. </div>
				<div align="center"><div class="fb-like" data-href="https://facebook.com/cropmybill" data-width="150" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
				<div style="text-align:center;font-size:22px;margin-bottom:20px;color:rgb(22, 105, 176)"><br><br>Please share our Facebook page with your valuable feedback with <span style="color:red">#CropmyBill...</span></div>
				<div class="fb-share-button" data-href="https://facebook.com/cropmybill" data-layout="button_count"></div></div>
				<div align="center" style="margin-top:25px;">For any queries related to contest, mail us at <span style="color:red;">care@cropmybill.com</span></div>
			</div>
		</div>
	</div>
</body>
</html>
<?php
mysql_close($connection);
mysql_close($conn);
?>