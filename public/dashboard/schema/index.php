<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
if(!isset($_SESSION['lgina']) && $_SESSION['post']=="webmaster")
{
  header("location:index.php");
}

$table_schema=$school_details['school_keycode']."_db";
$Tables=Tables::ReadAllTables($table_schema);
if(!isset($_GET['table_name']))
{
  foreach($Tables as $Table)
  {

  }
  $table_name=$Table;
}
else
{
  $table_name=$_GET['table_name'];
}




//Messages
$UnredMessages=Message::ReadAllUnreadMessages($_SESSION['email']);
$Messages=Message::ReadAll($_SESSION['email']);
$NewMessages=Message::ReadAllUnreadMessages($_SESSION['email']);
$NewAlerts=Message::ReadAllUnreadAlerts($_SESSION['email']);

$Columns=Tables::ReadTableColumns($table_schema,$table_name);
if(!isset($_GET['limitfrom']))
{
  $_GET['limitfrom']=0;
}

if(!isset($_GET['limitto']))
{
  $_GET['limitto']=25;
}


$TableData=Tables::ReadTableData($table_name,$_GET['limitfrom'],$_GET['limitto']); 
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

  <title>Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php"><img src="../../images/school/favicon.png" style="height: 50px"></a>

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
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../index.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Dashboard</span></a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="../../">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Home Page</span></a>
      </li>
      <?php
      foreach($Tables as $Table)
      {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="?table_name=<?php echo $Table;?>&limitfrom=0&limitto=25">
            <i class="fas fa-table"></i>
            <span><?php echo $Table; ?></span></a>
        </li>
        <?php
      }

      ?>
      
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()">Back</a>
          </li>
          <li class="breadcrumb-item active"><?php echo strtoupper($table_name);?> Table</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i> 
            <div><form><button ><a href="adddata.php?table_schema=<?php echo $table_schema;?>&table_name=<?php echo $table_name; ?>" title="Add Record"><img src="db_insert.png"> Add Record </a></button> <input type="hidden" name="table_name" id="table_name" value="<?php echo $_GET['table_name']; ?>" title="Query Limit From">Limit From <input type="number" name="limitfrom" id="limitfrom" placeholder="Limit From" min="0" value="<?php echo $_GET['limitfrom']; ?>">Limit To <input type="number" name="limitto" id="limitto" placeholder="Limit To" value="<?php echo $_GET['limitto']; ?>" title="Query Limit To"><input type="submit" name="btnGo" id="btnGo" value="Go" min="0"><button ><a href="adddata.php?table_schema=<?php echo $table_schema;?>&table_name=<?php echo $table_name; ?>" title="Add Record"> Search</a></button> 
            </form></div>
            <!--
            <div>Record Finder <form>
              <select>
                <option>Select</option>
              </select>
              <select>
                <option>Select</option>
              </select>
              <input type="hidden" name="table_name" id="table_name" value="<?php echo $_GET['table_name']; ?>" title="Query Limit From">Limit From <input type="number" name="limitfrom" id="limitfrom" placeholder="Limit From" min="0" value="<?php echo $_GET['limitfrom']; ?>">Limit To <input type="number" name="limitto" id="limitto" placeholder="Limit To" value="<?php echo $_GET['limitto']; ?>" title="Query Limit To"><input type="submit" name="btnGo" id="btnGo" value="Go" min="0"><button ><a href="adddata.php?table_schema=<?php echo $table_schema;?>&table_name=<?php echo $table_name; ?>" title="Add Record"> Search</a></button> 
            </form></div>-->
            

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>CMD</th>
                    <?php    
                    foreach($Columns as $column)
                    {
                      $coltype=Tables::ReadColumnDetails($table_schema,$table_name,$column);  
                      ?>
                      <th><?php echo strtoupper($column)." ($coltype)"; ?></th>
                      <?php
                    }
                    ?>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>CMD</th>
                    <?php                    
                    foreach($Columns as $column)
                    {
                      ?>
                      <th><?php echo strtoupper($column) ?></th>
                      <?php
                    }
                    ?>
                  </tr>
                </tfoot>
                <tbody> 
                    <?php 
                    foreach($TableData as $tableData)
                    {
                      $dataDetails=Tables::ReadDataDetails($table_name,$tableData);
                    ?>
                      <tr>
                        <td><a href="editdata.php?table_schema=<?php echo $table_schema;?>&table_name=<?php echo $table_name; ?>&id=<?php echo $tableData; ?>" title="Edit Record"><button><img src="db_edit.png" height="20px" width="20px"></button></a><a href="deletedata.php?table_schema=<?php echo $table_schema;?>&table_name=<?php echo $table_name; ?>&id=<?php echo $tableData; ?>" title="Delete Record"><button><img src="db_delete.png" height="20px" width="20px"></button></a></td>
                        <?php
                        foreach($Columns as $column)
                        {
                            $coltype=Tables::ReadColumnDetails($table_schema,$table_name,$column);  

                            if($coltype=="longblob")     
                            {
                              ?>
                              <td><img src="<?php echo 'data:image/jpeg;base64,'.$dataDetails[$column]; ?>" style="height: 100px"></td>
                              <?php
                            }
                            elseif($coltype=="blob")     
                            {
                              ?>
                              <td><img src="<?php echo 'data:image/jpeg;base64,'.$dataDetails[$column]; ?>" style="height: 100px"></td>
                              <?php
                            }
                            elseif($coltype=="tinyblob")     
                            {
                              ?>
                              <td><img src="<?php echo 'data:image/jpeg;base64,'.$dataDetails[$column]; ?>" style="height: 100px"></td>
                              <?php
                            }
                            elseif(strtolower($coltype)=="mediumblob")     
                            {
                              ?>
                              <td><img src="<?php echo 'data:image/jpeg;base64,'.$dataDetails[$column]; ?>" style="height: 100px"></td>
                              <?php
                            }
                            else
                            {  
                              $colData=$dataDetails[$column];
                              $colDatas=explode(" ", $colData);
                              $count=0;
                              if(count($colDatas)>0)
                              {
                                foreach($colDatas as $dataToken)
                                {
                                  $count++;
                                  if($count<=15)
                                  {
                                    $dataShow=$dataShow." $dataToken";

                                  }
                                } 
                              }
                              ?>
                              <td title="<?php echo $dataDetails[$column]; ?>"><?php echo $dataShow;
                              $dataShow="" ;
                              if(count($colDatas)>15)
                              {
                                ?>
                                ...
                                <?php
                              }

                               ?></td>
                              <?php
                            }
                        }
                        ?>
                        
                      <?php 

                      /*                  
                          foreach($Columns as $column)
                          {
                            $coltype=Tables::ReadColumnDetails($table_schema,$table_name,$column);  

                            if($coltype=="longblob")     
                            {
                              ?>
                              <td><img src="<?php echo 'data:image/jpeg;base64,'.$TableData[$column]; ?>" style="height: 100px"></td>
                              <?php
                            }
                            elseif($coltype=="blob")     
                            {
                              ?>
                              <td><img src="<?php echo 'data:image/jpeg;base64,'.$TableData[$column]; ?>" style="height: 100px"></td>
                              <?php
                            }
                            elseif($coltype=="tinyblob")     
                            {
                              ?>
                              <td><img src="<?php echo 'data:image/jpeg;base64,'.$TableData[$column]; ?>" style="height: 100px"></td>
                              <?php
                            }
                            elseif($coltype=="mediumblob")     
                            {
                              ?>
                              <td><img src="<?php echo 'data:image/jpeg;base64,'.$TableData[$column]; ?>" style="height: 100px"></td>
                              <?php
                            }
                            else
                            {                        
                              ?>
                              <td><?php echo $TableData[$column]; ?></td>
                              <?php
                            }
                          }
                          */
                          ?>                    
                      </tr>
                      <?php
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
      
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Panel</span>
          </div>
        </div>
      </footer>

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
