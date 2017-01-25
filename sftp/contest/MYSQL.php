<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if(isset($_SESSION['contest']))
{
	$email = $_SESSION['contest'];
}else
	$email = null;
$conn = new mysqli("localhost", "arka_cropmybill", "9735525775", "arka_contest") or die("1");

$result = $conn->query("SELECT products.id as product_id,products.website as website, products.name as name, products.price as price
							FROM products
							INNER JOIN cart
							ON products.id = cart.product_id and cart.status='1' and cart.user='$email'
							GROUP BY products.id;") or die("2");
 
$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"ID":"'  . $rs["product_id"] . '",';
	$str = strtolower($rs["website"]);
	$str = str_replace(' ', '', $str);
    $outp .= '"website":"'   . $str        . '",';
	$outp .= '"name":"'   . $rs["name"]        . '",';
    
    $outp .= '"price":"'. $rs["price"]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);

?>