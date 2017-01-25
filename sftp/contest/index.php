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
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			Shopaholic
		</title>
<link rel="shortcut icon" href="/img/crop.ico">
        <link href="./game.css" rel="stylesheet" type="text/css"/>
        <link href="./styles.css" rel="stylesheet" type="text/css"/>
		<script src="./js.js"></script>
		<script src="./jquery.min.js"></script>
	</head>
	<body>
	
		
	<?php
		require('./h.php');
	?>
		<div class="screen">
			<div class="mainpart">
				<div class="head">
					<div class="catalogue">
						Our Catalogue
						<img src="./catalogue.png"/>
					</div>
					<div class="info" title="Cash in Hand">
						<img src="./money.png"/> <b>Rs. <span id="remaining_bal">40000</span></b>
					</div>
					<div class="info" title="Money Spent">
						<img src="./cart.png"/> <b>Rs. <span id="cart_status"></span></b>
					</div>
				</div>			
			<?php
				$q="SELECT * FROM products order by rand()";
				$result = mysql_query($q) or die("query");
				WHILE($row = mysql_fetch_array($result))
					{
						$remove_c = 'def'.$row["id"];
						$add_c = 'abc'.$row["id"];
						$addc = $row["id"];
						$str = strtolower($row["website"]);
						$str = str_replace(' ', '', $str);
						echo '
						<div class="box">
							<div'; /*if($cart["col".$row["id"]]==1)*/  echo'>
								<div class="company">
									<img src="http://cropmybill.com/img/store/'.$str.'.png" alt=" '.$str.'"/>
									<div class="cutting">
										<img src="./scissor.png"/>
									</div>
								</div>
								<div class="productimg"  id="'.$row["id"].'">
									<img src="./img/'.$row["id"].'.jpg"/>
								</div>
								<div class="prodex">
									<div class="name"><b>'.$row["name"].'</b></div>
									<div class="price"><b>Rs. </b><b class="mrp">'.$row["price"].'</b></div>
								</div>
							</div>
							';?>
							
							<div style="display:none;" class="button-pos" id="<?php echo $add_c ?>" onClick="addcart('<?php echo $add_c ?>');">
								<div class="button addcart" >
									ADD TO CART
								</div>
							</div>
							<div style="display:none;" class="button-pos" id="<?php echo $remove_c ?>" onClick="removecart('<?php echo $remove_c ?>');">
								<div class="button remcart" >
									REMOVE
								</div>
							</div>
							<?php
							echo '
						</div>';
					}
			?>
			
		</div>
	</div>
	<?php
	$added_q = mysql_query("SELECT * from products ") or die("E");
	WHILE($dbary = mysql_fetch_array($added_q))
		{
			echo '<script>document.getElementById("abc'.$dbary['id'].'").style.display = "block";</script>';
			echo '<script>document.getElementById("'.$dbary['id'].'").style.opacity = "1";</script>';
			echo '<script>document.getElementById("cart_status").innerHTML = "0";</script>';
		}
	$remove_q = mysql_query("SELECT * from cart where status = '1' and user = '$session'") or die("E");
	$cart_value = 0;
	if($session !=null)
	{
	WHILE($dbary = mysql_fetch_array($remove_q))
		{
			$cart_value = $cart_value + $dbary['price'];
			echo '<script>document.getElementById("'.$dbary['product_id'].'").style.opacity = "0.5";</script>';
			echo '<script>document.getElementById("def'.$dbary['product_id'].'").style.display = "block";</script>';
			echo '<script>document.getElementById("cart_status").innerHTML = "'.$cart_value.'";</script>';
			echo '<script>document.getElementById("remaining_bal").innerHTML = "'.(40000-$cart_value).'";</script>';
		}
	}
	/*
	$q_p = "SELECT cart.cart_id as cart_id,cart.product_id as product_id, cart.user as user, cart.status as status, products.id as id
		FROM products
		INNER JOIN cart";
		$cart_result = mysql_query($q_p) or die("query");
		$name_conf	= array();
		$name_pend	= array();
		WHILE($res = mysql_fetch_array($cart_result))
		{
			if(isset($res['id']))
			{
				if($res['status']=='1')
				{
					$name_conf[] = $res['id'];
				}
				else
				{
					
					$name_pend[] = $res['id'];
				}
				
				//echo $res['status'];
				/*if((isset($res['status']))&&($res['status'] == 1))
				{
					$name_pend[] = $res['id'];
				}else
				{
					$name_conf[] = $res['id'];
				}
			}
		}
		//print_r ($name_conf);
		foreach ($name_conf as &$value) {
			//echo $value;
			
			echo '<script>document.getElementById("abc'.$value.'").style.display = "block";</script>';
			echo '<script>document.getElementById("def'.$value.'").style.display = "none";</script>';
		}
		foreach ($name_pend as &$value) {
			//echo $value;
			echo '<script>document.getElementById("abc'.$value.'").style.display = "none";</script>';
			echo '<script>document.getElementById("def'.$value.'").style.display = "block";</script>';
		}
		*/
		?>
			<div id="brokkk">
			<div id="blanket" style="display:none;" onclick="rempop()">
			</div>
				<div class="broke" id="broke" style="display:none;">
					<div class="tv" id="tv">
						<div class="broketext" id="broketext">
							Sorry you donot have enough money in hand to purchase this item.
							<span class="cross" id="cross" onmouseover="xswap()" onmouseout="xori()" onclick="rempop()"><img id="x" src="./x.png"/><img id="xx" style="display:none" src="./xx.png"/></span>
						</div>
					</div>
				</div>
			</div>
	</body>
	
	<script>
		function rempop() {
			document.getElementById("blanket").style.display = "none";
			document.getElementById("broke").style.display = "none";
		}
		function addcart(e) {
				<?php if($session==null)
				{
					echo ' joinus();brake;';
				}
				?>
				var p="cvalue="+e;
				var g="";
				var Li="./code.php";
				var el="cart_status";
				var remove_e = lod(g,p,Li,el);
				console.log(e);
				if(remove_e == "a")
				{
					
					
					document.getElementById(e).style.display = "none";
					//var stringLength = e.length; // this will be 16
					//var lastChar = e.charAt(stringLength - 1);
					var lastChar=e.substring(3);
					console.log(lastChar);
					SC("cmb_atc",lastChar,3);
					document.getElementById(lastChar).style.opacity = "0.5";
					lastChar = 'def' + lastChar;
					document.getElementById(e).style.display = "none";
					document.getElementById(lastChar).style.display = "block";
					
					console.log(lastChar);
				}
				else
					console.log("add to cart error");
		}
		function removecart(k) {
				<?php if($session==null)
				{
					echo ' joinus();brake;';
				}
				?>
				var p="cvalue="+k;
				var g="";
				var Li="./code.php";
				var el="cart_status";
				remove_k = lod(g,p,Li,el);
				if (remove_k=="a"){
					//var stringLength = k.length; // this will be 16
					//var lastChar = k.charAt(stringLength - 1);
					var lastChar=k.substring(3);
					document.getElementById(lastChar).style.opacity = "1";
					SC("cmb_atc",lastChar,3);
					lastChar = 'abc' + lastChar
					
					document.getElementById(k).style.display = "none";
					document.getElementById(lastChar).style.display = "block";
					console.log(remove_k);
				}
				else
					console.log("remove to cart error");
		}
		
	</script>
	<Script>
	(function(){
    //console.log('1');
	
	
	var some = GC("cmb_cc");
	//console.log("123");
	if(some != '')
	{
		document.getElementById(some).style.opacity = "1";
		somedef= "def"+some;
		someabc= "abc"+some;
		console.log(some);
		document.getElementById(somedef).style.display = "none";
		document.getElementById(someabc).style.display = "block";
		var update = document.getElementById('cart_status').innerHTML;
		console.log(update);
		
		var p="check_bal="+"check_bal";
		var g="";
		var Li="./code.php";
		var el="cart_status";
		lod(g,p,Li,el);
		
		SC("cmb_cc","",-1000);
		//document.getElementById("abc'.$cookie.'").style.display = "block";
	}
    setTimeout(arguments.callee, 500);
	})();
	
	
	</script>
	
	</html>
	
<?php
mysql_close($connection);
mysql_close($conn);
?>