<!doctype html>
<html lang="en">
 <head>
 <style>
td{
 height: 30px;
vertical-align: center;
}
 </style>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/fwslider.css" media="all">
<script src="js/jquery-ui.min.js"></script>
<script src="js/include.js"></script>
<script src="js/fwslider.js"></script>
  <title>The Mountain Bag</title>
 </head>
 <body>
 <?php
 if(isset($_POST["sm"])&&isset($_POST["txtName"])&&isset($_POST["price"])) 
 {	
	 include "connect.php";

	$dir=dirname(__FILE__).'\\product\\'.time()."_".$_FILES['filUpload']['name'];
	if(move_uploaded_file($_FILES['filUpload']['tmp_name'],$dir))
	{
		$strSQL = "INSERT INTO product (name, price, detail, filename, ImagePath) VALUES
		('" . $_POST["txtName"] . "', '" . $_POST["price"] . "','" . $_POST["detail"] . "', '".time()."_".$_FILES["filUpload"]["name"]."'
,'ecom/admin/product')";
		if(mysql_query($strSQL))
		{
			echo "<script>alert('Insert Successful')</script>";
			echo "<meta http-equiv='refresh' content='0;url=editp.php'>";
		}
	}
	mysql_close();
}
else
{
?>
	<div w3-include-html="header.html"></div>
	<br><br>
	<h2><center>Add Product</center></h2>
	<form name="form1" method="post" action="" enctype="multipart/form-data">
	<table align="center">
	<tr>
		<td align=right>
		Name:&nbsp
		</td>
		<td>
		<input type="text" name="txtName" placeholder="ชื่อสินค้า" required><br>
		</td>
	</tr>
	<tr>
		<td align=right>
			Price:&nbsp
		</td>
		<td>
			<input type="text" name="price" placeholder="หน่วย/บาท" required><br>
		</td>
	</tr>
	<tr>
		<td align="right">
			Detail:&nbsp
		</td>
		<td>
			<textarea rows="4" cols="50" name="detail" align="left" placeholder="ใส่อะไรสักหน่อย"></textarea><br>
		</td>
	</tr>
	<tr>
		<td align=right>
			Picture: &nbsp
		</td>
		<td>
			<br><input class="buttona button1a" type="file" name="filUpload" required><br>
		</td>
	</tr>
	</table>
	<center>
	<input class="button button2" type="submit" name="sm" value="Submit">&nbsp;&nbsp;&nbsp;
	<input class="button button3" type="reset" name="reset" value="Reset"><br><br><br><br><br>
	</center>
	</form>
	 <div w3-include-html="footer.html"></div>
<?php
}
?>
<script>
w3.includeHTML();
</script>
	   
 </body>
</html>
