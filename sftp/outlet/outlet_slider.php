<link rel="stylesheet" href="/ideal-image-slider.css">
    <link rel="stylesheet" href="/default.css">
	<script src="/ideal-image-slider.min.js"></script>
    <style media="screen">
    #slider {
        width: 650px;
		height: 284px;
		z-index:1;
		margin-left:auto;
		margin-right:auto;
    }
	.slider_container {
		width:1152;
	}
    </style>
<div class="slider_container">
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