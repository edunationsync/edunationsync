<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$month=$_GET['month'];
$year=$_GET['year'];


if(Finance::IsSalaryExist($id,$month,$year))
{
$salaryDataDetails=Finance::ReadSalaryDataDetails($id,$month,$year);
}
else
{
$salaryDataDetails=Finance::ReadSalaryDataDetails($id,"Default","Default");
}

if(PunnishmentCharges::IsExist($id,$month,$year))
{
$punnishmentChargeDetails=PunnishmentCharges::ReadDetails($id,$month,$year);
}
else
{
$punnishmentChargeDetails=PunnishmentCharges::ReadDetails($id,"Default","Default");    
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

  <title><?php echo $month." ".$month;  ?> Voucher Slips</title>

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

    $Vouchers=Finance::ReadMonthsVoucher($month,$year);
    if(count($Vouchers)>0)
    {
    	foreach($Vouchers as $Voucher)
    	{
			$voucherDetails=Finance::ReadVoucherDetails($Voucher);

			$staffDetails=Module::ReadStaffDetails($voucherDetails['staffid']);
			$passport=$staffDetails['passport'];
	    	?>
			<div style="float: left; padding: 5px 5px 5px 5px; height: 540px; width: 450px">
				    
		    <div class="card card-register mx-auto mt-5"> 
		      <center><img src="../../images/school/logo.png" style="width: 100px"></center>
		      <div class="card-header"><center style="background-color: purple; color:white; font-weight: bolder; padding: 5px 4px 4px 4px"><?php echo $school_details['school_keycode'];?> STAFF SALARY SLIP</center></div>
		      <div class="card-header"><center><strong><?php echo strtoupper($month).", ".$year; ?></strong></center></div>
		      <div><a href="single_voucher_slip.php?voucher_id=<?php echo $voucherDetails['id']; ?>"><b style="font-size: 15px; font-weight: bolder; "><center><?php echo strtoupper($voucherDetails['ref']) ?></center></b></a>     		              		
		       	<table class="table table-condensed">
		            <thead>

		                <tr><td class="text-center" rowspan="4"><img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="height: 120px; border-radius: 5px;"><br/></td></tr>
		                <tr><td class="text-left" colspan="3"><strong><span><?php echo strtoupper($staffDetails['names']); ?></span></strong></td></tr>
		                <tr><td class="text-left" colspan="1"><strong><span><?php echo $staffDetails['staff_id']; ?></span></strong></td>
		                    <td class="text-left" colspan="2"><strong>
			                  <div class="form-label-group">
			                    <?php echo $voucherDetails['date']; ?>
			                  </div></strong></td></tr>
		                <tr><td class="text-left"><strong>Salary Grade Level</strong></td>
		                    <td class="text-left"><strong>
			                  <div class="form-label-group">
			                    <?php if(!($staffDetails['sgl']=='')){ echo $staffDetails['sgl']; } else{ echo '1';}?>-SGL
			                  </div></strong></td>
		                </tr>
		            </thead>
		          </table>
			  </div>
			  <br/>
			  <table style="border:3px groove pink">
			  	<tr>
			  		<th>LATENESS</th><td><?php echo $voucherDetails['lateness']; ?></td>
			  		<th>SCHEME</th><td><?php echo $voucherDetails['scheme']; ?></td>
			  		<th>SAVINGS</th><td><?php echo $voucherDetails['savings']; ?></td>
			  	</tr>
			  	<tr>
			  		<th>DUTY</th><td><?php echo $voucherDetails['duty']; ?></td>
			  		<th>ABSENTEESM</th><td><?php echo $voucherDetails['absenteesm']; ?></td>
			  		<th>LESSON P&N</th><td><?php echo $voucherDetails['lesson_plan_note']; ?></td>
			  	</tr>
			  </table>
			  <?php 
			  $totaldeductions=$voucherDetails['scheme']+$voucherDetails['savings']+($voucherDetails['lateness']*$punnishmentChargeDetails['lateness'])+($voucherDetails['duty']*$punnishmentChargeDetails['duty'])+($voucherDetails['absenteesm']*$punnishmentChargeDetails['absenteesm'])+($voucherDetails['lesson_plan_note']*$punnishmentChargeDetails['lesson_plan_note']);
			  ?>
			  <br/>
		      <div style="background: lightpink">
	            <div style="background: green; color:white; font-weight: bolder; text-align: center">PAYMENT SUMMARY</div> 
	              <div class="panel-body">
	                <div class="table-responsive">
	                    <table class="table table-condensed">
	                      <thead  style="background: lightblue; color:black; font-weight: bolder; text-align: center">
	                          <tr>
	                              <td class="text-center"><strong>Payable Amount</strong></td>
	                              <td class="text-center"><strong>Total Deduction</strong></td>
	                              <td class="text-center"><strong>Paying Balance</strong></td>
	                          </tr>
	                      </thead>
	                      <tbody>
	                          <tr>
	                            <td class="text-center">N<span name="amount" id="amount"><?php echo $voucherDetails['amount']; ?></span></td>
	                            <td class="text-center">N<span name="total" id="total"><?php echo $totaldeductions; ?></span></td>
	                            <td class="text-center">N<span name="balance" id="balance"><?php echo $voucherDetails['balance']; ?></span></td>
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
