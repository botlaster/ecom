<?php
session_start();?>
</body>
</html>
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
<script>
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
function checkemail()
{
	var emailFilter=/^.+@.+\..{2,3}$/;
	var str=document.getElementById("email").value;
	var a=document.getElementById("email");
	if (!(emailFilter.test(str))) 
	{ 
		alert ("ท่านใส่อีเมล์ไม่ถูกต้อง กรุณากรอกใหม่");
//		document.activeElement.blur();
//		document.getElementById("email").value="";
	}
}

function check()
{
	var a = document.getElementById("pw");
	var b = document.getElementById("repw");
	if(a.value!=b.value)
	{
		alert("พาสเวิร์ดไม่ตรงกัน");
		a.value="";
		b.value="";
		a.focus();
	}
}
     </script>
 </head>
<body>
<?php
if(isset($_SESSION['email']))
{
	echo '55';
}
else
{
?>
<div w3-include-html="header.html"></div>
     <div class="main">
      <div class="shop_top">
	     <div class="container">
						<form action="save_checkout.php" method="post"> 
								<div class="register-top-grid">
										<center><h2>กรุณากรอกข้อมูล</h2></center><br>
										<div>
											<span>First Name<label>*</label></span>
											<input type="text" name="txtName" id="name" autofocus required> 
										</div>
										<div>
											<span>Last Name<label>*</label></span>
											<input type="text" name="sur" id="sur" required> 
										</div>
										<div>
											<span>Tel<label>*</label></span>
											<input type="tel" name="txtTel" id="tel" maxlength="10" required> 
										</div>
										<div>
											<span>Email Address<label>*</label></span>
											<input type="email" name="txtEmail" id="email" required> 
										</div>
										<div>
											<span>Address<label>*</label></span>
											<textarea rows="2" cols="50" name="txtAddress" id="address" required></textarea>
										</div>
								</div>
								<div class="clear"> </div>
								<input class="buttona button1a" type="submit" value="Submit">
						</form>
					</div>
		   </div>
	  </div>
<div w3-include-html="footer.html"></div>
<script>
w3.includeHTML();
function JSalert(){
	swal("Add product", "Add To List Already", "success");
	return true;
}
</script>
<?php
}
?>
</body>	
</html>