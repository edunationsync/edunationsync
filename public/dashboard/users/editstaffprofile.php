<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$recordid=$_GET['id'];


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
$sex=$details['sex'];
$password=$details['password'];
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
    $sex=$_POST['sex'];
    $password=$_POST['password'];
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
      if(Module::IsStaffEmailExistUpdate($staffid,$email))
      {
        if(Module::UpdateStaffById($staffid,$names,$sex,$user_type,$password,$post,$email,$phone,$status,$date_employed,$date_resigned,$sgl,$address))
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
      else{
        $msg="Profile Modification has failed due to Mismatched Email Address";
      }

    }
    else{

      if(Module::UpdateStaffById($staffid,$names,$sex,$user_type,$password,$post,$email,$phone,$status,$date_employed,$date_resigned,$sgl,$address))
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
  }
  elseif(isset($_GET['passport_removerbtn'])){
    //Passport Updater Module 
    //$passport=base64_encode(file_get_contents($_FILES['passport']['tmp_name']));

    if(Module::SaveProfilePicture($staffid,$emptypassport))
    {
      $msg="Profile Picture Was Removed Successfully";
    }
    else{
      $msg="Upload Failed";
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

  <title>Staff Profile Updater</title>

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
              if($_GET['id']>1)
              {
                ?><a href="editstaffprofile.php?id=<?php echo '1'; ?>" class="navi" style="background: red; border-bottom-left-radius: 100%; border-top-left-radius: 100%; border-bottom-right-radius: 0; border-top-right-radius: 0;"> << FIRST</a><a href="editstaffprofile.php?id=<?php echo $_GET['id']-1; ?>" class="navi" style="background: red; border-bottom-left-radius: 0; border-top-left-radius: 0; border-bottom-right-radius: 0; border-top-right-radius: 0; border-left: 2px solid white">< PREV</a>
                <?php
              }

              $totalStaff=count(Module::ReadGeneralStaff());

              if(!($_GET['id']==$totalStaff))
              {
                ?>
                <a href="editstaffprofile.php?id=<?php echo $_GET['id']+1; ?>"   class="navi" style="background: red;  border-bottom-left-radius: 0; border-top-left-radius: 0; border-bottom-right-radius: 0; border-top-right-radius: 0; border-left: 2px solid white">NEXT > </a><a href="editstaffprofile.php?id=<?php echo $totalStaff; ?>"   class="navi" style="background: red;  border-bottom-left-radius: 0; border-top-left-radius: 0; border-bottom-right-radius: 100%; border-top-right-radius: 100%; border-left: 2px solid white">LAST >> </a>
                <?php
              }
            ?>          
            
            </center><br/>
            <?php 
          }
          ?>
        <center>
          <a href="../index.php" class="navi"><i class="fa fa-home"></i> Dashboard</a>
          <?php 
            
            if(strtolower($_SESSION['user_type'])==strtolower("admin")&&(strtolower($_SESSION['post'])==strtolower("Vice Principal Academics")||strtolower($_SESSION['post'])==strtolower("webmaster")))
            {
              ?>
              <a href="registerstaff.php" class="navi"><i class="fa fa-user"> New Staff</i></a>
              <a href="allstaff.php" class="navi"><i class="fa fa-table"> All Staff</i></a>
              <?php 
            }
            ?>
          <a href="viewstaffprofile.php?id=<?php echo $_GET['id']; ?>" class="navi"><i class="fa fa-table"> View Profile</i></a>
        </center>
      </div>
      
      <div class="card-header" style="background: lightgreen"><center>The Profile of : <?php echo $details['names']; ?></center></div>
      <div class="card-header" style="background: red; color:white">
        <center><?php echo $msg; ?></center></div>
      <div class="card-body">
        <a href="?id=<?php echo $_GET['id'] ?>&passport_removerbtn=yes" >Remove Passport</a>
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
            <div class="form-row">

                <input type="hidden" id="passport_removerbtn" name="passport_removerbtn" class="form-control" placeholder="Full Names" autofocus="autofocus">

                <input type="hidden" id="id" name="id" class="form-control" placeholder="Full Names" autofocus="autofocus" value="<?php echo $_GET['id']; ?>">

                <input type="hidden" id="staffid" name="staffid" class="form-control" placeholder="Full Names" autofocus="autofocus" value="<?php echo $staffid; ?>">

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
                  <input type="text" id="names" name="names" class="form-control" placeholder="Full Names" required="required" autofocus="autofocus" value="<?php echo $names; ?>">
                  <label for="names">Names</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                    <?php 
                    if(strtolower($_SESSION['user_type'])==strtolower("admin")&&(strtolower($_SESSION['post'])==strtolower("Vice Principal Academics")||strtolower($_SESSION['post'])==strtolower("assistant headmaster")||strtolower($_SESSION['post'])==strtolower("headmistress")||strtolower($_SESSION['post'])==strtolower("assistant headmistress")||strtolower($_SESSION['post'])==strtolower("webmaster")))
                    {
                      ?>
                      <select id="user_type" name="user_type" class="form-control">
                        <?php
                        $user_types=array("Admin","Staff");
                        echo "<option>$user_type</option>";
                        foreach($user_types as $user_type_s)
                        {

                          if(!($user_type_s==$user_type))
                          {
                            echo "<option>$user_type_s</option>";
                          }
                        }
                        ?>
                      </select> 
                      <?php
                    }
                    else
                    {
                      ?>
                      <div class="form-control" ><?php echo $user_type; ?></div>
                      <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">
                      <?php
                    }

                    ?>


                  <label for="user_type">User Type</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="<?php echo $phone; ?>">
                  <label for="phone">Phone Number</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">

                  <?php 
                  if(strtolower($_SESSION['post'])==strtolower("Vice Principal Academics"))
                  {
                    ?>
                    <select id="sex" name="sex" class="form-control">
                      <?php
                      $sexes=array("Male","Female");
                      echo "<option>$sex</option>";
                      foreach($sexes as $sex_s)
                      {

                        if(!($sex_s==$sex))
                        {
                          echo "<option>$sex_s</option>";
                        }
                      }
                      ?>
                    </select> 
                    <?php
                  }
                  else
                  {
                    ?>
                    <div class="form-control" ><?php echo $sex; ?></div>
                    <input type="hidden" name="sex" value="<?php echo $sex; ?>">
                    <?php
                  }

                  ?>
                  <label for="sex">SEX</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="sgl" name="sgl" class="form-control" placeholder="Salary Grade Level (SGL)" value="<?php echo $sgl; ?>">
                  <label for="sgl">SGL</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <?php 
                  if(strtolower($_SESSION['user_type'])==strtolower("admin")&&(strtolower($_SESSION['post'])==strtolower("Vice Principal Academics")||strtolower($_SESSION['post'])==strtolower("webmaster")))
                  {
                    ?>
                    <select id="status" name="status" class="form-control">
                      <?php
                      $Statuss=array("Active","Resigned","Sacked","Leave","Suspension");
                      echo "<option>$status</option>";
                      foreach($Statuss as $status_s)
                      {

                        if(!($status_s==$status))
                        {
                          echo "<option>$status_s</option>";
                        }
                      }
                      ?>
                    </select> 
                    <?php
                  }
                  else
                  {
                    ?>
                    <div class="form-control" ><?php echo $status; ?></div>
                    <input type="hidden" name="status" value="<?php echo $status; ?>">
                    <?php
                  }

                  ?>

                  <label for="status">Status</label>
                </div>
              </div>
            </div>
          </div>          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="date_employed" name="date_employed" class="form-control" placeholder="Date Employed" value="<?php echo $date_employed; ?>">
                  <label for="date_employed">Date Emplyed</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="date_resigned" name="date_resigned" class="form-control" placeholder="Date Resigned" value="<?php echo $date_resigned; ?>">
                  <label for="date_resigned">Date Resigned</label>
                </div>
              </div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-label-group">
              <?php 
              if(strtolower($_SESSION['user_type'])==strtolower("admin")&&(strtolower($_SESSION['post'])==strtolower("Vice Principal Academics")||strtolower($_SESSION['post'])==strtolower("assistant headmaster")||strtolower($_SESSION['post'])==strtolower("headmistress")||strtolower($_SESSION['post'])==strtolower("assistant headmistress")||strtolower($_SESSION['post'])==strtolower("webmaster")))
                    
                {
                ?>
                <select id="post" name="post" class="form-control">
                  <?php
                  $posts=array("Exams & Records","Examinar","Assistant Examinar","Finance","Assistant Finance","Headmaster","Assistant Headmaster","Headmistress","Assistant Headmistress","Teacher","Security","Cleaner","Principal","Vice Principal Administration","Vice Principal Academics","ICT Officer","Assistant ICT Officer","Chief Librarian","Librarian","Language Head of Department","Arts Head of Department","Science Head of Department");
                  echo "<option>$post</option>";
                  foreach($posts as $post_s)
                  {

                    if(!($post_s==$post))
                    {
                      echo "<option>$post_s</option>";
                    }
                  }
                  ?>
                </select> 
                <?php
              }
              else
              {
                ?>
                <div class="form-control" ><?php echo $post; ?></div>
                <input type="hidden" name="post" value="<?php echo $post; ?>">
                <?php
              }

              ?>
                         
              <label for="address">Post</label>
            </div>
          </div>     
          
          <div class="form-group">
            <div class="form-label-group">
              <textarea id="address" name="address" class="form-control" placeholder="Home Address" rows="5"><?php echo $address; ?></textarea>              
              <label for="address">Home Address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo $email; ?>">
                  <label for="email">Email Address</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="password" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
                  <label for="password">Password</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="btnUpdate" id="btnUpdate" >Update</button>
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
