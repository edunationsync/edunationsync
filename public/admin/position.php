<?php
include '../Module.php';

  if(isset($_POST['btnAdd']))
  {
      if(Position::IsExist($_POST['id']))
      {
        $msg="Already Exist";
      }
      else
      {
        if(Position::AddNew($_POST['post'],$_POST['type'],$_POST['description'],$_POST['privileges']))
        {
          $msg="Position Added Successfully";
        }
        else
        {
          $msg="Error Occured, Try again later";
        }        
      }
  }

  $Positions=Position::ReadAllPositions();
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

  <title>Position Manager</title>
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

      function deleteposition(id)
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
            Toast( "Loading...");
          }
        };
        xmlhttp.open("GET", "deleteposition.php?id="+id, true);
        xmlhttp.send();
      }

      function processPrivilege(id,privilege)
      {
        if(document.getElementById(id).checked===true)
        {
          document.getElementById(id).style.display="none";
          document.getElementById(id+"_label").style.display="none";
          document.getElementById('privileges').innerHTML=document.getElementById('privileges').innerHTML+privilege;
        }
      }

      function updateposition(key,id,post,type,description,privileges)
      {
        if(key==9)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              document.getElementById("preloader").style.display="none";
              Toast(post+' was '+this.responseText);
            }
            else
            {            
            Toast( "Loading...");
            }
          };
          xmlhttp.open("GET", "updateposition.php?post="+post+"&type="+type+"&description="+description+"&privileges="+privileges+"&id="+id, true);
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

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../"><img src="../images/school/favicon.png"></a>

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
          <a class="dropdown-item" href="../users/changepassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="../users/changepassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="../users"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->

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


          <div class="content">
            <div style="width: 100%; text-align: center; font-size: 20px; font-weight: bolder; padding: 10px 10px 10px 10px; background: lightgreen; ">POSITIONS EXPLORER</div>
            <table cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th  width="40px" valign='top'></th>
                  <th  width="40px" valign='top'>ID</th>
                  <th valign='top'>POST</th>
                  <th valign='top'>TYPE</th>
                  <th valign='top'>DESCRIPTION</th>
                  <th valign='top'>PRIVILEGES</th>
                  <th valign='top'>TIMESTAMP</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count=0;
                foreach($Positions as $id)
                {
                  $positionDetails=Position::ReadDetails($id);
                  $post=$positionDetails['post'];
                  $type=$positionDetails['type'];
                  $description=$positionDetails['description'];
                  $privileges=$positionDetails['privileges'];
                  $timestamp=$positionDetails['timestamp'];
                  $count++;
                  ?>

                  <tr id="row<?php echo $id; ?>" onkeyup="updateposition(event.keyCode,'<?php echo $id; ?>',document.getElementById('<?php echo $id."post"; ?>').innerHTML,document.getElementById('<?php echo $id."type"; ?>').innerHTML,document.getElementById('<?php echo $id."description"; ?>').innerHTML,document.getElementById('<?php echo $id."privileges"; ?>').innerHTML)">
                      <td><button onclick="deleteposition('<?php echo $id;  ?>');"><img src='delete.png' width='20px' height='20px'></button></td>
                      <td><center><?php echo $count; ?></center></td>
                      <td id="<?php echo $id.'post'; ?>" contenteditable="true" title="<?php echo $id.'post'; ?>"><?php echo $post;  ?></td>
                      <td id="<?php echo $id.'type'; ?>" contenteditable="true" title="<?php echo $id.'type'; ?>"><?php echo $type;  ?></td>
                      <td id="<?php echo $id.'description'; ?>" contenteditable="true" title="<?php echo $id.'description'; ?>"><?php echo $description;  ?></td> 
                      <td id="<?php echo $id.'privileges'; ?>" contenteditable="true" title="<?php echo $id.'privileges'; ?>"><?php echo $privileges;  ?></td> 
                      <td id="<?php echo $id.'timestamp'; ?>"  title="<?php echo $id.'timestamp'; ?>"><?php echo $timestamp;  ?></td>                    
                  </tr>
                   <?php
                }
                  ?>
              </tbody>
              <form method="POST" action="">
                <tr>
                  <td>New</td><td>*</td>
                  <td><input type="text" id="post" name="post" autofocus="true" required="required"></td>
                  <td><select id="type" name="type"><option>Admin</option><option>Ad-hoc Staff</option><option>Staff</option><option>Student</option><option>Parent</option></select></td>
                  <td><textarea id="description" name="description"></textarea></td>
                  <td><textarea id="privileges" name="privileges"></textarea></td>
                  <td>
                    <div>
                      <p>Main Dashboard Icons</p>
                      <input type="checkbox" name="My_dashboard" id="My_dashboard" value="My_dashboard; " onchange="processPrivilege(this.id,this.value);"><label for="My_dashboard"  id="My_dashboard_label">My_dashboard</label> 
                      <input type="checkbox" name="Profile_picture" id="Profile_picture" value="Profile_picture; " onchange="processPrivilege(this.id,this.value);"><label for="Profile_picture"  id="Profile_picture_label">Profile_picture</label>

                      <input type="checkbox" name="My_students" id="My_students" value="My_students; " onchange="processPrivilege(this.id,this.value);"><label for="My_students"  id="My_students_label">My_students</label> 

                      <input type="checkbox" name="Admin" id="Admin" value="Admin; " onchange="processPrivilege(this.id,this.value);"><label for="Admin"  id="Admin_label">Admin</label> 

                      <input type="checkbox" name="My_wards" id="My_wards" value="My_wards; " onchange="processPrivilege(this.id,this.value);"><label for="My_wards"  id="My_wards_label">My_wards</label> 

                      <input type="checkbox" name="Innovations" id="Innovations" value="Innovations; " onchange="processPrivilege(this.id,this.value);"><label for="Innovations"  id="Innovations_label">Innovations</label> 

                      <input type="checkbox" name="Album" id="Album" value="Album; " onchange="processPrivilege(this.id,this.value);"><label for="Album"  id="Album_label">Album</label> 

                      <input type="checkbox" name="Documents" id="Documents" value="Documents; " onchange="processPrivilege(this.id,this.value);"><label for="Documents"  id="Documents_label">Documents</label> 

                      <input type="checkbox" name="Finance" id="Finance" value="Finance; " onchange="processPrivilege(this.id,this.value);"><label for="Finance"  id="Finance_label">Finance</label> 

                      <input type="checkbox" name="Results" id="Results" value="Results; " onchange="processPrivilege(this.id,this.value);"><label for="Results"  id="Results_label">Results</label> 
                    </div>
                    <div>
                      <p>Admin Dashboard Icons</p>

                      <input type="checkbox" name="Post_manager" id="Post_manager" value="Post_manager; " onchange="processPrivilege(this.id,this.value);"><label for="Post_manager"  id="Post_manager_label">Post_manager</label> 

                      <input type="checkbox" name="Student_manager" id="Student_manager" value="Student_manager; " onchange="processPrivilege(this.id,this.value);"><label for="Student_manager"  id="Student_manager_label">Student_manager</label> 

                      <input type="checkbox" name="Staff_manager" id="Staff_manager" value="Staff_manager; " onchange="processPrivilege(this.id,this.value);"><label for="Staff_manager"  id="Staff_manager_label">Staff_manager</label> 

                      <input type="checkbox" name="Subject_manager" id="Subject_manager" value="Subject_manager; " onchange="processPrivilege(this.id,this.value);"><label for="Subject_manager"  id="Subject_manager_label">Subject_manager</label> 

                      <input type="checkbox" name="Subject_registration" id="Subject_registration" value="Subject_registration; " onchange="processPrivilege(this.id,this.value);"><label for="Subject_registration"  id="Subject_registration_label">Subject_registration</label> 

                      <input type="checkbox" name="Subject_allocation" id="Subject_allocation" value="Subject_allocation; " onchange="processPrivilege(this.id,this.value);"><label for="Subject_allocation"  id="Subject_allocation_label">Subject_allocation</label> 

                      <input type="checkbox" name="Class_manager" id="Class_manager" value="Class_manager; " onchange="processPrivilege(this.id,this.value);"><label for="Class_manager"  id="Class_manager_label">Class_manager</label> 

                      <input type="checkbox" name="Class_allocation" id="Class_allocation" value="Class_allocation; " onchange="processPrivilege(this.id,this.value);"><label for="Class_allocation"  id="Class_allocation_label">Class_allocation</label> 

                      <input type="checkbox" name="Result_settings" id="Result_settings" value="Result_settings; " onchange="processPrivilege(this.id,this.value);"><label for="Result_settings"  id="Result_settings_label">Result_settings</label> 

                      <input type="checkbox" name="Grade_point_manager" id="Grade_point_manager" value="Grade_point_manager; " onchange="processPrivilege(this.id,this.value);"><label for="Grade_point_manager"  id="Grade_point_manager_label">Grade_point_manager</label> 

                      <input type="checkbox" name="Finance_manager" id="Finance_manager" value="Finance_manager; " onchange="processPrivilege(this.id,this.value);"><label for="Finance_manager"  id="Finance_manager_label">Finance_manager</label> 

                      <input type="checkbox" name="Official_letters" id="Official_letters" value="Official_letters; " onchange="processPrivilege(this.id,this.value);"><label for="Official_letters"  id="Official_letters_label">Official_letters</label> 

                      <input type="checkbox" name="Napps" id="Napps" value="Napps; " onchange="processPrivilege(this.id,this.value);"><label for="Napps"  id="Napps_label">Napps</label> 

                    </div>

                    <div>
                      <p>Result Dashboard Icons</p>

                      <input type="checkbox" name="Ca_sheet_explorer" id="Ca_sheet_explorer" value="Ca_sheet_explorer; " onchange="processPrivilege(this.id,this.value);"><label for="Ca_sheet_explorer"  id="Ca_sheet_explorer_label">Ca_sheet_explorer</label> 

                      <input type="checkbox" name="Master_sheet" id="Master_sheet" value="Master_sheet; " onchange="processPrivilege(this.id,this.value);"><label for="Master_sheet"  id="Master_sheet_label">Master_sheet</label> 

                      <input type="checkbox" name="Result_verifier" id="Result_verifier" value="Result_verifier; " onchange="processPrivilege(this.id,this.value);"><label for="Result_verifier"  id="Result_verifier_label">Result_verifier</label> 

                      <input type="checkbox" name="Individual_result_verifier" id="Individual_result_verifier" value="Individual_result_verifier; " onchange="processPrivilege(this.id,this.value);"><label for="Individual_result_verifier"  id="Individual_result_verifier_label">Individual_result_verifier</label> 

                      <input type="checkbox" name="Psychomotor_ratings" id="Psychomotor_ratings" value="Psychomotor_ratings; " onchange="processPrivilege(this.id,this.value);"><label for="Psychomotor_ratings"  id="Psychomotor_ratings_label">Psychomotor_ratings</label>

                      <input type="checkbox" name="Attendance" id="Attendance" value="Attendance; " onchange="processPrivilege(this.id,this.value);"><label for="Attendance"  id="Attendance_label">Attendance</label>  

                      <input type="checkbox" name="Result_cover_pages" id="Result_cover_pages" value="Result_cover_pages; " onchange="processPrivilege(this.id,this.value);"><label for="Result_cover_pages"  id="Result_cover_pages_label">Result_cover_pages</label> 

                      <input type="checkbox" name="All_result_covers" id="All_result_covers" value="All_result_covers; " onchange="processPrivilege(this.id,this.value);"><label for="All_result_covers"  id="All_result_covers_label">All_result_covers</label> 

                      <input type="checkbox" name="Admin_result_checker" id="Admin_result_checker" value="Admin_result_checker; " onchange="processPrivilege(this.id,this.value);"><label for="Admin_result_checker"  id="Admin_result_checker_label">Admin_result_checker</label> 

                      <input type="checkbox" name="Printable_students_results" id="Printable_students_results" value="Printable_students_results; " onchange="processPrivilege(this.id,this.value);"><label for="Printable_students_results"  id="Printable_students_results_label">Printable_students_results</label> 

                      <input type="checkbox" name="Position_processor" id="Position_processor" value="Position_processor; " onchange="processPrivilege(this.id,this.value);"><label for="Position_processor"  id="Position_processor_label">Position_processor</label> 

                      <input type="checkbox" name="Cummumulative_position_processor" id="Cummumulative_position_processor" value="Cummumulative_position_processor; " onchange="processPrivilege(this.id,this.value);"><label for="Cummumulative_position_processor"  id="Cummumulative_position_processor_label">Cummumulative_position_processor</label>

                      <input type="checkbox" name="Result_summary_explorer" id="Result_summary_explorer" value="Result_summary_explorer; " onchange="processPrivilege(this.id,this.value);"><label for="Result_summary_explorer"  id="Result_summary_explorer_label">Result_summary_explorer</label>

                      <input type="checkbox" name="Result_collectors_summary" id="Result_collectors_summary" value="Result_collectors_summary; " onchange="processPrivilege(this.id,this.value);"><label for="Result_collectors_summary"  id="Result_collectors_summary_label">Result_collectors_summary</label>  

                      <input type="checkbox" name="Print_testionial" id="Print_testionial" value="Print_testionial; " onchange="processPrivilege(this.id,this.value);"><label for="Print_testionial"  id="Print_testionial_label">Print_testionial</label>  

                      <input type="checkbox" name="Print_my_result" id="Print_my_result" value="Print_my_result; " onchange="processPrivilege(this.id,this.value);"><label for="Print_my_result"  id="Print_my_result_label">Print_my_result</label> 

                      <input type="checkbox" name="Slider_modifier" id="Slider_modifier" value="Slider_modifier; " onchange="processPrivilege(this.id,this.value);"><label for="Slider_modifier"  id="Slider_modifier_label">Slider_modifier</label> 

                      <input type="checkbox" name="School_profile" id="School_profile" value="School_profile; " onchange="processPrivilege(this.id,this.value);"><label for="School_profile"  id="School_profile_label">School_profile</label> 

                      <input type="checkbox" name="Control_panel" id="Control_panel" value="Control_panel; " onchange="processPrivilege(this.id,this.value);"><label for="Control_panel"  id="Control_panel_label">Control_panel</label> 
                    </div>

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
