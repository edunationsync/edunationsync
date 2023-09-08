<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$id=$_GET['id'];
$details=Module::ReadStaffDetails($id);
$staff_id=$details['staff_id'];
$names=$details['names'];
$id=$details['id'];
$password=$details['password'];
$post=$details['post'];
$sex=$details['sex'];
$phone=$details['phone'];
$user_type=$details['user_type'];
$email=$details['email'];
$status=$details['status'];
$sgl=$details['sgl'];
$date_employed=$details['date_employed'];
$date_resigned=$details['date_resigned'];
$address=$details['address'];
$passport=$details['passport'];
$timestamp=$details['timestamp'];

if(isset($_POST['btnDelete']))
{
  $staff_id=$_POST['staff_id'];
  

  if(Module::DeleteStaff($staff_id))
  {    
    header("location:allstaff.php");
  }
  else
  {
    $msg="Student was not deleted successfully";
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

  <title>Delete Staff</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
        <a href="../index.php"   class="navi" ><i class="fa fa-home"></i> Dashboard</a> 
        <a href="allstudents.php?txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-table"> All Students</i></a>
        <a href="registerstudent.php?txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-user"> New Student</i></a>
      </div>
      
      <div class="card-header">Are your sure you want to delete staff?</div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staff_id ?>">
        <div class="text-center">
          <a class="d-block small mt-3" href="#" onclick="window.history.back()">Cancel</a> 
          <button type="submit" class="btn btn-primary btn-block" name="btnDelete" id="btnDelete" >Delete</button>
        </div>

          <div class="form-group">
            <div class="form-row">
                <input type="hidden" id="regid" name="regid" class="form-control" placeholder="Full Names" required="required" autofocus="autofocus" value="<?php echo $regid; ?>">
                <input type="hidden" id="session" name="session" class="form-control" placeholder="Full Names" required="required" autofocus="autofocus" value="<?php echo $session; ?>">
              <div class="col-md-6">                
                <img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 100px; height: 100px; border-radius: 100%;">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control"  ><?php echo $staff_id; ?></p>
                  <label for="staff_id">STAFF ID</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $names; ?></p>
                  <label for="names">NAME</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-label-group">
            <p class="form-control" ><?php echo $sex; ?></p>
            <label for="sex">SEX</label>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $user_type; ?></p>
                  <label for="user_type">USER TYPE</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $phone; ?></p>
                  <label for="phone">PHONE</label>
                </div>
              </div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $email; ?></p>
                  <label for="email">EMAIL</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $status; ?></p>
                  <label for="status">STATUS</label>
                </div>
              </div>
            </div>
          </div>         
          <div class="form-group">
            <div class="form-label-group">
              <p class="form-control" ><?php echo $sgl; ?></p>              
              <label for="sgl">SGL</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $date_employed; ?></p>
                  <label for="date_employed">DATE EMPLOYED</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $date_resigned; ?></p>
                  <label for="date_resigned">DATE RESIGNED</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $password; ?></p>
                  <label for="password">PASSWORD</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $address; ?></p>
                  <label for="address">ADDRESS</label>
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
