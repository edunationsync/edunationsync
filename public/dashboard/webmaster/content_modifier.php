<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

if(isset($_POST['btnModify'])){
$school_name=str_replace("'", "\'", $_POST['school_name']);
$school_keycode=str_replace("'", "\'", $_POST['school_keycode']);
$school_date_of_establishment=str_replace("'", "\'", $_POST['school_date_of_establishment']);
$school_phone=str_replace("'", "\'", $_POST['school_phone']);
$school_email=str_replace("'", "\'", $_POST['school_email']);
$school_website=str_replace("'", "\'", $_POST['school_website']);
$school_facebook=str_replace("'", "\'", $_POST['school_facebook']);
$school_instagram=str_replace("'", "\'", $_POST['school_instagram']);
$school_whatsapp=str_replace("'", "\'", $_POST['school_whatsapp']);
$school_linkedin=str_replace("'", "\'", $_POST['school_linkedin']);
$school_motto=str_replace("'", "\'", $_POST['school_motto']);
$school_address=str_replace("'", "\'", $_POST['school_address']);
$school_mission=str_replace("'", "\'", $_POST['school_mission']);
$school_vision=str_replace("'", "\'", $_POST['school_vision']);
$school_values=str_replace("'", "\'", $_POST['school_values']);
$school_owner=str_replace("'", "\'", $_POST['school_owner']);
$school_head=str_replace("'", "\'", $_POST['school_head']);

if(School::UpdateSchoolProfile($id, $school_name, $school_keycode, $school_date_of_establishment, $school_phone, $school_email, $school_website, $school_facebook, $school_instagram, $school_whatsapp, $school_linkedin, $school_motto, $school_address, $school_mission, $school_vision, $school_values, $school_owner, $school_head))
  {
    $msg="Profile Modified Successfully";

    //School Logo
    $name = "logo.jpg";
    $path = "../../images/school/".$name;
    if(move_uploaded_file($_FILES['school_logo']['tmp_name'], $path)) 
    {
      $msg=$msg."<br/> Result Logo Changed";
    } 

    //Result Header
    $rhname = "result_header.jpg";
    $rhpath = "../../images/school/".$rhname;
    if(move_uploaded_file($_FILES['school_result_header']['tmp_name'], $rhpath)) 
    {
      $msg=$msg."<br/> Result Header Changed";
    } 

    //Result Background
    $rbname = "result_background.jpg";
    $rbpath = "../../images/school/".$rbname;
    if(move_uploaded_file($_FILES['school_result_background']['tmp_name'], $rbpath)) 
    {
      $msg=$msg."<br/> Result Background Changed";
    } 

    //Testimonial Background
    $tbname = "testimonial_background.jpg";
    $tbpath = "../../images/school/".$tbname;
    if(move_uploaded_file($_FILES['school_testimonial_background']['tmp_name'], $tbpath))
    {
      $msg=$msg."<br/> Testimonial Background Changed";
    }
     

    //School Letter Head
    $lhname = "letter_head.jpg";
    $lhpath = "../../images/school/".$lhname;
    if(move_uploaded_file($_FILES['school_letter_head']['tmp_name'], $lhpath)) 
    {
      $msg=$msg."<br/> School Letter Head Changed";
    }   
  }
  else
  {
    $msg="Profile Modification has Failed";
  }
}

