<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
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
<script src="../sweetalert/sweetalert2.all.min.js"></script>
<script src="../sweetalert/sweetalert2.common.js"></script>
<script src="../sweetalert/sweetalert2.common.min.js"></script>
<script src="../sweetalert/sweetalert2.common.min.js.map"></script>
<script src="../sweetalert/sweetalert2.css	"></script>
<script src="../sweetalert/sweetalert2.js"></script>
<script src="../sweetalert/sweetalert2.min.css"></script>
<script src="../sweetalert/sweetalert2.min.js"></script>
<script src="js/jquery.min.js"></script>
</head>
<body>
	<div w3-include-html="header.html"></div>
	
<form action="order.php" method="post" onsubmit="return JSalert();" target="iframe_target">
<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff"></iframe>
     <div class="main">
      <div class="shop_top">
		<div class="container">
			<div class="row shop_box-top">
			<?php
			include "connect.php";
			
			$str=mysql_query("select * from product");
			$i=0;
			
			while($data=mysql_fetch_array($str))
			{	

				if($i==4)
				{
					
					?>
					<div class="row shop_box-top">
					<?php
					$i=0;
				}
				?>


				<div class="col-md-3 shop_box"><a href="single.php?id=<?=$data['id']?>">
					<img src="<?php echo "product/".$data['filename'];?>" class="img-responsive" alt=""/>
					<div class="shop_desc">
						<h3><a href="single.php?id=<?=$data['id']?>"><?=$data['name']; ?></a></h3>
						<input type="hidden" name="txtProductID" value="<?=$data['id'];?>">
						<input type="hidden" name="txtQty" value="1">
						<p><?=$data['detail']; ?></p>
						<span class="actual"><?php echo '฿'.number_format($data['price'],0,'.',','); ?> </span><br>
						<ul class="buttons">

							<li class="cart"><button class="button2" type="button" id="Submit" name="Submit" onclick="JSalert();settimeout('order.php?txtProductID=<?=$data['id']?>');">Add To Cart</button></li>
							<li class="shop_btn"><a href="single.php?id=<?=$data['id']?>">Read More</a></li>
							<div class="clear"> </div>
					    </ul>
				    </div>
				</a></div>
				
				<?php
				$i++;
				if($i==4)
				{
					?>
					</div>
					<?php
				}
			}
				
			?>
				<?php
				if($i!=4)
				{
					echo "</div>";
				}
				?>
				
			</div>
		 </div>
	   </div>
	  </div>
	   <div w3-include-html="footer.html"></div>
</form>
<script>
w3.includeHTML();
function JSalert(){
	swal("Add product", "Add To List Already", "success");
	return true;
}
function settimeout(p1)
{
	 setTimeout(function(){
      window.location.href = p1;
  },1000)
}
</script>
</body>	
</html>