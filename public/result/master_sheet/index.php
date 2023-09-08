<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
if(!($_SESSION['lgina']=="IN"))
  header("location:../../login.php");

$staff=$_SESSION['staffid'];
$currentSession=Module::ReadCurrentSession();
$session=$currentSession['session'];
$term=$currentSession['term'];

$allsessions=Module::ReadAllSessions();



?>

<!DOCTYPE html>
<html lang="en">

<head> 
  <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CA Sheet <?php echo $Subject.' '.$Class.' '.$Session.' '.$Term; ?></title>
  <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="../../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../dashboard/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">


  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../../index.php"><img src="../../images/school/favicon.png"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>


    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="../student_almanac.php">
      <div class="input-group">
        <input type="text" name="src" id="src" class="form-control" value="<?php echo $_GET['src']; ?>" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"><?php if(count($NewAlerts)>0){ echo $NewAlerts;} elseif(count($NewAlerts)>9){echo "9+";} ?></i>

        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewAlerts)>0)
            {
              foreach($NewAlerts as $Alerts)
              {
                $alertDetails=Message::ReadDetails($Alerts);
                ?>
                <a href="../../dashboard/messages.php?id=<?php echo $alertDetails['id']; ?>" title="Sent By: <?php echo $alertDetails['sender']; ?>"><div><?php echo $alertDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="../../dashboard/messages.php">Show Messages</a>
          <a class="dropdown-item" href="?clearer=yes&type=message">Clear Messages</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"><?php if(count($NewMessages)>0){ echo $NewMessages;} elseif(count($NewMessages)>9){echo "9+";} ?></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewMessages)>0)
            {
              foreach($NewMessages as $Msg)
              {
                $msgDetails=Message::ReadDetails($Msg);
                ?>
                <a href="../../dashboard/messages.php?id=<?php echo $msgDetails['id']; ?>" title="Sent By: <?php echo $msgDetails['sender']; ?>"><div><?php echo $msgDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="../../dashboard/messages.php">Show Messages</a>
          <a class="dropdown-item" href="?clearer=yes&type=message">Clear Messages</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
      <li class="nav-item dropdown no-arrow">
        
          <?php
          if($_SESSION['lgina'])
          {
            ?>
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 20px; height: 20px; border-radius: 100%;"></a><div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="../../dashboard/users/changepassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="../../dashboard/users/changepassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="../../dashboard/users/viewstaffprofile.php"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
            <?php
          }
          else
          {
            ?>          
            <i class="fas fa-user-circle fa-fw"></i>
            <?php
          }
          ?>
        
        
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../../dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item" style="border-bottom: 4px groove white">
        <a class="nav-link" href="../../index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home Page</span></a>
      </li>
      <li class="nav-item" style="border-bottom: 4px groove white">
        <a class="nav-link" href="../../student_almanac.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Student Almanac</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()">Back</a>
          </li>
          <div style="padding-left: 25px">
            <a href="../../dashboard/users/allstudents.php?txtclassp=<?php echo $Class; ?>">Students</a> <a href="../../result/psychomotorp.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>">Ratings</a> <a href="../master_sheetp.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">Master Sheet</a> <a href="../../portal/allresultsp.php?prclass=<?php echo $Class; ?>&prsession=<?php echo $Session; ?>&prterm=<?php echo $Term; ?>">Result Sheets</a> <a href="ca_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>">All CA Sheets</a> <a href="ca_post_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>"> All Post CA Sheets</a> <a href="ca_score_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>" title="Print All CA Score Sheet for this class">All Score Sheets</a>
          </div>
        </ol><!-- Breadcrumbs-->
        <!-- Icon Cards-->
        <!--CA Sheet Content start-->
        <div id="content1">
          <div class="features">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="section_title_container text-center">
            <h2 class="section_title">Welcome to the Master's Sheet Gallary</h2>
            <div class="section_subtitle"><p>This platform is the greatest tool for effective reporting of the students' performance. </p>
            </div>
          </div> 
        </div>
      </div>

      <div>
        <div class="row features_row">  

          <?php 
          if($_SESSION['post']=="webmaster"||$_SESSION['post']=="examinar"||$_SESSION['post']=="exams & records"||$_SESSION['post']=="teacher")
          {
            ?>

            <!-- Features Item -->
            <div class="col-lg-3 feature_col">
              <div class="feature text-center trans_400">
                <div class="feature_icon"><img src="images/icon_2.png" alt=""></div>
                <h3 class="feature_title">1<sup>st</sup> CA Master</h3>
                <div class="feature_text"><p>Select Class and Click on Open</p></div>
                <form id='ca1_master_sheet' action="master_sheet_ca1.php" method="GET">
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
                                      if($_SESSION['post']=="examinar"||$_SESSION['post']=="exams and records"||$_SESSION['post']=="webmaster")
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
                <h3 class="feature_title">2<sup>nd</sup> CA Master</h3>
                <div class="feature_text"><p>Select Class and Click on Open</p></div>
                <form id='ca2_master_sheet' action="master_sheet_ca2.php" method="GET">
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
                                    if($_SESSION['post']=="examinar"||$_SESSION['post']=="exams and records"||$_SESSION['post']=="webmaster")
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
                <h3 class="feature_title">Exam Master</h3>
                <div class="feature_text"><p>Select Class and Click on Open</p></div>
                <form id='ca2_master_sheet' action="master_sheet_exam.php" method="GET">
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
                                    if($_SESSION['post']=="examinar"||$_SESSION['post']=="exams and records"||$_SESSION['post']=="webmaster")
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
                <form id='master_sheet_form' action="master_sheetp.php" method="GET">
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
                                    if($_SESSION['post']=="examinar"||$_SESSION['post']=="exams and records"||$_SESSION['post']=="webmaster")
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
                <h3 class="feature_title">Individual Result Verifier</h3>
                <div class="feature_text"><p>Select Class and Click on Open</p></div>
                <form id='master_sheet_form' action="individual_student_resultp.php" method="GET">
                  <table>
                    <tr>
                      <td><label for="session">Session</label></td>
                      <td>
                        <select name="session" id="session" class="submit" required>
                          <?php 
                          foreach($allsessions as $session)
                          {
                            ?>
                            <option><?php echo $session; ?></option>
                            <?php
                          }

                          ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td><label for="term">Term</label></td>
                      <td><select name="term" id="term" class="submit" required>     
                        <option>First</option>                              
                        <option>Second</option>                             
                        <option>Third</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td><label for="class">Class</label></td>
                      <td><select name="class" id="class" class="submit" required>
                        <?php
                        if($_SESSION['post']=="examinar"||$_SESSION['post']=="exams and records"||$_SESSION['post']=="webmaster")
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
        <!--CA Sheet Content ends-->
      <!-- /.container-fluid -->
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © GSDW</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../dashboard/vendor/jquery/jquery.min.js"></script>
  <script src="../../dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../../dashboard/vendor/chart.js/Chart.min.js"></script>
  <script src="../../dashboard/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../../dashboard/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../dashboard/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../../dashboard/js/demo/datatables-demo1.js"></script>


  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <div id="preloader" style="display: none">
    <div id="loader"></div>
  </div>


<script src="../../js/attracta.js"></script>
</body>

</html>
