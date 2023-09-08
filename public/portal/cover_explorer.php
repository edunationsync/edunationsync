<?php session_start();
include '../Module.php';
$school_details=School::ReadSchoolDetails();

if(isset($_POST['btncheck'])){
  if(isset($_POST['txtregno'])){
    $regNo=$_POST['txtregno'];
  }
  if(isset($_POST['txtsession'])){
    $session=$_POST['txtsession'];
  }
  if(isset($_POST['txtclass'])){
    $class=$_POST['txtclass'];
  }
  if(isset($_POST['txtterm'])){
    $term=$_POST['txtterm'];
  }
  if(isset($_POST['txtpin'])){
    $pin=trim($_POST['txtpin']);
  }
  if(isset($_POST['txtserial'])){
    $serial=trim($_POST['txtserial']);
  }


  if($term=="Select" || $session=="Select")
  {
    $msg="Session and Term must be selected";    
  }
  elseif($class=="Select")
  {
    $msg="Select Class";
  }
  else
  { 
      $student=base64_encode($regNo);
      $session=base64_encode($session);
      $term=base64_encode($term);
      $class=base64_encode($class);
      $pin=$pin;
      $serial=$serial;
      
      header("location:cover_explorer.php?student=$student&session=$session&term=$term&class=$class");
  }
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
  <title>Cover Page Explorer</title>
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
  <style type="text/css">
    form{
      padding-left: 30px;
    }

    input[type=text], input[type=password],  select {
      width: 100%;
      border-bottom: 2px solid purple;
      border-top: none;
      border-left: none;
      border-right: none;
      background-color: transparent;
    }

    input[type=submit], input[type=reset] {
      font-size: 16px;
      padding: 4px 4px 4px 4px;
      width: 100%;
      border-radius: 5px;
      border-bottom: 2px solid purple;
      color: white;
      background-color: purple;
    }

    input[type=submit]:hover, input[type=reset]:hover
    {
      font-size: 16px;
      color: white;
      background-color: lightblue; color:black;
    }

    input[type=text]:hover, input[type=password]:hover,  select:hover
    {
      width: 100%;
      height: auto;
      border-bottom: 2px solid purple;
      color: white;
      background-color: lightblue; color:black;
    }
    label{
      font-weight: bolder;
      color: purple;
    }
    input[type=text]:focus, input[type=password]:focus,  select:focus
    {
      width: 100%;
      height: auto;
      border-bottom: 2px solid red;
      color: purple;
      font-weight: bolder;
      background-color: transparent;
    }
  </style>
  <script type="text/javascript">
    function loadsession(student)
    {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
          document.getElementById("sessionContainer").innerHTML = this.responseText;
        }
        else
        {
          document.getElementById("sessionContainer").innerHTML = "Loading...";
        }
      };
      xmlhttp.open("GET", "sessions.php?student="+student, true);
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
  


  <!-- Latest News -->

  <div class="news">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title_container text-center">
            <h2 class="section_title">Cover Page Explorer</h2>
          </div>
        </div>
      </div>
      <div class="row news_row">
        <div class="col-lg-7 news_col">
          
          <!-- News Post Large -->
          <div class="news_post_large_container">
            <div class="news_post_large">
              <div>
                <form   method="POST" action="?" >
                  <table>
                    <tr><th colspan="3" style="background-color: red; color:white; padding:5px 5px 5px 5px"><?php echo $msg; ?></th></tr>
                    <tr><td>
                      <label for="txtclass">Class</label>
                    </td><td>
                      <select id="txtclass" name="txtclass" required>
                        <?php                        
                        foreach(Module::ReadClasses() as $class)
                        {
                          echo "<option>".$class."</option>";
                        }
                        ?>
                      </select>
                    </td></tr>
                    <tr><td><label for="txtregno">Reg. No.</label></td><td colspan="2"><input type="text" name="txtregno" id="txtregno" required onkeyup="loadsession(document.getElementById('txtregno').value)"  ></td></tr>
                    <tr><td></td><td><label for="txtsession">Session</label></td><td><label for="txtterm">Term</label></td></tr>
                    <tr><td></td><td id="sessionContainer">
                      Enter Reg No
                    </td><td>
                      <select id="txtterm" name="txtterm" required>
                        
                        <option>First</option>
                        <option>Second</option>
                        <option>Third</option>
                      </select>
                    </td></tr>
                    <tr><td></td><td ><input type="reset" name="" value="Clear"></td><td><input type="submit" name="btncheck" id="btncheck" value="View Cover Page"></td></tr>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5 news_col">
          <div class="news_posts_small">

            <!-- News Posts Small -->
            <div class="news_post_small">
              <div class="news_post_small_title"><h4>Steps invoved in checking your result</h4></div>
              <div class="news_post_meta">
                <p>
                  <ol>
                    <li>Enter your Register Number</li>
                    <li>Select Session</li>
                    <li>Select Term</li>
                    <li>Click on View Result</li>
                  </ol>
                </p>
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
                    <a href="#">
                      <div class="footer_logo_text">T<span>I</span>S</div>
                    </a>
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
                      <li><a href="portal/">Results</a></li>
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