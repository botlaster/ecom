﻿<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Free Snow Bootstrap Website Template | Single :: w3layouts</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
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
<script src="js/include.js"></script>
<script src="js/jquery.min.js"></script>

     <!----details-product-slider--->
				<!-- Include the Etalage files -->
					<link rel="stylesheet" href="css/etalage.css">
					<script src="js/jquery.etalage.min.js"></script>
				<!-- Include the Etalage files -->
				<script>
						jQuery(document).ready(function($){
			
							$('#etalage').etalage({
								thumb_image_width: 300,
								thumb_image_height: 400,
								
								show_hint: true,
								click_callback: function(image_anchor, instance_id){
									alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
								}
							});
							// This is for the dropdown list example:
							$('.dropdownlist').change(function(){
								etalage_show( $(this).find('option:selected').attr('class') );
							});

					});
				</script>
				<!----//details-product-slider--->	
</head>
<body>
<div w3-include-html="header.html"></div>
<?php 
include "connect.php";
$str=mysql_query("select * from product where id='".$_GET['id']."'");
?>
	<form action="order.php" method="post" onsubmit="return JSalert();" target="iframe_target">
	<iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff"></iframe>
	<?php
while($data=mysql_fetch_array($str))
{
	?>
     <div class="main">
      <div class="shop_top">
		<div class="container">
			<div class="row">
				<div class="col-md-9 single_left">
				   <div class="single_image">
					     <ul id="etalage">
							<li>
								<a href="optionallink.html">
									<img class="etalage_thumb_image" src="../admin/product/<?=$data['filename']?>" />
									<img class="etalage_source_image" src="../admin/product/<?=$data['filename']?>" />
								</a>
							</li>
							
						</ul>
					    </div>
				        <!-- end product_slider -->
				        <div class="single_right">
				        	<h3><?=$data['name']?></h3>
				        	<p class="m_10"><?=$data['detail']?></p>
				        	
							<ul class="add-to-links">
    			              <!-- <li><a href="#"><img src="images/wish.png" alt="">Add to wishlist</a></li>-->
    			            </ul>
							
				        </div>
				        <div class="clear"> </div>
				</div>
				<div class="col-md-3">
				  <div class="box-info-product">
					<p  class="price2" style="display:inline">฿</p><p style="display:inline" class="price2" id="c"><?=$data['price']?></p>
					       <ul class="prosuct-qty">
								<span>Quantity:</span>
								<select id="qun" name="txtQty" onchange="abc(this);">
								<?php
								for($i=1;$i<11;$i++)
								{
									echo "<option value=$i>$i</option>";
								}
								?>
								</select>
							</ul>
							<p style="display:inline">Total: <div style="display:inline" id="total"><?=$data['price']?></div></p><br/>
							<button type="submit" id="Submit" name="Submit" class="exclusive" >
							   <span>Add to cart</span>
							</button>
				   </div>
			   </div>
			</div>		
	     </div>
	   </div>
	</div>
	<input type="hidden" name="txtProductID" value="<?=$data['id']?>">
</form>
<?php
}
?>
<div w3-include-html="footer.html"></div>
<script>
w3.includeHTML();
function abc(data)
{
	var a = document.getElementById("qun");
	var b = a.options[a.selectedIndex].value;
	var d = $("#c").text();
	document.getElementById("total").innerHTML=d*b;
}
function JSalert(){
 
swal("Add product", "Add To List Already", "success");
 return true;
}
</script>
</body>	
</html>