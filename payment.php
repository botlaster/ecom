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
</head>
<body>
<div w3-include-html="header.html"></div>
<center>
<h2 style="margin-bottom:30;margin-top:50;font-family:NN mutthayom1">สะดวกจ่ายทาง</h2>
<div id="paypal-button-container" style="margin-bottom:100;margin-top:30"></div>
</center>
<div w3-include-html="footer.html"></div>
<?php
if(isset($_POST['sm']))
{
	$_SESSION['txtName']=$_POST["txtName"];
	$_SESSION['sur']=$_POST["sur"];
	$_SESSION['txtAddress']=$_POST["txtAddress"];
	$_SESSION['txtTel']=$_POST["txtTel"];
	$_SESSION['txtEmail']=$_POST["txtEmail"];
	echo $_SESSION['txtName'],' ',$_SESSION['sur'],' ',$_SESSION['txtAddress'],' ',$_SESSION['txtTel'],' ',$_SESSION['txtEmail'],'555';echo ' 655';
}
?>
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
                            amount: { total: '<?php echo $_SESSION["sum"]?>', currency: 'THB' }
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
<script>
w3.includeHTML();
</script>
</body>
</html>