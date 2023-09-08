<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$currentsession=Module::ReadCurrentSession();

if(isset($_GET['s']))
{
  if(isset($_GET['session']))
  {
    $session=$_GET['session'];
  }
  else
  {
    $session=$currentsession['session'];
  }

  if(isset($_GET['term']))
  {
    $term=$_GET['term'];
  }
  else
  {
    $term=$currentsession['term'];
  }
  
  $class=$_GET['class'];
}
else
{
  $session=$currentsession['session'];
  $term=$currentsession['term'];
  $class="Basic 1";
}

$feepayamount=Finance::ReadFee_Pay_AmountTermDetails($class,$session,$term);
  
$amount=$feepayamount['total'];
//$Level=Module::GetLevel($Class);

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

  <title><?php echo $session.", ".$term; ?> School Fee List</title>

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
      function savefee(id)
      {
        id=id.toUpperCase();

        var ref=document.getElementById(id+"ref").innerHTML;
        var reg_no=document.getElementById(id+"reg_no").innerHTML;
        var classs=document.getElementById(id+"class").innerHTML;
        var session=document.getElementById(id+"session").innerHTML;
        var term=document.getElementById(id+"term").innerHTML;
        var reg_fee=document.getElementById(id+"reg_fee").innerHTML;
        var fee=document.getElementById(id+"fee").innerHTML;
        var book=document.getElementById(id+"book").innerHTML;
        var pta=document.getElementById(id+"pta").innerHTML;
        var lesson=document.getElementById(id+"lesson").innerHTML;
        var scard=document.getElementById(id+"scard").innerHTML;

        ref=ref.toUpperCase();
        reg_no=reg_no;
        session=session;
        term=term;
        reg_fee=trimvalue(reg_fee);
        fee=trimvalue(fee);
        book=trimvalue(book);
        pta=trimvalue(pta);
        lesson=trimvalue(lesson);
        scard=trimvalue(scard);

        var amount=document.getElementById(id+"txtAmount").value;

        reg_fee=reg_fee||0;
        fee=fee||0;
        book=book||0;
        pta=pta||0;
        lesson=lesson||0;
        scard=scard||0;
        amount=amount||0;


        document.getElementById(id+"amount").innerHTML=eval(amount); 

        var totalpaid=eval(reg_fee)+eval(fee)+eval(book)+eval(pta)+eval(lesson)+eval(scard);
        var balance=amount-totalpaid;

        
        document.getElementById(id+"balance").innerHTML=balance;
        document.getElementById(id+"tPay").innerHTML=totalpaid;



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
        xmlhttp.open("GET", "savefee.php?id="+id+
          "&ref="+ref+
          "&reg_no="+reg_no+
          "&class="+classs+
          "&session="+session+
          "&term="+term+
          "&reg_fee="+reg_fee+

          "&fee="+fee+
          "&book="+book+
          "&pta="+pta+
          "&lesson="+lesson+
          "&scard="+scard
          , true);
        xmlhttp.send();
      } 

      function payallfee(id,ref,reg_no,term,session,classs)
      {

        id=id.toUpperCase();


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {            
            response=this.responseText;
            var details=response.split(';');

            document.getElementById(id+"reg_fee").innerHTML=details[0];
            document.getElementById(id+"fee").innerHTML=details[1];
            document.getElementById(id+"pta").innerHTML=details[2];
            document.getElementById(id+"lesson").innerHTML=details[3];
            document.getElementById(id+"book").innerHTML=details[4];
            document.getElementById(id+"scard").innerHTML=details[5];

            Toast(details[6]);       
            
          }
          else
          {
            Toast("Processing...");
          }
        };
        xmlhttp.open("GET", "saveallfees.php?id="+id+
          "&ref="+ref+
          "&term="+term+
          "&reg_no="+reg_no+
          "&session="+session+
          "&class="+classs
          , true);
        xmlhttp.send();
      }

      function clearfee(id)
      {        
        id=id.toUpperCase();

        document.getElementById(id+"reg_fee").innerHTML="";
        document.getElementById(id+"fee").innerHTML="";
        document.getElementById(id+"pta").innerHTML="";
        document.getElementById(id+"lesson").innerHTML="";
        document.getElementById(id+"book").innerHTML="";
        document.getElementById(id+"scard").innerHTML="";


        savefee(id);
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

<body id="page-top">

    <!-- DataTables Example -->
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
       SCHOOL FEES REPORT FOR <?php echo strtoupper("$class");  ?><BR/>
      <hd1><?php echo $session; ?> <?php echo $term; ?> TERM <br/><?php echo strtoupper("Printed on ".date("D M Y")) ?></center></div></b>
  </header>

        <table width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="20px"  valign='top' ><center>S/N</center></th>
              <th valign='top' >REG. NO.</th>

              <th valign='top' >STUDENT NAME</th>
              <th valign="top" ><center>CLASS</center></th>
              <th valign="top" ><center>SESSION</center></th>
              <th valign="top" ><center>TERM</center></th>
              <th valign="top" ><center>REG. FEE</center></th>
              <th valign="top" ><center>FEE</center></th>
              <th valign="top" ><center>BOOKS</center></th>
              <th valign="top" ><center>PTA</center></th>
              <th valign="top" ><center>LESSON FEE</center></th>
              <th valign="top" ><center>S-CARD</center></th>
              <th valign="top" ><center>AMOUNT</center></th>
              <th valign="top" ><center>TOTAL PAID</center></th>
              <th valign="top" ><center>BALANCE</center></th>
              <th valign="top" ><center>REF</center></th>
              <th valign="top" ><center>TIMESTAMP</center></th>
            </tr>
          </thead>
          <tbody>
          <?php

          $Fees=Finance::ReadAllFee_PayClass($class,$session,$term);
          
          foreach($Fees as $Fee)
          {
            $count++;
            $feeDetails=Finance::ReadFee_PayDetails($Fee);

            $feepayamount=Finance::ReadFee_Pay_AmountTermDetails($class,$feeDetails['session'],$feeDetails['term']);

            $studentDetails=Module::ReadStudentDetailsp($feeDetails['reg_no']);
            ?>
            <tr id="<?php echo $feeDetails['id']; ?>" title="<?php echo $feeDetails['id']; ?>" >

              <?php
              $ref=$feeDetails['id'];
              $amount=$feepayamount['total'];

              ?>
              <td><center><?php echo $count; ?></center></td>

              <td id="<?php echo $feeDetails['id']; ?>reg_no" title="<?php echo $studentDetails['names']; ?> Register Number" ><?php echo $feeDetails['reg_no']; ?></td>

              <td id="<?php echo $feeDetails['id']; ?>names" title="<?php echo $studentDetails['names']; ?> Name" ><?php echo $studentDetails['names']; ?></td>

              <td style="text-align: center;"  contenteditable="false" id="<?php echo $feeDetails['id']; ?>class" title="<?php echo $studentDetails['names']; ?>  Session" ><?php echo $feeDetails['class']; ?></td>

              <td style="text-align: center;"  contenteditable="false" id="<?php echo $feeDetails['id']; ?>session" title="<?php echo $studentDetails['names']; ?>  Session" ><?php echo $feeDetails['session']; ?></td>

              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>term" title="<?php echo $studentDetails['names']; ?> Term" ><?php echo $feeDetails['term']; ?></td>

              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>reg_fee" title="<?php echo $studentDetails['names']; ?> Registration Fee"  ><?php if($feeDetails['reg_fee']>0){echo $feeDetails['reg_fee'];}  ?></td>

              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>fee" title="<?php echo $studentDetails['names']; ?> Fee" ><?php  if($feeDetails['fee']>0){echo $feeDetails['fee'];} ?></td>
              
              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>book" title="<?php echo $studentDetails['names']; ?> Book" ><?php  if($feeDetails['book']>0){echo $feeDetails['book'];} ?></td>
              
              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>pta" title="<?php echo $studentDetails['names']; ?> PTA Fee" ><?php  if($feeDetails['pta']>0){echo $feeDetails['pta'];} ?></td>

              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>lesson" title="<?php echo $studentDetails['names']; ?> Lesson Fee" ><?php if($feeDetails['lesson']>0){echo $feeDetails['lesson'];} ?></td>

              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>scard" title="<?php echo $studentDetails['names']; ?> Scratch Card" ><?php  if($feeDetails['scard']>0){echo $feeDetails['scard'];}  ?></td>

              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>amount" title="<?php echo $studentDetails['names']; ?> Payable Amount" ><?php echo $feepayamount['total']; ?></td>

              <?php 

              $amount=$feepayamount['total'];

              $tPay=$feeDetails['total'];

              $balance=$amount-$tPay;

              ?>
              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>tPay" title="<?php echo $studentDetails['names']; ?> Total Amount Paid" ><?php echo $tPay ?></td>

              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>balance" title="<?php echo $studentDetails['names']; ?> Balance" ><?php echo $balance ?></td>

              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>ref" title="<?php echo $studentDetails['names']; ?> Payment Reference" ><?php echo $feeDetails['ref']; ?></td>

              <td style="text-align: center;" contenteditable="false" id="<?php echo $feeDetails['id']; ?>timestamp" title="<?php echo $studentDetails['names']; ?> Date of Transaction" ><?php echo $feeDetails['timestamp']; ?></td>
            </tr>
            <?php                    
          }
          ?>
        </tbody>
    </table>
  <!-- /#wrapper -->

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
