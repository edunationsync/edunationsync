<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$month=$_GET['month'];
$year=$_GET['year'];

if(isset($_GET['del']))
{
  $id=$_GET['id'];
  $month=$_GET['month'];
  $year=$_GET['year'];

  if(PunnishmentCharges::IsExist($id,$month,$year))
  {
    if(PunnishmentCharges::Delete($id,$month,$year))
    {
      $msg="Punnishment Charges for $month $year was deleted successfully";
    }  
    else
    {
      $msg="Punnishment Charges for $month $year was not deleted successfully";
    }          
  } 
  else
  {
    $msg="Punnishment Charges for $month $year does not exists";
  } 
}
if(isset($_POST['btnAddCharge']))
{

  $month=$_POST['month'];
  $year=$_POST['year'];
  $lateness=$_POST['lateness'];
  $duty=$_POST['duty'];
  $lesson_plan_note=$_POST['lesson_plan_note'];
  $absenteesm=$_POST['absenteesm'];
      
  if(!(PunnishmentCharges::IsExist($id,$month,$year)))
  {
    if(PunnishmentCharges::AddNew($month,$year,$lateness,$duty,$lesson_plan_note,$absenteesm))
    {
      $msg="Punnishment Charges for $month $year was added successfully";
    }  
    else
    {
      $msg="Punnishment Charges for $month $year was not added successfully";
    }          
  } 
  else
  {
    $msg="Punnishment Charges for $month $year already exists";
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

  <title>Punnishment Charges Mamagement</title>

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

    function trimvalue(value)
    {
      if(value.substr(value.length-4)=="<br>")
      {
        value=value.substr(0,value.length-4);
      }
      return value;
    }

    function savecharge(id)
    {
      var lateness=document.getElementById(id+"lateness").innerHTML;
      var duty=document.getElementById(id+"duty").innerHTML;
      var lesson_plan_note=document.getElementById(id+"lesson_plan_note").innerHTML;
      var absenteesm=document.getElementById(id+"absenteesm").innerHTML;
      var month=document.getElementById(id+"month").innerHTML;
      var year=document.getElementById(id+"year").innerHTML;

      id=trimvalue(id);
      lateness=trimvalue(lateness);
      duty=trimvalue(duty);
      lesson_plan_note=trimvalue(lesson_plan_note);
      absenteesm=trimvalue(absenteesm);
      month=trimvalue(month);
      year=trimvalue(year);
      
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


      xmlhttp.open("GET", "savecharge.php?id="+id+
        "&month="+month+
        "&year="+year+
        "&lateness="+lateness+
        "&duty="+duty+
        "&lesson_plan_note="+lesson_plan_note+
        "&absenteesm="+absenteesm
        , true);
      xmlhttp.send();
    }

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
              <a href="../../index.php">Home</a>|<a href="../index.php">Dashboard</a> | <a href="./">Fee Dashboard</a> | <a href="stndvoucher.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>">Open Voucher</a> | <a href="salary_data.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>">Salary Settings</a> | <a href="all_voucher_slips.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>">Voucher Slips</a>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div style="padding: 5px 5px 5px 5px; background: red; color: white; text-align: center; font-weight: bolder "><?php echo $msg; ?></div>
          <div class="card-header"> 

            <center><h3>PUNNISHMENT CHARGES MANAGEMENT</h3></center><br/><br/>
            <form method="POST" >
              <table>
                <tr>
                  <td style="min-width: 60px; color: black; padding: 5px 5px 5px 5px"><input type="text" name="year" id="year"  style="width: 100%" required="required"><label for="year">Year</label></td>
                  <td  style="min-width: 60px; color: black; padding: 5px 5px 5px 5px">
                    <select name="month" id="month" style="width: 100%; height: 30px" required="required">
                      <option>Default</option>
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
                  </td>
                  <td  style="min-width: 60px; color: black; padding: 5px 5px 5px 5px"><input type="text" name="lateness" id="lateness" placeholder="Lateness Charge"  style="width: 100%" required="required"><label for="lateness">Lateness Charge</label></td>
                  <td  style="min-width: 60px; color: black; padding: 5px 5px 5px 5px"><input type="text" name="duty" id="duty" placeholder="Duty Charge"  style="width: 100%" required="required"><label for="duty">Duty Charge</label></td>
                  <td  style="min-width: 60px; color: black; padding: 5px 5px 5px 5px"><input type="text" name="lesson_plan_note" id="lesson_plan_note" placeholder="Lesson Plan & Note Charge"  style="width: 100%" required="required"><label for="lesson_plan_note">Lesson Plan & Note Charge</label></td>
                  <td  style="min-width: 60px; color: black; padding: 5px 5px 5px 5px"><input type="text" name="absenteesm" id="absenteesm" placeholder="Absenteesm Charge"  style="width: 100%" required="required"><label for="absenteesm">Absenteesm Charge</label></td>
                  <td><input type="submit" name="btnAddCharge" value="Add Charge"></td>
                </tr>
              </table>            
            </form>
            <input type="hidden" name="current_year"  id="current_year" value="<?php echo $year ?>">
            <input type="hidden" name="current_date"  id="current_date" value="<?php echo $date ?>">
            <input type="hidden" name="current_month" id="current_month" value="<?php echo $month ?>">
            <p><b style="background: red; padding: 3px 3px 3px 3px; color: white">Note: </b>Make sure that you dont delete the general punnishment charges, otherwise, you may find it difficult make deductions for offended staff. If you have not yet set it add a charge and `select` Default for month and `type` defult for Year now</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead><tr><th width="20px"  valign='top' ><center>CMD</center></th>
                    <th width="20px"  valign='top' ><center>S/N</center></th>
                    <th valign='top' >MONTH</th>
                    <th valign='top' >YEAR</th>
                    <th valign="top" ><center>LATENESS</center></th>
                    <th valign="top" ><center>DUTY</center></th>
                    <th valign="top" ><center>LESSON P&N</center></th>
                    <th valign="top" ><center>ABSENCE</center></th>
                    <th valign="top" ><center>TIMESTAMP</center></th>
                  </tr>
                </thead>
                <tbody>                  
                  <?php
                  $Charges=PunnishmentCharges::ReadAllPunnishmentCharges();
                  foreach($Charges as $Charge)
                  {
                    $punnishmentDetails=PunnishmentCharges::ReadDetails($Charge,$month,$yea);
                    ?>
                    <tr id="<?php echo $punnishmentDetails['id']; ?>" title="<?php echo $punnishmentDetails['id']; ?>" onkeyup="savecharge(this.id)" >
                      
                      <td id="<?php echo $punnishmentDetails['id']; ?>id" title="<?php echo $punnishmentDetails['id']; ?> ID" ><a href="?id=<?php echo $punnishmentDetails['id']; ?>&month=<?php echo $punnishmentDetails['month']; ?>&year=<?php echo $punnishmentDetails['year']; ?>&del=delete"><button>X</button></a></td>
                      
                      <td id="<?php echo $punnishmentDetails['id']; ?>id" title="<?php echo $punnishmentDetails['id']; ?> ID" ><?php echo $punnishmentDetails['id']; ?></td>

                      <td id="<?php echo $punnishmentDetails['id']; ?>month" title="<?php echo $punnishmentDetails['id']; ?> Month" ><?php echo $punnishmentDetails['month']; ?></td>

                      <td style="text-align: center;" id="<?php echo $punnishmentDetails['id']; ?>year" title="<?php echo $punnishmentDetails['id']; ?> Year" ><?php echo $punnishmentDetails['year']; ?></td>

                      <td style="text-align: center;" contenteditable="true" id="<?php echo $punnishmentDetails['id']; ?>lateness" title="<?php echo $punnishmentDetails['id']; ?> Lateness" ><?php echo $punnishmentDetails['lateness']; ?></td>

                      <td style="text-align: center;" contenteditable="true" id="<?php echo $punnishmentDetails['id']; ?>duty" title="<?php echo $punnishmentDetails['id']; ?> Duty"  ><?php echo $punnishmentDetails['duty']; ?></td>

                      <td style="text-align: center;" contenteditable="true" id="<?php echo $punnishmentDetails['id']; ?>lesson_plan_note" title="<?php echo $punnishmentDetails['id']; ?> Lesson Plan Note" ><?php echo $punnishmentDetails['lesson_plan_note']; ?></td>

                      <td style="text-align: center;" contenteditable="true" id="<?php echo $punnishmentDetails['id']; ?>absenteesm" title="<?php echo $punnishmentDetails['id']; ?> Absenteesm" ><?php echo $punnishmentDetails['absenteesm']; ?></td>

                      <td style="text-align: center;" id="<?php echo $punnishmentDetails['id']; ?>timestamp" title="<?php echo $punnishmentDetails['timestamp']; ?>; ?> Timestamp" ><?php echo $punnishmentDetails['timestamp']; ?></td>

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
  <a class="scroll-to-top rounded" href="#page-top">
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
