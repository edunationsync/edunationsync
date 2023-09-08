<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$ref=$_GET['ref'];
$voucherDetails=Finance::ReadFeeDetails($_GET['id']);
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

  <title>Salary Details</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 

      <div style="padding: 20px 20px 20px 20px">
        <a href="../index.php"   class="navi" ><i class="fa fa-home"></i> Dashboard</a>
      </div>
      
      <div class="card-header">Your Salary Information</div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">

          <div class="form-group">
            <div class="form-label-group">
              <table width="100%">


                <tr><td>REF</td><th><?php echo $voucherDetails['ref']; ?></th></tr>
                <tr><td>CLASS</td><th><?php echo $voucherDetails['class']; ?></th></tr>
                <tr><td>SESSION</td><th><?php echo $voucherDetails['session']; ?></th></tr>
                <tr><td>1<sup>ST</sup></td><th><?php echo $voucherDetails['firstterm']; ?></th></tr>
                <tr><td>2<sup>ND</sup> TERM</td><th><?php echo $voucherDetails['secondterm']; ?></th></tr>
                <tr><td>3<sup>RD</sup></td><th><?php echo $voucherDetails['thirdterm']; ?></th></tr>
                <tr><td>PTA</td><th><?php echo $voucherDetails['pta']; ?></th></tr>
                <tr><td>LESSON FEE</td><th><?php echo $voucherDetails['lesson_fee']; ?></th></tr>
                <tr><td>NOTEBOOKS</td><th><?php echo $voucherDetails['notebooks']; ?></th></tr>
                <tr><td>ENGLISH TEXT</td><th><?php echo $voucherDetails['english_book']; ?></th></tr>
                <tr><td>MATHS TEXT</td><th><?php echo $voucherDetails['maths_book']; ?></th></tr>
                <tr><td>QUANTITATIVE</td><th><?php echo $voucherDetails['quant_book']; ?></th></tr>
                <tr><td>VERBAL TEXT</td><th><?php echo $voucherDetails['verbal_book']; ?></th></tr>
                <tr><td>LACOMBE TEXT</td><th><?php echo $voucherDetails['lacombe_book']; ?></th></tr>
                <tr><td>WRITING TEXT</td><th><?php echo $voucherDetails['writing_book']; ?></th></tr>
                <tr><td>QUEEN PRIMA TEXT</td><th><?php echo $voucherDetails['queen_prima_book']; ?></th></tr>
                <tr><td>1<sup>ST</sup> PUPILS FOUNDATION</td><th><?php echo $voucherDetails['firstpf']; ?></th></tr>
                <tr><td>2<sup>ND</sup> PUPILS FOUNDATION</td><th><?php echo $voucherDetails['secondpf']; ?></th></tr>
                <tr><td>3<sup>RD</sup> PUPILS FOUNDATION</td><th><?php echo $voucherDetails['thirdpf']; ?></th></tr>
                <tr><td>AMOUNT</td><th><?php echo $voucherDetails['amount']; ?></th></tr>
                <tr><td>BALANCE</td><th><?php echo $voucherDetails['balance']; ?></th></tr>
                <tr><td>STATUS</td><th><?php echo $voucherDetails['status']; ?></th></tr>
                <tr><td>DATE & TIME</td><th><?php echo $voucherDetails['timestamp']; ?></th></tr>

              </table>              
              
            </div>
          </div>


        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
