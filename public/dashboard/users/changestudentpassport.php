<?php session_start();
  include '../../Module.php';


  
//Profile Navigation Button Controller for administration
  $reg_no=$_GET['id'];
  $Class=$_GET['class'];
  
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
  $studentDetails=Module::ReadStudentDetailsp($reg_no);
if($_GET['remove_passport']=="true")
{  
    $passport='';
    if(Module::SaveStudentProfilePicturep($reg_no,$passport))
    {
      $msg="Profile Picture Was Removed Successfully";
      if($_SESSION['user_type']=="student"||$_SESSION['user_type']=="Student")
      {
        $_SESSION['passport']=$passport;
      }
      
    }
    else{
      $msg="Upload Failed";
    }

}

if(isset($_POST['btnSave']))
{
  if(is_uploaded_file($_FILES['passport']['tmp_name'])){
    $passport=base64_encode(file_get_contents($_FILES['passport']['tmp_name']));
    if(Module::SaveStudentProfilePicturep($reg_no,$passport))
    {
      $msg="Profile Picture Was Changed Successfully";
      if($_SESSION['user_type']=="student"||$_SESSION['user_type']=="Student")
      {
        $_SESSION['passport']=$passport;
      }
      
    }
    else{
      $msg="Upload Failed";
    }
  }
  else
  {
      $msg=" But you didn't select a passport to be uploaded ";
  }
}
else
{
  $studentDetails=Module::ReadStudentDetailsp($reg_no);
  $passport=$studentDetails['passport'];
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

  <title>Student's Passport</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">

  <div class="container">
    <div  style="padding: 20px 20px 20px 20px"  class="card card-register mx-auto mt-5">
      <div>
        <center>
          <a class="navi" href="#" onclick="window.history.back()"><i class="fa fa-menu"></i> Back</a> 

            
           <a class="navi" href="../index.php" ><i class="fa fa-home"></i> Dashboard</a> 
          <a class="navi" href="editstudentprofile.php?id=<?php echo $reg_no; ?>&txtclassp=<?php echo $Class; ?>">Profile</a>
          <?php 
          if($_SESSION['post']=="exams & records" || $_SESSION['post']=="webmaster"||$_SESSION['post']=="examinar"||$_SESSION['post']=="headmistress"||$_SESSION['post']=="headmaster")
          {
            ?>
            <a href="allstudents.php?txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-table" > All Students</i></a>
            <a href="registerstudent.php?txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-user"> Add</i></a>
            <?php 
          }
          ?> 
        </center>
      </div>
      
      <div class="card-header" style="background: lightgreen">Change <?php echo $reg_no.": ".$studentDetails['names']; ?>'s Passport</div>
      <div class="card-body">
        <form method="POST" action=""  enctype="multipart/form-data">

          <div class="form-group">
            <div><span ><?php echo $msg; ?></span></div><br/>
            <div class="form-row">
              <div class="col-md-6">
                <center><a href="?id=<?php echo $_GET['id']; ?>&remove_passport=true">Remove</a><img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 250px height: 250px"  /></center>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">                 
                  <input type="file" name="passport" id="passport" class="form-control" >
                <button class="btn btn-primary btn-block" type="submit" name="btnSave" id="btnSave">Save Profile Picture</button>
                </div>
                <br/><br/><br/><br/>
                <center>
                  <?php 
                  if (!($last_2_no=='/1'))
                  {
                    ?>
                    <a class="navi" href="changestudentpassport.php?id=<?php echo $reg_no_char.'1'; ?>&class=<?php echo $Class; ?>" style="background: red; border-top-left-radius: 100%; border-bottom-left-radius: 100%; border-top-right-radius: 0; border-bottom-right-radius: 0; border-right:2px solid white;"> << </a>
                    <?php
                  }
                  if (!($last_2_no=='/1'))
                  {
                    ?>
                    <a class="navi" href="changestudentpassport.php?id=<?php echo $reg_no_char.($last_no-1); ?>&class=<?php echo $Class; ?>" style="background: red; border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 0; border-bottom-right-radius: 0; border-left:2px solid white;"> < Previous</a>
                    <?php
                  }

                  if (!(($total_students==$last_2_no)||($total_students==$last_no)))
                  {
                    ?>
                    <a class="navi" href="changestudentpassport.php?id=<?php echo $reg_no_char.($last_no+1); ?>&class=<?php echo $Class; ?>" style="background: red; border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 0; border-bottom-right-radius: 0; border-left:2px solid white;"  >  Next > </a> 
                    <?php
                  } 
                  if (!(($total_students==$last_2_no)||($total_students==$last_no)))
                  {
                    ?>
                    <a class="navi" href="changestudentpassport.php?id=<?php echo $reg_no_char.($total_students); ?>&class=<?php echo $Class; ?>" style="background: red; border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 100%; border-bottom-right-radius: 100%; border-left:2px solid white;"  >  >></a> 
                    <?php
                  } 
                  ?>
                </center>
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
