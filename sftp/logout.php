<?php
session_start();
$temp=$_GET['log'];
//die($temp);
//setcookie('cmb_nm', '', time()-1000, '/');
setcookie('cmb_ssn', '', time()-1000, '/');
setcookie('cmb_vld', '', time()-1000, '/');
setcookie('cmb_nm', '', time()-1000, '/');
setcookie('cmb_lk', '', time()-1000, '/');
setcookie('cmb_r', '', time()-1000, '/');
/*
if (isset($_SERVER['HTTP_COOKIE'])) 
{
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) 
	{
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
*/
session_destroy();
header('Location: .'.$temp.''); // Redirecting Previous page
?>