$schoolDetails=School::ReadSchoolDetails();
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

  <title>Website Content Management</title>

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
        <a href="registrationform.php?txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-table"> Offline Form</i></a>
      </div>
      <div class="card-header">SCHOOL PROFILE MODIFIER</div>
      <div class="card-header"><?php echo $msg; ?></div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/logo.png" style="width: 300px; ">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_logo" name="school_logo" class="form-control">
                  <label for="school_logo">School Logo</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="school_name" name="school_name" class="form-control" placeholder="School Name" value="<?php echo $schoolDetails['school_name']; ?>">
                  <label for="school_name">School Name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="school_keycode" name="school_keycode" class="form-control" placeholder="School Keycode"  autofocus="autofocus" value="<?php echo $schoolDetails['school_keycode']; ?>">
                  <label for="school_keycode">School Keycode</label>
                </div>
              </div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/letter_head.jpg" style="width: 300px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_letter_head" name="school_letter_head" class="form-control">
                  <label for="school_letter_head">School Letter Head</label>
                </div>
              </div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/result_header.jpg" style="width: 300px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_result_header" name="school_result_header" class="form-control">
                  <label for="school_result_header">School Result Header</label>
                </div>
              </div>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/result_background.jpg"  style="width: 300px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_result_background" name="school_result_background" class="form-control">
                  <label for="school_result_background">School Result Background</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/testimonial_background.jpg"  style="width: 300px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_testimonial_background" name="school_testimonial_background" class="form-control">
                  <label for="school_testimonial_background">School Testimonial Background</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="school_date_of_establishment" name="school_date_of_establishment" class="form-control" placeholder="Date of Establishment"  value="<?php echo $schoolDetails['school_date_of_establishment']; ?>">
                  <label for="school_date_of_establishment">Date of Establishment</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="school_phone" name="school_phone" class="form-control" placeholder="School Phone"  autofocus="autofocus"  value="<?php echo $schoolDetails['school_phone']; ?>">
                  <label for="school_phone">School Phone</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="email" id="school_email" name="school_email" class="form-control" placeholder="Active School Email" autofocus="autofocus" value="<?php echo $schoolDetails['school_email']; ?>">
                  <label for="school_email">Active School Email</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="url" id="school_website" name="school_website" class="form-control" placeholder="School Website" value="<?php echo $schoolDetails['school_website']; ?>">
                  <label for="school_website">School Website</label>
                </div>
              </div>
            </div>
          </div>     
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="url" id="school_facebook" name="school_facebook" class="form-control" placeholder="School Facebook" autofocus="autofocus" value="<?php echo $schoolDetails['school_facebook']; ?>">
                  <label for="school_facebook">School Facebook</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="url" id="school_instagram" name="school_instagram" class="form-control" placeholder="School Instagram" value="<?php echo $schoolDetails['school_instagram']; ?>">
                  <label for="school_instagram">School Instagram</label>
                </div>
              </div>
            </div>
          </div>      
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="school_whatsapp" name="school_whatsapp" class="form-control" placeholder="School Whatsapp" autofocus="autofocus" value="<?php echo $schoolDetails['school_whatsapp']; ?>">
                  <label for="school_whatsapp">School Whatsapp</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="url" id="school_linkedin" name="school_linkedin" class="form-control" placeholder="School LinkedIn" value="<?php echo $schoolDetails['school_linkedin']; ?>">
                  <label for="school_linkedin">School LinkedIn</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <textarea id="school_motto" name="school_motto" class="form-control" placeholder="School Full Address" rows="3"><?php echo $schoolDetails['school_motto']; ?></textarea>              
              <label for="school_motto">School Motto</label>
            </div>
          </div>        
          <div class="form-group">
            <div class="form-label-group">
              <textarea id="school_address" name="school_address" class="form-control" placeholder="School Full Address" rows="5"><?php echo $schoolDetails['school_address']; ?></textarea>              
              <label for="school_address">School Full Address</label>
            </div>
          </div>         
          <div class="form-group">
            <div class="form-label-group">
              <textarea id="school_mission" name="school_mission" class="form-control" placeholder="School Mission Statement" rows="5"><?php echo $schoolDetails['school_mission']; ?></textarea>              
              <label for="school_mission">School Mission Statement</label>
            </div>
          </div>        
          <div class="form-group">
            <div class="form-label-group">
              <textarea id="school_vision" name="school_vision" class="form-control" placeholder="School Vision Statement" rows="5"><?php echo $schoolDetails['school_vision']; ?></textarea>              
              <label for="school_vision">School Vision Statement</label>
            </div>
          </div>        
          <div class="form-group">
            <div class="form-label-group">
              <textarea id="school_values" name="school_values" class="form-control" placeholder="School Core Values" rows="5"><?php echo $schoolDetails['school_values']; ?></textarea>              
              <label for="school_values">School Core Values</label>
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="school_owner" name="school_owner" class="form-control" placeholder="Proprietor/Proprietress" autofocus="autofocus" value="<?php echo $schoolDetails['school_owner']; ?>">
                  <label for="school_owner">Proprietor/Proprietress</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="school_head" name="school_head" class="form-control" placeholder="School Head"  value="<?php echo $schoolDetails['school_head']; ?>">
                  <label for="school_head">School Head</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="btnModify" id="btnModify" >Update Profile</button>
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
