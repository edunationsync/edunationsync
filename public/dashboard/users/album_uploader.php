<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

if(!(isset($userid)))
{
  $userid=$_SESSION['userid'];
}
else
{
  $userid=$_GET['userid'];
}


if(isset($_GET['deletebtn']))
{
  if(unlink("../../images/icons/".$_GET['delete_file_name']))
  {
    $msg=$_GET['delete_file_name']." was deleted Successfully";
    header("location:./icon_modifier.php");
  }
}

$upload_numbers=$_GET['upload_numbers'];
if(isset($_POST['btn_upload'])){
  $msg="";
  

  for ($i=1; $i <=$upload_numbers ; $i++)
  {
    $nam="upload".$i;
    $filename=$_FILES[$nam]['name'];
    $ext=substr($filename, strpos($filename, '.'));
    $path = "../../images/album/";
    if($_SESSION['user_type']=="student")
    {
      $userid=str_replace("/", "_", $userid);
    }
    else
    {
      $userid=$userid;
    }
    
    $imgname=$nam.$userid.time().$ext;
    $path = $path .$imgname;
    if(move_uploaded_file($_FILES[$nam]['tmp_name'], $path)) 
    {      
      $file_name=$path;
      $msg=$msg." <br/>Upload$i";
      $albumcategory=$nam.'category';
      if(School::AddAlbum($imgname,$userid,$_SESSION['user_type'],$_POST[$albumcategory],$_POST['album_caption'],date("Y-m-d")))
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

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
        <a href="./"   class="navi" ><i class="fa fa-home"></i> User Dashboard</a>
        <a href="album.php"   class="navi" ><i class="fa fa-home"></i> My Personal Album</a>
        <a href="albums.php"   class="navi" ><i class="fa fa-home"></i> All Albums</a>
      </div>
      <div class="card-header">User Album Uploader</div>
      <div class="card-header"><?php echo $msg; ?></div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
            <div class="form-row">
              <textarea id="album_caption" name="album_caption" class="form-control" rows="3"></textarea>
              <label for="album_caption">Album Caption</label>
            </div>
          </div>
          <?php
          for ($i=1; $i <=$upload_numbers ; $i++)
          {
            $nam="upload".$i;
            ?>
            <div class="form-group">
              <div  style="width: 400px; float: left">Maximum of 200kb
                <div class="form-row">
                  <input type="file" id="<?php echo $nam;?>" name="<?php echo $nam;?>" class="form-control" >
                  <label for="<?php echo $nam;?>">Upload<?php echo $i;?></label>
                </div>
              </div>
            <div>
              <div>Photo Category</div>
              <div class="form-row">
                <select id="<?php echo $nam;?>category" name="<?php echo $nam;?>category" class="form-control" >
                  <option>Others</option>
                  <option>Carnival</option>
                  <option>Culture</option>
                  <option>Graduation</option>
                  <option>Matriculation</option>
                  <option>Sendforth</option>
                  <option>Sport</option>
                  <option>Occasion</option>
                </select>
                <label for="<?php echo $nam;?>category">Upload<?php echo $i;?> Cetegory</label>
              </div>
            </div>
            </div>
            <?php 
          }
          ?>
          <div class="form-group">
            <div class="form-row"><button type="submit" class="btn btn-primary btn-block" name="btn_upload" id="btn_upload" >Upload Pictures</button>
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
