<?php
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

if((isset($_GET['action']))&&(isset($_GET['temp']))&&(isset($_GET['temp'])))
{
	
	//header('Refresh: 5;url="http://cropmybill.com/"'); 
	//echo "Under Construction";
	
    if($_GET['action']=="reset")
    {
        $encrypt = mysql_real_escape_string($_GET['encrypt']);
        $encrypt2 = mysql_real_escape_string($_GET['temp']);
		$query = mysql_query("SELECT ID,email,signup_name FROM reset_email where encrypt='".$encrypt."' AND temp='".$encrypt2."' AND active='1'") or die("md5");
		$Results  = mysql_fetch_array($query);
		
		mysql_query("update reset_email set active='0'") or die("not active");
				   
		if($Results)
		{
			$signin_email = mysql_real_escape_string($Results['email']);
			$_SESSION['signin_email'] = $signin_email;
			$signup_name = $Results['signup_name'];
			setcookie('cmb_eml', $signin_email, time() + (24*60*60*30), "/");
			setcookie('cmb_nm', $signup_name, time() + (24*60*60*30), "/");
			$result = mysql_query("select ID from login where signup_email = '$signin_email'");
			$dbarray = mysql_fetch_array($result, MYSQL_ASSOC);
			$signin_id_md5 = md5(420+$dbarray['ID']);
			setcookie('cmb_ssn', ($dbarray['ID']+20), time() + (24*60*60*30), "/");
			setcookie('cmb_vld', $signin_id_md5, time() + (24*60*60*30), "/");
			header('Refresh: 2;url="http://cropmybill.com/account"');
			echo "<br>You are redirecting";
			$success1="<span style='color:red;'>kindly change your password</span>";
		}
		else
			echo '<br>False Token<br>Your email link is not valid';
		
        
    } 
}
elseif(isset($_POST['action']))
{
	/*

    $encrypt      = mysqli_real_escape_string($connection,$_POST['action']);
    $password     = mysqli_real_escape_string($connection,$_POST['password']);
    $query = "SELECT id FROM users where md5(90*13+id)='".$encrypt."'";

    $result = mysqli_query($connection,$query);
    $Results = mysqli_fetch_array($result);
    if(count($Results)>=1)
    {
        $query = "update users set password='".md5($password)."' where id='".$Results['id']."'";
        mysqli_query($connection,$query);

        $message = "Your password changed sucessfully <a href=\"http://demo.phpgang.com/login-signup-in-php/\">click here to login</a>.";
    }
    else
    {
        $message = 'Invalid key please try again. <a href="http://demo.phpgang.com/login-signup-in-php/#forget">Forget Password?</a>';
    }
	*/
}
mysql_close($conn);
?>