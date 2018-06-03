<?php
session_start();
?>
<html>
<head>
<title>The Mountain Bag</title>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<script src="js/include.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/jquery.min.js"></script>
<script>
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
<div w3-include-html="header.html"></div>
     <div class="main">
      <div class="shop_top">
	     <div class="container">
						<form action="payment.php" method="post"> 
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
								<input class="buttona button1a" type="submit" name="sm" value="Submit">
						</form>
					</div>
		   </div>
	  </div>
	  
<div id="paypal-button-container"></div>
<div w3-include-html="footer.html"></div>
<script>
w3.includeHTML();
</script>
<script>

    // Render the PayPal button

    paypal.Button.render({

        // Set your environment

        env: 'sandbox', // sandbox | production

        // Specify the style of the button

        style: {
            layout: 'vertical',  // horizontal | vertical
            size:   'medium',    // medium | large | responsive
            shape:  'rect',      // pill | rect
            color:  'gold'       // gold | blue | silver | black
        },

        // Specify allowed and disallowed funding sources
        //
        // Options:
        // - paypal.FUNDING.CARD
        // - paypal.FUNDING.CREDIT
        // - paypal.FUNDING.ELV

        funding: {
            allowed: [ paypal.FUNDING.CARD, paypal.FUNDING.CREDIT ],
            disallowed: [ ]
        },

        // PayPal Client IDs - replace with your own
        // Create a PayPal app: https://developer.paypal.com/developer/applications/create

        client: {
            sandbox:    'ASWBjJgeol7E9yqbUtwgKUwado8wUQ91F5-CdnLSUCy7fZPavzcKszl4dCu0StuwxT8eH5tcJTTv9jCh',
            production: '<insert production client id>'
        },

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $_SESSION["money"]?>', currency: 'THB' }
                        }
                    ]
                }
            });
        },

        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                window.location.href="save_checkout.php";
            });
        }

    }, '#paypal-button-container');

</script>
</body>
</html>