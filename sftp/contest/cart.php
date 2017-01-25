<?php
include('/home/arka/public_html/main.php');
$connection= mysql_connect("localhost","arka_cropmybill","9735525775") or die ("connection error");
mysql_select_db("arka_contest", $connection) or die ("database not selected");
if($session != null)
{
	mysql_query("INSERT INTO `arka_contest`.`user` (`user_email`) VALUES ('$session');");
	$_SESSION['contest'] = $session;
	$active = mysql_query("SELECT active FROM `user` WHERE user_email = '$session';");
	$db_active = mysql_fetch_array($active, MYSQL_ASSOC);
	if($db_active['active'] == 0)
		header('Location: /contest/error.php');
}
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			Cart
		</title>

        <link href="./cart.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="/img/crop.ico">
        <link href="./styles.css" rel="stylesheet" type="text/css">
		<script src="./js.js"></script>
       
	</head>
	<body>
	<?php
		require('./h.php');
	?>
		<div class="screen">
			<div class="mainpart">
				<div class="head">
					<div class="carthead">
						Shopping Cart
						<img src="./cart.png" height=24px/>
					</div>
					<div class="details" title="Cash in hand">
						<img src="./coins.png" height=24px/>
						Rs. <span id="inhand">40000</span>
					</div>
				</div>
				<table id="carttable">
					<thead>
						<tr>
							<th>ITEM</th>
							<th>NAME</th>
							<th>WEBSITE</th>
							<th>PRICE</th>
							<th>ACTION</th>
						</tr>
					</thead>
					
				</table>
				<div id="id01"></div>
<?php/*
		if($count == 0)
		{
			echo'
				document.getElementById("carttable").style.display = "none";
				document.getElementById("conclusion").style.display = "none";
				document.getElementById("emptycart").style.display = "block";
				';
		}else
		{
			echo'
				document.getElementById("emptycart").style.display = "none";
				';
		}*/
		?>
				<script>
				function repe() {
				var xmlhttp = new XMLHttpRequest();
				var url = "MYSQL.php";

				xmlhttp.onreadystatechange=function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						myFunction(xmlhttp.responseText);
					}
				}
				xmlhttp.open("GET", url, true);
				xmlhttp.send();
				}
				(function(){
					
					repe();			
						
				setTimeout(arguments.callee, 1500);
				})();
				function myFunction(response) {
					var arr = JSON.parse(response);
					var i;
					var inhand1 = 0;
					var arr_len = arr.length;
					if(arr_len == 0)
					{
						document.getElementById("carttable").style.display = "none";
						document.getElementById("conclusion").style.display = "none";
						document.getElementById("emptycart").style.display = "block";
					}
					else
					{
						document.getElementById("carttable").style.display = "block";
						document.getElementById("conclusion").style.display = "block";
						document.getElementById("emptycart").style.display = "none";
					}
					var out = "<table>";
					for(i = 0; i < arr.length; i++) {
						inhand1 = parseInt(inhand1) + parseInt(arr[i].price);
						out += "<tr class='visible' id ='"+arr[i].ID+"'>" +
						"<td class='item'><img src='./img/" +
						arr[i].ID +
						".jpg'/></td><td class='name'>" +
						arr[i].name +
						"</td><td class='website'><img src='http://cropmybill.com/img/store/" +
						arr[i].website +
						".png'/></td><td class='price'><span>Rs. </span><span class='cost'>" +
						arr[i].price +
						"</span></td>" +
						"<td class='action'><div class='button' onClick='removecart("+arr[i].ID+")'>REMOVE<img src='./return.png'/></div></td></tr>";
					}
					out += "</table>"
					document.getElementById("id01").innerHTML = out;
					document.getElementById("inhand").innerHTML = (40000-inhand1);
					document.getElementById("totalbill").innerHTML = (inhand1);
				}
				
				
				</script>
				<div id="conclusion">
					<div class="summary">
						<div class="total">
							<span class="greyfont">Cart Total: </span>Rs. <span id="totalbill"></span>
						</div>
					</div>
					<div>
					<a href="./checkout.php">
						<div class="checkout">
							<div class="checkbutton">
								CHECKOUT
								<img src="./checkout.png"/>
							</div>
							<div class="checkouttext">
								If you have made your purchase and wish to complete the game you can
							</div>
						</div>
					</a>
					</div>
				</div>
				<div id="emptycart">
					<div id="emptytext">
						There are no items in your cart.
					</div>
					<a href="./" id="shopbutton">
							CONTINUE SHOPPING
					</a>
				</div>
			</div>
		</div>
		
		<script>
		
		function removecart(e) {
			var p="removecart="+e;
			var g="";
			var Li="./code.php";
			var el="cart_status";
			var remove_e = lod(g,p,Li,el);
			if(remove_e == "a")
			{
				SC("cmb_cc",e,3);
				document.getElementById(e).style.display = "none";
				
				console.log(remove_e);
			}
			
		}

		</script>
	</body>
</html>
<?php
mysql_close($connection);
mysql_close($conn);
?>