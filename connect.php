<?php
$host="localhost";
$username="root";
$password="password";
$db="ecomtest";

mysql_connect($host,$username,$password) or die("Connect Failed");
mysql_query("set names utf8");
mysql_select_db($db) or die("Select DB Failed");

mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
?>