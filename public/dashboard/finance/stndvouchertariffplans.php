<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
  $year=$_GET['year'];
  $date=$_GET['date'];
  
if(isset($_GET['s']))
{
  $year=$_GET['year'];
  $date=$_GET['date'];


    $Staffs=Module::ReadAllStaff();
    if(count($Staffs)>0)
    {
      foreach($Staffs as $staff_id)
      {
        $staffDetails=Module::ReadStaffDetails($staff_id);
        if(!(Finance::IsTarrifExist($id,$year)))
        {
          $amount=$salaryDataDetails['amount']+($salaryDataDetails['sgl_increase']*$staffDetails['sgl']);

          if(Finance::AddNewTariff($staff_id,$year,$savings,$scheme))
          {
            $msg=$msg.$staffDetails['staff_id']." added ";
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

  <title><?php echo $year; ?> Salary Tariff Plans</title>

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
  <script type="text/javascript">    
    function Toast(message) {
      // Get the snackbar DIV
      var x = document.getElementById("snackbar");
      x.innerHTML=message;

      // Add the "show" class to DIV
      x.className = "show";

      // After 3 seconds, remove the show class from DIV
      setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
  </script>

  <script type="text/javascript">


    function toggleMenu()
    {

      if(document.getElementById('menu').style.display=='none')
      {
        document.getElementById('menu').style.display='block';
        document.getElementById('btnMenu').innerHTML='Hide Menu';
      }
      else
      {          
        document.getElementById('menu').style.display='none';
        document.getElementById('btnMenu').innerHTML='Show Menu';
      }
    }
  </script>

  <script type="text/javascript">
     

    function trimvalue(value)
    {
      if(value.substr(value.length-4)=="<br>")
      {
        value=value.substr(0,value.length-4);
      }
      return value;
    }

    function savevoucher(id)
    {
      var amount=0;
      var charges=0;
      var ref=document.getElementById(id+"ref").innerHTML;
      var lateness=document.getElementById(id+"lateness").innerHTML;
      var duty=document.getElementById(id+"duty").innerHTML;
      var sgl=document.getElementById(id+"sgl").innerHTML;
      var lesson_plan_note=document.getElementById(id+"lesson_plan_note").innerHTML;
      var absenteesm=document.getElementById(id+"absenteesm").innerHTML;
      var scheme=document.getElementById(id+"scheme").innerHTML;
      var savings=document.getElementById(id+"savings").innerHTML;
      var staff_welfare=document.getElementById(id+"staff_welfare").innerHTML;
      var pay_amount="<?php echo $salaryDataDetails['amount']; ?>";
      var balance=document.getElementById(id+"balance").innerHTML;
      var staffid=document.getElementById(id+"staffid").innerHTML;
      var year=document.getElementById(id+"year").innerHTML;
      var month=document.getElementById(id+"month").innerHTML;
      var date=document.getElementById(id+"date").innerHTML;


      id=trimvalue(id);
      ref=trimvalue(ref);
      lateness=trimvalue(lateness);
      duty=trimvalue(duty);
      sgl=trimvalue(sgl);
      lesson_plan_note=trimvalue(lesson_plan_note);
      absenteesm=trimvalue(absenteesm);
      scheme=trimvalue(scheme);
      savings=trimvalue(savings);
      staff_welfare=trimvalue(staff_welfare);
      pay_amount=trimvalue(pay_amount);
      balance=trimvalue(balance);
      staffid=trimvalue(staffid);
      year=trimvalue(year);
      month=trimvalue(month);
      date=trimvalue(date);

      if(sgl>0)
      {
        pay_amount=eval(sgl*<?php echo $salaryDataDetails['sgl_increase']; ?>)+eval(pay_amount);
      }
      else
      {
        pay_amount=eval(pay_amount);
      }

      if(lateness=='')
      {
        lateness='0';
      }
      
      if(duty=='')
      {
        duty='0';
      }
      
      if(absenteesm=='')
      {
        absenteesm='0';
      }
      
      if(lesson_plan_note=='')
      {
        lesson_plan_note='0';
      }
      
      if(scheme=='')
      {
        scheme='0';
      }
      
      if(savings=='')
      {
        savings='0';
      }
      
      if(staff_welfare=='')
      {
        staff_welfare='0';
      }
      //document.getElementById(id+"pay_amount").innerHTML=pay_amount;
      var lateness_charge=eval(lateness*<?php echo $punnishmentChargeDetails['lateness']; ?>);
      var duty_charge=eval(duty*<?php echo $punnishmentChargeDetails['duty']; ?>);
      var absenteesm_charge=eval(absenteesm*<?php echo $punnishmentChargeDetails['absenteesm']; ?>);
      var lesson_charge=eval(lesson_plan_note*<?php echo $punnishmentChargeDetails['lesson_plan_note']; ?>);

      charges=lateness_charge+duty_charge+absenteesm_charge+lesson_charge+eval(scheme)+eval(savings)-eval(staff_welfare);

      balance=(pay_amount-charges);
      
      document.getElementById(id+"balance").innerHTML=balance;

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {        
          Toast(this.responseText);
          
        }
        else
        {
          Toast("Processing...");
        }
      };


      xmlhttp.open("GET", "savevoucher.php?id="+id+
        "&ref="+ref+
        "&lateness="+lateness+
        "&duty="+duty+
        "&sgl="+sgl+
        "&lesson_plan_note="+lesson_plan_note+
        "&absenteesm="+absenteesm+
        "&scheme="+scheme+
        "&savings="+savings+
        "&staff_welfare="+staff_welfare+
        "&pay_amount="+pay_amount+
        "&balance="+balance+
        "&staffid="+staffid+
        "&year="+year+
        "&month="+month+
        "&date="+date
        , true);
      xmlhttp.send(); 
    }
  </script>
</head>

<body id="page-top">


  <div id="wrapper">
    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()">Back</a>|
          </li>
              <a href="../../index.php">Home</a>|<a href="../index.php">Dashboard</a> | <a href="./">Fee Dashboard</a> | <a href="punnishment_charges.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>">Charges Settings</a> | <a href="salary_data.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>">Salary Settings</a> | <a href="stndvoucher.php?year=<?php echo $year; ?>">Open Voucher</a> | <a href="stndvoucher.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>">Voucher Slips</a> | <a href="stndvoucher_print.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>">Print List</a>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header"> 

            <center><h3><?php echo strtoupper($year) ?> SALARY TARIFF PLANS</h3></center><br/><br/>
            <form method="GET">
              <table>
                <tr>
                  <td valign="top" style="padding: 5px 5px 5px 5px; border:none" ><center><label for="date">Date</label></center></td><td style="min-width: 60px; color: black; padding: 5px 5px 5px 5px"><input type="text" name="date" id="date" value='<?php echo strtoupper(date("d/m/y"));  ?>' style="width: 100%"></td>
                  
                  <td valign="top" style="padding: 5px 5px 5px 5px; border:none" ><center><label for="year">Year</label></center></td><td  style="min-width: 60px; color: black; padding: 5px 5px 5px 5px"><input type="text" name="year" id="year"  value='<?php echo strtoupper(date("Y"));  ?>'  style="width: 100%"></td><td><input type="submit" name="s" value="Browse"></td>
                </tr>
              </table>            
            </form>
            <input type="hidden" name="current_year"  id="current_year" value="<?php echo $year ?>">
            <input type="hidden" name="current_date"  id="current_date" value="<?php echo $date ?>">
            <input type="hidden" name="current_month" id="current_month" value="<?php echo $month ?>">
            <p><b style="background: red; padding: 3px 3px 3px 3px; color: white">Note: </b>All the below subscriptions will be subtracted from the salary of the subscribed staff automatically</p>
          </div>
          <div class="card-body" style="font-size: 9px">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead><tr><th width="20px"  valign='top' ><center>CMD</center></th>
                  <th width="20px"  valign='top' ><center>S/N</center></th>
                    <th valign='top' >STAFF ID</th>
                    <th valign='top' >STAFF NAME</th>
                    <th valign="top" ><center>SCHEME</center></th>
                    <th valign="top" ><center>SAVINGS</center></th>
                    <th valign="top" ><center>YEAR</center></th>
                    <th valign="top" ><center>DATE</center></th>
                  </tr>
                </thead>
                <tbody>                  
                  <?php
                  $Tariffs=Finance::ReadAllTariffData();
                  foreach($Tariffs as $Tariff_id)
                  {
                    $count++;
                    $tariffDetails=Finance::ReadTariffDataDetails($Tariff_id,$year);
                    $staffDetails=Module::ReadStaffDetails($tariffDetails['staff_id']);
                    ?>
                    <tr id="<?php echo $tariffDetails['id']; ?>" title="<?php echo $tariffDetails['id']; ?>" onkeyup="if(event.keyCode==9){savevoucher(this.id)}" onkeydown="if(event.keyCode==9){savevoucher(this.id)}" >

                      <td><a href="single_voucher_slip.php?voucher_id=<?php echo $tariffDetails['id']; ?>"><center>Print</center></a></td>

                      <td><center><?php echo $count; ?></center></td>

                      <td style="text-align: center;" contenteditable="false" id="<?php echo $tariffDetails['id']; ?>staffid" title="<?php echo $tariffDetails['id']; ?>staffid" ><?php echo $staffDetails['staff_id']; ?></td>

                      <td id="<?php echo $tariffDetails['id']; ?>name" title="<?php echo $tariffDetails['id']; ?>name" ><?php echo $staffDetails['names']; ?></td>

                      <td style="text-align: center;" contenteditable="true"  id="<?php echo $tariffDetails['id']; ?>lateness" title="<?php echo $tariffDetails['id']; ?>lateness" ><?php echo $tariffDetails['scheme']; ?></td>

                      <td style="text-align: center;" contenteditable="true" id="<?php echo $tariffDetails['id']; ?>duty" title="<?php echo $tariffDetails['id']; ?>duty" ><?php echo $tariffDetails['savings']; ?></td>

                      <td style="text-align: center;" contenteditable="false" id="<?php echo $tariffDetails['id']; ?>year" title="<?php echo $tariffDetails['id']; ?>year" ><?php echo $year; ?></td>

                      <td style="text-align: center;" contenteditable="false" id="<?php echo $tariffDetails['id']; ?>date" title="<?php echo $tariffDetails['id']; ?>date" ><?php echo $date; ?></td>
                      <?php                    
                    }
                    ?>
                  </tr>              
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top" onclick="Toast('<?php echo $msg; ?>')">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- The actual snackbar -->
  <div id="snackbar"></div>

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
