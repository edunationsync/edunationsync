<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
  $year=$_GET['year'];
  $month=$_GET['month'];

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

if(isset($_GET['s']))
{
    $month=$_GET['month'];
    $year=$_GET['year'];
    $date=$_GET['date'];


    $Staffs=Module::ReadAllStaff();
    if(count($Staffs)>0)
    {
      foreach($Staffs as $Staff)
      {
        $staffDetails=Module::ReadStaffDetails($Staff);
        $ref=strtoupper($school_details['school_keycode']."/".$year.'/'.$month.'/'.$staffDetails['staff_id']);
        if(!(Finance::IsVoucherRefExist($ref)))
        {
          $amount=$salaryDataDetails['amount']+($salaryDataDetails['sgl_increase']*$staffDetails['sgl']);

          if(Finance::AddVoucher($ref,$staffDetails['staff_id'],$date,$month,$year,$staffDetails['sgl'],$lateness,$duty,$lesson_plan_note,$absenteesm,$scheme,$savings,$staff_welfare,$amount,$amount))
          {
            $msg=$msg.$staffDetails['staff_id']." added ";
          }          
        }
        else
        {
          $voucherDetailsData=Finance::ReadVoucherDetailsData($Staff,$month,$year);
          $ref=$voucherDetailsData['ref'];
          $staffid=$voucherDetailsData['staffid'];
          $date=$voucherDetailsData['date'];
          $month=$voucherDetailsData['month'];
          $year=$voucherDetailsData['year'];
          $lateness=$voucherDetailsData['lateness'];
          $duty=$voucherDetailsData['duty'];
          $lesson_plan_note=$voucherDetailsData['lesson_plan_note'];
          $absenteesm=$voucherDetailsData['absenteesm'];
          $scheme=$voucherDetailsData['scheme'];
          $savings=$voucherDetailsData['savings'];
          $staff_welfare=$voucherDetailsData['staff_welfare'];
          $amount=$voucherDetailsData['amount'];
          $balance=$voucherDetailsData['balance'];

          if(Finance::UpdateVoucher($id,$ref,$staffDetails['staff_id'],$date,$month,$year,$staffDetails['sgl'],$lateness,$duty,$lesson_plan_note,$absenteesm,$scheme,$savings,$staff_welfare,$amount,$balance))
          {
            $msg=$msg.$staffDetails['staff_id']." Modified ";
          }
          else
          {
            $msg=$msg.$staffDetails['staff_id']." Modified ";
          }
        }
      }
    }
}
?>
<input type="hidden" name="current_session"  id="current_session" value="<?php echo $session ?>">
<input type="hidden" name="current_class"  id="current_class" value="<?php echo $class ?>">
<!DOCTYPE html>
<html lang="en">

<head> 
    <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $month.", ".$year; ?> Salary Voucher List</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <style type="text/css">
    
      
      /* The snackbar - position it at the bottom and in the middle of the screen */
      #snackbar {
        visibility: hidden; /* Hidden by default. Visible on click */
        min-width: 250px; /* Set a default minimum width */
        margin-left: -125px; /* Divide value of min-width by 2 */
        background-color: #333; /* Black background color */
        color: #fff; /* White text color */
        text-align: center; /* Centered text */
        border-radius: 2px; /* Rounded borders */
        padding: 16px; /* Padding */
        position: fixed; /* Sit on top of the screen */
        z-index: 1; /* Add a z-index if needed */
        left: 50%; /* Center the snackbar */
        bottom: 30px; /* 30px from the bottom */
      }

      /* Show the snackbar when clicking on a button (class added with JavaScript) */
      #snackbar.show {
        visibility: visible; /* Show the snackbar */
        /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
        However, delay the fade out process for 2.5 seconds */
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
      }

      /* Show the snackbar when clicking on a button (class added with JavaScript) */
      #statusbarmessage {
        visibility: visible; /* Show the snackbar */
        /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
        However, delay the fade out process for 2.5 seconds */
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
      }

      /* Animations to fade the snackbar in and out */
      @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
      }

      @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
      }

      @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
      }

      @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
      }

  </style>
  <style type="text/css">
    td,th{
      border:2px solid black;
      padding: 3px 3px 3px 3px;
    }
  </style>
</head>

