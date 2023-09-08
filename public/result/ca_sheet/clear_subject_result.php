<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();


$Subject=$_GET['subject'];
$Class=$_GET['class'];
$Term=$_GET['term'];
$Session=$_GET['session'];

if(isset($_POST['btnDelete']))
{
  $Subject=$_POST['subject'];
  $Class=$_POST['class'];
  $Term=$_POST['term'];
  $Session=$_POST['session'];
  

  if(Module::ClearSubjectResultp($Subject,$Class,$Term,$Session))
  {    
    header("location:index.php?txtclassp=$Class&txttermp=$Term&txtsessionp=$Session&txtsubjectp=$Subject");
  }
  else
  {
    $msg="Subject Result for $Term, $Session, $Class was cleared successfully.";
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

  <title>Delete Student</title>

  <!-- Custom fonts for this template-->
  <link href="../../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../../dashboard/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> 
      <div style="padding: 20px 20px 20px 20px">
        <a href="../"   class="navi" ><i class="fa fa-home"></i> Result Dashboard</a> 
        <a href="./?txtclassp=<?php echo $Class; ?>"   class="navi"  ><i class="fa fa-table"> CA Sheet</i></a>
      </div>
      
      <div class="card-header">Are your sure you want to Delete <?php echo $Subject; ?> Result?</div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <input type="hidden" name="subject" id="subject" value="<?php echo $Subject ?>">
          <input type="hidden" name="class" id="class" value="<?php echo $Class ?>">
          <input type="hidden" name="term" id="term" value="<?php echo $Term ?>">
          <input type="hidden" name="session" id="session" value="<?php echo $Session ?>">
        <div class="text-center">
          <a class="d-block small mt-3" href="#" onclick="window.history.back()">Cancel</a> 
          <button type="submit" class="btn btn-primary btn-block" name="btnDelete" id="btnDelete" >Delete</button>
        </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control"  ><?php echo $Subject; ?></p>
                  <label for="names">Subject</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control"  ><?php echo $Class; ?></p>
                  <label for="names">Class</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $Term; ?></p>
                  <label for="guardian">Term</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <p class="form-control" ><?php echo $Session; ?></p>
                  <label for="guardian">Session</label>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../dashboard/vendor/jquery/jquery.min.js"></script>
  <script src="../../dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
