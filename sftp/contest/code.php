<?php 
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;  ");
date_default_timezone_set("Asia/Kolkata");
$mysql_user 	= "arka_cropmybill";
$mysql_pass 	= "9735525775";
$mysql_database	= "arka_contest";
$client  		= @$_SERVER['HTTP_CLIENT_IP'];
$forward 		= @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  		= $_SERVER['REMOTE_ADDR'];
$browser		= $_SERVER['HTTP_USER_AGENT'];
$datestamp		= date('Y-m-d H:i:s');
$conn			= mysql_connect("localhost",$mysql_user,$mysql_pass);
$email = $_COOKIE['cmb_eml'];
$total_money = 40000;
mysql_select_db($mysql_database, $conn);
	if(isset($_POST['cvalue']))
	{
		$cvalue = mysql_real_escape_string($_POST['cvalue']);
		//$p_value = substr($cvalue, -1);
		$p_value = substr($cvalue, 3,5);
		$action = substr($cvalue, 0, 3);
		if($action=='abc')
		{
			$query = mysql_query("SELECT * from cart where product_id = '$p_value' and user = '$email'") or die("E");
			$dbarray = mysql_fetch_array($query, MYSQL_ASSOC);
			//if($dbarray['status'] == 0)
			if((!$dbarray))
			{
				setcookie('cmb_cc', '', time()-1000, '/');
				$q_price = mysql_query("SELECT price,cashback from products where id = '$p_value'") or die("E");
				$db_price = mysql_fetch_array($q_price, MYSQL_ASSOC);
				$price = $db_price['price'];
				$cb = $db_price['cashback'];
				
				$query_insert = mysql_query("INSERT INTO `arka_contest`.`cart` (`cart_id`, `product_id`, `user`, `status`, `price`, cb) VALUES (NULL, '$p_value', '$email', '1', $price, $cb);") or die("E");
				$q_spent = mysql_query("SELECT sum(price) as spent from cart where user = '$email' and status='1' ") or die("E");
				$db_spent = mysql_fetch_array($q_spent, MYSQL_ASSOC);
				$spent = $db_spent['spent'];
				if($spent>$total_money)
				{
					$query_update = mysql_query("UPDATE `cart` SET `status`= '0' WHERE product_id = '$p_value' and user = '$email'") or die("E");
					$q_spent = mysql_query("SELECT sum(price) as spent from cart where user = '$email' and status='1' ") or die("E");
					$db_spent = mysql_fetch_array($q_spent, MYSQL_ASSOC);
					$spent = $db_spent['spent'];
					$arr = array( 'ms'=> $spent , 'blanket'=> $p_value , 'update'=> $p_value );
				}else
				{
					$rem_bal = $total_money - $spent;
					$arr = array(  'ms'=> $spent, 'remaining_bal'=> $rem_bal );
				}
				echo json_encode($arr);
			}elseif(isset($dbarray['status']))
			{
				setcookie('cmb_cc', '', time()-1000, '/');
				$query_update = mysql_query("UPDATE `cart` SET `status`= '1' WHERE product_id = '$p_value' and user = '$email'") or die("E");
				$q_spent = mysql_query("SELECT sum(price) as spent from cart where user = '$email' and status='1' ") or die("E");
				$db_spent = mysql_fetch_array($q_spent, MYSQL_ASSOC);
				$spent = $db_spent['spent'];
				if($spent>$total_money)
				{
					$query_update = mysql_query("UPDATE `cart` SET `status`= '0' WHERE product_id = '$p_value' and user = '$email'") or die("E");
					$q_spent = mysql_query("SELECT sum(price) as spent from cart where user = '$email' and status='1' ") or die("E");
					$db_spent = mysql_fetch_array($q_spent, MYSQL_ASSOC);
					$spent = $db_spent['spent'];
					$arr = array( 'ms'=> $spent , 'blanket'=> $p_value , 'update'=> $p_value );
				}else
				{
					$rem_bal = $total_money - $spent;
					$arr = array(  'ms'=> $spent , 'remaining_bal'=> $rem_bal);
				}
				echo json_encode($arr);
			}
			else
			{
				$arr = array(  'ms'=> $cvalue.'error' );
				echo json_encode($arr);
			}
				
		}
		else
		{
			$query_update = mysql_query("UPDATE `cart` SET `status`= '0' WHERE product_id = '$p_value' and user = '$email'") or die("E");
			$q_spent = mysql_query("SELECT sum(price) as spent from cart where user = '$email' and status='1' ") or die("E");
				$db_spent = mysql_fetch_array($q_spent, MYSQL_ASSOC);
				$spent = $db_spent['spent'];
				$rem_bal = $total_money - $spent;
				if($spent==0)
					$spent = '0';
				$arr = array(  'ms'=> $spent , 'remaining_bal'=> $rem_bal );
				echo json_encode($arr);
		}
		/*$q_p = "SELECT * products WHERE status = 1";
		$cart_result = mysql_query($q_p) or die("query");
		$name_conf	= array();
		$name_pend	= array();
		WHILE($res = mysql_fetch_array($cart_result))
		{
			
			if(isset($res['id']))
			{
				
				//echo $res['status'];
				if((isset($res['status']))&&($res['status'] == 1))
				{
					$name_pend[] = $res['product_id'];
				}else
				{
					$name_conf[] = $res['id'];
				}
				
			}
		}
		$arr = array(  'ms'=> $name_pend );
					echo json_encode($arr);
					/*
		foreach ($name_conf as &$value) {
			//echo $value;
			echo '<script>document.getElementById("abc'.$value.'").style.display = "block";</script>';
			echo '<script>document.getElementById("def'.$value.'").style.display = "none";</script>';
		}
		foreach ($name_pend as &$value) {
			//echo $value;
			echo '<script>document.getElementById("abc'.$value.'").style.display = "none";</script>';
			echo '<script>document.getElementById("def'.$value.'").style.display = "block";</script>';
		}*/
	}
	if(isset($_POST['removecart']))
	{
		$removecart = mysql_real_escape_string($_POST['removecart']);
		$query_update = mysql_query("UPDATE `cart` SET `status`= '0' WHERE product_id = '$removecart' and user = '$email'") or die("E");
		$arr = array(  'ms'=> $removecart );
			echo json_encode($arr);
	}
	if(isset($_POST['questions']))
	{
		$user_name	 = $_POST['user_name'];
		$user_ph	 = $_POST['user_ph'];
		$college	 = $_POST['college'];
		$result = '';
		for($i=1;$i<21;$i++)
		{
			$result .=$_POST[$i];
		}
		//$one = substr(chunk_split($one, 8, ':'), 0, -1);
		//$onee = explode(' ',$one);
		$result = str_split($result, 4);
		mysql_query("INSERT INTO `arka_contest`.`questions` (`question_id`, `eamil`, `question_one`, `question_two`, `question_three`, `question_four`, `question_five`) VALUES (NULL, '$email', '$result[0]', '$result[1]', '$result[2]', '$result[3]', '$result[4]');");
		mysql_query("UPDATE `user` SET user_name = '$user_name' ,user_ph = '$user_ph', college= '$college' , `active`='0' WHERE user_email='$email'") or die("a");
		$arr = array(  'ms'=> $result[0] );
			echo json_encode($arr);
	}
	if(isset($_POST['check_bal']))
	{
		$q_spent = mysql_query("SELECT sum(price) as spent from cart where user = '$email' and status='1' ") or die("E");
		$db_spent = mysql_fetch_array($q_spent, MYSQL_ASSOC);
		$spent = $db_spent['spent'];
		$rem_bal = $total_money - $spent;
		if($spent==0)
			$spent = '0';
		$arr = array(  'ms'=> $spent ,'remaining_bal'=> $rem_bal );
		echo json_encode($arr);
	}
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
	
mysql_close($conn);
?>