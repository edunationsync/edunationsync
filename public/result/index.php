<?php session_start();
include '../Module.php';
$school_details=School::ReadSchoolDetails();
if(!($_SESSION['lgina']=="IN"))
  header("location:../login.php");


$staff=$_SESSION['staffid'];
$currentSession=Module::ReadCurrentSession();
$session=$currentSession['session'];
$term=$currentSession['term'];


?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
	<title>Result Dashboard</title>
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

	<style type="text/css">
	  .feature_col{
	    background: lightgreen;
	    border-radius: 100%;
	  }
	  
	  .feature_icon img{
	    border-radius: 100%;
	  }
	</style>
	<script type="text/javascript">

      function loadSubjectItems(classs)
      {
      	/*
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("txtsubjectp").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("txtsubjectp").innerHTML = "Loading...";
          }
        };
        xmlhttp.open("GET", "loadsubjectitems.php?classs="+classs, true);
        xmlhttp.send();
        */
      }
      function loadsubjectitems(classs)
      {
      	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("txtsubjectp").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("txtsubjectp").innerHTML = "Loading...";
          }
        };
        xmlhttp.open("GET", "loadsubjectitems.php?classs="+classs, true);
        xmlhttp.send();
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
          if((Position::IsPositionPrivilege($_SESSION['post'],"Ca_sheet_explorer"))||$_SESSION['post']=="webmaster")
          {
            ?>
						<!-- Features Item -->
						<div id="Ca_sheet_explorer" class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img width="200px" src="../images/icons/ca_sheet.jpg" alt="Open CA Sheet"></div>
								<h3 class="feature_title">CA Sheet Explorer</h3>

								<form id='ca_sheet_form1'  action="ca_sheet" method="GET">
                  <input type="hidden" name="txtsessionp" id="txtsessionp" value="<?php echo $session; ?>">
                  <input type="hidden" name="txttermp" id="txttermp" value="<?php echo $term; ?>">
                  <label for="txtclassp">Class</label>
                  <div class="form-label-group">
                  <select  name="txtclassp" id="txtclassp" onclick="loadsubjectitems(this.value)" class="form-control" placeholder="Class" required="required">
                    <?php
                    if((Module::IsClassFormMaster($_SESSION['userid'],$Session,$Term,$Class))||$_SESSION['user_type']=='Admin'||$_SESSION['post']=="webmaster")
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

                      foreach(Module::ReadStaffAllocationClasses($staff,$session,$term) as $class)
                      {
                        echo "<option>".$class."</option>";
                      }			                          
                    }
                    ?>               
                  </select>
                </div>
                  <br/>
                  <div></div>
                  <select class="form-control" id="txtsubjectp" name="txtsubjectp" 
                  onclick="if(this.value!=='')
                  {
                  	document.getElementById('btnOpenCaSheet').style.display='block';
                  }">

                  </select>
                  <br/>
                  <div class="form-label-group">
                  <input type="submit" name="btnOpenCaSheet" id="btnOpenCaSheet" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder; display: none">
                </div>
                  
                </form>
							</div>
						</div>
            <?php

          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Master_sheet"))||$_SESSION['post']=="webmaster")
          {
            ?>      
						<!-- Features Item -->
						<div id="Master_sheet" class="col-lg-3 feature_col">
  						<a href="master.php">
  							<div class="feature text-center trans_400">
  								<div class="feature_icon"><img  width="200px" src="../images/icons/master_sheet.jpg" alt="Open Master Sheet"></div>
  								<h3 class="feature_title">Master Sheet</h3><br/>
  								<div class="feature_text"><p>This platform will help you to manage CA 1 Master Sheet<br/>CA 2 Master Sheet<br/>Exam Master Sheet<br/>Overall Master Sheet<br/>Result Sheet<br/>Different result manipulation and exploration tools<br></p></div>
  								
  							</div>
  						</a>
						</div>
            <?php

          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Result_verifier"))||$_SESSION['post']=="webmaster")
          {
            ?>
						<!-- Features Item -->
						<div id="Result_verifier" class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img   width="150px" src="../images/icons/all_result_verifier.jpg" alt=""></div>
								<h3 class="feature_title">Result Verifier</h3><br/>
								<form id='master_sheet_form' action="../portal/individual_student_resultp.php" method="GET">
                  <label for="class">Class</label>
                  <div class="form-label-group">
                  	<select name="class" id="class" class="form-control" placeholder="Class" required="required">
                    <?php
                    if((Position::IsPositionPrivilege($_SESSION['post'],"Result_verifier"))||$_SESSION['post']=="webmaster")
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
                    </select>
                </div>
                  <label for="session">Session</label>		                          
                  <div class="form-label-group">
                  	<select name="session" id="session" class="form-control" placeholder="Term" required="required">
                  		<?php
                      foreach(Module::ReadAllSessions() as $session)
                      {
                        echo "<option>".$session."</option>";
                      }
                      ?>
                  </select>
                </div>
                  <label for="term">Term</label>
                  <div class="form-label-group">
                  	<select name="term" id="prterm" class="form-control" placeholder="Term" required="required">			                          
                    	<option>First</option>
                    	<option>Second</option>
                    	<option>Third</option>
                    </select>
                </div>
                  <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                </form>
							</div>
						</div>
            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Individual_result_verifier"))||$_SESSION['post']=="webmaster")
          {
            ?>
            <!-- Features Item -->
						<div id="Individual_result_verifier" class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img   width="150px" src="../images/icons/result_verifier.jpg" alt=""></div>
								<h3 class="feature_title">Individual Result Verifier</h3><br/>
								<form id='master_sheet_form' action="../portal/individual_student_resultp.php" method="GET">
                  <label for="class">Student</label>
                  <div class="form-label-group">
                  	<input name="student" id="student" class="form-control" placeholder="Reg. No. e.g. <?php echo $school_details['school_keycode']; ?>/2014/1" required="required" style="text-transform: uppercase;">
                </div>
                  <label for="session">Session</label>		                          
                  <div class="form-label-group">
                  	<select name="session" id="session" class="form-control" placeholder="Term" required="required">
                  		<?php
                      foreach(Module::ReadAllSessions() as $session)
                      {
                        echo "<option>".$session."</option>";
                      }
                      ?>
                  </select>
                </div>
                  <label for="term">Term</label>
                  <div class="form-label-group">
                  	<select name="term" id="prterm" class="form-control" placeholder="Term" required="required">			                          
                    	<option>First</option>
                    	<option>Second</option>
                    	<option>Third</option>
                    </select>
                </div>
                  <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                </form>
							</div>
						</div>
            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Psychomotor_ratings"))||$_SESSION['post']=="webmaster")
          {
            ?>
            <!-- Features Item -->
            <div id="Psychomotor_ratings" class="col-lg-3 feature_col">
              <div class="feature text-center trans_400">
                <div class="feature_icon"><img   width="150px" src="../images/icons/rating.jpg" alt=""></div>
                <h3 class="feature_title">Psychomotor Ratings</h3><br/>
                <form id='master_sheet_form' action="psychomotorp.php" method="GET">
                  <label for="classp">Class</label>

                  <div class="form-label-group">
                    <select name="classp" id="classp" class="form-control" placeholder="Session" required="required">
                    <?php
                    if((Position::IsPositionPrivilege($_SESSION['post'],"Psychomotor_ratings"))||$_SESSION['post']=="webmaster")
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
                    </select>
                  </div>

                    <label for="sessionp">Session</label>
                    <div class="form-label-group">
                    <select name="sessionp" id="sessionp" class="form-control" placeholder="Session" required="required">
                      <?php
                      foreach(Module::ReadAllSessions() as $session)
                      {
                        echo "<option>".$session."</option>";
                      }
                      ?>
                  </select>

                  <label for="termp">Term</label>
                  <select name="termp" id="termp" class="form-control">
                    <option>First</option>
                    <option>Second</option>
                    <option>Third</option>
                  </select>
                    </div>
                      <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                    </form>
              </div>
            </div>
            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Student_gifting"))||$_SESSION['post']=="webmaster")
          {
            ?>
            <!-- Features Item -->
            <div id="Student_gifting" class="col-lg-3 feature_col">
              <div class="feature text-center trans_400">
                <div class="feature_icon"><img   width="150px" src="../images/icons/rating.jpg" alt=""></div>
                <h3 class="feature_title">Prizes & Gifts</h3><br/>
                <form id='master_sheet_form' action="psychomotorp.php" method="GET">
                  <label for="classp">Class</label>

                    <label for="sessionp">Session</label>
                    <div class="form-label-group">
                    <select name="sessionp" id="sessionp" class="form-control" placeholder="Session" required="required">
                      <?php
                      foreach(Module::ReadAllSessions() as $session)
                      {
                        echo "<option>".$session."</option>";
                      }
                      ?>
                  </select>
                    </div>
                      <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                    </form>
              </div>
            </div>
            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Attendance"))||$_SESSION['post']=="webmaster")
          {
            ?>
						<!-- Features Item -->
						<div id="Attendance" class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img   width="150px" src="../images/icons/rating.jpg" alt=""></div>
								<h3 class="feature_title">Attendance</h3><br/>
								<form id='master_sheet_form' action="attendance.php" method="GET">
                  <label for="classp">Class</label>

                  <div class="form-label-group">
                  	<select name="classp" id="classp" class="form-control" placeholder="Session" required="required">
                    <?php
                   if((Position::IsPositionPrivilege($_SESSION['post'],"Attendance"))||$_SESSION['post']=="webmaster")
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
                    </select>
                </div>

                  <label for="sessionp">Session</label>
                  <div class="form-label-group">
                  <select name="sessionp" id="sessionp" class="form-control" placeholder="Session" required="required">
                    <?php
                    foreach(Module::ReadAllSessions() as $session)
                    {
                      echo "<option>".$session."</option>";
                    }
                    ?>
									</select>

									<label for="termp">Term</label>
									<select name="termp" id="termp" class="form-control">
										<option>First</option>
										<option>Second</option>
										<option>Third</option>
									</select>
                    </div>
                      <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                    </form>
							</div>
						</div>
						<?php
					}

					if((Position::IsPositionPrivilege($_SESSION['post'],"Result_cover_pages"))||$_SESSION['post']=="webmaster")
					{
						?>
						<!-- Features Item -->
						<div id="Result_cover_pages" class="col-lg-3 feature_col">
							<a href="../portal/result_explorer.php">
								<div class="feature text-center trans_400">
									<div class="feature_icon"><img  width="150px" src="../images/icons/result_checker.jpg" alt="Open Individual Result"></div>
									<h3 class="feature_title">Admin Result Checker</h3><br/>
									<div class="feature_text"><p>This is what you can use to check result of individual student/student</p></div>
								</div>
							</a>
						</div>
            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"All_result_covers"))||$_SESSION['post']=="webmaster")
          {
            ?>						
						<!-- Features Item -->
						<div id="All_result_covers" class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img   width="150px" src="../images/icons/printable_result.jpg" alt=""></div>
								<h3 class="feature_title">Printable Students Results</h3><br/>
								<form id='master_sheet_form' action="../portal/allresultsp.php" method="GET">
                  <label for="prclass">Class</label>
                  <div class="form-label-group">
                  	<select name="prclass" id="prclass" class="form-control" placeholder="Session" required="required">
                    <?php
                    if((Position::IsPositionPrivilege($_SESSION['post'],"All_result_covers"))||$_SESSION['post']=="webmaster")
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
                    </select>
                </div>
                  <label for="prsession">Session</label>		                          
                  <div class="form-label-group">
                  	<select name="prsession" id="prsession" class="form-control" placeholder="Term" required="required">
                  		<?php
                      foreach(Module::ReadAllSessions() as $session)
                      {
                        echo "<option>".$session."</option>";
                      }
                      ?>
                  </select>
                </div>
                  <label for="prterm">Term</label>
                  <div class="form-label-group">
                  	<select name="prterm" id="prterm" class="form-control" placeholder="Term" required="required">			                          
                    	<option>First</option>
                    	<option>Second</option>
                    	<option>Third</option>
                    </select>
                </div>
                  <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                </form>
							</div>
						</div>
            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Admin_result_checker"))||$_SESSION['post']=="webmaster")
          {
            ?>						
						<!-- Features Item -->
						<div id="Admin_result_checker" class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img   width="150px" src="../images/icons/position.jpg" alt=""></div>
								<h3 class="feature_title">Position Processor</h3><br/>
								<form id='master_sheet_form' action="positions.php" method="GET">
                  <label for="classp">Class</label>

		                <div class="form-label-group">
		                  <select name="classp" id="classp" class="form-control" placeholder="Session" required="required">
	                     <?php
				                $Classes=Module::ReadClasses();
				                sort($Classes);
				                if(count($Classes)>0)
				                {
				                  $count=0;
				                  foreach($Classes as $Class)
				                  {
				                    ?>
				                    <option><?php echo $Class; ?></option>
				                    <?php
				                  }
				                }
				                ?>
                      </select>
                    </div>

                  <label for="sessionp">Session</label>
                  <div class="form-label-group">
                  <select name="sessionp" id="sessionp" class="form-control" placeholder="Session" required="required">
                      <?php
                      foreach(Module::ReadAllSessions() as $session)
                      {
                        echo "<option>".$session."</option>";
                      }
                      ?>
									</select>

									<label for="termp">Term</label>
									<select name="termp" id="termp" class="form-control">
										<option>First</option>
										<option>Second</option>
										<option>Third</option>
									</select>
                  </div>
                    <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                  </form>
							</div>
						</div>
            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Printable_students_results"))||$_SESSION['post']=="webmaster")
          {
            ?>      						
						<!-- Features Item -->
						<div id="Printable_students_results" class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img   width="150px" src="../images/icons/cummulative.jpg" alt=""></div>
								<h3 class="feature_title">Cummulative Position Processor</h3><br/>
								<form id='master_sheet_form' action="session_subject_positions.php" method="GET">
		                          

                  <label for="classp">Class</label>

                  <div class="form-label-group">
                  	<select name="classp" id="classp" class="form-control" placeholder="Session" required="required">
                        <?php
                        $Classes=Module::ReadClasses();
                        sort($Classes);
                        if(count($Classes)>0)
                        {
                          $count=0;
                          foreach($Classes as $Class)
                          {
                            ?>
                            <option><?php echo $Class; ?></option>
                            <?php
                          }
                        }
                        ?>
                    </select>
                  </div>

                  <label for="sessionp">Session</label>
                  <div class="form-label-group">
                  <select name="sessionp" id="sessionp" class="form-control" placeholder="Session" required="required">
                    <?php
                    foreach(Module::ReadAllSessions() as $session)
                    {
                      echo "<option>".$session."</option>";
                    }
                    ?>
									</select>

									<label for="termp">Term</label>
									<select name="termp" id="termp" class="form-control">
										<option>First</option>
										<option>Second</option>
										<option>Third</option>
									</select>
                    </div>
                      <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                    </form>
							</div>
						</div>

            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Position_processor"))||$_SESSION['post']=="webmaster")
          {
            ?>      
						
						<!-- Features Item -->
						<div id="Position_processor" class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img   width="150px" src="../images/icons/result_summary.jpg" alt=""></div>
								<h3 class="feature_title">Result Summary Explorer</h3><br/>
								<form id='master_sheet_form' action="result_summary.php" method="GET">
                  <label for="classp">Class</label>

                  <div class="form-label-group">
                  	<select name="classp" id="classp" class="form-control" placeholder="Session" required="required">
                    <?php
                    if((Position::IsPositionPrivilege($_SESSION['post'],"Position_processor"))||$_SESSION['post']=="webmaster")
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
                    </select>
                </div>

                  <label for="sessionp">Session</label>
                  <div class="form-label-group">
                  <select name="sessionp" id="sessionp" class="form-control" placeholder="Session" required="required">
                    <?php
                    foreach(Module::ReadAllSessions() as $session)
                    {
                      echo "<option>".$session."</option>";
                    }
                    ?>
									</select>

									<label for="termp">Term</label>
									<select name="termp" id="termp" class="form-control">
										<option>First</option>
										<option>Second</option>
										<option>Third</option>
									</select>
                </div>
                 <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
              	</form>
							</div>
						</div>

            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Cummumulative_position_processor"))||$_SESSION['post']=="webmaster")
          {
            ?>      
						
						<!-- Features Item -->
						<div id="Cummumulative_position_processor" class="col-lg-3 feature_col">
							<div class="feature text-center trans_400">
								<div class="feature_icon"><img   width="150px" src="../images/icons/result_summary.jpg" alt=""></div>
								<h3 class="feature_title">Result Collectors Summary</h3><br/>
								<form id='master_sheet_form' action="result_collector.php" method="GET">
                  <label for="classp">Class</label>

                  <div class="form-label-group">
                  	<select name="classp" id="classp" class="form-control" placeholder="Session" required="required">
                    <?php
                    if((Position::IsPositionPrivilege($_SESSION['post'],"Cummumulative_position_processor"))||$_SESSION['post']=="webmaster")
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
                    </select>
                </div>

                  <label for="sessionp">Session</label>
                <div class="form-label-group">
                  <select name="sessionp" id="sessionp" class="form-control" placeholder="Session" required="required">
                    <?php
                    foreach(Module::ReadAllSessions() as $session)
                    {
                      echo "<option>".$session."</option>";
                    }
                    ?>
									</select>

									<label for="termp">Term</label>
									<select name="termp" id="termp" class="form-control">
										<option>First</option>
										<option>Second</option>
										<option>Third</option>
									</select>
                </div>
                 <input type="submit" name="" value="Open" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
              	</form>
							</div>
						</div>

            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Result_summary_explorer"))||$_SESSION['post']=="webmaster")
          {
            ?>      
						
						<!-- Features Item -->
						<div id="Result_summary_explorer" class="col-lg-3 feature_col">
							<a href="testimonial.php">
								<div class="feature text-center trans_400">
									<div class="feature_icon"><img   width="150px" src="../images/icons/testimonial.jpg" alt=""></div>
									<h3 class="feature_title">Print Testimonial</h3><br/>
									<p>This is the printable copy of the school's Testimonial.
										You can click on this to preview it if you want to print it out.
									</p>
								</div>
							</a>
						</div>
            <?php
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Result_collectors_summary"))||$_SESSION['post']=="webmaster")
          {
            ?>      
						<!-- Features Item -->
						<div id="Result_collectors_summary" class="col-lg-3 feature_col">
							<a href="../portal/?userid=<?php echo $_SESSION['userid']; ?>">
								<div class="feature text-center trans_400">
									<div class="feature_icon"><img   width="150px" src="../../img/core-img/psychomoto-sheet.png" alt=""></div>
									<h3 class="feature_title">Print My Result</h3><br/>
									<p>Students can print their result by clicking here.</p>
								</div>
							</a>
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
  <script src="../js/result.js"></script>
</body>
</html>