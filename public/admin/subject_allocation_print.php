<?php session_start();
include '../Module.php';

$session=Module::ReadCurrentSession();
$Session=$session['session'];
$Term=$session['term'];

    if(isset($_POST['btnAdd'])){
      $nTeacher=$_POST['txtTeacher'];
      $nSubject=$_POST['txtsubjectp'];
      $nClass=$_POST['txtClass'];
      $nSession=$_POST['txtSession'];
      $nTerm=$_POST['txtTerm'];
      $nLevel=$_POST['txtLevel'];

      if(Module::IsAllocationExist($nSubject,$nSession,$nTerm,$nClass))
      {
        echo "Subject Exist <br/>";
      }
      else
      {
        if(Module::AddAllocation($nTeacher,$nSubject,$nClass,$nSession,$nTerm,$nLevel))
        {
          echo "Added Sucessfully <br/>";
        }
        else
        {
          echo "Not Added <br/>";
        }
        
      }
    }


  $Subjects=Module::ReadAllSubjectAllocations();
?>

<!DOCTYPE html>
<html lang="en">

<head> 
  <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Subject Allocation</title>
  <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../dashboard/css/sb-admin.css" rel="stylesheet">

  <style type="text/css">
    select{
      width: 98%;
    }
  </style>
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

      function Toast(message){
        // Get the snackbar DIV
        var x = document.getElementById("snackbar");
        x.innerHTML=message;

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      } 

      function loadSubjectItems(classs)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("txtsubjectp").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("txtsubjectp").innerHTML = "Loading...";
          }
        };
        xmlhttp.open("GET", "../result/loadsubjectitems.php?classs="+classs, true);
        xmlhttp.send();
      }

      function loadsubjectitems(classs)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("txtsubjectp").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("txtsubjectp").innerHTML = "Loading...";
          }
        };
        xmlhttp.open("GET", "../result/loadsubjectitems.php?classs="+classs, true);
        xmlhttp.send();
      }

      function saveallocation(id,teacher,classs,session,term)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            Toast(this.responseText);
          }
          else
          {
            Toast("Loading...");
          }
        };
        xmlhttp.open("GET", "savesubjectallocationp.php?id="+id+"&teacher="+teacher+"&classs="+classs+"&session="+session+"&term="+term
          , true);
        xmlhttp.send();
      }

      function deleteallocation(id)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            Toast(this.responseText);
            HideThis('row'+id);
          }
          else
          {
            Toast("Loading...");
          }
        };
        xmlhttp.open("GET", "deleteallocationp.php?id="+id
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
    <div class="bheader"><center><img src="../images/school/logo.png" width="100px"><br/><b ><hd>DUBAI CARE SCHOOL</hd></b><br/>
       SUBJECTS' ALLOCATION REPORT <BR/>
      <hd1><?php echo strtoupper("Printed on ".date("D M Y")) ?></center></div></b>
  </header>
            <table cellspacing="0" width="100%">
              <thead><tr><td valign='top'>ID</td><td valign='top'>TEACHER</td><td   valign='top'>CLASS</td><td   valign='top'>SUBJECT</td><td   valign='top'>SESSION</td><td   valign='top'>TERM</td><td   valign='top'>LEVEL</td></tr></thead>
              <tbody>
                <?php
                $count=0;
                foreach($Subjects as $id)
                { 
                  $subjectDetails=Module::ReadAllocationDetails($id);
                  $subject=$subjectDetails['subject'];
                  $id=$subjectDetails['id'];
                  $staffid=$subjectDetails['staffid'];
                  $level=$subjectDetails['level'];
                  $class=$subjectDetails['class'];
                  $term=$subjectDetails['term'];
                  $session=$subjectDetails['session'];


                  ?>
                  <tr id="row<?php echo $id; ?>" >
                  <td><center><?php echo $id; ?></center></td>

                  <td id="<?php echo $id;  ?>teache"  
                      onkeyup="if(event.keyCode==9){saveallocation('<?php echo $id; ?>',
                        document.getElementById('<?php echo $id;?>teache').innerHTML,
                        document.getElementById('<?php echo $id;?>subjec').innerHTML,
                        document.getElementById('<?php echo $id;?>clas').innerHTML,
                        document.getElementById('<?php echo $id;?>sessio').innerHTML,
                        document.getElementById('<?php echo $id;?>ter').innerHTML,
                        document.getElementById('<?php echo $id;?>leve').innerHTML)}" contenteditable="true"><?php echo $staffid;  ?></td>

                  <td id="<?php echo $id;  ?>clas"  onkeyup="if(event.keyCode==9){saveallocation('<?php echo $id; ?>',
                        document.getElementById('<?php echo $id;?>teache').innerHTML,
                        document.getElementById('<?php echo $id;?>subjec').innerHTML,
                        document.getElementById('<?php echo $id;?>clas').innerHTML,
                        document.getElementById('<?php echo $id;?>sessio').innerHTML,
                        document.getElementById('<?php echo $id;?>ter').innerHTML,
                        document.getElementById('<?php echo $id;?>leve').innerHTML)}" contenteditable="true"><?php echo $class;  ?></td> 

                  <td id="<?php echo $id;  ?>subjec"  onkeyup=" if(event.keyCode==9){saveallocation('<?php echo $id; ?>',
                        document.getElementById('<?php echo $id;?>teache').innerHTML,
                        document.getElementById('<?php echo $id;?>subjec').innerHTML,
                        document.getElementById('<?php echo $id;?>clas').innerHTML,
                        document.getElementById('<?php echo $id;?>sessio').innerHTML,
                        document.getElementById('<?php echo $id;?>ter').innerHTML,
                        document.getElementById('<?php echo $id;?>leve').innerHTML)}" contenteditable="true"><?php echo $subject;  ?></td>

                  <td id="<?php echo $id;  ?>sessio"  onkeyup="if(event.keyCode==9){saveallocation('<?php echo $id; ?>',
                        document.getElementById('<?php echo $id;?>teache').innerHTML,
                        document.getElementById('<?php echo $id;?>subjec').innerHTML,
                        document.getElementById('<?php echo $id;?>clas').innerHTML,
                        document.getElementById('<?php echo $id;?>sessio').innerHTML,
                        document.getElementById('<?php echo $id;?>ter').innerHTML,
                        document.getElementById('<?php echo $id;?>leve').innerHTML)}"  contenteditable="true"><?php echo $session;  ?></td> 

                  <td id="<?php echo $id;  ?>ter"  onkeyup="if(event.keyCode==9){saveallocation('<?php echo $id; ?>',
                        document.getElementById('<?php echo $id;?>teache').innerHTML,
                        document.getElementById('<?php echo $id;?>subjec').innerHTML,
                        document.getElementById('<?php echo $id;?>clas').innerHTML,
                        document.getElementById('<?php echo $id;?>sessio').innerHTML,
                        document.getElementById('<?php echo $id;?>ter').innerHTML,
                        document.getElementById('<?php echo $id;?>leve').innerHTML)}" contenteditable="true"><?php echo $term;  ?></td> 

                  <td id="<?php echo $id;  ?>leve"  onkeyup="if(event.keyCode==9){saveallocation('<?php echo $id; ?>',
                        document.getElementById('<?php echo $id;?>teache').innerHTML,
                        document.getElementById('<?php echo $id;?>subjec').innerHTML,
                        document.getElementById('<?php echo $id;?>clas').innerHTML,
                        document.getElementById('<?php echo $id;?>sessio').innerHTML,
                        document.getElementById('<?php echo $id;?>ter').innerHTML,
                        document.getElementById('<?php echo $id;?>leve').innerHTML)}" contenteditable="true"><?php echo $level;  ?></td>    

                  <?php       
                }
                ?>
              </tbody>
              <tfoot></tfoot>
            </table>
  <!-- Bootstrap core JavaScript-->
  <script src="../dashboard/vendor/jquery/jquery.min.js"></script>
  <script src="../dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../dashboard/vendor/chart.js/Chart.min.js"></script>
  <script src="../dashboard/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../dashboard/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../dashboard/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../dashboard/js/demo/datatables-demo1.js"></script>

  <!-- Result Javascript-->  
  <script src="../js/result.js"></script>

</body>

</html>