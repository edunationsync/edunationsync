<?php session_start();
include '../Module.php';
$school_details=School::ReadSchoolDetails();
if(!($_SESSION['lgina']=="IN"))
  header("location:../login.php");

$staff=$_SESSION['staffid'];
$currentSession=Module::ReadCurrentSession();
$session=$currentSession['session'];
$term=$currentSession['term'];

$allsessions=Module::ReadAllSessions();

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
<title>Result Portal</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Aleka Academy">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
<link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="../styles/responsive.css">


<script type="text/javascript">
    function ToggleCASheetDisplay()
    {
      var x=document.getElementById("ca_sheet_form");
      if(x.style.display==="none")
      {
        x.style.display="block";
      }
      else
        x.style.display="none";
    }

    function HideResultTools()
    {
      var x=document.getElementById("ca_sheet_form");
      if(!(x.style.display==="none"))
      {
        x.style.display="none";
      }
      else{
        x.style.display="none";
      }

      var y=document.getElementById("master_sheet_form");
      if(!(y.style.display==="none"))
      {
        y.style.display="none";
      }
      else
        y.style.display="none";

    }

    function ToggleMasterSheetDisplay()
    {
      var x=document.getElementById("master_sheet_form");
      if(x.style.display==="none")
      {
        x.style.display="block";
      }
      else
        x.style.display="none";
    }

    function loadSubjects(staff,session,term,classs)
    {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
          document.getElementById("subjectContainer").innerHTML = this.responseText;
        }
        else
        {
          document.getElementById("subjectContainer").innerHTML = "Loading...";
        }
      };
      xmlhttp.open("GET", "staffsubjectload.php?staff="+staff+"&session="+session+"&term="+term+"&classs="+classs, true);
      xmlhttp.send();
    }

    function loadSubjectsp(classs)
    {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
          document.getElementById("subjectContainerp").innerHTML = this.responseText;
        }
        else
        {
          document.getElementById("subjectContainerp").innerHTML = "Loading...";
        }
      };
      xmlhttp.open("GET", "staffsubjectloadp.php?classs="+classs, true);
      xmlhttp.send();
    }
</script>
<style type="text/css">
	input,select{
		width: 98%;
		padding: 3px 3px 3px 3px;
	}
