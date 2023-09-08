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
<title><?php echo $school_details['school_name'];?> Best Students</title>
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
						<div class="header_content d-flex flex-row align-items-center justify-content-start"  style="background: white">
							<div class="logo_container">
								<div class="logo_text"><a href="index.php"><img src="images/school/logo.png" alt="<?php echo $school_details['school_keycode'];?> School Portal" style="width: 100px"></a></div>
							</div>

							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">
									<li class="active"><a href="index.php">Home</a></li>
									<li><a href="about.php">About</a></li>
									<li><a href="admission.php">Admission</a></li>
									<li><a href="exam.php">Exams</a></li>
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
										<li class="nav-item dropdown">

							            <a href="tools">Tools</a>
							            </li>
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
				<li class="menu_mm"><a href="about.php">About</a></li>
				<li class="menu_mm"><a href="admission.php">Admission</a></li>
				<li class="menu_mm"><a href="exam.php">Exams</a></li>
				<li class="menu_mm"><a href="contact.php">Contact</a></li>
				
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
	<div class="container-fluid" style="margin-top: 200px">
			<ul class="nav nav-tabs">
				<li><a href="#ca1" data-toggle="tab">CA1 Best</a></li>
				<li><a href="#ca2" data-toggle="tab">CA2 Best</a></li>
				<li><a href="#exam" data-toggle="tab">Exam Best</a></li>
				<li><a href="#overall" data-toggle="tab">Overall Best</a></li>
			</ul>

			<div class="tab-content">
				<div id="ca1" class="tab-pane fade">
					<div class="row">
						<div class="col">
							<div class="section_title_container text-center">
								<h2 class="section_title">Best Students in the 1<sup>st</sup> CA for <?php echo $Term." Term ".$Session ?></h2>
							</div>
						</div>
					</div>
					<div class="row team_row">

		            <?php
		            $count=0;
		            $classes=Module::ReadClasses();
		            foreach($classes as $class)
		            {
		            	$Position=0;


						//CA 1
						$ca1_Analysis=Module::ReadCA1Analysis($Session,$Term,$class);
						if(is_array($ca1_Analysis))
						{
							rsort($ca1_Analysis); 
						}

						//Arrange unique array elements to use for position
						$Poss=array();
						foreach($ca1_Analysis as $caScore)
						{
							if(!(in_array($caScore, $Poss)))
							{
								array_push($Poss, $caScore);
							}
						}

						foreach($Poss as $caScore)
						{
						$Position++;

						if($Position==1)
						{
							if($caScore>0)
							{
								$stnts=Module::ReadTotalCA1Students($Session,$Term,$class,$caScore);
								foreach($stnts as $std)
								{
									$details=Module::ReadStudentDetailsp($std);
									?>
									<!-- Team Item -->
									<div class="col-lg-3 col-md-6 team_col">
										<div class="team_item">
											<div class="team_image"><img src="<?php echo 'data:image/jpeg;base64,'.$details['passport'];?>" style="height: 150px; border-radius: 10px; padding: 2px 2px 2px 2px"></div>
											<div class="team_body">
												<div class="team_title" style="font-size: 16px"><b><?php echo strtoupper($details['names']); ?></b></div>
												<div class="team_subtitle"><?php echo strtoupper($class); ?></div>
												<div  style="background: green; color: white; padding:2px 2px 2px 2px">Score = <?php echo $caScore; ?></div>
											</div>
										</div>
									</div>
									<!--
									<tr/><td><?php echo $std; ?></td><td><?php echo strtoupper($details['names']); ?></td><td><?php echo $caScore; ?></td><td><?php  echo  round(($caScore/Module::CountSubjectsp($class)),2); ?></td><td><?php echo $Position; ?></td></tr>-->
									<?php
								}
							}
							else
							{
								//Show that Result not yet entered

							}
						}

						$bracketCount=count(array_keys($ca1_Analysis,$caScore));
						$Position=$Position+$bracketCount;
						$Position=$Position-1;
						}
		            }
		            ?>



						<!-- Team Item -->
						<div class="col-lg-3 col-md-6 team_col">
							<div class="team_item">
								<div class="team_image"></div>
								<div class="team_body">
								</div>
							</div>
						</div>

						<!-- Team Item -->
						<div class="col-lg-3 col-md-6 team_col">
							<div class="team_item">
								<div class="team_image"></div>
								<div class="team_body">
								</div>
							</div>
						</div>

					</div>
				</div>

				<div id="ca2" class="tab-pane fade">
						<div class="row">
							<div class="col">
								<div class="section_title_container text-center">
									<h2 class="section_title">Best Students in the 2<sup>nd</sup> CA for <?php echo $Term." Term ".$Session ?></h2>
								</div>
							</div>
						</div>
						<div class="row team_row">

			            <?php
			            $count=0;
			            $classes=Module::ReadClasses();
			            foreach($classes as $class)
			            {
			            	$Position=0;


							//CA 1
							$ca2_Analysis=Module::ReadCA2Analysis($Session,$Term,$class);
							if(is_array($ca2_Analysis))
							{
								rsort($ca2_Analysis); 
							}

							//Arrange unique array elements to use for position
							$Poss=array();
							foreach($ca2_Analysis as $caScore)
							{
								if(!(in_array($caScore, $Poss)))
								{
									array_push($Poss, $caScore);
								}
							}

							foreach($Poss as $caScore)
							{
							$Position++;

							if($Position==1)
							{
								if($caScore>0)
								{
									$stnts=Module::ReadTotalCA2Students($Session,$Term,$class,$caScore);
									foreach($stnts as $std)
									{
										$details=Module::ReadStudentDetailsp($std);
										?>
										<!-- Team Item -->
										<div class="col-lg-3 col-md-6 team_col">
											<div class="team_item">
												<div class="team_image"><img src="<?php echo 'data:image/jpeg;base64,'.$details['passport'];?>" style="height: 150px; border-radius: 10px; padding: 2px 2px 2px 2px"></div>
												<div class="team_body">
													<div class="team_title" style="font-size: 16px"><b><?php echo strtoupper($details['names']); ?></b></div>
													<div class="team_subtitle"><?php echo strtoupper($class); ?></div>
													<div  style="background: green; color: white; padding:2px 2px 2px 2px">Score = <?php echo $caScore; ?></div>
												</div>
											</div>
										</div>
										<?php
									}
								}
								else
								{
									//Show that Result not yet entered

								}
							}

							$bracketCount=count(array_keys($ca2_Analysis,$caScore));
							$Position=$Position+$bracketCount;
							$Position=$Position-1;
							}
			            }
			            ?>



							<!-- Team Item -->
							<div class="col-lg-3 col-md-6 team_col">
								<div class="team_item">
									<div class="team_image"></div>
									<div class="team_body">
									</div>
								</div>
							</div>

							<!-- Team Item -->
							<div class="col-lg-3 col-md-6 team_col">
								<div class="team_item">
									<div class="team_image"></div>
									<div class="team_body">
									</div>
								</div>
							</div>

						</div>
				</div>
				
				<div id="exam" class="tab-pane fade">
						<div class="row">
							<div class="col">
								<div class="section_title_container text-center">
									<h2 class="section_title">Best Students in the Exam for <?php echo $Term." Term ".$Session ?></h2>
								</div>
							</div>
						</div>
						<div class="row team_row">

			            <?php
			            $count=0;
			            $classes=Module::ReadClasses();
			            foreach($classes as $class)
			            {
			            	$Position=0;


							//CA 1
							$exam_Analysis=Module::ReadExamAnalysis($Session,$Term,$class);
							if(is_array($exam_Analysis))
							{
								rsort($exam_Analysis); 
							}

							//Arrange unique array elements to use for position
							$Poss=array();
							foreach($exam_Analysis as $caScore)
							{
								if(!(in_array($caScore, $Poss)))
								{
									array_push($Poss, $caScore);
								}
							}

							foreach($Poss as $caScore)
							{
							$Position++;

							if($Position==1)
							{
								if($caScore>0)
								{
									$stnts=Module::ReadTotalExamStudents($Session,$Term,$class,$caScore);
									foreach($stnts as $std)
									{
										$details=Module::ReadStudentDetailsp($std);
										?>
										<!-- Team Item -->
										<div class="col-lg-3 col-md-6 team_col">
											<div class="team_item">
												<div class="team_image"><img src="<?php echo 'data:image/jpeg;base64,'.$details['passport'];?>" style="height: 150px; border-radius: 10px; padding: 2px 2px 2px 2px"></div>
												<div class="team_body">
													<div class="team_title" style="font-size: 16px"><b><?php echo strtoupper($details['names']); ?></b></div>
													<div class="team_subtitle"><?php echo strtoupper($class); ?></div>
													<div  style="background: green; color: white; padding:2px 2px 2px 2px">Score = <?php echo $caScore; ?></div>
												</div>
											</div>
										</div>
										<?php
									}
								}
								else
								{
									//Show that Result not yet entered

								}
							}

							$bracketCount=count(array_keys($exam_Analysis,$caScore));
							$Position=$Position+$bracketCount;
							$Position=$Position-1;
							}
			            }
			            ?>



							<!-- Team Item -->
							<div class="col-lg-3 col-md-6 team_col">
								<div class="team_item">
									<div class="team_image"></div>
									<div class="team_body">
									</div>
								</div>
							</div>

							<!-- Team Item -->
							<div class="col-lg-3 col-md-6 team_col">
								<div class="team_item">
									<div class="team_image"></div>
									<div class="team_body">
									</div>
								</div>
							</div>

						</div>
				</div>

				<div id="overall" class="tab-pane fade in active">
						<div class="row">
							<div class="col">
								<div class="section_title_container text-center">
									<h2 class="section_title">Best Students in the Overall Assessment for <?php echo $Term." Term ".$Session ?></h2>
								</div>
							</div>
						</div>
						<div class="row team_row">

			            <?php
			            $count=0;
			            $classes=Module::ReadClasses();
			            foreach($classes as $class)
			            {
			            	$Position=0;


							//CA 1
							$overall_Analysis=Module::ReadOverallAnalysis($Session,$Term,$class);
							if(is_array($overall_Analysis))
							{
								rsort($overall_Analysis); 
							}

							//Arrange unique array elements to use for position
							$Poss=array();
							foreach($overall_Analysis as $caScore)
							{
								if(!(in_array($caScore, $Poss)))
								{
									array_push($Poss, $caScore);
								}
							}

							foreach($Poss as $caScore)
							{
							$Position++;

							if($Position==1)
							{
								if($caScore>0)
								{
									$stnts=Module::ReadTotalOverallStudents($Session,$Term,$class,$caScore);
									foreach($stnts as $std)
									{
										$details=Module::ReadStudentDetailsp($std);
										?>
										<!-- Team Item -->
										<div class="col-lg-3 col-md-6 team_col">
											<div class="team_item">
												<div class="team_image"><img src="<?php echo 'data:image/jpeg;base64,'.$details['passport'];?>" style="height: 150px; border-radius: 10px; padding: 2px 2px 2px 2px"></div>
												<div class="team_body">
													<div class="team_title" style="font-size: 16px"><b><?php echo strtoupper($details['names']); ?></b></div>
													<div class="team_subtitle"><?php echo strtoupper($class); ?></div>
													<div  style="background: green; color: white; padding:2px 2px 2px 2px">Score = <?php echo $caScore; ?></div>
												</div>
											</div>
										</div>
										<?php
									}
								}
								else
								{
									//Show that Result not yet entered

								}
							}

							$bracketCount=count(array_keys($overall_Analysis,$caScore));
							$Position=$Position+$bracketCount;
							$Position=$Position-1;
							}
			            }
			            ?>



							<!-- Team Item -->
							<div class="col-lg-3 col-md-6 team_col">
								<div class="team_item">
									<div class="team_image"></div>
									<div class="team_body">
									</div>
								</div>
							</div>

							<!-- Team Item -->
							<div class="col-lg-3 col-md-6 team_col">
								<div class="team_item">
									<div class="team_image"></div>
									<div class="team_body">
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
											<li><a href="about.php">About</a></li>
											<li><a href="contact.php">Contact</a></li>
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
											<li><a href="about.php">School Portal</a></li>
											<li><a href="contact.php">Admission Portal</a></li>
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved Developed by <a href="https://gsdw.org.ng" target="_blank">GSDW</a></div>
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