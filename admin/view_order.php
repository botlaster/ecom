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
input[type="text"]
{
width:20%;
}
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

.button4 {
    background-color: white;
    color: black;
    border: 2px solid #e7e7e7;
}

.button4:hover {background-color: #e7e7e7;}
</style>
</head>
<body>
<div w3-include-html="header.html"></div>
<?php
session_start();
include "connect.php";
if(isset($_POST['order']))
{
	$strSQL = "SELECT * FROM orders WHERE Email = '".$_SESSION["email"]."' ";
	$objQuery = mysql_query($strSQL)  or die(mysql_error());
	$objResult = mysql_fetch_array($objQuery);
	?>
	<center>
	 <table border="1" style="margin-bottom:50" class="w3-table-all">
	 <thead>
		<tr>	
		  <th width="71">OrderID</th>
		  <th width="71">Name</th>
		  <th width="71">Surname</th>
		  <th>Address</th>
		  <th>วันที่สั่ง</th>
		  <th>ค่าส่ง</th>
		  <th>ยอดรวมทั้งหมด</th>
		</tr>
	</thead>
	<?php
	while($objResult=mysql_fetch_array($objQuery))
	{
		?>
		<tr class="w3-hover-blue">
	<td width="5%">
	<?php echo $objResult["OrderID"];?></td>
	<td width="10%">
	<?php echo $objResult["Name"];?></td>
	<td width="10%">
	<?php echo $objResult["sur"];?></td>
	<td width="40%"><?php echo $objResult["Address"];?></td>
	<td width="15%"><?php echo $objResult["OrderDate"];?></td>
	<td width="10%"><?php echo $objResult["charge"];?></td>
	<td width="10%"><?php echo $objResult["tprice"];?></td>
	</tr>
		<?php
	}
	?>
	</table>
	<center>
	<form action="" method="post">
	<input type="text" name="order" id="order" value="" size="20" class="abc" placeholder='กรอก OrderID เพื่อดูรายละเอียด'>
	<input type="submit" name="sm" id="sm" value="Search" class="button button4">
	</form>

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
	$strSQL2 = "SELECT * FROM orders_detail WHERE OrderID = '".$_POST["order"]."' ";
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
			<td><?php echo $_POST['order'];?></td>
			<td><?php echo $objResult3["name"];?></td>
			<td><?php echo "<img src='product/".$objResult3['filename']."' height=150/>" ?></td>
			<td><?php echo $objResult3["price"];?></td>
			<td><?php echo $objResult2["Qty"];?></td>
			<td><?php echo number_format($Total,2);?></td>
		  </tr>
		  <?php
		  if($count>0){$c=($count-1)*10+50;}
	 }
	 $strSQL = "SELECT * FROM orders WHERE OrderID = '".$_POST["order"]."' ";
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
	<?php
}
else
{
	$strSQL = "SELECT * FROM orders WHERE Email = '".$_SESSION["email"]."' ";
	$objQuery = mysql_query($strSQL)  or die(mysql_error());
	$objResult = mysql_fetch_array($objQuery);
	?>
	<center>
	 <table border="1" style="margin-bottom:50" class="w3-table-all">
	 <thead>
		<tr>	
		  <th width="71">OrderID</th>
		  <th width="71">Name</th>
		  <th width="71">Surname</th>
		  <th>Address</th>
		  <th>วันที่สั่ง</th>
		  <th>ค่าส่ง</th>
		  <th>ยอดรวมทั้งหมด</th>
		</tr>
	</thead>
	<?php
	while($objResult=mysql_fetch_array($objQuery))
	{
		?>
		<tr>
	<td width="5%">
	<?php echo $objResult["OrderID"];?></td>
	<td width="10%">
	<?php echo $objResult["Name"];?></td>
	<td width="10%">
	<?php echo $objResult["sur"];?></td>
	<td width="40%"><?php echo $objResult["Address"];?></td>
	<td width="15%"><?php echo $objResult["OrderDate"];?></td>
	<td width="10%"><?php echo $objResult["charge"];?></td>
	<td width="10%"><?php echo $objResult["tprice"];?></td>
	</tr>
		<?php
	}
	?>
	</table>
	<center>
	<form action="" method="post">
	<input type="text" name="order" id="order" value="" size="20" class="abc" placeholder='กรอก OrderID เพื่อดูรายละเอียด'>
	<input type="submit" name="sm" id="sm" value="Search" class="button button4" style="margin-bottom:50">
	</form>

<?php
}
mysql_close();
?>
<div w3-include-html="footer.html"></div>
<script>
w3.includeHTML();
</script>
</body>
</html>