</style>
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
                <div class="logo_text"><a href="../index.php"><img src="../images/school/logo.png" alt="<?php echo $school_details['school_keycode']; ?> School Portal" style="width: 100px"></a></div>
              </div>

              <nav class="main_nav_contaner ml-auto">
                <ul class="main_nav">
                  <li class="active"><a href="../index.php">Home</a></li>
                  <li><a href="../about.php">About</a></li>
                  <li><a href="../admission.php">Admission</a></li>
                  <li><a href="../exam.php">Exams</a></li>
                  <li><a href="../contact.php">Contact</a></li>
                  <li><a href="../portal">Check Result</a></li>
                  <li><a href="../student_almanac.php">Almanac</a></li>
                  <?php 
                  if(isset($_SESSION['lgina']))
                  {
                    ?>
                    <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="preview" role="button" area-haspopup="true" area-expanded="false"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 30px; border-radius: 100%; padding: 2px 2px 2px 2px"></a>
                            <div class="dropdown-menu" area-labelledby="Preview">
                              <a href="../dashboard/users/viewstaffprofile.php" class="dropdown-item"><i class="fa fa-user"></i> Profile</a>
                              <a href="../dashboard" class="dropdown-item">Dashboard</a>
                              <a href="../logout.php" class="dropdown-item">Logout</a>
                            </div>
                            
                          </li>
                    <?php
                  }
                  else
                  {
                    ?>
                    <li class="nav-item dropdown">
                            <a href="../login.php" class="nav-link " ><i class="fa fa-user" aria-hidden="true"></i> Login</a>
                            
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
        <li class="menu_mm"><a href="../index.php">Home</a></li>
        <li class="menu_mm"><a href="../about.php">About</a></li>
        <li class="menu_mm"><a href="../admission.php">Admission</a></li>
        <li class="menu_mm"><a href="../exam.php">Exams</a></li>
        <li class="menu_mm"><a href="../contact.php">Contact</a></li>
        <li class="menu_mm"><a href="../portal/">Result Checker</a></li>
        <?php
        if($_SESSION['lgina']=="IN")
        {
          ?>
          <li class="menu_mm"><a href="../dashboard/">Dashboard</a></li>
          <li class="menu_mm"><a href="../logout.php">Logout</a></li>
          <?php
        }
        else
        { ?>
          <li class="menu_mm"><a href="../login.php">Login</a></li>
          <?php
        }
        ?>
      </ul>
    </nav>
  </div>
	<br/><br/><br/><br/><br/>

	<!-- Features -->

	<div class="features">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<h2 class="section_title">Welcome to the Result Portal</h2>
						<div class="section_subtitle"><p>You are now in the result portal. Use the CA Sheet and the Master Sheet report to record your results as appropriate.</p></div>
					</div> 
				</div>
			</div>

			<div>
				<div class="row features_row">	
          <?php
          if((Position::IsPositionPrivilege($_SESSION['post'],"Master_sheet"))||$_SESSION['post']=="webmaster")
          {
            ?>

						<!-- Features Item -->
						<div class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img src="images/icon_2.png" alt=""></div>
								<h3 class="feature_title">1<sup>st</sup> CA Master Sheet</h3>
								<div class="feature_text"><p>Select Class and Click on Open</p></div>
								<form id='ca1_master_sheet' action="master_sheet/master_sheet_ca1.php" method="GET">
									<table>
										<tr>
											<td><label for="txtsession">Session</label></td>
											<td><select name="txtsession" id="txtsession" class="submit" required>
                        <?php 
                        foreach($allsessions as $session)
                        {
                        	?>
                        	<option><?php echo $session; ?></option>
                        	<?php
                        }

                        ?>
                      </select></td>
										</tr>
										<tr>
											<td><label for="txtterm">Term</label></td>
											<td><select name="txtterm" id="txtterm" class="submit" required>
                        <option>First</option>	                            
                        <option>Second</option>	                            
                        <option>Third</option>
                      </select></td>
										</tr>
										<tr>
											<td><label for="txtclass">Class</label></td>
											<td><select name="txtclass" id="txtclass" class="submit" required>
                        <?php
                        if((Position::IsPositionPrivilege($_SESSION['post'],"Master_sheet"))||$_SESSION['post']=="webmaster")
                        {
                          foreach(Module::ReadClasses() as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        else
                        {

                          foreach(Module::ReadStaffAllocationClassesp($staff,$session,$term) as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        ?>
                      </select></td>
										</tr>
										<tr><td colspan="2"><input type="submit" name="" value="Open"></td></tr>
									</table>
                </form>
							</div>
						</div>

						<!-- Features Item -->
						<div class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img src="images/icon_2.png" alt=""></div>
								<h3 class="feature_title">2<sup>nd</sup> CA Master Sheet</h3>
								<div class="feature_text"><p>Select Class and Click on Open</p></div>
								<form id='ca2_master_sheet' action="master_sheet/master_sheet_ca2.php" method="GET">
									<table>
										<tr>
											<td><label for="txtclass">Session</label></td>
											<td><select name="txtsession" id="txtsession" class="submit" required>
                        <?php 
                        foreach($allsessions as $session)
                        {
                        	?>
                        	<option><?php echo $session; ?></option>
                        	<?php
                        }

                        ?>
                      </select></td>
										</tr>
										<tr>
											<td><label for="txtclass">Term</label></td>
											<td><select name="txtterm" id="txtterm" class="submit" required>
		                            		                            
                        <option>First</option>	                            
                        <option>Second</option>	                            
                        <option>Third</option>
                      </select></td>
										</tr>
										<tr>
											<td><label for="txtclass">Class</label></td>
											<td><select name="txtclass" id="txtclass" class="submit" required>
                       	<?php
                        if((Position::IsPositionPrivilege($_SESSION['post'],"Master_sheet"))||$_SESSION['post']=="webmaster")
                        {
                          foreach(Module::ReadClasses() as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        else
                        {

                          foreach(Module::ReadStaffAllocationClassesp($staff,$session,$term) as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
	                ?>
                      </select></td>
										</tr>
										<tr>
											<td colspan="2"><input type="submit" name="" value="Open"></td>
										</tr>
									</table>
                </form>
							</div>
						</div>

						<!-- Features Item -->
						<div class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img src="images/icon_2.png" alt=""></div>
								<h3 class="feature_title">Exam Master Sheet</h3>
								<div class="feature_text"><p>Select Class and Click on Open</p></div>
								<form id='exam_master_sheet' action="master_sheet/master_sheet_exam.php" method="GET">
									<table>
										<tr>
											<td><label for="txtclass">Session</label></td>
											<td><select name="txtsession" id="txtsession" class="submit" required>
                      <?php 
                      foreach($allsessions as $session)
                      {
                      	?>
                      	<option><?php echo $session; ?></option>
                      	<?php
                      }

                      ?>
                    </select></td>
										</tr>
										<tr>
											<td><label for="txtclass">Term</label></td>
											<td><select name="txtterm" id="txtterm" class="submit" required>
		                            		                            
                        <option>First</option>	                            
                        <option>Second</option>	                            
                        <option>Third</option>
                      </select></td>
										</tr>
										<tr>
											<td><label for="txtclass">Class</label></td>
											<td><select name="txtclass" id="txtclass" class="submit" required>
                      <?php
                      if((Position::IsPositionPrivilege($_SESSION['post'],"Master_sheet"))||$_SESSION['post']=="webmaster")
                      {
                        foreach(Module::ReadClasses() as $class)
                        {
                          echo "<option>".$class."</option>";
                        }
                      }
                      else
                      {

                        foreach(Module::ReadStaffAllocationClassesp($staff,$session,$term) as $class)
                        {
                          echo "<option>".$class."</option>";
                        }
                      }
                ?>
                    </select></td>
										</tr>
										<tr>
											<td colspan="2"><input type="submit" name="" value="Open"></td>
										</tr>
									</table>
                </form>
							</div>
						</div>

						<!-- Features Item -->
						<div class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img src="images/icon_2.png" alt=""></div>
								<h3 class="feature_title">Master Sheet</h3>
								<div class="feature_text"><p>Select Class and Click on Open</p></div>
								<form id='master_sheet_form' action="master_sheet/master_sheetp.php" method="GET">
									<table>
										<tr>
											<td><label for="txtclass">Session</label></td>
											<td><select name="txtsession" id="txtsession" class="submit" required>
                        <?php 
                        foreach($allsessions as $session)
                        {
                        	?>
                        	<option><?php echo $session; ?></option>
                        	<?php
                        }

                        ?>
                      </select></td>
										</tr>
										<tr>
											<td><label for="txtclass">Term</label></td>
											<td><select name="txtterm" id="txtterm" class="submit" required>
		                            		                            
                        <option>First</option>	                            
                        <option>Second</option>	                            
                        <option>Third</option>
                      </select></td>
										</tr>
										<tr>
											<td><label for="txtclass">Class</label></td>
											<td><select name="txtclass" id="txtclass" class="submit" required>
                        <?php
                        if((Position::IsPositionPrivilege($_SESSION['post'],"Master_sheet"))||$_SESSION['post']=="webmaster")
                        {
                          foreach(Module::ReadClasses() as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        else
                        {

                          foreach(Module::ReadStaffAllocationClassesp($staff,$session,$term) as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
	                ?>
                      </select></td>
										</tr>
										<tr>
											<td colspan="2"><input type="submit" name="" value="Open"></td>
										</tr>
									</table>
                </form>
							</div>
						</div>
						<?php
					}
					?>

				</div>
			</div>
		</div>
	</div>
</div>


<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../styles/bootstrap4/popper.js"></script>
<script src="../styles/bootstrap4/bootstrap.min.js"></script>
<script src="../plugins/greensock/TweenMax.min.js"></script>
<script src="../plugins/greensock/TimelineMax.min.js"></script>
<script src="../plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="../plugins/greensock/animation.gsap.min.js"></script>
<script src="../plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../plugins/easing/easing.js"></script>
<script src="../plugins/parallax-js-master/parallax.min.js"></script>
<script src="../js/custom.js"></script>
</body>
</html>