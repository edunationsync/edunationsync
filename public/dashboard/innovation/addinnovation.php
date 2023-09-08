<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_WARNING);

if(isset($_POST['btnAddNew']))
{
  $innovation_author_id=$_POST['innovation_author_id'];
  $innovation_author_type=$_POST['innovation_author_type'];
  $innovation_title=$_POST['innovation_title'];
  $innovation_type=$_POST['innovation_type'];
  $innovation_description=$_POST['innovation_description'];
  $innovation_date=$_POST['innovation_date'];
  

  if(Innovation::AddNew($innovation_author_id, $innovation_author_type, $innovation_title, $innovation_type, $innovation_description, $innovation_date))
  {    
    $msg="An innovation was added successfully";
  }
  else
  {
    $msg="An innovation was not added successfully";
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

  <title>New Innovation</title>

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
        <a href="index.php" class="navi"><i class="fa fa-table"> All Innovations</i></a>
      </div>

      <div class="card-header">Add New Innovation</div>
      <div class="card-header" style="background: red; color:white">
        <center><?php echo $msg; ?></center></div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
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
                  <input type="file" id="innovation_cover_photo" name="innovation_cover_photo" class="form-control" required="required">
                  <label for="innovation_cover_photo"><span style="color: red">(*)</span> Innovation Cover Photo</label>
                </div>
                <div class="form-label-group">
                  <input type="date" id="innovation_date" name="innovation_date" class="form-control" required="required">
                  <label for="innovation_date"><span style="color: red">(*)</span> Innovation Date</label>
                </div>
              </div> 
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="innovation_author_id" name="innovation_author_id" class="form-control" placeholder="Innovation Author ID" required="required" autofocus="autofocus">
                  <label for="innovation_author_id"><span style="color: red">(*)</span> Innovation Author ID</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select id="innovation_author_type" name="innovation_author_type" class="form-control"  required="required">
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
                  <input type="text" id="innovation_title" name="innovation_title" class="form-control" placeholder="Innovation Title" required="required">
                  <label for="innovation_title"><span style="color: red">(*)</span> Innovation Title</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select id="innovation_type" name="innovation_type" class="form-control" required="required">
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
              <textarea id="innovation_description" name="innovation_description" class="form-control" placeholder="Innovation Description" rows="5" required="required"></textarea>              
              <label for="innovation_description"><span style="color: red">(*)</span> Innovation Description</label>
            </div>
          </div> 
          <button type="submit" class="btn btn-primary btn-block" name="btnAddNew" id="btnAddNew" >Add Innovation</button>
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
