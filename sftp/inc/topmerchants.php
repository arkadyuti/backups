<style>
#ebay {background:url("/img/store/ebay.png") 0px 0px no-repeat;background-size: 232px 100px;}
#homeshop18 {background:url("/img/store/homeshop18.png") 0px 0px no-repeat;background-size: 232px 100px;}
#shopclues {background:url("/img/store/shopclues.png") 0px 0px no-repeat;background-size: 232px 100px;}
#themobilestore {background:url("/img/store/themobilestore.png") 0px 0px no-repeat;background-size: 232px 100px;}

#americanswan {background:url("/img/store/americanswan.png") 0px 0px no-repeat;background-size: 232px 100px;}
#basicslife {background:url("/img/store/basicslife.png") 0px 0px no-repeat;background-size: 232px 100px;}
#bagittoday {background:url("/img/store/bagittoday.png") 0px 0px no-repeat;background-size: 232px 100px;}
#koovs {background:url("/img/store/koovs.png") 0px 0px no-repeat;background-size: 232px 100px;}

#trendin {background:url("/img/store/trendin.png") 0px 0px no-repeat;background-size: 232px 100px;}
#yepme {background:url("/img/store/yepme.png") 0px 0px no-repeat;background-size: 232px 100px;}
#happilyunmarried {background:url("/img/store/happilyunmarried.png") 0px 0px no-repeat;background-size: 232px 100px;}
#faballey {background:url("/img/store/faballey.png") 0px 0px no-repeat;background-size: 232px 100px;}

.margin_btm {
	margin-bottom:40px;
}

.clothing_container {
	width:1000px;
	height:795px;
}
.favorite_container {
	width:1000px;
	height:642px;
}
.electronics_container {
	width:1000px;
	height:430px;
}
.catagory_container {
	width:1000px;
	height:486px;
}
.clothing_wrap {
	width:232px;
	height:340px;
	float:left;
	margin-right:18px;
	margin-bottom:21px;
	border:1px solid #EAEAEA;
	background:#fff;
}
.slider_nimage {
	width:1000px;
	height:405px;
	margin-top:20px;
}
.slider_left {
	width:675px;
	height:405px;
	float:left;
}
.slider_right {
	width:315px;
	height:405px;
	float:right;
}
.right_split {
	width:315px;
	height:197px;
}
.store_text {
	margin-bottom:15px;
	color: #444;
  font-weight: 600;
  font-size: 21px;
}
.clothing_image {
	height:100px;
	width:232px;
	border-bottom: 1px dashed #CECECE;
	position:relative;
}
.cname_text {
	height: 80px;
	margin: 5px;
	margin-left: 17px;
	margin-right: 17px;
	color: #4a4a4a;
	font-size: 17px;
	overflow: hidden;
	/* transform: scale(1,1.3); */
	margin-top: 55px;
}
.rate_text {
	width: auto;
	height: 36px;
	display:block;
	font: normal 17px/34px 'Arial,Helvetica,sans-serif';
	font-weight: 700;
	text-align: center;
	padding: 2px 15px 0px 15px;
	background-origin: padding-box;
	background-color: #1e8cbe;
  
  color: white;
  border-bottom: 2px solid #1669AF;
  margin-left: 34px;
  margin-right: 34px;
}
.clothing_wrap  a:hover {
	background-color: #FFF;
	transition: background-color 0.2s ease;
	border:1px solid #eaeaea;
	color:#1669AF;
}
.cname_head {
margin-right: 12px;
  /* text-decoration: underline; */
  border-bottom: 3px solid #cc5251;
  display: inline-block;
  line-height: 28px;
  font-weight: bold;
  /* left: 0; */
  float: right;
}
.viewall {
	float:right;
	margin: 10px;
	font-family: Arial,Helvetica,sans-serif;
}
.test {
	color:#CC5251;text-decoration:none;
}
.viewall a:hover {
	color:blue;
	text-decoration:underline;
}
.fav_box {
	width:240px;
	height:276px;
	float:left;
	margin-right: 13px;
	margin-bottom: 13px;
	position:relative;
}
#flipkart {
	background:url("/img/topm/flipkart.jpg");
}
#snapdeal {
	background:url("/img/topm/snapdeal.jpg");
}
#expedia {
	background:url("/img/topm/expedia.jpg");
}
#amazon {
	background:url("/img/topm/amazon.jpg");
}
#lenskart {
	background:url("/img/topm/lenskart.jpg");
}
#paytm {
	background:url("/img/topm/paytm.jpg");
}
#dominos {
	background:url("/img/topm/dominos.jpg");
}
#jabong {
	background:url("/img/topm/jabong.jpg");
}
.fav_text {
	position:absolute;
	color:white;
	bottom:13px;
	font-size:25px;
	left:13px;
}
#deal {background:url("/img/topm/deal.jpg");}
#coupons {background:url("/img/topm/coupons.jpg");}
.deal_hov div:hover {
	opacity:.8;
}
</style>
<link rel="stylesheet" href="/ideal-image-slider.css">
<link rel="stylesheet" href="/default.css">
<script src="/js/ideal-image-slider.min.js"></script>

