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
        <a href="pay_form.php?class=<?php echo $class; ?>&session=<?php echo $session; ?>&term=<?php echo $term; ?>&fee=<?php echo $fee-1; ?>"   class="navi" style="background: red;" > < PREV </a> 
        <a href="../"   class="navi" ><i class="fa fa-home"></i> Dashboard</a> 
        <a href="stndfees.php?class=<?php echo $class; ?>&session=<?php echo $session; ?>&term=<?php echo $term; ?>&s="   class="navi"  ><i class="fa fa-table"> Fee Explorer</i></a> <a href="reciept.php?class=<?php echo $class; ?>&session=<?php echo $session; ?>&term=<?php echo $term; ?>&fee=<?php echo $fee; ?>"   class="navi"  ><i class="fa fa-table"> Fee Reciept</i></a>
        <a  href="pay_form.php?class=<?php echo $class; ?>&session=<?php echo $session; ?>&term=<?php echo $term; ?>&fee=<?php echo $fee+1; ?>" class="navi" style="background: red;" > NEXT > </a> 
      </div>
      <div class="card-header">FEE PAYMENT FORM</div>
      <div class="card-header"><?php echo $msg; ?></div>
      <div class="panel panel-primary">
        <div style="background: green; color:white; font-weight: bolder; text-align: center">TRANSACTION SUMMARY</div> 
        <div class="panel-body">
          <div class="table-responsive">
              <table class="table table-condensed">
                  <thead>
                      <tr>
                          <td class="text-center"><strong>Amount</strong></td>
                          <td class="text-center"><strong>Total Paid</strong></td>
                          <td class="text-center"><strong>Balance</strong></td>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td class="text-center"><span id="txtAmount"><?php echo $amountDetails['total']; ?></span></td>
                          <td class="text-center"><span id="txtTotalPaid"><?php echo $feeDetails['total']; ?></span></td>
                          <td class="text-center"><span id="txtBalance"><?php echo $amountDetails['total']-$feeDetails['total']; ?></span></td>
                      </tr>
                  </tbody>
              </table>
          </div>
        </div>    
        <div class="panel-footer"><center><?php echo $feeDetails['timestamp']; ?></center></div>   
      </div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6"> 
              <input type="hidden" name="txtClass" id="txtClass" value="<?php echo $_GET['class'] ?>">
              <input type="hidden" name="txtSession" id="txtSession" value="<?php echo $session ?>">
              <input type="hidden" name="txtTerm" id="txtTerm" value="<?php echo $term; ?>">
                
              </div>


            </div>
            <center>
              <b><?php echo strtoupper($feeDetails['ref']) ?></b><br/>
              <img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 100px; border-radius: 5px;"><br/>
              <b><?php echo strtoupper($feeDetails['reg_no']) ?></b><br/>
              <b><?php echo strtoupper($studentDetails['names']) ?></b>
            </center>
          </div>
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  onkeyup="updateform()" id="txtRegFee" name="txtRegFee" class="form-control" placeholder="Reg. Fee"  value="<?php echo $feeDetails['reg_fee'] ?>">
                  <label for="txtRegFee">REGISTRATION FEE</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  onkeyup="updateform()" id="txtFee" name="txtFee" class="form-control" placeholder="School Fee"   value="<?php echo $feeDetails['fee'] ?>">
                  <label for="txtFee">School Fee</label>
                </div>
              </div>
            </div>
          </div>    
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  onkeyup="updateform()" id="txtBook" name="txtBook" class="form-control" placeholder="Book Cost"   value="<?php echo $feeDetails['book'] ?>">
                  <label for="txtBook">BOOK COST</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  onkeyup="updateform()" id="txtLesson" name="txtLesson" class="form-control" placeholder="Lesson Fee"  value="<?php echo $feeDetails['lesson'] ?>">
                  <label for="txtLesson">LESSON FEE</label>
                </div>
              </div>
            </div>
          </div>   

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  onkeyup="updateform()" id="txtPta" name="txtPta" class="form-control" placeholder="PTA FEE"   value="<?php echo $feeDetails['pta'] ?>">
                  <label for="txtPta">PTA FEE</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text"  onkeyup="updateform()" id="txtSCard" name="txtSCard" class="form-control" placeholder="Scratch Card"  value="<?php echo $feeDetails['scard'] ?>">
                  <label for="txtSCard">SCRATCH CARD</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="btnPay" id="btnPay" >Update Fees</button>
          <button type="reset" class="btn btn-danger btn-block" >Clear Fees</button>
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
