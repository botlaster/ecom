<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php

mysql_connect("localhost","root","password") or die("Error Connect to Database");
mysql_select_db("ecomtest") or die('Select Database Failed');
	if(isset($_POST["sm"])) {	
		$strSQL = "INSERT INTO product (name, price, detail, filename, ImagePath) VALUES
		('" . $_POST["txtName"] . "', '" . $_POST["price"] . "','" . $_POST["detail"] . "', '".$_FILES["filUpload"]["name"]."'
		,'ecom/admin/image')";
		$objQuery = mysql_query($strSQL);
		if(copy($_FILES["filUpload"]["tmp_name"],"image/".$_FILES["filUpload"]["name"])){

			echo 'insert success';
		}
		else{
			$error_message = "กรุณาเลือกรูปภาพ";
		}
	
	mysql_close();
	}
?>
</body>
</html>