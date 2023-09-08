<?php
include '../Module.php';

if(!isset($_GET['session'])&&!isset($_GET['term']))
{
  $currentsession=Module::ReadCurrentSession();
  $_GET['session']=$currentsession['session'];
  $_GET['term']=$currentsession['term'];
}

  $Session=$_GET['session'];
  $Term=$_GET['term'];
  if(isset($_POST['btnAdd']))
  {
    if(Module::AddSubjectp($_POST['txtSubject'],$_POST['txtShortcode']))
    {
      $msg="Successful";
    }
    else{
      if(Module::IsSubjectLibraryExistp($_POST['txtSubject']))
      {
        $msg="Subject have been saved before";
      }
      else
      {
        $msg="Something went wrong";
      }
    }
  }

  $Subjects=Module::ReadSubjectLibraryp();
  $Classes=Module::ReadClasses();
  sort($Classes);
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

  <title>Subject Library</title>
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

      function Toast(message) {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar");
        x.innerHTML=message;

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }

      function registerclasssubject(id,subject,shortcode,session,term,classs)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            Toast(subject+' was '+this.responseText+' for '+classs);
            document.getElementById(id).style.background="red";
            document.getElementById(id+'chkbox').checked="true";
          }
          else
          {            
            Toast( "Loading...");
          }
        };
        xmlhttp.open("GET", "saveclasssubjectregistration.php?subject="+subject+"&shortcode="+shortcode+"&session="+session+"&term="+term+"&classs="+classs, true);
        xmlhttp.send();
      }

      function deregisterclasssubject(id,subject,shortcode,session,term,classs)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            Toast(subject+' was '+this.responseText+' for '+classs);
            document.getElementById(id).style.background="transparent";
            document.getElementById(id+'chkbox').checked="false";
          }
          else
          {            
            Toast( "Loading...");
          }
        };
        xmlhttp.open("GET", "cancelclasssubjectregistration.php?subject="+subject+"&shortcode="+shortcode+"&session="+session+"&term="+term+"&classs="+classs, true);
        xmlhttp.send();
      }

      function deletesubject(id)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            HideThis('row'+id);
            Toast(subject+' was '+this.responseText+' for '+classs);            
          }
          else
          {                        
            Toast( "Loading...");
          }
        };
        xmlhttp.open("GET", "deletesubjectp.php?id="+id
          , true);
        xmlhttp.send();
      }

      function updatesubject(key,id,osubject,subject,shortcode)
      {
        if(key==9)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              document.getElementById(id+"osub").innerHTML = subject;
              document.getElementById("preloader").style.display="none";
              Toast(subject+' was '+this.responseText+' for '+classs);
            }
            else
            {            
            Toast( "Loading...");
            }
          };
          xmlhttp.open("GET", "updatesubjectp.php?subject="+subject+"&osubject="+osubject+"&shortcode="+shortcode, true);
          xmlhttp.send();          
        }
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
       SCHOOL SUBJECT LIST REPORT<BR/>
      <hd1><?php echo strtoupper($Session); ?> <?php echo strtoupper($Term); ?> TERM <br/><?php echo strtoupper("Printed on ".date("D M Y")) ?></center></div></b>
  </header>
            <table cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th  width="40px" valign='top'>ID</th>
                  <th valign='top'>SUBJECT</th>
                  <th valign='top'>SHORT CODE</th>
                  <?php
                  foreach($Classes as $Class)
                  {
                    ?>
                    <th valign='top' width="20px"><?php echo $Class; ?></th>
                    <?php
                  }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $count=0;
                foreach($Subjects as $id)
                {
                  $subjectDetails=Module::ReadSubjectLibraryIdDetailsp($id);
                  $subject=$subjectDetails['subject'];
                  $id=$subjectDetails['id'];
                  $shortcode=$subjectDetails['short_code'];
                  $count++;
                  ?>
                  <span id="<?php echo $id."osub"; ?>" style="display: none"><?php echo $subject; ?></span>
                  <tr id="row<?php echo $id; ?>" onkeyup="updatesubject(event.keyCode,'<?php echo $id; ?>',document.getElementById('<?php echo $id."osub"; ?>').innerHTML,document.getElementById('<?php echo $id."sub"; ?>').innerHTML,document.getElementById('<?php echo $id."shortc"; ?>').innerHTML)">
                      
                      <td><center><?php echo $count; ?></center></td>
                      <td id="<?php echo $id.'sub'; ?>" contenteditable="false" title="<?php echo $id.'sub'; ?>"><?php echo $subject;  ?></td>
                      <td id="<?php echo $id.'shortc'; ?>" contenteditable="false" title="<?php echo $id.'shortc'; ?>"><?php echo $shortcode;  ?></td>
                      <?php
                      foreach($Classes as $class)
                      {
                        ?>
                        <td valign='top' align="center" <?php if (Module::IsClassSubjectRegisteredp($subject,$shortcode,$class,$Session,$Term)): ?>
                          style="background:none"

                        <?php else: ?>
                          
                        <?php endif ?>  id="<?php echo $class.$subject; ?>" title="<?php echo $class.$subject; ?>"><input type="checkbox" id="<?php echo $class.$subject; ?>chkbox" <?php if (Module::IsClassSubjectRegisteredp($subject,$shortcode,$class,$Session,$Term)): ?>
                          style="background:none"
                          checked='true'
                        <?php endif ?>></td>
                        <?php
                      }      
                    }
                    ?>
                  </tr>
              </tbody>
            </table>
  <!-- /#wrapper -->
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
