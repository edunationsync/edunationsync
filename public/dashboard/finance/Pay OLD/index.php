<?php session_start();
include '../../../Module.php';
$session=$_GET['session'];
$term=$_GET['term'];
$reg_no=$_SESSION['userid'];

$studentDetails=Module::ReadStudentDetailsp($reg_no);

$class=$studentDetails['class'];

$feeAmountDetails=Finance::ReadFee_Pay_AmountTermDetails($class,$session,$term);
$feeDetails=Finance::ReadStudentFee_PayDetails($reg_no,$session,$term)

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
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    

    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>


  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <script type="text/javascript">

    function addfee(id,fee)
    {
      var amount=document.getElementById('amount').innerHTML;
      var total=document.getElementById('total').innerHTML;
      var balance=document.getElementById('balance').innerHTML;

      balance=amount-total;
      var status=document.getElementById(id);
      if(status.checked)
      {
        total=eval(total)+eval(fee);
        balance=eval(balance)-eval(fee);
      }
      else
      {
        total=eval(total)-eval(fee);
        balance=eval(balance)+eval(fee);
      }
      
      document.getElementById('amount').innerHTML=amount;
      document.getElementById('total').innerHTML=total;
      document.getElementById('balance').innerHTML=balance;
    }

    function trimvalue(value)
    {
      if(value.substr(value.length-4)=="<br>")
      {
        value=value.substr(0,value.length-4);
      }
      return value;
    }    
  </script>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
        <a href="../../"   class="navi" ><i class="fa fa-home"></i> Dashboard</a> 
        <a href="../"   class="navi" ><i class="fa fa-home"></i> Fees Dashboard</a> 
      </div>
      <div class="card-header"  style="background: green; color:white; font-weight: bolder; text-align: center">FEES PAYMENT SLIP</div>
      <?php
      if($studentDetails['g_phone']=="null")
      {
        ?>
        <div class="card-header"  style="background: red; color:white; font-weight: bolder; text-align: center">You must update your profile Phone Number</div>
        <?php
      }
      elseif($studentDetails['g_email']=="null")
      {
        ?>
        <div class="card-header"  style="background: red; color:white; font-weight: bolder; text-align: center">You must update your profile Email Address</div>
        <?php
      }
      else
      {
        ?>
        <div class="panel panel-primary">
          <table class="table table-condensed">
            <thead>
                <input type="hidden" name="reg_no" id="reg_no" value="<?php echo $reg_no; ?>" title="Register Number">
                <input type="hidden" name="phone" id="phone" value="<?php echo $studentDetails['g_phone']; ?>" title="Phone Number">
                <input type="hidden" name="email" id="email" value="<?php echo $studentDetails['g_email']; ?>" title="Email Address">

                <tr><td class="text-center" rowspan="4"><img src="<?php echo 'data:image/jpeg;base64,'.$studentDetails['passport'];?>" style="width: 120px; border-radius: 5px;"><br/></td></tr>
                <tr><td class="text-left"><strong><span><?php echo $reg_no; ?></span></strong></td>
                    <td class="text-left"><strong><span><?php echo $studentDetails['names']; ?></span></strong></td>
                    <td class="text-left"><strong><span><?php echo $studentDetails['class']; ?></span></strong></td></tr>
                <tr/><td class="text-left"><strong>
                  <div class="form-label-group">
                    <select id="session" name="session" class="form-control" title="Session">
                      <?php
                      $sessions=Module::ReadAllSessions();
                      foreach($sessions as $session)
                      {
                        ?>
                        <option><?php echo $session; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                    <label for="session">Session</label>
                  </div></strong></td>
                    <td class="text-left"><strong>
                  <div class="form-label-group">
                    <select id="term" name="term" class="form-control" title="Term">
                      <option>First</option>
                      <option>Second</option>
                      <option>Third</option>
                    </select>
                    <label for="term">Term</label>
                  </div></strong></td>
                    <td class="text-left"><strong>
                  <div class="form-label-group">
                    <select id="class" name="class" class="form-control" placeholder="Class">
                      <?php
                      $classes=Module::ReadAllClassesp();
                      foreach($classes as $class)
                      {
                        ?>
                        <option><?php echo $class; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                    <label for="class">Class</label>
                  </div></strong></td>
                </tr>
            </thead>
          </table>
        </div>
        <div class="card-body">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <?php 
                    if($feeDetails['lesson']>=$feeAmountDetails['lesson'])
                    {                      
                      ?>
                      <div style="background: lightpink; text-align: center; font-weight: bolder; padding: 20px 20px 20px 20px">You have paid Lesson Fee</div><label for="lesson"> Lesson </label><br/>
                      <?php
                    }
                    else
                    {
                      ?>
                      <div style="background: lightgreen; text-align: center; font-weight: bolder"><?php echo $feeAmountDetails['lesson']-$feeDetails['lesson']; ?><input type="checkbox" onchange="addfee(this.id,<?php echo $feeAmountDetails['lesson']-$feeDetails['lesson']; ?>)" name="lesson" id="lesson"  class="form-control" value="<?php echo $feeAmountDetails['lesson']-$feeDetails['lesson']; ?>"></div><label for="lesson"> Lesson </label><br/>
                      <?php
                    }

                    ?>                    

                    <?php 
                    if($feeDetails['pta']>=$feeAmountDetails['pta'])
                    {                      
                      ?>
                      <div style="background: lightpink; text-align: center; font-weight: bolder; padding: 20px 20px 20px 20px">You have paid PTA Fee</div><label for="pta"> PTA </label><br/>
                      <?php
                    }
                    else
                    {
                      ?>
                      <div style="background: lightgreen; text-align: center; font-weight: bolder"><?php echo $feeAmountDetails['pta']-$feeDetails['pta']; ?><input type="checkbox" onchange="addfee(this.id,<?php echo $feeAmountDetails['pta']-$feeDetails['pta']; ?>)" name="pta" id="pta"  class="form-control" value="<?php echo $feeAmountDetails['pta']-$feeDetails['pta']; ?>"></div><label for="pta"> PTA </label><br/>
                      <?php
                    }

                    ?>                   

                    <?php 
                    if($feeDetails['scard']>=$feeAmountDetails['scard'])
                    {                      
                      ?>
                      <div style="background: lightpink; text-align: center; font-weight: bolder; padding: 20px 20px 20px 20px">You have paid Scratch Card Fee</div><label for="scard"> Scratch Card </label><br/>
                      <?php
                    }
                    else
                    {
                      ?>
                      <div style="background: lightgreen; text-align: center; font-weight: bolder"><?php echo $feeAmountDetails['scard']-$feeDetails['scard']; ?><input type="checkbox" onchange="addfee(this.id,<?php echo $feeAmountDetails['scard']-$feeDetails['scard']; ?>)" name="scard" id="scard"  class="form-control" value="<?php echo $feeAmountDetails['scard']-$feeDetails['scard']; ?>"></div> <label for="scard">Scratch Card </label><br/>
                      <?php
                    }

                    ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group"> 


                    <?php 
                    if($feeDetails['reg_fee']>=$feeAmountDetails['reg_fee'])
                    {                      
                      ?>
                      <div style="background: lightpink; text-align: center; font-weight: bolder; padding: 20px 20px 20px 20px">You have paid Registration Fee</div><label for="reg_fee"> Registration Fee </label><br/>
                      <?php
                    }
                    else
                    {
                      ?>
                      <div style="background: lightgreen; text-align: center; font-weight: bolder"><?php echo $feeAmountDetails['reg_fee']-$feeDetails['reg_fee']; ?><input type="checkbox" onchange="addfee(this.id,<?php echo $feeAmountDetails['reg_fee']-$feeDetails['reg_fee']; ?>)" name="reg_fee" id="reg_fee"  class="form-control" value="<?php echo $feeAmountDetails['reg_fee']-$feeDetails['reg_fee']; ?>"></div><label for="reg_fee"> Reg Fee </label><br/>
                      <?php
                    }

                    ?>              

                    <?php 
                    if($feeDetails['book']>=$feeAmountDetails['book'])
                    {                      
                      ?>
                      <div style="background: lightpink; text-align: center; font-weight: bolder; padding: 20px 20px 20px 20px">You have paid for Books </div><label for="book"> Books </label><br/>
                      <?php
                    }
                    else
                    {
                      ?><div style="background: lightgreen; text-align: center; font-weight: bolder"><?php echo $feeAmountDetails['book']-$feeDetails['book']; ?><input type="checkbox" onchange="addfee(this.id,<?php echo $feeAmountDetails['book']-$feeDetails['book']; ?>)" name="book" id="book"  class="form-control" value="<?php echo $feeAmountDetails['book']-$feeDetails['book']; ?>"></div><label for="book"> Books </label><br/>
                      <?php
                    }

                    ?>              

                    <?php 
                    if($feeDetails['fee']>=$feeAmountDetails['fee'])
                    {                      
                      ?>
                      <div style="background: lightpink; text-align: center; font-weight: bolder; padding: 20px 20px 20px 20px">You have paid School Fee</div><label for="fee"> School Fee </label><br/>
                      <?php
                    }
                    else
                    {
                      ?>
                      <div style="background: lightgreen; text-align: center; font-weight: bolder"><?php echo $feeAmountDetails['fee']-$feeDetails['fee']; ?><input type="checkbox" onchange="addfee(this.id,<?php echo $feeAmountDetails['fee']-$feeDetails['fee']; ?>)" name="fee" id="fee"  class="form-control" value="<?php echo $feeAmountDetails['fee']-$feeDetails['fee']; ?>"></div><label for="fee"> School Fee </label><br/>
                      <?php
                    }

                    ?>
                  </div>
                </div>
              </div>
            </div>
          <div style="background: lightpink">
            <div style="background: red; color:white; font-weight: bolder; text-align: center">TRANSACTION SUMMARY</div> 
              <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-condensed">
                      <thead  style="background: lightblue; color:black; font-weight: bolder; text-align: center">
                          <tr>
                              <td class="text-center"><strong>Amount</strong></td>
                              <td class="text-center"><strong>Total Paid</strong></td>
                              <td class="text-center"><strong>Balance</strong></td>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td class="text-center">N<span name="amount" id="amount"><?php echo $feeAmountDetails['total']; ?></span></td>
                            <td class="text-center">N<span name="total" id="total"><?php echo $feeDetails['total']; ?></span></td>
                            <td class="text-center">N<span name="balance" id="balance"><?php echo $feeAmountDetails['total']-$feeDetails['total']; ?></span></td>
                          </tr>
                      </tbody>
                    </table>
                </div>
              </div>   
          </div>         
          <div class="panel-footer" style="background: green; color:white; font-weight: bolder; text-align: center"><center><?php echo $feeDetails['timestamp']; ?></center></div>   
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <button class="btn btn-primary btn-block"  onclick="payChargeWithPaystack(document.getElementById('reg_no').value,document.getElementById('session').value,document.getElementById('term').value,document.getElementById('class').value,document.getElementById('phone').value,document.getElementById('email').value,document.getElementById('total').innerHTML-<?php echo $feeDetails['total'] ?>)">Continue</button>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group"> 
                    
                    <button class="btn btn-danger btn-block" >Cancel</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <?php
      }

      ?>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="paymentscript.js"></script>
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
