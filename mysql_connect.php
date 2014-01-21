<?php  
$host="localhost";
$user="group0";
$password="telic";
$link=mysql_connect($host,$user,$password);
$query = "SET NAMES 'utf8'";
$result = mysql_query($query);
mysql_select_db("Group0",$link) || die("db error");
?>