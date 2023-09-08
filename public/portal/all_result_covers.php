<?php session_start();

set_time_limit(2400);
?>

<?php
include '../Module.php';
$schoolDetails=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_NOTICE);


//if(!(isset($Class)))
  $class=$_GET['prclass'];
//if(!(isset($Session)))
  $session=$_GET['prsession'];
  $term=$_GET['prterm'];
  $ss=Module::GetClassSessionp($class);



  $leasts=Analysis::ReadSubjectLeastScoreStudents($Class,$Session,$Term,$Subject);

  foreach ($leasts as $least) {
    if(!(Module::IsStudentActive($least)))
    {
      Module::RemoveResults($least,$Term,$Session);
    }
  }

  //$level=Module::GetLevel($class);
$Students=Module::ReadSessionStudentsp($ss,$class);
foreach($Students as $student)
{
  $studentDetails=Module::ReadStudentDetailsp($student);
  $studentName=$studentDetails['names'];
  $passport=$studentDetails['passport'];
  
  $Subjects=Module::ReadStudentRegisteredSubjects($student,$session,$term);

  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >


  <head> 
    <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
    <style>
    @media print{
      *{
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
      }
    }
      body 
      {
        background-color: white;
      }
      .bheader{
        color: black;
        font-family: times new roman;
        text-align: center;
        font-size: 25px;
      }
      thead{
        font-weight: bolder;
        text-align: center;
        font-size: 14px;
      }
      tbody{
        font-size: 14px;
      }
      .dataField{
        font-family: times new roman;
        text-align: center;
        padding-right: 0.2%;
        border-bottom: 1px solid black;
        font-weight: bold;
      }

      .labelField{
        padding-right: 0.2%;
        border: none;
        font-weight: bold;
        font-family: calibri;
        font-size: 12px;
        vertical-align: bottom;
      }

      .labelFieldHd{
        padding-right: 0.2%;
        border-top: 2px solid black;
        border-bottom: 2px solid black;
        border-right: 2px solid black;
        font-weight: bold;
        font-family: calibri;
        font-size: 13px;
        text-align: center;
      }

      .labelFieldHdFirst{
        padding-right: 0.2%;
        border-bottom: 2px solid black;
        border-right: 2px solid black;
        font-weight: bold;
        font-family: calibri;
        font-size: 13px;
        text-align: center;
      }

      .labelFieldHdLast{
        padding-right: 0.2%;
        border-bottom: 2px solid black;
        font-weight: bold;
        font-family: calibri;
        font-size: 13px;
        text-align: center;
      }

      .subjectFieldBody{
        padding-right: 0.2%;
        border-right: 2px solid black;
        font-weight: bold;
        font-family: calibri;
        font-size: 14px;
      }


      .dataFieldBody{
        padding-right: 0.2%;
        border-bottom: 1px solid black;
        font-weight: bold;
        font-family: calibri;
        font-size: 14px;
        text-align: center;
      }

      .dataFieldBodyLastRow{
        padding-right: 0.2%;
        border-right: 2px solid black;
        font-weight: bold;
        font-family: calibri;
        font-size: 14px;
        text-align: center;
      }

      .dataFieldBodyLastRowLast{
        padding-right: 0.2%;
        font-weight: bold;
        font-family: calibri;
        font-size: 14px;
        text-align: center;
      }

      .dataFieldBodyFirst{
        padding-right: 0.2%;
        border: 1px solid black;
        font-weight: bold;
        font-family: calibri;
        font-size: 14px;
        text-align: center;
      }

      .dataFieldBodyFirstComment{
        padding-right: 0.2%;
        border: 1px solid black;
        font-weight: bold;
        font-family: calibri;
        font-size: 14px;
        text-align: left;
      }

      .content 
      {
        background-color: white;
        padding-left: 3%;
        padding-right: 3%;
        margin-left: auto;
        margin-right: auto;
        width: 90%;
        min-height: 700px;
        page-break-after: always;
      }
     

      </style>
      <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
     
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title><?php echo strtoupper($class." ".$session." ".$term); ?> TERM RESULT SHEETS</title>
  </head>

  <body>
    <div class="content" style="border: 15px groove blue">
      <BR/>
      <center>
        <h1 style="font-family: Comic Sans MS; font-size: 35px; color: red"><?php echo strtoupper($schoolDetails['school_name']); ?></h1>
        <h1 style="font-family: Calibri; font-size: 15px; color: red"><?php echo strtoupper($schoolDetails['school_address']); ?></h1>
        <h1 style="font-family: Calibri; font-size: 15px; color: red"><?php echo strtoupper($schoolDetails['school_phone']); ?></h1>
        <h1 style="font-family: Lucida Calligraphy; font-size: 30px; color: red">TERMLY ASSESSMENT REPORT</h1>
        <h1 style="font-family: Lucida Calligraphy; font-size: 30px; color: red">For <?php echo $term;?> Term</h1>
        <h1 style="font-family: Lucida Calligraphy; font-size: 30px; color: red"><?php echo $session;?> ACADEMIC SESSION</h1></center>


      <div style="padding-left: 7PX; padding-right: 5%; padding-top: 2%; width: 100%">


          <?php
          if(isset($passport))
          {
            ?>
            <img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="height: 300px; border-radius: 10px; float: right">
            <?php
          }
          ?>
          <br/><br/><br/><br/><br/>
        <b style="font-family: calibri; font-size: 30px">NAME: <?php echo $studentName;?></b><br/>
        <b style="font-family: calibri; font-size: 30px">CLASS: <?php echo $class;?></b>
      </div>

    </div>


  </body>
  </html>
  <?php 

}
?>