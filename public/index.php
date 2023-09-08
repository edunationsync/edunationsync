<?php session_start();

include 'Module.php';
$school_details=School::ReadSchoolDetails();

$currentsession=Module::ReadCurrentSession();
$Session=$currentsession['session'];
$Term=$currentsession['term'];
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="icon" type="image/png" href="images/school/favicon.png"/>
	<title><?php echo $school_details['school_name']; ?> Website</title>
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

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <!--Tab Bootstrap-->        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="form.js"></script>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <!-- CSS | menuzord megamenu skins -->
        <link href="css/menuzord-megamenu.css" rel="stylesheet" />
        <link id="menuzord-menu-skins" href="css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet" />

        <!-- CSS | Main style file -->
        <link href="css/style-main.css" rel="stylesheet" type="text/css">

        <!-- CSS | Custom Margin Padding Collection -->
        <link href="css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">

        <!-- CSS | Responsive media queries -->
        <link href="css/responsive.css" rel="stylesheet" type="text/css">

        <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
        <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="styles/responsive.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


        <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
        <!-- <link href="/css/style.css" rel="stylesheet" type="text/css"> -->
        <!-- CSS | Theme Color -->
        <link href="css/colors/theme-skin-color-set6.css" rel="stylesheet" type="text/css">

        <!-- Revolution Slider 5.x CSS settings -->
        <link href="js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" />
        <link href="js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css" />
        <link href="js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css" />

        <!-- external javascripts -->
        <script src="js/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>


        <!-- JS | jquery plugin collection for this theme -->
        <script src="js/jquery-plugin-collection.js"></script>

        <!-- Revolution Slider 5.x SCRIPTS -->
        <script src="js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
        <script src="js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>



    <script type="text/javascript">      

        function toggleMenu(btn,menu)
        {

          if(document.getElementById(menu).style.display=='none')
          {
            document.getElementById(menu).style.display='block';
            document.getElementById(btn).innerHTML='Hide '+document.getElementById(btn).title+' Best Students';   
          }
          else
          {          
            document.getElementById(menu).style.display='none';
            document.getElementById(btn).innerHTML='Show '+document.getElementById(btn).title+' Best Students';   
          }
        }
    </script>
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
						<div class="header_content d-flex flex-row align-items-center justify-content-start" style="background: white">
							<div class="logo_container">
								<div class="logo_text"><a href="index.php"><img src="images/school/logo.png" alt="<?php echo $school_details['school_keycode'];?> School Portal" style="width: 100px"></a></div>
							</div>

							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
									<li class="active"><a href="index.php">Home</a></li>
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
		<div class="home_slider_container">
			
			<!-- Home Slider -->
			<div class="owl-carousel owl-theme home_slider">
				
				<?php
				$filesss=School::ReadSlideGraphics("images/slideimages/");

				foreach($filesss as $Dir)
				{
					?>
					<!-- Home Slider Item -->
					<div class="owl-item">
						<div class="home_slider_background" style="background-image:url(images/slideimages/<?php echo $Dir ?>)"></div>
						<div class="home_slider_content">
							
						</div>
					</div>

					<?php
				}
				?>

			</div>
		</div>

		<!-- Home Slider Nav -->

		<div class="home_slider_nav home_slider_prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
		<div class="home_slider_nav home_slider_next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
	</div>

	<!-- Features -->
	<br/><br/>
	


	<!-- Team -->

	<div class="team">
		<div class="team_background parallax-window" data-parallax="scroll" data-image-src="images/team_background.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<h2 class="section_title">Management Team</h2>
						<!--<div class="section_subtitle"><p>The staff responsible for the effective and efficient compilation of result are as follows:</p></div>-->
					</div>
				</div>
			</div>
			<div class="row team_row">
				
				<!-- Team Item -->
				<div class="col-lg-3 col-md-6 team_col">
					<div class="team_item">
						<div class="team_image"><img src="images/school/owner_passport.png" alt=""></div>
						<div class="team_body">
							<div class="team_title"><a href="#"><?php echo $school_details['school_owner']; ?></a></div>
							<div class="team_subtitle">The Admin</div>
							<div class="social_list">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="<?php echo $school_details['school_google_plus'];?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!-- Team Item -->
				<div class="col-lg-3 col-md-6 team_col">
					<div class="team_item">
						<div class="team_image"><img src="images/school/head_passport.png" alt=""></div>
						<div class="team_body">
							<div class="team_title"><a href="#"><?php echo $school_details['school_head']; ?></a></div>
							<div class="team_subtitle">The School Head</div>
							<div class="social_list">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!-- Team Item -->
				<div class="col-lg-3 col-md-6 team_col">
					<div class="team_item">
						<div class="team_image"><img src="images/school/exam_officer_passport.png" alt=""></div>
						<div class="team_body">
							<div class="team_title"><a href="#"><?php echo $school_details['school_exam_officer']; ?></a></div>
							<div class="team_subtitle">Exams and Records</div>
							<div class="social_list">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="<?php echo $school_details['school_google_plus'];?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!-- Team Item -->
				<div class="col-lg-3 col-md-6 team_col">
					<div class="team_item">
						<div class="team_image"><img src="images/school/burser_passport.png" alt=""></div>
						<div class="team_body">
							<div class="team_title"><a href="#"><?php echo $school_details['school_burser']; ?></a></div>
							<div class="team_subtitle">Burser</div>
							<div class="social_list">
								<ul>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="<?php echo $school_details['school_google_plus'];?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
								</ul>
							</div>
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
										<p><?php echo $school_details['school_motto'];?></p>
										<p>...global technologies!</p>
									</div>
									<div class="footer_social">
										<ul>
											<li><a href="<?php echo $school_details['school_facebook'];?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li><a href="<?php echo $school_details['school_google_plus'];?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
											<!--<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>-->
											<li><a href="<?php echo $school_details['school_tweeter'];?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
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
											<li><?php echo $school_details['school_address'];?></li>
										</ul>
									</div>
								</div>
								
							</div>

							<div class="col-lg-3 footer_col">
					
								<!-- Footer links -->
								<div class="footer_section footer_links">
									<div class="footer_title">Links</div>
									<div class="footer_links_container">
										<ul>
											<li><a href="index.php">Home</a></li>
											<!-- <li><a href="about.php">About</a></li>
											<li><a href="contact.php">Contact</a></li> -->
										</ul>
									</div>
								</div>
								
							</div>

							<div class="col-lg-3 footer_col">
					
								<!-- Footer links -->
								<div class="footer_section footer_links">
									<div class="footer_title">Quick Navigator</div>
									<div class="footer_links_container">
										<ul>
											<li><a href="index.php">School Website</a></li>
											<!-- <li><a href="about.php">School Portal</a></li>
											<li><a href="contact.php">Admission Portal</a></li> -->
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

