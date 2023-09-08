<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();


if(isset($_POST['btnUpdate']))
{
  $staffid=$_POST['staffid'];
  $names=$_POST['names'];
  $sex=$_POST['sex'];
  $password=$_POST['password'];
  $user_type=$_POST['user_type'];
  $post=$_POST['post'];
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $status=$_POST['status'];
  $date_employed=$_POST['date_employed'];
  $date_resigned=$_POST['date_resigned'];
  $sgl=$_POST['sgl'];
  $address=$_POST['address'];

    if(Module::IsStaffEmailExistNew($email))
    {
      $msg="Another staff have registered with this email, try another one";
    }
    else
    {
      if(Module::AddNewStaff($staffid,$names,$sex,$user_type,$password,$post,$email,$phone,$status,$date_employed,$date_resigned,$sgl,$address))
      {    
        $msg="User was registered successfully";
      }
      else
      {
        $msg="User was not registered successfully";
      }
    }
      

  //Passport Updater Module 
  if(is_uploaded_file($_FILES['passport']['tmp_name'])){

    $passport=base64_encode(file_get_contents($_FILES['passport']['tmp_name']));
    if(Module::SaveProfilePicture($staffid,$passport))
    {
      $msg=$msg."Profile Picture Was Changed Successfully";
    }
    else{
      $msg=$msg."Upload Failed";
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

  <title>New Staff Registration</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
        <a href="../"   class="navi" ><i class="fa fa-home"></i> Dashboard</a> 
        <?php 
            if(strtolower($_SESSION['user_type'])==strtolower("Staff")||strtolower($_SESSION['user_type'])==strtolower("Admin")||strtolower($_SESSION['post'])==strtolower("Vice Principal Academics"))
            {
              ?>
              <a href="allstaff.php" class="navi"><i class="fa fa-table"> All Staff</i></a>
              <?php 
            }
            ?>
      </div>
      
      <div class="card-header" style="background: lightgreen">Register New Staff</div>
      <div class="card-header" style="background: red; color:white">
        <center><?php echo $msg; ?></center></div>
      <div class="card-body">

        <?php echo $msg;?>
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">                
                <img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 100px; height: 100px; border-radius: 100%;">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="passport" name="passport" class="form-control" >
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="names" name="names" class="form-control" placeholder="Full Names"  autofocus="autofocus" required>
                  <label for="names">Names</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number">
                  <label for="phone">Phone Number</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="sgl" name="sgl" class="form-control" placeholder="Salary Grade Level (SGL)">
                  <label for="sgl">SGL</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select id="status" name="status" class="form-control">
                    <option>Active</option>
                    <option>Resigned</option>
                    <option>Sacked</option>
                  </select>  
                  <label for="status">Status</label>
                </div>
              </div>
            </div>
          </div>          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="date_employed" name="date_employed" class="form-control" placeholder="Date Employed">
                  <label for="date_employed">Date Employed</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="date_resigned" name="date_resigned" class="form-control" placeholder="Date Resigned">
                  <label for="date_resigned">Date Resigned</label>
                </div>
              </div>
            </div>
          </div>   
          <div class="form-group">
            <div class="form-label-group">
              <select id="sex" name="sex" class="form-control">
                <option>Male</option>
                <option>Female</option>
              </select>            
              <label for="user_type">Sex</label>
            </div>
          </div>  
          <div class="form-group">
            <div class="form-label-group">
              <select id="user_type" name="user_type" class="form-control" required>
                <option>Staff</option>
                <option>Admin</option>
              </select>            
              <label for="user_type">User Type</label>
            </div>
          </div>  
          <div class="form-group">
            <div class="form-label-group">
              <select id="post" name="post" class="form-control" required>
                <?php $posts=Position::ReadAllPositionPosts();?>
                <?php 
                foreach($posts as $post)
                {
                  ?><option><?php echo $post;?></option>
                  <?php
                }?>
              </select>
              <label for="post">Post</label>
            </div>
          </div>        
          <div class="form-group">
            <div class="form-label-group">
              <textarea id="address" name="address" class="form-control" placeholder="Home Address" rows="5"></textarea>              
              <label for="address">Home Address</label>
            </div>
          </div>  
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="staffid" name="staffid" class="form-control" placeholder="Staff ID" required>             
              <label for="staffid">Staff Unique ID</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="email" name="email" class="form-control" placeholder="Email Address" required="required">
                  <label for="email">Email Address</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="password" name="password" class="form-control" placeholder="Password" required="required" value="man">
                  <label for="password">Password</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="btnUpdate" id="btnUpdate" >Register</button>
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
