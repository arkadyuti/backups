<div id="header">
	<div class="header_footer_margin">
		<a href="/"> <img style="float:left" width="229px" height="50px" src="/img/logo.png"/> </a>
		<div onclick="joinus();" id="ddmenu2" style="float:right">
			 <a class="headerclass_a"> Join Us </a>
		</div>
	</div>
</div>
<script>
function joinus() {
	document.getElementById('popup_outer').style.display = 'block';
	document.getElementById('sign_container_visible').style.display = 'block';
	document.getElementById('hide_total').style.display = 'block';
}
function clearAll() {
	document.getElementById('sign_in').style.display = "none";
	document.getElementById('sign_up').style.display = "none";
	document.getElementById('popup_forgot').style.display = "none";
}
function bgcolor() {
	document.getElementById('sign_up1').style.background = 'white';
	document.getElementById('sign_in1').style.background = 'white';
}
function vsbl(a) {
	clearAll();
	bgcolor();
	document.getElementById(a).style.display = "block";
	document.getElementById(a+'1').style.background = '#D2D8D8';
}
function hide_popup() {
		document.getElementById('popup_outer').style.display = 'none';
}
function some() {
	document.getElementById('sign_container_visible').style.display = 'block';
}
function some2() {
	document.getElementById('popup_outer').style.display = 'none';
	document.getElementById('sign_container_visible').style.display = 'none';
	document.getElementById('hide_total').style.display = 'none';
}
document.onkeydown = function (evt) {
	evt = evt || window.event;
	if(evt.keyCode == 27)
	{
		some2();
	}
}
function pass_hide1() {
	document.getElementById('sign_password').type = 'text';
	document.getElementById('pass_hide11').style.display = 'none';
	document.getElementById('pass_hide22').style.display = 'block';
}
function pass_hide2() {
	document.getElementById('sign_password').type = 'password';
	document.getElementById('pass_hide22').style.display = 'none';
	document.getElementById('pass_hide11').style.display = 'block';
}
</script>
<div onclick="some2();" class="popup" id="popup_outer">
</div>
<div style="background: transparent;" id="hide_total">
	<div onclick="some();" class="sign_container" id="sign_container_visible">
		<div class="sign_top_container">
			<div class="sign_in">
				<div class="sign_up_contain">
					<div onclick="vsbl('sign_in');" class="sign_in_left" id="sign_up1">
						<div class="sign_margin">Sign In</div>
					</div>
					<div onclick="vsbl('sign_up');" class="sign_in_right" id="sign_in1">
						<div class="sign_margin">Sign Up</div>
					</div>
				</div>
				<div class="sign_input_height" id="sign_in">
					<form method="post">
						<input class="sign_email ico_email" type="email" placeholder="&nbsp;&nbsp;&nbsp;E-mail"/>
						<input class="sign_password ico_password" id="sign_password" type="password" placeholder="&nbsp;&nbsp;&nbsp;Password"/>
							<a onclick="pass_hide1();" id="pass_hide11" style="color: #2f889a;text-decoration: none;" href="#0" class="show_password">Show</a>
							<a onclick="pass_hide2();" id="pass_hide22" style="display:none;color: #2f889a;text-decoration: none;" href="#0" class="show_password">Hide</a>
						<div>
						<input class="sign_remember" type="checkbox" id="remember_me" checked="">
							<label for="remember-me">Remember me</label>
						</div>
						<input class="signin_submit" id="signin_submit" name="signin_submit" type="button" value="Login"/>
					</form>
					<img style="margin-left:40px;" width="130px" height="35px" src="/img/fb.png">
					<img width="130px" height="35px" src="/img/g+.png">
					<a onclick="vsbl('popup_forgot');" class="sign_forgot" href="#0">Forgot your password?</a>
				</div>
				<div class="signup_input_height" id="sign_up">
					<form method="post">
						<input class="signup_name ico_name" type="text" placeholder="&nbsp;&nbsp;&nbsp;Name"/>
						<input class="signup_phone ico_phone" type="tel" placeholder="&nbsp;&nbsp;&nbsp;Phone"/>
						<input class="sign_email ico_email" type="email" placeholder="&nbsp;&nbsp;&nbsp;E-mail"/>
						<input class="sign_password ico_password" type="password" placeholder="&nbsp;&nbsp;&nbsp;Password"/>
							<a style="color: #2f889a;text-decoration: none;" href="#0" class="up_show_password">Show</a>
							<a style="color: #2f889a;text-decoration: none;" href="#0" class="up_hide_password">Hide</a>
						<input class="signup_submit" id="signup_submit" name="signup_submit" type="button" value="Create Account"/>
					</form>
				</div>
				<div class="signup_forgot_height" id="popup_forgot">
					<div class="forgot_note">
						Lost your password? Please enter your email address. You will receive a link to create a new password.
					</div>
					<form method="post">
						<input class="sign_email ico_email" type="email" placeholder="&nbsp;&nbsp;&nbsp;E-mail"/>
						<input class="forgot_submit" id="forgot_submit" name="forgot_submit" type="button" value="Reset Password"/>
					</form>
					<a onclick="vsbl('sign_in');" class="sign_forgot" href="#0">Back To Login</a>
				</div>
			</div>
			<div class="sign_welcome">
				<div class="welcome_head">
					Welcome at CropmyBill
				</div>
				<div class="welcome_note">
					Please login to earn cashback.
					<br>
					<br>
					You will earn huge cashback.
					<br>
					<br>
					Shop over 100s online stores via CropmyBill
					<br>
					<br>
					Get the best deals and latest coupons on exclusive range of products.
				</div>
			</div>
		</div>
		<div class="popup_merchants">
			<div class="popup_bottom"></div>
			<div class="popup_bottom"></div>
			<div class="popup_bottom"></div>
			<div class="popup_bottom"></div>
			<div class="popup_bottom"></div>
		</div>
	</div>
</div>