<?php
$school_details=School::ReadSchoolDetails();
$d_e_d=School::DomainExpiryDay($school_details['domain_due_date']);
$h_e_d=School::HostingExpiryDay($school_details['hosting_due_date']);


$ded=$d_e_d['day_diff'];
$hed=$h_e_d['day_diff'];

if(($ded<=(-30))||($hed<=(-30))&&(!$_SESSION['post']=="webmaster"))
{
  ?>
  <!-- Start main-content -->
    <div class="main-content">
        <!-- Notice modal -->
        <div class="modal fade  in" id="noticeModal" tabindex="-1" role="dialog" style="display: block; padding-right: 16px">
            <div class="modal-dialog " style=" background: white; padding: 30px">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button><h3 class="panel-title">IMPORTANT NOTICE</h3>
                    </div>

                    <div class="panel-body">
                      <h1>Server Error</h1>
                        <ul class="list theme-colored2 angle-double-right" style="color: red; font-weight: bold">
                            <li>
                                <strong>
                                    Hosting Notification
                                </strong><br>
                                The Last Hosting Subscription was made on <?php echo $school_details['hosting_sub_date'];?>. The Due date for the next hosting is <?php echo $school_details['hosting_due_date'];?>.
                            </li>
                            <li>
                                <strong>
                                    Domain Name Notification
                                </strong><br>
                                The Last Domain Name Subscription was made on <?php echo $school_details['domain_sub_date'];?>. The Due date for the next domain is <?php echo $school_details['domain_due_date'];?>.
                            </li>
                            <li>
                                <strong>
                                    Update any of the subscription(s) that is/are due to avoid loss of data on your server and to avoid inconveniences.
                                </strong>
                            </li>
                        </ul>
                        <h1 style="color: green">Current Date: <br/><?php echo date('Y-m-d'); ?></h1>

                        <?php $hostingexpiryday=School::HostingExpiryDay($school_details['hosting_due_date']) ?>
                        <h2>Current Hosting will expire duly</h2>
                        <h1 style="color: green">Expiry Date: <br/><?php echo $school_details['hosting_due_date']; ?></h1>
                        <h1 style="color: green">Day Diff: <br/><?php 
                        if($hostingexpiryday['day_diff']<0)
                        {
                          echo "last ".$hostingexpiryday['day_diff']." day(s)";
                        }
                        elseif($hostingexpiryday['day_diff']==0)
                        {
                          echo "Today";
                        }
                        else{
                          echo $hostingexpiryday['day_diff'];
                        } ?></h1>

                        <?php $domainexpiryday=School::DomainExpiryDay($school_details['domain_due_date']) ?>
                        <h2>Current Domain Name will expire duly</h2>
                        <h1 style="color: green">Expiry Date: <br/><?php echo $school_details['domain_due_date']; ?></h1>
                        <h1 style="color: green">Day Diff: <br/><?php 
                        if($domainexpiryday['day_diff']<0)
                        {
                          echo "last ".$domainexpiryday['day_diff']." day(s)";
                        }
                        elseif($domainexpiryday['day_diff']==0)
                        {
                          echo "Today";
                        }
                        else{
                          echo $domainexpiryday['day_diff'];
                        } 
                        ?>

                        <h4>Contact the webmaster as soon as possible for support to avoid loss of data</h4>
                      

                        <div class="modal-footer" style="border-top: 0px;">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#noticeModal').modal('toggle')
            });
        </script>
    </div>

  <?php
}

?>


    
</div>



<script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
</script>

<script src="js/bootstrap.min.js"></script>

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

<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="js/custom1.js"></script>
</body>
</html>