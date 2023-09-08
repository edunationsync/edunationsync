<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
//if(!(isset($Class)))
  $Class=$_GET['txtclassp'];

//if(!(isset($Session)))
  $Session=Module::GetClassSessionp($Class);

if($Class=='')
{
  //if(!(isset($Students)))
  $Students=Module::ReadAllStudentsp();
}
else
{
  //if(!(isset($Students)))
  $Students=Module::ReadAllSessionStudentsp($Session,$Class);
}


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

  <title><?php echo $Session;?> <?php echo $Class;?> STUDENT LIST</title>

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
      <hd1><?php echo $Session; ?> <?php echo strtoupper("$Class");  ?> STUDENT LIST <br/><?php echo strtoupper("Printed on ".date("D M Y")) ?></center></div></b>
  </header>
    <table width="100%" cellspacing="0" style="padding: 15px 15px 15px 15px">
      <thead>
        <tr>
          <th></th>
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
      <tbody>
        <?php 
        foreach($Students as $Student)
        {

          $details=Module::ReadStudentDetailsp($Student);
          
          ?>
          
          <tr id="<?php echo $details['regno']; ?>" onclick="ToggleSellect('<?php echo $details["regno"]; ?>')" title="<?php echo $details['regno']; ?>">
            
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
