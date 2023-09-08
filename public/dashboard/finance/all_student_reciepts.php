<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
if(!isset($_GET['reg_no']))
{
	$reg_no=$_SESSION['userid'];	
}
else
{
	$reg_no=$_GET['reg_no'];
}

$studentDetails=Module::ReadStudentDetailsp($reg_no);
$passport=$studentDetails['passport'];


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

  <title><?php echo $class;  ?> Reciept Slips</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>


  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  
</head>

<body>
	<?php
    $Fees=Finance::ReadAllStudentFee_Pay($reg_no);
    if(count($Fees)>0)
    {
    	foreach($Fees as $Fee)
    	{
			$feeDetails=Finance::ReadFee_PayDetails($Fee);


			$class=$feeDetails['class'];
			$session=$feeDetails['session'];
			$term=$feeDetails['term'];

			$feeAmountDetails=Finance::ReadFee_Pay_AmountTermDetails($class,$session,$term);
			
			$studentDetails=Module::ReadStudentDetailsp($feeDetails['reg_no']);
			$passport=$studentDetails['passport'];
	    	?>
			<div style="float: left; padding: 5px 5px 5px 5px; height: 740px; width: 450px">
				    
		    <div class="card card-register mx-auto mt-5"> 
		      <div style="padding: 20px 20px 20px 20px;">
		      	<center><img src="../../images/school/logo.png" style="width: 100px"></center>
		      	<center><h2 onclick="window.history.back()" style="font-size: 16px; font-weight: bolder"><?php echo strtoupper($school_details['school_name']); ?></h2> <h3  style="font-size: 14px; font-weight: bolder"><?php echo strtoupper($school_details['school_address']); ?></h3></center></div>
		      <div class="card-header"><center style="background-color: purple; color:white; font-weight: bolder; padding: 5px 4px 4px 4px">FEE RECIEPT SLIP</center></div>
		      <div class="card-header"><center><strong><?php echo $session." ".strtoupper($term); ?></strong></center></div>
		      <div><b style="font-size: 15px; font-weight: bolder; "><center><a href="reciept.php?class=<?php echo $feeDetails['class']; ?>&session=<?php echo $session; ?>&term=<?php echo $term; ?>&ref=<?php echo $feeDetails['ref']; ?>"><?php echo strtoupper($feeDetails['ref']) ?></a></center></b>        		              		
		       	<table class="table table-condensed">
		            <thead>

		                <tr><td class="text-center" rowspan="4"><img src="<?php echo 'data:image/jpeg;base64,'.$studentDetails['passport'];?>" style="height: 120px; border-radius: 5px;"><br/></td></tr>
		                <tr><td class="text-left"><strong><span><?php echo $studentDetails['regno']; ?></span></strong></td>
		                    <td class="text-left" colspan="2"><strong><span><?php echo strtoupper($studentDetails['names']); ?></span></strong></td>
		                    <td class="text-left"></td></tr>
		                <tr><td class="text-left"><strong>
			                  <div class="form-label-group">
			                    <?php echo $feeDetails['session']; ?>
			                  </div></strong></td>
		                    <td class="text-left"><strong>
			                  <div class="form-label-group">
			                    <?php echo $feeDetails['term']; ?>
			                  </div></strong></td>
		                    <td class="text-left"><strong>
			                  <div class="form-label-group">
			                    <?php echo $feeDetails['class']; ?>
			                  </div></strong></td>
		                </tr>
		            </thead>
		          </table>
			  </div>
			  <br/>
			  <table style="border:3px groove pink">
			  	<tr>
			  		<th>Registration Fee</th><td><?php echo $feeDetails['reg_fee']; ?></td>
			  		<th>School Fee</th><td><?php echo $feeDetails['fee']; ?></td>
			  		<th>Books</th><td><?php echo $feeDetails['book']; ?></td>
			  	</tr>
			  	<tr>
			  		<th>PTA</th><td><?php echo $feeDetails['pta']; ?></td>
			  		<th>Lesson Fee</th><td><?php echo $feeDetails['lesson']; ?></td>
			  		<th>Scratch Card</th><td><?php echo $feeDetails['scard']; ?></td>
			  	</tr>
			  </table>
			  <br/>
		      <div style="background: lightpink">
	            <div style="background: green; color:white; font-weight: bolder; text-align: center">PAYMENT SUMMARY</div> 
	              <div class="panel-body">
	                <div class="table-responsive">
	                    <table class="table table-condensed">
	                      <thead  style="background: lightblue; color:black; font-weight: bolder; text-align: center">
	                          <tr>
	                              <td class="text-center"><strong>Payable Amount</strong></td>
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
		          </div>          
		      </div>
		    </div>
			</div>
    	<?php
    	}
    }

	?>
  

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
