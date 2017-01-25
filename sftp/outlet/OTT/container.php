<style>
#outlet_container{
	
	position: relative;
}
#outlet_container:after {
    content : "";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    background:url("/images/bs-overlay.png");
    width: 100%;
    height: 100%;
    opacity : 0.3;
    z-index: -1;
}
#outlet_top {
	height:400px;
	width:100%;
	background:url("./ott_2.jpg");
	background-size:100%;
}
#outlet_wrap {
	min-height:726px;
	width:1152px;
	background:blue;
	margin-left:auto;
	margin-right:auto;
	margin-top: 10px;
	margin-bottom: 10px;
}
#top_writeup {
	background:transparent;
	width:1152px;
	height:354px;
	margin-left:auto;
	margin-right:auto;
	position:relative;
	bottom:0px;
}
#writeup_bottom {
	bottom:0px;
	height:120px;
	width:410px;
	background:transparent;
	position:absolute;
}
</style>
<div id="outlet_container">
	<div id="outlet_top">
		<div id="top_writeup">
			<div id="writeup_bottom">
				<div style="font-size:42px;color:white;">OTT - Over the Top</div>
			</div>
		</div>
	</div>
</div>
<div id="table_container">
	<table id="table_body">
		<tr>
			<td style="vertical-align: baseline;width:270px;background-color:#f4f49;"> 
				<div style="margin:10px;">
					<div style="font-size:20px;">PHONE NUMBER</div>
					<br>
					<div style="">033 xxxx xxxx
					</div>
					<br>
					<br>
					<div style="">LOCATION
					</div>
					<div style="">Sector 1, Salt Lake › EC 26, Near City Centre 1, Sector 1, Salt Lake, Kolkata
					</div>
					<div id="g_maps">
						<iframe width="250" height="187" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Club%20Salsa%20Nights%20at%20The%20Myx%2C%20Park%20Street%2C%20Park%20Street%20area%2C%20Kolkata%2C%20West%20Bengal%2C%20India&key=AIzaSyDnFy3CCQW0bsOmBsIIgXTt_CbMDJLRPiE"></iframe>
					</div>
					<br>
					<br>
					<script>
					$(document).ready(function(){
						$("#cmore").click(function(){
							$("#cmore").hide();
							//$("#cless").slideToggle(1500,"easeOutBounce");
							$("#cless").show();
							$("#c_toggle").slideToggle("slow");
						});
						$("#cless").click(function(){
							$("#cless").hide();
							//$("#cless").slideToggle(1500,"easeOutBounce");
							$("#cmore").show();
							$("#c_toggle").slideToggle("slow");
						});
					});
					</script>
					<div style="">OPERATING HOURS
						<div id="cmore" style="float:right; color:red;font-size:14px;margin-right:20px; cursor:pointer;">(SEE MORE +)</div>
						<div id="cless" style="float:right; color:red;font-size:14px;margin-right:20px; cursor:pointer;display:none;">(SEE LESS +)</div>
					</div> 
					<br>
					<div style="">Today 00 AM to 00:00 PM	</div>
					<br>
					<div id="c_toggle" style="display:none;">
						<div style="">Mon 00 AM to 00:00 PM	</div>
						<div style="">Mon 00 AM to 00:00 PM	</div>
						<div style="">Mon 00 AM to 00:00 PM	</div>
						<div style="">Mon 00 AM to 00:00 PM	</div>
						<div style="">Mon 00 AM to 00:00 PM	</div>
						<div style="">Mon 00 AM to 00:00 PM	</div>
						<div style="">Mon 00 AM to 00:00 PM	</div>
					</div>
				</div>
			</td>
			<td style="vertical-align: baseline;width:auto;background-color:#FFFFCC;">
				<div style="margin:20px;">
				<style type="text/css" media="screen">
					
					ul li { display: inline; }
					
					.wide {
						border-bottom: 1px #000 solid;
						width: 4000px;
					}
					
					.fleft { float: left; margin: 0 20px 0 0; }
					
					.cboth { clear: both; }
					
					
				</style>
					<div style="">PHOTOS
					<ul class="gallery clearfix">
						<li><a href="images/fullscreen/1.jpg" rel="prettyPhoto[gallery2]"><img src="images/thumbnails/t_1.jpg" width="60" height="60" alt="" /></a></li>
						<li><a href="images/fullscreen/1.jpg" rel="prettyPhoto[gallery2]"><img src="images/thumbnails/t_1.jpg" width="60" height="60" alt="" /></a></li>
						<li><a href="images/fullscreen/1.jpg" rel="prettyPhoto[gallery2]"><img src="images/thumbnails/t_1.jpg" width="60" height="60" alt="" /></a></li>
						<li><a href="images/fullscreen/1.jpg" rel="prettyPhoto[gallery2]"><img src="images/thumbnails/t_1.jpg" width="60" height="60" alt="" /></a></li>
					</ul>
					<div style="">MENU
					<ul class="gallery clearfix">
						<li><a href="images/fullscreen/5.jpg" rel="prettyPhoto[gallery2]"><img src="images/thumbnails/t_5.jpg" width="60" height="60" alt="" /></a></li>
						<li><a href="images/fullscreen/5.jpg" rel="prettyPhoto[gallery2]"><img src="images/thumbnails/t_5.jpg" width="60" height="60" alt="" /></a></li>
						<li><a href="images/fullscreen/5.jpg" rel="prettyPhoto[gallery2]"><img src="images/thumbnails/t_5.jpg" width="60" height="60" alt="" /></a></li>
						<li><a href="images/fullscreen/5.jpg" rel="prettyPhoto[gallery2]"><img src="images/thumbnails/t_5.jpg" width="60" height="60" alt="" /></a></li>
					</ul>
			
					<script type="text/javascript" charset="utf-8">
					$(document).ready(function(){
						$("area[rel^='prettyPhoto']").prettyPhoto();
						
						$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
						$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
				
						$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
							custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
							changepicturecallback: function(){ initialize(); }
						});

						$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
							custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
							changepicturecallback: function(){ _bsap.exec(); }
						});
					});
					</script>
					</div>
					<div style="width:558px;height:350px;background:#e47f31; margin-bottom:15px;">
						<script type="text/javascript">
						function DrawCaptcha()
						{
							var alpha = new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
							 var i;
							 for (i=0;i<6;i++){
							   var a = alpha[Math.floor(Math.random() * alpha.length)];
							   var b = alpha[Math.floor(Math.random() * alpha.length)];
							   var c = alpha[Math.floor(Math.random() * alpha.length)];
							   var d = alpha[Math.floor(Math.random() * alpha.length)];
							  }
							var code = a + ' ' + b + ' ' + c + ' ' +d;
							document.getElementById("txtCaptcha").innerHTML = code
							document.getElementById('txtInput').value= "";
						}
						function ValidCaptcha(){
							var str1 = removeSpaces(document.getElementById('txtCaptcha').innerHTML);
							var str2 = removeSpaces(document.getElementById('txtInput').value);
							if (str1 == str2) 
							{
								var p="&session="+"<?php echo $session ;?>"
									+"&deal_details="+document.getElementById("deal_details").innerHTML.trim();
								var g="";
								var Li="/code.php";
								var el="outlet_error";
								lod(g,p,Li,el);
							}
							else 
							{
								DrawCaptcha();
							}
						}
						function removeSpaces(string)
						{
							return string.split(' ').join('');
						}
						</script>
						<style>
						#btnrefresh{
							height:20px; width:20px;
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
							background-image:url(./images/refresh.png); background-size:100%; 
						}
						.txtCaptcha_c {
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
							
							text-align:center;font-weight:bold; font-size:20px; font-family:Modern;
						}
						.crop_dialog_overlay
						{
						   position: fixed;
						   top: 0;
						   right: 0;
						   bottom: 0;
						   left: 0;
						   height: 100%;
						   width: 100%;
						   margin: 0;
						   padding: 0;
						   background: #000000;
						   opacity: .65;
						   filter: alpha(opacity=15);
						   -moz-opacity: .15;
						   z-index: 101;
						   display: none;
						   background: url("/images/bs-overlay.png");
						}
						.recharge_submit
						{
						   display: none;
						   position: fixed;
						   width: 390px;
						   height: 202px;
						   top:50%;
						   left:50%;
						   align:center;
						   margin-left: -190px;
						   margin-top: -100px;
						   background-color: #ffffff;
						   border: 1px solid #336699;
						   border-radius:5px;
						   padding: 0px;
						   z-index: 102;
						}
						</style>
						<div id="deal_details" align="center"style="font-size:40px;">
							Deal Details: 10% off
						</div>
						
						<div onclick="myFunction();" style="height: 20px;width:195px;color:white;cursor:pointer;font-size: 1em;margin: 25px 0px 0px 34px;background-color: #539AA0;border-radius: 5px;padding: 7px 10px 5px 10px;  font-family: latoregular,Arial,sans-serif;">
							Click here to activate deal
						</div>
					</div>
					
					<div id="overlay" class="crop_dialog_overlay"></div>
					<div id="dialog" class="recharge_submit">
					
					<?php
					if($session != null)
					{
						echo '
						<div align="center">Enter the text shown</div>
						<form method="post">
							<table align="center">
							<tr>
								<td>
									<div id="txtCaptcha" class="txtCaptcha_c" style="width:155px;height: 32px;line-height: 1;font-size: 29px;float:left;background-image:url(./images/1.jpg);cursor:default;"></div>
									<div id="btnrefresh" onclick="DrawCaptcha();" style="float:right;" ></div>
								</td>
							</tr>
							<tr>
								<td>
									<input type="text" id="txtInput" class="txtCaptcha_c" maxlength="4" style="width: 155px;" autocomplete="off" placeholder="Text Here"/>    
								</td>
							</tr>
							<tr>
								<td>
									<input id="Button1" type="submit" value="Submit" onclick="ValidCaptcha();return false;" style="  margin-left: 45px;"/>
								</td>
							</tr>
							</table>
							<div id="outlet_error" class="outlet_error"></div>
							
						</form>
						';
					}else
					{
						echo '
						doen';
					}
					?>
					
					</div>
					
					<script>
					function myFunction (e)
					  {
						 ShowDialog(false);
						 e.preventDefault();
					  }
					   function ShowDialog(modal)
					   {
						  $("#overlay").show();
						  $("#dialog").fadeIn(300);
						  if (modal)
						  {
							 $("#overlay").unbind("click");
						  }
						  else
						  {
							 $("#overlay").click(function (e)
							 {
								HideDialog();
							 });
						  }
						  DrawCaptcha();
					   }
					   function HideDialog()
					   {
						  $("#overlay").hide();
						  $("#dialog").fadeOut(300);
					   } 
					   document.onkeydown = function (evt) {
							evt = evt || window.event;
							if(evt.keyCode == 27)
							{
								HideDialog();
							}
						}
					</script>
					<div style="width:558px;height:150px;background:#e47f31; margin-bottom:15px;">
					</div>
				</div>
			</td>
			
			<td style="vertical-align: baseline;width:270px;background-color:#f4f4e9;">
				<div style="margin:10px;">
					<div style="height:500px;">Find us on Facebook
					<div style="position:absolute;" class="fb-page" data-href="https://www.facebook.com/Ovrthetop" data-width="250" data-small-header="true" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/Ovrthetop"><a href="https://www.facebook.com/Ovrthetop">Facebook</a></blockquote></div></div>
					</div>
				</div>
			</td>
			
		</tr>
	</table>
</div>