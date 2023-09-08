<?php session_start();
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

  <title>User Documents Management</title>

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
        <a href="documents.php?userid=<?php echo $_GET['userid'] ?>"   class="navi" ><i class="fa fa-home"></i> Open Documents</a>
      </div>
      <div class="card-header">User Document Upload Number</div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="GET" action="document_uploader.php">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6" style="text-align: right">
                <h3>How many documents do you want to upload?</h3>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="hidden" id="userid" name="userid" value="<?php echo $_GET['userid']; ?>">
                  <input type="number" name="upload_numbers" id="upload_numbers" max="30" min="1" placeholder="Number of Uploads" required="required" value="<?php echo $upload_numbers; ?>">
                  <label for="facebook_icon">Set Number</label>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="btnModify" id="btnModify" >Upload Document(s)</button>
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
