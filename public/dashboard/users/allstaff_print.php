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

  <title>Staff List Report</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">


    <!-- DataTables Example -->
    <style type="text/css">
      th{
        border: 2px solid black;
        text-transform: uppercase;
      }
      td{
        border: 2px solid black;
      }
    </style>
  <header>
    <b>
    <div class="bheader"><center><img src="../../images/school/logo.png" width="100px"><br/><b ><hd>DUBAI CARE SCHOOL</hd></b><br/>
      <hd1><?php echo $Session; ?> <?php echo strtoupper("$Class");  ?> COMPREHENSIVE STAFF LIST <br/><?php echo strtoupper("Printed on ".date("D M Y")) ?></center></div></b>
  </header>

    <table width="100%" cellspacing="0">
      <thead>
        <tr>
          <th></th>
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
      <tbody>
        <?php 
        $Workers=Module::ReadGeneralStaff();

        foreach($Workers as $Worker)
        {
          $details=Module::ReadStaffDetails($Worker);
          ?>
          <tr>
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

    <!-- /.container-fluid -->
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
