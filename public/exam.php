<?php session_start();

include 'Module.php';
$school_details=School::ReadSchoolDetails();


?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="icon" type="image/png" href="images/school/favicon.png"/>
<title><?php echo $school_details['school_name'];?>  Examinations</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Dubai Care School">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
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
									<li><a href="about.php">About</a></li>
									<li><a href="admission.php">Admission</a></li>
									<li class="active"><a href="exam.php">Exams</a></li>
									<li><a href="contact.php">Contact</a></li>
									
									<li><a href="portal">Check Result</a></li>
									<li><a href="student_almanac.php">Almanac</a></li>
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
							              <a href="login.php" class="nav-link " ><i class="fa fa-user" aria-hidden="true"></i> Login</a>
							              
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
	
	<!-- Home -->

	<div class="home">
		<div class="home_slider_container">
			
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">
				
				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/home_slider_1.png)"></div>
					<div class="home_slider_content">
						
					</div>
				</div>


				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/home_slider_2.png)"></div>
					<div class="home_slider_content">
						
					</div>
				</div>


				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/home_slider_3.png)"></div>
					<div class="home_slider_content">
						
					</div>
				</div>


				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/home_slider_4.png)"></div>
					<div class="home_slider_content">
						
					</div>
				</div>


				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/home_slider_5.png)"></div>
					<div class="home_slider_content">
						
					</div>
				</div>


				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url(images/home_slider_7.png)"></div>
					<div class="home_slider_content">
						
					</div>
				</div>

			</div>
		</div>

		<!-- Home Slider Nav -->

		<div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
		<div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
	</div>

	<!-- Features -->



	<div style="padding: 10px 10px 10px 10px; margin: 10px 10px 100px 10px">
	  <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
	    <li class="nav-item">
	      <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md"
	        aria-selected="true">Examination Requirements</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" id="profile-tab-md" data-toggle="tab" href="#profile-md" role="tab" aria-controls="profile-md"
	        aria-selected="false">Examination Rules and Regulations</a>
	    </li>
	    <li class="nav-item">
	      <a class="nav-link" id="contact-tab-md" data-toggle="tab" href="#contact-md" role="tab" aria-controls="contact-md"
	        aria-selected="false">Punishment for Malpractice</a>
	    </li>
	  </ul>
	  <div class="tab-content card pt-5" id="myTabContentMD" style="padding: 1% 1% 1% 1% ;">
	    <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
	      <h4>Examination Requirements</h4>
	      <p>It is not possible for a student to write an examination without the requirements in the like manner that a farmer cannot farm without the farming requirements. Hence, the examinatino requirements in this school are itemized thus.
	      <ol>
	      	<li>Evidence of payment</li>
	      	<li>Writing Materials</li>
	      	<li>...</li>
	      	<li>to the last one</li>
	      </ol> </p>
	    </div>
	    <div class="tab-pane fade" id="profile-md" role="tabpanel" aria-labelledby="profile-tab-md">
	    	<h4>Rules and Regulations</h4>
	      <p>The rules and regulations governing examination in this school includes
		      <ol>
		      	<li>Evidence of payment</li>
		      	<li>Writing Materials</li>
		      	<li>...</li>
		      	<li>to the last one</li>
		      </ol>
		  </p>
	    </div>
	    <div class="tab-pane fade" id="contact-md" role="tabpanel" aria-labelledby="contact-tab-md">
	    	<h4>Punishment for Malpractice</h4>
	      <p>Evry offense has its allocated punishment. The punishment for examination malpractice in this school includes.
	      <ol>
	      	<li>The punishment for the use of materials in the examination is suspension.</li>
	      	<li>The punishment for looking at another person's work is forcing to submit</li>
	      	<li>...</li>
	      	<li>to the last one</li>
	      </ol></p>
	    </div>
	  </div>
	</div>


	

	<!-- Latest News 

	<div class="news">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<h2 class="section_title">Latest News</h2>
						<div class="section_subtitle"><p>You may not just need to be coming to school to verify somethings, below are our latest news</p></div>
					</div>
				</div>
			</div>
			<div class="row news_row">
				<div class="col-lg-7 news_col">-->
					
					<!-- News Post Large 
					<div class="news_post_large_container">
						<div class="news_post_large">
							<div class="news_post_image"><img src="images/news_1.jpg" alt=""></div>
							<div class="news_post_large_title"><a href="blog_single.php">Here’s What You Need to Know About Online Testing for the ACT and SAT</a></div>
							<div class="news_post_meta">
								<ul>
									<li><a href="#">admin</a></li>
									<li><a href="#">november 11, 2017</a></li>
								</ul>
							</div>
							<div class="news_post_text">
								<p>Policy analysts generally agree on a need for reform, but not on which path policymakers should take. Can America learn anything from other nations...</p>
							</div>
							<div class="news_post_link"><a href="blog_single.php">read more</a></div>
						</div>
					</div>
				</div>

				<div class="col-lg-5 news_col">
					<div class="news_posts_small">-->

						<!-- News Posts Small 
						<div class="news_post_small">
							<div class="news_post_small_title"><a href="blog_single.php">Home-based business insurance issue (Spring 2017 - 2018)</a></div>
							<div class="news_post_meta">
								<ul>
									<li><a href="#">admin</a></li>
									<li><a href="#">november 11, 2017</a></li>
								</ul>
							</div>
						</div>-->

						<!-- News Posts Small 
						<div class="news_post_small">
							<div class="news_post_small_title"><a href="blog_single.php">2018 Fall Issue: Credit Card Comparison Site Survey (Summer 2018)</a></div>
							<div class="news_post_meta">
								<ul>
									<li><a href="#">admin</a></li>
									<li><a href="#">november 11, 2017</a></li>
								</ul>
							</div>
						</div>-->

						<!-- News Posts Small 
						<div class="news_post_small">
							<div class="news_post_small_title"><a href="blog_single.php">Cuentas de cheques gratuitas una encuesta de Consumer Action</a></div>
							<div class="news_post_meta">
								<ul>
									<li><a href="#">admin</a></li>
									<li><a href="#">november 11, 2017</a></li>
								</ul>
							</div>
						</div>-->

						<!-- News Posts Small 
						<div class="news_post_small">
							<div class="news_post_small_title"><a href="blog_single.php">Troubled borrowers have fewer repayment or forgiveness options</a></div>
							<div class="news_post_meta">
								<ul>
									<li><a href="#">admin</a></li>
									<li><a href="#">november 11, 2017</a></li>
								</ul>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>-->

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="newsletter_background parallax-window" data-parallax="scroll" data-image-src="images/newsletter.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-center justify-content-start">

						<!-- Newsletter Content -->
						<div class="newsletter_content text-lg-left text-center">
							<div class="newsletter_title">want to get email notification</div>
							<div class="newsletter_subtitle">Subcribe to our email notification option</div>
						</div>

						<!-- Newsletter Form -->
						<div class="newsletter_form_container ml-lg-auto">
							<form action="#" id="newsletter_form" class="newsletter_form d-flex flex-row align-items-center justify-content-center">
								<input type="email" class="newsletter_input" placeholder="Your Email" required="required">
								<button type="submit" class="newsletter_button">subscribe</button>
							</form>
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