<?php session_start();

include '../Module.php';
error_reporting(error_reporting() & ~E_NOTICE);


$session=$_GET['session'];
$class=$_GET['class'];
$term=$_GET['term'];
$student=$_GET['student'];


  $stdDetails=Module::ReadStudentDetailsp($student);
//if(!(isset($Subject)))
  $class=$stdDetails['class'];
//if(!(isset($Subject)))
  $serial=strtoupper($_SESSION['serial']);
//if(!(isset($Class)))
  $studentName=strtoupper($stdDetails['names']);
  $passport=$stdDetails['passport'];

  $ss=Module::GetClassSessionp($class);

  //$level=Module::GetLevel($class);
  $Students=Module::ReadSessionStudentsp($ss,$class);
  //$level=Module::GetLevel($class);

  
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
  <div class="content" >
    <div><img src="../images/school/result_header.jpg" width="100%" height="110px" /></div><BR/>
    <center><b style="font-family: calibri; font-size: 20px">TERMINAL REPORT SHEET</b></center>
    <div style="padding-left: 7PX; padding-right: 5%; padding-top: 2%; width: 100%">
    <table width="80%" cellspacing="0">

      <?php
      $cl=substr($class, strlen($class)-1,1);
      if($cl=="O")
      {
        $cl= substr($class, 0,strlen($class)-1);
      }
      else
      {
        $cl=strtoupper($class);
      } ?>
      <tr>
        <?php
        if(isset($passport))
        {
          ?>
          <td rowspan="2" style="border: 1px solid black; padding: 3px 3px 3px 3px; margin: 3px 3px 3px 3px; border-radius: 10px; margin-left: 20px "><img src="<?php echo 'data:image/jpeg;base64,'.$passport;?>" style="height: 100px; border-radius: 10px; "></td>
          <?php
        }
        ?>
        <td class="labelField" style="text-align: right">REG NO</td><td class="dataField" style="vertical-align: bottom;"><?php echo $student; ?></td><td width="120px" class="labelField" style="text-align: right">NAME</td><td colspan="3" class="dataField" style="vertical-align: bottom;"><?php echo $studentName; ?></td></tr>
      <tr><td width="70px" class="labelField" style="text-align: right">TERM</td><td width="150px" class="dataField" style="vertical-align: bottom;"><?php echo $term; ?></td><td width="50px" class="labelField" style="text-align: right">SESSION</td><td width="150px" class="dataField" style="vertical-align: bottom;"><?php echo $session; ?></td><td width="40px" class="labelField" style="text-align: right">CLASS</td><td width="150px" class="dataField" style="vertical-align: bottom;"><?php echo $cl; ?></td></tr>
      
    </table>
    <table width="100%">
      <tr>
        <td width="90%" valign="top">
          <img src="../images/school/logo.png" style="position: absolute; width: 500px; padding-top: 100px; opacity: 0.2">
          <table width="95%" cellspacing="0" style="padding-top: 5px;">
            <tr>
              <td class="labelFieldHdFirst" width="90px" >SUBJECT</td>
              <td class="labelFieldHd" width="30px" >CA1 (10)</td>
              <td class="labelFieldHd" width="30px" >CA2 (10)</td>
              <td class="labelFieldHd" width="30px" >CA3 (10)</td>
              <td class="labelFieldHd" width="30px" >CAT (30)</td>
              <td class="labelFieldHd" width="30px" >EXAM (70)</td>
              <td class="labelFieldHd" width="30px" >TOTAL (100)</td>
              <td class="labelFieldHd" width="30px" >L.S</td>
              <td class="labelFieldHd" width="30px" >H.S</td>
              <!--<td class="labelFieldHd" width="30px" >CLASS AVER</td>-->
              <td class="labelFieldHd" width="30px" >POS</td>
              <td class="labelFieldHd" width="30px" >GRADE</td>
              <td class="labelFieldHd" style="min-width: 60px" >REMARK</td>
            </tr>

            <?php
            $subjectCount=0;

            $Subjects=Module::ReadStudentRegisteredSubjects($student,$session,$term);
            $subjectTotal=count($Subjects);

            foreach($Subjects as $Subject)
            {
              $subjectDetail=Module::ReadSubjectDetailsp($Subject);
              $resultData=Module::ReadSubjectResultp($student,$Subject,$session,$term);
              $subjectCount++;
                //First Subject
                ?>
                <tr>
                  <td class="subjectFieldBody" ><?php echo $subjectDetail['short_code']; ?></td>
                  <td class="dataFieldBodyFirst" ><?php  echo $resultData['ca1'];  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  echo $resultData['ca2'];  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  echo $resultData['ca3'];  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  echo $resultData['catotal'];  ?></td>
                  <td class="dataFieldBodyFirst" ><?php 
                  if(isset($resultData['exam'])) 
                    echo $resultData['exam'];  
                  else
                    echo "-";

                  ?></td>
                  <td class="dataFieldBodyFirst" ><?php 
                  if(isset($resultData['total'])) 
                    echo round($resultData['total'],2);  
                  else
                    echo "-";  ?></td>
                  <td class="dataFieldBodyFirst" ><?php 
                  if(isset($resultData['lowest_score'])) 
                    echo $resultData['lowest_score'];  
                  else
                    echo "-";  ?></td>
                  <td class="dataFieldBodyFirst" ><?php 
                  if(isset($resultData['highest_score'])) 
                    echo $resultData['highest_score'];  
                  else
                    echo "-";  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  
                  if(isset($resultData['position'])){
                    echo $resultData['position'];  
                    $Position=$resultData['position'];

                    $lPos=substr($Position, strlen($Position)-1,1);      
                    if($lPos==1 && $Position!=11)
                    {
                      echo "<sup>st</sup>";        
                    }
                    elseif($lPos==2  && $Position!=12)
                    {
                      echo "<sup>nd</sup>";        
                    }
                    elseif($lPos==3  && $Position!=13)
                    {
                      echo "<sup>rd</sup>";        
                    }
                    else
                    {
                      echo "<sup>th</sup>";
                    }
                  }
                  else
                    echo "-"; ?></td>
                  <td class="dataFieldBodyFirst" ><?php  
                  if(isset($resultData['grade'])) 
                    echo $resultData['grade'];  
                  else
                    echo "-"; ?></td>
                  <td class="dataFieldBodyFirst" ><?php  
                  if(isset($resultData['remark'])) 
                    echo $resultData['remark'];  
                  else
                    echo "-"; ?></td>
                </tr>



                <?php
              
              $resultData=Module::ReadDomainDetailsp($student,$session,$term);
              $attentiveness=$resultData['attentiveness'];
              $neatness=$resultData['neatness'];
              $attendance=$resultData['attendance'];
              $politeness=$resultData['politeness'];
              $relationship=$resultData['relationship'];
              $curiosity=$resultData['curiosity'];
              $honesty=$resultData['honesty'];
              $help_others=$resultData['help_others'];
              $punctuality=$resultData['punctuality'];
              $leadership=$resultData['leadership'];
              $emotional_stability=$resultData['emotional_stability'];
              $attitude_to_work=$resultData['attitude_to_work'];
            }

            ?>
            <tr>
                  <td class="subjectFieldBody" >Total</td>
                  <td class="dataFieldBodyFirst" ><?php  echo round(Module::GetTotalCa1Scorep($student,$session,$term,$class),2);  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  echo round(Module::GetTotalCa2Scorep($student,$session,$term,$class),2);  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  echo round(Module::GetTotalCa3Scorep($student,$session,$term,$class),2);  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  echo round(Module::GetGrandCATotalp($student,$session,$term,$class),2);  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  echo round(Module::GetTotalExamScorep($student,$session,$term,$class),2);  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  echo round(Module::GetGrandTotalp($student,$session,$term,$class),2);  ?></td>
                  <td class="dataFieldBodyFirst" ><?php 
                  if(isset($resultData['lowest_score'])) 
                    echo $resultData['lowest_score'];  
                  else
                    echo "-";  ?></td>
                  <td class="dataFieldBodyFirst" ><?php 
                  if(isset($resultData['highest_score'])) 
                    echo $resultData['highest_score'];  
                  else
                    echo "-";  ?></td>
                  <td class="dataFieldBodyFirst" ><?php  
                  if(isset($resultData['position'])){
                    echo $resultData['position'];  
                    $Position=$resultData['position'];

                    $lPos=substr($Position, strlen($Position)-1,1);      
                    if($lPos==1 && $Position!=11)
                    {
                      echo "<sup>st</sup>";        
                    }
                    elseif($lPos==2  && $Position!=12)
                    {
                      echo "<sup>nd</sup>";        
                    }
                    elseif($lPos==3  && $Position!=13)
                    {
                      echo "<sup>rd</sup>";        
                    }
                    else
                    {
                      echo "<sup>th</sup>";
                    }
                  }
                  else
                    echo "-"; ?></td>
                  <td class="dataFieldBodyFirst" ><?php  
                  if(isset($resultData['grade'])) 
                    echo $resultData['grade'];  
                  else
                    echo "-"; ?></td>
                  <td class="dataFieldBodyFirst" ><?php  
                  if(isset($resultData['remark'])) 
                    echo $resultData['remark'];  
                  else
                    echo "-"; ?></td>
                </tr>
            <tr><td class="labelFieldHdFirst" style="text-align: center"></td><td class="labelFieldHdLast" colspan="10"></td></tr>
          </table>
        </td>
        <td valign="top" width="10%">
          <table cellspacing="0">
            <tr><th style="border: 1px solid black;">AFFECTIVE AREAS</th><th style="border: 1px solid black;">POINTS</th></tr>
            <tr><td style="border: 1px solid black;">Punctuality</td><td style="border: 1px solid black;"><center><?php echo $punctuality; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Neatness</td><td style="border: 1px solid black;"><center><?php echo $neatness; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Politeness</td><td style="border: 1px solid black;"><center><?php echo $politeness; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Honesty</td><td style="border: 1px solid black;"><center><?php echo $honesty; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Cooperation with others</td><td style="border: 1px solid black;"><center><?php echo $relationship; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Leadership</td><td style="border: 1px solid black;"><center><?php echo $leadership; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Helping Others</td><td style="border: 1px solid black;"><center><?php echo $help_others; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Emotional Stability</td><td style="border: 1px solid black;"><center><?php echo $emotional_stability; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Attidude to Work</td><td style="border: 1px solid black;"><center><?php echo $attitude_to_work; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Attentiveness</td><td style="border: 1px solid black;"><center><?php echo $attentiveness; ?></center></td></tr>
            <tr><td style="border: 1px solid black;">Speaking/Hand Writing</td><td style="border: 1px solid black;"><center><?php echo $curiosity; ?></center></td></tr>
          </table>

          <table>
            <tr><th>RATING SCALE: 1-5</th></tr>
            <tr><td>5 - Excellent</td></tr>
            <tr><td>4 - Good</td></tr>
            <tr><td>3 - Fair</td></tr>
            <tr><td>2 - Poor</td></tr>
            <tr><td>1 - Very Poor</td></tr>
          </table>
        </td>
      </tr>
    </table>
      <br/>
    <?php
    //Read Result Analysis Here
      //$resAnalysis=Module::ReadResultAnalysisp($student,$session,$term);
      $resAnalysis=Analysis::ReadSessionResultAnalysisp($student,$session,$class);
      
      if($term=="First")
      {
        $Position=$resAnalysis['1st_term_position'];
        $Remark=$resAnalysis['1st_term_remark'];
        $Total=round($resAnalysis['1st_term_total'],2);
        $Average=$resAnalysis['1st_term_average'];
        $Grade=$resAnalysis['1st_term_grade'];
      }
      elseif($term=="Second")
      {
        $Position=$resAnalysis['2nd_term_position'];
        $Remark=$resAnalysis['2nd_term_remark'];
        $Total=round($resAnalysis['2nd_term_total'],2);
        $Average=$resAnalysis['2nd_term_average'];
        $Grade=$resAnalysis['2nd_term_grade'];
      }
      elseif($term=="Third")
      {
        $Position=$resAnalysis['3rd_term_position'];
        $Remark=$resAnalysis['3rd_term_remark'];
        $Total=round($resAnalysis['3rd_term_total'],2);
        $Average=$resAnalysis['3rd_term_average'];
        $Grade=$resAnalysis['3rd_term_grade'];
      }
    ?>
    </div>
    <table width="500px" cellspacing="0">
      <tr>
        <td width="100px" class="labelField" style="text-align: right">1st Term Tot</td><td width="150px" class="dataField">
        <?php echo round($resAnalysis['1st_term_total'],2); ?>
        </td>
        <td width="100px" class="labelField" style="text-align: right">1st Aver</td><td width="150px" class="dataField">
          <?php echo $resAnalysis['1st_term_average']; ?>      
        </td>
        <td width="100px" class="labelField" style="text-align: right">1st Term Po</td><td width="150px" class="dataField">
        <?php 
            echo $resAnalysis['1st_term_position']; 
            $stlPos=substr($resAnalysis['1st_term_position'], strlen($resAnalysis['1st_term_position'])-1,1);      
            if($stlPos==1 && $resAnalysis['1st_term_position']!=11)
            {
              echo "<sup>st</sup>";        
            }
            elseif($stlPos==2  && $resAnalysis['1st_term_position']!=12)
            {
              echo "<sup>nd</sup>";        
            }
            elseif($stlPos==3  && $resAnalysis['1st_term_position']!=13)
            {
              echo "<sup>rd</sup>";        
            }
            else
            {
              echo "<sup>th</sup>";
            }
        ?>
        </td></tr>



      <tr>
        <td width="100px" class="labelField" style="text-align: right">2nd Term Tot</td><td width="150px" class="dataField">
        <?php echo round($resAnalysis['2nd_term_total'],2); ?>
        </td>
        <td width="100px" class="labelField" style="text-align: right">2nd Aver</td><td width="150px" class="dataField">
          <?php echo $resAnalysis['2nd_term_average']; ?>      
        </td>
        <td width="100px" class="labelField" style="text-align: right">2nd Term Po</td><td width="150px" class="dataField">
        <?php 
            echo $resAnalysis['2nd_term_position']; 
            $stlPos=substr($resAnalysis['2nd_term_position'], strlen($resAnalysis['2nd_term_position'])-1,1);      
            if($stlPos==1 && $resAnalysis['2nd_term_position']!=11)
            {
              echo "<sup>st</sup>";        
            }
            elseif($stlPos==2  && $resAnalysis['2nd_term_position']!=12)
            {
              echo "<sup>nd</sup>";        
            }
            elseif($stlPos==3  && $resAnalysis['2nd_term_position']!=13)
            {
              echo "<sup>rd</sup>";        
            }
            else
            {
              echo "<sup>th</sup>";
            }
        ?>
        </td></tr>




      <tr>
        <td width="100px" class="labelField" style="text-align: right">3rd Term Tot</td><td width="150px" class="dataField">
        <?php echo round($resAnalysis['3rd_term_total'],2); ?>
        </td>
        <td width="100px" class="labelField" style="text-align: right">3rd Aver</td><td width="150px" class="dataField">
          <?php echo $resAnalysis['3rd_term_average']; ?>      
        </td>
        <td width="100px" class="labelField" style="text-align: right">3rd Term Po</td><td width="150px" class="dataField">
        <?php 
            echo $resAnalysis['3rd_term_position']; 
            $stlPos=substr($resAnalysis['3rd_term_position'], strlen($resAnalysis['3rd_term_position'])-1,1);      
            if($stlPos==1 && $resAnalysis['3rd_term_position']!=11)
            {
              echo "<sup>st</sup>";        
            }
            elseif($stlPos==2  && $resAnalysis['3rd_term_position']!=12)
            {
              echo "<sup>nd</sup>";        
            }
            elseif($stlPos==3  && $resAnalysis['3rd_term_position']!=13)
            {
              echo "<sup>rd</sup>";        
            }
            else
            {
              echo "<sup>th</sup>";
            }
        ?>
        </td></tr>




      <tr style="background: lightgreen">
        <td width="100px" class="labelField" style="text-align: right">Cum. Tot</td><td width="150px" class="dataField">
        <?php echo $resAnalysis['total']; ?>
        </td>
        <td width="100px" class="labelField" style="text-align: right">Cum. Aver</td><td width="150px" class="dataField">
          <?php echo $resAnalysis['average']; ?>      
        </td>
        <td width="100px" class="labelField" style="text-align: right">Cum. Po</td><td width="150px" class="dataField">
        <?php 
            echo $resAnalysis['position']; 
            $stlPos=substr($resAnalysis['position'], strlen($resAnalysis['position'])-1,1);      
            if($stlPos==1 && $resAnalysis['position']!=11)
            {
              echo "<sup>st</sup>";        
            }
            elseif($stlPos==2  && $resAnalysis['position']!=12)
            {
              echo "<sup>nd</sup>";        
            }
            elseif($stlPos==3  && $resAnalysis['position']!=13)
            {
              echo "<sup>rd</sup>";        
            }
            else
            {
              echo "<sup>th</sup>";
            }
        ?>
        </td></tr>

    </table>

    <table>
      <tr>
        <td width="150px" class="labelField">Score Attainable</td><td width="150px" class="dataField"><?php echo (count($Subjects))*100; ?></td>
        <td class="labelField" style="text-align: right;">Score Obtained</td><td colspan="1" class="dataField"><?php echo round(Module::GetGrandTotalp($student,$session,$term,$class),2); ?></td></tr>

      <tr><td width="150px" class="labelField">Position in Class</td><td width="150px" class="dataField">
        <?php

        echo $Position; 
        $lPos=substr($Position, strlen($Position)-1,1);      
        if($lPos==1 && $Position!=11)
        {
          echo "<sup>st</sup>";        
        }
        elseif($lPos==2  && $Position!=12)
        {
          echo "<sup>nd</sup>";        
        }
        elseif($lPos==3  && $Position!=13)
        {
          echo "<sup>rd</sup>";        
        }
        else
        {
          echo "<sup>th</sup>";
        }
        ?></td><td  width="150px" class="labelField" style="text-align: right;">Out of</td><td colspan="1"  width="150px" class="dataField"><?php echo count($Students); ?></td></tr>
      <tr><td width="150px" class="labelField">Attendance</td><td width="150px" class="dataField"><?php echo $attendance; ?></td><td class="labelField" style="text-align: right;">Out of</td>
        <td colspan="1" class="dataField"><?php
        $ses=Module::ReadSessionDetails($session,$term);

         echo $ses['tdays'];  ?></td>
      </tr>
      <!--<tr><td width="150px" class="labelField">Apperance</td><td width="150px" class="dataField"><?php echo $Appearance; ?></td><td class="labelField">Conduct</td><td colspan="1" class="dataField"><?php echo $Conduct; ?></td></tr>
      <tr><td width="150px" class="labelField" >Form Master's Remark</td><td width="150px" class="dataField" colspan="3"><?php echo $FormMasterRemark ?></td></tr>-->
      <tr><td width="150px" class="labelField" >Principal's Remark</td><td width="150px" class="dataField" colspan="3"><?php echo $Remark; ?></td></tr>
      <tr><td width="150px" class="labelField">Next Term Begins</td><td width="150px" class="dataField" colspan="6"><?php echo Module::NextTermBegins($session,$term); ?></td></tr>
    </table>
    <table width="100%">
      <tr>
        <td><br/><br/><a href="presult.php?session=<?php echo base64_encode($session);?>&class=<?php echo $_GET['prclass'];?>&term=<?php echo base64_encode($term);?>&student=<?php echo base64_encode($student);?>" target="_blank"><img src="sign.jpg" style="float: right;"></a></td>
      </tr>
      <tr>
        <td><center> <b>Note:</b> <i>This result is digitally signed and is highly secured</i></center></td>
      </tr>
    </table>
  </div>


</body>
</html>