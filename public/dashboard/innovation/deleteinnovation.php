<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_WARNING);

$id=$_GET['id'];

if(isset($_POST['btnDelete']))
{
  if(Innovation::Delete($id))
  {    
    $msg="Innovation was deleted successfully";
    header("location:index.php");
  }
  else
  {
    $msg="Innovation was not deleted successfully";
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

  <title>Delete Innovation</title>

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
          <center>
            <a href="../"   class="navi" ><i class="fa fa-home"></i> Dashboard</a> 
              <?php 
              if(strtolower($_SESSION['post'])==strtolower("Headmaster")||strtolower($_SESSION['post'])==strtolower("Headmistress")||strtolower($_SESSION['post'])==strtolower("Assistant Headmaster")||strtolower($_SESSION['post'])==strtolower("Assistant Headmistress")||strtolower($_SESSION['post'])==strtolower("Webmaster")||strtolower($_SESSION['post'])==strtolower("Exams & Records"))
              {
                ?>
                <a href="allinnovations.php" class="navi"><i class="fa fa-table"> All Ideas</i></a>
                <?php 
              }
              ?>
              <a href="index.php" class="navi"><i class="fa fa-table"> My Ideas</i></a> <br/><br/>                  
              <a href="viewinnovationdetail.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i> View Details</a>            
              <a href="changeinnovationcover.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i>Change Cover</a> 
              <a href="changeinnovationfile.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i>Change File</a>
              <a href="changeinnovationvideo.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i>Change Video</a>
            </center>
        </div>
      </div>
      
      <div class="card-header" style="background: red; color: white; font-weight: bolder; font-size: 25px; text-align: center">Confirm Delete Innovation</div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">

          
          <div class="form-group">
          <div class="form-group">
            <div class="form-label-group">
              Click on <span class="btn btn-danger"> Confirm</span> button below to complete the delete operation or click on <span class="btn btn-primary"> Cancel</span> button to cancel go back
            </div>
          </div>
          </div>

          <div class="form-group">
            <div class="form-row">   
              
              <div class="col-md-6">
                <div class="form-label-group">
                  <center><button type="submit" class="btn btn-danger btn-block" name="btnDelete" id="btnDelete">Confirm</button></center>
                </div>
              </div>            
              <div class="col-md-6">
                <div class="form-label-group">
                  <center><a href="location:index.php"><button class="btn btn-primary btn-block">Cancel</button></center></a>
                </div>
              </div> 
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">   

              <div class="col-md-6">
                <div class="form-label-group">
                  <center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 100px; height: 100px; border-radius: 20%;"></center>
                  <center><label for="innovation_video"><?php echo $_SESSION['names'];?></label></center>
                </div>
              </div>            
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="date" id="innovation_date" name="innovation_date" class="form-control"  value="<?php echo $innovationdetails['innovation_date']; ?>" autofocus="autofocus">
                  <label for="innovation_date"><span style="color: red">(*)</span> Innovation Date</label>
                </div>
              </div> 
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="innovation_author_id" name="innovation_author_id" class="form-control" placeholder="Innovation Author ID" value="<?php echo $innovationdetails['innovation_author_id'] ?>">
                  <label for="innovation_author_id"><span style="color: red">(*)</span> Innovation Author ID</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select id="innovation_author_type" name="innovation_author_type" class="form-control" >
                    <option>Student</option>
                    <option>Staff</option>
                  </select>  
                  <label for="innovation_author_type"><span style="color: red">(*)</span> Innovation Author Type</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="innovation_title" name="innovation_title" class="form-control" placeholder="Innovation Title" value="<?php echo $innovationdetails['innovation_title'] ?>">
                  <label for="innovation_title"><span style="color: red">(*)</span> Innovation Title</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">                  
                  <select id="innovation_type" name="innovation_type" class="form-control" >
                    <option>Research</option>
                    <option>Creativity</option>
                    <option>Others</option>
                  </select>  
                  <label for="innovation_type"><span style="color: red">(*)</span> Innovation Type</label>
                </div>
              </div>
            </div>
          </div>  

          <div class="form-group">
            <div class="form-label-group">
              <textarea id="innovation_description" name="innovation_description" class="form-control" placeholder="Innovation Description" rows="5"> <?php echo $innovationdetails['innovation_description'] ?></textarea>              
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
