<?php session_start();

include 'Module.php';
$school_details=School::ReadSchoolDetails();
if(isset($_GET['src']))
{
	$Students=Module::SearchStudents($_GET['src']);
}
else
{		
	if(isset($_GET['class']))
	{
	  $class=$_GET['class'];
	}
	else
	{
	  $class="Basic 1";
	}

	$Students=Module::ReadClassStudentsp($class);
}
?>

<!DOCTYPE html>
<html lang="en">

<head> 
    <link rel="icon" type="image/png" href="images/school/favicon.png"/>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $school_details['school_name'];?> Students Almanac</title>
  <link rel="icon" type="image/png" href="images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="dashboard/css/sb-admin.css" rel="stylesheet">

  <style type="text/css">
    select{
      width: 98%;
    }
  </style>
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php"><img src="images/school/favicon.png"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="">
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
        
          <?php
          if($_SESSION['lgina'])
          {
            ?>
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 20px; height: 20px; border-radius: 100%;"></a><div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="../dashboard/users/changepassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="../dashboard/users/changepassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="../dashboard/users"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
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
    <ul class="sidebar navbar-nav" >
      <li class="nav-item active">
        <a class="nav-link" href="dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Home Page</span></a>
      </li> 
      <?php
      $Classes=Module::ReadClasses();
      foreach($Classes as $Class)
      {
        if($Class==$class)
        {
          ?>
          <li class="nav-item" style="background: white; color:black">
            <a class="nav-link" href="?class=<?php echo $Class; ?>">
              <i class="fas fa-fw fa-chart-area"></i>
              <span style="background: white; color:black"><?php echo $Class; ?></span></a>
          </li>
          <?php

        }
        else
        {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="?class=<?php echo $Class; ?>">
              <i class="fas fa-fw fa-chart-area"></i>
              <span><?php echo $Class; ?></span></a>
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
            <a href="#" onclick="window.history.back()">Back</a>
          </li>
          <li class="breadcrumb-item active"><?php echo $class; ?> Almanac</li>
          <li class="breadcrumb-item active">Total Match <?php echo count($Students); ?> Students</li>
        </ol>

        <!-- Icon Cards-->
      <div class="row"> 
        <?php

          foreach($Students as $Student)
          {
            $details=Module::ReadStudentDetailsp($Student)
            ?>
            <div class="col-lg-3 col-md-6 team_col">
              <div class="team_item">
                <?php
                  if($_SESSION['post']=="webmaster"||$_SESSION['post']=="examinar"||$_SESSION['post']=="headmistress"||$_SESSION['post']=="headmaster"||$_SESSION['post']=="principal")
                  {
                    ?>
                    <div class="team_image"><center><a href="dashboard/users/viewstudentprofile.php?id=<?php echo $Student; ?>&class=<?php echo $class; ?>"><img src="<?php echo 'data:image/jpeg;base64,'.$details['passport'];?>" style="width: 170px;height: 170px; border-radius: 10px; padding: 2px 2px 2px 2px">
                      <a href="dashboard/users/changestudentpassport.php?id=<?php echo $Student; ?>&class=<?php echo $class; ?>" title="View Passport" style="background: black; color: white; padding: 2px 2px 2px 2px ">Passport</a><a href="dashboard/users/viewstudentprofile.php?id=<?php echo $Student; ?>&class=<?php echo $class; ?>" title="View Profile" style="background: black; color: white; padding: 2px 2px 2px 2px ">Profile</a></a></center>
                    </div>
                    <?php
                  }
                  else
                  {
                    ?>
                    <div class="team_image"><center><a href="dashboard/users/viewstudentprofile.php?id=<?php echo $Student; ?>&class=<?php echo $class; ?>" title="View Profile"><img src="<?php echo 'data:image/jpeg;base64,'.$details['passport'];?>" style="width: 170px;height: 170px; border-radius: 10px; padding: 2px 2px 2px 2px"></a></center>
                    </div>
                    <?php
                  }
                  ?>


                
                <div class="team_body">
                  <div class="team_title" style="font-size: 16px"><center><b><?php echo strtoupper($Student); ?></b></center></div>
                  <div class="team_title" style="font-size: 16px"><center><b><?php echo strtoupper($details['names']); ?></b></center></div>
                  <div class="team_subtitle"><center><?php echo strtoupper($details['class']); ?></center></div>
                  <center><div  style="background: green; color: white; padding:2px 2px 2px 2px; width: 170px"><?php echo $details['date_admitted']; ?></div></center>
                </div>
              </div>
            </div>
            <?php
          }

          ?>
      </div>
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
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>



  <!-- Logout Modal-->
  <div class="modal fade" id="walletModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Profile Show <?php echo $_GET['regn'] ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="dashboard/vendor/jquery/jquery.min.js"></script>
  <script src="dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="dashboard/vendor/chart.js/Chart.min.js"></script>
  <script src="dashboard/vendor/datatables/jquery.dataTables.js"></script>
  <script src="dashboard/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="dashboard/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="dashboard/js/demo/datatables-demo1.js"></script>

  <!-- Result Javascript-->  
  <script src="js/result.js"></script>

</body>

</html>
