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
$school_exam_officer=str_replace("'", "\'", $_POST['school_exam_officer']);
$school_burser=str_replace("'", "\'", $_POST['school_burser']);
$header_color=str_replace("'", "\'", $_POST['header_color']);
$top_header_color=str_replace("'", "\'", $_POST['top_header_color']);

$domain_sub_date=str_replace("'", "\'", $_POST['domain_sub_date']);
$domain_due_date=str_replace("'", "\'", $_POST['domain_due_date']);
$hosting_sub_date=str_replace("'", "\'", $_POST['hosting_sub_date']);
$hosting_due_date=str_replace("'", "\'", $_POST['hosting_due_date']);

if(School::UpdateSchoolProfile($id, $school_name, $school_keycode, $school_date_of_establishment, $school_phone, $school_email, $school_website, $school_facebook, $school_instagram, $school_whatsapp, $school_linkedin, $school_motto, $school_address, $school_mission, $school_vision, $school_values, $school_owner, $school_head, $school_exam_officer, $school_burser, $domain_sub_date, $domain_due_date, $hosting_sub_date, $hosting_due_date, $header_color, $top_header_color))
  {
    $msg="Profile Modified Successfully";

    //School Logo
    $name = "logo.png";
    $path = "../../images/school/".$name;
    if(move_uploaded_file($_FILES['school_logo']['tmp_name'], $path)) 
    {
      $msg=$msg."<br/> School Logo Changed";
    } 

    //School Head Passport
    $name = "head_passport.png";
    $path = "../../images/school/".$name;
    if(move_uploaded_file($_FILES['school_head_passport']['tmp_name'], $path)) 
    {
      $msg=$msg."<br/> School Head Passport Changed";
    } 

    //School Owner Passport
    $name = "owner_passport.png";
    $path = "../../images/school/".$name;
    if(move_uploaded_file($_FILES['school_owner_passport']['tmp_name'], $path)) 
    {
      $msg=$msg."<br/> School Owner Passport Changed";
    } 

    //School Exam Officer Passport
    $name = "exam_officer_passport.png";
    $path = "../../images/school/".$name;
    if(move_uploaded_file($_FILES['school_exam_officer_passport']['tmp_name'], $path)) 
    {
      $msg=$msg."<br/> School Exam Officer Passport Changed";
    }  

    //School Result Sign Passport
    $name = "result_sign.jpg";
    $path = "../../images/school/".$name;
    if(move_uploaded_file($_FILES['school_result_sign']['tmp_name'], $path)) 
    {
      $msg=$msg."<br/> School Result Sign Changed";
    } 

    //School Result Header Passport
    $name = "result_header.jpg";
    $path = "../../images/school/".$name;
    if(move_uploaded_file($_FILES['school_result_header']['tmp_name'], $path)) 
    {
      $msg=$msg."<br/> School Result Heder Changed";
    } 

    //School Burser Passport
    $name = "burser_passport.png";
    $path = "../../images/school/".$name;
    if(move_uploaded_file($_FILES['school_burser_passport']['tmp_name'], $path)) 
    {
      $msg=$msg."<br/> School Burser Passport Changed";
    } 

    //School Favicon 
    $name = "favicon.png";
    $path = "../../images/school/".$name;
    if(move_uploaded_file($_FILES['school_favicon']['tmp_name'], $path)) 
    {
      $msg=$msg."<br/> Favicon Changed";
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

  <title>School Profile</title>

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
                <img src="../../images/school/favicon.png" style="width: 300px; ">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_favicon" name="school_favicon" class="form-control">
                  <label for="school_favicon">School favicon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/head_passport.png" style="width: 300px; ">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_head_passport" name="school_head_passport" class="form-control">
                  <label for="school_head_passport">School head passport</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/owner_passport.png" style="width: 300px; ">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_owner_passport" name="school_owner_passport" class="form-control">
                  <label for="school_owner_passport">School owner passport</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/exam_officer_passport.png" style="width: 300px; ">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_exam_officer_passport" name="school_exam_officer_passport" class="form-control">
                  <label for="school_exam_officer_passport">School Exam Officer passport</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/burser_passport.png" style="width: 300px; ">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_burser_passport" name="school_burser_passport" class="form-control">
                  <label for="school_burser_passport">School Burser Passport</label>
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
              <p style="background-color: <?php echo $schoolDetails['header_color']; ?>; height: 50px; width: 50px">RGB</p>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="color" id="header_color" name="header_color" class="form-control" placeholder="Header Color" value="<?php echo $schoolDetails['header_color']; ?>">
                  <label for="header_color">Header Color</label>
                </div>
              </div>
            </div>
            <div class="form-row">
              <p style="background-color: <?php echo $schoolDetails['top_header_color']; ?>; height: 50px; width: 50px">RGB</p>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="color" id="top_header_color" name="top_header_color" class="form-control" placeholder="Top Header Color" value="<?php echo $schoolDetails['top_header_color']; ?>">
                  <label for="top_header_color">Top Header Color</label>
                </div>
              </div>
            </div>
          </div> 


          <?php 
          if(($_SESSION['lgina']=="IN")&&$_SESSION['post']=="webmaster")
          {
            ?>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="domain_sub_date" name="domain_sub_date" class="form-control" placeholder="Domain Sub Date" value="<?php echo $schoolDetails['domain_sub_date']; ?>">
                    <label for="domain_sub_date">Domain Sub Date</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="domain_due_date" name="domain_due_date" class="form-control" placeholder="Domain Due Date"  autofocus="autofocus" value="<?php echo $schoolDetails['domain_due_date']; ?>">
                    <label for="domain_due_date">Domain Due Date</label>
                  </div>
                </div>
              </div>
            </div> 

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="hosting_sub_date" name="hosting_sub_date" class="form-control" placeholder="Hosting Sub Date" value="<?php echo $schoolDetails['hosting_sub_date']; ?>">
                    <label for="hosting_sub_date">Hosting Sub Date</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="hosting_due_date" name="hosting_due_date" class="form-control" placeholder="Hosting Due Date"  autofocus="autofocus" value="<?php echo $schoolDetails['hosting_due_date']; ?>">
                    <label for="hosting_due_date">Hosting Due Date</label>
                  </div>
                </div>
              </div>
            </div> 

            <?php
          }
          else
          {
            ?>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="domain_sub_date" name="domain_sub_date" class="form-control" placeholder="Domain Sub Date" value="<?php echo $schoolDetails['domain_sub_date']; ?>" readonly="readonly">
                    <label for="domain_sub_date">Domain Sub Date</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="domain_due_date" name="domain_due_date" class="form-control" placeholder="Domain Due Date"  autofocus="autofocus" value="<?php echo $schoolDetails['domain_due_date']; ?>" readonly="readonly">
                    <label for="domain_due_date">Domain Due Date</label>
                  </div>
                </div>
              </div>
            </div> 

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="hosting_sub_date" name="hosting_sub_date" class="form-control" placeholder="Hosting Sub Date" value="<?php echo $schoolDetails['hosting_sub_date']; ?>" readonly="readonly">
                    <label for="hosting_sub_date">Hosting Sub Date</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="date" id="hosting_due_date" name="hosting_due_date" class="form-control" placeholder="Hosting Due Date"  autofocus="autofocus" value="<?php echo $schoolDetails['hosting_due_date']; ?>" readonly="readonly">
                    <label for="hosting_due_date">Hosting Due Date</label>
                  </div>
                </div>
              </div>
            </div> 

            <?php
          }
          ?>

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
          </div> <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <img src="../../images/school/result_sign.jpg" style="width: 300px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_result_sign" name="school_result_sign" class="form-control">
                  <label for="school_result_sign">School Result Sign</label>
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
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="school_exam_officer" name="school_exam_officer" class="form-control" placeholder="School exam officer"  value="<?php echo $schoolDetails['school_exam_officer']; ?>">
                  <label for="school_exam_officer">School Exam Officer</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="school_burser" name="school_burser" class="form-control" placeholder="School Burser"  value="<?php echo $schoolDetails['school_burser']; ?>">
                  <label for="school_burser">School Burser</label>
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
