<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

if(isset($_GET['id']))
{
  $staffid=$_GET['id'];
}
else
{
  $staffid=$_SESSION['userid'];
}

$details=Module::ReadStaffDetails($staffid);
$staffid=$details['staff_id'];
$id=$details['id'];
$names=$details['names'];
$user_type=$details['user_type'];
$password=$details['password'];
$sex=$details['sex'];
$post=$details['post'];
$email=$details['email'];
$phone=$details['phone'];
$status=$details['status'];
$address=$details['address'];
$passport=$details['passport'];
$date_employed=$details['date_employed'];
$date_resigned=$details['date_resigned'];
$sgl=$details['sgl'];
$timestamp=$details['timestamp'];

if(isset($_POST['btnUpdate']))
{
  $staffid=$_POST['staffid'];
  $names=$_POST['names'];
  $user_type=$_POST['user_type'];
  $password=$_POST['password'];
  $post=$_POST['post'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $status=$_POST['status'];
  $date_employed=$_POST['date_employed'];
  $date_resigned=$_POST['date_resigned'];
  $sgl=$_POST['sgl'];
  $address=$_POST['address'];
  
  if(Module::UpdateStaffById($staffid,$names,$password,$post,$email,$phone,$status,$date_employed,$date_resigned,$sgl,$address))
  {    
    $msg="Profile was modified successfully";
  }
  else
  {
    $msg="Profile was not modified successfully";
  }


  //Passport Updater Module 
  if(is_uploaded_file($_FILES['passport']['tmp_name'])){

    $passport=base64_encode(file_get_contents($_FILES['passport']['tmp_name']));
    if(Module::SaveProfilePicture($staffid,$passport))
    {
      $msg="Profile Picture Was Changed Successfully";
    }
    else{
      $msg="Upload Failed";
    }
  }
}

  

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

  <title>Staff Profile Viewer</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">

    <div class="card card-register mx-auto mt-5"> 

      <div style="padding: 20px 20px 20px 20px">
        <?php 
          if(strtolower($_SESSION['user_type'])==strtolower("admin")&&(strtolower($_SESSION['post'])==strtolower("Vice Principal Academics")||strtolower($_SESSION['post'])==strtolower("webmaster")))
          {
            ?>
            <center>
              
              <?php 
              if($staffid>1)
              {
                ?><a href="editstaffprofile.php?id=<?php echo '1'; ?>" class="navi" style="background: red; border-bottom-left-radius: 100%; border-top-left-radius: 100%; border-bottom-right-radius: 0; border-top-right-radius: 0;"> << FIRST</a><a href="editstaffprofile.php?id=<?php echo $staffid-1; ?>" class="navi" style="background: red; border-bottom-left-radius: 0; border-top-left-radius: 0; border-bottom-right-radius: 0; border-top-right-radius: 0; border-left: 2px solid white">< PREV</a>
                <?php
              }

              $totalStaff=count(Module::ReadGeneralStaff());

              if(!($staffid==$totalStaff))
              {
                ?>
                <a href="editstaffprofile.php?id=<?php echo $staffid+1; ?>"   class="navi" style="background: red;  border-bottom-left-radius: 0; border-top-left-radius: 0; border-bottom-right-radius: 0; border-top-right-radius: 0; border-left: 2px solid white">NEXT > </a><a href="editstaffprofile.php?id=<?php echo $totalStaff; ?>"   class="navi" style="background: red;  border-bottom-left-radius: 0; border-top-left-radius: 0; border-bottom-right-radius: 100%; border-top-right-radius: 100%; border-left: 2px solid white">LAST >> </a>
                <?php
              }
            ?>          
            
            </center><br/>
            <?php 
          }
          ?>
        <center>
          <a href="../index.php" class="navi"><i class="fa fa-home"></i> Dashboard</a> <?php 
            
            if(strtolower($_SESSION['user_type'])==strtolower("admin")&&(strtolower($_SESSION['post'])==strtolower("Vice Principal Academics")||strtolower($_SESSION['post'])==strtolower("webmaster")))
            {
              ?>
              <a href="registerstaff.php" class="navi"><i class="fa fa-user"> New Staff</i></a>
              <a href="allstaff.php" class="navi"><i class="fa fa-table"> All Staff</i></a>
              <?php 
            }
            ?>
          <a href="editstaffprofile.php?id=<?php echo $staffid; ?>" class="navi"><i class="fa fa-table"> Update Profile</i></a>
          
        </center>
      </div>
      
      <div class="card-header" style="background: lightgreen"><center>The Profile of : <?php echo $details['names']; ?></center></div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
            <div class="form-row">

                <input type="hidden" id="staffid" name="staffid" class="form-control" placeholder="Full Names" required="required" autofocus="autofocus" value="<?php echo $staffid; ?>">

              <div class="col-md-6">                
                <img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 100px; height: 100px; border-radius: 20%;">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $names; ?></div>
                  <label for="names">Names</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $user_type; ?></div>
                  <label for="phone">User Type</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $phone; ?></div>
                  <label for="phone">Phone Number</label>
                </div>
                
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $sex; ?></div>
                  <label for="phone">Sex</label>
                </div>
                
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $sgl; ?></div>
                  <label for="sgl">SGL</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $status; ?></div>
                  <label for="status">Status</label>
                </div>
              </div>
            </div>
          </div>          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $date_employed; ?></div>
                  <label for="date_employed">Date Emplyed</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $date_resigned; ?></div>
                  <label for="date_resigned">Date Resigned</label>
                </div>
              </div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-label-group">
              <div class="form-control" ><?php echo $post; ?></div>           
              <label for="address">Post</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <div class="form-control" ><?php echo $address; ?></div>              
              <label for="address">Home Address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $email; ?></div>
                  <label for="email">Email Address</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control" ><?php echo $password; ?></div>
                  <label for="password">Password</label>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
