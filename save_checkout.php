<?php
session_start();

include "connect.php";
if(isset($_SESSION['sum'])&&isset($_SESSION['c']))
{
	
  $Total = 0;
  $SumTotal = 0;

  $strSQL = "
	INSERT INTO orders (Name,sur,Address,Tel,Email,charge,tprice)
	VALUES
	('".$_SESSION["txtName"]."','".$_SESSION["sur"]."','".$_SESSION["txtAddress"]."','".$_SESSION["txtTel"]."','".$_SESSION["txtEmail"]."','".$_SESSION["c"]."','".$_SESSION['sum']."') 
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
unset($_SESSION['strQty']);;
unset($_SESSION['c']);
unset($_SESSION['sum']);
unset($_SESSION['txtName']);
unset($_SESSION['sur']);
unset($_SESSION['txtAddress']);
unset($_SESSION['txtTel']);
unset($_SESSION['txtEmail']);
unset($_SESSION['email']);
session_destroy();
header("location:finish_order.php");
}
