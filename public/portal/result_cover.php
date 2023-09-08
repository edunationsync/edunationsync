<?php session_start();
set_time_limit(2400);

include '../Module.php';
error_reporting(error_reporting() & ~E_NOTICE);

$session=base64_decode($_GET['session']);
$class=base64_decode($_GET['class']);
$term=base64_decode($_GET['term']);
$student=base64_decode($_GET['student']);
  $ss=Module::GetClassSessionp($class);



  $leasts=Analysis::ReadSubjectLeastScoreStudents($Class,$Session,$Term,$Subject);

  foreach ($leasts as $least) {
    if(!(Module::IsStudentActive($least)))
    {
      Module::RemoveResults($least,$Term,$Session);
    }
  }

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
        width: 700px;
        height: 100%;
        page-break-after: always;
      }
     

      </style>
      <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
     
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <title><?php echo strtoupper($class." ".$session." ".$term); ?> TERM RESULT SHEETS</title>
  </head>

  <body>

    <!-- ========================================= Cover Page ======================================= -->

    <div class="content" style="border: 15px groove blue">
      <BR/>
      <center><h1 style="font-family: calibri; font-size: 30px"><?php echo $studentName;?></h1></center>
      <div style="padding-left: 7PX; padding-right: 5%; padding-top: 2%; width: 100%">


          <?php
          if(isset($passport))
          {
            ?>
            <td rowspan="2" style="border: 1px solid black; padding: 3px 3px 3px 3px; margin: 3px 3px 3px 3px; border-radius: 10px; margin-left: 20px "><img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="height: 300px; border-radius: 10px; "></td>
            <?php
          }
          ?>

      <table width="100%" style="min-height: 500px">
        <tr>
          <td width="100%" valign="top">
            <img src="../images/school/logo.png" style="position: absolute; width: 500px; padding-top: 100px; opacity: 0.2">
          </td>
        </tr>
      </table>

      </div>

    </div>

  </body>
  </html>