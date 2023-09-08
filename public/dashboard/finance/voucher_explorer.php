<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$class=$_GET['class'];
$session=$_GET['session'];
$term=$_GET['term'];
$fee=$_GET['fee'];

$feeDetails=Finance::ReadFee_PayDetails($fee);
$studentDetails=Module::ReadStudentDetailsp($feeDetails['reg_no']);
$passport=$studentDetails['passport'];
$amountDetails=Finance::ReadFee_Pay_AmountTermDetails($class,$session,$term);

if(isset($_POST['btnPay']))
{

  if(Finance::UpdateFee_Payment($fee,$feeDetails['reg_no'],$feeDetails['ref'],$class,$session,$term,$_POST['txtRegFee'],$_POST['txtFee'],$_POST['txtBook'],$_POST['txtPta'],$_POST['txtSCard'],$_POST['txtLesson']))
  {
    $msgh="Modified Successfully";
  }
  else
  {
    $msgh="Not Modified Successfully";
  }
}

$feeDetails=Finance::ReadFee_PayDetails($fee);
$studentDetails=Module::ReadStudentDetailsp($feeDetails['reg_no']);
$passport=$studentDetails['passport'];


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

  <title>Fee Form</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <script type="text/javascript">

    function trimvalue(value)
    {
      if(value.substr(value.length-4)=="<br>")
      {
        value=value.substr(0,value.length-4);
      }
      return value;
    }

    function updateform()
    {
      var txtRegFee=document.getElementById('txtRegFee').value||0;
      var txtFee=document.getElementById('txtFee').value||0;
      var txtBook=document.getElementById('txtBook').value||0;
      var txtLesson=document.getElementById('txtLesson').value||0;
      var txtPta=document.getElementById('txtPta').value||0;
      var txtSCard=document.getElementById('txtSCard').value||0;
      var Amount=document.getElementById('txtAmount').innerHTML;

      TotalPaid= eval(txtRegFee)+eval(txtFee)+eval(txtBook)+eval(txtLesson)+eval(txtPta)+eval(txtSCard);

      document.getElementById('txtTotalPaid').innerHTML=eval(TotalPaid);
      document.getElementById('txtBalance').innerHTML=Amount-eval(TotalPaid);

      
    }
  </script>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
        <a href="../"   class="navi" ><i class="fa fa-home"></i> Dashboard</a> 
        <a href="./"   class="navi" ><i class="fa fa-home"></i> Fees Dashboard</a> 
        <a href="fee_amounts.php"   class="navi" ><i class="fa fa-home"></i> Fees Amounts</a> 
      </div>
      <div class="card-header">FEES EXPLORATION FORM</div>
      <div class="card-header"><?php echo $msg; ?></div>
     
      <div class="card-body">
        <form  enctype="multipart/form-data" method="GET" action="stndvoucher.php">
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <select id="month" name="month" class="form-control" placeholder="Session">
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>Novermber</option>
                    <option>December</option>              
                  </select>
                  <label for="month">Month</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="year" value="<?php echo date('Y') ?>">
                  <label for="year">Year</label>
                </div>
              </div>
            </div>
          </div>    
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group"> 
                  <button type="submit" class="btn btn-primary btn-block" name="s" id="s" >Open Voucher</button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <button type="reset" class="btn btn-danger btn-block" >Clear Form</button>
                </div>
              </div>
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
