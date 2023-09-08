<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_WARNING);

if(isset($_POST['btnAddNew']))
{
  $grade=$_POST['grade'];
  $grade_symbol=$_POST['grade_symbol'];
  $grade_min_score=$_POST['grade_min_score'];
  $grade_max_score=$_POST['grade_max_score'];
  $grade_remark_sub=$_POST['grade_remark_sub'];
  $grade_remark_anal=$_POST['grade_remark_anal'];
  $grade_unit=$_POST['grade_unit'];
  

  if(Grades::AddNew($grade, $grade_symbol, $grade_min_score, $grade_max_score, $grade_remark_sub, $grade_remark_anal, $grade_unit))
  {    
    $msg="Grade Point was added successfully";
  }
  else
  {
    $msg="Grade Point was not added successfully";
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

  <title>New Grade</title>

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
        <a href="index.php" class="navi"><i class="fa fa-table"> All Grades</i></a>
      </div>

      <div class="card-header">Add New Grade</div>
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
                  <input type="text" id="grade" name="grade" class="form-control" placeholder="Grade" required="required" autofocus="autofocus">
                  <label for="grade"><span style="color: red">(*)</span> Grade</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_symbol" name="grade_symbol" class="form-control"  required="required" />
                  <label for="grade_symbol"><span style="color: red">(*)</span> Grade Symbol</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_min_score" name="grade_min_score" class="form-control" placeholder="Grade Minimum Score e.g. 89" required="required">
                  <label for="grade_min_score"><span style="color: red">(*)</span> Grade Minimum Score</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_max_score" name="grade_max_score" class="form-control" placeholder="Grade Maximum Score e.g. 89" required="required">
                  <label for="grade_max_score"><span style="color: red">(*)</span> Grade Maximum Score</label>
                </div>
              </div>
            </div>
          </div>
              <input type="text" id="grade_remark_anal" name="grade_remark_anal" class="form-control" placeholder="Grade Remark Anal e.g. Keep Shining" required="required">
              <label for="grade_remark_anal"><span style="color: red">(*)</span> Grade Remark Analysis</label>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_remark_sub" name="grade_remark_sub" class="form-control" placeholder="Grade Remark e.g. Excellent" required="required">
                  <label for="grade_remark_sub"><span style="color: red">(*)</span> Grade Remark Subject</label>
                </div>
              </div>
              <div class="col-md-6">                
                <div class="form-label-group">
                  <input type="text" id="grade_unit" name="grade_unit" class="form-control" placeholder="Grade Unit e.g. 5" required="required">
                  <label for="grade_unit"><span style="color: red">(*)</span> Grade Unit</label>
                </div>
              </div>
            </div>
          </div> 

          <button type="submit" class="btn btn-primary btn-block" name="btnAddNew" id="btnAddNew" >Add Grade</button>
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
