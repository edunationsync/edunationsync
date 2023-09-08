<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
  $table_name=$_GET['table_name'];
  $table_schema=$_GET['table_schema'];
  
  $Columns=Tables::ReadTableColumns($table_schema,$table_name);
  if(isset($_POST['btnSave']))
  {
    $sql_query="INSERT INTO `$table_name` (";
    $count=0;
    foreach($Columns as $Column)
    {
      $count++;
      if($count==1)
      {
        $delimi="";
      }
      else
      {
        $delimi=", ";
      }

      $coltype=Tables::ReadColumnDetails($table_schema,$table_name,$Column);

      if($coltype=="blob"||$coltype=="tinyblob"||$coltype=="mediumblob"||$coltype=="longblob")
      {
        if(is_uploaded_file($_FILES[$Column]['tmp_name'])){
          $passport=base64_encode(file_get_contents($_FILES[$Column]['tmp_name']));
        }
        else
        {
          $passport=$dataDetails[$Column];
        }

        $sql_strings=$sql_strings."$delimi `$Column`";
      }
      elseif($coltype=="timestamp")
      {
        $sql_strings=$sql_strings."$delimi `$Column` ";
      } 
      else
      {
        $sql_strings=$sql_strings."$delimi `$Column` ";
      }



      
    }

    $sql_query=$sql_query.$sql_strings.") VALUES(";

    $count=0;
    $sql_strings="";
    foreach($Columns as $Column)
    {
      $count++;
      if($count==1)
      {
        $delimi="";
      }
      else
      {
        $delimi=", ";
      }



      $coltype=Tables::ReadColumnDetails($table_schema,$table_name,$Column);
      if($coltype=="blob"||$coltype=="tinyblob"||$coltype=="mediumblob"||$coltype=="longblob")
      {
        if(is_uploaded_file($_FILES[$Column]['tmp_name'])){
          $passport=base64_encode(file_get_contents($_FILES[$Column]['tmp_name']));
        }
        else
        {
          $passport=$dataDetails[$Column];
        }

        $sql_strings=$sql_strings."$delimi '".$passport."' ";
      }
      elseif($coltype=="timestamp")
      {
         $sql_strings=$sql_strings."$delimi CURRENT_TIMESTAMP ";
      }        
      else
      {
        if($Column=="id")
        {
          if(isset($_POST[$Column]))
          {
            $sql_strings=$sql_strings."$delimi NULL ";
          }
          else
          {
            $sql_strings=$sql_strings."$delimi NULL ";
          }
          
        }
        else
        {
          if($_POST[$Column]=='')
          {
            $sql_strings=$sql_strings."$delimi NULL ";
          }
          else
          {
            $sql_strings=$sql_strings."$delimi '".$_POST[$Column]."' ";
          }
          
        }        
      } 

    }

    $sql_query=$sql_query.$sql_strings.");";

    

    if(Tables::AddTableData($table_name,$tableData,$sql_query))
    {
      //echo "Successful";
      //header("location:schema/?table_name=".$table_name);
    }
    else
    {
      ?>
      <script type="text/javascript">alert('Failed to Add Record');</script>
      <?php
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

  <title>Add <?php echo $table_name; ?> Record</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5"> <a href="index.php"  class="form-control" >Dashboard</a> <a href="index.php?table_name=<?php echo $table_name; ?>"  class="form-control" >Database</a> 
      <div class="card-header" style="text-align: center;">Add record to '<?php echo strtoupper($table_name); ?>' Table</div>
      <div class="card-body">
        <form  enctype="multipart/form-data" method="POST" action="">
          <?php
          foreach($Columns as $Column)
          {
            $coltype=Tables::ReadColumnDetails($table_schema,$table_name,$Column);

            if($coltype=="text"||$coltype=="mediumtext"||$coltype=="longtext")
            {
              ?>
              <!--Text type-->  
              <div class="form-group" style="background: lightblue">
                <div class="form-label-group">
                  <label for="<?php echo $Column; ?>"><?php echo strtoupper($Column).$coltype; ?></label>
                  <textarea id="<?php echo $Column; ?>" name="<?php echo $Column; ?>" class="form-control" placeholder="<?php echo $Column; ?>" rows="5"><?php echo $dataDetails[$Column]; ?></textarea>              
                  
                </div>
              </div>  
              <?php
            }
            elseif($coltype=="blob"||$coltype=="tinyblob"||$coltype=="mediumblob"||$coltype=="longblob")
            {
              ?>              
              <!-- Image Type-->
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">                
                    <img src="<?php echo 'data:image/jpeg;base64,'.$dataDetails[$Column];?>" style="width: 100px; height: 100px; border-radius: 100%;">
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="file" id="<?php echo $Column; ?>" name="<?php echo $Column; ?>" class="form-control" >
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
            elseif($coltype=="timestamp")
            {
              ?>
              <!--VARCHAR type-->    
              <div class="form-group" style="background: lightblue">
                <div class="form-label-group">
                  <label for="<?php echo $Column; ?>"><?php echo strtoupper($Column); ?></label>
                  <input type="text" name="<?php echo $Column; ?>" class="form-control" placeholder="<?php echo $Column; ?>" value="<?php echo $dataDetails[$Column]; ?>" readonly />              
                  
                </div>
              </div>

              <?php
            }
            elseif($Column=="id")
            {

            }
            else
            {
              ?>
              <!--VARCHAR type-->    
              <div class="form-group" style="background: lightblue">
                <div class="form-label-group">
                  <label for="<?php echo $Column; ?>"><?php echo strtoupper($Column); ?></label>
                  <input type="text" name="<?php echo $Column; ?>" class="form-control" placeholder="<?php echo $Column; ?>" value="<?php echo $dataDetails[$Column]; ?>" />              
                  
                </div>
              </div>

              <?php
            }
          }
          ?>          
          
          <button type="submit" class="btn btn-primary btn-block" name="btnSave" id="btnSave" >Save Record</button>
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
