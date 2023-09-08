<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
if(!($_SESSION['lgina']=="IN"))
  header("location:../../login.php");

if((School::Today()>=(abs($school_details['d_e_d']['expiry_day'])+30))||(School::Today()>=(abs($school_details['h_e_d']['expiry_day'])+30)))
  header("location:../../");

$staff=$_SESSION['staffid'];
$currentSession=Module::ReadCurrentSession();
$session=$currentSession['session'];
$term=$currentSession['term'];
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
<title>Finance Dashboard</title>
<link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="<?php echo strtoupper($school_details['school_name']); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="../../styles/bootstrap4/bootstrap.min.css">
<link href="../../plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="../../plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="../../styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="../../styles/responsive.css">

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
                              <a href="../dashboard/users/viewstaffprofile.php" class="dropdown-item"><i class="fa fa-user"></i> Profile</a>
                              <a href="../dashboard" class="dropdown-item">Dashboard</a>
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
            <h2 class="section_title">Finance Management</h2>
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
          <a href="../"><div class="feature text-center trans_400">
            <div class="feature_icon"><img src="../../images/icons/dashboard_icon.png" alt="" width="70px"></div>
            <h3 class="feature_title">My Dashboard</h3>
            <div class="feature_text"><p>Carryout your own operations easily and flexibly<br/><br/><br/><br/></p></div>
          </div></a>
        </div>


        <?php
        if(strtolower($_SESSION['user_type'])==strtolower("Admin")&&((strtolower($_SESSION['post'])==strtolower("Finance")&&strtolower($_SESSION['status'])==strtolower("Active"))||(strtolower($_SESSION['post'])==strtolower("Webmaster"))))
        {
          ?>
          <!-- Features Item -->
          <div class="col-lg-3 feature_col">
            <div class="feature text-center trans_400">
            <a href="fee_explorer.php"><div class="feature_icon"><img src="../../images/icons/finance_icon.png" alt="" width="70px"></div>
              <h3 class="feature_title">Fee Explorer</h3>
              <div class="feature_text"><p>Open Admin Fee Payment Explorer<br/><br/></p>
              </div>

              <br/><br/></a>
            </div>
          </div>

          <!-- Features Item -->
          <div class="col-lg-3 feature_col">
            <div class="feature text-center trans_400">
            <a href="../../pin"><div class="feature_icon"><img src="../../images/icons/scratch_card_icon.png" alt="" width="70px"></div>
              <h3 class="feature_title">Scratch Card</h3>
              <div class="feature_text"><p>Open the Scratch Card Explorer <br/><br/></p>
              </div>

              <br/><br/></a>
            </div>
          </div>

          <!-- Features Item -->
          <div class="col-lg-3 feature_col">
            <a href="fee_amounts.php"><div class="feature text-center trans_400">
              <div class="feature_icon"><img src="../images/icons/fee_amount_icon.png" alt="" width="70px"></div>
              <h3 class="feature_title">Fee Amounts</h3>
              <div class="feature_text"><p>This is where the amount to be paid by the students are set.<br/><br/></p></div>
            </div></a>
          </div>

          <!-- Features Item -->
          <div class="col-lg-3 feature_col">
            <a href="voucher_explorer.php"><div class="feature text-center trans_400">
              <div class="feature_icon"><img src="../images/icons/voucher_explorer_icon.png" alt="" width="70px"></div>
              <h3 class="feature_title">Voucher Explorer</h3>
              <div class="feature_text"><p>This is where the payment voucher for staff payments are processed.<br/><br/></p></div>
            </div></a>
          </div>

          <!-- Features Item -->
          <div class="col-lg-3 feature_col">
            <a href="reciept_explorer.php"><div class="feature text-center trans_400">
              <div class="feature_icon"><img src="../images/icons/reciept_explorer_icon.png" alt="" width="70px"></div>
              <h3 class="feature_title">Reciept Explorer</h3>
              <div class="feature_text"><p>This is where the payment reciepts for students are explored or printed.<br/><br/></p></div>
            </div></a>
          </div>

          <?php
        }
        ?>

        <?php
        if(strtolower($_SESSION['user_type'])==strtolower("Student"))
        {
          ?>
          <!-- Features Item -->
          <div class="col-lg-3 feature_col">
            <div class="feature text-center trans_400">
              <div class="feature_icon"><img  src="../images/icons/pay_fees_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title" style="background: white;">Pay Fees</h3>
                <div class="feature_text"><p>Pay your fees using this tool.<br/>
                  <form method="GET" action="Pay">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <div class="form-label-group">
                            <select id="session" name="session" class="form-control" placeholder="Session">
                              <?php
                              $sessions=Module::ReadAllSessions();
                              foreach($sessions as $session)
                              {
                                ?>
                                <option><?php echo $session; ?></option>
                                <?php
                              }
                              ?>                    
                            </select>
                            <label for="session">Session</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-label-group">
                            <select id="term" name="term" class="form-control" placeholder="Session">
                              <option>First</option>
                              <option>Second</option>
                              <option>Third</option>
                            </select>
                            <label for="term">Term</label>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6">
                          <div class="form-label-group">
                            <input type="submit" name="btnPay" value="Continue" style="background: green; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-label-group">
                            <input type="reset" name="" value="Cancel" style="background: red; color: white; border-radius: 20px; padding: 5px 5px 5px 5px; width: 100%; font-weight: bolder;">
                          </div>
                        </div>
                      </div>
                    </div> 
                  </form> 
                </p>
              </div>
            </div>
          </div>

          <!-- Features Item -->
          <div class="col-lg-3 feature_col">
            <div class="feature text-center trans_400">

              <a href="all_student_reciepts.php">
                <div class="feature_icon"><img src="../images/icons/my_fees_reciept_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">My Fees & Reciept</h3>
                <div class="feature_text">
                  <p>This is where you can access your payment details like reciept and online payment</p>
                </div>
              </a>
            </div>
          </div>
          <?php
        }
        ?>

        <?php
        if(strtolower($_SESSION['user_type'])==strtolower("Staff")||strtolower($_SESSION['user_type'])==strtolower("Admin"))
        {
          ?>
          <!-- Features Item -->
          <div class="col-lg-3 feature_col">
            <div class="feature text-center trans_400">

              <a href="./staff_voucher_slips.php">
                <div class="feature_icon"><img src="../images/icons/my_vouchers_icon.png" alt="" width="70px"></div>
                <h3 class="feature_title">My Vouchers</h3>
                <div class="feature_text">
                  <p>This is where you can access your payment information</p>
                </div>
              </a>
            </div>
          </div>  
          <?php
        }
        ?>
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
                <div class="logo_text"><a href="../index.php"><img src="../../images/school/logo.png" alt="" style="width: 100px"></a></div>
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
                      <li><?php echo strtoupper($school_details['school_name']); ?>, <?php echo strtoupper($school_details['school_address']); ?></li>
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