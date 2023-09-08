<?php session_start();
include '../Module.php';
  if(isset($_POST['btnAdd']))
  {
    $yc=$_POST['txtYC'];
    $level=$_POST['txtLevel'];
    if(Module::AddClassp($_POST['txtClass'],$_POST['txtYC'],$_POST['txtLevel']))
    {
      $msg="Successful";
    }
    else{
      if(Module::IsClassExistp($_POST['txtClass']))
      {
        $msg="Class have been saved before";
      }
      else
      {
        $msg="Something went wrong";
      }
    }
  }
  $Classes=Module::ReadIdClasses();
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

  <title>Dashboard</title>
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

      function deleteclass(id)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            HideThis('row'+id);
            Toast(this.responseText);
          }
          else
          {
            Toast("Loading...");
          }
        };
        xmlhttp.open("GET", "deleteclassp.php?id="+id
          , true);
        xmlhttp.send();
      }

      function updateclass(key,id,oclass,classs,yc,level)
      {
        if(key==9)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              document.getElementById(id+"oclass").innerHTML = classs;
              Toast(this.responseText);
            }
            else
            {
              Toast("Loading...");
            }
          };
          xmlhttp.open("GET", "updateclassp.php?oclass="+oclass+"&classs="+classs+"&yc="+yc+"&level="+level, true);
          xmlhttp.send();          
        }
      }

      function toggleMenu(btn,menu)
      {

        if(document.getElementById(menu).style.display=='none')
        {
          document.getElementById(menu).style.display='block';
          document.getElementById(btn).innerHTML='Hide Menu';
        }
        else
        {          
          document.getElementById(menu).style.display='none';
          document.getElementById(btn).innerHTML='Show Menu';
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
       CLASSES REPORT <BR/>
      <hd1><?php echo strtoupper("Printed on ".date("D M Y")) ?></center></div></b>
  </header>
  <table cellspacing="0" width="100%">
    <thead>
      <tr>
        <th  width="40px" valign='top'>ID</th>
        <th valign='top'>CLASS</th>
        <th valign='top'>YC</th>
        <th valign='top'>LEVEL</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $count=0;
      foreach($Classes as $id)
      {
        $classDetails=Module::ReadClassLibraryIdDetailsp($id);
        $class=$classDetails['class'];
        $id=$classDetails['id'];
        $yc=$classDetails['yc'];
        $level=$classDetails['level'];
        $count++;

        ?>
        <span id="<?php echo $id."oclass"; ?>" style="display: none"><?php echo $class; ?></span>
        
        <tr id="row<?php echo $id; ?>">
          <td><center><?php echo $count; ?></center></td>
          <td id="<?php echo $id.'class'; ?>" contenteditable="false" title="<?php echo $id.'class'; ?>"><?php echo $class;  ?></td>
          <td id="<?php echo $id.'yc'; ?>" contenteditable="false" title="<?php echo $id.'yc'; ?>"><?php echo $yc;  ?></td>
          <td id="<?php echo $id.'level'; ?>" contenteditable="false" title="<?php echo $id.'level'; ?>"><?php echo $level;  ?></td>
          <?php   
        }
        ?>
      </tr>
    </tbody>
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
