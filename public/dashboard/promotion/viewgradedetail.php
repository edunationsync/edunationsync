<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_WARNING);

$id=$_GET['id'];
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

  <title>Grade Details</title>

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
            <a href="index.php" class="navi"><i class="fa fa-table"> Grades</i></a> <br/><br/>        
            <a href="editgrade.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i> Edit Grade</a> <a href="deletegrade.php?id=<?php echo $id; ?>" class="navi" ><i class="fa fa-home"></i> Delete Grade</a> </center>
        </div>
      </div>
      
      <div class="card-header">Grade Details</div>
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
                  <div class="form-control"><?php echo $details['grade'] ?></div>
                  <label for="grade"><span style="color: red">(*)</span> Grade</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $details['grade_symbol'] ?></div>  
                  <label for="grade_symbol"><span style="color: red">(*)</span> Grade Symbol</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $details['grade_min_score'] ?></div>
                  <label for="grade_min_score"><span style="color: red">(*)</span> Grade Min Score</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $details['grade_max_score'] ?></div>
                  <label for="grade_max_score"><span style="color: red">(*)</span> Grade Max Score</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-label-group">                  
            <div class="form-control"><?php echo $details['grade_remark_anal'] ?></div>
            <label for="grade_remark_anal"><span style="color: red">(*)</span> Grade Remark Analysis</label>
          </div>          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="form-control"><?php echo $details['grade_remark_sub'] ?></div>  
                  <label for="grade_remark_sub"><span style="color: red">(*)</span> Grade Remark Subject</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">                  
                  <div class="form-control"><?php echo $details['grade_unit'] ?></div>  
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
