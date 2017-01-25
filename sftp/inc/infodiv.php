<link rel="stylesheet" href="/ideal-image-slider.css">
    <link rel="stylesheet" href="/default.css">
	<script src="/ideal-image-slider.min.js"></script>
    <style media="screen">
    #slider {
        width: 650px;
  height: 284px;
  z-index:1;
    }
    </style>
<div class="banner_body">
	<div id="slider">
	<?php 
	if($session==null)
	{
		$session= 'anonymous'; 
	}
	$aff_date = date("YmdHis");
	echo '
	
		<a href="/crop.php?cname=snapdeal_banner&&ses='.$session.'&&urlo=http://tracking.vcommission.com/aff_c?offer_id=110&aff_id=36716&file_id=22091&aff_sub='.$aff_date.'" target="_blank"><img width="650px" height="284px" src="/img/Snapdeal_Fashion_336X280.jpg" alt="Slide 1" /></a>
		<a href="/crop.php?cname=jabong_banner&&ses='.$session.'&&urlo=http://tracking.vcommission.com/aff_c?offer_id=126&aff_id=36716&file_id=41252&aff_sub='.$aff_date.'" target="_blank"><img width="650px" height="284px" src="/img/JABONG_BANNER.jpg"  alt="Slide 1" /></a>
		<a href="/crop.php?cname=paytm_banner&&ses='.$session.'&&urlo=http://tracking.vcommission.com/aff_c?offer_id=1022&aff_id=36716&file_id=58854&aff_sub='.$aff_date.'" target="_blank"><img width="650px" height="284px" src="/img/paytm_banner.jpg"  alt="Slide 1" /></a>
	';
	?>
	</div>
</div>
<script>
	var slider = new IdealImageSlider.Slider('#slider');
    slider.start();
	</script>
<?php
if($session == 'anonymous')
{
	echo '
	<div class="join_info">
		<div class="info_howto">Steps to save and earn at CropmyBill</div>
		<div style="position:absolute;height:137px;width:22px;margin-left: 29px;">
		<a class="join_avater"></a>
		<a class="cart_avater"></a>
		<a class="reedem_avater"></a>
		</div>
		<div class="info_join">
			<div class="info_margin">Join CropmyBill for free</div>
			
			<hr style="opacity:.3;border-width: 1px;border-style:inset;" width="90%" align="left">
			<div class="info_margin">Shop via us & earn cashback</div>
			<hr style="opacity:.3;border-width: 1px;border-style:inset;" width="90%" align="left">
			<div class="info_margin">Redeem your cashback</div>
		</div>
	</div>
	';
}
else
{
	echo '
	<div class="join_info">
		<div class="info_howto">You are ready to Save!</div>
		<div style="position:absolute;height:137px;width:22px;margin-left: 29px;">
		</div>
		<div class="info_join" style="margin-left: 27px;">
			<div class="info_margin">1. Look for your favourite store.</div>
			
			<hr style="opacity:.3;border-width: 1px;border-style:inset;" width="90%" align="left">
			<div class="info_margin">2. Click on your preferred store & Shop Normally.</div>
			<hr style="opacity:.3;border-width: 1px;border-style:inset;" width="90%" align="left">
			<div class="info_margin">3. Enjoy! Cashback tracks in your CropmyBill wallet.</div>
		</div>
	</div>
	';
}
?>