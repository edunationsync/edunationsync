<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
  $session=$_GET['session'];
  $class=$_GET['class'];
  $amount=$_GET['amount'];
  $currentsession=Module::ReadCurrentSession();
//$Level=Module::GetLevel($Class);


if(isset($_POST['btnAdd']))
{
  if(Finance::AddFee_Pay_Amount($_POST['class'], $_POST['session'], $_POST['term'], $_POST['reg_fee'], $_POST['fee'], $_POST['book'], $_POST['lesson'], $_POST['pta'], $_POST['scard']))
  {
    $msg=$msg. "Added Successfully ";
  } 
  else
  {
    $msg=$msg. "Fail to Add Record";
  }
  echo $msg;
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

  <title>FEES & PAYMENT</title>

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
    <style type="text/css">
      hd{
        font-size: 24px;
      }
      hd1{
        font-size: 19px;
      }
      button{
        background-color: blue;
        color: white;
        font-weight: bolder;
      }
      button:hover{
        background-color: lightblue;
        color: black;
        font-weight: bolder;
      }
      .input{
        background-color: blue;
        border:1px solid black;
        font-weight: bolder;
      }
      .input:hover{
        background-color: lightblue;
        font-weight: bolder;
      }

      .bheader{
        color: black;
        font-family: times new roman;
        text-align: center;
        font-size: 12px;
        font-weight: bolder;
      }
      thead{
        font-weight: bolder;
        text-align: center;
        font-size: 12px;
        background-color: white;
      }
      tr:hover{
        background-color: lightgreen; 
      }
      tbody{
        font-size: 12px;
        background-color: white;
      }
      td{
        border: 1px solid black;
      }
      .content 
      {
        background-color: white;
        height: 100%;
        page-break-after: always;
      }
      input[type=text]
      {
        margin: 0px 0px 0px 0px;
        border: 1px solid white;
        width: 100%;
        height: 20px;
        text-align: center;
        font-size: 9px;
      }
      form{
        float: left;
      }
      
      input[type="submit"]
      {
        background-color: blue;
        color: white;
        padding: 3px 3px 3px 3px;
      }
      input[type="submit"]:hover
      {
        background-color: lightblue;
        color: black;
      }
      .tdata{
        text-align: center;
      }

    </style>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

    <script type="text/javascript">

      function savefeeamount(id)
      {
        var classs=document.getElementById(id+"class").innerHTML
        var session=document.getElementById(id+"session").innerHTML;
        var term=document.getElementById(id+"term").innerHTML;
        var reg_fee=document.getElementById(id+"reg_fee").innerHTML;
        var fee=document.getElementById(id+"fee").innerHTML;
        var book=document.getElementById(id+"book").innerHTML;
        var lesson=document.getElementById(id+"lesson").innerHTML;
        var pta=document.getElementById(id+"pta").innerHTML;
        var scard=document.getElementById(id+"scard").innerHTML;

        reg_fee=trimvalue(reg_fee);
        fee=trimvalue(fee);
        book=trimvalue(book);
        lesson=trimvalue(lesson);
        pta=trimvalue(pta);
        scard=trimvalue(scard);

        reg_fee=reg_fee||0;
        fee=fee||0;
        book=book||0;
        lesson=lesson||0;
        pta=pta||0;
        scard=scard||0;

        document.getElementById(id+"amount").innerHTML=(eval(reg_fee) + eval(fee) + eval(book) + eval(lesson) + eval(pta) + eval(scard));

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
        xmlhttp.open("GET", "savefeeamount.php?id="+id+
          "&reg_fee="+reg_fee+
          "&classs="+classs+
          "&session="+session+
          "&term="+term+
          "&fee="+fee+
          "&book="+book+
          "&lesson="+lesson+
          "&pta="+pta+
          "&scard="+scard
          , true);
        xmlhttp.send();
      }

      function trimvalue(value)
      {
        if(value.substr(value.length-4)=="<br>")
        {
          value=value.substr(0,value.length-4);
        }
        return value;
      }

      function deletefeeamount(id)
      {
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
        xmlhttp.open("GET", "deletefeeamount.php?id="+id
          , true);
        xmlhttp.send();
      }


      function HideThis(id)
      {
        var row=document.getElementById(id);
        row.style.display="none";
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
              <a href="../../index.php">Home</a> | <a href="../index.php">Dashboard</a> | <a href="./">Fee Dashboard</a> | <a href="fee_explorer.php">Fee Explorer</a>  | <a href="fee_amounts_print.php">Print Preview</a> 
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">


          <table cellspacing="0" width="100%" style="font-size: 12px">
            <thead><tr><td width="20px"  valign='top' ><center>CMD</center></td>
              <td width="20px"  valign='top' ><center>S/N</center></td>
              <td valign="top" ><center>CLASS</center></td>
              <td valign="top" ><center>SESSION</center></td>
              <td valign="top" ><center>TERM</center></td>
              <td valign="top" ><center>REG. FEE</center></td>
              <td valign="top" ><center>FEE</center></td>
              <td valign="top" ><center>BOOK</center></td>
              <td valign="top" ><center>LESSON FEE</center></td>
              <td valign="top" ><center>PTA</center></td>
              <td valign="top" ><center>S-CARD</center></td>
              <td valign="top" ><center>TOTAL</center></td>
              <td valign="top" ><center>DATE</center></td>
            </tr>
            </thead>
            <tbody>
              <?php

              $FeeAmounts=Finance::ReadAllFee_Pay_Amount();
              foreach($FeeAmounts as $FeeId)
              {
                $count++;
                $feeAmountDetails=Finance::ReadFee_Pay_AmountDetails($FeeId);
                ?>

                <tr id="<?php echo $feeAmountDetails['id']; ?>" title="<?php echo $feeAmountDetails['class']; ?>" onkeyup="savefeeamount('<?php echo $feeAmountDetails['id']; ?>'); "  >

                  <td><button onclick="deletefeeamount('<?php echo $feeAmountDetails['id']; ?>');">Delete</button></td>

                  <td><center><?php echo $count; ?></center></td>

                  <td style="text-align: center;"  contenteditable="true" id="<?php echo $feeAmountDetails['id']; ?>class" title="<?php echo $feeAmountDetails['id']; ?> Class" ><?php echo $feeAmountDetails['class']; ?></td>

                  <td style="text-align: center;"  contenteditable="true" id="<?php echo $feeAmountDetails['id']; ?>session" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?>  Session" ><?php echo $feeAmountDetails['session']; ?></td>

                  <td style="text-align: center;"  contenteditable="true" id="<?php echo $feeAmountDetails['id']; ?>term" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?>  Term" ><?php echo $feeAmountDetails['term']; ?></td>

                  <td style="text-align: center;" contenteditable="true" id="<?php echo $feeAmountDetails['id']; ?>reg_fee" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?> Registration Fee" ><?php if($feeAmountDetails['reg_fee']>0){echo $feeAmountDetails['reg_fee'];} ?></td>

                  <td style="text-align: center;" contenteditable="true" id="<?php echo $feeAmountDetails['id']; ?>fee" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?> Fee" ><?php if($feeAmountDetails['fee']>0){echo $feeAmountDetails['fee'];} ?></td>

                  <td style="text-align: center;" contenteditable="true" id="<?php echo $feeAmountDetails['id']; ?>book" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?> Book Cost"  ><?php if($feeAmountDetails['book']>0){echo $feeAmountDetails['book'];}  ?></td>

                  <td style="text-align: center;" contenteditable="true" id="<?php echo $feeAmountDetails['id']; ?>lesson" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?> Lesson Fee" ><?php  if($feeAmountDetails['lesson']>0){echo $feeAmountDetails['lesson'];} ?></td>

                  <td style="text-align: center;" contenteditable="true" id="<?php echo $feeAmountDetails['id']; ?>pta" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?> PTA Fee" ><?php  if($feeAmountDetails['pta']>0){echo $feeAmountDetails['pta'];} ?></td>
                  
                  <td style="text-align: center;" contenteditable="true" id="<?php echo $feeAmountDetails['id']; ?>scard" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?> Scrtach Card" ><?php  if($feeAmountDetails['scard']>0){echo $feeAmountDetails['scard'];} ?></td>

                  <td style="text-align: center;" contenteditable="false" id="<?php echo $feeAmountDetails['id']; ?>amount" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?> Total Fee" ><?php  echo $feeAmountDetails['total'];  ?></td>

                  <td style="text-align: center;" contenteditable="false" id="<?php echo $feeAmountDetails['id']; ?>timestamp" title="<?php echo $feeAmountDetails['id'].' '.$feeAmountDetails['class']; ?> Time and Date of laet modification" ><?php  echo $feeAmountDetails['timestamp'];  ?></td>

                  <?php                    
                }
                ?>
              </tr>
              <!--Form to add new amount -->
              <form method="POST" action="">
                
                <tr><td></td><td></td><td style="text-align: center;"   >

                  
                  <select name="class">
                    
                  <?php
                  $Classes=Module::ReadClasses();
                  foreach($Classes as $Class)
                  {
                    ?>
                    <option><?php echo $Class; ?></option>
                    <?php
                  }
                  ?>
                  </select>
                </td><td style="text-align: center;"   ><input type="text" name="session"></td><td style="text-align: center;"  ><input type="text" name="term"></td>
                  <td style="text-align: center;" ><input type="text" name="reg_fee"><td style="text-align: center;" ><input type="text" name="fee"></td><td style="text-align: center;" ><input type="text" name="book"></td><td style="text-align: center;" ><input type="text" name="lesson"></td><td style="text-align: center;" ><input type="text" name="pta"></td><td style="text-align: center;" ><input type="text" name="scard"></td><td style="text-align: center;" ><input type="submit" name="btnAdd" value="Add New"></td><td style="text-align: center;"  ><input type="reset" name="" value="Reset"></td></tr>
              </form>
              
              
            </tbody>
            <tfoot></tfoot>
          </table>
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
