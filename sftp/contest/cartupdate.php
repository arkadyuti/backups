<?php
	require('./connection.php');
	if(isset($_GET['id']) && isset($_GET['step'])) {
		$id = $_GET['id'];
		$step = $_GET['step'];
		if($step == 'delete')
		{
			$query = "UPDATE products SET incart = 0 WHERE id={$id}";
			$result = $connection->query($query);
			echo "tick";
		}
		else if($step == 'add')
		{
			$carttotal = 0;
			foreach($result as $row)
			{
				if($row['incart'] == 1 )
					$carttotal += $row['price'];
				else if($row['id'] == $id)
					$carttotal += $row['price'];
			}
			if($carttotal > 4000)
				echo 'overflow';
			else
			{
				$query = "UPDATE products SET incart = 1 WHERE id={$id}";
				$result = $connection->query($query);
				echo "tick";
			}
		}
		else
		{
			echo "fail";
		}
	}
?>