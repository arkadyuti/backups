<?php

$to      = 'arkadooti.sarkar@gmail.com';
$subject = 'the subject';
$message = "
<html>
<head>
<title>CropmyBill</title>
</head>
<body>
<p>Your password!</p>
<table>
<tr>
<th>Email</th>
</tr>
<tr>
<td>password</td>
</tr>
</table>
</body>
</html>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: care@cropmybill.com' . "\r\n" .
			'Reply-To: care@cropmybill.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers) or die("error");
?>
