<?php session_start();

include 'Module.php';
$school_details=School::ReadSchoolDetails();


?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="icon" type="image/png" href="images/school/favicon.png"/>
<title>About <?php echo $school_details['school_name'];?> </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Unicat project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/about.css">
<link rel="stylesheet" type="text/css" href="styles/about_responsive.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</head>
<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar" style="background: <?php echo $school_details['top_header_color'];?>">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<ul class="top_bar_contact_list">
									<li><div class="question">Have any questions?</div></li>
									<li>
										<i class="fa fa-phone" aria-hidden="true"></i>
										<div><?php echo $school_details['school_phone'];?></div>
									</li>
									<li>
										<i class="fa fa-envelope-o" aria-hidden="true"></i>
										<div><?php echo $school_details['school_email'];?></div>
									</li>
								</ul>
								
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>

		<!-- Header Content -->
		<div class="header_container" style="background: <?php echo $school_details['header_color'];?>">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start"  style="background: white">
							<div class="logo_container">
								<div class="logo_text"><a href="index.php"><img src="images/school/logo.png" alt="<?php echo $school_details['school_keycode'];?> School Portal" style="width: 100px"></a></div>
							</div>
							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
									<li><a href="index.php">Home</a></li>
									<li class="active"><a href="about.php">About</a></li>
									<li><a href="admission.php">Admission</a></li>
									<li><a href="exam.php">Exams</a></li>
									<li><a href="contact.php">Contact</a></li>
									
									<li><a href="portal">Check Result</a></li>
									<li><a href="student_almanac.php">Almanac</a></li>
									<li class="nav-item dropdown">
						            <a href="tools">Tools</a>
						            </li>
									<?php 
									if(isset($_SESSION['lgina']))
									{?>
										<li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="preview" role="button" area-haspopup="true" area-expanded="false">
							               <?php
								               if(isset($_SESSION['passport']))
								               {
								               	?>
								               	<img src="<?php  echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 30px; border-radius: 100%; padding: 2px 2px 2px 2px">
								               	<?php
								               }
								               else
								               {
								               	?><i class="fa fa-user" aria-hidden="true"></i>
								               	<?php
								               }
								               ?></a>
							              <div class="dropdown-menu" area-labelledby="Preview">
							                <a href="dashboard/users/" class="dropdown-item"><i class="fa fa-user"></i> Profile</a>
							                <a href="dashboard" class="dropdown-item">Dashboard</a>
							                <a href="logout.php" class="dropdown-item">Logout</a>
							              </div>
							              
							            </li>
										<?php
									}
									else
									{
										?>
										<li class="nav-item dropdown">
							              <a href="login.php" class="nav-link " ><i class="fa fa-user" aria-hidden="true"></i></a>
							              
							            </li>
										<?php
									}
									?>
								</ul>

								<!-- Hamburger -->

								
								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</nav>

						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Header Search Panel -->
		<div class="header_search_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_search_content d-flex flex-row align-items-center justify-content-end">
							<form action="#" class="header_search_form">
								<input type="search" class="search_input" placeholder="Search" required="required">
								<button class="header_search_button d-flex flex-column align-items-center justify-content-center">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>			
		</div>			
	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="search">
			<form action="#" class="header_search_form menu_mm">
				<input type="search" class="search_input menu_mm" placeholder="Search" required="required">
				<button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
					<i class="fa fa-search menu_mm" aria-hidden="true"></i>
				</button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="index.php">Home</a></li>
				<li class="menu_mm"><a href="about.php">About</a></li>
				<li class="menu_mm"><a href="admission.php">Admission</a></li>
				<li class="menu_mm"><a href="exam.php">Exams</a></li>
				<li class="menu_mm"><a href="contact.php">Contact</a></li>
				
				<li class="menu_mm"><a href="portal/">Result Checker</a></li>
				<li class="menu_mm"><a href="student_almanac.php">Almanac</a></li>
				<?php
				if(($_SESSION['post']=="Principal")||($_SESSION['post']=="Webmaster")||($_SESSION['post']=="Proprietor")||($_SESSION['post']=="Headmaster")||($_SESSION['post']=="Headmistress"))
				{
					if($_SESSION['lgina']=="IN")
					{
						?>
						<li class="menu_mm"><a href="admin/">Admin</a></li>
						<?php
					}
				}

				if($_SESSION['lgina']=="IN")
				{
					?>
					<li class="menu_mm"><a href="result/">Results</a></li>
					<li class="menu_mm"><a href="logout.php">Logout</a></li>
					<?php
				}
				else
				{ ?>
					<li class="menu_mm"><a href="login.php">Login</a></li>
					<?php
				}
				?>
			</ul>
		</nav>
	</div>	
	</header>

	
	<!-- Home -->

	<div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li>About</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

	<!-- About -->

	<div style="padding: 10px 10px 10px 10px">
	  <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
	    <li class="nav-item">
	      <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md"
	        aria-selected="true">Brief History</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md"
	        aria-selected="false">Mission</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md"
	        aria-selected="false">Vission</a>
	    </li>
	  </ul>
	  <div class="tab-content card pt-5" id="myTabContentMD" style="padding: 1% 1% 1% 1% ;">
	    <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
	      <h4>Brief History of Result System</h4>
	      <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua,
	        retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica.
	        Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry
	        richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american
	        apparel, butcher voluptate nisi qui.</p>
	    </div>
	    <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
	    	<h4>Mission of Result System</h4>
	      <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.
	        Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko
	        farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip
	        jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna
	        delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan
	        fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry
	        richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus
	        tattooed echo park.</p>
	    </div>
	    <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">
	    	<h4>Vission of Result System</h4>
	      <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo
	        retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer,
	        iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
	        Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles
	        pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of
	        them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
	    </div>
	  </div>
	</div>
	<br/><br/><br/>

	<!-- Footer -->
	<footer class="footer">
		<div class="footer_background" style="background-image:url(images/footer_background.png)"></div>
		<div class="container">
			<div class="row footer_row">
				<div class="col">
					<div class="footer_content">
						<div class="row">

							<div class="col-lg-3 footer_col">
					
								<!-- Footer About -->
								<div class="footer_section footer_about">
									<div class="footer_logo_container">
										<div class="logo_container">
								<div class="logo_text"><a href="../index.php"><img src="../img/core-img/logo1.png" alt=""></a></div>
							</div>
									</div>
									<div class="footer_about_text">
										<p>The best school for your children. Have fun with us through our social media forums.</p>
									</div>
									<div class="footer_social">
										<ul>
											<li><a href="http://facebook.com/tis"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li><a href="<?php echo $school_details['school_google_plus'];?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
											<!--<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->
											<li><a href="http://twitter.com/tis"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										</ul>
									</div>
								</div>
								
							</div>

							<div class="col-lg-3 footer_col">
					
								<!-- Footer Contact -->
								<div class="footer_section footer_contact">
									<div class="footer_title">Contact Us</div>
									<div class="footer_contact_info">
										<ul>
											<li>Email: <?php echo $school_details['school_email'];?></li>
											<li>Phone:  <?php echo $school_details['school_phone'];?></li>
											<li>Ejegbo Road, Beside Dubai Care School, Ankpa, Kogi State, Nigeria</li>
										</ul>
									</div>
								</div>
								
							</div>

							<div class="col-lg-3 footer_col">
					
								<!-- Footer links -->
								<div class="footer_section footer_links">
									<div class="footer_title">Contact Us</div>
									<div class="footer_links_container">
										<ul>
											<li><a href="index.php">Home</a></li>
											<li><a href="about.php">About</a></li>
											<li><a href="contact.php">Contact</a></li>
											<li><a href="#">Exams</a></li>
											<li><a href="admission.php">Admission</a></li>
											<li><a href="#">Results</a></li>
											<li><a href="#">Jet Club</a></li>
											<li><a href="#">Press Club</a></li>
										</ul>
									</div>
								</div>
								
							</div>

							<div class="col-lg-3 footer_col clearfix">
					
								<!-- Footer links -->
								<div class="footer_section footer_links">
									<div class="footer_title">Multimedia</div>
									<div class="footer_links_container">
										<ul>
											<li><a href="gallery.html">Gallery</a></li>
										</ul>
									</div>
								</div>
								
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="row copyright_row">
				<div class="col">
					<div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
						<div class="cr_text">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved Developed by <a href="https://gsdw.org.ng" target="_blank">Global Shining</a></div>
						<!--
						<div class="ml-lg-auto cr_links">
							<ul class="cr_list">
								<li><a href="#">Copyright notification</a></li>
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>-->
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>