<div style="width: 1000px;margin-left: auto;margin-right: auto;">
	<div class="slider_nimage margin_btm">
		<div class="slider_left">
			<div id="slider">
	
		<a href="#"><img width="675px" height="405px" src="/img/topm/banner1.jpg" alt="Slide 1" /></a>
		<a href="#"><img width="675px" height="405px" src="/img/topm/banner2.jpg"  alt="Slide 1" /></a>
	
	</div>
	<script>
	var slider = new IdealImageSlider.Slider('#slider');
    slider.start();
	</script>
		</div>
		<div class="slider_right">
			<a href="/deals/" class="deal_hov"><div style="background-color:grey;"> <div class="right_split" id="deal"></div></div></a>
			<a href="/coupons/" class="deal_hov"> <div style="background-color:grey;"> <div class="right_split" id="coupons" style="margin-top:11px;"></div></div></a>
		</div>
	</div>
	<div class="clothing_container margin_btm">
		<div class="store_text allfont">OUR CLOTHING STORES</div>
		<div class="clothing_wrap">
			<div class="clothing_image" id="americanswan" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">AMERICAN SWAN</div>
			<div class="cname_text allfont" >Pick out from the best apparels, shoes and accessories...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto 20% CashBack </div>
			<a href="/stores/americanswan" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="clothing_wrap">
			<div class="clothing_image" id="basicslife" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">BASICS LIFE</div>
			<div class="cname_text allfont" >From clothing to accessories, the ultimate fashion destination...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto Rs.360 CashBack </div>
			<a href="/stores/basicslife" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="clothing_wrap">
			<div class="clothing_image" id="bagittoday" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">BAG IT TODAY</div>
			<div class="cname_text allfont" >Shop online for anything & everything...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto 9.9% CashBack </div>
			<a href="/stores/bagittoday" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="clothing_wrap" style="margin-right:0px;">
			<div class="clothing_image" id="happilyunmarried" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">HAPPILY UNMARRIED</div>
			<div class="cname_text allfont" >Buy funny & unique gifts...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto 9.3% CashBack </div>
			<a href="/stores/happilyunmarried" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="clothing_wrap">
			<div class="clothing_image" id="koovs" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">KOOVS</div>
			<div class="cname_text allfont" >One-stop online fashion destination for all your fashion needs...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto Rs.245 CashBack </div>
			<a href="/stores/koovs" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="clothing_wrap">
			<div class="clothing_image" id="trendin" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">TREND IN</div>
			<div class="cname_text allfont" >Online Store of Louis Philippe, Allen Solly & more...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto Rs.252 CashBack </div>
			<a href="/stores/trendin" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="clothing_wrap">
			<div class="clothing_image" id="yepme" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">YEPME</div>
			<div class="cname_text allfont" >Buy Men's & Women's garments and accessories...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto 7.2% CashBack </div>
			<a href="/stores/yepme" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="clothing_wrap" style="margin-right:0px;">
			<div class="clothing_image" id="faballey" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">FABALLEY</div>
			<div class="cname_text allfont" >Buy Women's handbags, shoes, jewelry & more...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto Rs.315 CashBack </div>
			<a href="/stores/faballey" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		
		<div class="viewall" style="margin-top: -11px;"><a href="/usearch/Clothing%20&%20Accessories/" class="test">view all clothing stores</a></div>
	</div>

	<div class="favorite_container margin_btm allfont">
		<div class="store_text allfont">OUR FAVOURITE STORES</div>
		<a href="/stores/amazon"><div id="amazon" class="fav_box"><div class="fav_text">Upto 13.5%</div></div></a>
		<a href="/stores/flipkart"><div id="flipkart" class="fav_box"><div class="fav_text">Upto 12.6%</div></div></a>
		<a href="/stores/snapdeal"><div id="snapdeal" class="fav_box"><div class="fav_text">Upto 6.3%</div></div></a>
		<a href="/stores/jabong"><div id="jabong" class="fav_box" style="margin-right:0px;"><div class="fav_text">Upto 7.2%</div></div></a>
		<a href="/stores/dominos"><div id="dominos" class="fav_box"><div class="fav_text">Flat Rs.18</div></div></a>
		<a href="/stores/paytm"><div id="paytm" class="fav_box"><div class="fav_text">Upto 5%</div></div></a>
		<a href="/stores/lenskart"><div id="lenskart" class="fav_box"><div class="fav_text">Upto Rs.45</div></div></a>
		<a href="/stores/expedia"><div id="expedia" class="fav_box" style="margin-right:0px;"><div class="fav_text">Upto 5%</div></div></a>
		<a href="#"><div class="viewall"><a href="/allstore/" class="test">view all stores</a></div></a>
	</div>
	<div class="electronics_container margin_btm">
		<div class="store_text allfont">OUR ELECTRONICS STORES</div>
		<div class="clothing_wrap">
			<div class="clothing_image" id="ebay" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			<div class="cname_head allfont">eBAY</div>
			<div class="cname_text allfont" >Buy and sell electronics, fashion apparel etc...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto Rs.190 CashBack </div>
			<a href="/stores/ebay" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="clothing_wrap">
			<div class="clothing_image" id="homeshop18" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">HOMESHOP18</div>
			<div class="cname_text allfont" >Shop Online for Mobiles, Jewellery, Fashion & more...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto 7.5% CashBack </div>
			<a href="/stores/homeshop18" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="clothing_wrap">
			<div class="clothing_image" id="shopclues" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">SHOPCLUES</div>
			<div class="cname_text allfont" >Buy Mobiles Phone, Computers, Tablets PC & Home Appliances...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto 4.0% CashBack </div>
			<a href="/stores/shopclues" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		
		<div class="clothing_wrap" style="margin-right:0px;">
			<div class="clothing_image" id="themobilestore" >
				<div style="position:absolute;top:94px;left: 25px;"><img src="/img/scissor.png"></div>
			</div>
			
			<div class="cname_head allfont">THE MOBILE STORE</div>
			<div class="cname_text allfont" >Buy Mobiles & Tablets online from TheMobileStore.in...</div>
			<div class="allfont" style="color:#1669b0;margin-left: 17px;margin-bottom: 28px;transform: scale(1,1.4);font-size: 15px;">+ Get upto 2.5% CashBack </div>
			<a href="/stores/themobilestore" class="rate_text allfont" style="font-family: Arial,Helvetica,sans-serif;">SHOP TO CROP</a>
		</div>
		<div class="viewall"><a href="/usearch/Electronics/" class="test">view all electronics stores</a></div>
	</div>
