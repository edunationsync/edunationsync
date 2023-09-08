<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_WARNING);

$id=$_GET['id'];

if(isset($_POST['btnUpdate']))
{
  $grade=$_POST['grade'];
  $grade_symbol=$_POST['grade_symbol'];
  $grade_min_score=$_POST['grade_min_score'];
  $grade_max_score=$_POST['grade_max_score'];
  $grade_unit=$_POST['grade_unit'];
  $grade_remark_sub=$_POST['grade_remark_sub'];
  $grade_remark_anal=$_POST['grade_remark_anal'];
  

  if(Grades::Update($id, $grade, $grade_symbol, $grade_min_score, $grade_max_score, $grade_remark_sub, $grade_remark_anal, $grade_unit))
  {    
    $msg="Grade was modified successfully";
  }
  else
  {
    $msg="Grade was not modified successfully";
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

  <title>Modify Grade</title>

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
              
              <a href="index.php" class="navi"><i class="fa fa-table"> Grades</i></a> <br/><br/>
            </center>
        </div>
      </div>
      
      <div class="card-header">Modify Grade</div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <div class="form-group">
          <div class="form-group">
            <div class="form-label-group">
              <?php echo $msg; ?>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade" name="grade" class="form-control" value="<?php echo $details['grade']; ?>">
                  <label for="grade"><span style="color: red">(*)</span> Grade</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_symbol" name="grade_symbol" class="form-control" value="<?php echo $details['grade_symbol']; ?>"/>
                  <label for="grade_symbol"><span style="color: red">(*)</span> Grade Symbol</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_min_score" name="grade_min_score" class="form-control"  value="<?php echo $details['grade_min_score']; ?>">
                  <label for="grade_min_score"><span style="color: red">(*)</span> Grade Min Score</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_max_score" name="grade_max_score" class="form-control"  value="<?php echo $details['grade_max_score']; ?>">
                  <label for="grade_max_score"><span style="color: red">(*)</span> Grade Max Score</label>
                </div>
              </div>
            </div>
          </div>                
          <div class="form-label-group">
            <input type="text" id="grade_remark_anal" name="grade_remark_anal" class="form-control" value="<?php echo $details['grade_remark_anal']; ?>">
            <label for="grade_remark_anal"><span style="color: red">(*)</span> Grade Remark Analysis</label>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="grade_remark_sub" name="grade_remark_sub" class="form-control" value="<?php echo $details['grade_remark_sub']; ?>">
                  <label for="grade_remark_sub"><span style="color: red">(*)</span> Grade Remark Subject</label>                  
                </div>
              </div>
              <div class="col-md-6">                
                <div class="form-label-group">
                  <input type="text" id="grade_unit" name="grade_unit" class="form-control" value="<?php echo $details['grade_unit']; ?>">
                  <label for="grade_unit"><span style="color: red">(*)</span> Grade Unit</label>
                </div>
              </div>
            </div>
          </div>  
          <button type="submit" class="btn btn-primary btn-block" name="btnUpdate" id="btnUpdate" >Edit Grade</button>
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
