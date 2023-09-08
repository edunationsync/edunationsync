<?php session_start();
include '../Module.php';

if(!isset($_SESSION['lgina']))
{
  header("location:../logout.php");
}
//Read Vouchers from first to fift
$vouchers=Finance::ReadAllVouchers(1,5);
//$orders=Order::ReadAll($_SESSION['email']);
//$carts=Cart::ReadAvailable($_SESSION['email']);

$staff=$_SESSION['staffid'];
$currentSession=Module::ReadCurrentSession();
$session=$currentSession['session'];
$term=$currentSession['term'];
$allsessions=Module::ReadAllSessions();

//Messages
$UnredMessages=Message::ReadAllUnreadMessages($_SESSION['email']);
$Messages=Message::ReadAll($_SESSION['email']);
$NewMessages=Message::ReadAllUnreadMessages($_SESSION['email']);
$NewAlerts=Message::ReadAllUnreadAlerts($_SESSION['email']);
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
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <style type="text/css">
    select{
      width: 98%;
    }
  </style>
  <script type="text/javascript">
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["English", "Maths", "Basic"],
        datasets: [{
          label: "Analysis",
          lineTension: 0.3,
          backgroundColor: "rgba(2,117,216,0.2)",
          borderColor: "rgba(2,117,216,1)",
          pointRadius: 5,
          pointBackgroundColor: "rgba(2,117,216,1)",
          pointBorderColor: "rgba(255,255,255,0.8)",
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(2,117,216,1)",
          pointHitRadius: 50,
          pointBorderWidth: 2,
          data: [1000, 1162, 1663],
        }],
      },
      options: {
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              min: 0,
              max: 1900,
              maxTicksLimit: 5
            },
            gridLines: {
              color: "rgba(0, 0, 0, .125)",
            }
          }],
        },
        legend: {
          display: false
        }
      }
    });

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

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php
      if($_SESSION['post']=="webmaster")
      {
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Admin</span>
          </a>
          
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Administration</h6>
            <a class="dropdown-item" href="schema/">Database</a>
            <a class="dropdown-item" href="messages.php">Messages</a>
            <a class="dropdown-item" href="../scard.php">Scratch Card</a>
            <a class="dropdown-item" href="../scard_print.php">Scratch card Print</a>
          </div>
        </li>
        <?php
      }
      ?>      
      <li class="nav-item">
        <a class="nav-link" href="../">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Home Page</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="webmaster/">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Control Panel</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../admin/">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Admin</span></a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="users/">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Users</span></a>
      </li>      
      <li class="nav-item">
        <a class="nav-link" href="finance">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Finance</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../result/">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Result</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../portal/">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Result Checker</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $school_details['school_blog'] ?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Blog</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $school_details['school_facebook'] ?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Facebook</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $school_details['school_linkedin'] ?>">
          <i class="fas fa-fw fa-table"></i>
          <span>LinkedIn</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $school_details['school_tweeter'] ?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Twitter</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()">Back</a>
          </li>
          <li class="breadcrumb-item active">Easy Dashboard</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row"> 
        <?php
        if($_SESSION['user_type']=="staff" || $_SESSION['post']=="webmaster")
        {
          ?>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">              
                <p  class="tab-btn" title="This is your profile management widget">Staff's Profile</p> 
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"></div>
                <center>
                <a href="users/changepassport.php" title="Click to View Profile"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style=" width: 150px; border-radius: 10%;"></a></center>
                <h5><?php echo $_SESSION['names']; ?></h5>
                <div>
                  <table style="font-size: 12px;">
                    <tr class="tr"><th class="th">Address:</th><td class="td"><?php echo $_SESSION['address']; ?></td></tr>
                    <tr class="tr"><th class="th">Phone:</th><td class="td"><?php echo $_SESSION['phone']; ?></td></tr>
                    <tr class="tr"><th class="th">Email:</th><td class="td"><?php echo $_SESSION['email']; ?></td></tr>
                  </table>
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <a href="users/changepassport.php"  class="tab-btn" title="Click to Modify your Profile">Change Passport</a>
                <a href="users/viewstaffprofile.php"  class="tab-btn" title="Click to View your Profile">View Profile</a>
                <a href="users/editprofile.php"  class="tab-btn" title="Click to Modify your Profile">Modify Profile</a>
              </a>
            </div>
          </div>
          <?php
        }
        elseif($_SESSION['user_type']=="student" || $_SESSION['post']=="webmaster")
        {
          ?>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">              
                <p  class="tab-btn" title="This is your profile management widget">Student Profile</p> 
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"></div>
                <center>
                <a href="users/editstudentprofile.php?id=<?php echo $_SESSION['id']; ?>" title="Click to View Profile"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style=" width: 150px; border-radius: 10%;"></a></center>
                <h5><?php echo $_SESSION['names']; ?></h5>
                <div>
                  <table style="font-size: 12px;">
                    <tr class="tr"><th class="th">ADDRESS:</th><td class="td"><?php echo $_SESSION['address']; ?></td></tr>
                    <tr class="tr"><th class="th">SESSION:</th><td class="td"><?php echo $_SESSION['session']; ?></td></tr>
                    <tr class="tr"><th class="th">DATE:</th><td class="td"><?php echo $_SESSION['date_admitted']; ?></td></tr>
                  </table>
                </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <a href="users/editstudentprofile.php?id=<?php echo $_SESSION['id']; ?>"  class="tab-btn" title="Click to Modify your Profile">Modify Profile</a>
              </a>
            </div>
          </div>
          <?php
        }

        if($_SESSION['user_type']=="staff")
        { 
          if($_SESSION['post']=="assistant headmistress" ||$_SESSION['post']=="assistant headmaster"|| $_SESSION['post']=="webmaster")
          {
            ?>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                  <p  class="tab-btn" title="These are your registered teams.">Staff Explorer</p> 
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                  </div>
                  <div class="mr-5"></div>

                  <?php
                  $Workers=Module::ReadAllStaff();
                  
                  if(count($Workers)>0)
                  {
                    foreach($Workers as $Worker)
                    {
                      $workerDetails=Module::ReadStaffDetails($Worker);
                      $staffid=$workerDetails['staff_id'];
                      $names=$workerDetails['names'];
                      $id=$workerDetails['id'];
                      $password=$workerDetails['password'];
                      $post=$workerDetails['post'];
                      $phone=$workerDetails['phone'];
                      $email=$workerDetails['email'];
                      $status=$workerDetails['status'];
                      $sgl=$workerDetails['sgl'];
                      $date_employed=$workerDetails['date_employed'];
                      $date_resigned=$workerDetails['date_resigned'];
                      $address=$workerDetails['address'];
                      $passport=$workerDetails['passport'];
                      ?>
                      <div>
                        <a href="users/edituserprofile.php?email=<?php echo $email; ?>&id=<?php echo $staffid; ?>" title=" <?php echo $names; ?> <?php echo $phone; ?>"> <img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 60px; height: 60px; border-radius: 100px; float: left;"></a>
                      </div>                    
                      <?php
                    }
                  }
                  ?>
                </div>
                    <a class="card-footer text-white clearfix small z-1" href="#">
                      <a href="users/registerworker.php"  class="tab-btn" title="Click here to start earning now">New Staff</a>
                      <a href="users/allstaff.php"  class="tab-btn" title="View all my Registed Teams">View All Staffs</a>                
                    </a>
              </div>
            </div>
            <?php            
          }

          if($_SESSION['post']=="finance" ||$_SESSION['post']=="burser" || $_SESSION['post']=="webmaster")
          {
            ?>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">              
                  <p  class="tab-btn" title="Your Fully paid Orders">Fees Explorer</p> 
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <div>
                    These are the fees and payments made by the students.
                    <?php

                    $count=0;
                    if(count($orders)>0)
                    {
                      foreach($orders as $order)
                      {
                        $count++;

                        //$orderDetails=Order::ReadDetails($order);
                        $orderID=$orderDetails['id'];
                        $orderEmail=$orderDetails['email'];
                        $orderCart_ID=$orderDetails['cart_id'];
                        $orderPay_Ref=$orderDetails['pay_ref'];
                        $orderAmount=$orderDetails['amount'];
                        $orderTimestamp=$orderDetails['timestamp'];
                        if($count<=3)
                        {
                          ?>
                          <br><br>
                          <a href="voucher/fees.php" class="tab-btn" >All Fees</a>
                          <?php                        
                        }
                      }
                    }                  
                    ?>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <a href="voucher/fees.php"  class="tab-btn" title="Go to Fees Explorer">Fees Explorer</a>                
                </a>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">            
                  <p  class="tab-btn" title="These are your unpaid orders which are still in your carts">Voucher Explorer</p> 
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">The five most recent Vouchers ar as follows</div>
                <?php
                $Vouchers=Finance::ReadVoucherMonthsLimit(date('Y'),5);
                if(count($Vouchers)>0)
                {
                  $months=array();
                  $count=0;
                  foreach($Vouchers as $Voucher)
                  {
                    $voucherDetails=Finance::ReadVoucherDetails($Voucher);
                    $voucherMonth=$voucherDetails['month'];
                    $voucherYear=$voucherDetails['year'];

                    if(!(in_array($voucherMonth, $months)))
                    {
                      array_push($months, $voucherMonth);
                      ?><br/>
                      <a href="voucher/index.php?month=<?php echo $voucherMonth; ?>&year=<?php echo $voucherYear; ?>"  class="tab-btn" title="Click to proceed to checkout"><?php echo $voucherMonth; ?></a><br/>  
                      <?php                
                    }
                  }
                }
                ?>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <a href="voucher/index.php?month=<?php echo date('F'); ?>&year=<?php echo date('Y'); ?>"  class="tab-btn" title="All Vouchers">All Vouchers</a>              
                </a>
              </div>
            </div>
            <?php
          }
          if($_SESSION['post']=="assistant headmistress" ||$_SESSION['post']=="assistant headmaster"|| $_SESSION['post']=="webmaster")
          {
          ?>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">            
                  <p  class="tab-btn" title="These are your unpaid orders which are still in your carts">Students</p> 
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">The students are categorized based on classes as follows</div><br/>
                <?php
                $Classes=Module::ReadClasses();
                sort($Classes);
                if(count($Classes)>0)
                {
                  $count=0;
                  foreach($Classes as $Class)
                  {
                    $count++;
                    if($count==2)
                    {
                      $count=0;
                      echo "<br/><br/>";
                    }
                    ?>
                    <a href="users/allstudents.php?txtclassp=<?php echo $Class; ?>"  class="tab-btn" title="Click to view <?php echo $Class ?>\'s students/students"><?php echo $Class; ?></a> 
                    <?php
                  }
                }
                ?>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <a href="users/allstudents.php"  class="tab-btn" title="All Students">All Students</a>              
                </a>
              </div>
            </div>
            <?php
          }

          if($_SESSION['post']=="webmaster" ||$_SESSION['post']=="exams & records" || $_SESSION['post']=="examinar")
          {
            ?>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">            
                  <p  class="tab-btn" title="These are your unpaid orders which are still in your carts">Analog Admin</p> 
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">Easy Managment of Students</div><br/>
                  <a href="../admin"  class="tab-btn" title="Administration">Admin</a> 
                </div>
              </div>
            </div>
            <?php
          }

          if($_SESSION['post']=="exams & records" || $_SESSION['post']=="webmaster"||$_SESSION['post']=="examinar"||$_SESSION['post']=="headmistress"||$_SESSION['post']=="headmaster")
          {
            ?>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">            
                <p  class="tab-btn" title="These are your unpaid orders which are still in your carts">Result Admin</p> 
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5" style="text-align: justify;">All the variables that are needed for the compilation of results ranging from staff, students, session, subject management and class allocations</div><br/>

                  <hr style="border: 2px white groove" />

                  <!-- Subject Management -->
                  <a href="../admin/subject_library.php" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow;">Subject Manager</a>
                  
                  <hr style="border: 2px white groove" />
                  
                  <!-- Class Management -->
                  <a href="../admin/class_library.php" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow;">Class Manager</a>

                  <hr style="border: 2px white groove" />
                  <!-- Result Settings -->

                  <a href="../admin/settings.php?session=<?php echo $session; ?>&term=<?php echo $term; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow;">Result Settings</a><hr style="border: 2px white groove" />
                  <!-- Result Settings -->

                  <a href="../admin/classaloc.php?session=<?php echo $session; ?>&term=<?php echo $term; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow;">Allocations</a>

                </div>
                </div>
            </div>
            <?php
          }



          if($_SESSION['post']=="exams & records" || $_SESSION['post']=="webmaster"||$_SESSION['post']=="examinar"||$_SESSION['post']=="headmistress"||$_SESSION['post']=="headmaster"||$_SESSION['post']=="teacher")
          {
            ?>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">            
                  <p  class="tab-btn" title="These are your unpaid orders which are still in your carts">Result Explorer</p> 
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5">Use this tool to manage results.</div><br/>
                  <div class="feature text-center trans_400">
                    
                    <hr style="border: 2px white groove" />

                    <!-- CA Sheet Manager-->
                    <div onclick="if(document.getElementById('ca_sheet_form1').style.display=='none'){document.getElementById('ca_sheet_form1').style.display='block'} else{document.getElementById('ca_sheet_form1').style.display='none'} "><h5 class="feature_title"   style="background: black; color: yellow; padding: 4px 4px 4px 4px;">CA Sheet</h5>
                    <p>This is where the scores of subject results are entered.</p></div>

                    <form id='ca_sheet_form1'  action="../result/ca_sheet/index.php" method="GET" style="display: none">
                     <table>

                        <tr><td width="70px"><label for="txtsessionp">Session</label></td><td><select name="txtsessionp" id="txtsessionp" required>
                        <?php
                        foreach($allsessions as $session)
                        {
                          echo "<option>".$session."</option>";
                        }
                        ?>
                      </select></td></tr>

                        <tr><td width="70px"><label for="txttermp">Term</label></td><td><select name="txttermp" id="txttermp" required>
                        <option>First</option>
                        <option>Second</option>
                        <option>Third</option>
                        
                      </select></td></tr>

                        <tr><td width="70px"><label for="txtclassp">Class</label></td><td><select name="txtclassp" id="txtclassp" onchange="loadSubjectsp(this.value)" onclick="loadSubjectsp(this.value)" required>
                        <?php
                        if($_SESSION['post']=="examinar"||$_SESSION['post']=="exams and records"||$_SESSION['post']=="webmaster")
                        {
                          foreach(Module::ReadClasses() as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        else
                        {

                          foreach(Module::ReadStaffAllocationClassesp($staff,$session,$term) as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        
                        ?>
                      </select></td></tr>
                      <tr><td colspan="2"><div id="subjectContainerp"></div>
                      </td></tr>
                      <tr><td colspan="2" ><input type="submit" name="" value="Open" style="width: 98%"></td></tr>
                      </table>
                    </form>

                  </div>
                  <br/><hr style="border: 2px white groove" />

                  <!-- Master Sheet Gallery-->
                  <a href="../result/master_sheet/" style="color: yellow; font-weight: bolder; text-align: center; background: black; padding: 5px 5px 5px 5px ">Master Sheet Gallery</a>

                  <br/><hr style="border: 2px white groove" />
                  
                  <!-- Result Analysis-->
                  <a href="../result/analysis.php" style="color: yellow; font-weight: bolder; text-align: center; background: black; padding: 5px 5px 5px 5px ">Result Analysis</a>

                  <!-- Printable Students Result-->
                  <br/><hr style="border: 2px white groove" />
                  <div onclick="if(document.getElementById('master_sheet_form').style.display=='none'){document.getElementById('master_sheet_form').style.display='block'} else{document.getElementById('master_sheet_form').style.display='none'} "><h5 class="feature_title" style="background: black; color: yellow; padding: 4px 4px 4px 4px;">Result Sheet</h5>
                  <p>This is where all the students' results sheets are printed.</p></div>
                  
                  <form id='master_sheet_form' action="../portal/allresultsp.php" method="GET" style="display: none">
                    <table>
                      <tr><td><label for="prclass">Class</label></td><td><select name="prclass" id="prclass">

                        <?php
                        if($_SESSION['post']=="examinar"||$_SESSION['post']=="examinar"||$_SESSION['post']=="webmaster")
                        {
                          foreach(Module::ReadClasses() as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        else
                        {

                          foreach(Module::ReadStaffAllocationClassesp($staff,$session,$term) as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        
                        ?>
                      </select></td></tr>
                      <tr><td><label for="prsession">Session</label></td><td><select name="prsession" id="prsession" class="submit" required>
                        
                        <?php
                        foreach(Module::ReadAllSessions() as $session)
                        {
                          echo "<option>".$session."</option>";
                        }
                        ?>
                      </select></td></tr>
                      <tr><td><label for="prterm">Term</label></td><td><select name="prterm" id="prterm">
                      
                        <option>First</option>
                        <option>Second</option>
                        <option>Third</option>
                      </select></td></tr>
                      <tr><td colspan="2"><input type="submit" name="" value="Open" style="width: 98%"></td></tr>
                    </table>
                  </form>

                  <hr style="border: 2px white groove" />



                  <!-- Psychomotor Rating-->
                  <div onclick="if(document.getElementById('psychomotor_form').style.display=='none'){document.getElementById('psychomotor_form').style.display='block'} else{document.getElementById('psychomotor_form').style.display='none'} "><h5 class="feature_title"    style="background: black; color: yellow; padding: 4px 4px 4px 4px;">Psychomotor Ratings</h5>
                  <p>Select Class; Session and Term to print all the students results</p></div>
                  <form id='psychomotor_form' action="../result/psychomotorp.php" method="GET" style="display: none">
                    <table>
                      <tr><td><label for="classp">Class</label></td><td><select name="classp" id="classp">

                        <?php
                        if($_SESSION['post']=="examinar"||$_SESSION['post']=="exams and records"||$_SESSION['post']=="webmaster")
                        {
                          foreach(Module::ReadClasses() as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        else
                        {

                          foreach(Module::ReadStaffAllocationClassesp($staff,$session,$term) as $class)
                          {
                            echo "<option>".$class."</option>";
                          }
                        }
                        
                        ?>
                    </select></td></tr>
                    <tr><td><label for="sessionp">Session</label></td><td><select name="sessionp" id="sessionp" class="submit" required>
                      
                      <?php
                      foreach(Module::ReadAllSessions() as $session)
                      {
                        echo "<option>".$session."</option>";
                      }
                      ?>
                    </select></td></tr>
                    <tr><td><label for="termp">Term</label></td><td><select name="termp" id="termp">
                      
                      <option>First</option>
                      <option>Second</option>
                      <option>Third</option>
                    </select></td></tr>
                    <tr><td colspan="2"><input type="submit" name="" value="Open" style="width: 98%"></td></tr>
                    </table>
                  </form>
                  <hr style="border: 2px white groove" />
                </div>
              </div>
            </div>
            <?php
          }
            ?>

          

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">            
              <p  class="tab-btn" title="These are your unpaid orders which are still in your carts">My Salary Explorer</p> 
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5" style="text-align: justify;">My salary history and details</div><br/>
                <?php
                $Vouchers=Finance::ReadStaffVouchers($staff);
                foreach($Vouchers as $Voucher)
                {
                  $voucherDetails=Finance::ReadVoucherDetails($Voucher);
                  ?><hr style="border: 2px white groove" />
                  <a href="voucher/voucherdetail.php?id=<?php echo $Voucher; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px"><?php echo $voucherDetails['ref']; ?></a>
                  <?php
                }
                ?>
                <hr style="border: 2px white groove" />
              </div>
              </div>
          </div>
          <?php 
          if($_SESSION['post']=="webmaster")
          {
            ?>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">            
                <p  class="tab-btn" title="These are your unpaid orders which are still in your carts">Database Management</p> 
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5" style="text-align: justify;" onclick="if(document.getElementById('database_box').style.display=='none'){document.getElementById('database_box').style.display='block'} else{document.getElementById('database_box').style.display='none'} ">My salary history and details</div><br/>
                  <div id="database_box" style="display: none">
                  <?php


                  $table_schema="aleka_kiddies";
                  $Tables=Tables::ReadAllTables($table_schema);

                  foreach($Tables as $Table)
                  {
                    ?><hr style="border: 2px white groove" />
                    <a href="schema/?table_name=<?php echo $Table; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px"><?php echo $Table; ?></a>
                    <?php
                  }

                  ?></div>
                  <hr style="border: 2px white groove" />
                </div>
                </div>
            </div>
          <?php
          }
        }

          if($_SESSION['user_type']=="student" || $_SESSION['post']=="webmaster")
          {
            ?>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">            
                <p  class="tab-btn" title="These are your unpaid orders which are still in your carts">My Fees Explorer</p> 

                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5" style="text-align: justify;">My School Fees history and details</div><br/>

                  <?php
                  $Sessions=Module::ReadStudentSessionsp($_SESSION['regno']);

                  foreach($Sessions as $Session)
                  {
                    $Class=Module::ReadStudentSessionDetailsp($_SESSION['regno'],$Session,"First");
                    ?><hr style="border: 2px white groove" />
                    <table>
                      <?php 
                      $regNoR=$_SESSION['regno'];
                      $termR="First";
                      $sessionR=$Session;
                      ?>
                      <tr><td><?php echo $Session; ?></td>
                        <td>
                            <a href="voucher/reciept.php?session=<?php echo $sessionR; ?>&class=<?php echo $Class; ?>&term=<?php echo $termR ?>&student=<?php echo $regNoR; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">First</a>
                        </td>
                      <?php 
                      $regNoR=$_SESSION['regno'];
                      $termR="Second";
                      $sessionR=$Session;
                      ?>
                        <td>
                            <a href="voucher/reciept.php?session=<?php echo $sessionR; ?>&class=<?php echo $Class; ?>&term=<?php echo $termR ?>&student=<?php echo $regNoR; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">Second</a>
                        </td>

                      <?php 
                      $regNoR=$_SESSION['regno'];
                      $termR="Third";
                      $sessionR=$Session;
                      ?>
                        <td>
                            <a href="voucher/reciept.php?session=<?php echo $sessionR; ?>&class=<?php echo $Class; ?>&term=<?php echo $termR ?>&student=<?php echo $regNoR; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">Third</a></td></tr>
                    </table>                  
                    <?php
                  }
                  ?>
                  <hr style="border: 2px white groove" />
                </div>
                <a class="card-footer text-white clearfix small z-1" href="#">
                  <a href="voucher/pay.php"  class="tab-btn" title="Make Payment Now">Pay Fee Now</a>              
                </a>
                </div>
            </div>          

            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">            
                <p  class="tab-btn" title="These are your unpaid orders which are still in your carts">My Result Checker</p> 
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                  </div>
                  <div class="mr-5" style="text-align: justify;">Click on the session and term to check your reult or click here to check your custom results</div><br/>
                  

                  <?php
                  $Sessions=Module::ReadStudentSessionsp($_SESSION['regno']);

                  foreach($Sessions as $Session)
                  {
                    $Class=Module::ReadStudentSessionDetailsp($_SESSION['regno'],$Session,"First");
                    ?><hr style="border: 2px white groove" />
                    <table>
                      <?php 
                      $regNoR=base64_encode($_SESSION['regno']);
                      $termR=base64_encode("First");
                      $sessionR=base64_encode($Session);
                      ?>
                      <tr><td><?php echo $Session; ?></td>
                        <td>
                          <?php 
                          if(Finance::IsFee_Paid($_SESSION['regno'],$Session,"First"))
                          {
                            ?>
                            <a href="../portal/presult.php?session=<?php echo $sessionR; ?>&class=<?php echo $Class; ?>&term=<?php echo $termR ?>&student=<?php echo $regNoR; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">First</a>
                            <?php
                          }
                          else
                          {
                            ?>
                            <a href="../portal/" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">First</a>
                            <?php
                          }


                          ?>
                          
                        </td>
                      <?php 
                      $regNoR=base64_encode($_SESSION['regno']);
                      $termR=base64_encode("Second");
                      $sessionR=base64_encode($Session);
                      ?>
                        <td>

                          <?php 
                          if(Finance::IsFee_Paid($_SESSION['regno'],$Session,"Second"))
                          {
                            ?>
                            <a href="../portal/presult.php?session=<?php echo $sessionR; ?>&class=<?php echo $Class; ?>&term=<?php echo $termR ?>&student=<?php echo $regNoR; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">Second</a>
                            <?php
                          }
                          else
                          {
                            ?>
                            <a href="../portal/" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">Second</a>
                            <?php
                          }?>
                        </td>

                      <?php 
                      $regNoR=base64_encode($_SESSION['regno']);
                      $termR=base64_encode("Third");
                      $sessionR=base64_encode($Session);
                      ?>
                        <td>

                          <?php 
                          if(Finance::IsFee_Paid($_SESSION['regno'],$Session,"Third"))
                          {
                            ?>
                            <a href="../portal/presult.php?session=<?php echo $sessionR; ?>&class=<?php echo $Class; ?>&term=<?php echo $termR ?>&student=<?php echo $regNoR; ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">Third</a>
                            <?php
                          }
                          else
                          {
                            ?>
                            <a href="../portal/" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">Third</a>
                            <?php
                          }?></td></tr>
                      <tr>
                          <td><a href="../result/transcript.php?regno=<?php echo $_SESSION['regno'] ?>" style="padding: 5px 5px 5px 5px; margin: 5px 5px 5px 5px; background: black; color: yellow; font-size: 12px">Transcript</a></td>
                      </tr>
                    </table>                  
                    <?php
                  }
                  ?>
                  <hr style="border: 2px white groove" />
                </div>
                </div>
            </div>

            <?php
          }
          ?>

        
        </div>

    
        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Area Chart Example</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
<?php /* ?>
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                  </tr>
                  <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                  </tr>
                  <tr>
                    <td>Ashton Cox</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
                  </tr>
                  <tr>
                    <td>Cedric Kelly</td>
                    <td>Senior Javascript Developer</td>
                    <td>Edinburgh</td>
                    <td>22</td>
                    <td>2012/03/29</td>
                    <td>$433,060</td>
                  </tr>
                  <tr>
                    <td>Airi Satou</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>33</td>
                    <td>2008/11/28</td>
                    <td>$162,700</td>
                  </tr>
                  <tr>
                    <td>Brielle Williamson</td>
                    <td>Integration Specialist</td>
                    <td>New York</td>
                    <td>61</td>
                    <td>2012/12/02</td>
                    <td>$372,000</td>
                  </tr>
                  <tr>
                    <td>Herrod Chandler</td>
                    <td>Sales Assistant</td>
                    <td>San Francisco</td>
                    <td>59</td>
                    <td>2012/08/06</td>
                    <td>$137,500</td>
                  </tr>
                  <tr>
                    <td>Rhona Davidson</td>
                    <td>Integration Specialist</td>
                    <td>Tokyo</td>
                    <td>55</td>
                    <td>2010/10/14</td>
                    <td>$327,900</td>
                  </tr>
                  <tr>
                    <td>Colleen Hurst</td>
                    <td>Javascript Developer</td>
                    <td>San Francisco</td>
                    <td>39</td>
                    <td>2009/09/15</td>
                    <td>$205,500</td>
                  </tr>
                  <tr>
                    <td>Sonya Frost</td>
                    <td>Software Engineer</td>
                    <td>Edinburgh</td>
                    <td>23</td>
                    <td>2008/12/13</td>
                    <td>$103,600</td>
                  </tr>
                  <tr>
                    <td>Jena Gaines</td>
                    <td>Office Manager</td>
                    <td>London</td>
                    <td>30</td>
                    <td>2008/12/19</td>
                    <td>$90,560</td>
                  </tr>
                  <tr>
                    <td>Quinn Flynn</td>
                    <td>Support Lead</td>
                    <td>Edinburgh</td>
                    <td>22</td>
                    <td>2013/03/03</td>
                    <td>$342,000</td>
                  </tr>
                  <tr>
                    <td>Charde Marshall</td>
                    <td>Regional Director</td>
                    <td>San Francisco</td>
                    <td>36</td>
                    <td>2008/10/16</td>
                    <td>$470,600</td>
                  </tr>
                  <tr>
                    <td>Haley Kennedy</td>
                    <td>Senior Marketing Designer</td>
                    <td>London</td>
                    <td>43</td>
                    <td>2012/12/18</td>
                    <td>$313,500</td>
                  </tr>
                  <tr>
                    <td>Tatyana Fitzpatrick</td>
                    <td>Regional Director</td>
                    <td>London</td>
                    <td>19</td>
                    <td>2010/03/17</td>
                    <td>$385,750</td>
                  </tr>
                  <tr>
                    <td>Michael Silva</td>
                    <td>Marketing Designer</td>
                    <td>London</td>
                    <td>66</td>
                    <td>2012/11/27</td>
                    <td>$198,500</td>
                  </tr>
                  <tr>
                    <td>Paul Byrd</td>
                    <td>Chief Financial Officer (CFO)</td>
                    <td>New York</td>
                    <td>64</td>
                    <td>2010/06/09</td>
                    <td>$725,000</td>
                  </tr>
                  <tr>
                    <td>Gloria Little</td>
                    <td>Systems Administrator</td>
                    <td>New York</td>
                    <td>59</td>
                    <td>2009/04/10</td>
                    <td>$237,500</td>
                  </tr>
                  <tr>
                    <td>Bradley Greer</td>
                    <td>Software Engineer</td>
                    <td>London</td>
                    <td>41</td>
                    <td>2012/10/13</td>
                    <td>$132,000</td>
                  </tr>
                  <tr>
                    <td>Dai Rios</td>
                    <td>Personnel Lead</td>
                    <td>Edinburgh</td>
                    <td>35</td>
                    <td>2012/09/26</td>
                    <td>$217,500</td>
                  </tr>
                  <tr>
                    <td>Jenette Caldwell</td>
                    <td>Development Lead</td>
                    <td>New York</td>
                    <td>30</td>
                    <td>2011/09/03</td>
                    <td>$345,000</td>
                  </tr>
                  <tr>
                    <td>Yuri Berry</td>
                    <td>Chief Marketing Officer (CMO)</td>
                    <td>New York</td>
                    <td>40</td>
                    <td>2009/06/25</td>
                    <td>$675,000</td>
                  </tr>
                  <tr>
                    <td>Caesar Vance</td>
                    <td>Pre-Sales Support</td>
                    <td>New York</td>
                    <td>21</td>
                    <td>2011/12/12</td>
                    <td>$106,450</td>
                  </tr>
                  <tr>
                    <td>Doris Wilder</td>
                    <td>Sales Assistant</td>
                    <td>Sidney</td>
                    <td>23</td>
                    <td>2010/09/20</td>
                    <td>$85,600</td>
                  </tr>
                  <tr>
                    <td>Angelica Ramos</td>
                    <td>Chief Executive Officer (CEO)</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2009/10/09</td>
                    <td>$1,200,000</td>
                  </tr>
                  <tr>
                    <td>Gavin Joyce</td>
                    <td>Developer</td>
                    <td>Edinburgh</td>
                    <td>42</td>
                    <td>2010/12/22</td>
                    <td>$92,575</td>
                  </tr>
                  <tr>
                    <td>Jennifer Chang</td>
                    <td>Regional Director</td>
                    <td>Singapore</td>
                    <td>28</td>
                    <td>2010/11/14</td>
                    <td>$357,650</td>
                  </tr>
                  <tr>
                    <td>Brenden Wagner</td>
                    <td>Software Engineer</td>
                    <td>San Francisco</td>
                    <td>28</td>
                    <td>2011/06/07</td>
                    <td>$206,850</td>
                  </tr>
                  <tr>
                    <td>Fiona Green</td>
                    <td>Chief Operating Officer (COO)</td>
                    <td>San Francisco</td>
                    <td>48</td>
                    <td>2010/03/11</td>
                    <td>$850,000</td>
                  </tr>
                  <tr>
                    <td>Shou Itou</td>
                    <td>Regional Marketing</td>
                    <td>Tokyo</td>
                    <td>20</td>
                    <td>2011/08/14</td>
                    <td>$163,000</td>
                  </tr>
                  <tr>
                    <td>Michelle House</td>
                    <td>Integration Specialist</td>
                    <td>Sidney</td>
                    <td>37</td>
                    <td>2011/06/02</td>
                    <td>$95,400</td>
                  </tr>
                  <tr>
                    <td>Suki Burks</td>
                    <td>Developer</td>
                    <td>London</td>
                    <td>53</td>
                    <td>2009/10/22</td>
                    <td>$114,500</td>
                  </tr>
                  <tr>
                    <td>Prescott Bartlett</td>
                    <td>Technical Author</td>
                    <td>London</td>
                    <td>27</td>
                    <td>2011/05/07</td>
                    <td>$145,000</td>
                  </tr>
                  <tr>
                    <td>Gavin Cortez</td>
                    <td>Team Leader</td>
                    <td>San Francisco</td>
                    <td>22</td>
                    <td>2008/10/26</td>
                    <td>$235,500</td>
                  </tr>
                  <tr>
                    <td>Martena Mccray</td>
                    <td>Post-Sales support</td>
                    <td>Edinburgh</td>
                    <td>46</td>
                    <td>2011/03/09</td>
                    <td>$324,050</td>
                  </tr>
                  <tr>
                    <td>Unity Butler</td>
                    <td>Marketing Designer</td>
                    <td>San Francisco</td>
                    <td>47</td>
                    <td>2009/12/09</td>
                    <td>$85,675</td>
                  </tr>
                  <tr>
                    <td>Howard Hatfield</td>
                    <td>Office Manager</td>
                    <td>San Francisco</td>
                    <td>51</td>
                    <td>2008/12/16</td>
                    <td>$164,500</td>
                  </tr>
                  <tr>
                    <td>Hope Fuentes</td>
                    <td>Secretary</td>
                    <td>San Francisco</td>
                    <td>41</td>
                    <td>2010/02/12</td>
                    <td>$109,850</td>
                  </tr>
                  <tr>
                    <td>Vivian Harrell</td>
                    <td>Financial Controller</td>
                    <td>San Francisco</td>
                    <td>62</td>
                    <td>2009/02/14</td>
                    <td>$452,500</td>
                  </tr>
                  <tr>
                    <td>Timothy Mooney</td>
                    <td>Office Manager</td>
                    <td>London</td>
                    <td>37</td>
                    <td>2008/12/11</td>
                    <td>$136,200</td>
                  </tr>
                  <tr>
                    <td>Jackson Bradshaw</td>
                    <td>Director</td>
                    <td>New York</td>
                    <td>65</td>
                    <td>2008/09/26</td>
                    <td>$645,750</td>
                  </tr>
                  <tr>
                    <td>Olivia Liang</td>
                    <td>Support Engineer</td>
                    <td>Singapore</td>
                    <td>64</td>
                    <td>2011/02/03</td>
                    <td>$234,500</td>
                  </tr>
                  <tr>
                    <td>Bruno Nash</td>
                    <td>Software Engineer</td>
                    <td>London</td>
                    <td>38</td>
                    <td>2011/05/03</td>
                    <td>$163,500</td>
                  </tr>
                  <tr>
                    <td>Sakura Yamamoto</td>
                    <td>Support Engineer</td>
                    <td>Tokyo</td>
                    <td>37</td>
                    <td>2009/08/19</td>
                    <td>$139,575</td>
                  </tr>
                  <tr>
                    <td>Thor Walton</td>
                    <td>Developer</td>
                    <td>New York</td>
                    <td>61</td>
                    <td>2013/08/11</td>
                    <td>$98,540</td>
                  </tr>
                  <tr>
                    <td>Finn Camacho</td>
                    <td>Support Engineer</td>
                    <td>San Francisco</td>
                    <td>47</td>
                    <td>2009/07/07</td>
                    <td>$87,500</td>
                  </tr>
                  <tr>
                    <td>Serge Baldwin</td>
                    <td>Data Coordinator</td>
                    <td>Singapore</td>
                    <td>64</td>
                    <td>2012/04/09</td>
                    <td>$138,575</td>
                  </tr>
                  <tr>
                    <td>Zenaida Frank</td>
                    <td>Software Engineer</td>
                    <td>New York</td>
                    <td>63</td>
                    <td>2010/01/04</td>
                    <td>$125,250</td>
                  </tr>
                  <tr>
                    <td>Zorita Serrano</td>
                    <td>Software Engineer</td>
                    <td>San Francisco</td>
                    <td>56</td>
                    <td>2012/06/01</td>
                    <td>$115,000</td>
                  </tr>
                  <tr>
                    <td>Jennifer Acosta</td>
                    <td>Junior Javascript Developer</td>
                    <td>Edinburgh</td>
                    <td>43</td>
                    <td>2013/02/01</td>
                    <td>$75,650</td>
                  </tr>
                  <tr>
                    <td>Cara Stevens</td>
                    <td>Sales Assistant</td>
                    <td>New York</td>
                    <td>46</td>
                    <td>2011/12/06</td>
                    <td>$145,600</td>
                  </tr>
                  <tr>
                    <td>Hermione Butler</td>
                    <td>Regional Director</td>
                    <td>London</td>
                    <td>47</td>
                    <td>2011/03/21</td>
                    <td>$356,250</td>
                  </tr>
                  <tr>
                    <td>Lael Greer</td>
                    <td>Systems Administrator</td>
                    <td>London</td>
                    <td>21</td>
                    <td>2009/02/27</td>
                    <td>$103,500</td>
                  </tr>
                  <tr>
                    <td>Jonas Alexander</td>
                    <td>Developer</td>
                    <td>San Francisco</td>
                    <td>30</td>
                    <td>2010/07/14</td>
                    <td>$86,500</td>
                  </tr>
                  <tr>
                    <td>Shad Decker</td>
                    <td>Regional Director</td>
                    <td>Edinburgh</td>
                    <td>51</td>
                    <td>2008/11/13</td>
                    <td>$183,000</td>
                  </tr>
                  <tr>
                    <td>Michael Bruce</td>
                    <td>Javascript Developer</td>
                    <td>Singapore</td>
                    <td>29</td>
                    <td>2011/06/27</td>
                    <td>$183,000</td>
                  </tr>
                  <tr>
                    <td>Donna Snider</td>
                    <td>Customer Support</td>
                    <td>New York</td>
                    <td>27</td>
                    <td>2011/01/25</td>
                    <td>$112,000</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->
<?php */ ?>
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © GSDW</span>
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
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo1.js"></script>

  <!-- Result Javascript-->  
  <script src="../js/result.js"></script>

</body>

</html>
