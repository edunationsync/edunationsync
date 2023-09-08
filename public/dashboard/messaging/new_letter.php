<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_WARNING);

if(isset($_GET['btn_new']))
{
  if(OfficialLetter::AddNewLetter($_GET['our_reference'], str_replace("'", "\'", $_GET['letter_body']), $_SESSION['userid'], str_replace("'", "\'", $_GET['reciever_address']), str_replace("'", "\'", $_GET['letter_title']), date('M'), str_replace("'", "\'", $_GET['letter_clossure']), $_GET['our_date'], str_replace("'", "\'", $_GET['letter_salutation'])))
  {    
    $msg="<br/>An Official Letter was added successfully";
  }
  else
  {
    $msg="<br/>An Official Letter was not added successfully";
  }

  $letterdetails=OfficialLetter::ReadNewLetterDetails(str_replace("'", "\'", $_GET['letter_body']), str_replace("'", "\'", $_GET['reciever_address']),str_replace("'", "\'", $_GET['letter_title']),str_replace("'", "\'", $_GET['our_date']));

  $schooldetails=School::ReadSchoolDetails();

  $our_reference=$schooldetails['school_keycode'].date('Y').date('m').date('d').'-'.$letterdetails['id'];
  
  if(OfficialLetter::UpdateReferenceLetter($letterdetails['id'],$our_reference))
  {    
    $msg="<br/>An Official Reference Letter was Updated successfully";
  }
  else
  {
    $msg="<br/>An Official Reference Letter was not Updated successfully";
  }

  header("location:new_letter.php?id=".$letterdetails['id']);
}
elseif(isset($_GET['btn_update']))
{
  $letterdetails=OfficialLetter::ReadDetails($_GET['id']);
    


  if(OfficialLetter::UpdateLetter($_GET['id'],str_replace("'", "\'", $_GET['letter_salutation']),str_replace("'", "\'", $_GET['letter_title']),str_replace("'", "\'", $_GET['reciever_address']),str_replace("'", "\'", $_GET['letter_body']),str_replace("'", "\'", $_GET['letter_clossure'])))
  {    
    $msg="An Official Letter was Updated successfully";
  }
  else
  {
    $msg="An Official Letter was not Updated successfully";
  }
}
elseif(isset($_GET['btn_print']))
{
  header("location:print_letter.php?id=".$_GET['id']);
}

if(isset($_GET['id']))
{
  $letterdetails=OfficialLetter::ReadDetails($_GET['id']);
  $status="update_letter";
}
else
{
  $status="new_letter";
}

$letterdetails=OfficialLetter::ReadDetails($_GET['id']);
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

  <title>New Official Letter</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <style type="text/css">
    .container{
          padding: 20px 20px 20px 20px;  
          width: 100%
          margin-left: auto;
          margin-right: auto;
          page-break-after: always;
    }
    .letter_content{
      padding: 5px 5px 5px 5px;
      margin-top: -121%;
      width: 100%;
      border-radius: 10px;
    }
    .our_reference{
      height: 10px;
      width: 270px;
      margin-left: 110px;
      margin-top: -5px;
    }
    .our_date{
      height: 10px;
      width: 200px;
      margin-left: 840px;
      margin-top: -10px;
    }
    .letter_title{
      width: 90%;
      text-align: center;
      margin-left: 50px;
    }
    .reciever_address{
      padding: 5px 5px 5px 5px;
      width: 400px;
      border-radius: 10px;
      margin-top: 80px;
      margin-left: 50px;
    }
    .reciever_address textarea{
      min-height: 150px;
    }
    .letter_body{
      padding: 5px 5px 5px 5px;
      width: 90%;
      border-radius: 10px;
      margin-left: 50px;
    }
    .letter_body textarea{
      min-height: 200px;
    }
    .letter_salutation{
      padding: 5px 5px 5px 5px;
      width: 90%;
      border-radius: 10px;
      margin-left: 50px;
    }
    .letter_clossure{
      margin-left: 700px;

    }
    input,textarea{
      border: none;
      background: none;
      color: black;
      font-weight: bolder;
      width: 100%;
    }
  </style>
</head>

<body class="bg-dark">
  <a href="./">Back</a>
<form method="GET" action="./new_letter.php">
  <?php echo $msg; ?>
  <div class="container">
      <img src="../../images/school/letter_head.jpg" style="width: 100%">

      <input type="hidden" name="id" value="<?php echo $letterdetails['id']; ?>" readonly="readonly">

      <div class="letter_content">
        <div class="our_reference"><input type="input" name="our_reference" placeholder="Our Reference" value="<?php echo $letterdetails['our_reference']; ?>" readonly="readonly"></div>

        <div class="our_date"><input type="date" name="our_date" placeholder="Date" value="<?php echo $letterdetails['our_date']; ?>"></div>

        <div class="reciever_address"><textarea placeholder="Reciever's Address e.g. The Principal Dubai Care School, Ankpa" spellcheck="true" name="reciever_address"><?php echo $letterdetails['reciever_address']; ?></textarea></div>

        <div class="letter_salutation"><input type="input" name="letter_salutation" placeholder="Letter Salutation" value="<?php echo $letterdetails['letter_salutation']; ?>"></div>

        <center><div class="letter_title"><input type="input" name="letter_title" placeholder="Title of the Letter" style="text-align: center" value="<?php echo $letterdetails['letter_title']; ?>"></div></center>

        <div class="letter_body"><textarea placeholder="Body of the Letter" name="letter_body" rows="6"><?php echo $letterdetails['letter_body']; ?></textarea></div>

        <div class="letter_clossure"><textarea placeholder="Complementary Close" name="letter_clossure" rows="4"><?php echo $letterdetails['letter_clossure']; ?></textarea></div>
        <?php 
        if($status=="new_letter")
        {
          ?>
          <button type="submit" name="btn_new">Save Message</button>
          <?php
        }
        else
        {
          ?>
          <button type="submit" name="btn_update">Update Message</button>
          <button type="submit" name="btn_print">Print Message</button>
          <?php
        }

        ?>
        
      </div>
  </div>
</form>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
