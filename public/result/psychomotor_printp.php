<?php

include '../Module.php';
$school_details=School::ReadSchoolDetails();
//if(!(isset($Class)))
  $Class=$_GET['classp'];
  
//if(!(isset($Session)))
  $Session=$_GET['sessionp'];
//if(!(isset($Term)))
  $Term=$_GET['termp'];
//if(!(isset($Students)))
  $ss=Module::GetClassSessionp($Class);

  $Students=Module::ReadSessionStudentsp($ss,$Class);


  $subDetails=Module::ReadSubjectDetailsp($Subject);
  $sbjt=$subDetails['subject'];


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >


<head> 
    <link rel="icon" type="image/png" href="../images/school/favicon.png"/>

<style type="text/css">
    hd{
      font-size: 24px;
    }
    hd1{
      font-size: 19px;
    }

    body 
    {
      left-margin:auto;
      right-margin:auto;
      font-size:13px;
    }
    .bheader{
      color: black;
      font-family: times new roman;
      text-align: center;
      font-size: 25px;
    }
    tr:hover{
      background-color: lightgreen;
    }

    thead{
      font-weight: bolder;
      text-align: center;
      font-size: 20px;
    }
    tbody{
      font-size: 25px;
    }
    td{
      padding-right: 0.2%;
      border: 1px solid black;
      font-size:12px;
    }
    .content 
    {
      background-color: white;
      padding-left: 3%;
      padding-right: 3%;
      margin-left: auto;
      margin-right: auto;
      min-height: 700px;
      width: 842;
      page-break-after: always;
    }
    input[type=text]
    {
      background-color: transparent;
      margin: 0px 0px 0px 0px;
      border: 1px solid white;
      width: 100%;
      height: 100%;
      text-align: center;
      font-size: 20px;
      border: none;
    }
    
    input[type="submit"]
    {
      background-color: blue;
      color: white;
      padding: 3px 3px 3px 3px;
    }
    input[type="submit"]:hover
    {
      background-color: lightblue;
      color: black;
    }

    form{
      float: left;
    }

    input[type=text]:focus
    {
      font-weight: bolder;
      background-color: lightblue;
      color: black;
      border-color: lightblue;
    }


    #msgContainer
    {
      background-color: lightblue;
      padding: 15px 15px 15px 15px;
      color: red;
      font-weight: bolder;
      border: 1px solid white;
      text-align: center;
      font-size: 12px;
      position: fixed;
    }

    </style>
    <script type="text/javascript">
      function computeca(field,ca1,ca2,ca3)
      {
        var ca;
        if(ca1=='')
          ca1=0;
        if(ca2=='')
          ca2=0;
        if(ca3=='')
          ca3=0;
        ca=eval(ca1)+eval(ca2)+eval(ca3);
        document.getElementById(field).value=eval(ca);
      }

      function computeexam(field1,field2,field3,ca,exam)
      {
        var ca;
        if(ca=='')
          ca=0;
        if(exam=='')
          exam=0;
        total=eval(ca)+eval(exam);
        document.getElementById(field1).value=eval(total);
        if(total=='')
          total=0;
        if(total<=29){
          grade="F";
          remark="Fail";
        }
        else if(total<=39){
          grade="E";
          remark="Fair";
        }
        else if(total<=49){
          grade="D";
          remark="Pass";
        }
        else if(total<=59){
          grade="C";
          remark="Credit";
        }
        else if(total<=69){
          grade="B";
          remark="Very Good";
        }
        else if(total>=70){
          grade="A";
          remark="Excellent";
        }
        document.getElementById(field2).value=remark;
        document.getElementById(field3).value=grade;
      }

      function saverating(regno,session,term,attendance,attentiveness,neatness,politeness,relationship,curiosity,honesty,help_others,punctuality,leadership,emotional_stability,attitude_to_work)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("msgContainer").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("msgContainer").innerHTML = "Loading...";
          }
        };
        xmlhttp.open("GET", "saveratingsp.php?regno="+regno+
          "&session="+session+
          "&term="+term+
          "&attendance="+attendance+
          "&attentiveness="+attentiveness+
          "&neatness="+neatness+
          "&politeness="+politeness+
          "&relationship="+relationship+
          "&curiosity="+curiosity+
          "&honesty="+honesty+
          "&help_others="+help_others+
          "&punctuality="+punctuality+
          "&leadership="+leadership+
          "&emotional_stability="+emotional_stability+
          "&attitude_to_work="+attitude_to_work
          , true);
        xmlhttp.send();
      }

    </script>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Aleka Academy, Ankpa, Kogi State, Nigeria" />
<title>Psychomotor Rating for <?php echo $Class; ?></title>

</head>

<body  >
<div class="content">
  <header>
    <center><b class="bheader"><b ><hd><?php echo strtoupper($school_details['school_name']); ?></hd></b><br/>
      <hd1><?php echo $Session; ?> <?php echo strtoupper($Term); ?> TERM PSYCHOMOTOR RATING SHEET FOR <?php echo strtoupper("$Class");  ?></hd1> <br/>
      <u>PSYCHOMOTOR DOMAIN RATING</u></b></center>
  </header>

  <table cellspacing="0" width="100%">
     <thead><tr><td  width="40px" valign='top'>REG. NO.</td><td style="width:270px;"  valign='top'>NAME</td><td  valign='top'>ATTENDANCE</td><td  valign='top'>ATTENTIVE</td><td  valign='top'>NEAT</td><td  valign='top'>POLITE</td><td  valign='top'>RELATION</td><td  valign='top'>CURIOSITY</td><td  valign='top'>HONESTY</td><td  valign='top'>HELP</td><td  valign='top'>PUNCT</td><td  valign='top'>LEAD</td><td  valign='top'>EMOT STAB</td><td  valign='top'>ATTIT</td></tr></thead>
    <tbody>
      <?php
      $count=0;
        foreach($Students as $RegNo)
        {

          
          $count++;
          $studentDetails=Module::ReadStudentDetailsp($RegNo);
          $Student=$studentDetails['names'];
          echo "<tr/><td>$RegNo</td><td>$Student</td>";
          $resultData=Module::ReadDomainDetailsp($RegNo,$Session,$Term);
          $attendance=$resultData['attendance'];
          $attentiveness=$resultData['attentiveness'];
          $neatness=$resultData['neatness'];
          $politeness=$resultData['politeness'];
          $relationship=$resultData['relationship'];
          $curiosity=$resultData['curiosity'];
          $honesty=$resultData['honesty'];
          $help_others=$resultData['help_others'];
          $punctuality=$resultData['punctuality'];
          $leadership=$resultData['leadership'];
          $emotional_stability=$resultData['emotional_stability'];
          $attitude_to_work=$resultData['attitude_to_work'];
          
            ?>
              
              <td></td>

              <td></td>


              <td></td>
             

              <td></td>
              
              <td></td>
              
              <td></td>
              
              <td></td>


              <td></td>


              <td></td>


              <td></td>


              <td></td>


              <td></td>

            <?php
        }

      ?>
    </tbody>
    <tfoot></tfoot>
  </table>

  <footer></footer>
</div>

</body>
</html>
