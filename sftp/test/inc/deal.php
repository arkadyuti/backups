<?php
if(!isset($user))
	$user='';
if(isset($brand))
{
	if(isset($_SESSION['access_token']))
	{
		$session= $userData->email; 
	}elseif(isset($_SESSION['signin_email']))
	{
		$session=$_SESSION['signin_email'];
	}
	elseif($user)
	{
		$session= $user_profile['email'];
	}
	else
	{
		$session='anonymous';
	}
	$aff_date = date("YmdHis");
	$q="SELECT * FROM table11 WHERE ExpDate >= '$today' AND OfferName LIKE '".$brand."%' AND Type='Promotion'";
	$result = mysql_query($q) or die("query");
	echo '
	<div id="website_deals">
		<div class="headerdeals"> '.$brand.' Deals</div>
		<div id="headerdeals_float">
		';
		WHILE($rows = mysql_fetch_array($result))
		{
			$url = $rows['url'];
			$desc = $rows['Desc'];
			$title = $rows['Title'];
			$date = $rows['ExpDate'];
			echo '
			<div class="deals1">
				<div class="deals_title"> 
					'.$title.'
				</div>
				<div class="deals_desc">
				'.$desc.'
				</div>
				<div class="deals_click">
					<a class="hoverdeals" href="#"> Join Us to get offer</a>
				</div>
				<div class="deals_click2">
				<a class="hoverdeals" href="/crop.php?cname='.$brand.'_deals&&ses='.$session.'&&url='.$url.'&aff_sub='.$aff_date.'" target="_blank"> Click to activate offer</a>
					<a style="display:none;" class="hoverdeals" href="'.$url.'" target="_blank"> Click to activate offer</a>
				</div>
				<div class="deals_discount">
					Discount added automatically
				</div>
				<div class="deals_expire">
					Expire on '.$date.'
				</div>
			</div>
			';
		}
		echo '
		</div>
		<div class="rightdiv">
			<div class="notice_right">
				<div class="notice_text" style="font-weight:bold;font-style:normal;font-size:1.1em;text-align:center;">Please Note</div>
				<hr style="width:90%;">
				<div class="notice_text">Do not forget to login before purchasing and purchase in the same session.</div>
				<div class="notice_text">Do not visit any other coupon or price comparison site after clicking-out from CropmyBill.com.This ensures you get your cashback.</div>
				<div class="notice_text">Only use coupon codes available on CropmyBill(not those emailed or SMS`ed to you by '.$brand.' directly).</div>
			</div>
			<div class="steps_right">
				<div class="notice_text" style="font-weight:bold;font-style:normal;font-size:1.1em;text-align:center;">Steps for cashback</div>
				<hr style="width:90%;">
				<div class="steps_bold">Join Us</div>
					<div class="steps_text">Sign up on CropmyBill.com to create your account.</div>
				<div class="steps_bold">Shop via us </div>
					<div class="steps_text">Go to your preferred retailer through CropmyBill.com and shop like you normally do.</div>
				<div class="steps_bold">Redeem </div>
					<div class="steps_text">Once your cashback is confirmed either recharge your phone or transfer the money to your account</div>
			</div>
		</div>
	</div>
	';
} 

else
{
	$result=mysql_query("SELECT count(PromoID) as total from table11 WHERE ExpDate >= '$today' AND Type='Promotion'");
	$data=mysql_fetch_assoc($result);
	$count=$data['total'];
	$count2 = $count;
	$q="SELECT OfferName,PromoID,ExpDate FROM table11 WHERE ExpDate >= '$today' AND Type='Promotion' GROUP BY OfferName";
	$result = mysql_query($q) or die("query");
	echo '
	<div style="float:left;background: #CCFFCC;margin-bottom: 35px;">
		<div class="trending_body">
			<div class="top_merchants">
				Top Merchants : for Deals 
			</div>
			<div class="merchants_body">';
			WHILE(($rows = mysql_fetch_array($result))&&($count>=0))
			{
				$temp = explode('.',$rows['OfferName']);
				$product_name = $temp[0];
				$id = $rows['PromoID'];
				$date = $rows['ExpDate'];
				$count=$count-1;
				echo '
				<style>
				#dealimg'.$id.' {background:url("/img/circle/'.$product_name.'.png") 49% 100% no-repeat;background-size: 94px 65px;}
				</style> ';
				echo '
					<a href="/deals/'.$product_name.'/"> <div class="merchants_details"><div id="dealimg'.$id.'" style="height:65px;width:137px;"></div>Show</div></a>';
			}
			echo '
			</div>
		</div>
	</div>';
}
?>