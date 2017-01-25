<?php	
//$success_contact='';
session_start();
date_default_timezone_set("Asia/Kolkata");

$mysql_user 	= "arka_cropmybill";
$mysql_pass 	= "9735525775";
$mysql_database	= "arka_cropmybill";

$client  		= @$_SERVER['HTTP_CLIENT_IP'];
$forward 		= @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  		= $_SERVER['REMOTE_ADDR'];
$browser		= $_SERVER['HTTP_USER_AGENT'];
$datestamp		= date('Y-m-d H:i:s');
$conn			= mysql_connect("localhost",$mysql_user,$mysql_pass) or die ("connection error");
mysql_select_db($mysql_database, $conn) or die ("database not selected");
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
		)") or die("Could not create table");

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
		)") or die("Could not create table");
		
		$done = mysql_query("INSERT INTO $mysql_table(footer_email,footer_text,client,forward,remote,browser,datestamp)
			       VALUES('$footer_email','$footer_text','$client','$forward','$remote','$browser','$datestamp')") 
				   or die("not inserted");
		
		echo $done;
		mysql_close($conn);
	}
	if(isset($_POST['update_name']))
	{
		
		$mysql_table 	= "login";
		$update_name	=$_POST['update_name'];
		$update_phone	=$_POST['update_phone'];
		$update_cPass	=md5($_POST['update_cPass']);
		$email			=$_POST['update_eamil'];
		$done = mysql_query("update $mysql_table set signup_name='$update_name',name_google='$update_name',signup_phone='$update_phone',signup_password='$update_cPass' where signup_email='$email'")
				   or die("not inserted");
		
		echo $done;
		mysql_close($conn);
	}
	if(isset($_POST['signup_email']))
	{		
		//header('Location: ./admin.php');
		$mysql_table 	= "login";
		$login_record	= "login_record";
		$signup_email	=$_POST['signup_email'];
		$signup_password=md5($_POST['signup_password']);
		$signup_phone	=$_POST['signup_phone'];
		$signup_name	=$_POST['signup_name'];
		
		$done = mysql_query("INSERT INTO $mysql_table(signup_email,signup_password,signup_phone,signup_name,client,forward,remote,browser,datestamp)
			       VALUES('$signup_email','$signup_password','$signup_phone','$signup_name','$client','$forward','$remote','$browser','$datestamp')") 
				   or die("not inserted");
		$_SESSION['signin_email']=$signup_email;
		echo $done;
		mysql_close($conn);
	}

	if(isset($_POST['signin_email']))
	{
		
		$mysql_table 	= "login";
		$login_record	= "login_record";
		$signin_email	=mysql_real_escape_string($_POST['signin_email']);
		$signin_password=md5(mysql_real_escape_string($_POST['signin_password']));
		
		$q = "SELECT ID,signup_email,signup_password FROM $mysql_table WHERE signup_email = '$signin_email'";
		$result = mysql_query($q);
		if(!$result || (mysql_numrows($result) < 1))
		{
		 echo '3';
		 mysql_close($conn);
		 
		} else {
			{
				$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
				if($signin_password != $dbarray['signup_password'])
			{
				echo '2';
				mysql_close($conn);

			} else
				{
					echo '1';
					$_SESSION['signin_email']=$signin_email;
					//keeping login record
					mysql_query("CREATE TABLE IF NOT EXISTS $login_record
					(
						ID int(10) NOT NULL AUTO_INCREMENT,
						signin_email varchar(60),
						client text(20),
						forward text(20),
						remote text(20),
						browser TINYTEXT,
						datestamp varchar(20),
						PRIMARY KEY (ID)
					)") or die("Could not create $login_record");
					mysql_query("INSERT INTO $login_record(signin_email,client,forward,remote,browser,datestamp)
					   VALUES('$signin_email','$client','$forward','$remote','$browser','$datestamp')") or die("not inserted into $login_record");
					mysql_close($conn);
				}
			}
		}
		
		
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
			mysql_query("update login set confirmed='$balance' where signup_email='$re_email'") or die(3);
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
			)") or die("Could not create table");
			
			$done = mysql_query("INSERT INTO $mysql_table(re_phone,re_operator,re_amount,re_email,client,forward,remote,browser,datestamp)
					   VALUES('$re_phone','$re_operator','$re_amount','$re_email','$client','$forward','$remote','$browser','$datestamp')");
			echo $done;
		
		}
		mysql_close($conn);
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
			mysql_query("update login set confirmed='$balance' where signup_email='$bank_email'") or die(3);
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
			)") or die("Could not create table");
			
			$done = mysql_query("INSERT INTO $mysql_table(acc_holder,acc_number,bank_name,branch_name,ifsc_code,transfer_amount,bank_email,client,forward,remote,browser,datestamp)
					   VALUES('$acc_holder','$acc_number','$bank_name','$branch_name','$ifsc_code','$transfer_amount','$bank_email','$client','$forward','$remote','$browser','$datestamp')");
			echo $done;
		
		}
		mysql_close($conn);
	}
	if(isset($_POST['reset_email']))
	{	
		$reset_email		=mysql_real_escape_string($_POST['reset_email']);
		
		$email      = mysql_real_escape_string($reset_email);
		
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) // Validate email address
		{
			echo 2;
			//die (1);
		}
		else
		{
			$query = mysql_query("SELECT ID,signup_email FROM login WHERE signup_email = '$reset_email'");
			$Results  = mysql_fetch_array($query, MYSQL_ASSOC);
			
			if($Results || (mysql_numrows($result) >= 1))
			{
				$encrypt = md5(rand(10,1900)+$Results['ID']);
				$encrypt2 =md5(rand(1,9)+$Results['signup_email']);
				$to=$email;
				$subject="Forget Password";
				$from = 'care@cropmybill.com';
				$body='Hi, <br/> <br/>Your Email ID is '.$Results['signup_email'].' <br><br>Click here to reset your password http://cropmybill.com/reset.php?encrypt='.$encrypt.'&temp='.$encrypt2.'&action=reset   <br/> <br/>--<br>HAPPY CROPPING';
				$headers = "From: " . strip_tags($from) . "\r\n";
				$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				mail($to,$subject,$body,$headers);
				mysql_query("CREATE TABLE IF NOT EXISTS reset_email
				(
					ID int NOT NULL AUTO_INCREMENT,
					encrypt text,
					temp text,
					email varchar(30),
					
					active int NOT NULL DEFAULT '1',
					client text(20),
					forward text(20),
					remote text(20),
					browser TINYTEXT,
					datestamp varchar(20),
					PRIMARY KEY (ID)
				)") or die("Could not create table");
				mysql_query("INSERT INTO reset_email(encrypt,temp,email,client,forward,remote,browser,datestamp)
					   VALUES('$encrypt','$encrypt2','$email','$client','$forward','$remote','$browser','$datestamp')");
				
				echo "1";//reset successful
			}else
				{
					echo $query;
				}
			
		}
		mysql_close($conn);
	}
?>
