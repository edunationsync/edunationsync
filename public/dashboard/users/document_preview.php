<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

if(isset($_GET['deletebtn']))
{

  if(School::DeleteDocument($_GET['document_id']))
  {
    if(unlink("../../images/documents/".$_GET['delete_file_name']))
    {
      $msg=$_GET['delete_file_name']." was deleted Successfully";
    } 

    header("location:./documents.php?userid=".$_GET['userid']);   
  }
}

$album_key=$_GET['album_key'];

$image_id=$_GET['image_id'];

$documents=School::ReadAllDocuments($_SESSION['userid']);
if(count($documents)>0)
{
  $min_album_id=min($documents);
  $max_album_id=max($documents);  
  $total_albums=count($documents);
}
else
{
  $min_album_id=0;
  $max_album_id= 0;
  $total_albums=0;
}

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

  <title>Document Preview</title>

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

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()">Back</a> | <a href="document_upload_no.php?userid=<?php echo $_GET['userid']; ?>">Upload Document(s)</a> | <a href="documents.php?userid=<?php echo $_GET['userid'] ?>"> My Documents</a> 
          </li>
        </ol>
        <!-- DataTables Example -->
        <?php

        $documentdetails=School::ReadDocumentDetails($_GET['document_id']);
        $document_user_id=$documentdetails['document_user_id'];
        $document_upload_name=$documentdetails['document_upload_name'];
        $document_type=$documentdetails['document_type'];
        $document_institution_name=$documentdetails['document_institution_name'];
        $document_date_started=$documentdetails['document_date_started'];
        $document_date_ended=$documentdetails['document_date_ended'];
        $document_description=$documentdetails['document_description'];
        $userDetails=Module::ReadStaffDetails($document_user_id);
        
        $passport=$userDetails['passport'];
        $src=$document_upload_name;
        ?>
        <div  style="padding: 10px 10px 10px 10px; margin: 10px 10px 10px 10px; margin-bottom: 100px ">

          <center><img src="<?php echo $src; ?>" style="min-height: 300px;"></center>
          <div style="margin-left: 150px; background: lightgreen; padding: 8px 8px 8px 8px; min-height: 200px">
            <img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 180px; height: 180px; border-radius: 10px; float: left; margin-right: 10px ">
            <div><span  style="color: black; font-weight: bolder; "><?php echo $document_type; ?></span><br/><span  style="color: black;"><?php echo $document_institution_name ?></span><br/><span  style="color: black;"><?php echo $document_description ?></span><br/>
            <span  style=" color: black;"><?php echo $document_date_started." to ".$document_date_ended; ?></span></div>
          </div>
          <?php
          if($document_user_id==$_SESSION['userid']||$_SESSION['user_category']=="admin")
          {
            ?>
            <div style="margin-top: -90px; margin-left: 70px; width: 60px; height: 60px;">
              <a href="?deletebtn=yes&document_id=<?php echo $_GET['document_id']; ?>&userid=<?php echo $_GET['userid']; ?>"><button style="width: 100%; height: 100%"><img src="../../images/icons/delete_icon.png" style="width: 100%"></button></a>
            </div>
            <?php
          }

          ?>
          
        </div>
        <div class="card mb-3">
            <div>
              <?php
              
              if(count($documents)>0)
              {
                foreach($documents as $id)
                {
                  $documentdetails=School::ReadDocumentDetails($_GET['document_id']);
                  $document_user_id=$documentdetails['document_user_id'];
                  $document_upload_name=$documentdetails['document_upload_name'];
                  $document_type=$documentdetails['document_type'];
                  $document_institution_name=$documentdetails['document_institution_name'];
                  $document_date_started=$documentdetails['document_date_started'];
                  $document_date_ended=$documentdetails['document_date_ended'];
                  $document_description=$documentdetails['document_description'];

                  if($album_user_type=="student")
                  {
                    $userDetails=Module::ReadStudentDetailsp($document_user_id);
                  }
                  else
                  {
                    $userDetails=Module::ReadStaffDetails($document_user_id);
                  }
                  
                  $passport=$userDetails['passport'];
                  $src=$document_upload_name;
                  ?>
                  <div  style="padding: 10px 10px 10px 10px; margin: 10px 10px 10px 10px; height: 200px; width: 250px; float: left">
                    <a href="./document_preview.php?userid=<?php echo $_GET['userid'] ?>&document_id=<?php echo $id; ?>"><center><img src="<?php echo $src; ?>" style="width: 200px; height: 130px; padding: 10px 10px 10px 10px"></center></a>
                  </div>
                  <?php
                }
              }
              ?>
            </div>
          
        </div>

      </div>
      <!-- /.container-fluid -->
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
