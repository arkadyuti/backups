<style>
.mobile_mnu {
	color:#fff;
	width:auto;
	display:block;
	font: normal 23px/44px 'Arial,Helvetica,sans-serif';
	float:left;
	margin-right: 30px;
}
	
</style>
<div style="width:100%;height:44px; background:#12446E;">
	<div style="width:1152px;margin-left:auto;margin-right:auto;height: 44px;background: #12446E;">
	<?php
	if($device_type == 'mobile')
	{
		echo '
		<a href="/allstore/" class="mobile_mnu allfont">All Store</a>
		<a href="/deals/" class="mobile_mnu allfont">Deals</a>
		<a href="/coupons/" class="mobile_mnu allfont">Coupons</a>
		';
	}
	else 
	{
		echo '
		<div id="umnu">
			<ul> 
			   <li><a href="/allstore/"><span>All Stores</span></a>
			   </li>
			   
			   <li class="has-sub"><a href=""><span>By Category</span></a>
				  <ul>
					 <li style="z-index:500;background:white;width:210px;height:auto;margin-left:-2px;box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);">
						
						<a href="/usearch/Clothing & Accessories/" style="margin:0px; padding:0px;"><div class="by_category">Clothing & Accessories</div></a>
						<a href="/usearch/Electronics/" style="margin:0px; padding:0px;"><div class="by_category">Electronics</div></a>
						<a href="/usearch/Recharge & Top Up/" style="margin:0px; padding:0px;"><div class="by_category">Recharge & Top Up</div></a>
						<a href="/usearch/Flowers & Gifts/" style="margin:0px; padding:0px;"><div class="by_category">Flowers & Gifts</div></a>
						<a href="/usearch/Footwear/" style="margin:0px; padding:0px;"><div class="by_category">Footwear</div></a>
						<a href="/usearch/Food & Drink/" style="margin:0px; padding:0px;"><div class="by_category">Food & Drink</div></a>
						<a href="/usearch/Travel & Vacations/" style="margin:0px; padding:0px;"><div class="by_category">Travel & Vacations</div></a>
						<a href="/usearch/Baby Products & Toy/" style="margin:0px; padding:0px;"><div class="by_category">Baby Products & Toy</div></a>
						<a href="/usearch/Jewellery/" style="margin:0px; padding:0px;"><div class="by_category">Jewellery</div></a>
						<a href="/usearch/Health & Beauty/" style="margin:0px; padding:0px;"><div class="by_category">Health & Beauty</div></a>
						<a href="/usearch/Home & Kitchen/" style="margin:0px; padding:0px;"><div class="by_category">Home & Kitchen</div></a>
						<a href="/usearch/Books & Stationary/" style="margin:0px; padding:0px;"><div class="by_category">Books & Stationary</div></a>
						<a href="/usearch/Pets/" style="margin:0px; padding:0px;"><div class="by_category">Pets</div></a>
						<a href="/usearch/Eyewear/" style="margin:0px; padding:0px;"><div class="by_category">Eyewear</div></a>
						<a href="/usearch/Others/" style="margin:0px; padding:0px;"><div class="by_category">Others</div></a>
					 </li>
				  </ul>
			   </li>
			   <li><a href="/deals/"><span>Deals</span></a></li>
			   <li class="last"><a href="/coupons/"><span>Coupons</span></a></li>
			 
			</ul>
		</div>
	  ';
	}
?>
	</div>
</div>