<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "arka_cropmybill", "9735525775", "arka_cropmybill") or die("1");

$result = $conn->query("SELECT ID, session,cname,aff_sub,client, remote, forward, browser, reUrl, timestamp FROM redirect3") or die("2");
 
$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {$outp .= ",";}
    $outp .= '{"ID":"'  . $rs["ID"] . '",';
    $outp .= '"session":"'   . $rs["session"]        . '",';
	$outp .= '"aff_sub":"'   . $rs["aff_sub"]        . '",';
    $outp .= '"cname":"'   . $rs["cname"]        . '",';
	$outp .= '"remote":"'   . $rs["remote"]        . '",';
	$outp .= '"browser":"'   . $rs["browser"]        . '",';
	$outp .= '"reUrl":"'   . $rs["reUrl"]        . '",';
    $outp .= '"timestamp":"'. $rs["timestamp"]     . '"}'; 
}
$outp .="]";

$conn->close();

echo($outp);
?>