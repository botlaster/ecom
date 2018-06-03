<?php
	@session_start();
	mysql_connect("localhost","root","1234") or die("Error Connect to Database");
		mysql_select_db("ecomtest") or die('Select Database Failed');
		$strSQL = mysql_query("SELECT * FROM product");	
		mysql_close();
?>

<!DOCTYPE html>
<html>
<title>Product List</title>
<head> 
<style>
p{

    padding-left: 80px;
}
</style>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>

<?php

?>
<br><br><br>
<br>

		<form class="form-horizontal" name="frmRegistration" method="post" action="">

			<?php
			while($objResult = mysql_fetch_array($strSQL)){

			?>	    
			<div class="container col-md-3 well p">
				<table>
					<tr>
					<tr><td>ชื่อสินค้า: <?php echo $objResult["name"];?></td></tr>
					<tr><td>ราคา: <?php echo $objResult["price"];?></td></tr>
					<tr><td>รายละเอียด: <?php echo $objResult["detail"];?></td></tr>
					</tr>
				</table>
				
				<td><img  src="<? echo $IMGPath.$objResult["filename"]; ?>" height="150" /></td>
			  </tr>
			</div>
			<?php
			}
			?>
		</table>
		<br>
		</form>

		

</body>
</html>

