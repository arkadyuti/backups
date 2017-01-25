<?php
if(isset($_POST['passw']))
{
	if($_POST['passw']=='cropnew')
		setcookie("set_for", 'cropnew', time()+(60*60*24*30*6) );
}
if(!isset($_COOKIE['set_for']))
{
	{
		echo '	<form method="POST" action="" autocomplete="off">
					<input type="password" name="passw"/>
					<input type="submit" value="submit"/>
				</form>
			';
		die("Not Authorize");
	}
}
?>
<script>
//window.history.pushState("object or string", "Title", "/new-url");
</script>
<form method="POST">
	<input type="text" name="email"/>
	<input type="submit" value="submit"/>
</form>

<?php

if(isset($_POST['email']))
{
	$conn = mysql_connect("localhost",'cropmybill','su4adu9ez') or die ("connection error");
	mysql_select_db('suvankar_cropmybill', $conn) or die ("database not selected");
	
	$email = $_POST['email'];
	echo '
		<table class="acc_table">
		<tr>
			<td>Date</td>
			<td>Merchant</td>
			<td>Amount</td>
			<td>Status</td>
			<td>Probable Confirmed Date</td>
		</tr>
		';
		$total = 0;
		$approved = 0;
		$q = "SELECT flipkart.id as id,flipkart.Title as Offer_name, flipkart.status as status, flipkart.payout, flipkart.OrderDate as datetime, redirect3.session as session, redirect3.aff_sub as aff_sub
				FROM flipkart
				INNER JOIN redirect3
				ON flipkart.`affiliate_info1`=redirect3.aff_sub and redirect3.session = '$email'
				GROUP BY flipkart.id order by flipkart.`affiliate_info1` desc;";
		$result = mysql_query($q) or die("query1");
		WHILE($rows = mysql_fetch_array($result))
		{
			echo '<tr>';
			
			//echo $rows['id'].'-		-Flipkart-	-'.$rows['status'].'-	-'.$rows['payout'].'-	-'.$rows['datetime'].'-	-'.$rows['session'];
			$payout = (number_format(($rows['payout']), 2, '.', ''));
			$datestamp = date_format(new DateTime($rows['datetime']), 'jS F Y');
			$probable = $rows['session'];;
			if(isset($rows['status']))
			{
				if ($rows['status'] == 'tentative')
					$status = 'Pending';
				elseif($rows['status'] == 'processed')
					$status = 'Confirmed';
				else
					$status = 'Pending';
			}
			echo '<td>'.$datestamp.'</td><td>Flipkart</td><td>'.(number_format(($payout*(.9)), 2, '.', '')).'</td><td>'.$status.'</td><td>'.$probable.'</td><td>'.$rows['aff_sub'].'</td>';
			echo '</tr>';
			if($rows['status'] == 'processed')
				$approved = $approved + (number_format(($payout*(.9)), 2, '.', ''));
			$total = $total + number_format(($payout*(.9)), 2, '.', '');
		}
		$q = "SELECT vcommision.id as id,vcommision.Offer_name as Offer_name, vcommision.status as status, vcommision.payout, vcommision.datetime as datetime, redirect3.session as session, redirect3.aff_sub as aff_sub
				FROM vcommision
				INNER JOIN redirect3
				ON vcommision.`affiliate_info1`=redirect3.aff_sub and redirect3.session = '$email'
				GROUP BY vcommision.id order by vcommision.datetime desc;";
		$result = mysql_query($q) or die("query1");
		
		WHILE($rows = mysql_fetch_array($result))
		{
			echo '<tr>';
			$Offer_name = explode('.',$rows['Offer_name']);
			$payout = (number_format(($rows['payout']), 2, '.', ''));
			$datestamp = date_format(new DateTime($rows['datetime']), 'jS F Y');
			$approve_date = date('jS F Y');

			//echo $approve_date.'<br>';
			//echo $datestamp.'<br>';
			$datetime1 = date_create($approve_date);
			$datetime2 = date_create($datestamp);
			$interval = date_diff($datetime1, $datetime2);
			$d_dif = $interval->format('%a');
			$status = 'Pending';
			if(($rows['status'] == 'approved') && ($d_dif>90))
			{
				$approved = $approved + (number_format(($payout*(.9)), 2, '.', ''));
				$status = 'Confirmed';
			}
			$total = $total + number_format(($payout*(.9)), 2, '.', '');
			$probable = $rows['session'];
			echo '<td>'.$datestamp.'</td><td>'.$Offer_name[0].'</td><td>'.(number_format(($payout*(.9)), 2, '.', '')).'</td><td>'.$status.'</td><td>'.$probable.'</td><td>'.$rows['aff_sub'].'</td>';
			echo '</tr>';
			
		}
		
		
	echo '</table>';
	$q 			= "SELECT pending,confirmed,refer_code FROM login WHERE signup_email = '$email'";
	$re 		= mysql_query($q) ;
	$qre 		= mysql_fetch_array($re, MYSQL_ASSOC) ;
	//$temp 	= explode(" ",$qre['signup_name']);
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
	echo '
	<div class="account_head" style="font-size:24px;margin: 30px 30px 0;">Referral Earning(&#8377; '.($count_ref+$count_act).')</div>
	<table class="acc_table">
		<tr>
			<td>ID</td>
			<td>Friend&#39s Name</td>
			<td>Status</td>
			<td>Bonus</td>
		</tr>
		';
		$count_id = 1;
		foreach ($name_conf as $value) 
		{
			echo '<tr><td>'.$count_id.'</td>';
			echo '<td>'.$value.'</td>';
			echo '<td>Active</td>';
			echo '<td>Rs. 10</td></tr>';
			$count_id++;
		}
		foreach ($name_pend as $value) 
		{
			echo '<tr><td>'.$count_id.'</td>';
			echo '<td>'.$value.'</td>';
			echo '<td>Not Active</td>';
			echo '<td>Rs. 10</td></tr>';
			$count_id++;
		}
	
	echo ' </table>';
	$result		= mysql_query("SELECT (SELECT SUM(transfer_amount) as tmp1 from BankTransfer where bank_email = '$email') as bank,
						(SELECT SUM(re_amount) as tmp2 from Recharge where re_email = '$email') as recharge
						FROM BankTransfer, Recharge ");
	if($result)
	{
		$paid 		= mysql_fetch_array($result, MYSQL_ASSOC);
		$bank 		= $paid['bank'];
		$recharge	= $paid['recharge'];
	}else
	{
		$bank 		= 0;
		$recharge	= 0;
	}
	echo '<div style="position:fixed;right:40px;top:0px;"><br>Total Earnings: ';
	echo $total+$count_ref+$count_act;
	echo '<br>Paid Earnings: ';
	echo $bank + $recharge;
	
	if((($approved+$count_act)-($bank + $recharge))<0)
		$available_e = 0;
	else
		$available_e = (($approved+$count_act)-($bank + $recharge));
	echo '<br>Available for payment: ';
	echo $available_e;
	echo '<br>Cashback waiting for approval: ';
	echo $total - $approved;
	echo '<br>Referral Earnings: ';
	echo $count_ref+$count_act;
	echo '</div>';
	
	mysql_close($conn);
}
?>

	
