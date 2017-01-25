<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'arka_cropmybill');
define('DB_PASSWORD', '9735525775');
define('DB_DATABASE', 'arka_cropmybill');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
