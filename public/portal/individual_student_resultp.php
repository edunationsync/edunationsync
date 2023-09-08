<?php session_start();

set_time_limit(2400);

include '../Module.php';
error_reporting(error_reporting() & ~E_NOTICE);


  $student=$_GET['student'];


  $studentDetails=Module::ReadStudentDetailsp($student);

//if(!(isset($Class)))
  $class=$_GET['class'];

//if(!(isset($Session)))
  $session=$_GET['session'];
  $term=$_GET['term'];
  $ss=Module::GetClassSessionp($class);


  $current=Module::ReadCurrentSession();

  if(strtolower($session)==strtolower($current['session']) && strtolower($term)==strtolower($current['term']))
  {
    $editStatus='true';
  }
  else
  {
    $editStatus='false';
  }

$studentDetails=Module::ReadStudentDetailsp($student);
$studentName=$studentDetails['names'];

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

    .menuBtn{
      background: blue;
      color: white;
      padding: 5px 5px 5px 5px;
      border-radius: 20px;
    }

    .menuBtn:hover{
      background: lightblue;
      color: black;
    }
</style>

  <style type="text/css">
    /* The snackbar - position it at the bottom and in the middle of the screen */
    #snackbar {
      visibility: hidden; /* Hidden by default. Visible on click */
      min-width: 250px; /* Set a default minimum width */
      margin-left: -125px; /* Divide value of min-width by 2 */
      background-color: #333; /* Black background color */
      color: #fff; /* White text color */
      text-align: center; /* Centered text */
      border-radius: 2px; /* Rounded borders */
      padding: 16px; /* Padding */
      position: fixed; /* Sit on top of the screen */
      z-index: 1; /* Add a z-index if needed */
      left: 50%; /* Center the snackbar */
      bottom: 30px; /* 30px from the bottom */
    }

    /* Show the snackbar when clicking on a button (class added with JavaScript) */
    #snackbar.show {
      visibility: visible; /* Show the snackbar */
      /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
      However, delay the fade out process for 2.5 seconds */
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    /* Animations to fade the snackbar in and out */
    @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }

    .navmenu{
      padding: 4px 4px 4px 4px;
      background: white;
      color: black;
    }
    .navmenu a{
      border: 1px groove black;
      text-decoration: none;
      text-transform: uppercase;
      text-decoration: none;
      padding: 5px 5px 5px 5px;
      margin: 5px 5px 5px 5px;
      background: lightgreen;
    }

    .navmenu a:hover{
      background: lightblue;
    }
  </style>

