<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();



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

  <title>Staff Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

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
          <a class="dropdown-item" href="changestaffpassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="changestaffpassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="viewstaffprofile.php"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
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
      <li class="nav-item">
        <a class="nav-link" href="../../">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Home Page</span></a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="../../admin/">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Portal</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../result/">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Result</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $school_details['school_blog'] ?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Blog</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $school_details['school_facebook'] ?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Facebook</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $school_details['school_linkedin'] ?>">
          <i class="fas fa-fw fa-table"></i>
          <span>LinkedIn</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $school_details['school_tweeter'] ?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Twitter</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()" style="background: red; color: white; padding: 4px 4px 4px 4px; border-radius: 5px">Back</a>
          </li>
          <div style="padding-left: 25px">
            <a href="../../" title="Main Dashboard"><i class="fas fa-fw fa-home"></i> Home</a> | <a href="../../dashboard/" title="Main Dashboard">Dashboard</a> | <a href="../../admin" title="Admin Dashboard">Admin Dashboard</a> | <a href="../../result/">Result Dashboard</a> | <a href="../../admin/subject_library.php" title="Subject Library">Subjects</a> | <a href="../../dashboard/users/allstudents.php?txtclassp=<?php echo $Class; ?>" title="Students List">Students</a> | <a href="../../admin/student_subject_registration.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>" title="Subject registration for Students">Subject Registration</a> | <a href="../../admin/subject_allocation.php" title="Subject Allocation to Teachers">Subject Allocation</a> | <a href="../../admin/class_library.php" title="Class Library">Class Library</a> | <a href="../../admin/class_allocation.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>" title="Form Masters Class Allocation">Class Allocation</a>
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
            <a href="registerstaff.php"><i class="fas fa-user"> New Staff</i></a> | <a href="allstaff_print.php"><i class="fas fa-print"> Print Staff List</i></a> | <a href="allstaff_print_simple.php"><i class="fas fa-print"> Print Staff List Simple</i></a></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th></th>
                    <th>Passport</th>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>User Type</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Post</th>
                    <th>Status</th>
                    <th>SGL</th>
                    <th>Date Employed</th>
                    <th>Date Resigned</th>
                    <th>Password</th>
                    <th>Address</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Passport</th>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>User Type</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Post</th>
                    <th>Status</th>
                    <th>SGL</th>
                    <th>Date Employed</th>
                    <th>Date Resigned</th>
                    <th>Password</th>
                    <th>Address</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                  $Workers=Module::ReadGeneralStaff();

                  foreach($Workers as $Worker)
                  {
                    $details=Module::ReadStaffDetails($Worker);
                    ?>
                    <tr>
                      <td><a href="user_dashboard.php?userid=<?php echo $details['staff_id']; ?>" style=" height: 80px; border-radius: 10%;">Dashboard</a><br/><a href="viewstaffprofile.php?id=<?php echo $Worker; ?>" style=" height: 80px; border-radius: 10%;">Profile</a><br/><a href="delete_staff.php?id=<?php echo $Worker; ?>" style=" height: 80px; border-radius: 10%;">Delete</a></td>
                      <td><a href="viewstaffprofile.php?id=<?php echo $details['id']; ?>"><img src="<?php echo 'data:image/jpeg;base64,'.$details['passport'];?>" style=" height: 80px; border-radius: 10%;"></a></td>
                      <td><?php echo $details['staff_id']; ?></td>
                      <td><?php echo $details['names']; ?></td>
                      <td><?php echo $details['sex']; ?></td>
                      <td><?php echo $details['user_type']; ?></td>
                      <td><?php echo $details['phone']; ?></td>
                      <td><?php echo $details['email']; ?></td>
                      <td><?php echo $details['post']; ?></td>
                      <td><?php echo $details['status']; ?></td>
                      <td><?php echo $details['sgl']; ?></td>
                      <td><?php echo $details['date_employed']; ?></td>
                      <td><?php echo $details['date_resigned']; ?></td>
                      <td><?php echo $details['password']; ?></td>
                      <td><?php echo $details['address']; ?></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">The list of staffs of this noble schools</div>
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
