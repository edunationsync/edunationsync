<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$d_e_d=School::DomainExpiryDay($school_details['domain_due_date']);
$h_e_d=School::HostingExpiryDay($school_details['hosting_due_date']);


if(!($_SESSION['lgina']=="IN"))
  header("location:../../login.php");


$ded=$d_e_d['day_diff'];
$hed=$h_e_d['day_diff'];
/*
if(($ded<=(-30))||($hed<=(-30))&&(!$_SESSION['post']=="webmaster"))
  header("location:../../");*/

// echo $school_details['h_e_d']['expiry_day'];echo $school_details['d_e_d']['expiry_day'];

$staff=$_SESSION['staffid'];
$currentSession=Module::ReadCurrentSession();
$session=$currentSession['session'];
$term=$currentSession['term'];
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
  <title>User Dashboard</title>
  <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Dubai Care School">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../../styles/bootstrap4/bootstrap.min.css">
  <link hDref="../../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
  <link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
  <link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/animate.css">
  <link rel="stylesheet" type="text/css" href="../../styles/main_styles.css">
  <link rel="stylesheet" type="text/css" href="../../styles/responsive.css">


        <!--Tab Bootstrap-->        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="form.js"></script>


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <!-- CSS | menuzord megamenu skins -->
        <link href="../../css/menuzord-megamenu.css" rel="stylesheet" />
        <link id="menuzord-menu-skins" href="../../css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet" />

        <!-- CSS | Main style file -->
        <link href="../../css/style-main.css" rel="stylesheet" type="text/css">

        <!-- CSS | Custom Margin Padding Collection -->
        <link href="../../css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">

        <!-- CSS | Responsive media queries -->
        <link href="../../css/responsive.css" rel="stylesheet" type="text/css">

        <link href="../../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/animate.css">
        <link rel="stylesheet" type="text/css" href="../../styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="../../styles/responsive.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


        <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
        <!-- <link href="/css/style.css" rel="stylesheet" type="text/css"> -->
        <!-- CSS | Theme Color -->
        <link href="../../css/colors/theme-skin-color-set6.css" rel="stylesheet" type="text/css">

        <!-- Revolution Slider 5.x CSS settings -->
        <link href="../../js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css" />
        <link href="../../js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css" />
        <link href="../../js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css" />

        <!-- external javascripts -->
        <script src="../../js/jquery-2.2.4.min.js"></script>
        <script src="../../js/jquery-ui.min.js"></script>


        <!-- JS | jquery plugin collection for this theme -->
        <script src="../../js/jquery-plugin-collection.js"></script>

        <!-- Revolution Slider 5.x SCRIPTS -->
        <script src="../../js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
        <script src="../../js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

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
                  <div class="logo_text"><a href="../../index.php"><img src="../../images/school/logo.png" alt="<?php echo $school_details['school_keycode'];?> School Portal" style="width: 100px"></a></div>
                </a>
              </div>
              <nav class="main_nav_contaner ml-auto">
                <ul class="main_nav">
                  <li class="active"><a href="../../index.php">Home</a></li>
                  <li><a href="../../about.php">About</a></li>
                  <li><a href="../../admission.php">Admission</a></li>
                  <li><a href="../../exam.php">Exams</a></li>
                  <li><a href="../../contact.php">Contact</a></li>
                  <li><a href="../../portal">Check Result</a></li>
                  <?php 
                  if(isset($_SESSION['lgina']))
                  {
                    ?>
                    <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="preview" role="button" area-haspopup="true" area-expanded="false"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 30px; border-radius: 100%; padding: 2px 2px 2px 2px"> </a>
                            <div class="dropdown-menu" area-labelledby="Preview">
                              <a href="../users/viewstaffprofile.php" class="dropdown-item"><i class="fa fa-user"></i> Profile</a>
                              <a href="../" class="dropdown-item">Dashboard</a>
                              <a href="../../logout.php" class="dropdown-item">Logout</a>
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
        <li class="menu_mm"><a href="../../index.php">Home</a></li>
        <li class="menu_mm"><a href="../../about.php">About</a></li>
        <li class="menu_mm"><a href="../../admission.php">Admission</a></li>
        <li class="menu_mm"><a../ href="../../exam.php">Examins</a></li>
        <li class="menu_mm"><a href="../../contact.php">Contact</a></li>
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
            <h2 class="section_title">Main Dashboard</h2>
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

    <?php 
    if(((School::Today()>=(abs($d_e_d['expiry_day'])+30))||(School::Today()>=(abs($h_e_d['expiry_day'])+30)))&&(!$_SESSION['post']=="webmaster"))
    {
      ?>
      <div class="col-lg-12 feature_col">
        <div class="feature text-center trans_400">
          <div class="feature_icon"><img src="../../images/icons/settings.jpg" alt="" width="70px"></div>
          <h3 class="feature_title">Something went wrong!</h3>
          <h5>Posible Causes of the problem includes:</h5>
          <div class="feature_text">
            <p>Synchronization error</p>
            <p>Server Host/Domain not connecting</p>
            <p>Local Network Connectivity problem</p>
            <p>Contact the developer's helpdesk on 08145471529 or 07067713946 or 09128722323 or 09123297104</p>
          </div>
        </div>
      </div>
      <?php
    }
    else
    {
      ?>

        <!-- Features Item -->
        <div class="col-lg-3 feature_col">
          <a href="../"><div class="feature text-center trans_400">
            <div class="feature_icon"><img src="../../images/icons/dashboard_icon.png" alt="" width="70px"></div>
            <h3 class="feature_title">My Dashboard</h3>
            <div class="feature_text"><p>Carryout your own operations easily and flexibly<br/><br/><br/><br/></p></div>
          </div></a>
        </div>

        <!-- Features Item -->
        <div class="col-lg-3 feature_col">
          <div class="feature text-center trans_400">
            <?php
            if(strtolower($_SESSION['user_type'])==strtolower("Staff")||strtolower($_SESSION['user_type'])==strtolower("Admin"))
            {
              ?>
              <a href="changestaffpassport.php?id=<?php echo $_SESSION['userid']; ?>">
              <?php
            }
            elseif(strtolower($_SESSION['user_type'])==strtolower("Student"))
            {
              ?>
              <a href="changestudentpassport.php?id=<?php echo $_SESSION['userid']; ?>">
              <?php
            }

            ?>
            <div class="feature_icon"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" alt="" width="70px"></div>
            <h3 class="feature_title" style="background: white;">Profile Picture</h3>
            <div class="feature_text"><p>Manage your profile picture here.<br/><br/><br/><br/></p></div>
          </div></a>
        </div>

        <!-- Features Item -->
        <div class="col-lg-3 feature_col">
          <div class="feature text-center trans_400">
            <?php
            if(strtolower($_SESSION['user_type'])==strtolower("Student"))
            {
              ?>
              <a href="viewstudentprofile.php?id=<?php echo $_SESSION['userid']; ?>">
              <?php
            }
            else
            {
              ?>
              <a href="viewstaffprofile.php?id=<?php echo $_SESSION['userid']; ?>">
              <?php
            }

            ?>
          <div class="feature_icon"><img src="../../images/icons/biodata_icon.png" alt="" width="70px"></div>
            <h3 class="feature_title">Bio Data</h3>
            <div class="feature_text"><p>View and modify your personal information.<br/></p></div>

            <br/><br/></a>
          </div>
        </div>

            <?php 
          if((Position::IsPositionPrivilege($_SESSION['post'],"My_students"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- User Students Management -->
            <div class="col-lg-3 feature_col">
              <div class="feature text-center trans_400">
              <div class="feature_icon"><img src="../../images/icons/my_student_manager_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title"><!--Primary -->My Students</h3>
                <div class="feature_text"><p>Open Staff Students Management <br/></p></div>

                <form id='ca_sheet_form'  action="./user_classes.php" method="GET">
                  <select name="txtsessionp" id="txtsessionp" style="padding: 5px 5px 5px 5px; width: 120px"  required>
                    <?php

                    //$Classes=Module::ReadStaffAllocationClassesp($staff,$session,$term);
                    $Sessions=Module::ReadAllSessions();
                    sort($Sessions);
                    if(count($Sessions)>0)
                    {
                      $count=0;
                      foreach($Sessions as $Session)
                      {
                        ?>
                        <option><?php echo $Session; ?></option>
                        <?php
                      }
                    }

                    ?>
                  </select>
                  <select name="txttermp" id="txttermp" style="padding: 5px 5px 5px 5px; width: 120px"  required>
                    <?php

                    //$Classes=Module::ReadStaffAllocationClassesp($staff,$session,$term);
                    $Terms=array("First","Second","Third");
                    foreach($Terms as $Term)
                    {
                      ?>
                      <option><?php echo $Term; ?></option>
                      <?php
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

          if((Position::IsPositionPrivilege($_SESSION['post'],"My_wards"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- User Students Management -->
            <div class="col-lg-3 feature_col">
              <a href="./my_wards.php">
                <div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../../images/icons/my_student_manager_icon.png" alt="" width="70px"></div>
                  <h3 class="feature_title"><!--Primary -->My Wards</h3>
                  <div class="feature_text"><p>Open the list of my children in <?php echo $school_details['school_name']; ?> <br/></p></div>
                </div>
              </a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Admin"))||$_SESSION['post']=="webmaster")
          {
          ?>
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../../admin/"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../../images/icons/admin_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Admin</h3>
                <div class="feature_text"><p>This is where you can manage the Administrative Unit of the school.<br/><br/></p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Innovations"))||$_SESSION['post']=="webmaster")
          {
          ?>
        
            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../innovation"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../../images/icons/innovation_icon,png" alt="" width="70px"></div>
                <h3 class="feature_title">Innovations</h3>
                <div class="feature_text"><p>This is where you can manage your innovations are uploaded<br/><br/></p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Album"))||$_SESSION['post']=="webmaster")
          {
          ?>

            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="albums.php"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../../images/icons/album_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Album</h3>
                <div class="feature_text"><p>This where you can manage your photo albums<br/><br/></p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Documents"))||$_SESSION['post']=="webmaster")
          {
          ?>

            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="documents.php?userid=<?php echo $_SESSION['userid']; ?>"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../../images/icons/document_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Documents</h3>
                <div class="feature_text"><p>This where you can manage your Important Documents and Credentials <br/><br/></p></div>
              </div></a>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Finance"))||$_SESSION['post']=="webmaster")
          {
          ?>


            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <div class="feature text-center trans_400">

                <a href="../finance">
                  <div class="feature_icon"><img src="../../images/icons/finance_icon.png" alt="" width="70px"></div>
                  <h3 class="feature_title">Finance</h3>
                  <div class="feature_text">
                    <p>This is where you can access your payment details like reciept and online payment</p>
                  </div>
                </a>
              </div>
            </div>

            <?php 
          }

          if((Position::IsPositionPrivilege($_SESSION['post'],"Results"))||$_SESSION['post']=="webmaster")
          {
          ?>

            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <a href="../../result/"><div class="feature text-center trans_400">
                <div class="feature_icon"><img src="../../images/icons/result_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">Results</h3>
                <div class="feature_text"><p>This is where you access your result.</p></div>
              </div></a>
            </div>

            <?php 
          }
          ?>
        
      </div>

      <?php
    }
    ?>

    </div>
  </div>

  <?php 
  $d_e_d=School::DomainExpiryDay($school_details['domain_due_date']);
  $h_e_d=School::HostingExpiryDay($school_details['hosting_due_date']);
  

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

<script src="../../js/jquery-3.2.1.min.js"></script>
<script src="../../styles/bootstrap4/popper.js"></script>
<script src="../../styles/bootstrap4/bootstrap.min.js"></script>
<script src="../../plugins/greensock/TweenMax.min.js"></script>
<script src="../../plugins/greensock/TimelineMax.min.js"></script>
<script src="../../plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="../../plugins/greensock/animation.gsap.min.js"></script>
<script src="../../plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="../../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="../../plugins/easing/easing.js"></script>
<script src="../../plugins/parallax-js-master/parallax.min.js"></script>
<script src="../../js/custom.js"></script>
</body>
</html>