<script type="text/javascript">
      function Toast(message) {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar");
        x.innerHTML=message;

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
      }

      function checkkey(event)
      {
        if(event.key=="Enter")
        {
          document.getElementById('msgContainer').innerHTML="Pressing Enter key will create a new line which is not necessary for result processing. <br/>Use Backspace key to clear every new lines to continue.";
          alert('Pressing Enter key is not allowed. \n Press Back space to clear that new line to continue ');
        }
        
      }

      function validateca(id,subject)
      {
        var ca1=document.getElementById(id+subject+"ca1").innerHTML;
        var ca2=document.getElementById(id+subject+"ca2").innerHTML;
        var ca3=document.getElementById(id+subject+"ca3").innerHTML;
        var exam=document.getElementById(id+subject+"exam").innerHTML;

        if(exam==''){
          exam=0;
        }
        else if(exam.substr(exam.length-4)=="<br>")
        {
          exam=exam.substr(0,exam.length-4);

          if(exam=='')
          {
            exam=0;
          }
        }

        if(ca1==''){
          ca1=0;
        }
        else if(ca1.substr(ca1.length-4)=="<br>")
        {
          ca1=ca1.substr(0,ca1.length-4);

          if(ca1=='')
          {
            ca1=0;
          }
        }

        if(ca2==''){
          ca2=0;
        }
        else if(ca2.substr(ca2.length-4)=="<br>")
        {
          ca2=ca2.substr(0,ca2.length-4);
          if(ca2=='')
          {
            ca2=0;
          }
        }

        if(ca3==''){
          ca3=0;
        }
        else if(ca3.substr(ca3.length-4)=="<br>")
        {
          ca3=ca3.substr(0,ca3.length-4);
          if(ca3=='')
          {
            ca3=0;
          }
        }


        ca1=eval(ca1);
        ca2=eval(ca2);
        ca3=eval(ca3);
        exam=eval(exam);



        if(ca1>10)
        {
          document.getElementById(id+subject+"ca1").style.background="RED";
        }
        else
        {
          document.getElementById(id+subject+"ca1").style.background="white";
        }

        if(ca2>10)
        {
          document.getElementById(id+subject+"ca2").style.background="RED";
        }
        else
        {
          document.getElementById(id+subject+"ca2").style.background="white";
        }

        if(ca3>10)
        {
          document.getElementById(id+subject+"ca3").style.background="RED";
        }
        else
        {
          document.getElementById(id+subject+"ca3").style.background="white";
        }

        if(exam>70)
        {
          document.getElementById(id+subject+"exam").style.background="RED";
        }
        else
        {
          document.getElementById(id+subject+"exam").style.background="white";
        }
      }

      function computeresult(id,subject)
      {
        var ca,total,cat;
        var ca1=document.getElementById(id+subject+"ca1").innerHTML;
        var ca2=document.getElementById(id+subject+"ca2").innerHTML;
        var ca3=document.getElementById(id+subject+"ca3").innerHTML;
        var exam=document.getElementById(id+subject+"exam").innerHTML;

        if(exam==''){
          exam=0;
        }
        else if(exam.substr(exam.length-4)=="<br>")
        {
          exam=exam.substr(0,exam.length-4);

          if(exam=='')
          {
            exam=0;
          }
        }

        if(ca1==''){
          ca1=0;
        }
        else if(ca1.substr(ca1.length-4)=="<br>")
        {
          ca1=ca1.substr(0,ca1.length-4);

          if(ca1=='')
          {
            ca1=0;
          }
        }

        if(ca2==''){
          ca2=0;
        }
        else if(ca2.substr(ca2.length-4)=="<br>")
        {
          ca2=ca2.substr(0,ca2.length-4);
          if(ca2=='')
          {
            ca2=0;
          }
        }

        if(ca3==''){
          ca3=0;
        }
        else if(ca3.substr(ca3.length-4)=="<br>")
        {
          ca3=ca3.substr(0,ca3.length-4);
          if(ca3=='')
          {
            ca3=0;
          }
        }
        cat=eval(ca1)+eval(ca2)+eval(ca3);
        total=eval(cat)+eval(exam);

        document.getElementById(id+subject+"exT").innerHTML = eval(total);
        document.getElementById(id+subject+"caT").innerHTML = eval(cat);

        if(total=='')
          total=0;
        if(total<=39){
          grade="F";
          remark="Fail";
        }
        else if(total<=44){
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
        else if(total<=79){
          grade="A";
          remark="Excellent";
        }
        else if(total>=80){
          grade="A+";
          remark="Excellent";
        }
        document.getElementById(id+subject+"Re").innerHTML = remark;
        document.getElementById(id+subject+"Gr").innerHTML = grade;
      }      

      function testSaveScore(session,term,classs)
      {
        var subjects=[];
        var count=0;
        subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($class)); ?>');
        students=JSON.parse('<?php echo json_encode($Students); ?>');
        for (var s = students.length - 1; s >= 0; s--) {
          count++;
          for (var i = subjects.length - 1; i >= 0; i--) {
            //document.getElementById(students[i]+"exam").contentEditable="false";
            //alert(subjects[i]);
            savescore(students[s],subjects[i],session,term,classs);

          }
        }
      }

      function savescore(id,subject,session,term,classs)
      {

        var catotal=document.getElementById(id+subject+"caT").innerHTML;
        var total=document.getElementById(id+subject+"exT").innerHTML;
        var remark=document.getElementById(id+subject+"Re").innerHTML;
        var grade=document.getElementById(id+subject+"Gr").innerHTML;
        var ca1=document.getElementById(id+subject+"ca1").innerHTML;
        var ca2=document.getElementById(id+subject+"ca2").innerHTML;
        var ca3=document.getElementById(id+subject+"ca3").innerHTML;
        var exam=document.getElementById(id+subject+"exam").innerHTML;


        if(exam==''){
          exam=0;
        }
        else if(exam.substr(exam.length-4)=="<br>")
        {
          exam=exam.substr(0,exam.length-4);

          if(exam=='')
          {
            exam=0;
          }
        }

        if(ca1==''){
          ca1=0;
        }
        else if(ca1.substr(ca1.length-4)=="<br>")
        {
          ca1=ca1.substr(0,ca1.length-4);

          if(ca1=='')
          {
            ca1=0;
          }
        }

        if(ca2==''){
          ca2=0;
        }
        else if(ca2.substr(ca2.length-4)=="<br>")
        {
          ca2=ca2.substr(0,ca2.length-4);
          if(ca2=='')
          {
            ca2=0;
          }
        }

        if(ca3==''){
          ca3=0;
        }
        else if(ca3.substr(ca3.length-4)=="<br>")
        {
          ca3=ca3.substr(0,ca3.length-4);
          if(ca3=='')
          {
            ca3=0;
          }
        }


        if(exam=='')
          exam=0;
        if(ca1=='')
          ca1=0;
        if(ca2=='')
          ca2=0;
        if(ca3=='')
          ca3=0;
        if(catotal=='')
          catotal=0;
        if(total=='')
          total=0;


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            Toast(this.responseText);
          }
          else
          {
            Toast("Saving Changes");
          }
        };
        xmlhttp.open("GET", "../result/savescorep.php?student="+id+
          "&subject="+subject+
          "&session="+session+
          "&term="+term+
          "&ca1="+ca1+
          "&ca2="+ca2+
          "&ca3="+ca3+
          "&catotal="+catotal+
          "&exam="+exam+
          "&total="+total+
          "&remark="+remark+
          "&grade="+grade+
          "&class="+classs
          , true);
        xmlhttp.send();
      }

      function CA1Only()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        
      }

      function CA2Only()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"ca1").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        
      }

      

      function ExamOnly()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="false";
          document.getElementById(students[i]+"ca2").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        
      }

      function BothCA()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        
      }
      
      function AllScores()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        
      }


      function  print(elem)
      {
        var mywindow=window.open('','PRINT','height=auto,width=auto');
        mywindow.document.write('');
        mywindow.document.write('<body>'+document.getElementById(elem).innerHTML+'</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
      }

      function exportTableToExcel(tableID, filename = ''){
          var downloadLink;
          var dataType = 'application/vnd.ms-excel';
          var tableSelect = document.getElementById(tableID);
          var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
          
          // Specify file name
          filename = filename?filename+'.xls':document.title+'.xls';
          
          // Create download link element
          downloadLink = document.createElement("a");
          
          document.body.appendChild(downloadLink);
          
          if(navigator.msSaveOrOpenBlob){
              var blob = new Blob(['\ufeff', tableHTML], {
                  type: dataType
              });
              navigator.msSaveOrOpenBlob( blob, filename);
          }else{
              // Create a link to the file
              downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
          
              // Setting the file name
              downloadLink.download = filename;
              
              //triggering the function
              downloadLink.click();
          }
      }

      function toggleMenu()
      {

        if(document.getElementById('menu').style.display=='none')
        {
          document.getElementById('menu').style.display='block';
          document.getElementById('btnMenu').innerHTML='Hide Menu';
        }
        else
        {          
          document.getElementById('menu').style.display='none';
          document.getElementById('btnMenu').innerHTML='Show Menu';
        }
      }
</script>
   
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<title> <?php echo $student; ?> <?php echo $session; ?> <?php echo $term; ?> Term Result Verifier</title>

</head>

<body style="background: #353A40" >

    <div style="color:black; position: absolute;" id='msgContainer' onclick="this.style.display='none'"></div>
    <div style=" color:black; position: relative; width: 200px; float: left;  border-right: 5px white groove " id='menu'>
      <a href="../dashboard"><button style="width: 99%">Dashboard</button> </a> <a href="../result/"><button style="width: 99%">Result Dashboard</button> </a>
      <div>
        <b style="color: white">List of Students:</b><br/>
        <?php 

        $Students=Module::ReadSessionStudentsp($ss,$class);
        foreach($Students as $regno)
        { 

          $regnoDetails=Module::ReadStudentDetailsp($regno);
          $regnoName=$regnoDetails['names'];
          if(!($student==$regno))
          {
            ?>
            <p style="background: #353A40; color: white; border-bottom: 3px groove white; "><a href="individual_student_resultp.php?student=<?php echo $regno; ?>&session=<?php echo $_GET['session']; ?>&class=<?php echo $_GET['class']; ?>&term=<?php echo $_GET['term']; ?>" style="background: #353A40; color: white; text-transform: uppercase; text-decoration: none;"><?php echo $regno." <br/>".$regnoName; ?></a></p>
            <?php 
          }
          else
          {
            ?>
            <p style="background: white; color: black; border-bottom: 3px groove white;  "><a href="individual_student_resultp.php?student=<?php echo $regno; ?>&session=<?php echo $_GET['session']; ?>&class=<?php echo $_GET['class']; ?>&term=<?php echo $_GET['term']; ?>" style="background: white; color: black; text-transform: uppercase; text-decoration: none; "><?php echo $regno." <br/>".$regnoName; ?></a></p>
            <?php           
          }
        }

        ?>
      </div>

    </div>
    <?php 
    if(!(isset($_GET['student'])))
    {
      ?>

      <div class="content" style="background: white;">
        <BR/>
        <hr style="border: 2px groove white">
        <center><b style="font-family: calibri; font-size: 20px;"><u>SELECT STUDENT FROM THE RIGHT SIDE BAR</u></b></center>
        <div style="padding-left: 7PX; padding-right: 5%; padding-top: 2%; width: 100%">
        Select the student from the student list to start verifying results now.
          <br/>
        </div>
      </div>
      <?php
    }
    else
    {
      ?>      
      <div class="content" style="background: white;">
        <BR/>
        <hr style="border: 2px groove white">
        <center><b style="font-family: calibri; font-size: 20px;"><u><?php echo strtoupper($studentName); ?> RESULT ENTRY VERIFIER</u></b></center>
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
          <tr><td class="labelField">REG NO</td><td class="dataField"><?php echo $student; ?></td></tr>
          <tr><td width="120px" class="labelField">NAME</td><td colspan="3" class="dataField"><?php echo $studentName; ?></td></tr>
          <tr><td width="70px" class="labelField">TERM</td><td width="150px" class="dataField"><?php echo $term; ?></td></tr>
          <tr><td width="50px" class="labelField">SESSION</td><td width="150px" class="dataField"><?php echo $session; ?></td></tr>
          <tr><td width="40px" class="labelField">CLASS</td><td width="150px" class="dataField"><?php echo $cl; ?></td></tr>
          
        </table>
        <table width="100%">
          <tr>
            <td width="90%" valign="top">
            <table width="95%" cellspacing="0" style="padding-top: 5px;">
              <tr>
                <td class="labelFieldHdFirst" width="90px" >SUBJECT</td>
                <td class="labelFieldHd" width="30px" >CA1 (10)</td>
                <td class="labelFieldHd" width="30px" >CA2 (10)</td>
                <td class="labelFieldHd" width="30px" >CA3 (10)</td>
                <td class="labelFieldHd" width="30px" >CAT (30)</td>
                <td class="labelFieldHd" width="30px" >TERM EXAM (70)</td>
                <td class="labelFieldHd" width="30px" >TERM TOTAL (100)</td>
                <!--<td class="labelFieldHd" width="30px" >CLASS AVER</td>-->
                <td class="labelFieldHd" width="30px" >POS</td>
                <td class="labelFieldHd" width="30px" >GRADE</td>
                <td class="labelFieldHd" width="30px" >REMARK</td>
              </tr>

              <?php
              $subjectCount=0;

              $Subjects=Module::ReadClassSubjectsp($class);
              $subjectTotal=count($Subjects);

              foreach($Subjects as $Subject)
              {
                $resultData=Module::ReadSubjectResultp($student,$Subject,$session,$term);
                $subjectCount++;
                  //First Subject
                  ?>
                  <tr  id="<?php echo $student;?>" onkeyup="checkkey(event);validateca(this.id,'<?php echo $Subject; ?>'); computeresult(this.id,'<?php echo $Subject; ?>');
                    savescore(this.id,
                                  '<?php echo $Subject; ?>',
                                 '<?php echo $session; ?>',
                                 '<?php echo $term; ?>',
                                 '<?php echo $class; ?>')">
                    <td class="subjectFieldBody" ><?php echo $Subject; ?></td>
                    <td class="dataFieldBodyFirst" id="<?php echo $student.$Subject;?>ca1"  contenteditable="<?php echo $editStatus; ?>"><?php  echo $resultData['ca1'];  ?></td>
                    <td class="dataFieldBodyFirst" id="<?php echo $student.$Subject;?>ca2"  contenteditable="<?php echo $editStatus; ?>"><?php  echo $resultData['ca2'];  ?></td>
                    <td class="dataFieldBodyFirst" id="<?php echo $student.$Subject;?>ca3"  contenteditable="<?php echo $editStatus; ?>"><?php  echo $resultData['ca3'];  ?></td>
                    <td class="dataFieldBodyFirst" id="<?php echo $student.$Subject;?>caT" ><?php  echo $resultData['catotal'];  ?></td>
                    <td class="dataFieldBodyFirst" id="<?php echo $student.$Subject;?>exam"   contenteditable="<?php echo $editStatus; ?>"><?php 
                    if(isset($resultData['exam'])) 
                      echo $resultData['exam'];  
                    else
                      echo "";

                    ?></td>
                    <td class="dataFieldBodyFirst"  id="<?php echo $student.$Subject;?>exT"><?php 
                    if(isset($resultData['total'])) 
                      echo $resultData['total'];  
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
                    <td class="dataFieldBodyFirst"  id="<?php echo $student.$Subject;?>Gr"><?php  
                    if(isset($resultData['grade'])) 
                      echo $resultData['grade'];  
                    else
                      echo "-"; ?></td>
                    <td class="dataFieldBodyFirst"  id="<?php echo $student.$Subject;?>Re"><?php  
                    if(isset($resultData['remark'])) 
                      echo $resultData['remark'];  
                    else
                      echo "-"; ?></td>
                  </tr>

                  <?php
              }
              ?>

              <tr><td class="labelFieldHdFirst" style="text-align: center"></td><td class="labelFieldHdLast" colspan="8"></td></tr>
            </table>
            </td>
          </tr>
        </table>
          <br/>
        </div>

        <table width="100%">
          <tr>
            <td><center> <b>Note:</b> <i>This result is digitally signed and is highly secured</i></center></td>
          </tr>
        </table>
      </div>

      <?php
    }
    ?>
</body>
</html>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <!-- The actual snackbar -->
  <div id="snackbar"></div>

  <div id="preloader" style="display: none">
    <div id="loader"><b style="color: white; background: red; padding: 5px 5px 5px 5px">Please Wait</b></div>
  </div>