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
	$strSQL = "SELECT * FROM orders order by orderid DESC";
	$objQuery = mysql_query($strSQL);
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
		<tr class="w3-hover-green">
	<td width="5%">
	<a href="onlyproduct.php?orderid=<?php echo $objResult["OrderID"];?>"><?php echo $objResult["OrderID"];?></td>
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

<?php

mysql_close();
?>
<div w3-include-html="footer.html"></div>
<script>
w3.includeHTML();
</script>
</body>
</html>