<?php
session_start();

if(session_destroy()) // Destroying All Sessions
{
	
header("Location: http://m.cropmybill.com/"); // Redirecting To Home Page
}
?>