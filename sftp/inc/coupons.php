<?php

if(isset($brand))
{
	if($session==null)
	{
		$session= 'anonymous'; 
	}
	
	$aff_date = date("YmdHis");
	$q="SELECT * FROM table11 WHERE ExpDate >= '$today' AND OfferName LIKE '".$brand."%' AND Type='Coupon'";
	$result = mysql_query($q) or die("query");
	echo '
	<div id="website_deals">
		<div class="headerdeals"> '.$brand.' Coupons</div>
		<div id="headerdeals_float">
		';
		WHILE($rows = mysql_fetch_array($result))
		{
			$url = $rows['url'];
			$desc = $rows['Desc'];
			$title = $rows['Title'];
			$date = $rows['ExpDate'];
			$coupon = $rows['Code'];
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
				<a class="hoverdeals" href="/crop.php?cname='.$brand.'_coupons&&ses='.$session.'&&urlo='.$url.'&aff_sub='.$aff_date.'" target="_blank"> Click to activate offer</a>
				</div>
				<div class="deals_discount">
					'.$coupon.'
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
				<div class="notice_text">Do not visit any other coupon or price comparison site after clicking out from CropmyBill.com. This ensures you get your cashback.</div>
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
	$result=mysql_query("SELECT count(PromoID) as total from table11 WHERE ExpDate >= '$today' AND Type='Coupon'");
	$data=mysql_fetch_assoc($result);
	$count=$data['total'];
	$count2 = $count;
	$q="SELECT OfferName,PromoID,ExpDate FROM table11 WHERE ExpDate >= '$today' AND Type='Coupon' GROUP BY OfferName";
	$result = mysql_query($q) or die("query");
	echo '
	<div style="background:white;min-height:2631px;margin-bottom:50px;border:2px solid #d0dde2;border: 2px solid #d0dde2;box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);">
		<div class="allstore_body allstore_body2">
			<div class="top_merchants">
				<div class="merchants_header" align="left">Coupon Stores</div>
				<div class="merchants_500" align="left">Cashback from over 500+ best online stores</div>
			</div>
			<div class="merchants_body_alls"  style="margin-bottom:30px;">
			';
			WHILE(($rows = mysql_fetch_array($result))&&($count>=0))
			{
				$temp = explode('.',$rows['OfferName']);
				$product_name = $temp[0];
				$product_name = strtolower($product_name);
				$id = $rows['PromoID'];
				$date = $rows['ExpDate'];
				$count=$count-1;
				echo '
				<style>
				#dealimg'.$id.' {background:url("/img/store/'.$product_name.'.png") 49% 100% no-repeat;background-size: 186px 104px;}
				</style> ';
				echo '
					<a href="/coupons/'.$product_name.'"><div class="merchants_details_alls"><div id="dealimg'.$id.'" style="height: 97px;width:191px;"></div><div class="m_desertion">  </div><div class="merchants_text">Show Coupons</div></div></a>
					';
			}
			echo '
			</div>
		</div>
	</div>';
}
?>