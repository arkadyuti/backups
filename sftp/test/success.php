<?php
require 'instagram.class.php';
require 'instagram.config.php';
$code = $_GET['code'];
if (true === isset($code)) {
  $data = $instagram->getOAuthToken($code);
if(empty($data->user->username))
{
header('Location: index.php');
}
else
{
	session_start();
	$_SESSION['userdetails']=$data;
	$user=$data->user->username;
	$fullname=$data->user->full_name;
	$bio=$data->user->bio;
	$website=$data->user->website;
	$id=$data->user->id;
	$token=$data->access_token;
header('Location: home.php');
}
} 
else 
{
if (true === isset($_GET['error'])) 
{
    echo 'An error occurred: '.$_GET['error_description'];
}
}
?>