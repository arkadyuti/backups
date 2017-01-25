<?php	
//$success_contact='';
session_start();
date_default_timezone_set("Asia/Kolkata");

$mysql_user 	= "cropmybill";
$mysql_pass 	= "su4adu9ez";
$mysql_database	= "suvankar_cropmybill";

$client  		= @$_SERVER['HTTP_CLIENT_IP'];
$forward 		= @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  		= $_SERVER['REMOTE_ADDR'];
$browser		= $_SERVER['HTTP_USER_AGENT'];
$datestamp		= date('Y-m-d H:i:s');
$conn			= mysql_connect("localhost",$mysql_user,$mysql_pass);
mysql_select_db($mysql_database, $conn);

mysql_query("CREATE TABLE IF NOT EXISTS login
		( 
			ID int NOT NULL AUTO_INCREMENT,
			signup_email varchar(30),
			signup_password text(32),
			signup_phone varchar(13),
			signup_name varchar(40),
			
			id_fb varchar(25),
			fname_fb varchar(15),
			gender_fb varchar(6),
			name_fb varchar(40),
			icon_fb TINYTEXT,
			
			fname_google varchar(15),
			name_google varchar(40),
			ID_google varchar(25),
			icon_google TINYTEXT,
			gender_google varchar(6),
			
			confirmed int(5) DEFAULT '0',
			pending int(5) DEFAULT '0',
			
			active int NOT NULL DEFAULT '1',
			client text(20),
			forward text(20),
			remote text(20),
			browser TINYTEXT,
			datestamp varchar(20),
			PRIMARY KEY (ID),
			UNIQUE (signup_email),
			UNIQUE (id_fb),
			UNIQUE (ID_google)
		)");

	if(isset($_POST['footer_text']))
	{
		
		$mysql_table 	= "contactUS";
		$footer_email	=mysql_real_escape_string($_POST['footer_email']);
		$footer_text	=mysql_real_escape_string($_POST['footer_text']);
		
		mysql_query("CREATE TABLE IF NOT EXISTS $mysql_table
		(
			ID int NOT NULL AUTO_INCREMENT,
			footer_email varchar(30),
			footer_text text(300),
			active int NOT NULL DEFAULT '1',
			client text(20),
			forward text(20),
			remote text(20),
			browser TINYTEXT,
			datestamp varchar(20),
			PRIMARY KEY (ID)
		)");
		
		$done = mysql_query("INSERT INTO $mysql_table(footer_email,footer_text,client,forward,remote,browser,datestamp)
			       VALUES('$footer_email','$footer_text','$client','$forward','$remote','$browser','$datestamp')");
		
		echo $done;
		
	}
	if(isset($_POST['re_phone']))
	{		
		//header('Location: ./admin.php');
		$mysql_table 	= "Recharge";
		$re_phone	=mysql_real_escape_string($_POST['re_phone']);
		$re_operator=mysql_real_escape_string($_POST['re_operator']);
		$re_amount	=mysql_real_escape_string($_POST['re_amount']);
		$re_email	=mysql_real_escape_string($_POST['re_email']);

		$re = mysql_query("SELECT confirmed FROM login WHERE signup_email = '$re_email'");
		$qre = mysql_fetch_array($re, MYSQL_ASSOC);
		$temp = $qre['confirmed'];
		if($re_amount > $temp)
		{
			echo 2;
		}
		else
		{
			$balance = $temp - $re_amount;
			mysql_query("update login set confirmed='$balance' where signup_email='$re_email'");
			mysql_query("CREATE TABLE IF NOT EXISTS $mysql_table
			(
				ID int NOT NULL AUTO_INCREMENT,
				re_phone varchar(13),
				re_operator varchar(20),
				re_amount int(13),
				re_email varchar(30),
				
				active int NOT NULL DEFAULT '1',
				client text(20),
				forward text(20),
				remote text(20),
				browser TINYTEXT,
				datestamp varchar(20),
				PRIMARY KEY (ID)
			)") ;
			
			$done = mysql_query("INSERT INTO $mysql_table(re_phone,re_operator,re_amount,re_email,client,forward,remote,browser,datestamp)
					   VALUES('$re_phone','$re_operator','$re_amount','$re_email','$client','$forward','$remote','$browser','$datestamp')");
			
			$to='care@cropmybill.com';
			$subject="Recharge";
			$from = 'no-reply@cropmybill.com';
			$body='operator '.$re_operator.'<br/>Email ID is '.$re_email.' <br><br>Ph Number'.$re_phone.'<br>Amount='.$re_amount.'<br/>Recharge Soon';
			$headers = "From: " . strip_tags($from) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			mail($to,$subject,$body,$headers);
			
			echo $done;
		
		}
		
	}
	if(isset($_POST['acc_holder']))
	{	
		//header('Location: ./admin.php');
		$mysql_table 	= "BankTransfer";
		$acc_holder		=mysql_real_escape_string($_POST['acc_holder']);
		$acc_number		=mysql_real_escape_string($_POST['acc_number']);
		$bank_name		=mysql_real_escape_string($_POST['bank_name']);
		$branch_name	=mysql_real_escape_string($_POST['branch_name']);
		$ifsc_code		=mysql_real_escape_string($_POST['ifsc_code']);
		$transfer_amount=mysql_real_escape_string($_POST['transfer_amount']);
		$bank_email		=mysql_real_escape_string($_POST['bank_email']);

		$re = mysql_query("SELECT confirmed FROM login WHERE signup_email = '$bank_email'");
		$qre = mysql_fetch_array($re, MYSQL_ASSOC);
		$temp = $qre['confirmed'];
		if($transfer_amount > $temp)
		{
			echo 2;
		}
		else
		{
			$balance = $temp - $transfer_amount;
			mysql_query("update login set confirmed='$balance' where signup_email='$bank_email'");
			mysql_query("CREATE TABLE IF NOT EXISTS $mysql_table
			(
				ID int NOT NULL AUTO_INCREMENT,
				acc_holder text,
				acc_number text,
				bank_name text,
				branch_name varchar(45),
				ifsc_code varchar(20),
				transfer_amount int(5),
				bank_email varchar(50),
				
				active int NOT NULL DEFAULT '1',
				client text(20),
				forward text(20),
				remote text(20),
				browser TINYTEXT,
				datestamp varchar(20),
				PRIMARY KEY (ID)
			)");
			
			$done = mysql_query("INSERT INTO $mysql_table(acc_holder,acc_number,bank_name,branch_name,ifsc_code,transfer_amount,bank_email,client,forward,remote,browser,datestamp)
					   VALUES('$acc_holder','$acc_number','$bank_name','$branch_name','$ifsc_code','$transfer_amount','$bank_email','$client','$forward','$remote','$browser','$datestamp')");
			echo $done;
		
		}
		
	}
mysql_close($conn);
?>