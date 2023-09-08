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
$date_of_birth=$details['date_of_birth'];
$lga=$details['lga'];
$country=$details['country'];
$state=$details['state'];
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

if(isset($_POST['btnUpdate']))
{
  $regid=str_replace("'", "\'", $_POST['regid']);
  $status=str_replace("'", "\'", $_POST['status']);
  $regno=str_replace("'", "\'", $_POST['regno']);
  $names=str_replace("'", "\'", $_POST['names']);
  $password=str_replace("'", "\'", $_POST['password']);
  $g_email=str_replace("'", "\'", $_POST['g_email']);
  $g_phone=str_replace("'", "\'", $_POST['g_phone']);
  $guardian=str_replace("'", "\'", $_POST['guardian']);
  $address=str_replace("'", "\'", $_POST['address']);
  $date_admitted=str_replace("'", "\'", $_POST['date_admitted']);
  $date_graduated=str_replace("'", "\'", $_POST['date_graduated']);
  $session=str_replace("'", "\'", $_POST['session']);
  

  if(Module::UpdateStudentp($id,$regid,$regno,$status,$names,$Class,$date_admitted,$session,$password,$guardian,$g_email,$g_phone,$date_graduated,$address))
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
    if(Module::SaveStudentProfilePicturep($regno,$passport))
    {
      $msg="Profile Picture Was Changed Successfully";
    }
    else{
      $msg="Upload Failed";
    }
  }
}

  
  //Profile Navigation Button Controller for administration
  $reg_no=$_GET['id'];
  $Class=$_GET['txtclassp'];
  
  $last_no=substr($reg_no, strlen($reg_no)-1,1);
  $last_2_no=substr($reg_no, strlen($reg_no)-2);

  $session=Module::GetClassSessionp($Class);
  $total_students=Module::GetTotalStudentsp($session,$Class);

  if(($last_no=='0'&&$last_2_no>0))
  {
    $reg_no_char=substr($reg_no, 0,strlen($reg_no)-2);
    $last_no=substr($reg_no, strlen($reg_no)-2);
  }
  elseif($last_no=='9'&&$last_2_no>9)
  {    
    $reg_no_char=substr($reg_no, 0,strlen($reg_no)-2);
    $last_no=substr($reg_no, strlen($reg_no)-2);
  }
  else
  {    
    $reg_no_char=substr($reg_no, 0,strlen($reg_no)-1);
    $last_no=substr($reg_no, strlen($reg_no_char),1);
  }
  
  $src_reg_no=$reg_no_char.$last_2_no;
  
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

  <title>Profile Editor Widget</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <!-- //Profile Navigation Button Controller for administration-->
      <center>
        <?php 
        if (!($last_2_no=='/1'))
        {
          ?>
          <a class="navi" href="viewstudentprofile.php?id=<?php echo $reg_no_char.'1'; ?>&txtclassp=<?php echo $Class; ?>" style="background: red; border-top-left-radius: 100%; border-bottom-left-radius: 100%; border-top-right-radius: 0; border-bottom-right-radius: 0; border-right:2px solid white;"> << </a>
          <?php
        }
        if (!($last_2_no=='/1'))
        {
          ?>
          <a class="navi" href="viewstudentprofile.php?id=<?php echo $reg_no_char.(($last_no)-1); ?>&txtclassp=<?php echo $Class; ?>" style="background: red; border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 0; border-bottom-right-radius: 0; border-left:2px solid white;"> < Previous</a>
          <?php
        }
        if (!(($total_students==$last_2_no)||($total_students==$last_no)))
        {
          ?>
          <a class="navi" href="viewstudentprofile.php?id=<?php echo $reg_no_char.($last_no+1); ?>&txtclassp=<?php echo $Class; ?>" style="background: red; border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 0; border-bottom-right-radius: 0; border-left:2px solid white;"  >  Next > </a> 
          <?php
        } 
        if (!(($total_students==$last_2_no)||($total_students==$last_no)))
        {
          ?>
          <a class="navi" href="viewstudentprofile.php?id=<?php echo $reg_no_char.($total_students); ?>&txtclassp=<?php echo $Class; ?>" style="background: red; border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-left:2px solid white;"  >  >></a> 
          <?php
        } 
        ?>
      </center>
      <!-- //Profile Navigation Button Controller for administration-->
      <div style="padding: 20px 20px 20px 20px">
        <center><a href="#" onclick="window.history.back()">Back</a>
        <a href="../index.php"   class="navi" ><i class="fa fa-home"></i> Dashboard</a> 
        <a href="editstudentprofile.php?id=<?php echo $regno; ?>&txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-table"> Edit Profile</i></a>
        <?php 
        
        if(strtolower($_SESSION['user_type'])==strtolower("admin")&&(strtolower($_SESSION['post'])==strtolower("headmaster")||strtolower($_SESSION['post'])==strtolower("assistant headmaster")||strtolower($_SESSION['post'])==strtolower("headmistress")||strtolower($_SESSION['post'])==strtolower("assistant headmistress")||strtolower($_SESSION['post'])==strtolower("webmaster")))
        {
          ?>
          
          <a href="allstudents.php?txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-table"> All Students</i></a>
          <a href="registerstudent.php?txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-user"> New Student</i></a>
          <?php
        }
        ?></center>
      </div>
      
      <div class="card-header">Modify Profile</div>
      <div class="card-header"><?php echo $msg; ?></div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
            <div class="form-row">
                <input type="hidden" id="regid" name="regid" class="form-control" placeholder="Full Names" required="required" autofocus="autofocus" value="<?php echo $regid; ?>">
                <input type="hidden" id="session" name="session" class="form-control" placeholder="Full Names" required="required" autofocus="autofocus" value="<?php echo $session; ?>">
              <div class="col-md-6">                
                <img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 100px; height: 100px; border-radius: 10px;">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $names; ?></div>
                  <label for="names">Names</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $guardian; ?></div>
                  <label for="guardian">Gurdian Name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-label-group">
            <div class="form-control"><?php echo $status; ?></div>
            <label for="guardian">Status</label>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $lga; ?></div>
                  <label for="lga">LGA</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"> <?php echo $state; ?></div>
                  <label for="state">State</label>
                </div>
              </div>
            </div>
          </div>          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $country; ?></div>
                  <label for="country">Country</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"> <?php echo $date_of_birth; ?></div>
                  <label for="date_of_birth">Date of Birth</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $g_email; ?></div>
                  <label for="g_email">Gurdian Email</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $g_phone; ?></div>
                  <label for="g_phone">Gurdian Phone</label>
                </div>
              </div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $date_admitted; ?></div>
                  <label for="date_admitted">Date Admitted</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $date_graduated; ?></div>
                  <label for="date_graduated">Date Graduated</label>
                </div>
              </div>
            </div>
          </div>         
          <div class="form-group">
            <div class="form-label-group">
              <div class="form-control"><?php echo $address; ?></div>
              <label for="address">Home Address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $regno; ?></div>
                  <label for="regno">Register Number</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $password; ?></div>
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
