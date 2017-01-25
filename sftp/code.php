<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;  ");
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
	if(isset($_POST['signin_email']))
	{
		$signin_email	=mysql_real_escape_string($_POST['signin_email']);
		$signin_password=md5($_POST['signin_password']);
		//$arr = array(  'ms'=> $signin_email );
		//echo json_encode($arr);
		$mysql_table 	= "login";
		$login_auth	= "login_auth";
		$q = "SELECT ID,signup_email,signup_password,signup_name,active FROM $mysql_table WHERE signup_email = '$signin_email'";
		$result = mysql_query($q);
		if(!$result || (mysql_numrows($result) < 1))
		{
			$arr = array(  'ms'=> '<span style="color:red;">Please enter valid Email</span>' );
			echo json_encode($arr);
		} else 
		{
			{
				$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
				if($signin_password != $dbarray['signup_password'])
				{
					$arr = array(  'ms'=> '<span style="color:red;">Please enter valid Password</span>' );
					echo json_encode($arr);
				} 
				elseif($dbarray['active'] == 0)
				{
					$arr = array(  'ms'=> '<span style="color:red;">Your account is temporarily suspended</span>' );
					echo json_encode($arr);
				}
				else
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
			$done = mysql_query("INSERT INTO $mysql_table(signup_email,signup_password,signup_phone,signup_name,client,forward,remote,browser,datestamp)
					   VALUES('$signup_email','$signup_password','$signup_phone','$signup_name','$client','$forward','$remote','$browser','$datestamp')");
			if($done==1)
			{
				if(($refer_code != null)&&($refer_code != ''))
				{
					$do = mysql_query("INSERT INTO refer(referral,referral_name,refer_code,client,forward,remote,browser,datestamp)
					   VALUES('$signup_email','$signup_name','$refer_code','$client','$forward','$remote','$browser','$datestamp')") or die("e");
				}
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
		$refer_code		=mysql_real_escape_string($_POST['refer_code']);
		mysql_query("INSERT INTO login(signup_email,signup_name,fname_fb,name_fb,id_fb,icon_fb,gender_fb,client,forward,remote,browser,datestamp)
			       VALUES('$signup_email','$name_fb','$name_fb','$name_fb','$id_fb','$icon_fb','$gender_fb','$client','$forward','$remote','$browser','$datestamp')");
		if(($refer_code != null)&&($refer_code != ''))
		{
			$do = mysql_query("INSERT INTO refer(referral,referral_name,refer_code,client,forward,remote,browser,datestamp)
			   VALUES('$signup_email','$name_fb','$refer_code','$client','$forward','$remote','$browser','$datestamp')");
		}
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
	if(isset($_POST['missing_date']))
	{
		$missing_date	=mysql_real_escape_string($_POST['missing_date']);
		$missing_email	=mysql_real_escape_string($_POST['missing_email']);
		$query = mysql_query("SELECT * FROM redirect3 WHERE session = '$missing_email' and timestamp like '$missing_date%' group by aff_sub");
		$out = '<table class="acc_table">
				<tr><td>ID</td><td>Merchant</td><td>Date</td><td>Select Order</td><tr>';
		WHILE($rows = mysql_fetch_array($query))
		{
			$out .= '<tr><td>'.$rows['aff_sub'].'</td><td>'.$rows['cname'].'</td><td>'.$missing_date.'</td><td><a id="'.$rows['aff_sub'].'" class="tick" style="cursor:pointer;color:red;" onClick="ticket('.$rows['aff_sub'].');">Create Ticket</a></td><tr>';
		}	
		$out .= '</table>';
		if(!$query || (mysql_numrows($query) < 1))
		{
			$arr = array(  'ms'=> '<div class="no_transaction allfont">No Transaction in this date</div>' );
			echo json_encode($arr);	
		}else
		{
			$arr = array(  'ms'=> $out );
			echo json_encode($arr);
		}
	}
	if(isset($_POST['ticket_id']))
	{
		$ticket_id	=mysql_real_escape_string($_POST['ticket_id']);
		$ticket_amount	=mysql_real_escape_string($_POST['ticket_amount']);
		$ticket_coupon	=mysql_real_escape_string($_POST['ticket_coupon']);
		$ticket_email	=mysql_real_escape_string($_POST['ticket_email']);
		$ticket_det	=mysql_real_escape_string($_POST['ticket_det']);
		$to			= 'care@cropmybill.com';
		$to2		= 'cropmybill@gmail.com';
		$subject	= 'Ticket No. '.$ticket_id.'';
		$from 		= 'care@cropmybill.com';
		$body		= '<br/> <br/> Ticket ID = '.$ticket_id.' <br> Ticket Amount = '.$ticket_amount.' <br> Ticket Email = '.$ticket_email.' <br> Ticket Coupon = '.$ticket_coupon.' <br> Ticket Details = '.$ticket_det.' ';
		$headers 	= "From: " . strip_tags($from) . "\r\n";
		$headers	.= "Reply-To: ". strip_tags($from) . "\r\n";
		$headers	.= "MIME-Version: 1.0\r\n";
		$headers 	.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		mail($to,$subject,$body,$headers);
		$arr = array(  'ms'=> '<div class="no_transaction allfont">Please Note Ticket ID '.$ticket_id.'</div>' );
		echo json_encode($arr);
	}
	if(isset($_POST['acc_holder']))
	{
		$mysql_table 	= "BankTransfer";
		$acc_holder		=mysql_real_escape_string($_POST['acc_holder']);
		$acc_number		=mysql_real_escape_string($_POST['acc_number']);
		$bank_name		=mysql_real_escape_string($_POST['bank_name']);
		$branch_name	=mysql_real_escape_string($_POST['branch_name']);
		$ifsc_code		=mysql_real_escape_string($_POST['ifsc_code']);
		$transfer_amount=mysql_real_escape_string($_POST['transfer_amount']);
		$bank_email		=mysql_real_escape_string($_POST['bank_email']);
		if((isset($_COOKIE['cmb_eml'])) && ($_COOKIE['cmb_eml'] == $bank_email) && (checkamount($transfer_amount,$bank_email)== true ))
		{
			$email_uni = $bank_email;
			mysql_query("INSERT INTO $mysql_table(acc_holder,acc_number,bank_name,branch_name,ifsc_code,transfer_amount,bank_email,client,forward,remote,browser,datestamp)
					   VALUES('$acc_holder','$acc_number','$bank_name','$branch_name','$ifsc_code','$transfer_amount','$bank_email','$client','$forward','$remote','$browser','$datestamp')");
			$arr = array(  'ms'=> 'Thank You !!' );
			echo json_encode($arr);
			$to			= 'care@cropmybill.com';
			$subject	= "Bank Transfer";
			$from 		= 'no-reply@cropmybill.com';
			$body		= 'acc_holder = '.$acc_holder.' <br>
							acc_number = '.$acc_number.' <br>
							bank_name = '.$bank_name.' <br>
							branch_name = '.$branch_name.' <br>
							ifsc_code = '.$ifsc_code.' <br>
							transfer_amount = '.$transfer_amount.' <br>
							Request email = '.$bank_email.'';
			$headers 	= "From: " . strip_tags($from) . "\r\n";
			$headers	.= "Reply-To: ". strip_tags($from) . "\r\n";
			$headers	.= "MIME-Version: 1.0\r\n";
			$headers 	.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($to,$subject,$body,$headers);
		}
		else 
		{
			$arr = array(  'ms'=> 'Please Contact our Technical Team' );
			echo json_encode($arr);
		}
	}
	if(isset($_POST['re_phone']))
	{
		$re_phone	=mysql_real_escape_string($_POST['re_phone']);
		$re_operator=mysql_real_escape_string($_POST['re_operator']);
		$re_amount	=mysql_real_escape_string($_POST['re_amount']);
		$re_email	=mysql_real_escape_string($_POST['re_email']);
		if((isset($_COOKIE['cmb_eml'])) && ($_COOKIE['cmb_eml'] == $re_email) && (checkamount($re_amount,$re_email)== true ))
		{
			mysql_query("INSERT INTO Recharge(re_phone,re_operator,re_amount,re_email,client,forward,remote,browser,datestamp)
					   VALUES('$re_phone','$re_operator','$re_amount','$re_email','$client','$forward','$remote','$browser','$datestamp')");
			$arr = array(  'ms'=> 'Thank You !!' );
			echo json_encode($arr);
			$to			= 'care@cropmybill.com';
			$subject	= "Recharge";
			$from 		= 'no-reply@cropmybill.com';
			$body		= 'Phone Number = '.$re_phone.' <br>
							Operator = '.$re_operator.' <br>
							Amount = '.$re_amount.' <br>
							Request Email = '.$re_email.'';
			$headers 	= "From: " . strip_tags($from) . "\r\n";
			$headers	.= "Reply-To: ". strip_tags($from) . "\r\n";
			$headers	.= "MIME-Version: 1.0\r\n";
			$headers 	.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($to,$subject,$body,$headers);
		}
		else 
		{
			$arr = array(  'ms'=> 'Please Contact our Technical Team' );
			echo json_encode($arr);
		}
	}
	if(isset($_POST['friend_email']))
	{
		$friend_email	=$_POST['friend_email'];
		$your_message	=$_POST['your_message'];
		$yourlink		=$_POST['yourlink'];
		if (!filter_var($friend_email, FILTER_VALIDATE_EMAIL) === true) // Validate email address
		{
			$arr = array(  'ms'=> 'Please enter valid email address' );
			echo json_encode($arr);
		}else
		{
			$to			= $friend_email;
			$subject	= "CropmyBill - Refer And Earn Invite";
			$from 		= 'care@cropmybill.com';
			$body		= $your_message.'  <br/> <br/> <a href="'.$yourlink.'">Click here</a> to join CropmyBill '.$yourlink.'';
			$headers 	= "From: " . strip_tags($from) . "\r\n";
			$headers	.= "Reply-To: ". strip_tags($from) . "\r\n";
			$headers	.= "MIME-Version: 1.0\r\n";
			$headers 	.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			mail($to,$subject,$body,$headers);
			$arr = array(  'ms'=> 'Invite Sent' );
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
	function checkamount($amount,$email)
	{
		$total = 0;
		$q = "SELECT vcommision.id as id,vcommision.Offer_name as Offer_name, vcommision.status as status, vcommision.payout, vcommision.datetime as datetime, redirect3.aff_sub as session
				FROM vcommision
				INNER JOIN redirect3
				ON vcommision.`affiliate_info1`=redirect3.aff_sub and redirect3.session = '$email'
				GROUP BY vcommision.id;";
		$result = mysql_query($q) or die("query1");
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
			if(($rows['status'] == 'approved') && ($d_dif>30))
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
		$result = mysql_query($q) or die("query1");
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
		$paid 		= mysql_fetch_array($result);
		$bank 		= $paid['bank'];
		$recharge	= $paid['recharge'];
		if($amount <= (($approved+$count_act)-($bank + $recharge)))
			return true;
		else
			return false;
	}
mysql_close($conn);
?>