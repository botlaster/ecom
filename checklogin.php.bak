<?php
session_start();
include "connect.php";
if(isset($_POST['email'])&&isset($_POST['pw']))
{
	$email=mysql_real_escape_string($_POST['email']);
	$pw=mysql_real_escape_string($_POST['pw']);
	$str="select * from member where email='".$email."' and password='".$pw."'";
	$objstr=mysql_query($str);
	$result=mysql_fetch_array($objstr);
	if(!$result)
	{
		echo "incorrect username and password";
	}
	else
	{
		$_SESSION['email']=$result['email'];
		if($result['status']=="0")
		{
			echo "<meta http-equiv='refresh' content='0;url=admin/index.html'>";
		}
		else
		{
			echo "<meta http-equiv='refresh' content='0;url=member/index.html'>";
		}
	}
	mysql_close();
}
?>