<div class="account_head" style="margin: 30px 0 30px;">My Account</div>
<div class="account_menu allfont">
	<div class="account_float">
		<a href="/account">
			<div class="account_box">My Account</div>
		</a>
	</div>
	<div class="account_float">
		<a href="/earning">
			<div class="account_box selected">My Earning</div>
		</a>
	</div>
	<div class="account_float">
		<a href="/redeem">
			<div class="account_box">Redeem</div>
		</a>
	</div>
	<div class="account_float">
		<a href="/missing-cashback">
			<div class="account_box">Missing Cashback?</div>
		</a>
	</div>
</div>
<div class="account_body" style="position:relative;">
	<div class="acc_hover allfont" style="float:right;">
		<section class="acc_right">
			<h3 style="margin:0px 0 11px;color:#555;font-size:18px;">My Earnings</h3>
			<div class="right_text">Total Earnings<div style="float:right;">&#8377; <span id="total_earning"></span></div></div>
			<div class="right_text">Paid Earnings<div style="float:right;">&#8377; <span id="paid_earning"></span></div></div>
			<div class="right_text">Earnings Available<div style="float:right;">&#8377; <span id="available_earning"></span></div> for payment</div>
			<div class="right_text">Cashback waiting <div style="float:right;">&#8377; <span id="waiting_earning"></span></div>retailer approval</div>
			<div class="right_text">Referral Earnings<div style="float:right;">&#8377; <span id="refer_earning"></span></div></div>
		</section>
		<section class="acc_right" style="height: auto;">
			<h3 style="margin:0px 0 11px;color:#555;font-size:18px;">Frequently Asked Questions</h3>
			<div class="right_text"><strong>When do I get my cashback?</strong><br>Once the return period of your product is over, your cashback then becomes ready to be redeemed.</div>
			<div class="right_text"><strong>How to redeem my wallet cash?</strong><br>To redeem your wallet cash you can either 1)Recharge Your Phone - no minimum limit. 2)Transfer to Bank - Rs.250 minimum in your wallet.</div>
			<div class="right_text"><strong>How long does it take for you to reply?</strong><br>We respond to queries as soon as possible (usually within a few hours) but it may take upto 48 working hours to respond to your query.</div>
		</section>
	</div>

	<div class="account_head" style="font-size:24px;margin: 30px 30px 0;">Cashback Earning (&#8377; <span id="cashback_earning"></span>)</div>
	<table class="acc_table">
		<tr>
			<td>Date</td>
			<td>Merchant</td>
			<td>Amount</td>
			<td>Status</td>
			<td>Probable Confirmed Date</td>
		</tr>
		<?php
		$total = 0;
		$approved = 0;
		$email = $session;
		$q = "SELECT flipkart.id as id,flipkart.Title as Offer_name, flipkart.status as status, flipkart.payout, flipkart.OrderDate as datetime, redirect3.session as session
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
			$probable = date('jS F Y',strtotime(''.$datestamp.' + 90 days'));
			if(isset($rows['status']))
			{
				if ($rows['status'] == 'tentative')
					$status = 'Pending';
				elseif($rows['status'] == 'processed')
					$status = 'Confirmed';
				else
					$status = 'Pending';
			}
			echo '<td>'.$datestamp.'</td><td>Flipkart</td><td>'.(number_format(($payout*(.9)), 2, '.', '')).'</td><td>'.$status.'</td><td>'.$probable.'</td>';
			echo '</tr>';
			if($rows['status'] == 'processed')
				$approved = $approved + (number_format(($payout*(.9)), 2, '.', ''));
			$total = $total + number_format(($payout*(.9)), 2, '.', '');
		}
		$q = "SELECT vcommision.id as id,vcommision.Offer_name as Offer_name, vcommision.status as status, vcommision.payout, vcommision.datetime as datetime, redirect3.aff_sub as session
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
			$probable = date('jS F Y',strtotime(''.$datestamp.' + 90 days'));
			echo '<td>'.$datestamp.'</td><td>'.$Offer_name[0].'</td><td>'.(number_format(($payout*(.9)), 2, '.', '')).'</td><td>'.$status.'</td><td>'.$probable.'</td>';
			echo '</tr>';
			
		}
		?>
	</table>
	<?php
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
	?>
	</table>
	<div class="account_head" style="font-size:24px;margin: 30px 30px 0;">Clicks History</div>
	<table class="acc_table">
		<tr>
			<td>ID</td>
			<td>Merchant</td>
			<td>Time</td>
			<td>Total Clicks</td>
		</tr>
		<?php
		$result = mysql_query("SELECT * FROM redirect3 WHERE session='$email' ORDER BY `timestamp` DESC LIMIT 5") or die("query1");
		$count=1;
		WHILE($rows = mysql_fetch_array($result))
		{
			$product_name = $rows['cname'];
			$time = date_format(new DateTime($rows['timestamp']), 'jS F Y g:ia');
			$aff_sub = $rows['aff_sub'];
			$result2=mysql_query("SELECT count(cname) as total from redirect3 WHERE cname='$product_name' AND session='$email'");
			$data=mysql_fetch_assoc($result2);
			$clicks=$data['total'];
			echo '
			<tr>
			<td>'.$aff_sub.'</td>
			<td>'.$product_name.'</td>
			<td>'.$time.'</td>
			<td>'.$clicks.'</td></tr>
			';
			$count = $count+1;
		}
		?>
	</table>
</div>
<?php
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

?>

<script>
	document.getElementById("cashback_earning").innerHTML = "<?php echo $total;?>";
	document.getElementById("total_earning").innerHTML = "<?php echo $total+$count_ref+$count_act;?>";
	document.getElementById("paid_earning").innerHTML = "<?php echo $bank + $recharge;?>.00";
	<?php 
	if((($approved+$count_act)-($bank + $recharge))<0)
		$available_e = 0;
	else
		$available_e = (($approved+$count_act)-($bank + $recharge))
	?>		
	document.getElementById("available_earning").innerHTML = "<?php echo $available_e;?>";
	document.getElementById("waiting_earning").innerHTML = "<?php echo $total - $approved;?>";
	document.getElementById("refer_earning").innerHTML = "<?php echo $count_ref+$count_act;?>";
</script>












