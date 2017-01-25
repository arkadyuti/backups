<?php
	$host = "localhost";
	$user = "arka_cropmybill";
	$pass = "9735525775";
	$db = "arka_contest";
	
	$connection = new mysqli($host, $user, $pass, $db);
	
	if (!$connection) {
	
		die ("Error connecting");
		
	}
	else {
		$query = "SELECT * FROM products";
		$result = $connection->query($query);
		$userid = 1;
		$query = "SELECT * FROM playercart WHERE id = {$userid}";
		$cartbox = $connection->query($query);
		foreach($cartbox as $x) {
			$cart = $x;
		}
		$query = "SELECT * FROM player WHERE id = {$userid}";
		$playerdet = $connection->query($query);
		foreach($playerdet as $x) {
			$userdet = $x;
		}
	}
?>