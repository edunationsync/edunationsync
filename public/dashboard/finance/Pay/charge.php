<?php
  $project_id=$_GET['id'];
  $amount=$_GET['amount'];

  if($_POST['btnPay'])
  {
    $amount=$_POST['txtamount'];
    $email=$_POST['txtemail'];
    $phone=$_POST['txtphone'];
    $projectid=$_POST['txtprojectid'];
    $fname=$_POST['txtfirstname'];
    $lname=$_POST['txtlastname'];
    echo "
         Amount: $amount<br/>
         Email: $email<br/>
         Phone: $phone<br/>
         Project Id: $projectid<br/>
         FName: $fname<br/>
         LName: $lname

         ";
  }
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Aviato E-Commerce Template">
  
  <meta name="author" content="Themefisher.com">

  <title>Global Shining | Research and Innovation Team</title>

  <link rel="stylesheet" href="style.css">
  <!-- Mobile Specific Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png" />
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">
  <!-- Ionic Icon Css -->
  <link rel="stylesheet" href="../plugins/Ionicons/css/ionicons.min.css">
  <!-- animate.css -->
  <link rel="stylesheet" href="../plugins/animate-css/animate.css">
  <!-- Magnify Popup -->
  <link rel="stylesheet" href="../plugins/magnific-popup/dist/magnific-popup.css">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="../plugins/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="../plugins/slick-carousel/slick/slick-theme.css">
  
  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="../css/style.css">
  <!--Resizable -->
    <!--PaySTack start-->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="myPaymentScript.js"></script>
    <!--PaySTack end-->


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".chatBoard" ).resizable();
  } );
  </script>
  <!--Resizable -->
</head>

<body id="body" onload="<?php if (empty($_GET['agent'])): ?>Minimize()
  
<?php endif ?>">

<!-- Header Start -->
<header class="navigation">

  <div id="chatBoard" class="chat_board">
    <div class="chat_title_bar_container">Global Shining Review</div>
    <div class="top_botton_container">
      <!--<button id="minimizebtn" onclick="Minimize()"  class="minimize_btn"></button><button  onclick="Maximize()"  class="maximize_btn"></button>--><button onclick="Close()"  class="close_btn"></button>
    </div>
    <br/><br/>
    <a href="Review" target="_blank"><center><img src="../images/review.png"></center></a>
  </div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- header Nav Start -->
				<nav class="navbar">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						 
						<!-- Collect the nav links, forms, and other content for toggling -->
						
							</div><!-- /.container-fluid -->
						</nav>
					</div>
				</div>
			</div>
			</header><!-- header close -->

<!-- Slider Start -->
<section class="slider">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="block">
					<h1 class="animated fadeInUp">Fill the Payment Teller Below</h1>
					<p class="animated fadeInUp">Your account information is treated with strict confidentiality and integrity<br/> You have no need to fear for froud on our website as we are highly secured<br/>Your order will be complete after making your payment.</p>
					<!--<a href="" target="_blank" class="btn btn-main animated fadeInUp"  >Rate Us</a>-->
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Wrapper Start -->
<section class="about section">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-sm-12">
				<div class="block">
					<div class="section-title">
						<h2>Payment Teller</h2>
						<p>Please fill this teller approriately because it is what we will use to reach you for confirmation of product delivery.</p>
					</div>
          <form>
            
            <input type="hidden" name="txtprojectid" id="txtprojectid" value="<?php echo $project_id; ?>">
            <input type="hidden" name="txtamount" id="txtamount" value="<?php echo $amount; ?>">

            <table class="paymentForm">
              <tr><td>Email</td><td><input type="email" name="txtemail" id="txtemail" placeholder="Email Address" required></td><td>Phone</td><td><input type="text" name="txtphone" id="txtphone" placeholder="Phone Number" required></td></tr>
              <tr><td>Amount</td><td><input type="text" name="txtamount" id="txtamount" placeholder="Amount e.g. 10000" required></td></tr>
              <tr><td colspan="4"><center><button onclick="payChargeWithPaystack(document.getElementById('txtemail').value,document.getElementById('txtphone').value,document.getElementById('txtamount').value)">Pay</button></center></td></tr>
              
            </table>
          </form>

				</div>
			</div><!-- .col-md-7 close -->
			<div class="col-md-5 col-sm-12">
				<div class="block">
					<img src="../images/pay.jpg" alt="Img">
				</div>
			</div><!-- .col-md-5 close -->
		</div>
	</div>
</section>


<!-- footer Start -->
<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
				<p class="copyright">Copyright 2018 &copy; Design & Developed by <a href="http://globalshining.tech">Global Shining Inc.</a>. All rights reserved.
				</p>
			</div>
		</div>
	</div>
</footer>

    <!-- 
    Essential Scripts
    =====================================-->
    
    <!-- <script src="js/jquery.counterup.js"></script> -->
    
    <!-- Main jQuery -->
   
    <script src="https://code.jquery.com/jquery-git.min.js"></script>
    <!-- Bootstrap 3.1 -->
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Owl Carousel -->
    <script src="plugins/slick-carousel/slick/slick.min.js"></script>
    <!--  -->
    <script src="plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <!-- Mixit Up JS -->
    <script src="plugins/mixitup/dist/mixitup.min.js"></script>
    <!-- <script src="plugins/count-down/jquery.lwtCountdown-1.0.js"></script> -->
    <script src="plugins/SyoTimer/build/jquery.syotimer.min.js"></script>


    <!-- Form Validator -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js"></script>


    
    <!-- Google Map -->
    <script src="plugins/google-map/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap"></script>    

    <script src="js/script.js"></script>
    



  </body>
  </html>