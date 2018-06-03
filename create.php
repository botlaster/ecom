<?php
include "connect.php";
$str="create table member
(
	name varchar(20) not null, 
	sur varchar(20) not null,
	tel varchar(10) not null,
	email varchar(50) not null primary key,
	password varchar(32) not null,
	status varchar(1) not null default '1'
)";
$str2="create table product
(
	id int(10) not null primary key AUTO_INCREMENT,
	name varchar(50) not null, 
	price int(10) not null,
	detail varchar(250) not null,
	filename varchar(50) null
)";

$a = (mysql_query($str))? 'Create Table Member Successful<br>': 'Create Table Member Failed<br>';
$b = (mysql_query($str2))? 'Create Table Product Successful<br>':'Create Table Product Failed<br>';
echo $a,$b;
?>