<html>
<body>
<div>		
<span style='float:right'><a href='?id=logout'>Logout</a></span>	
</div>		
<h2>User Details</h2>
<?php
session_start();
if($_GET['id']=='logout')
{
unset($_SESSION['userdetails']);
session_destroy();
echo '<script>window.location = "http://test.cropmybill.com/";</script>';
}
require 'instagram.class.php';
require 'instagram.config.php';
if (!empty($_SESSION['userdetails'])) 
{
$data=$_SESSION['userdetails'];
echo "<div style='float:left;margin-right:10px'><img src=\"{$data->user->profile_picture}\" ></div><div style='float:left'>";  
echo '<b>Name:</b> '.$data->user->full_name.'</br>';
echo '<b>Username:</b> '.$data->user->username.'</br>';
echo '<b>User ID:</b> '.$data->user->id.'</br>';
echo '<b>Bio:</b> '.$data->user->bio.'</br>';
echo '<b>Website:</b> '.$data->user->website.'</br>';
echo '<b>Profile Pic:</b> '.$data->user->profile_picture.'</br>';
echo '<b>Access Token:</b> '.$data->access_token.'</br></div>';
$access = $data->access_token;

	$url = 'https://api.instagram.com/v1/users/'.$data->user->id.'/follows?access_token='.$access.'';
	$get = file_get_contents($url);
    $json = json_decode($get);
	var_dump($json);
$instagram->setAccessToken($data);
}
else
{	
header('Location: index.php');
}
?>
<div>
<?php
$popular = $instagram->getUserMedia($data->user->id);
// Display results
foreach ($popular->data as $data) {
  echo "<img src=\"{$data->images->thumbnail->url}\">";
}
?>
</div>
<h2>Instagram Data Array</h2>
<div>
	<?php 
	//$url = 'https://api.instagram.com/v1/users/'.$data->user->id.'/follows?access_token='.$access.''
	
	/*
	
	$print = $instagram1->$url;
	echo '<pre>' . print_r($instagram1) . '</pre>';
	echo $url;
	/*
	echo '<pre>';
	   print_r($data);
	   echo '<pre>';
	*/
	echo $url;
	?>
	</div>
</body>
</html>