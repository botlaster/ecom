<?php
$name=mysql_real_escape_string($_POST['name']);
$sur=mysql_real_escape_string($_POST['sur']);
$tel=mysql_real_escape_string($_POST['tel']);
$address=mysql_real_escape_string($_POST['address']);
$email=mysql_real_escape_string($_POST['email']);
$pw=mysql_real_escape_string($_POST['pw']);
include "connect.php";
$str="insert into member(name,sur,tel,address,email,password) values('".$name."','".$sur."','".$tel."','".$address."','".$email."','".$pw."')";
if(mysql_query($str))
{
	echo "<script>alert('ลงทะเบียนเรียบร้อย')</script>";
	echo "<meta http-equiv='refresh' content='0;url=login.html'>";
}
else
{
	echo "<script>alert('ลงทะเบียนไม่ได้ กรุณากรอกใหม่')</script>";
	echo "<script>window.history.back();</script>";
	//echo "<meta http-equiv='refresh' content='0;url=register.html'>";
}

?>