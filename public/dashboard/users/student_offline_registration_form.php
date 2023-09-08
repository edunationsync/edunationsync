<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$class=$_GET['txtclassp'];
$Class=$_GET['txtclassp'];
$session=Module::GetClassSessionp($class);


  $AllStudents=Module::ReadSessionStudentsp($session,$Class);
  $newSerial=count($AllStudents);

    if(isset($_POST['btnAdd'])){
      $nRegNo=str_replace("'", "\'", $_POST['txtRegNo']) ;
      $nNames=str_replace("'", "\'", $_POST['txtName']) ;
      $password=str_replace("'", "\'", $_POST['password']) ;
      $guardian=str_replace("'", "\'", $_POST['guardian']) ;
      $g_phone=str_replace("'", "\'", $_POST['g_phone']) ;
      $g_email=str_replace("'", "\'", $_POST['g_email']) ;
      $lga=str_replace("'", "\'", $_POST['lga']) ;
      $state=str_replace("'", "\'", $_POST['state']) ;
      $country=str_replace("'", "\'", $_POST['country']) ;
      $date_of_birth=str_replace("'", "\'", $_POST['date_of_birth']) ;
      $address=str_replace("'", "\'", $_POST['address']) ;
      $date_graduated=str_replace("'", "\'", $_POST['date_graduated']) ;
      $nClass=$Class;
      $nDateAdmitted=$_POST['txtDateAdmitted'];
      $nSession=$_POST['txtSession'];
      $nPassword=$_POST['txtPassword'];
      $nRegId=$nRegNo;
      
      //++==++This is used just to generate the register number for checking existence only
      $ree=explode("/", $session);
      $year=$ree[0];
      $classtoken=substr($class, strlen($class)-1);

      if(!(($classtoken=="A") || ($classtoken=="B") || ($classtoken=="C") || ($classtoken=="D") || ($classtoken=="E") || ($classtoken=="F") || ($classtoken=="G") || ($classtoken=="H") || ($classtoken=="I") || ($classtoken=="J") || ($classtoken=="K") || ($classtoken=="L") || ($classtoken=="M") || ($classtoken=="N") || ($classtoken=="O") || ($classtoken=="P") || ($classtoken=="Q") || ($classtoken=="R") || ($classtoken=="S") || ($classtoken=="T") || ($classtoken=="U") || ($classtoken=="V") || ($classtoken=="W") || ($classtoken=="X") || ($classtoken=="Y") || ($classtoken=="Z")))
      {
        $regno=$school_details['school_keycode']."/$year"."/$nRegNo";
      }
      else
      {
        $regno=$school_details['school_keycode']."/$year/".$classtoken."/$nRegNo";
      }

      echo "<b style='color: red'>[ $regno ]</b>";
      //++==++

      if(Module::IsStudentExistp($regno))
      {
        
        if(Module::DeleteStudentp($regno))
        {
          $msg="Student Replaced <br/>";
          if(Module::AddStudentp($nRegId,$nRegNo,$nNames,$date_of_birth,$lga,$state,$country,$nClass,$nDateAdmitted,$nSession,$nPassword,$date_graduated,$g_email,$g_phone,$address,$guardian)){
            $msg="Added Sucessfully <br/>";
          }
          else
          {
            $msg="Not Added <br/>";
          }

          //Passport Updater Module 
          if(is_uploaded_file($_FILES['passport']['tmp_name'])){

            $passport=base64_encode(file_get_contents($_FILES['passport']['tmp_name']));
            if(Module::SaveStudentProfilePicturep($regno,$passport))
            {
              //$msg="Profile Picture Was Changed Successfully";
            }
            else{
              //$msg="Upload Failed";
            }
          }
          else
          {
            $msg=$msg."<br/> Profile picture was not selected";
          }

        }
        else
        {
          $msg=$msg."<br/>Not Removed Successfully";
        }

          
      }
      else
      {
        if(Module::AddStudentp($nRegId,$nRegNo,$nNames,$nClass,$nDateAdmitted,$nSession,$nPassword,$date_graduated,$g_email,$g_phone,$address,$guardian))
        {
          $msg="Added Sucessfully <br/>";
        }
        else
        {
          $msg="Not Added <br/>";
        }

        //Passport Updater Module 
        if(is_uploaded_file($_FILES['passport']['tmp_name'])){

          $passport=base64_encode(file_get_contents($_FILES['passport']['tmp_name']));
          if(Module::SaveStudentProfilePicturep($regno,$passport))
          {
            //$msg="Profile Picture Was Changed Successfully";
          }
          else{
            //$msg="Upload Failed";
          }
        }
        else
        {
          $msg=$msg."<br/> Profile picture was not selected";
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

  <title>New Student Registration Form</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
        <a href="registerstudent.php?txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-table"> Online Form</i></a>
      </div>
      <div class="card-header" style="font-weight: bolder; text-align: center ">DUBAI CARE SCHOOL ANKPA<BR/>ANKPA, KOGI STATE<BR/>OFOKE CLOSE OPULEGA<BR/><BR/>NEW STUDENT REGISTRATION FORM</div>
      <div class="card-header"><?php echo $msg; ?></div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6"> 
              <input type="hidden" name="txtClass" id="txtClass" value="<?php echo $_GET['class'] ?>">
              <input type="hidden" name="txtSession" id="txtSession" value="<?php echo $session ?>">
                <img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="width: 100px; height: 100px; border-radius: 100%;">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="txtName" name="txtName" class="form-control">
                  <label for="txtName">Full Name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="guardian" name="guardian" class="form-control">
                  <label for="guardian">Guardian Name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="g_email" name="g_email" class="form-control">
                  <label for="g_email">Guardian Email</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="g_phone" name="g_phone" class="form-control">
                  <label for="g_phone">Guadian Phone</label>
                </div>
              </div>
            </div>
          </div>          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lga" name="lga" class="form-control">
                  <label for="lga">LGA</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="state" name="state" class="form-control">
                  <label for="state">State</label>
                </div>
              </div>
            </div>
          </div>          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="country" name="country" class="form-control">
                  <label for="country">Country</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="date_of_birth" name="date_of_birth" class="form-control">
                  <label for="date_of_birth">Date of Birth</label>
                </div>
              </div>
            </div>
          </div>                    
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="txtDateAdmitted" name="txtDateAdmitted" class="form-control">
                  <label for="txtDateAdmitted">Date Admitted</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="date_graduated" name="date_graduated" class="form-control">
                  <label for="date_graduated">Date Graduated</label>
                </div>
              </div>
            </div>
          </div>         
          <div class="form-group">
            <div class="form-label-group">
              <textarea id="address" name="address" class="form-control" rows="5"></textarea>              
              <label for="address">Home Address</label>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="txtRegNo" name="txtRegNo" class="form-control" value="<?php echo $newSerial+1; ?>">
                  <label for="txtRegNo">Serial Number</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="txtPassword" name="txtPassword" class="form-control" >
                  <label for="txtPassword">Password</label>
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