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

  if(Finance::IsSalaryExist($id,$month,$yea))
  {
    if(Finance::DeleteSalary($id,$month,$year))
    {
      $msg="Salary Data for $month $year was deleted successfully";
    }  
    else
    {
      $msg="Salary Data for $month $year was not deleted successfully";
    }          
  } 
  else
  {
    $msg="Salary Data for $month $year does not exists";
  } 
}
if(isset($_POST['btnAddSalary']))
{

  $month=$_POST['month'];
  $year=$_POST['year'];
  $amount=$_POST['amount'];
  $sgl_increase=$_POST['sgl_increase'];
      
  if(!(Finance::IsSalaryExist($id,$month,$year)))
  {
    if(Finance::AddNewSalary($month,$year,$amount,$sgl_increase))
    {
      $msg="Salary Data for $month $year was added successfully";
    }  
    else
    {
      $msg="Salary Data for $month $year was not added successfully";
    }          
  } 
  else
  {
    $msg="Salary Data for $month $year already exists";
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

  <title>Salary Data Mamagement</title>

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

    function savesalary(id)
    {
      var amount=document.getElementById(id+"amount").innerHTML;
      var sgl_increase=document.getElementById(id+"sgl_increase").innerHTML;
      var month=document.getElementById(id+"month").innerHTML;
      var year=document.getElementById(id+"year").innerHTML;

      id=trimvalue(id);
      amount=trimvalue(amount);
      sgl_increase=trimvalue(sgl_increase);
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


      xmlhttp.open("GET", "savesalary.php?id="+id+
        "&amount="+amount+
        "&sgl_increase="+sgl_increase+
        "&year="+year+
        "&month="+month
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
              <a href="../../index.php">Home</a>|<a href="../index.php">Dashboard</a> | <a href="./">Fee Dashboard</a> | <a href="stndvoucher.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>">Open Voucher</a> | <a href="all_voucher_slips.php?month=<?php echo $month; ?>&year=<?php echo $year; ?>">Voucher Slips</a>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div style="padding: 5px 5px 5px 5px; background: red; color: white; text-align: center; font-weight: bolder "><?php echo $msg; ?></div>
          <div class="card-header"> 

            <center><h3>SALARY DATA MANAGEMENT</h3></center><br/><br/>
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
                  <td  style="min-width: 60px; color: black; padding: 5px 5px 5px 5px"><input type="text" name="amount" id="amount" placeholder="Amount"  style="width: 100%" required="required"><label for="amount">Amount</label></td>
                  <td  style="min-width: 60px; color: black; padding: 5px 5px 5px 5px"><input type="text" name="sgl_increase" id="sgl_increase" placeholder="SGL Increase"  style="width: 100%" required="required"><label for="sgl_increase">SGL Inrease</label></td>
                  <td><input type="submit" name="btnAddSalary" value="Add Salary Data"></td>
                </tr>
              </table>            
            </form>
            <input type="hidden" name="current_year"  id="current_year" value="<?php echo $year ?>">
            <input type="hidden" name="current_date"  id="current_date" value="<?php echo $date ?>">
            <input type="hidden" name="current_month" id="current_month" value="<?php echo $month ?>">
            <p><b style="background: red; padding: 3px 3px 3px 3px; color: white">Note: </b>Make sure that you dont delete the Default Salary Data, otherwise, you may find it difficult make payments for staff. If you have not yet set it add a salary data and `select` [Default] for month and `type` [Defult] for Year now</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead><tr><th width="20px"  valign='top' ><center>CMD</center></th>
                    <th width="20px"  valign='top' ><center>S/N</center></th>
                    <th valign='top' >MONTH</th>
                    <th valign='top' >YEAR</th>
                    <th valign="top" ><center>AMOUNT</center></th>
                    <th valign="top" ><center>SGL INCREASE</center></th>
                    <th valign="top" ><center>TIMESTAMP</center></th>
                  </tr>
                </thead>
                <tbody>                  
                  <?php
                  $SalaryRecords=Finance::ReadAllSalaryData();
                  foreach($SalaryRecords as $SalaryData)
                  {
                    $salaryDataDetails=Finance::ReadSalaryDataDetails($SalaryData,$month,$yea);
                    ?>
                    <tr id="<?php echo $salaryDataDetails['id']; ?>" title="<?php echo $salaryDataDetails['id']; ?>" onkeyup="savesalary(this.id)" >
                      
                      <td id="<?php echo $salaryDataDetails['id']; ?>id" title="Delete Salary Data with ID: <?php echo $salaryDataDetails['id']; ?>" ><a href="?id=<?php echo $salaryDataDetails['id']; ?>&month=<?php echo $salaryDataDetails['month']; ?>&year=<?php echo $salaryDataDetails['year']; ?>&del=delete"><button>X</button></a></td>
                      
                      <td id="<?php echo $salaryDataDetails['id']; ?>id" title="<?php echo $salaryDataDetails['id']; ?> ID" ><?php echo $salaryDataDetails['id']; ?></td>

                      <td id="<?php echo $salaryDataDetails['id']; ?>month" title="<?php echo $salaryDataDetails['id']; ?> Month" ><?php echo $salaryDataDetails['month']; ?></td>

                      <td style="text-align: center;" id="<?php echo $salaryDataDetails['id']; ?>year" title="<?php echo $salaryDataDetails['id']; ?> Year" ><?php echo $salaryDataDetails['year']; ?></td>

                      <td style="text-align: center;" contenteditable="true" id="<?php echo $salaryDataDetails['id']; ?>amount" title="<?php echo $salaryDataDetails['id']; ?> Amount" ><?php echo $salaryDataDetails['amount']; ?></td>

                      <td style="text-align: center;" contenteditable="true" id="<?php echo $salaryDataDetails['id']; ?>sgl_increase" title="<?php echo $salaryDataDetails['id']; ?> SGL Increase" ><?php echo $salaryDataDetails['sgl_increase']; ?></td>

                      <td style="text-align: center;" id="<?php echo $salaryDataDetails['id']; ?>timestamp" title="<?php echo $salaryDataDetails['timestamp']; ?>; ?> Timestamp" ><?php echo $salaryDataDetails['timestamp']; ?></td>

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
