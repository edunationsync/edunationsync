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

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php"><img src="../images/school/favicon.png"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="../student_almanac.php">
      <div class="input-group">
        <input type="text" name="src" id="src" class="form-control" value="<?php echo $_GET['src']; ?>" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <p class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa- fa-f"></i>
          <span class="badge badge-danger"><?php if(count($NewAlerts)>10){ echo "10+";}else{echo count($NewAlerts);} ?></span>
        </a>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="messages.php" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger"><?php if(count($NewMessages)>10){ echo "10+";}else{echo count($NewMessages);} ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewAlerts)>0)
            {
              foreach($NewAlerts as $Alrt)
              {
                $alrtDetails=Message::ReadDetails($Alrt);
                ?>
                <a href="messages.php?id=<?php echo $alrtDetails['id']; ?>" title="<?php echo $alrtDetails['sender']; ?>"><div><?php echo $alrtDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="messages.php">View All</a>
          <a class="dropdown-item" href="?clearer=yes&type=alert">Clear Alerts</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewMessages)>0)
            {
              foreach($NewMessages as $Msg)
              {
                $msgDetails=Message::ReadDetails($Msg);
                ?>
                <a href="messages.php?id=<?php echo $msgDetails['id']; ?>" title="Sent By: <?php echo $msgDetails['sender']; ?>"><div><?php echo $msgDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="messages.php">Show Messages</a>
          <a class="dropdown-item" href="?clearer=yes&type=message">Clear Messages</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
          if($_SESSION['lgina'])
          {
            ?>
            <img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 20px; height: 20px; border-radius: 100%;">
            <?php
          }
          else
          {
            ?>          
            <i class="fas fa-user-circle fa-fw"></i>
            <?php
          }
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="users/changepassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="users/changepassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="users"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <div id="content-wrapper">

      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()" style="background: red; color: white; padding: 4px 4px 4px 4px; border-radius: 5px">Back</a>
          </li>
          <div style="padding-left: 25px">
            <a href="../" title="Main Dashboard"><i class="fas fa-fw fa-home"></i> Home</a> | <a href="../dashboard/" title="Main Dashboard">Dashboard</a> | <a href="../admin" title="Admin Dashboard">Admin Dashboard</a> | <a href="../result/">Result Dashboard</a> | <a href="subject_library.php" title="Subject Library">Subjects</a> | <a href="../admin/student_subject_registration.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>" title="Subject registration for Students">Subject Registration</a> | <a href="../admin/subject_allocation.php" title="Subject Allocation to Teachers">Subject Allocation</a> | <a href="../admin/class_library.php" title="Class Library">Class Library</a> | <a href="../admin/class_allocation.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>" title="Form Masters Class Allocation">Class Allocation</a>
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px">
            <a href="../dashboard/users/album.php">Album</a> | <a href="../dashboard/users/documents.php">Documents</a> | <a href="../dashboard/users/allstudents.php?txtclassp=<?php echo $Class; ?>" title="Students List">Students</a> | <a href="../dashboard/users/allstaff.php">Staff List</a> | <a href="../dashboard/innovation">Innovation</a> | <a href="../dashboard/messaging">Messaging</a> | <a href="../dashboard/webmaster">Webmaster</a> | <a href="../dashboard/grade_point">Grade Point</a> | <a href="../dashboard/finance">Finance</a>
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Icon Cards-->
        <div class="row" style="padding: 15px 15px 15px 15px">
          <table cellspacing="0" width="100%">
            <thead>
              <tr>
                <th  width="40px" valign='top'></th>
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
                
                <tr id="row<?php echo $id; ?>" onkeyup="updateclass(event.keyCode,'<?php echo $id; ?>',document.getElementById('<?php echo $id."oclass"; ?>').innerHTML,document.getElementById('<?php echo $id."class"; ?>').innerHTML,document.getElementById('<?php echo $id."yc"; ?>').innerHTML,document.getElementById('<?php echo $id."level"; ?>').innerHTML)">
                    
                  <td><button onclick="deleteclass('<?php echo $id;  ?>');" class="btn btn-danger"><img src='delete.png'></button></td>
                  <td><center><?php echo $count; ?></center></td>
                  <td id="<?php echo $id.'class'; ?>" contenteditable="true" title="<?php echo $id.'class'; ?>"><?php echo $class;  ?></td>
                  <td id="<?php echo $id.'yc'; ?>" contenteditable="true" title="<?php echo $id.'yc'; ?>"><?php echo $yc;  ?></td>
                  <td id="<?php echo $id.'level'; ?>" contenteditable="true" title="<?php echo $id.'level'; ?>"><?php echo $level;  ?></td>
                  <?php   
                }
                ?>
              </tr>
            </tbody>
            <form method="POST" action="">
              <tr>
                <td>New</td><td>*</td>
                <td><input type="text" id="txtClass" name="txtClass" autofocus="true" required="required"></td>
                <td><input type="text" id="txtYC" name="txtYC"  required="required"></td>
                <td>
                  <select id="txtLevel" name="txtLevel" required="required">
                    <option>Junior</option>
                    <option>Senior</option>
                  </select>
                </td>
                <td><button style="float: right" name="btnAdd" id="btnAdd"><img src="save.png"></button></td></tr>
            </form>
            <tfoot></tfoot>
          </table>

          <footer></footer>
        </div>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>




  <!-- The actual snackbar -->
  <div id="snackbar"></div>

  <div id="preloader" style="display: none">
    <div id="loader"><b style="background: red; color: white; padding: 5px 5px 5px 5px">Saving</b></div>
  </div>

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