<body id="page-top">


  <div id="wrapper">
    <div id="content-wrapper">

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
    <div class="bheader"><center><img src="../../images/school/logo.png" width="100px"><br/><b ><hd><?php echo strtoupper($school_details['school_name']); ?></hd></b><br/>
       SCHOOL SALARY REPORT <BR/>
      <hd1><?php echo strtoupper($month); ?> <?php echo strtoupper($year); ?> <br/><?php echo strtoupper("Printed on ".date("D M Y")) ?></center></div></b>
  </header>
      <div class="container-fluid">
              <table  width="100%" cellspacing="0">
                <thead><tr>
                  <th width="20px"  valign='top' ><center>S/N</center></th>
                    <th valign='top' >STAFF ID</th>
                    <th valign='top' >STAFF NAME</th>
                    <th valign="top" ><center>SGL</center></th>
                    <th valign="top" ><center>LATENESS</center></th>
                    <th valign="top" ><center>DUTY</center></th>
                    <th valign="top" ><center>LESSON P&N</center></th>
                    <th valign="top" ><center>ABSENCE</center></th>
                    <th valign="top" ><center>SCHEME</center></th>
                    <th valign="top" ><center>SAVINGS</center></th>
                    <th valign="top" ><center>STAFF WELFARE</center></th>
                    <th valign="top" ><center>AMOUNT</center></th>
                    <th valign="top" ><center>BALANCE</center></th>
                  </tr>
                </thead>
                <tbody>                  
                  <?php
                  $Vouchers=Finance::ReadAllVouchers($month,$year);
                  foreach($Vouchers as $Voucher)
                  {
                    $count++;
                    $voucherDetails=Finance::ReadVoucherDetails($Voucher);
                    $staffDetails=Module::ReadStaffDetails($voucherDetails['staffid']);
                    ?>
                    <tr id="<?php echo $voucherDetails['ref']; ?>" title="<?php echo $voucherDetails['ref']; ?>" onkeyup="savevoucher(this.id)" >

                      <td><center><?php echo $count; ?></center></td>

                      <td id="<?php echo $voucherDetails['ref']; ?>staffid" title="<?php echo $voucherDetails['ref']; ?>staffid" ><?php echo $voucherDetails['staffid']; ?></td>

                      <td id="<?php echo $voucherDetails['ref']; ?>names" title="<?php echo $voucherDetails['ref']; ?>name" ><?php echo $staffDetails['names']; ?></td>

                      <td style="text-align: center;" id="<?php echo $voucherDetails['ref']; ?>sgl" title="<?php echo $voucherDetails['ref']; ?>sgl" ><?php echo $voucherDetails['sgl']; ?></td>

                      <td style="text-align: center;"  id="<?php echo $voucherDetails['ref']; ?>lateness" title="<?php echo $voucherDetails['ref']; ?>lateness" ><?php echo $voucherDetails['lateness']; ?></td>
                      <?php $balance=$voucherDetails['lateness']*$punnishmentChargeDetails['lateness']; ?>

                      <td style="text-align: center;"  id="<?php echo $voucherDetails['ref']; ?>duty" title="<?php echo $voucherDetails['ref']; ?>duty"  ><?php echo $voucherDetails['duty']; ?></td>
                      <?php $balance=$balance+($voucherDetails['duty']*$punnishmentChargeDetails['duty']); ?>

                      <td style="text-align: center;"  id="<?php echo $voucherDetails['ref']; ?>lesson_plan_note" title="<?php echo $voucherDetails['ref']; ?>lesson_plan_note" ><?php echo $voucherDetails['lesson_plan_note']; ?></td>
                       <?php $balance=$balance+($voucherDetails['lesson_plan_note']*$punnishmentChargeDetails['lesson_plan_note']); ?>

                      <td style="text-align: center;"  id="<?php echo $voucherDetails['ref']; ?>absenteesm" title="<?php echo $voucherDetails['ref']; ?>absenteesm" ><?php echo $voucherDetails['absenteesm']; ?></td>
                       <?php $balance=$balance+($voucherDetails['absenteesm']*$punnishmentChargeDetails['absenteesm']); ?>

                      <td style="text-align: center;"  id="<?php echo $voucherDetails['ref']; ?>scheme" title="<?php echo $voucherDetails['ref']; ?>scheme" ><?php echo $voucherDetails['scheme']; ?></td>
                       <?php $balance=$balance+$voucherDetails['scheme']; ?>

                      <td style="text-align: center;"  id="<?php echo $voucherDetails['ref']; ?>staff_welfare" title="<?php echo $voucherDetails['ref']; ?>staff_welfare" ><?php echo $voucherDetails['staff_welfare']; ?></td>
                       <?php $balance=$balance+$voucherDetails['staff_welfare']; ?>

                      <td style="text-align: center;"  id="<?php echo $voucherDetails['ref']; ?>savings" title="<?php echo $voucherDetails['ref']; ?>savings" ><?php echo $voucherDetails['savings']; ?></td>
                       <?php $balance=$balance+$voucherDetails['savings']; ?>

                      <td style="text-align: center;"  id="<?php echo $voucherDetails['ref']; ?>amount" title="<?php echo $voucherDetails['ref']; ?>amount" ><?php echo $salaryDataDetails['amount']+($salaryDataDetails['sgl_increase']*$staffDetails['sgl']); ?></td>

                       <?php $balance=$salaryDataDetails['amount']+($salaryDataDetails['sgl_increase']*$voucherDetails['sgl'])-$balance; ?>
                      <td style="text-align: center;"  id="<?php echo $voucherDetails['ref']; ?>balance" title="<?php echo $voucherDetails['ref']; ?>balance" ><?php echo $balance; ?></td>
                      <?php                    
                    }
                    ?>
                  </tr>              
                </tbody>
              </table>

      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

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
