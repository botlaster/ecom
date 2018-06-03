<?php
session_start();
?>
<html>
<head>
<title>The Mountain Bag</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="js/include.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<style>
.footer {
    clear: both;
    position: relative;
    bottom: 0;
    margin-top: 10em;
}
.abc th,.abc td{
text-align:center;
}
#abc{
width:100%;
}

</style>
</head>
<body>
<div w3-include-html="header.html"></div>
<?php
include "connect.php";
?>
<br><br><br>
<center>
  
  <?php
  $Total = 0;
  $SumTotal = 0;
	if(isset($_SESSION["intLine"])){
		?>
		<form action="update.php" method="post">
<table class="abc" width="700"  border="1" id="customers">
  <tr>
    <th width="125">ProductName</th>
	<th width="75">Image</th>
    <th width="100">Price</th>
    <th width="100">Qty</th>
    <th width="100">Total</th>
    <th width="100">Delete</th>
  </tr><h1>Check Out</h1><br> <?php
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
		  
		$strSQL = "SELECT * FROM product WHERE id = '".$_SESSION["strProductID"][$i]."' ";
		$objQuery = mysql_query($strSQL)  or die(mysql_error());
		$objResult = mysql_fetch_array($objQuery);
		$Total = $_SESSION["strQty"][$i] * $objResult["price"];
		$SumTotal = $SumTotal + $Total;
		
		
	  ?>
	  
	  <tr>
		<td><?php echo $objResult["name"];?><input type="hidden" name="txtProductID<?php echo $i;?>" value="<?php echo $_SESSION["strProductID"][$i];?>"</td>
		<td><?php echo "<img src='../admin/product/".$objResult['filename']."' height=150/>" ?></td>
		<td><?php echo $objResult["price"];?></td>
		<td>
			<select name="txtQty<?php echo $i;?>">
				<?php 
			
				for($qty=1;$qty<=20;$qty++)
			  {
					$sel = "";
					if($_SESSION["strQty"][$i] == $qty)
				  {
						$sel = "selected";
				  }
			  ?>
				<option value="<?php echo $qty;?>" <?php echo $sel;?>><?php echo $qty;?></option>
				<?php
			  }
			  ?>
			</select>
		</td>
		<td><?php echo number_format($Total,2);?></td>
		<td><a href="delete.php?Line=<?php echo $i;?>">x</a></td>
	  </tr>
	  
	  <?php
	  }
  }
  ?>
   <tr>
		<td><strong></strong></td>
		<td></td>
		<td></td>
		<td>
		</td>
		<td><input class="button button2" style="font-size: 15px;"
} type="submit" value="Update"/></td>
		<td></td>
	  </tr>
   <tr>
		<td></td>
		<td>จำนวนสินค้าทั้งหมด</td>
		<td><?php 
  $count=0;
		for($i=0;$i<count($_SESSION["strQty"]);$i++)
		{
			$count+=$_SESSION["strQty"][$i];
		} 
		echo $count;?></td>
		<td>Price
		</td>
		<td><?php echo number_format($SumTotal,2);?></td>
		<td></td>
	  </tr>
  <tr>
		<td><strong>ค่าส่งชิ้นแรกราคา 50 บาท ตั้งแต่ชิ้นที่ 2 ขึ้นไปชิ้นละ 10 บาท</strong></td>
		<td></td>
		<td></td>
		<td>Charge
		</td>
		<td><?php if($count>0){$c=($count-1)*10+50;echo number_format($c,2);}?></td>
		<td></td>
	  </tr>
  <tr>
		<td><strong></strong></td>
		<td></td>
		<td></td>
		<td>Total
		</td>
		<td><?php $SumTotal=$SumTotal+$c; echo number_format($SumTotal,2);?></td>
		<td></td>
	  </tr>
</table>

</form>
<br>
<?php
}else{ ?><center><br><br><br><br><br><br>
<h1>No Have Order. </h1></center> <?php
}
	if($SumTotal > 0)
	{
?>
	 <button class="button button3" id="abc" onclick="location='save_checkout.php'">Payment</button> 
<?php
	}
mysql_close();
?>
<br>
<div w3-include-html="footer.html"></div>
<script>
w3.includeHTML();
</script>
</body>
</html>