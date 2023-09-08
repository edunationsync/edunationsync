<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
//if(!(isset($Class)))
  $Session=$_GET['txtsession'];



  $Students=Module::ReadAlumniStudentsp_($Session);

//Messages
$UnredMessages=Message::ReadAllUnreadMessages($_SESSION['email']);
$Messages=Message::ReadAll($_SESSION['email']);
$NewMessages=Message::ReadAllUnreadMessages($_SESSION['email']);
$NewAlerts=Message::ReadAllUnreadAlerts($_SESSION['email']);
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

  <title>List of <?php echo $Class;?> Students for <?php echo $Session;?></title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

  <script type="text/javascript">
    function ToggleSellect(id)
    {
      if(document.getElementById(id+'chk').checked)
      {
        document.getElementById(id+'chk').checked=0;
        document.getElementById(id).style.background="white";
      }
      else
      {
        document.getElementById(id+'chk').checked=1;
        document.getElementById(id).style.background="orange";
      }

    }
  </script>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php"><img src="../../images/school/favicon.png" style="height: 50px"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="../../student_almanac.php">
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
        <p class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa- fa-f"></i>
          <span class="badge badge-danger"><?php if(count($NewAlerts)>10){ echo "10+";}else{echo count($NewAlerts);} ?></span>
        </a>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="messages.php" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger"><?php if(count($NewMessages)>10){ echo "10+";}else{echo count($NewMessages);} ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewAlerts)>0)
            {
              foreach($NewAlerts as $Alrt)
              {
                $alrtDetails=Message::ReadDetails($Alrt);
                ?>
                <a href="messages.php?id=<?php echo $alrtDetails['id']; ?>" title="<?php echo $alrtDetails['sender']; ?>"><div><?php echo $alrtDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="messages.php">View All</a>
          <a class="dropdown-item" href="?clearer=yes&type=alert">Clear Alerts</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
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
                <a href="messages.php?id=<?php echo $msgDetails['id']; ?>" title="Sent By: <?php echo $msgDetails['sender']; ?>"><div><?php echo $msgDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="messages.php">Show Messages</a>
          <a class="dropdown-item" href="?clearer=yes&type=message">Clear Messages</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
          if($_SESSION['lgina'])
          {
            ?>
            <img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 20px; height: 20px; border-radius: 100%;">
            <?php
          }
          else
          {
            ?>          
            <i class="fas fa-user-circle fa-fw"></i>
            <?php
          }
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="users/changepassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="users/changepassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="users"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php
      if(strtolower($_SESSION['post'])=="webmaster")
      {
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Admin</span>
          </a>
          
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Administration</h6>
            <a class="dropdown-item" href="../schema/">Database</a>
            <a class="dropdown-item" href="../messages.php">Messages</a>
          </div>
        </li>
        <?php
      }
      ?>   

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Menus</span>
        </a>
        
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Management</h6>
          <a class="dropdown-item" href="../../">Home Page</a>
          <a class="dropdown-item" href="../../admin">Management</a>
          <a class="dropdown-item" href="../../result/">Result</a>
        </div>
      </li>
      <?php
      foreach(Module::ReadStudentsSessions() as $session_)
      {
        if($session_==$_GET['txtsession'])
        {         
          ?>
          <li class="nav-item" style="background: white; color: black;">
            <a class="nav-link" href="allalumni.php?txtsession=<?php echo $session_; ?>">
              <i class="fas fa-fw fa-chart-area"></i>
              <span  style="background: white; color: black;"><?php echo $session_;?></span></a>
          </li>
          <?php
        }
        else
        {          
          ?>
          <li class="nav-item"  style="background: lightgreen; color: black;">
            <a class="nav-link" href="allalumni.php?txtsession=<?php echo $session_; ?>">
              <i class="fas fa-fw fa-chart-area"></i>
              <span   style="background: lightgreen; color: black;"><?php echo $session_;?></span></a>
          </li>
          <?php
        }
      }

      ?>
      

    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()" style="background: red; color: white; padding: 4px 4px 4px 4px; border-radius: 5px">Back</a>
          </li>
          <div style="padding-left: 25px">
            <a href="../../" title="Main Dashboard"><i class="fas fa-fw fa-home"></i> Home</a> | <a href="../../dashboard/" title="Main Dashboard">Dashboard</a> | <a href="../../admin" title="Admin Dashboard">Admin Dashboard</a> | <a href="../../result/">Result Dashboard</a> | <a href="../../admin/subject_library.php" title="Subject Library">Subjects</a> | <a href="../../dashboard/users/allalumni.php?txtsession=<?php echo $session; ?>" title="Old Students List">Alumni</a> | <a href="../../admin/student_subject_registration.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>" title="Subject registration for Students">Subject Registration</a> | <a href="../../admin/subject_allocation.php" title="Subject Allocation to Teachers">Subject Allocation</a> | <a href="../../admin/class_library.php" title="Class Library">Class Library</a> | <a href="../../admin/class_allocation.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>" title="Form Masters Class Allocation">Class Allocation</a>
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px">
            <a href="album.php">Album</a> | <a href="documents.php">Documents</a> | <a href="allstaff.php">Staff List</a> | <a href="../innovation">Innovation</a> | <a href="../messaging">Messaging</a> | <a href="../webmaster">Webmaster</a> | <a href="../grade_point">Grade Point</a> | <a href="../finance">Finance</a>
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <a href="registerstudent.php?txtclassp=<?php echo $_GET['txtclassp'] ?>"><i class="fas fa-user"> New Student</i></a> | <a href="allstudents_print.php?txtclassp=<?php echo $_GET['txtclassp'] ?>"><i class="fas fa-print"> Print Student List</i></a> | <a href="allstudentscontact_print.php?txtclassp=<?php echo $_GET['txtclassp'] ?>"><i class="fas fa-print"> Print Student Contact List</i></a></div>
            <?php $session_part=explode("/", $Session);?>
            <div><h1>These set of students graduated in <?php echo $session_part[0]+6; ?></h1></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>CMD</th>
                    <th>Passport</th>
                    <th>Status</th>
                    <th>Reg. No.</th>
                    <th>Name</th>
                    <th>Guardian</th>
                    <th>G. Email</th>
                    <th>G. Phone</th>
                    <th>Date of Birth</th>
                    <th>LGA</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Session</th>
                    <th>Password</th>
                    <th>Address</th>
                    <th>Date Admitted</th>
                    <th>Date Graduated</th>
                    <th>Time Registered</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>CMD</th>
                    <th>Passport</th>
                    <th>Status</th>
                    <th>Reg. No.</th>
                    <th>Name</th>
                    <th>Guardian</th>
                    <th>G. Email</th>
                    <th>G. Phone</th>
                    <th>Date of Birth</th>
                    <th>LGA</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Session</th>
                    <th>Password</th>
                    <th>Address</th>
                    <th>Date Admitted</th>
                    <th>Date Graduated</th>
                    <th>Time Registered</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                  echo "The total population of this class is ".count($Students);
                  echo "<br/>Active: ".count(Module::ReadStatusStudentsp("Active",$Session,$Class));
                  echo "<br/>Graduated: ".count(Module::ReadStatusStudentsp("Graduated",$Session,$Class));
                  echo "<br/>Dropout: ".count(Module::ReadStatusStudentsp("Dropout",$Session,$Class));
                  echo "<br/>Expelled: ".count(Module::ReadStatusStudentsp("Expelled",$Session,$Class));
                  foreach($Students as $Student)
                  {

                    $details=Module::ReadStudentDetailsp($Student);
                    
                    ?>
                    
                    <tr id="<?php echo $details['regno']; ?>" onclick="ToggleSellect('<?php echo $details["regno"]; ?>')" title="<?php echo $details['regno']; ?>">
                      <td ><input type="checkbox" name="<?php echo $details['regno']; ?>chk" id="<?php echo $details['regno']; ?>chk" ><a href="editstudentprofile.php?id=<?php echo $details['regno']; ?>&txtclassp=<?php echo $Class; ?>"><img src="../../images/icons/edit_icon.png" style=" height: 20px; "></a><a href="deletestudent.php?id=<?php echo $details['id']; ?>&txtclassp=<?php echo $Class; ?>"><img src="../../images/icons/delete_icon.png" style=" height: 20px; "></a></td>
                      <td><a href="changestudentpassport.php?id=<?php echo $details['regno']; ?>&class=<?php echo $Class; ?>"><img src="<?php echo 'data:image/jpeg;base64,'.$details['passport'];?>" style=" height: 80px; border-radius: 10%;"></a></td>
                      <td><?php echo $details['status']; ?></td>
                      <td><?php echo $details['regno']; ?></td>
                      <td><?php echo $details['names']; ?></td>
                      <td><?php echo $details['guardian']; ?></td>
                      <td><?php echo $details['g_email']; ?></td>
                      <td><?php echo $details['g_phone']; ?></td>
                      <td><?php echo $details['date_of_birth']; ?></td>
                      <td><?php echo $details['lga']; ?></td>
                      <td><?php echo $details['state']; ?></td>
                      <td><?php echo $details['country']; ?></td>
                      <td><?php echo $details['session']; ?></td>
                      <td><?php echo $details['password']; ?></td>
                      <td><?php echo $details['address']; ?></td>
                      <td><?php echo $details['date_admitted']; ?></td>
                      <td><?php echo $details['date_graduated']; ?></td>
                      <td><?php echo $details['timestamp']; ?></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Developed by Global Shining Digital Works (GSDW)</span>
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
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>

</body>

</html>