</div>
	
<div class="steps_full">
	<div class="steps_container allfont">
		<div class="steps_head allfont">STEPS TO GET CASHBACK</div>
		<div class="steps_img_wrap">
			<div class="join_img"></div>
			<div class="steps_text_btm">Join Us</div>
			<div class="steps_details">Join us for free & visit 200+ websites</div>
		</div>
		<div class="steps_img_wrap">
			<div class="cart_img"></div>
			<div class="steps_text_btm">Browse & Shop</div>
			<div class="steps_details">Click on your preferred website & shop as you normally do </div>
		</div>
		<div class="steps_img_wrap" style="margin-right:0px">
			<div class="earn_img"></div>
			<div class="steps_text_btm">Earn</div>
			<div class="steps_details">With our cashback rates earn huge bucks</div>
		</div>
		
	</div>
</div>
<style>
.steps_full {
	background:#1A6CB6;
	width:100%;
	height:350px;
}
.steps_container {
	width:1000px;
	margin-left:auto;
	margin-right:auto;
}
.steps_head {
	color: white;
	font-size: 34px;
	padding-top: 20px;
	text-align: center;
	transform: scale(1,1.4);
	font-weight: bold;
}
.steps_img_wrap {
	width:210px;
	height:250px;
	float:left;
	margin-top: 20px;
	text-align:center;
	margin-right:185px;
}
.cart_img {
	background:url("/img/topm/cart.png") 50% 0% no-repeat;  background-size: 67%;
	height:148px;
	width:200px;
}
.join_img {
	background:url("/img/topm/join.png") 50% 34% no-repeat;  background-size: 67%;
	height:148px;
	width:200px;
}
.earn_img {
	background:url("/img/topm/earning.png") 50% 0% no-repeat;  background-size: 67%;
	height:148px;
	width:200px;
}
.steps_text_btm {
	color: rgb(219, 227, 234);
	font-size: 28px;
	text-align: center;
	transform: scale(1,1.2);
	font-weight: bold;
}
.steps_details {
	color: rgb(255, 255, 255);
	font-size: 16px;
	text-align: center;
	transform: scale(1,1.1);
	margin-top: 10px;
}
#electronics {background:url("/img/topm/electronics.jpg") no-repeat;}
#clothing {background:url("/img/topm/clothing.jpg") no-repeat;}
#flower {background:url("/img/topm/flower.jpg") no-repeat;}
#food {background:url("/img/topm/food.jpg") no-repeat;}
#recharge {background:url("/img/topm/recharge.jpg") no-repeat;}
</style>
<div style="width: 1000px;margin-left: auto;margin-right: auto;">
	<div class="catagory_container margin_btm" style="margin-top:20px;">
		<div class="store_text allfont">CATEGORIES</div>
		<a href="/usearch/Clothing%20&%20Accessories/"><div style="width:490px;height:200px;float:left;" id="clothing"></div></a>
		<a href="/usearch/Food%20&%20Drink/"><div style="width:490px;height:200px;float:right;" id="food"></div></a>
		<div style="width:490px;height:200px;float:left;margin-top:20px;">
			<a href="/usearch/Recharge%20&%20Top%20Up/"><div style="width:235px;height:200px;float:left;" id="recharge"></div></a>
			<a href="/usearch/Flowers%20&%20Gifts/"><div style="width:235px;height:200px;float:right;" id="flower"></div></a>
		</div>
		<a href="/usearch/Electronics/"><div style="width:490px;height:200px;float:right;margin-top:20px;" id="electronics"></div></a>
	
	</div>
</div>