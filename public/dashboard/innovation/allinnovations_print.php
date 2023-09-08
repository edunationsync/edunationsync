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

  <title>My Innovations</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <div id="wrapper">


    <div id="content-wrapper">

      <div class="container-fluid">
       
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <a href="addinnovation.php"><i class="fas fa-user"> New Idea & Innovation</i></a> | <a href="myinnovations_print.php"><i class="fas fa-print"> Print Idea & Innovation List</i></a></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Cover Photo</th>
                    <th>Author Id</th>
                    <th>Author Category</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Innovation Type</th>
                    <th>Date</th>
                    <th>Timestamp</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Cover Photo</th>
                    <th>Author Id</th>
                    <th>Author Category</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Innovation Type</th>
                    <th>Date</th>
                    <th>Timestamp</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  $Innovations=Innovation::ReadAllInnovations();

                  foreach($Innovations as $innovation)
                  {
                    $details=Innovation::ReadDetails($innovation,$innovation_author_id,$innovation_title,$innovation_date);
                    ?>
                    <tr>
                      <td><?php echo $details['id']; ?></td>
                      <td><a href="viewinnovationdetail.php?id=<?php echo $details['id']; ?>"><img src="<?php echo 'data:image/jpeg;base64,'.$details['innovation_cover_photo'];?>" style=" height: 80px; border-radius: 10%;"></a></td>
                      <td><?php echo $details['innovation_author_id']; ?></td>
                      <td><?php echo $details['innovation_author_type']; ?></td>
                      <td><?php echo $details['innovation_title']; ?></td>
                      <td><?php echo $details['innovation_description']; ?></td>
                      <td><?php echo $details['innovation_type']; ?></td>
                      <td><?php echo $details['innovation_date']; ?></td>
                      <td><?php echo $details['innovation_timestamp']; ?></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">The following are my List of Ideas and Innovations</div>
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
