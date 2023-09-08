<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_WARNING);

$id=$_GET['id'];

if(isset($_POST['btnDelete']))
{
  if(Grades::Delete($id))
  {    
    $msg="Grade was deleted successfully";
    header("location:index.php");
  }
  else
  {
    $msg="Grade was not deleted successfully";
  }
}  

  $details=Grades::ReadDetails($id);
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

  <title>Delete Grade</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      
      <div class="card-header" style="background: red; color: white; font-weight: bolder; font-size: 25px; text-align: center">Confirm Delete Grade</div>
      <div class="card-body">


          <div style="padding: 20px 20px 20px 20px">
            <div style="padding: 20px 20px 20px 20px">
              <center><a href="../"   class="navi" ><i class="fa fa-home"></i> Dashboard</a>
                <a href="index.php" class="navi"><i class="fa fa-table"> Grades</i></a> <br/><br/>        
                <a href="editgrade.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i> Edit Grade</a> <a href="viewgradedetail.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i> Preview Grade</a> </center>
            </div>
          </div>
          
          <div class="form-group">
          <div class="form-group">
            <div class="form-label-group">
              Click on <span class="btn btn-danger"> Confirm</span> button below to complete the delete operation.</div>
          </div>
          </div>
          <br/><br/><br/>
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
              <center><button type="submit" class="btn btn-danger btn-block" name="btnDelete" id="btnDelete">Confirm</button></center>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade" name="grade" class="form-control" value="<?php echo $details['grade']; ?>" readonly="readonly" >
                  <label for="grade"><span style="color: red">(*)</span> Grade</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_symbol" name="grade_symbol" class="form-control" value="<?php echo $details['grade_symbol']; ?>" readonly="readonly" />
                  <label for="grade_symbol"><span style="color: red">(*)</span> Grade Symbol</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_min_score" name="grade_min_score" class="form-control"  value="<?php echo $details['grade_min_score']; ?>" readonly="readonly" >
                  <label for="grade_min_score"><span style="color: red">(*)</span> Grade Min Score</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_max_score" name="grade_max_score" class="form-control"  value="<?php echo $details['grade_max_score']; ?>" readonly="readonly" >
                  <label for="grade_max_score"><span style="color: red">(*)</span> Grade Max Score</label>
                </div>
              </div>
            </div>
          </div>             
          <div class="form-label-group">
            <input type="text" id="grade_remark_anal" name="grade_remark_anal" class="form-control" value="<?php echo $details['grade_remark_anal']; ?>" readonly="readonly" >
              <label for="grade_remark_anal"><span style="color: red">(*)</span> Grade Remark Analysis</label>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_remark_sub" name="grade_remark_sub" class="form-control" value="<?php echo $details['grade_remark_sub']; ?>" readonly="readonly" >
                  <label for="grade_remark_sub"><span style="color: red">(*)</span> Grade Remark Subject</label>
                </div>
              </div>
              <div class="col-md-6">                
                <div class="form-label-group">
                  <input type="text" id="grade_unit" name="grade_unit" class="form-control" value="<?php echo $details['grade_unit']; ?>" readonly="readonly" >
                  <label for="grade_unit"><span style="color: red">(*)</span> Grade Unit</label>
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
