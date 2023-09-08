<?php session_start();

set_time_limit(4800);

include '../Module.php';
$school_details=School::ReadSchoolDetails();
error_reporting(error_reporting() & ~E_NOTICE);


  $Session=$_GET['sessionp'];


  if(!isset($_SESSION['lgina']))
  {
    header("location:../../login.php");
  }
  $ss=Module::GetClassSessionp($Class);

  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >


  <head> 
    <link rel="icon" type="image/png" href="../images/school/favicon.png"/>

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
    <style type="text/css">
      hd{
        font-size: 24px;
      }
      hd1{
        font-size: 19px;
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
        font-size: 20px;
      }
      tr:hover{
        background-color: white;
      }
      tbody{
        font-size: 16px;
      }
      tbody .data{
        text-align: center;
      }
      td{
        padding-right: 0.2%;
        border: 1px solid black;
      }
      .content 
      {
        background-color: white;
        padding-left: 3%;
        padding-right: 3%;
        margin-left: auto;
        margin-right: auto;
        min-height: 700px;
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

      td:focus
      {
        font-weight: bolder;
        background-color: lightblue;
        color: black;
        border-color: lightblue;
      }


      #msgContainer1
      {
        
        padding: 15px 15px 15px 15px;
        color: red;
        font-weight: bolder;
        text-align: center;
        font-size: 12px;
        position: fixed;
        overflow: left;
        background: #4F3611;
      }
    </style>

    <script type="text/javascript">
      function checkkey(event)
      {
        if(event.key=="Enter")
        {
          document.getElementById('msgContainer').innerHTML="Pressing Enter key will create a new line which is not necessary for result processing. <br/>Use Backspace key to clear every new lines to continue.";
          alert('Pressing Enter key is not allowed. \n Press Back space to clear that new line to continue ');
        }
        
      }



      function Current(rowid,subject)
      {
        var students=[];

        students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
            document.getElementById(students[i]+subject).style.backgroundColor="transparent";
        }

        document.getElementById(rowid+subject).style.backgroundColor="purple";
      }

      function validateca(id,subject)
      {
        var ca1=document.getElementById(id+subject+"ca1").innerHTML;
        var ca2=document.getElementById(id+subject+"ca2").innerHTML;
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


        ca1=eval(ca1);
        ca2=eval(ca2);
        exam=eval(exam);



        if(ca1>20)
        {
          document.getElementById(id+subject+"ca1").style.background="RED";
        }
        else
        {
          document.getElementById(id+subject+"ca1").style.background="white";
        }

        if(ca2>20)
        {
          document.getElementById(id+subject+"ca2").style.background="RED";
        }
        else
        {
          document.getElementById(id+subject+"ca2").style.background="white";
        }

        if(exam>60)
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

        ReadScoreDetails(id,total,subject);
      }         

      function ReadScoreDetails(id,total,subject)
      {


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            var response=this.responseText;

            var gradeData=response.split(':');
            document.getElementById(id+subject+"Re").innerHTML = gradeData[2];
            document.getElementById(id+subject+"Gr").innerHTML = gradeData[0];
          }
          else
          {

          }
        };
        xmlhttp.open("GET", "../read_score_grade.php?score="+total, true);
        xmlhttp.send();
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
            document.getElementById("preloader").style.display="none";
            document.getElementById("msgContainer").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("preloader").style.display="block";
            document.getElementById("msgContainer").innerHTML = "Saving Changes";
          }
        };
        xmlhttp.open("GET", "../savescorep.php?student="+id+
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

      function Toast(message) {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar");
        x.innerHTML=message;

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
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

    <title> <?php echo $Session; ?> Result Analysis</title>

  </head>

  <body>

    <div id="menu" style="position: absolute; display: none">

    </div>

    <center><div style="color: white; background-color: lightblue; color:black;" id='rst'></div></center>
    <div class="content" style="background: white;">
      
      <header>
        <b>
        <div class="bheader"><center><b ><hd><?php echo strtoupper($school_details['school_name']); ?></hd></b><br/>
          <hd1><?php echo $Session; ?> RESULT ANALYSIS <br/></div></b>
      </header>
      <?php
      $Classes =Module::ReadAllClassesp();
      foreach($Classes as $Class)
      {

        $ss=Module::GetClassSessionp($Class);

        $Total_Students=count(Module::ReadSessionStudentsp($Session,$Class));
        $Total_Class_Average=Analysis::GetSessionClassAverage($Class,$Session);

        $Total_Max=Analysis::GetSessionClassMaximumAverage($Class,$Session);

        $Total_Min=Analysis::GetSessionClassMinimumAverage($Class,$Session);

        ?>
        <style type="text/css">
          td{
            text-align: center;
          }
        </style>
        <h2><?php echo $Class; ?></h2>
        <h3>POPULATION = <?php echo $Total_Students;?></h3>
        <h3>CLASS AVERAGE = <?php echo $Total_Class_Average/$Total_Students; ?></h3>
        <h3>CLASS MAXIMUM = <?php echo $Total_Max; ?> </h3>
        <h3>CLASS MINIMUM = <?php echo $Total_Min; ?> </h3>
        <table cellspacing="0" width="100%">
          <tr><td>A1</td><td>B2</td><td>B3</td><td>C</td><td>D</td><td>E</td><td>F</td></tr>

          <tr><td><?php echo Analysis::CountSessionGrade($Class,$Session,"A1"); ?></td><td><?php echo Analysis::CountSessionGrade($Class,$Session,"B2"); ?></td><td><?php echo Analysis::CountSessionGrade($Class,$Session,"B3"); ?></td><td><?php echo Analysis::CountSessionGrade($Class,$Session,"C"); ?></td><td><?php echo Analysis::CountSessionGrade($Class,$Session,"D"); ?></td><td><?php echo Analysis::CountSessionGrade($Class,$Session,"E"); ?></td><td><?php echo Analysis::CountSessionGrade($Class,$Session,"F"); ?></td></tr>
        </table>

        <!--

        <h3>FAILURE IN ENGLISH = </h3>
        <h3>FAILURE IN MATHEMATICS = </h3>
        <h3>PROMOTION = </h3>
        <h3>REPEAT = </h3> -->
        <br/>
        <hr/>

        <?php

      }
      ?>
              

    </div>
  </body>
  </html>
  <?php 


?>



  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <div id="preloader" style="display: none">
    <div id="loader"><b style="color: white; background: red; padding: 5px 5px 5px 5px">Please Wait</b></div>
  </div>

  <!-- The actual snackbar -->
  <div id="snackbar"></div>