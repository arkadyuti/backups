<?php
date_default_timezone_set("Asia/Kolkata");
$t = microtime(true);
$micro = sprintf("%06d",($t - floor($t)) * 1000000);
$d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
$mTime = $d->format("Y-m-d H:i:s");
$host='';
$port='';
$query='';
$scheme='';
$path='';
$client  		= @$_SERVER['HTTP_CLIENT_IP'];
$forward 		= @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  		= $_SERVER['REMOTE_ADDR'];
$browser		= $_SERVER['HTTP_USER_AGENT'];
$url			= $_SERVER["REQUEST_URI"];
$uri			= $url;
if(strpos($url,"?")>-1){
$a=explode("?",$url,2);
$url=$a[0];
$query=$a[1];
}
if(strpos($url,"://")>-1){
$scheme=substr($url,0,strpos($url,"//")-1);
$url=substr($url,strpos($url,"//")+2,strlen($url));

}
if(strpos($url,"/")>-1){
$a=explode("/",$url,2);
$url=$a[0];
$path="/".$a[1];
}

if(strpos($url,":")>-1){
$a=explode(":",$url,2);
$url=$a[0];
$port=$a[1];
}
$host=$url;
$url=null;
foreach(array("url","scheme","host","port","path","query") as $var){
if(!empty($var)){
$return[$var]=$var;
}
}
array("url"=>$uri,"scheme"=>$scheme,"host"=>$host,"port"=>$port,"path"=>$path,"query"=>$query,"a"=>$url);
//echo 'url='.$uri .'<br>scheme='. $scheme.'<br>host='.$host.'<br>port='.$port.'<br>path='.$path.'<br>query='.$query.'<br>url='.$url;

$temp=explode('&&',$query);
$tmp=explode('cname=',$temp[0]);
$cname = $tmp[1];

$tmp=explode('ses=',$temp[1]);
$sessn = $tmp[1];


$tmp=explode('url=',$temp[2]);
$reUrl = $tmp[1];
//echo '<br>'.$timestamp.'<br>'.$sessn.'<br>'.$reUrl;
$temp=explode('&',$reUrl);
$aff_date = date("YmdHis");
if(isset($temp[3]))
{
	$temp=explode('=',$temp[3]);
	if($temp[0]=='aff_sub')
		$aff_sub=$temp[1];
	else
		$aff_sub='0';
}elseif(isset($temp[2]))
{
	$temp=explode('=',$temp[2]);
	if($temp[0]=='aff_sub')
		$aff_sub=$temp[1];
	else
		$aff_sub='0';
}elseif(isset($temp[1]))
{
	$temp=explode('=',$temp[1]);
	if($temp[0]=='affExtParam1')
		$aff_sub=$temp[1];
	else
		$aff_sub='0';
}
else
	$aff_sub='0';

$mysql_user 	= "arka_cropmybill";
$mysql_pass 	= "9735525775";
$mysql_database	= "arka_cropmybill";
$mysql_table 	= "redirect3";
$conn	=	mysql_connect("localhost",$mysql_user,$mysql_pass) or die ("connection error");
$query  = "create database if not exists $mysql_database";
mysql_query($query, $conn) or die ("database not created");
mysql_select_db($mysql_database, $conn) or die ("database not selected");
mysql_query("CREATE TABLE IF NOT EXISTS $mysql_table
		(
			ID int NOT NULL AUTO_INCREMENT,
			session varchar(50),
			cname varchar(20),
			aff_sub varchar(20),
			client varchar(20),
			remote varchar(20),
			forward varchar(300),
			browser varchar(300),
			reUrl varchar(300),
			timestamp varchar(20),
			PRIMARY KEY (ID)
		)") or die("Could not create table");
mysql_query("INSERT INTO $mysql_table(session,cname,aff_sub,client,remote,forward,browser,reUrl,timestamp)
				   VALUES('$sessn','$cname','$aff_sub','$client','$remote','$forward','$browser','$reUrl','$mTime')") or die("not inserted into $mysql_table");

mysql_close($conn);
header('Refresh: 0;url='.$reUrl.''); 
	
?>