<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$status=$_GET['status'];

if($_GET['type']=='available_cards')
{
  $Cards=Card::ReadAvailableCards();
}
elseif($_GET['type']=='used_cards')
{
  $Cards=Card::ReadUsedCards();
}
else{
  $Cards=Card::ReadAll();
}


/*
if(!isset($_SESSION['lgina']))
{
  header("location:../login.php");
}*/
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

  <title> <?php echo $schoolDetails['school_name']; ?> Scratch Card Print Preview</title>
  <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="../../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../dashboard/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <div id="wrapper">

    <div id="content-wrapper">

        <div class="container-fluid">
          <!-- Icon Cards-->
        <div class="row"> 
          <!--Scratch Card Content start-->
          <div class="card-body">
            <?php
            foreach($Cards as $id)
            {
              $scardDetails=Card::ReadDetails($id);
              $status=strtolower($scardDetails['status']);
              
              if(!($status=="used"))
              {
                ?>
                <div class="card" style="width:400px; float: left; margin: 10px 10px 10px 10px;">
                  <img class="card-img-top" src="../../images/scard_design.jpg" alt="Card image">
                  <div class="card-img-overlay" style="margin-top: 60px">
                    <h4 class="card-title" style="font-size: 15px; font-weight: bolder">PIN:  <?php echo $scardDetails['pin']; ?> </h4>
                    <p class="card-text" style="font-size: 15px; font-weight: bolder">SERIAL: <?php echo $scardDetails['serial']; ?></p>
                  </div>
                </div>
                <?php     
              }
            }
            ?>
          </div>
          <!--Scratch Card Content ends-->
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

<!-- The actual snackbar -->
<script src="../../js/attracta.js"></script>
</body>

</html>
