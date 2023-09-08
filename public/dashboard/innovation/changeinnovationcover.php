<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_WARNING);


$innovation_id=$_GET['id'];
$innovation_author_id=$_GET['innovation_author_id'];
$innovation_title=$_GET['innovation_title'];
$innovation_date=$_GET['innovation_date'];

if(Innovation::IsExist($innovation_id,$innovation_author_id,$innovation_title,$innovation_date))
{
  $innovationdetails=Innovation::ReadDetails($innovation_id);
}
  

if(isset($_POST['btnUpdateInnovation']))
{
  $innovation_id=$_POST['innovation_id'];
  $innovation_author_id=$_POST['innovation_author_id'];
  $innovation_title=$_POST['innovation_title'];
  $innovation_date=$_POST['innovation_date'];
  
  if(Innovation::IsExist($innovation_id))
  {
    //Innovation Cover Updater Module 
    if(is_uploaded_file($_FILES['innovation_cover_photo']['tmp_name'])){

      $innovation_cover_photo=base64_encode(file_get_contents($_FILES['innovation_cover_photo']['tmp_name']));
      if(Innovation::ChangeInnovationCoverPhoto($innovation_id,$innovation_cover_photo))
      {
        //Folder Upload Files Begins
        $filename=$_FILES['innovation_cover_photo']['name'];
        $ext=substr($filename, strpos($filename, '.'));
        $path = "../../files/cover_photos/";
        $path = $path .$innovationdetails['innovation_author_id']." ".$innovation_id." ".$innovationdetails['innovation_title'].$ext;
        if(move_uploaded_file($_FILES['innovation_cover_photo']['tmp_name'], $path)) 
        {      
          $file_name=$path;
        } 
        else
        {
          $msg="Document Upload was not successful, Try again";
        }
        //Folder Upload Files Ends

        $msg=$msg."<br/>Innovation Cover Photo Was Changed Successfully";
      }
      else{
        $msg=$msg."<br/>Innovation Cover Photo Upload Failed";
      }
    }
    else
    {
      $msg=$msg."<br/>Innovation Cover Photo was not uploaded";
    }
  }
  else
  {
    $msg="Innovation Records not found for the selected innovation, try again later";
  }
}


if(Innovation::IsExist($innovation_id,$innovation_author_id,$innovation_title,$innovation_date))
{
  $innovationdetails=Innovation::ReadDetails($innovation_id);
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

  <title>Update Innovation Cover Photo</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
        <center><a href="../"   class="navi" ><i class="fa fa-home"></i> Dashboard</a> 
        <?php 
          if(strtolower($_SESSION['post'])==strtolower("Headmaster")||strtolower($_SESSION['post'])==strtolower("Headmistress")||strtolower($_SESSION['post'])==strtolower("Assistant Headmaster")||strtolower($_SESSION['post'])==strtolower("Assistant Headmistress")||strtolower($_SESSION['post'])==strtolower("Webmaster")||strtolower($_SESSION['post'])==strtolower("Exams & Records"))
          {
            ?>
            <a href="allinnovations.php" class="navi"><i class="fa fa-table"> All Ideas</i></a>
            <?php 
          }
          ?>
          <a href="index.php" class="navi"><i class="fa fa-table"> My Ideas</i></a>  <br/><br/>       
          <a href="editinnovation.php?id=<?php echo $innovation_id; ?>" class="navi" ><i class="fa fa-home"></i> Edit Details</a>        
          <a href="changeinnovationfile.php?id=<?php echo $innovation_id; ?>" class="navi" ><i class="fa fa-home"></i> Change File</a> 
          <a href="changeinnovationvideo.php?id=<?php echo $innovation_id; ?>" class="navi" ><i class="fa fa-home"></i> Change Video</a> </center>
      </div>


      <div class="card-header">Innovation Cover Photo Updater </div>
      <div class="card-header" style="background: red; color:white">
        <center><?php echo $msg; ?></center></div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
          <div class="form-group">
            <div class="form-label-group">
            </div>
          </div> 

            <div class="form-row"> 
              <div class="col-md-6">
                <div class="form-label-group">
                  <img src="<?php echo 'data:image/jpeg;base64,'.$innovationdetails['innovation_cover_photo'];?>" style="width: 400px; border-radius: 20%;">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="hidden" id="innovation_id" name="innovation_id" value="<?php echo $innovation_id; ?>">
                  <input type="hidden" id="innovation_author_id" name="innovation_author_id" value="<?php echo $innovation_author_id; ?>">
                  <input type="hidden" id="innovation_title" name="innovation_title" value="<?php echo $innovation_title; ?>">
                  <input type="hidden" id="innovation_date" name="innovation_date" value="<?php echo $innovation_date; ?>">

                  <input type="file" id="innovation_cover_photo" name="innovation_cover_photo" class="form-control" required="required">
                  <label for="innovation_cover_photo"><span style="color: red">(*)</span> Innovation Cover Photo</label>
                  <button type="submit" class="btn btn-primary btn-block" name="btnUpdateInnovation" id="btnUpdateInnovation" >Update Innovation Cover Photo</button>
                  <table style="background: white; padding: 10px 10px 10px 10px; border-bottom-left-radius: 20px; border: 2px solid blue; ">
                    <tr><th style="background: white; padding: 10px 10px 10px 10px;">ID</th><td><?php echo $innovationdetails['id']; ?></td></tr>
                    <tr><th style="background: white; padding: 10px 10px 10px 10px;">Author</th><td><?php echo $innovationdetails['innovation_author_id']; ?></td></tr>
                    <tr><th style="background: white; padding: 10px 10px 10px 10px;">Title</th><td><?php echo $innovationdetails['innovation_title']; ?></td></tr>
                  </table>
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
