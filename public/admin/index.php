<?php session_start();
include '../Module.php';
$school_details=School::ReadSchoolDetails();
if(!($_SESSION['lgina']=="IN") || !(strtolower($_SESSION['user_type'])=="admin")){
  header("location:../login.php");
}

$staff=$_SESSION['staffid'];
$currentSession=Module::ReadCurrentSession();
$session=$currentSession['session'];
$term=$currentSession['term'];
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
  <title>Admin Dashboard</title>
  <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Dubai Care School">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../styles/bootstrap4/bootstrap.min.css">
  <link href="../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/animate.css">
  <link rel="stylesheet" type="text/css" href="../styles/main_styles.css">
  <link rel="stylesheet" type="text/css" href="../styles/responsive.css">
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
            <div class="header_content d-flex flex-row align-items-center justify-content-start" style="background: white">
              <div class="logo_container">
                <a href="#">
                  <div class="logo_text"><a href="../index.php"><img src="../images/school/logo.png" alt="<?php echo $school_details['school_keycode'];?> School Portal" style="width: 150px"></a></div>
                </a>
              </div>
              <nav class="main_nav_contaner ml-auto">
                <ul class="main_nav">
                  <li class="active"><a href="../index.php">Home</a></li>
                  <li><a href="../about.php">About</a></li>
                  <li><a href="../admission.php">Admission</a></li>
                  <li><a href="../exam.php">Exams</a></li>
                  <li><a href="../contact.php">Contact</a></li>
                  <li><a href="../portal">Check Result</a></li>
                  <?php 
                  if(isset($_SESSION['lgina']))
                  {
                    ?>
                    <li class="nav-item dropdown">
                      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="preview" role="button" area-haspopup="true" area-expanded="false"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 30px; border-radius: 100%; padding: 2px 2px 2px 2px"> <?php
                         if(isset($_SESSION['staffid']))
                         {
                          echo $_SESSION['staffid']; 
                         }
                         else
                         {
                          $names=explode(' ', $_SESSION['names']);
                          echo $names[1]; 
                         }
                         

                         ?></a>
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
        <li class="menu_mm"><a href="../index.php">Home</a></li>
        <li class="menu_mm"><a href="../about.php">About</a></li>
        <li class="menu_mm"><a href="../admission.php">Admission</a></li>
        <li class="menu_mm"><a../ href="../exam.php">Examins</a></li>
        <li class="menu_mm"><a href="../contact.php">Contact</a></li>
      </ul>
    </nav>
  </div>
  <br/><br/><br/>

  <!-- Features -->

  <div class="features">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title_container text-center">
            <h2 class="section_title">Management Portal</h2>
          </div> 
        </div>
      </div>
      <!--If Principal -->
      <div class="row features_row">
        <style type="text/css">
          .feature_col{
            background: lightgreen;
            border-radius: 100%;
          }
          
          .feature_icon img{
            border-radius: 100%;
          }
        </style>

        <!-- Features Item -->
        <div class="col-lg-3 feature_col">
          <a href="../dashboard"><div class="feature text-center trans_400">
            <div class="feature_icon"><img src="../images/icons/dashboard_icon.png" alt="" width="70px"></div>
            <h3 class="feature_title">My Dashboard</h3>
            <div class="feature_text"><p>Carryout your own operations easily and flexibly<br/><br/><br/><br/></p></div>
          </div></a>
        </div>
        <?php
          if((Position::IsPositionPrivilege($_SESSION['post'],"Post_manager"))||$_SESSION['post']=="webmaster")
          {
            ?>

          <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../admin/position.php"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/staff_manager_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Post Manager</h3>
                <div class="feature_text"><p>This is where you manage the list of post to assign to staff.<br/><br/></p></div>
              </div></a>
            </div>
            <?php 
          }


          if((Position::IsPositionPrivilege($_SESSION['post'],"Student_manager"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <div class="feature text-center trans_400">
              <div class="feature_icon"><img src="../images/icons/student_manager_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title"><!--Primary -->Students Manager</h3>
                <div class="feature_text"><p>Select Class to View Students <br/></p></div>

                <form id='ca_sheet_form'  action="../dashboard/users/allstudents.php" method="GET">
                  <select name="txtclassp" id="txtclassp" style="padding: 5px 5px 5px 5px; width: 120px"  required>
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
                  <br/>
                  
                  <input type="submit" name="" value="Open" style="padding: 5px 5px 5px 5px; width: 120px">
                </form>
                <br/><br/>
              </div>
            </div>
            <?php 
          }


          if((Position::IsPositionPrivilege($_SESSION['post'],"Staff_manager"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../dashboard/users/allstaff.php"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/staff_manager_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Staff Manager</h3>
                <div class="feature_text"><p>This is the comprehensive list of staff in this school. Coupled with tools used for adding new, removing and updating staff information<br/><br/></p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Subject_manager"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <div class="feature text-center trans_400">

                <a href="subject_library.php">
                  <div class="feature_icon"><img src="../images/icons/subject_manager_icon.png" alt="" width="70px"></div>
                  <h3 class="feature_title">Subject Manager</h3>
                  <div class="feature_text">
                    <p>This is the comprehensive list of subjects offered in this school. Coupled with tools used for adding new, removing and updating existing subject details</p>
                  </div>
                </a>
              </div>
            </div>            
            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Subject_registration"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <div class="feature text-center trans_400">

                
                  <div class="feature_icon"><img src="../images/icons/subject_registration_icon.png" alt="" width="70px"></div>
                  <h3 class="feature_title">Subject Registration</h3>
                  <div class="feature_text">
                    <p>This is the where students subjects are registered manually by the form master or members of the examination board.</p>
                    <form id='ca_sheet_form'  action="./student_subject_registration.php" method="GET">
                      <select name="class" id="class" style="padding: 5px 5px 5px 5px; width: 120px"  required>
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
                      <br/>
                      
                      <input type="submit" name="" value="Open" style="padding: 5px 5px 5px 5px; width: 120px">
                    </form>
                  </div>
              </div>
            </div>                       
            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Subject_allocation"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="subject_allocation.php?session=<?php echo $session; ?>&term=<?php echo $term; ?>"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/subject_allocation_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Subject Allocation</h3>
                <div class="feature_text"><p>This is where Subjects are allocated to the Teachers of a particular class</p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Class_manager"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="class_library.php?session=<?php echo $session; ?>&term=<?php echo $term; ?>"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/class_management_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Class Manager</h3>
                <div class="feature_text"><p>This is the tools used for managing classes</p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Class_allocation"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="class_allocation.php?session=<?php echo $session; ?>&term=<?php echo $term; ?>"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/class_allocation_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Class Allocation</h3>
                <div class="feature_text"><p>This is where classes are allocated to the form masters</p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Result_settings"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="settings.php?session=<?php echo $session; ?>&term=<?php echo $term; ?>"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/result_setting_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Result Settings</h3>
                <div class="feature_text"><p>This is where Next term Begin and Sessions are been set</p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Grade_point_manager"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../dashboard/grade_point/"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/grade_point_average_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Grade Point Manager</h3>
                <div class="feature_text"><p>This is where the gades that will appear on the result are set</p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Finance_manager"))||$_SESSION['post']=="webmaster")
          {
          ?>

            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../dashboard/finance/?session=<?php echo $session; ?>&term=<?php echo $term; ?>"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/finance_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Finance Manager</h3>
                <div class="feature_text"><p>This is where money related issues are observed</p></div>
              </div></a>
            </div>           
            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Innovations"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../dashboard/innovation/index.php"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/innovation_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Innovations</h3>
                <div class="feature_text"><p>This is where all innovations of this organization are managed</p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Official_letters"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../dashboard/messaging/index.php"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/official_letter_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Official Letters</h3>
                <div class="feature_text"><p>This is where all official messages of the school are managed with official references.</p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Napps"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="https://napps.com.ng"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/napps_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">NAPPS</h3>
                <div class="feature_text"><p>This is the link to the National Association of Proprietor of Private Schools in Nigeria.</p></div>
              </div></a>
            </div>    

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Control_panel"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../dashboard/webmaster"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../images/icons/control_panel_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Control Panel</h3>
                <div class="feature_text"><p>This is the link to the National Association of Proprietor of Private Schools in Nigeria.</p></div>
              </div></a>
            </div>

            <?php 
          }
          ?>
        
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