<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;  ");
date_default_timezone_set("Asia/Kolkata");
$mysql_user 	= "arka_cropmybill";
$mysql_pass 	= "9735525775";
$mysql_database	= "arka_cropmybill";
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
	if(isset($_POST['signin_email']))
	{
		$signin_email	=mysql_real_escape_string($_POST['signin_email']);
		$signin_password=md5($_POST['signin_password']);
		//$arr = array(  'ms'=> $signin_email );
		//echo json_encode($arr);
		$mysql_table 	= "login";
		$login_auth	= "login_auth";
		$q = "SELECT ID,signup_email,signup_password,signup_name FROM $mysql_table WHERE signup_email = '$signin_email'";
		$result = mysql_query($q);
		if(!$result || (mysql_numrows($result) < 1))
		{
			$arr = array(  'ms'=> '<span style="color:red;">Please enter valid Email</span>' );
			echo json_encode($arr);
		} else {
			{
				$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
				if($signin_password != $dbarray['signup_password'])
				{
					$arr = array(  'ms'=> '<span style="color:red;">Please enter valid Password</span>' );
					echo json_encode($arr);
				} else
				{
					//$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
					$signup_name = $dbarray['signup_name'];
					$signin_id_md5 = md5(420+$dbarray['ID']);
					$arr = array(  'cmb_eml'=> $signin_email  , 'cmb_ssn' => ($dbarray['ID']+20) ,  'cmb_vld' => $signin_id_md5 , 'cmb_nm' => $signup_name , 'refresh'=> 'refresh' );
					echo json_encode($arr);
					$_SESSION['signin_email']=$signin_email;
				}
			}
		}
	}
	if(isset($_POST['signup_email']))
	{
		$signup_email		=mysql_real_escape_string($_POST['signup_email']);
		$signup_email      = mysql_real_escape_string($signup_email);
		if (!filter_var($signup_email, FILTER_VALIDATE_EMAIL) === true) // Validate email address
		{
			$arr = array(  'ms'=> '<span style="color:red;">Please enter valid Email</span>' );
			echo json_encode($arr);
		}
		else
		{
			//header('Location: ./admin.php');
			$mysql_table 	= "login";
			$login_record	= "login_record";
			$signup_email	=mysql_real_escape_string($_POST['signup_email']);
			$signup_password=md5($_POST['signup_password']);
			$signup_phone	=mysql_real_escape_string($_POST['signup_phone']);
			$signup_name	=mysql_real_escape_string($_POST['signup_name']);
			
				$refer_code		=mysql_real_escape_string($_POST['refer_code']);
				$do = mysql_query("INSERT INTO refer(referral,referral_name,refer_code,client,forward,remote,browser,datestamp)
					   VALUES('$signup_email','$signup_name','$refer_code','$client','$forward','$remote','$browser','$datestamp')") or die("e");
			
			$done = mysql_query("INSERT INTO $mysql_table(signup_email,signup_password,signup_phone,signup_name,client,forward,remote,browser,datestamp)
					   VALUES('$signup_email','$signup_password','$signup_phone','$signup_name','$client','$forward','$remote','$browser','$datestamp')");
			if($done==1)
			{
				$_SESSION['signin_email']=$signup_email;
				$result = mysql_query("select ID from login where signup_email = '$signup_email'");
				$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
				$signin_id_md5 = md5(420+$dbarray['ID']);
				$arr = array(  'cmb_eml'=> $signup_email  , 'cmb_ssn' => ($dbarray['ID']+20) , 'cmb_vld' => $signin_id_md5 , 'cmb_nm' => $signup_name , 'refresh'=> 'refresh' );
				echo json_encode($arr);
			}else
			{
				$arr = array(  'ms'=> '<span style="color:red;">This email already exists</span>' );
				echo json_encode($arr);
			}
		}
	}
	if(isset($_POST['email_fb']))
	{		
		//header('Location: ./admin.php');
		$mysql_table 	= "login";
		$signup_email	=mysql_real_escape_string($_POST['email_fb']);
		if($signup_email == 'undefined')
		{
		$arr = array(  'undefined' => 'undefined' ,'ms'=> 'Your Facebook profile does not contain email address, please opt different login method' );
		echo json_encode($arr);
		}
		else 
		{
		$name_fb		=mysql_real_escape_string($_POST['name_fb']);
		$id_fb			=mysql_real_escape_string($_POST['id_fb']);
		$icon_fb		=mysql_real_escape_string($_POST['icon_fb']);
		$gender_fb		=mysql_real_escape_string($_POST['gender_fb']);
		$client			=mysql_real_escape_string($_POST['client']);
		$forward		=mysql_real_escape_string($_POST['forward']);
		$remote			=mysql_real_escape_string($_POST['remote']);
		$browser		=mysql_real_escape_string($_POST['browser']);
		$datestamp		=mysql_real_escape_string($_POST['datestamp']);
		mysql_query("INSERT INTO login(signup_email,signup_name,fname_fb,name_fb,id_fb,icon_fb,gender_fb,client,forward,remote,browser,datestamp)
			       VALUES('$signup_email','$name_fb','$name_fb','$name_fb','$id_fb','$icon_fb','$gender_fb','$client','$forward','$remote','$browser','$datestamp')");
		$_SESSION['signin_email']=$signup_email;
		$result = mysql_query("select ID from login where signup_email = '$signup_email'");
		$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
		$signin_id_md5 = md5(420+$dbarray['ID']);
		$arr = array(  'cmb_eml'=> $signup_email  , 'cmb_ssn' => ($dbarray['ID']+20) , 'cmb_vld' => $signin_id_md5 , 'cmb_nm' => $id_fb , 'refresh'=> 'refresh' );
		echo json_encode($arr);
		}
	}
	if(isset($_POST['deal_details']))
	{
		mysql_query("CREATE TABLE IF NOT EXISTS outlet
		(
			ID int NOT NULL AUTO_INCREMENT,
			offer_code varchar(10),
			outlet_session text,
			deal_details text,
			deactive_date varchar(20),
			
			active int NOT NULL DEFAULT '1',
			client text(20),
			forward text(20),
			remote text(20),
			browser TINYTEXT,
			datestamp varchar(20),
			PRIMARY KEY (ID),
			UNIQUE (offer_code)
		)");
		$outlet_session	=mysql_real_escape_string($_POST['session']);
		$deal_details	=mysql_real_escape_string($_POST['deal_details']);
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$randstring = '';
		for ($i = 0; $i < 5; $i++) {
			$randstring .= $characters[rand(0, strlen($characters))];
			//$randstring .= ' ';
		}
		
		$offer_code	= $randstring;
		//$result = mysql_query("select ID from outlet where offer_code = '$offer_code' ");
		$done = mysql_query("INSERT INTO outlet(offer_code,outlet_session,deal_details,client,forward,remote,browser,datestamp)
			       VALUES('$offer_code','$outlet_session','$deal_details','$client','$forward','$remote','$browser','$datestamp')");
		if($done == 1)
		{
			$to = $outlet_session;
			$vld = 'Please Check your email for the desired deal. *Check spam folder if not found in Inbox*';
			$subject="CODE";
			$from = 'care@cropmybill.com';
			$body='Code = '.$offer_code.'  <br/> <br/>--<br>HAPPY CROPPING';
			$headers = "From: " . strip_tags($from) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($to,$subject,$body,$headers);
		}else
			$vld = 'Some error occurred, please try again later';
		
		$arr = array('ms'=> $vld);
		echo json_encode($arr);
	}
	if(isset($_POST['update_name']))
	{
		$mysql_table 	= "login";
		$update_name	=mysql_real_escape_string($_POST['update_name']);
		$update_phone	=mysql_real_escape_string($_POST['update_phone']);
		$update_cPass	=md5($_POST['update_cPass']);
		$email			=mysql_real_escape_string($_POST['update_eamil']);
		$done = mysql_query("update $mysql_table set signup_name='$update_name',name_google='$update_name',signup_phone='$update_phone',signup_password='$update_cPass' where signup_email='$email'");
		if($done==1)
		{
			$_SESSION['signin_email']=$email;
			$result = mysql_query("select ID from login where signup_email = '$email'");
			$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
			$signin_id_md5 = md5(420+$dbarray['ID']);
			$arr = array(  'cmb_eml'=> $email  , 'cmb_ssn' => ($dbarray['ID']+20) , 'cmb_vld' => $signin_id_md5 , 'cmb_nm' => $update_name , 'refresh'=> 'refresh' );
			echo json_encode($arr);
		}else
		{
			$arr = array(  'ms'=> '<span style="color:red;">email already exists</span>' );
			echo json_encode($arr);
		}
	}
	if(isset($_POST['reset_email']))
	{	
		$reset_email		=mysql_real_escape_string($_POST['reset_email']);
		$email      = mysql_real_escape_string($reset_email);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL) === true) // Validate email address
		{
			$arr = array(  'ms'=> '<span style="color:red;">Please enter valid Email</span>' );
			echo json_encode($arr);
		}
		else
		{
			$query = mysql_query("SELECT ID,signup_email,signup_name FROM login WHERE signup_email = '$reset_email'");
			$Results  = mysql_fetch_array($query, MYSQL_ASSOC);
			if($Results)
			{
				$encrypt = md5(rand(10,1900)+$Results['ID']);
				$encrypt2 =md5(rand(1,9)+$Results['signup_email']);
				$signup_name_t = explode(' ',$Results['signup_name']);
				$signup_name = $signup_name_t[0];
				$to=$email;
				$subject="Forget Password";
				$from = 'care@cropmybill.com';
				$body='Hi '.$signup_name.', <br/> <br/>Your Email ID is '.$Results['signup_email'].' <br><br><a style="text-decoration:none;" href="http://cropmybill.com/reset.php?encrypt='.$encrypt.'&temp='.$encrypt2.'&action=reset">Click here</a> to reset your password  <br/> <br/>--<br>HAPPY CROPPING';
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
					signup_name varchar(60),					
					active int NOT NULL DEFAULT '1',
					client text(20),
					forward text(20),
					remote text(20),
					browser TINYTEXT,
					datestamp varchar(20),
					PRIMARY KEY (ID)
				)");
				mysql_query("INSERT INTO reset_email(encrypt,temp,email,signup_name,client,forward,remote,browser,datestamp)
					   VALUES('$encrypt','$encrypt2','$email','$signup_name','$client','$forward','$remote','$browser','$datestamp')");
				$arr = array(  'ms'=> '<span style="color:red;">Please Check your email for the reset link, check spam folder if not found in inbox</span>' );
				echo json_encode($arr);
			}else
				{
					$arr = array(  'ms'=> '<span style="color:red;">Please enter valid Email</span>' );
					echo json_encode($arr);
				}
		}
	}
mysql_close($conn);
?>