<?php
$host="localhost";
$username="root";
$password="password";
$db="ecomtest";

mysql_connect($host,$username,$password) or die("Connect Failed");
mysql_query("set names utf8");
mysql_select_db($db) or die("Select DB Failed");
?>