<!DOCTYPE HTML>
<html>
<head>
<title>The Mountain Bag</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<script src="js/include.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });
                        
            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });
                        
            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
</script>
</head>
<body>
<div w3-include-html="header.html"></div>
<br/>
<?php
if(isset($_GET['id'])&&isset($_POST['sm']))
{
	include "connect.php";
	if($_FILES['filUpload']['name']!="")
	{
		$dir=dirname(__FILE__)."\\product\\".$_FILES['filUpload']['name'];
		if(move_uploaded_file($_FILES['filUpload']['tmp_name'],$dir))
		{
			$str="update product set name='".$_POST['txtName']."',price='".$_POST['price']."',detail='".$_POST['detail']."',filename='".time()."_".$_FILES['filUpload']['name']."' where id='".$_GET['id']."'";
			if(mysql_query($str))
			{
				echo "<script>alert('Update Successful')</script>";
				@unlink("product/".$_POST['oldfile']);
			}
			mysql_close();
			echo "<meta http-equiv='refresh' content='0;url=$_SERVER[SCRIPT_NAME]'>";
		}
	}
	else
	{
		$str="update product set name='".$_POST['txtName']."',price='".$_POST['price']."',detail='".$_POST['detail']."' where id='".$_GET['id']."'";
		if(mysql_query($str))
		{
			echo "<script>alert('Update Successful')</script>";
			mysql_close();
			echo "<meta http-equiv='refresh' content='0;url=$_SERVER[SCRIPT_NAME]'>";
		}
	}
}
else if(isset($_GET['id']))
{
	include "connect.php";
	$str=mysql_query("select * from product where id='".$_GET['id']."'");
	while($data=mysql_fetch_array($str))
	{
		?>
		<h2><center>Edit Product</center></h2>
		<form name="form1" method="post" action="" enctype="multipart/form-data">
			<table align="center">
				<tr> 
					<td align=right>
					Name:&nbsp
					</td>
					<td>
					<input type="text" name="txtName" placeholder="ชื่อสินค้า" value="<?=$data['name'];?>" required><br>
					</td>
				</tr>
				<tr>
					<td align=right>
						Price:&nbsp
					</td>
					<td>
						<input type="text" name="price" placeholder="หน่วย/บาท" value="<?=$data['price'];?>" required><br>
					</td>
				</tr>
				<tr>
					<td align="right">
						Detail:&nbsp
					</td>
					<td>
						<textarea rows="4" cols="50" name="detail" align="left" placeholder="ใส่อะไรสักหน่อย"><?=$data['detail'];?></textarea><br>
					</td>
				</tr>
				<tr>
					<td align=right>
						Picture: &nbsp
					</td>
					<td>
						<br><input class="buttona button1a" type="file" name="filUpload"><br>
						<input type="hidden" name="oldfile" value="<?=$data["filename"];?>">
					</td>
				</tr>
				<tr>
					<td align=right>
						Old Picture:
					</td>
					<td>
					<img src="product/<?=$data["filename"];?>" height="150"><br>
					</td>
				</tr>
			</table>
			<center>
			<br>
			<input class="button button2" type="submit" name="sm" value="Submit">&nbsp;&nbsp;
			<input class="button button5" type="button" name="back" value="Back" onclick="window.location.href='editp.php'"><br><br><br><br><br>
			</center>
			</form>
		<?php
		mysql_close();
	}
}
else if(isset($_GET['did']))
{
	include "connect.php";
	$str="delete from product where id='".$_GET['did']."'";
	if(mysql_query($str))
	{
		$str=mysql_query("select * from product where id='".$_GET['did']."'");
		while($data=mysql_fetch_array($str))
		{
			$file=$data['filename'];
		}
		@unlink("product/".$file);
		echo "<script>alert('Delete Product Successful')</script>";
		echo "<meta http-equiv='refresh' content='0;url=$_SERVER[SCRIPT_NAME]'>";
	}
}
else
{
	?>
	<div class="main">
		<h2><center>All Product</center></h2>
		<br/><center>
		<form method="post" action="">
			<table id="customers">
				<center>
				<tr>
					<th>รหัสสินค้า</th>
					<th>ชื่อสินค้า</th>
					<th>รายละเอียดสินค้า</th>
					<th>ราคาสินค้า</th>
					<th>รูปสินค้า</th>
					<th>แก้ไข</th>
					<th>ลบ</th>
				</tr>
				<?php
				include "connect.php";
				$str = mysql_query("SELECT * FROM product");	
				while($data = mysql_fetch_array($str))
				{
					?>	    
					<tr>
					<td><center><?php echo $data["id"];?></center></td>
					<td><center><?php echo $data["name"];?></center></td>
					<td><center><?php echo $data["detail"];?></center></td>
					<td><center><?php echo '฿'.$data["price"];?></center></td>
					<td><center><img  src="<?php echo 'product/'.$data["filename"]; ?>" height="150" /></center></td>
					<td><center><a href="editp.php?id=<?=$data["id"];?>">Edit</a></center></td>
					<td><center><a href="editp.php?did=<?=$data["id"];?>" onclick="return abc()">Delete</a></center></td>
					</tr>
					<?php
				}
				mysql_close();
				?>
			</table>
		</form>
	</div>
<?php
}
?>
<div w3-include-html="footer.html"></div>
<script>
w3.includeHTML();
function abc()
{
	if(confirm("คุณต้องการลบสินค้านี้หรือไม่")==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
</body>
					