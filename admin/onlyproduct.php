<html>
<head>
<title>The Mountain Bag</title>
<link rel="stylesheet" href="../css/w3.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="js/include.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery.min.js"></script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<style>
.w3-button {width:150px;}
</style>
</head>
<body>
<div w3-include-html="header.html"></div>
<?php
if(isset($_GET['orderid']))
{
session_start();
include "connect.php";
	?>
	<center>
	<table width="400"  border="1" class="w3-table-all" style="margin-bottom:50;margin-top:50">
	<thead>
	  <tr class="w3-hover-black">
		<th width="200">OrderID</td>
		<th>ProductName</td>
		<th>Piture</th>
		<th>Price</td>
		<th>Quantity</td>
		<th>Total</td>
	  </tr>
	</thead>
	<?php

	$Total = 0;
	$SumTotal = 0;
	$count=0;
	$strSQL2 = "SELECT * FROM orders_detail WHERE OrderID = '".$_GET["orderid"]."' ";
	$objQuery2 = mysql_query($strSQL2)  or die(mysql_error());
	$c=0;
	while($objResult2 = mysql_fetch_array($objQuery2))
	{
			$strSQL3 = "SELECT * FROM product WHERE id = '".$objResult2["ProductID"]."' ";
			$objQuery3 = mysql_query($strSQL3)  or die(mysql_error());
			$objResult3 = mysql_fetch_array($objQuery3);
			$Total = $objResult2["Qty"] * $objResult3["price"];
			$SumTotal = $SumTotal + $Total;
			$count+=$objResult2["Qty"]; 
		  ?>
		  <tr class="w3-hover-blue">
			<td><?php echo $_GET['orderid'];?></td>
			<td><?php echo $objResult3["name"];?></td>
			<td><?php echo "<img src='product/".$objResult3['filename']."' height=150/>" ?></td>
			<td><?php echo $objResult3["price"];?></td>
			<td><?php echo $objResult2["Qty"];?></td>
			<td><?php echo number_format($Total,2);?></td>
		  </tr>
		  <?php
		  if($count>0){$c=($count-1)*10+50;}
	 }
	 $strSQL = "SELECT * FROM orders WHERE OrderID = '".$_GET["orderid"]."'";
	$objQuery = mysql_query($strSQL)  or die(mysql_error());
	$objResult = mysql_fetch_array($objQuery);
	 ?>
	 <tr class="w3-hover-red">
	 <td></td><td></td><td></td><td></td><td>Charge</td><td><?php echo number_format($objResult['charge'],2);?></td>
	 </tr>
	 <tr class="w3-hover-red">
	 <td></td><td></td><td></td><td></td>
	 <td>
	Total
	</td>
	<td>
	<?php 
	$SumTotal=$SumTotal+$c; echo number_format($objResult['tprice'],2);?>
	</td>
	 </tr>
	</table>
	<input class="w3-button w3-light-blue" style="margin-bottom:50" type="button" onclick="location='report.php'" value="Back">
<?php
mysql_close();
}
?>
<div w3-include-html="footer.html"></div>
<script>
w3.includeHTML();
</script>
</body>
</html>