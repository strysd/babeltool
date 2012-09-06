<?php
global $db_con;
$db_con = mysql_connect($dbIp, $dbUser, $dbPassword);
if(!$db_con){
	echo 'connection error:', mysql_error();
	return;
}
if(!mysql_select_db('test', $db_con)){
	echo 'selection error:', mysql_error();
	mysql_close($db_con);
	exit;
}

mysql_set_charset('latin1');
