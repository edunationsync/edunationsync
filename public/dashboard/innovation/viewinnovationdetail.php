<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_WARNING);

$id=$_GET['id'];

if(isset($_POST['btnUpdate']))
{
  $innovation_author_id=$_POST['innovation_author_id'];
  $innovation_author_type=$_POST['innovation_author_type'];
  $innovation_title=$_POST['innovation_title'];
  $innovation_type=$_POST['innovation_type'];
  $innovation_description=$_POST['innovation_description'];
  $innovation_date=$_POST['innovation_date'];
  

  if(Innovation::Update($id,$innovation_author_id, $innovation_author_type, $innovation_title, $innovation_type, $innovation_description, $innovation_date))
  {    
    $msg="Innovation was modified successfully";
  }
  else
  {
    $msg="Innovation was not modified successfully";
  }
}

  

  $innovationdetails=Innovation::ReadDetails($id);
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

  <title>Innovation Details</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
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
            <a href="index.php" class="navi"><i class="fa fa-table"> My Ideas</i></a> <br/><br/>        
            <a href="editinnovation.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i> Edit Details</a> <a href="deleteinnovation.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i> Delete Idea</a> </center>
        </div>
      </div>
      
      <div class="card-header">Innovation Details</div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
          <div class="form-group">
            <div class="form-label-group">
              <?php echo $msg; ?>
            </div>
          </div>
          </div>
          <div class="form-group">
            <div class="form-row">   

              <div class="col-md-6">
                <div class="form-label-group">
                  <center><label for="innovation_video">Author</label></center>
                  <center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 200px; height: 200px; border-radius: 20%;"></center>
                  <center><label for="innovation_video"><?php echo $_SESSION['names'];?></label></center>
                </div>
              </div>            
              <div class="col-md-6">
                <div class="form-label-group">
                  <center><img src="<?php echo 'data:image/jpeg;base64,'.$innovationdetails['innovation_cover_photo'];?>" style="width: 100px; height: 100px; border-radius: 20%;"></center>
                </div>
                <div class="form-label-group">
                  <div class="form-control"><?php echo $innovationdetails['innovation_date'] ?></div>
                  <label for="innovation_date"><span style="color: red">(*)</span> Innovation Date</label>
                </div>
              </div> 
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $innovationdetails['innovation_author_id'] ?></div>
                  <label for="innovation_author_id"><span style="color: red">(*)</span> Innovation Author ID</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $innovationdetails['innovation_author_type'] ?></div>  
                  <label for="innovation_author_type"><span style="color: red">(*)</span> Innovation Author Type</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $innovationdetails['innovation_title'] ?></div>
                  <label for="innovation_title"><span style="color: red">(*)</span> Innovation Title</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">                  
                  <div class="form-control"><?php echo $innovationdetails['innovation_type'] ?></div>  
                  <label for="innovation_type"><span style="color: red">(*)</span> Innovation Type</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <div class="form-control"><?php echo $innovationdetails['innovation_description'] ?></div>
              <label for="innovation_description"><span style="color: red">(*)</span> Innovation Description</label>
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
