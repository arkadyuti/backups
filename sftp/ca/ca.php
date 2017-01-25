<script src="/jquery-1.11.0.min.js"></script>
<style>
#ca_pic {
	width:1275px;
	height:498px;
	width:100%;
	background:url("./ca.png") no-repeat;
	background-size:100%;
}

.ca_bottom_container {
	width: 970px;
	margin-left: auto;
	margin-right: auto;
	margin-bottom:45px;
	margin-top: 25px;
	box-shadow: 0 2px 6px 2px rgba(131, 131, 131, 0.27);
}
.ca_body {
	min-height: 400px;
	background:#fff;
	padding: 1px 30px 30px 30px;
	line-height: 1.5;
	font-family: "Roboto",sans-serif;
	font-weight: normal;
	color: rgba(0,0,0,0.87);
	font-size: 15px;
}
.ca_h {
	font-size: 2em;
	line-height: 3.212rem;
	margin: 1.46rem 0 1.168rem 0;
	font-weight: 400;
	color: rgba(0,0,0,0.87);
	font-family: "Roboto",sans-serif;
}
.ca_p {
	font-size: 15px;
	line-height: 1.5;
	font-family: "Roboto",sans-serif;
	font-weight: normal;
	color: rgba(0,0,0,0.87);
}

.reg_trans div:hover {
	background:#162F6B;
	width:130px;
	height:40px;
	
	transition: background-color 0.2s;
}
.social_name {
	font:normal 19px/38px 'Arial,Helvetica,sans-serif';margin-left:19px;color:#fff;
}
.reg_trans {
	width:130px;
	height:40px;
	background:#3c5a98;
}
.cahead {
	color:#fff;
	margin-right: auto;
	margin-left: auto;
	width: 462px;
	padding-top: 89px;
	font-size: 3.0em;
	transform: scale(1,1.3);
	
}
.nav-up {
    top: -40px;
}
</style>
<script>

$(function(){
var lastScrollTop = 0, delta = 5;
$(window).scroll(function(event){
   var st = $(this).scrollTop();

   if(Math.abs(lastScrollTop - st) <= delta)
      return;

   if (st > lastScrollTop){
       // downscroll code
       $("#cahead").css('visibility','hidden').hover ();
   } else {
      // upscroll code
      $("#cahead").css('visibility','visible');
   }
   lastScrollTop = st;
});
});

 </script>
<div id="ca_pic">
	<div id="cahead" class="cahead allfont">Campus Ambassador</div>
</div>
<div class="ca_bottom_container">
	<div class="ca_body">
		<h3 class="ca_h">About</h3>
		<p class="ca_p">
			The Campus Ambassadorship Program by CropmyBill.com is a nationwide programme which explores, innovates, shapes and exposes the students nationwide from various colleges as efficient managers and creative leaders. 
			The campus ambassador program recognizes enthusiastic students, hardworking and motivated students by giving them opportunity to develop knowledge and leadership skills by representing CropmyBill on their campus.

		</p>
		
		
		<h3 class="ca_h">BENEFITS</h3>
		<p class="ca_p">
			Benefits to the Campus Ambassadors now become the responsibility of the CropmyBill team. So these are the benefits, waiting for the successful Campus Ambassadors!
		</p>
		<ol>
			<li>The Campus Ambassadors would be acknowledged by providing CERTIFICATES. (Campus Ambassador Certificate & Certificate of Appreciation) </li>
			<li>Ambassadors will be granted GOODIES. (T-shirts, Exclusive Coupons, Free Recharge,  etc)</li>
			<li>Ambassadors will be given Confirmed Cash in CropmyBill wallet .</li>
			<li>Ambassadors gain valuable insights and experience throughout the campaign.</li>
			<li>Visibility of their engagement during the campaign would be appreciated by letting Ambassadors have special exposure. This programme would allow the ambassadors to have Expert Advice in Technical & Management fields.</li>
			
		</ol>
		
		<h3 class="ca_h">PREREQUISITES</h3>
		<ol>
			<li>All applicants must be college/university students irrespective of their fields.</li>
			<li>Must be from age group (17-25) .</li>
			<li>Involved with student organizations and other extra curricular Activities.(Preferable)</li>
			<li>Familiar and active on Social Networking Sites such as Facebook, Twitter etc.</li>
			<li>Must be able to provide strong motivation.</li>
			<li>Must be consistent to work efficiently during his/her tenure.</li>
			<li>Good at English (preferably) or good at regional language (if local).</li>
			
		</ol>
		
		<h3 class="ca_h">REGISTER</h3>
		<p class="ca_p">
			Register yourself at Campus Ambassador Registration
		</p>
		<a href="https://docs.google.com/forms/d/1Wl27oEmmUdcLInMCLm1KmcLtVLAny92GYQ7lZg_9_pc/viewform" target="_blank" style="text-decoration: none;">
			<div class="reg_trans">
				<div style="width:130px;height:40px;cursor:pointer;">
					<span class="social_name">REGISTER</span>
				</div>
			</div>
		</a>
	</div>
</div>












