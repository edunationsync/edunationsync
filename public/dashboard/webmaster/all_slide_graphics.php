<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

if(isset($_GET['deletebtn']))
{
  if(School::DeleteSlide($_GET['id']))
  {
    if(unlink("../../images/slideimages/".$_GET['delete_file_name']))
    {
      $msg=$_GET['delete_file_name']." was deleted Successfully";
      header("location:./all_slide_graphics.php");
    }
  }
  
}
  
if(isset($_POST['btnAddSlide']))
{
  $filename=$_FILES['image_id']['name'];  
  $ext=substr($filename, strpos($filename, '.'));

  $name = str_replace(' ', '_', $_POST['name']);
  $path = "../../images/slideimages/".$name.$ext;
  if(move_uploaded_file($_FILES['image_id']['tmp_name'], $path)) 
  {      
    $file_name=$path;
  } 
  $slidename=$name.$ext;
  $slidedescription=$_POST['description'];
  if(!(School::IsSlideExist($slidename)))
  {    
      if(School::AddNewSlide($slidename, $slidedescription))
      {
        $msg="Slide Image was added successfully";
      }  
      else
      {
        $msg="Slide Image was not added successfully";
      }
  }
  else
  {
    $msg="Slide Image already existed";
  }
}

$AllSlides=School::ReadAllSlides();


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

  <title>Slide Management Dashboard</title>

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
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()">Back</a>
          </li>
          <li class="breadcrumb-item active">Slide Management Dashboard</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div><?php echo $msg; ?></div>
          <div style="background: red; padding: 4px 4px 4px 4px; color: white; font-weight: bolder;">NOTE: The Image to upload should be 700px by 500px </div>
          <div class="card-header">
            <a href="registerstudent.php?txtclassp=<?php echo $_GET['txtclassp'] ?>"><i class="fas fa-user"> New Slide Image</i></a>
            <form  enctype="multipart/form-data" method="POST" action="">
                  <input type="file" id="image_id" name="image_id" class="form-control" required="required">
                  <input type="text" id="name" name="name" class="form-control" placeholder="Slide Name" autofocus="autofocus" required="required">
                  <textarea id="description" name="description" class="form-control" placeholder="Description"></textarea>
              <button type="submit" class="btn btn-primary btn-block" name="btnAddSlide" id="btnAddSlide" >Add Slide Image</button>
            </form>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>CMD</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Timestamp</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>CMD</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Timestamp</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  echo "The total slide images are ".count($AllSlides);
                  foreach($AllSlides as $Slide)
                  {
                    $details=School::ReadSlidesDetails($Slide);                    
                    ?>
                    
                    <tr id="<?php echo $details['id']; ?>" onclick="ToggleSellect('<?php echo $details["id"]; ?>')" title="<?php echo $details['id']; ?>">
                      <td >
                        <a href="?deletebtn=true&delete_file_name=<?php echo $details['name']; ?>&id=<?php echo $details['id']; ?>"><img src="../../images/icons/delete_icon.png" style=" height: 20px; "></a>
                      </td>

                      <td><a href="<?php echo '../../images/slideimages/'.$details['name']; ?>"><img src="<?php echo '../../images/slideimages/'.$details['name']; ?>" style=" height: 80px; border-radius: 10%;"></a></td>
                      <td><?php echo $details['name']; ?></td>
                      <td><?php echo $details['description']; ?></td>
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
