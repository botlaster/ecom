﻿<?php
session_start();

include "connect.php";
if(isset($_SESSION['email']))
{
  $Total = 0;
  $SumTotal = 0;
  $str=mysql_query("select * from member where email='".$_SESSION['email']."'");
  while($data=mysql_fetch_array($str))
  {
	  $a['name']=$data['name'];
	  $a['sur']=$data['sur'];
	  $a['address']=$data['address'];
	  $a['tel']=$data['tel'];
	  $a['email']=$data['email'];
  }
  $strSQL = "
	INSERT INTO orders (Name,sur,Address,Tel,Email,charge,tprice)
	VALUES
	('".$a["name"]."','".$a["sur"]."','".$a["address"]."','".$a["tel"]."','".$a["email"]."','".$_SESSION["c"]."','".$_SESSION['sum']."') 
  ";
  mysql_query($strSQL) or die(mysql_error());

  $strOrderID = mysql_insert_id();

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
			  $strSQL = "
				INSERT INTO orders_detail (OrderID,ProductID,Qty)
				VALUES
				('".$strOrderID."','".$_SESSION["strProductID"][$i]."','".$_SESSION["strQty"][$i]."') 
			  ";
			  mysql_query($strSQL) or die(mysql_error());
	  }
  }

mysql_close();
unset($_SESSION['intLine']);
unset($_SESSION['strProductID']);
unset($_SESSION['strQty']);
unset($_SESSION['c']);
unset($_SESSION['sum']);
header("location:finish_order.php");
}
else
{
	
  $Total = 0;
  $SumTotal = 0;

  $strSQL = "
	INSERT INTO orders (Name,sur,Address,Tel,Email,charge,tprice)
	VALUES
	('".$_POST["txtName"]."','".$_POST["sur"]."','".$_POST["txtAddress"]."','".$_POST["txtTel"]."','".$_POST["txtEmail"]."','".$_SESSION["c"]."','".$_SESSION['sum']."') 
  ";
  mysql_query($strSQL) or die(mysql_error());

  $strOrderID = mysql_insert_id();

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
			  $strSQL = "
				INSERT INTO orders_detail (OrderID,ProductID,Qty)
				VALUES
				('".$strOrderID."','".$_SESSION["strProductID"][$i]."','".$_SESSION["strQty"][$i]."') 
			  ";
			  mysql_query($strSQL) or die(mysql_error());
	  }
  }

mysql_close();

session_destroy();

//header("location:finish_order.php?OrderID=".$strOrderID);
header("location:finish_order.php");
}