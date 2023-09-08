<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$upload_numbers=$_GET['upload_numbers'];
if(isset($_POST['btn_upload'])){
  $msg="";
  

  for ($i=1; $i <=$upload_numbers ; $i++)
  {
    $nam="document".$i;
    $filename=$_FILES[$nam.'file']['name'];
    $ext=substr($filename, strpos($filename, '.'));
    $path = "../../images/documents/";
    if($_SESSION['user_type']=="student")
    {
      $userid=str_replace("/", "_", $_SESSION['userid']);
    }
    else
    {
      $userid=$_SESSION['userid'];
    }
    
    $imgname=$nam.$userid.time().$ext;
    $path = $path .$imgname;
    if(move_uploaded_file($_FILES[$nam.'file']['tmp_name'], $path)) 
    {      
      $file_name=$path;
      $msg=$msg." <br/>Document$i";
      $albumcategory=$nam.'category';
      if(School::AddDocument($_SESSION['userid'],$path,$_POST[$nam.'document_type'],$_POST[$nam.'document_institution_name'],$_POST[$nam.'document_date_started'],$_POST[$nam.'document_date_ended'],$_POST[$nam.'document_description']))
      {
        $msg=$msg." Uploaded Successfully";
      }
      else
      {
        $msg=$msg." was not Uploaded Successfully";
      }
    }
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

  <title>User Album Management</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <style type="text/css">
    .document_container{
      background: lightblue;
      
    }
    .document_container:hover{
      background: lightgreen;
      
    }
  </style>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
        <a href="./"   class="navi" ><i class="fa fa-home"></i> User Dashboard</a>
        <a href="documents.php?userid=<?php echo $_GET['userid']; ?>"   class="navi" ><i class="fa fa-home"></i> My Documents</a>
      </div>
      <div class="card-header">User Document Uploader</div>
      <div class="card-header" style="background: red; color:white">
        <center><?php echo $msg; ?></center></div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
          </div>
          <?php
          for ($i=1; $i <=$upload_numbers ; $i++)
          {
            $nam="document".$i;
            ?>
            <div class="form-group document_container" style="border-bottom: 4px groove black; padding: 5px 5px 5px 5px">
              <div style="padding: 4px 4px 4px 4px; background: lightgreen; text-align: center; border-top-right-radius: 5px; border-top-left-radius: 5px;"><?php echo "Document ".$i;?></div>
                <div class="form-row">
                  <input type="text" id="<?php echo $nam; ?>document_institution_name" name="<?php echo $nam; ?>document_institution_name" class="form-control" placeholder="Institution Name or Organization Name" />
                  <label for="<?php echo $nam; ?>document_institution_name">Document<?php echo $i;?> Institution Name</label>
                </div>
              <br/>
                <div class="form-row">
                  <textarea id="<?php echo $nam; ?>document_description" name="<?php echo $nam; ?>document_description" class="form-control" rows="3" placeholder="Document Description"></textarea>
                  <label for="<?php echo $nam; ?>document_description">Document<?php echo $i;?> Description</label>
                </div>
                <div  style="width: 400px; float: left">Maximum of 200kb
                  <div class="form-row">
                    <input type="file" id="<?php echo $nam;?>file" name="<?php echo $nam;?>file" class="form-control" >
                    <label for="<?php echo $nam;?>file">Document<?php echo $i;?> File</label>
                  </div>
                </div>
              <div>
                <div>Photo Category</div>
                <div class="form-row">
                  <select id="<?php echo $nam;?>document_type" name="<?php echo $nam;?>document_type" class="form-control">
                    <option></option>
                    <option>FSLC</option>
                    <option>O Level</option>
                    <option>NCE</option>
                    <option>ND</option>
                    <option>HND</option>
                    <option>Degree</option>
                    <option>Post Degree</option>
                    <option>Ph.D</option>
                    <option>Other</option>
                  </select>
                  <label for="<?php echo $nam;?>document_type">Document<?php echo $i;?> Type</label>
                </div>
              </div>
              <br/>
              <div  style="width: 50%; float: left">
                <div class="form-row">
                  <input type="date" id="<?php echo $nam;?>document_date_started" name="<?php echo $nam;?>document_date_started" class="form-control" >
                  <label for="<?php echo $nam;?>document_date_started">Document<?php echo $i;?> Date Admitted</label>
                </div>
              </div>
              <div>
                <div class="form-row">
                  <input type="date" id="<?php echo $nam;?>document_date_ended" name="<?php echo $nam;?>document_date_ended" class="form-control" >
                  <label for="<?php echo $nam;?>document_date_ended">Document<?php echo $i;?> Date Ended</label>
                </div>
              </div>
            </div>
            <?php 
          }
          ?>
          <div class="form-group">
            <div class="form-row"><button type="submit" class="btn btn-primary btn-block" name="btn_upload" id="btn_upload" >Upload Document(s)</button>
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
