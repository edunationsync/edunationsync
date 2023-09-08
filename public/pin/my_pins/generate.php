<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

if(!( $_SESSION['post']=='webmaster'))
{
  header("location:buy_pin");
}

echo $_SESSION['post'];
$CurrentSession=Module::ReadCurrentSession();
$Session=$CurrentSession['session'];
$session=split("/", $Session);

$Term=$_GET['term'];


  if(isset($_POST['btnGenerate']))
  {
    $number=$_POST['txtNo'];
    
      $last= Module::GetLastCard();
      if(!($last>0))
      {
        $last=1;
      }
      
      for ($i=$number; $i >0 ; $i--) { 
        
        $pin=Module::GeneratePin();
        
        if(strlen($pin)==12)        
        {          
          $serial=$school_details['school_keycode']."/".$session[1]."/".$last++;
          
          Module::AddCard($pin,$serial);
        }
        else{
          $pin=Module::GeneratePin();
          $serial=$school_details['school_keycode']."/".$session[1]."/".$last++;          
          Module::AddCard($pin,$serial);
        }
      }
  }     

  $scards=Module::ReadAllScratchCards();
?>

<!DOCTYPE html>
<html lang="en">

<head> 
    <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> <?php echo $schoolDetails['school_name']; ?> All Scratch Card</title>
  <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="../../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../dashboard/css/sb-admin.css" rel="stylesheet">


  <script type="text/javascript">

    function savecard(id,serial,pin,status,user,session,term)
    {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
          document.getElementById("msgContainer").innerHTML = this.responseText;
        }
        else
        {
          document.getElementById("msgContainer").innerHTML = "Loading...";
        }
      };
      xmlhttp.open("GET", "savecard.php?id="+id+"&serial="+serial+"&pin="+pin+"&status="+status+"&user="+user+"&session="+session+"&term="+term
        , true);
      xmlhttp.send();
    }

    function deletecard(id)
    {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
          document.getElementById("msgContainer").innerHTML = this.responseText;
          HideThis('row'+id);
        }
        else
        {
          document.getElementById("msgContainer").innerHTML = "Loading...";
        }
      };
      xmlhttp.open("GET", "deletecard.php?id="+id
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


  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../index.php"><img src="../../images/school/favicon.png"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>


    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="../../student_almanac.php">
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
                <a href="../dashboard/messages.php?id=<?php echo $alrtDetails['id']; ?>" title="<?php echo $alrtDetails['sender']; ?>"><div><?php echo $alrtDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="../dashboard/messages.php">View All</a>
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
                <a href="../dashboard/messages.php?id=<?php echo $msgDetails['id']; ?>" title="Sent By: <?php echo $msgDetails['sender']; ?>"><div><?php echo $msgDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="../dashboard/messages.php">Show Messages</a>
          <a class="dropdown-item" href="?clearer=yes&type=message">Clear Messages</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
      <li class="nav-item dropdown no-arrow">
        
          <?php
          if($_SESSION['lgina'])
          {
            ?>
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 20px; height: 20px; border-radius: 100%;"></a><div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="../dashboard/users/changepassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="../dashboard/users/changepassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="../dashboard/users"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
            <?php
          }
          else
          {
            ?>          
            <i class="fas fa-user-circle fa-fw"></i>
            <?php
          }
          ?>
        
        
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="../?school_id=<?php echo $school_details['school_keycode'];?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>PIN Dashboard</span>
        </a>
      </li>
      <li class="nav-item" style="border-bottom: 4px groove white">
        <a class="nav-link" href="../../index.php">
          <i class="fas fa-fw fa-home"></i>
          <span>Home Page</span></a>
      </li>
      <li class="nav-item" style="border-bottom: 4px groove white">
        <a class="nav-link" href="generate.php?school_id=<?php echo $school_details['school_keycode'];?>">
          <i class="fas fa-fw fa-home"></i>
          <span>Buy Pins</span></a>
      </li>
      <li class="nav-item" style="border-bottom: 4px groove white">
        <a class="nav-link" href="available.php?school_id=<?php echo $school_details['school_keycode'];?>">
          <i class="fas fa-fw fa-home"></i>
          <span>Available Cards</span></a>
      </li>
      <li class="nav-item" style="border-bottom: 4px groove white">
        <a class="nav-link" href="used.php?school_id=<?php echo $school_details['school_keycode'];?>">
          <i class="fas fa-fw fa-home"></i>
          <span>Used Cards</span></a>
      </li>
      <li class="nav-item" style="border-bottom: 4px groove white">
        <a class="nav-link" href="index.php?school_id=<?php echo $school_details['school_keycode'];?>">
          <i class="fas fa-fw fa-home"></i>
          <span>All Cards</span></a>
      </li>
    </ul>

    <div>

    <center><div id='msgContainer'><?php echo $msg;
    ?></div></center>
      <div class="content">
        <header>
          <center><b class="bheader"><b ><hd>DUBAI CARE SCHOOL</hd></b><br/>
            <hd1> SCRATCH CARD SUBSCRIPTION PLATFORM</hd1> <br/></b></center>
        </header>

        
        <table cellspacing="0" width="100%">
          <thead><tr><td valign='top'></td><td valign='top'>ID</td><td valign='top'>SERIAL</td><td   valign='top'>PIN</td><td   valign='top'>STATUS</td><td   valign='top'>USER</td><td   valign='top'>SESSION</td><td   valign='top'>TERM</td></tr></thead>
          <tbody>
            <?php
            $count=0;
            foreach($scards as $serial)
            { 
              $subjectDetails=Module::ReadCardDetails($serial);
              $serial=$subjectDetails['serial'];
              $id=$subjectDetails['id'];
              $pin=$subjectDetails['pin'];
              $status=$subjectDetails['status'];
              $user=$subjectDetails['user'];
              $session=$subjectDetails['session'];
              $term=$subjectDetails['term'];


              ?>
              <tr id="row<?php echo $id; ?>" ><td><button onclick="deletecard('<?php echo $id;  ?>');"><img src='../../images/icons/delete_icon.png' width='20px' height='20px'></button></td>
              <td><center><?php echo $id; ?></center></td>

              <td>
                <input type="text" value="<?php echo $serial;  ?>"  id="<?php echo $id;  ?>seria"  
                  onkeyup="savecard('<?php echo $id; ?>',
                    document.getElementById('<?php echo $id;?>seria').value,
                    document.getElementById('<?php echo $id;?>pi').value,
                    document.getElementById('<?php echo $id;?>statu').value,
                    document.getElementById('<?php echo $id;?>use').value,
                    document.getElementById('<?php echo $id;?>sessio').value,
                    document.getElementById('<?php echo $id;?>ter').value)"  
                >
              </td>

              <td>
                <input type="text" value="<?php echo $pin;  ?>"  id="<?php echo $id;  ?>pi"  
                  onkeyup="savecard('<?php echo $id; ?>',
                    document.getElementById('<?php echo $id;?>seria').value,
                    document.getElementById('<?php echo $id;?>pi').value,
                    document.getElementById('<?php echo $id;?>statu').value,
                    document.getElementById('<?php echo $id;?>use').value,
                    document.getElementById('<?php echo $id;?>sessio').value,
                    document.getElementById('<?php echo $id;?>ter').value)"  
                >
              </td>

              <td>
                <input type="text" value="<?php echo $status;  ?>"  id="<?php echo $id;  ?>statu"  
                  onkeyup="savecard('<?php echo $id; ?>',
                    document.getElementById('<?php echo $id;?>seria').value,
                    document.getElementById('<?php echo $id;?>pi').value,
                    document.getElementById('<?php echo $id;?>statu').value,
                    document.getElementById('<?php echo $id;?>use').value,
                    document.getElementById('<?php echo $id;?>sessio').value,
                    document.getElementById('<?php echo $id;?>ter').value)"  
                >
              </td>

              <td>
                <input type="text" value="<?php echo $user;  ?>"  id="<?php echo $id;  ?>use"  
                  onkeyup="savecard('<?php echo $id; ?>',
                    document.getElementById('<?php echo $id;?>seria').value,
                    document.getElementById('<?php echo $id;?>pi').value,
                    document.getElementById('<?php echo $id;?>statu').value,
                    document.getElementById('<?php echo $id;?>use').value,
                    document.getElementById('<?php echo $id;?>sessio').value,
                    document.getElementById('<?php echo $id;?>ter').value)"  
                >
              </td>

              <td>
                <input type="text" value="<?php echo $session;  ?>"  id="<?php echo $id;  ?>sessio"  
                  onkeyup="savecard('<?php echo $id; ?>',
                    document.getElementById('<?php echo $id;?>seria').value,
                    document.getElementById('<?php echo $id;?>pi').value,
                    document.getElementById('<?php echo $id;?>statu').value,
                    document.getElementById('<?php echo $id;?>use').value,
                    document.getElementById('<?php echo $id;?>sessio').value,
                    document.getElementById('<?php echo $id;?>ter').value)"  
                >
              </td>

              <td>
                <input type="text" value="<?php echo $term;  ?>"  id="<?php echo $id;  ?>ter"  
                  onkeyup="savecard('<?php echo $id; ?>',
                    document.getElementById('<?php echo $id;?>seria').value,
                    document.getElementById('<?php echo $id;?>pi').value,
                    document.getElementById('<?php echo $id;?>statu').value,
                    document.getElementById('<?php echo $id;?>use').value,
                    document.getElementById('<?php echo $id;?>sessio').value,
                    document.getElementById('<?php echo $id;?>ter').value)"  
                >
              </td>

              <?php       
            }
            ?>
                <tr><td colspan="4" ><form method="POST" action=""><button style="float: right;"  name="btnGenerate" id="btnGenerate" type="submit" ><img src="generate.png"></button><div style="float: right; height: 35px; width: 200px"><label for="txtNo" ><input  type="number" name="txtNo" id="txtNo"></div></form></td></tr>

              
          </tbody>
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
          <a class="btn btn-primary" href="../../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../dashboard/vendor/jquery/jquery.min.js"></script>
  <script src="../../dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../../dashboard/vendor/chart.js/Chart.min.js"></script>
  <script src="../../dashboard/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../../dashboard/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../dashboard/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../../dashboard/js/demo/datatables-demo1.js"></script>


  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <div id="preloader" style="display: none">
    <div id="loader"></div>
  </div>

<!-- The actual snackbar -->
<script src="../../js/attracta.js"></script>
</body>

</html>
