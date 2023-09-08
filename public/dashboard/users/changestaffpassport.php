<?php session_start();
  include '../../Module.php';
  

if(isset($_GET['id']))
{
  $staffid=$_GET['id'];
}
else
{
  $staffid=$_SESSION['userid'];
}
  
if(isset($_POST['btnSave']))
{
  if(is_uploaded_file($_FILES['passport']['tmp_name'])){
    
    $passport=base64_encode(file_get_contents($_FILES['passport']['tmp_name']));
    if(Module::SaveProfilePicture($_SESSION['userid'],$passport))
    {
      $msg="Profile Picture Was Changed Successfully";
    }
    else{
      $msg="Upload Failed";
    }
  }
  else
  {
    $msg=" But you didn't Upload Passport of the Product ";
  }
}
else
{
  $staffDetails=Module::ReadStaffDetails($_SESSION['userid']);
  $passport=$staffDetails['passport'];
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

  <title>Profile Picture</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">

  <div class="container">
    <div  style="padding: 20px 20px 20px 20px"  class="card card-register mx-auto mt-5">
      <div>
        <a class="navi" href="../index.php" ><i class="fa fa-home"></i> Dashboard</a> 
        <a class="navi" href="editstaffprofile.php?id=<?php echo $staffid;?>">Edit Profile</a> 
        <a class="navi" href="viewstaffprofile.php?id=<?php echo $staffid;?>">View Profile</a>
      </div>
      
      <div class="card-header">Change Passport</div>
      <div class="card-body">
        <form method="POST" action=""  enctype="multipart/form-data">

          <div class="form-group">
            <div><span ><?php echo $msg; ?></span></div><br/>
            <div class="form-row">
              <div class="col-md-6">
                <center><img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 250px height: 250px"  /></center>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">  
                <input type="hidden" name="email" id="email" value="<?php echo $_GET['email'] ?>">
                <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>">               
                  <input type="file" name="passport" id="passport" class="form-control" >
                <button class="btn btn-primary btn-block" type="submit" name="btnSave" id="btnSave">Save Profile Picture</button>
                </div>
              </div><br/>
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
