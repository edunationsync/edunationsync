<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

if(isset($_GET['deletebtn']))
{
  if(unlink("../../images/icons/".$_GET['delete_file_name']))
  {
    $msg=$_GET['delete_file_name']." was deleted Successfully";
    header("location:./icon_modifier.php");
  }
}

if(isset($_POST['btnModify'])){
    $msg="Graphics Modified Successfully";

    //facebook_icon
    $facebook_iconname = "facebook_icon.png";
    $facebook_iconpath = "../../images/icons/".$facebook_iconname;
    if(move_uploaded_file($_FILES['facebook_icon']['tmp_name'], $facebook_iconpath)) 
    {
      $msg=$msg."<br/> Facebook Icon Changed";
    }

    //grade_point_average_icon
    $grade_point_average_iconname = "grade_point_average_icon.png";
    $grade_point_average_iconpath = "../../images/icons/".$grade_point_average_iconname;
    if(move_uploaded_file($_FILES['grade_point_average_icon']['tmp_name'], $grade_point_average_iconpath)) 
    {
      $msg=$msg."<br/> Grade Point Average Icon Changed";
    }

    //google_plus_icon
    $google_plus_iconname = "google_plus_icon.png";
    $google_plus_iconpath = "../../images/icons/".$google_plus_iconname;
    if(move_uploaded_file($_FILES['google_plus_icon']['tmp_name'], $google_plus_iconpath)) 
    {
      $msg=$msg."<br/> Google+ Icon Changed";
    }

    //twitter_icon
    $twitter_iconname = "twitter_icon.png";
    $twitter_iconpath = "../../images/icons/".$twitter_iconname;
    if(move_uploaded_file($_FILES['twitter_icon']['tmp_name'], $twitter_iconpath)) 
    {
      $msg=$msg."<br/> Twitter Icon Changed";
    }

    //linkedln_icon
    $linkedln_iconname = "linkedln_icon.png";
    $linkedln_iconpath = "../../images/icons/".$linkedln_iconname;
    if(move_uploaded_file($_FILES['linkedln_icon']['tmp_name'], $linkedln_iconpath)) 
    {
      $msg=$msg."<br/> Linkedln Icon Changed";
    }

    //instagram_icon
    $instagram_iconname = "instagram_icon.png";
    $instagram_iconpath = "../../images/icons/".$instagram_iconname;
    if(move_uploaded_file($_FILES['instagram_icon']['tmp_name'], $instagram_iconpath)) 
    {
      $msg=$msg."<br/> Instagram Icon Changed";
    }

    //dashboard_icon
    $dashboard_iconname = "dashboard_icon.png";
    $dashboard_iconpath = "../../images/icons/".$dashboard_iconname;
    if(move_uploaded_file($_FILES['dashboard_icon']['tmp_name'], $dashboard_iconpath)) 
    {
      $msg=$msg."<br/> Dashboard Icon Changed";
    }

    //student_manager_icon
    $student_manager_iconname = "student_manager_icon.png";
    $student_manager_iconpath = "../../images/icons/".$student_manager_iconname;
    if(move_uploaded_file($_FILES['student_manager_icon']['tmp_name'], $student_manager_iconpath)) 
    {
      $msg=$msg."<br/> Student Manager Icon Changed";
    }

    //my_student_manager_icon
    $my_student_manager_iconname = "my_student_manager_icon.png";
    $my_student_manager_iconpath = "../../images/icons/".$my_student_manager_iconname;
    if(move_uploaded_file($_FILES['my_student_manager_icon']['tmp_name'], $my_student_manager_iconpath)) 
    {
      $msg=$msg."<br/> My Student Manager Icon Changed";
    }

    //Biodata Icon
    $biodata_iconname = "biodata_icon.png";
    $biodata_iconpath = "../../images/icons/".$biodata_iconname;
    if(move_uploaded_file($_FILES['biodata_icon']['tmp_name'], $biodata_iconpath)) 
    {
      $msg=$msg."<br/> Biodata Icon Changed";
    }

    //staff_manager_icon
    $staff_manager_iconname = "staff_manager_icon.png";
    $staff_manager_iconpath = "../../images/icons/".$staff_manager_iconname;
    if(move_uploaded_file($_FILES['staff_manager_icon']['tmp_name'], $staff_manager_iconpath)) 
    {
      $msg=$msg."<br/> staff_manager Icon Changed";
    }

    //subject_manager_icon
    $subject_manager_iconname = "subject_manager_icon.png";
    $subject_manager_iconpath = "../../images/icons/".$subject_manager_iconname;
    if(move_uploaded_file($_FILES['subject_manager_icon']['tmp_name'], $subject_manager_iconpath)) 
    {
      $msg=$msg."<br/> Subject Manager Icon Changed";
    }

    //subject_registration_icon
    $subject_registration_iconname = "subject_registration_icon.png";
    $subject_registration_iconpath = "../../images/icons/".$subject_registration_iconname;
    if(move_uploaded_file($_FILES['subject_registration_icon']['tmp_name'], $subject_registration_iconpath)) 
    {
      $msg=$msg."<br/> Subject Registration Icon Changed";
    }

    //subjectallocationn_icon
    $subject_allocation_iconname = "subject_allocation_icon.png";
    $subject_allocation_iconpath = "../../images/icons/".$subject_allocation_iconname;
    if(move_uploaded_file($_FILES['subject_allocation_icon']['tmp_name'], $subject_allocation_iconpath)) 
    {
      $msg=$msg."<br/> Subject Allocation Icon Changed";
    }

    //class_management_icon
    $class_management_iconname = "class_management_icon.png";
    $class_management_iconpath = "../../images/icons/".$class_management_iconname;
    if(move_uploaded_file($_FILES['class_management_icon']['tmp_name'], $class_management_iconpath)) 
    {
      $msg=$msg."<br/> Class Management Icon Changed";
    }

    //class_allocation_icon
    $class_allocation_iconname = "class_allocation_icon.png";
    $class_allocation_iconpath = "../../images/icons/".$class_allocation_iconname;
    if(move_uploaded_file($_FILES['class_allocation_icon']['tmp_name'], $class_allocation_iconpath)) 
    {
      $msg=$msg."<br/> Class Allocation Icon Changed";
    }

    //result_setting_icon
    $result_setting_iconname = "result_setting_icon.png";
    $result_setting_iconpath = "../../images/icons/".$result_setting_iconname;
    if(move_uploaded_file($_FILES['result_setting_icon']['tmp_name'], $result_setting_iconpath)) 
    {
      $msg=$msg."<br/> Result Setting Icon Changed";
    }

    //result_icon
    $result_iconname = "result_icon.png";
    $result_iconpath = "../../images/icons/".$result_iconname;
    if(move_uploaded_file($_FILES['result_icon']['tmp_name'], $result_iconpath)) 
    {
      $msg=$msg."<br/> Result Icon Changed";
    }

    //finance_icon
    $finance_iconname = "finance_icon.png";
    $finance_iconpath = "../../images/icons/".$finance_iconname;
    if(move_uploaded_file($_FILES['finance_icon']['tmp_name'], $finance_iconpath)) 
    {
      $msg=$msg."<br/> Finance Icon Changed";
    }

    //innovation_icon
    $innovation_iconname = "innovation_icon.png";
    $innovation_iconpath = "../../images/icons/".$innovation_iconname;
    if(move_uploaded_file($_FILES['innovation_icon']['tmp_name'], $innovation_iconpath)) 
    {
      $msg=$msg."<br/> Innovation Icon Changed";
    }

    //album_icon
    $album_iconname = "album_icon.png";
    $album_iconpath = "../../images/icons/".$album_iconname;
    if(move_uploaded_file($_FILES['album_icon']['tmp_name'], $album_iconpath)) 
    {
      $msg=$msg."<br/> Album Icon Changed";
    }

    //scholarship_icon
    $scholarship_iconname = "scholarship_icon.png";
    $scholarship_iconpath = "../../images/icons/".$scholarship_iconname;
    if(move_uploaded_file($_FILES['scholarship_icon']['tmp_name'], $scholarship_iconpath)) 
    {
      $msg=$msg."<br/> Scholarship Icon Changed";
    }

    //pay_icon
    $pay_iconname = "pay_icon.png";
    $pay_iconpath = "../../images/icons/".$pay_iconname;
    if(move_uploaded_file($_FILES['pay_icon']['tmp_name'], $pay_iconpath)) 
    {
      $msg=$msg."<br/> Pay Icon Changed";
    }

    //google_plus_icon
    $google_plus_iconname = "google_plus_icon.png";
    $google_plus_iconpath = "../../images/icons/".$google_plus_iconname;
    if(move_uploaded_file($_FILES['google_plus_icon']['tmp_name'], $google_plus_iconpath)) 
    {
      $msg=$msg."<br/> Google+ Icon Changed";
    }

    //fee_explorer_icon
    $fee_explorer_iconname = "fee_explorer_icon.png";
    $fee_explorer_iconpath = "../../images/icons/".$fee_explorer_iconname;
    if(move_uploaded_file($_FILES['fee_explorer_icon']['tmp_name'], $fee_explorer_iconpath)) 
    {
      $msg=$msg."<br/> Fee Explorer Icon Changed";
    }

    //fee_amount_icon
    $fee_amount_iconname = "fee_amount_icon.png";
    $fee_amount_iconpath = "../../images/icons/".$fee_amount_iconname;
    if(move_uploaded_file($_FILES['fee_amount_icon']['tmp_name'], $fee_amount_iconpath)) 
    {
      $msg=$msg."<br/> Fee Amount Icon Changed";
    }

    //voucher_explorer_icon
    $voucher_explorer_iconname = "voucher_explorer_icon.png";
    $voucher_explorer_iconpath = "../../images/icons/".$voucher_explorer_iconname;
    if(move_uploaded_file($_FILES['voucher_explorer_icon']['tmp_name'], $voucher_explorer_iconpath)) 
    {
      $msg=$msg."<br/> Voucher Explorer Icon Changed";
    }

    //google_plus_icon
    $my_fee_reciept_iconname = "my_fee_reciept_icon.png";
    $my_fee_reciept_iconpath = "../../images/icons/".$my_fee_reciept_iconname;
    if(move_uploaded_file($_FILES['my_fee_reciept_icon']['tmp_name'], $my_fee_reciept_iconpath)) 
    {
      $msg=$msg."<br/> My Fee Reciept Icon Changed";
    }

    //my_voucher_icon
    $my_voucher_iconname = "my_voucher_icon.png";
    $my_voucher_iconpath = "../../images/icons/".$my_voucher_iconname;
    if(move_uploaded_file($_FILES['my_voucher_icon']['tmp_name'], $my_voucher_iconpath)) 
    {
      $msg=$msg."<br/> My Voucher Icon Changed";
    }

    //content_modifier_icon
    $content_modifier_iconname = "content_modifier_icon.png";
    $content_modifier_iconpath = "../../images/icons/".$content_modifier_iconname;
    if(move_uploaded_file($_FILES['content_modifier_icon']['tmp_name'], $content_modifier_iconpath)) 
    {
      $msg=$msg."<br/> Content Modifier Icon Changed";
    }

    //school_profile_icon
    $school_profile_iconname = "school_profile_icon.png";
    $school_profile_iconpath = "../../images/icons/".$school_profile_iconname;
    if(move_uploaded_file($_FILES['school_profile_icon']['tmp_name'], $school_profile_iconpath)) 
    {
      $msg=$msg."<br/> School Profile Icon Changed";
    }

    //graphic_modifier_icon
    $graphic_modifier_iconname = "graphic_modifier_icon.png";
    $graphic_modifier_iconpath = "../../images/icons/".$graphic_modifier_iconname;
    if(move_uploaded_file($_FILES['graphic_modifier_icon']['tmp_name'], $graphic_modifier_iconpath)) 
    {
      $msg=$msg."<br/> Graphic Modifier Icon Changed";
    }

    //slide_modifier_icon
    $slide_modifier_iconname = "slide_modifier_icon.png";
    $slide_modifier_iconpath = "../../images/icons/".$slide_modifier_iconname;
    if(move_uploaded_file($_FILES['slide_modifier_icon']['tmp_name'], $slide_modifier_iconpath)) 
    {
      $msg=$msg."<br/> Slide Modifier Icon Changed";
    }

    //theme_modifier_icon
    $theme_modifier_iconname = "theme_modifier_icon.png";
    $theme_modifier_iconpath = "../../images/icons/".$theme_modifier_iconname;
    if(move_uploaded_file($_FILES['theme_modifier_icon']['tmp_name'], $theme_modifier_iconpath)) 
    {
      $msg=$msg."<br/> Theme Modifier Icon Changed";
    }

    //seo_keyword_icon
    $seo_keyword_iconname = "seo_keyword_icon.png";
    $seo_keyword_iconpath = "../../images/icons/".$seo_keyword_iconname;
    if(move_uploaded_file($_FILES['seo_keyword_icon']['tmp_name'], $seo_keyword_iconpath)) 
    {
      $msg=$msg."<br/> SEO Keyword Icon Changed";
    }

    //mail_messaging_icon
    $mail_messaging_iconname = "mail_messaging_icon.png";
    $mail_messaging_iconpath = "../../images/icons/".$mail_messaging_iconname;
    if(move_uploaded_file($_FILES['mail_messaging_icon']['tmp_name'], $mail_messaging_iconpath)) 
    {
      $msg=$msg."<br/> Mail Messaging Icon Changed";
    }

    //napps_icon
    $napps_iconname = "napps_icon.png";
    $napps_iconpath = "../../images/icons/".$napps_iconname;
    if(move_uploaded_file($_FILES['napps_icon']['tmp_name'], $napps_iconpath)) 
    {
      $msg=$msg."<br/> NAPPS Icon Changed";
    }

    //ca_sheet_explorer_icon
    $ca_sheet_explorer_iconname = "ca_sheet_explorer_icon.png";
    $ca_sheet_explorer_iconpath = "../../images/icons/".$ca_sheet_explorer_iconname;
    if(move_uploaded_file($_FILES['ca_sheet_explorer_icon']['tmp_name'], $ca_sheet_explorer_iconpath)) 
    {
      $msg=$msg."<br/> CA Sheet Explorer Icon Changed";
    }

    //master_sheet_explorer_icon
    $master_sheet_explorer_iconname = "master_sheet_explorer_icon.png";
    $master_sheet_explorer_iconpath = "../../images/icons/".$master_sheet_explorer_iconname;
    if(move_uploaded_file($_FILES['master_sheet_explorer_icon']['tmp_name'], $ca_sheet_explorer_iconpath)) 
    {
      $msg=$msg."<br/> Master Sheet Explorer Icon Changed";
    }

    //admin_result_checker_icon
    $admin_result_checker_iconname = "admin_result_checker_icon.png";
    $admin_result_checker_iconpath = "../../images/icons/".$admin_result_checker_iconname;
    if(move_uploaded_file($_FILES['admin_result_checker_icon']['tmp_name'], $admin_result_checker_iconpath)) 
    {
      $msg=$msg."<br/> Admin Result Checker Icon Changed";
    }

    //admin_icon
    $admin_iconname = "admin_icon.png";
    $admin_iconpath = "../../images/icons/".$admin_iconname;
    if(move_uploaded_file($_FILES['admin_icon']['tmp_name'], $admin_iconpath)) 
    {
      $msg=$msg."<br/> Admin Icon Changed";
    }

    //printable_student_icon
    $printable_student_iconname = "printable_student_result.png";
    $printable_student_iconpath = "../../images/icons/".$ca_sheet_explorer_iconname;
    if(move_uploaded_file($_FILES['printable_student_icon']['tmp_name'], $printable_student_iconpath)) 
    {
      $msg=$msg."<br/> Printable Student Icon Changed";
    }

    //psychomotor_rating_icon
    $psychomotor_rating_iconname = "psychomotor_rating_icon.png";
    $psychomotor_rating_iconpath = "../../images/icons/".$psychomotor_rating_iconname;
    if(move_uploaded_file($_FILES['psychomotor_rating_icon']['tmp_name'], $psychomotor_rating_iconpath)) 
    {
      $msg=$msg."<br/> Psychomotor Rating Icon Changed";
    }

    //opened_file_icon
    $opened_file_iconname = "opened_file_icon.png";
    $opened_file_iconpath = "../../images/icons/".$opened_file_iconname;
    if(move_uploaded_file($_FILES['opened_file_icon']['tmp_name'], $opened_file_iconpath)) 
    {
      $msg=$msg."<br/> Opened File Icon Changed";
    }

    //closed_file_icon
    $closed_file_iconname = "closed_file_icon.png";
    $closed_file_iconpath = "../../images/icons/".$closed_file_iconname;
    if(move_uploaded_file($_FILES['closed_file_icon']['tmp_name'], $closed_file_iconpath)) 
    {
      $msg=$msg."<br/> Closed File Icon Changed";
    }

    //delete_icon
    $delete_iconname = "delete_icon.png";
    $delete_iconpath = "../../images/icons/".$delete_iconname;
    if(move_uploaded_file($_FILES['delete_icon']['tmp_name'], $delete_iconpath)) 
    {
      $msg=$msg."<br/> Delete Icon Changed";
    }

    //edit_icon
    $edit_iconname = "edit_icon.png";
    $edit_iconpath = "../../images/icons/".$edit_iconname;
    if(move_uploaded_file($_FILES['edit_icon']['tmp_name'], $edit_iconpath)) 
    {
      $msg=$msg."<br/> Edit Icon Changed";
    }

    //new_file_icon
    $new_file_iconname = "new_file_icon.png";
    $new_file_iconpath = "../../images/icons/".$new_file_iconname;
    if(move_uploaded_file($_FILES['new_file_icon']['tmp_name'], $new_file_iconpath)) 
    {
      $msg=$msg."<br/> New File Icon Changed";
    }

    //dashboard_icon
    $dashboard_iconname = "dashboard.png";
    $dashboard_iconpath = "../../images/icons/".$dashboard_iconname;
    if(move_uploaded_file($_FILES['dashboard']['tmp_name'], $dashboard_iconpath)) 
    {
      $msg=$msg."<br/> Dashboard Icon Changed";
    }

    //student_icon
    $student_iconname = "student.jpg";
    $student_iconpath = "../../images/icons/".$student_iconname;
    if(move_uploaded_file($_FILES['student']['tmp_name'], $student_iconpath)) 
    {
      $msg=$msg."<br/> Student Icon Changed";
    }

    //staff_icon
    $staff_iconname = "staff.png";
    $staff_iconpath = "../../images/icons/".$staff_iconname;
    if(move_uploaded_file($_FILES['staff']['tmp_name'], $staff_iconpath)) 
    {
      $msg=$msg."<br/> staff Icon Changed";
    }

    //==========================================



    //innovation_icon
    $innovation_iconname = "innovation.png";
    $innovation_iconpath = "../../images/icons/".$innovation_iconname;
    if(move_uploaded_file($_FILES['innovation']['tmp_name'], $innovation_iconpath)) 
    {
      $msg=$msg."<br/> innovation Icon Changed";
    }

    //album_icon
    $album_iconname = "album.png";
    $album_iconpath = "../../images/icons/".$album_iconname;
    if(move_uploaded_file($_FILES['album']['tmp_name'], $album_iconpath)) 
    {
      $msg=$msg."<br/> album Icon Changed";
    }

    //subject_icon
    $subject_iconname = "subject.png";
    $subject_iconpath = "../../images/icons/".$subject_iconname;
    if(move_uploaded_file($_FILES['subject']['tmp_name'], $subject_iconpath)) 
    {
      $msg=$msg."<br/> subject Icon Changed";
    }

    //finance_icon
    $finance_iconname = "finance.png";
    $finance_iconpath = "../../images/icons/".$finance_iconname;
    if(move_uploaded_file($_FILES['finance']['tmp_name'], $finance_iconpath)) 
    {
      $msg=$msg."<br/> finance Icon Changed";
    }

    //gpa_icon
    $gpa_iconname = "gpa.png";
    $gpa_iconpath = "../../images/icons/".$gpa_iconname;
    if(move_uploaded_file($_FILES['gpa']['tmp_name'], $gpa_iconpath)) 
    {
      $msg=$msg."<br/> gpa Icon Changed";
    }

    //class_icon
    $class_iconname = "class.png";
    $class_iconpath = "../../images/icons/".$class_iconname;
    if(move_uploaded_file($_FILES['class']['tmp_name'], $class_iconpath)) 
    {
      $msg=$msg."<br/> class Icon Changed";
    }

    //class_alloc_icon
    $class_alloc_iconname = "class_alloc.png";
    $class_alloc_iconpath = "../../images/icons/".$class_alloc_iconname;
    if(move_uploaded_file($_FILES['class_alloc']['tmp_name'], $class_alloc_iconpath)) 
    {
      $msg=$msg."<br/> class_alloc Icon Changed";
    }

    //gpa_icon
    $gpa_iconname = "gpa.png";
    $gpa_iconpath = "../../images/icons/".$gpa_iconname;
    if(move_uploaded_file($_FILES['gpa']['tmp_name'], $gpa_iconpath)) 
    {
      $msg=$msg."<br/> gpa Icon Changed";
    }

    //official_letter_icon
    $official_letter_iconname = "official_letter_icon.png";
    $official_letter_iconpath = "../../images/icons/".$official_letter_iconname;
    if(move_uploaded_file($_FILES['official_letter_icon']['tmp_name'], $official_letter_iconpath)) 
    {
      $msg=$msg."<br/> official_letter Icon Changed";
    }

    //napps_icon
    $napps_iconname = "napps.png";
    $napps_iconpath = "../../images/icons/".$napps_iconname;
    if(move_uploaded_file($_FILES['napps']['tmp_name'], $napps_iconpath)) 
    {
      $msg=$msg."<br/> napps Icon Changed";
    }

    //control_panel_icon
    $control_panel_iconname = "control_panel_icon.png";
    $control_panel_iconpath = "../../images/icons/".$control_panel_iconname;
    if(move_uploaded_file($_FILES['control_panel_icon']['tmp_name'], $control_panel_iconpath)) 
    {
      $msg=$msg."<br/> control_panel Icon Changed";
    }

    //document_icon
    $document_iconname = "document_icon.png";
    $document_iconpath = "../../images/icons/".$document_iconname;
    if(move_uploaded_file($_FILES['document_icon']['tmp_name'], $document_iconpath)) 
    {
      $msg=$msg."<br/> Document Icon Changed";
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

  <title>Icon Modifier</title>

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
      </div>
      <div class="card-header">Software Graphics Modifier</div>
      <div class="card-header"><?php echo $msg; ?></div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="icon_modifier.php">    

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=facebook_icon.png">X</a>
                <img src="../../images/icons/facebook_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="facebook_icon" name="facebook_icon" class="form-control">
                  <label for="facebook_icon">Facebook Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=google_plus_icon.png">X</a>
                <img src="../../images/icons/google_plus_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="google_plus_icon" name="google_plus_icon" class="form-control">
                  <label for="google_plus_icon">Google+ Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=twitter_icon.png">X</a>
                <img src="../../images/icons/twitter_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="twitter_icon" name="twitter_icon" class="form-control">
                  <label for="twitter_icon">Twitter Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=linkedln_icon.png">X</a>
                <img src="../../images/icons/linkedln_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="linkedln_icon" name="linkedln_icon" class="form-control">
                  <label for="linkedln_icon">LinkedLn Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=instagram_icon.png">X</a>
                <img src="../../images/icons/instagram_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="instagram_icon" name="instagram_icon" class="form-control">
                  <label for="instagram_icon">Instagram Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=dashboard_icon.png">X</a>
                <img src="../../images/icons/dashboard_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="dashboard_icon" name="dashboard_icon" class="form-control">
                  <label for="dashboard_icon">Dashboard Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=student_manager_icon.png">X</a>
                <img src="../../images/icons/student_manager_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="student_manager_icon" name="student_manager_icon" class="form-control">
                  <label for="student_icon">Student Manager Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=my_student_manager_icon.png">X</a>
                <img src="../../images/icons/my_student_manager_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="my_student_manager_icon" name="my_student_manager_icon" class="form-control">
                  <label for="student_icon">My Student Manager Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=biodata_icon.png">X</a>
                <img src="../../images/icons/biodata_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="biodata_icon" name="biodata_icon" class="form-control">
                  <label for="biodata_icon">Biodata Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=staff_manager_icon.png">X</a>
                <img src="../../images/icons/staff_manager_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="staff_manager_icon" name="staff_manager_icon" class="form-control">
                  <label for="staff_manager_icon">Staff Manager Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=subject_manager_icon.png">X</a>
                <img src="../../images/icons/subject_manager_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="subject_manager_icon" name="subject_manager_icon" class="form-control">
                  <label for="subject_manager_icon">Subject Manager Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=subject_registration_icon.png">X</a>
                <img src="../../images/icons/subject_registration_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="subject_registration_icon" name="subject_registration_icon" class="form-control">
                  <label for="subject_registration_icon">Subject Registration Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=subject_allocation_icon.png">X</a>
                <img src="../../images/icons/subject_allocation_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="subject_allocation_icon" name="subject_allocation_icon" class="form-control">
                  <label for="subject_allocation_icon">Subject Allocation Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=class_management_icon.png">X</a>
                <img src="../../images/icons/class_management_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="class_management_icon" name="class_management_icon" class="form-control">
                  <label for="class_management_icon">Class Management Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=class_allocation_icon">X</a>
                <img src="../../images/icons/class_allocation_icon"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="class_allocation_icon" name="class_allocation_icon" class="form-control">
                  <label for="class_allocation_icon">Class Allocation Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=result_setting_icon.png">X</a>
                <img src="../../images/icons/result_setting_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="result_setting_icon" name="result_setting_icon" class="form-control">
                  <label for="result_setting_icon">Result Setting Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=result_icon.png">X</a>
                <img src="../../images/icons/result_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="result_icon" name="result_icon" class="form-control">
                  <label for="result_icon">Result Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=grade_point_average_icon.png">X</a>
                <img src="../../images/icons/grade_point_average_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="grade_point_average_icon" name="grade_point_average_icon" class="form-control">
                  <label for="grade_point_average_icon">Grade Point Average Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=finance_icon.png">X</a>
                <img src="../../images/icons/finance_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="finance_icon" name="finance_icon" class="form-control">
                  <label for="finance_icon">Finance Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=innovation_icon.png">X</a>
                <img src="../../images/icons/innovation_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="innovation_icon" name="innovation_icon" class="form-control">
                  <label for="innovation_icon">Innovation Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=album_icon.png">X</a>
                <img src="../../images/icons/album_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="album_icon" name="album_icon" class="form-control">
                  <label for="album_icon">Album Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=scholarship_icon.png">X</a>
                <img src="../../images/icons/scholarship_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="scholarship_icon" name="scholarship_icon" class="form-control">
                  <label for="scholarship_icon">Scholarship and Award icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=pay_icon.png">X</a>
                <img src="../../images/icons/pay_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="pay_icon" name="pay_icon" class="form-control">
                  <label for="pay_icon">Pay Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=fee_explorer_icon.png">X</a>
                <img src="../../images/icons/fee_explorer_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="fee_explorer_icon" name="fee_explorer_icon" class="form-control">
                  <label for="fee_explorer_icon">Fee Explorer</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=fee_amount_icon.png">X</a>
                <img src="../../images/icons/fee_amount_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="fee_amount_icon" name="fee_amount_icon" class="form-control">
                  <label for="fee_amount_icon">Fee Amount Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=voucher_explorer_icon.png">X</a>
                <img src="../../images/icons/voucher_explorer_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="voucher_explorer_icon" name="voucher_explorer_icon" class="form-control">
                  <label for="voucher_explorer_icon">Voucher Explorer Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=my_fee_reciept_icon.png">X</a>
                <img src="../../images/icons/my_fee_reciept_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="my_fee_reciept_icon" name="my_fee_reciept_icon" class="form-control">
                  <label for="my_fee_reciept_icon">My Fees & Reciept Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=my_voucher_icon.png">X</a>
                <img src="../../images/icons/my_voucher_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="my_voucher_icon" name="my_voucher_icon" class="form-control">
                  <label for="my_voucher_icon">My Voucher Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=content_modifier_icon.png">X</a>
                <img src="../../images/icons/content_modifier_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="content_modifier_icon" name="content_modifier_icon" class="form-control"><a href="?deletebtn=yes&delete_file_name=content_modifier_icon.png">X</a>
                  <label for="content_modifier_icon">Content Modifier Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=school_profile_icon.png">X</a>
                <img src="../../images/icons/school_profile_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="school_profile_icon" name="school_profile_icon" class="form-control">
                  <label for="school_profile_icon">School Profile Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=graphic_modifier_icon.png">X</a>
                <img src="../../images/icons/graphic_modifier_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="graphic_modifier_icon" name="graphic_modifier_icon" class="form-control">
                  <label for="graphic_modifier_icon">Graphic Modifier Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=slide_modifier_icon.png">X</a>
                <img src="../../images/icons/slide_modifier_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="slide_modifier_icon" name="slide_modifier_icon" class="form-control">
                  <label for="slide_modifier_icon">Slide Modifier Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=theme_modifier_icon.png">X</a>
                <img src="../../images/icons/theme_modifier_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="theme_modifier_icon" name="theme_modifier_icon" class="form-control">
                  <label for="theme_modifier_icon">Theme Modifier Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=seo_keyword_icon.png">X</a>
                <img src="../../images/icons/seo_keyword_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="seo_keyword_icon" name="seo_keyword_icon" class="form-control">
                  <label for="seo_keyword_icon">SEO Keywords Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=mail_messaging_icon.png">X</a>
                <img src="../../images/icons/mail_messaging_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="mail_messaging_icon" name="mail_messaging_icon" class="form-control">
                  <label for="mail_messaging_icon">Mail & Messaging Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=napps_icon.png">X</a>
                <img src="../../images/icons/napps_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="napps_icon" name="napps_icon" class="form-control">
                  <label for="napps_icon">NAPPS Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=ca_sheet_explorer_icon.png">X</a>
                <img src="../../images/icons/ca_sheet_explorer_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="ca_sheet_explorer_icon" name="ca_sheet_explorer_icon" class="form-control">
                  <label for="ca_sheet_explorer_icon">CA Sheet Explorer Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=master_sheet_explorer_icon.png">X</a>
                <img src="../../images/icons/master_sheet_explorer_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="master_sheet_explorer_icon" name="master_sheet_explorer_icon" class="form-control">
                  <label for="master_sheet_explorer_icon">Master Sheet Explorer Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=admin_result_checker_icon.png">X</a>
                <img src="../../images/icons/admin_result_checker_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="admin_result_checker_icon" name="admin_result_checker_icon" class="form-control">
                  <label for="admin_result_checker_icon">Admin Result Checker Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=admin_icon.png">X</a>
                <img src="../../images/icons/admin_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="admin_icon" name="admin_icon" class="form-control">
                  <label for="admin_icon">Admin Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=printable_student_result.png">X</a>
                <img src="../../images/icons/printable_student_result.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="printable_student_result" name="printable_student_result" class="form-control">
                  <label for="printable_student_result">Printable Student Result Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=psychomotor_rating_icon.png">X</a>
                <img src="../../images/icons/psychomotor_rating_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="psychomotor_rating_icon" name="psychomotor_rating_icon" class="form-control">
                  <label for="psychomotor_rating_icon">Psychomotor Rating Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=opened_file_icon.png">X</a>
                <img src="../../images/icons/opened_file_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="opened_file_icon" name="opened_file_icon" class="form-control">
                  <label for="opened_file_icon">Opened File Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=closed_file_icon.png">X</a>
                <img src="../../images/icons/closed_file_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="closed_file_icon" name="closed_file_icon" class="form-control">
                  <label for="closed_file_icon">Closed File Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=delete_icon.png">X</a>
                <img src="../../images/icons/delete_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="delete_icon" name="delete_icon" class="form-control">
                  <label for="delete_icon">Delete Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=edit_icon.png">X</a>
                <img src="../../images/icons/edit_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="edit_icon" name="edit_icon" class="form-control">
                  <label for="edit_icon">Edit Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=new_file_icon.png">X</a>
                <img src="../../images/icons/new_file_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="new_file_icon" name="new_file_icon" class="form-control">
                  <label for="new_file_icon">New File Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=control_panel_icon.png">X</a>
                <img src="../../images/icons/control_panel_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="control_panel_icon" name="control_panel_icon" class="form-control">
                  <label for="control_panel_icon">Control Panel Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=document_icon.png">X</a>
                <img src="../../images/icons/document_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="document_icon" name="document_icon" class="form-control">
                  <label for="document_icon">Document Icon</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right"><a href="?deletebtn=yes&delete_file_name=official_letter_icon.png">X</a>
                <img src="../../images/icons/official_letter_icon.png"  style="width: 100px">
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="official_letter_icon" name="official_letter_icon" class="form-control">
                  <label for="official_letter_icon">Official Letter Icon</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="btnModify" id="btnModify" >Update Graphics</button>
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
