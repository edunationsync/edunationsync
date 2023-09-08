<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$id=$_GET['id'];
$Class=$_GET['txtclassp'];
$details=Module::ReadStudentDetailsp($id);
$regno=$details['regno'];
$status=$details['status'];
$regid=$details['regid'];
$id=$details['id'];
$names=$details['names'];
$password=$details['password'];
$g_email=$details['g_email'];
$g_phone=$details['g_phone'];
$guardian=$details['guardian'];
$address=$details['address'];
$date_admitted=$details['date_admitted'];
$passport=$details['passport'];
$date_graduated=$details['date_graduated'];
$class=$details['class'];
$session=$details['session'];
$timestamp=$details['timestamp'];

if(isset($_POST['btnDelete']))
{
  $regno=$_POST['regno'];
  

  if(Module::DeleteStudentp($regno))
  {    
    header("location:allstudents.php?txtclassp=$Class");
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

  <title>Delete Student</title>

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
      
      <div class="card-header">Are your sure you want to delete student?</div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <input type="hidden" name="regno" id="regno" value="<?php echo $regno ?>">
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
                  <p class="form-control"  ><?php echo $names; ?></p>
                  <label for="names">Names</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $guardian; ?></p>
                  <label for="guardian">Gurdian Name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-label-group">
            <p class="form-control" ><?php echo $status; ?></p>
            <label for="status">Status</label>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $g_email; ?></p>
                  <label for="g_email">Gurdian Email</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $g_phone; ?></p>
                  <label for="g_phone">Gurdian Phone</label>
                </div>
              </div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $date_admitted; ?></p>
                  <label for="date_admitted">Date Admitted</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $date_graduated; ?></p>
                  <label for="date_graduated">Date Graduated</label>
                </div>
              </div>
            </div>
          </div>         
          <div class="form-group">
            <div class="form-label-group">
              <p class="form-control" ><?php echo $address; ?></p>              
              <label for="address">Home Address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $regno; ?></p>
                  <label for="regno">Register Number</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $password; ?></p>
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
