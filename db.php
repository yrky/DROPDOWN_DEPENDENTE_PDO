<?php
$mysql_db_hostname = "localhost";
$mysql_db_user = "root";
$mysql_db_password = "mysqlUsernamePassword";
$mysql_db_database = "teste";
try{
	$con=new PDO("mysql:host=$mysql_db_hostname;dbname=$mysql_db_database","$mysql_db_user","$mysql_db_password");
}catch(PDOExection $e){
	echo $e->getMessage();
}
?>