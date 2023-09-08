<?php session_start();
include '../Module.php';
$school_details=School::ReadSchoolDetails();
//if(!(isset($Class)))
  $Class=$_GET['classp'];
//if(!(isset($Session)))
  $Session=$_GET['sessionp'];
//if(!(isset($Term)))
  $Term=$_GET['termp'];

  $Subject=$_GET['subjectp'];



$BestStudents=Module::ReadSessionSubjectAnalysis1stpositionsp($Session);
?>

<!DOCTYPE html>
<html lang="en">

<head> 
    <link rel="icon" type="image/png" href="../images/school/favicon.png"/>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Session Subject Summary Sheet <?php echo $Class.' '.$Session.' '.$Subject; ?></title>
  <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../dashboard/css/sb-admin.css" rel="stylesheet">

  <style type="text/css">
    select{
      width: 98%;
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

      function SpeakOut(text)
      {

        if(document.getElementById('verifier').checked)
        {
          if(text==="")
          {
            text="Nothing";
          }

          var msg=new SpeechSynthesisUtterance(text);
          msg.volume=10.0;
          msg.lang='en-US';
          msg.volume=1;
          msg.rate=1;
          msg.pitch=0;
          window.speechSynthesis.speak(msg);
        }
        else
        {
        }
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

      function checkkey(event)
      {
        if(event.key=="Enter")
        {
          document.getElementById('msgContainer').innerHTML="Pressing Enter key will create a new line which is not necessary for result processing. <br/>Use Backspace key to clear every new lines to continue.";
          alert('Pressing Enter key is not allowed. \n Press Back space to clear that new line to continue ');
        }
        
      }

      function validateca(id)
      {
        var ca1=document.getElementById(id+"ca1").innerHTML;
        var ca2=document.getElementById(id+"ca2").innerHTML;
        var exam=document.getElementById(id+"exam").innerHTML;

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
          document.getElementById(id+"ca1").style.background="RED";
        }
        else
        {
          document.getElementById(id+"ca1").style.background="white";
        }

        if(ca2>20)
        {
          document.getElementById(id+"ca2").style.background="RED";
        }
        else
        {
          document.getElementById(id+"ca2").style.background="white";
        }

        if(exam>60)
        {
          document.getElementById(id+"exam").style.background="RED";
        }
        else
        {
          document.getElementById(id+"exam").style.background="white";
        }
      }

      function computeresult(id)
      {
        var ca,total,cat;
        var ca1=document.getElementById(id+"ca1").innerHTML;
        var ca2=document.getElementById(id+"ca2").innerHTML;
        var exam=document.getElementById(id+"exam").innerHTML;

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
        cat=eval(ca1)+eval(ca2);
        total=eval(cat)+eval(exam);

        document.getElementById(id+"exT").innerHTML = eval(total);
        document.getElementById(id+"caT").innerHTML = eval(cat);

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
        document.getElementById(id+"Re").innerHTML = remark;
        document.getElementById(id+"Gr").innerHTML = grade;
      }



      function testSaveScore(subject,session,session,term,classs)
      {
        var subjects=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');
        for (var s = students.length - 1; s >= 0; s--) {
            savescore(students[s],subject,session,term,classs);
        }

      }



      function savescore(id,subject,session,term,classs)
      {

        var catotal=document.getElementById(id+"caT").innerHTML;
        var total=document.getElementById(id+"exT").innerHTML;
        var remark=document.getElementById(id+"Re").innerHTML;
        var grade=document.getElementById(id+"Gr").innerHTML;
        var ca1=document.getElementById(id+"ca1").innerHTML;
        var ca2=document.getElementById(id+"ca2").innerHTML;
        var exam=document.getElementById(id+"exam").innerHTML;


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


        if(exam=='')
          exam=0;
        if(ca1=='')
          ca1=0;
        if(ca2=='')
          ca2=0;
        if(catotal=='')
          catotal=0;
        if(total=='')
          total=0;


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            cleanresult();
            document.getElementById("preloader").style.display="none";
            Toast(this.responseText);
            //document.getElementById("msgContainer").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("preloader").style.display="block";
            document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;

          }
        };
        xmlhttp.open("GET", "../savescorep.php?student="+id+
          "&subject="+subject+
          "&session="+session+
          "&term="+term+
          "&ca1="+ca1+
          "&ca2="+ca2+
          "&catotal="+catotal+
          "&exam="+exam+
          "&total="+total+
          "&remark="+remark+
          "&grade="+grade+
          "&class="+classs
          , true);
        xmlhttp.send();
      }

      function cleanresult()
      {


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("preloader").style.display="none";
            document.getElementById("msgContainer").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("preloader").style.display="block";
            document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;
          }
        };
        xmlhttp.open("GET", "../clean_resultp.php" , true);
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

      function ProcessSessionSubjectClassPositions(session,classs,subject)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              //UpdatePositions(subject,session,term);
              document.getElementById("entryMsg").innerHTML=this.responseText;              
              document.getElementById("loader").innerHTML="Successfull";
              document.getElementById("preloader").style.display="none";
              //document.getElementById("msgContainer").innerHTML = this.responseText;
            }
            else
            {
              document.getElementById("entryMsg").innerHTML="Processing Positions";
              document.getElementById("loader").innerHTML="Processing...";
              document.getElementById("preloader").style.display="block";
              //document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;
            }
          };
          xmlhttp.open("GET", "generate_session_subject_positions.php?session="+session+'&class='+classs+'&subject='+subject , true);
          xmlhttp.send();
        }

      function ClearSessionClassPositions(session,classs)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              //UpdatePositions(subject,session,term);
              document.getElementById("entryMsg").innerHTML=this.responseText;              
              document.getElementById("loader").innerHTML="Successfull";
              document.getElementById("preloader").style.display="none";
              //document.getElementById("msgContainer").innerHTML = this.responseText;
            }
            else
            {
              document.getElementById("entryMsg").innerHTML="Processing Positions";
              document.getElementById("loader").innerHTML="Processing...";
              document.getElementById("preloader").style.display="block";
              //document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;
            }
          };
          xmlhttp.open("GET", "generate_session_positions.php?session="+session+'&class='+classs+'&operation=clear_position' , true);
          xmlhttp.send();
        }


        function ProcessClassPositions(sub,session,term,classs)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              //UpdatePositions(subject,session,term);
              document.getElementById("entryMsg").innerHTML=this.responseText;              
              document.getElementById("loader").innerHTML="Successfull";
              document.getElementById("preloader").style.display="none";
              //document.getElementById("msgContainer").innerHTML = this.responseText;
            }
            else
            {
              document.getElementById("entryMsg").innerHTML="Processing Positions";
              document.getElementById("loader").innerHTML="Processing...";
              document.getElementById("preloader").style.display="block";
              //document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;
            }
          };
          xmlhttp.open("GET", "master_sheet/generate_positions.php?session="+session+'&term='+term+'&class='+classs+'&sub='+sub , true);
          xmlhttp.send();
        }

        function ClearClassPositions(sub,session,term,classs)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              //UpdatePositions(sub,session,term);
              document.getElementById("entryMsg").innerHTML="Positions Cleared";
              document.getElementById("loader").innerHTML="Successfull";
              document.getElementById("preloader").style.display="none";
              //document.getElementById("msgContainer").innerHTML = this.responseText;
            }
            else
            {
              document.getElementById("entryMsg").innerHTML="Clearing Positions";
              document.getElementById("loader").innerHTML="Processing...";
              document.getElementById("preloader").style.display="block";
              //document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;
            }
          };
          xmlhttp.open("GET", "master_sheet/generate_positions.php?session="+session+'&term='+term+'&operation=clear_position'+'&sub='+sub+'&class='+classs , true);
          xmlhttp.send();
        }


        function UpdateRemarkManually(reg_no,session,term,classs,remark)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              document.getElementById("entryMsg").innerHTML= this.responseText;
              Toast(this.responseText);
              document.getElementById("loader").innerHTML="Successfull";
              document.getElementById("preloader").style.display="none";
            }
            else
            {
              document.getElementById("entryMsg").innerHTML= this.responseText;
              document.getElementById("loader").innerHTML="Processing...";
              document.getElementById("preloader").style.display="block";
            }
          };
          xmlhttp.open("GET", "update_remark_manually.php?session="+session+'&term='+term+'&reg_no='+reg_no+'&class='+classs+'&remark='+remark , true);
          xmlhttp.send();
        }

        function ProcessPositions(sub,session,term,classs)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              //UpdatePositions(sub,session,term);
              document.getElementById("entryMsg").innerHTML=this.responseText;
              document.getElementById("loader").innerHTML="Successfull";
              document.getElementById("preloader").style.display="none";
              //document.getElementById("msgContainer").innerHTML = this.responseText;
            }
            else
            {
              document.getElementById("entryMsg").innerHTML="Processing Positions";
              document.getElementById("loader").innerHTML="Processing...";
              document.getElementById("preloader").style.display="block";
              //document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;
            }
          };
          xmlhttp.open("GET", "master_sheet/generate_positions.php?sub="+sub+'&session='+session+'&term='+term+'&class='+classs , true);
          xmlhttp.send();
        }
        
        function UpdateAnalysis(classs,session,term)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              response=this.responseText;
              document.getElementById("loader").innerHTML="Successful";
              document.getElementById("preloader").style.display="none";
              document.getElementById("entryMsg").innerHTML=this.responseText;
            }
            else
            {
              document.getElementById("entryMsg").innerHTML="Updating...";
              document.getElementById("loader").innerHTML="Updating...";
              document.getElementById("preloader").style.display="block";
              //document.getElementById("testPanel").innerHTML = "Loading...";
            }
          };
          xmlhttp.open("GET", "update_analysis.php?session="+session+'&term='+term+'&class='+classs, true);
          xmlhttp.send();
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

      function toggleMenu(btn,menu)
      {

        if(document.getElementById(menu).style.display=='none')
        {
          document.getElementById(menu).style.display='block';
          document.getElementById(btn).innerHTML='Hide Menu';
        }
        else
        {          
          document.getElementById(menu).style.display='none';
          document.getElementById(btn).innerHTML='Show Menu';
        }
      }

  </script>
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


      button{
        background-color: blue;
        color: white;
        font-weight: bolder;
      }
      button:hover{
        background-color: lightblue;
        color: black;
        font-weight: bolder;
      }

      #msgContainer1
      {
        
        padding: 15px 15px 15px 15px;
        color: yellow;
        font-weight: bolder;
        text-align: center;
        font-size: 12px;
        overflow: left;
        background: #4F3611;
        min-height: 120px;
      }
    </style>
</head>

<body id="page-top">
  <div>

    <div>

      <div>

        <!-- Icon Cards-->
      <div> 
        <!--CA Sheet Content start-->
        <div class="content" id="content" style="padding:20px 20px 20px 20px">
          <header>
            <b>
            <div class="bheader"><center ><img src="../images/school/logo.png" width="100px"/><br/><b ><hd><?php echo strtoupper($school_details['school_name']); ?></hd></b><br/>BEST SESSION SUBJECT RESULT SUMMARY<BR/>
                <?php echo $Session; ?> ACADEMIC SESSION </center></div></b>
          </header>

          



          <table cellspacing="0" width="100%" id="tableData" border="0">
            <tr>
              <td style="border:none">
                  <table cellspacing="0" width="100%">
                    
                    <thead>
                      <tr>
                        <td  width="40px"  valign="top">REG. NO.</td><td  valign="top" style="width: 300px">NAME</td><td  valign="top" style="width: 300px">CLASS</td><td  valign="top" style="width: 300px">SUBJECT</td>

                        <td width="5px" valign="top">CA1 TOT</td><td width="5px" valign="top">CA1 AVR</td><td width="5px" valign="top">CA1 POS</td><td width="5px" valign="top">CA1 GR</td><td width="5px" valign="top">CA1 REM</td> 

                        <td width="5px" valign="top">CA2 TOT</td><td width="5px" valign="top">CA2 AVR</td><td width="5px" valign="top">CA2 POS</td><td width="5px" valign="top">CA2 GR</td><td width="5px" valign="top">CA2 REM</td>

                        <td width="5px" valign="top">EXAM TOT</td><td width="5px" valign="top">EXAM AVR</td><td width="5px" valign="top">EXAM POS</td><td width="5px" valign="top">EXAM GR</td><td width="5px" valign="top">EXAM REM</td>

                        <td width="5px" valign="top">TOTAL</td><td width="5px" valign="top">AVERAGE</td><td width="5px" valign="top">POSITION</td><td width="5px" valign="top">GRADE</td><td width="5px" valign="top">REMARK</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count=0;

                      foreach($BestStudents as $ID)
                      {
                        $resAnalysis=Module::ReadSessionSubjectResultAnalysisp($ID);
                        $count++;

                        $studentDetails=Module::ReadStudentDetailsp($resAnalysis['reg_no']);
                        $Student=$studentDetails['names'];
                        ?>

                        <tr>
                                          
                          <?php 
                          if(isset($_SESSION['lgina']) && $_SESSION['post']=="assistant headmistress" ||$_SESSION['post']=="assistant headmaster"||$_SESSION['post']=="webmaster" ||$_SESSION['post']=="exams & records")
                          {
                            ?>
                            <td><a style="background:transparent; border:none;" href="../dashboard/users/editstudentprofile.php?id=<?php echo $RegNo; ?>" title="Modify Profile"><center><?php echo $resAnalysis['reg_no']; ?></center></a></td>

                          <td  onclick="togglePassport('<?php echo $RegNo;?>imgid')"><?php echo $Student; ?><a style="background:transparent; border:none;" href="../dashboard/users/changestudentpassport.php?id=<?php echo $RegNo; ?>" title="Change Picture"><img style="display: none" class="img-profile" src="<?php echo 'data:image/jpeg;base64,'.$studentDetails['passport'];?>" id="<?php echo $RegNo;?>imgid"></a></td>
                            <?php
                          }
                          else
                          {
                            ?>
                            <td><center><?php echo $resAnalysis['reg_no']; ?></center></td>

                          <td onclick="togglePassport('<?php echo $RegNo;?>imgid')"><?php echo $Student; ?></td>
                            <?php
                          }

                        ?>

                          <td class="data" id="<?php echo $RegNo; ?>ca1T"><?php echo $resAnalysis['class']; ?></td>
                          <td class="data" id="<?php echo $RegNo; ?>ca1Avr" ><?php echo $resAnalysis['subject']; ?></td>



                          <td class="data" id="<?php echo $RegNo; ?>ca1T"><?php echo $resAnalysis['ca1_total']; ?></td>
                          <td class="data" id="<?php echo $RegNo; ?>ca1Avr" ><?php echo $resAnalysis['ca1_average']; ?></td>
                          <td class="data" id="<?php echo $RegNo; ?>ca1Avr">                            
                            <?php if($resAnalysis['ca1_position']>0){ echo $resAnalysis['ca1_position'];

                              $l1Pos=substr($resAnalysis['ca1_position'], strlen($resAnalysis['ca1_position'])-1,1);      
                              if($l1Pos==1 && $resAnalysis['ca1_position']!=11)
                              {
                                echo "<sup>st</sup>";        
                              }
                              elseif($l1Pos==2  && $resAnalysis['ca1_position']!=12)
                              {
                                echo "<sup>nd</sup>";        
                              }
                              elseif($l1Pos==3  && $resAnalysis['ca1_position']!=13)
                              {
                                echo "<sup>rd</sup>";        
                              }
                              elseif($l1Pos=='' || $resAnalysis['ca1_position']=0)
                              {
                                echo "<sup></sup>";        
                              }
                              else
                              {
                                echo "<sup>th</sup>";
                              }
                            }
                            ?>
                          </td>
                          
                          <td class="data" id="<?php echo $RegNo; ?>ca2T"><?php echo $resAnalysis['ca1_grade']; ?></td>
                          
                          <td class="data" id="<?php echo $RegNo; ?>ca2T"><?php echo $resAnalysis['ca1_remark']; ?></td>




                          <td class="data" id="<?php echo $RegNo; ?>ca1T"><?php echo $resAnalysis['ca2_total']; ?></td>
                          <td class="data" id="<?php echo $RegNo; ?>ca1Avr" ><?php echo $resAnalysis['ca2_average']; ?></td>
                          <td class="data" id="<?php echo $RegNo; ?>ca1Avr">                            
                            <?php if($resAnalysis['ca2_position']>0){ echo $resAnalysis['ca2_position'];

                              $l1Pos=substr($resAnalysis['ca2_position'], strlen($resAnalysis['ca2_position'])-1,1);      
                              if($l1Pos==1 && $resAnalysis['ca2_position']!=11)
                              {
                                echo "<sup>st</sup>";        
                              }
                              elseif($l1Pos==2  && $resAnalysis['ca2_position']!=12)
                              {
                                echo "<sup>nd</sup>";        
                              }
                              elseif($l1Pos==3  && $resAnalysis['ca2_position']!=13)
                              {
                                echo "<sup>rd</sup>";        
                              }
                              elseif($l1Pos=='' || $resAnalysis['ca2_position']=0)
                              {
                                echo "<sup></sup>";        
                              }
                              else
                              {
                                echo "<sup>th</sup>";
                              }
                            }
                            ?>
                          </td>
                          
                          <td class="data" id="<?php echo $RegNo; ?>ca2T"><?php echo $resAnalysis['ca2_grade']; ?></td>
                          
                          <td class="data" id="<?php echo $RegNo; ?>ca2T"><?php echo $resAnalysis['ca2_remark']; ?></td>




                          <td class="data" id="<?php echo $RegNo; ?>ca1T"><?php echo $resAnalysis['exam_total']; ?></td>
                          <td class="data" id="<?php echo $RegNo; ?>ca1Avr" ><?php echo $resAnalysis['exam_average']; ?></td>
                          <td class="data" id="<?php echo $RegNo; ?>ca1Avr">                            
                            <?php if($resAnalysis['exam_position']>0){ echo $resAnalysis['exam_position'];

                              $l1Pos=substr($resAnalysis['exam_position'], strlen($resAnalysis['exam_position'])-1,1);      
                              if($l1Pos==1 && $resAnalysis['exam_position']!=11)
                              {
                                echo "<sup>st</sup>";        
                              }
                              elseif($l1Pos==2  && $resAnalysis['exam_position']!=12)
                              {
                                echo "<sup>nd</sup>";        
                              }
                              elseif($l1Pos==3  && $resAnalysis['exam_position']!=13)
                              {
                                echo "<sup>rd</sup>";        
                              }
                              elseif($l1Pos=='' || $resAnalysis['exam_position']=0)
                              {
                                echo "<sup></sup>";        
                              }
                              else
                              {
                                echo "<sup>th</sup>";
                              }
                            }
                            ?>
                          </td>
                          
                          <td class="data" id="<?php echo $RegNo; ?>ca2T"><?php echo $resAnalysis['exam_grade']; ?></td>
                          
                          <td class="data" id="<?php echo $RegNo; ?>ca2T"><?php echo $resAnalysis['exam_remark']; ?></td>




                          <td class="data" id="<?php echo $RegNo; ?>ca1T"><?php echo $resAnalysis['total']; ?></td>
                          <td class="data" id="<?php echo $RegNo; ?>ca1Avr" ><?php echo $resAnalysis['average']; ?></td>
                          <td class="data" id="<?php echo $RegNo; ?>ca1Avr">                            
                            <?php if($resAnalysis['position']>0){ echo $resAnalysis['position'];

                              $l1Pos=substr($resAnalysis['position'], strlen($resAnalysis['position'])-1,1);      
                              if($l1Pos==1 && $resAnalysis['position']!=11)
                              {
                                echo "<sup>st</sup>";        
                              }
                              elseif($l1Pos==2  && $resAnalysis['position']!=12)
                              {
                                echo "<sup>nd</sup>";        
                              }
                              elseif($l1Pos==3  && $resAnalysis['position']!=13)
                              {
                                echo "<sup>rd</sup>";        
                              }
                              elseif($l1Pos=='' || $resAnalysis['position']=0)
                              {
                                echo "<sup></sup>";        
                              }
                              else
                              {
                                echo "<sup>th</sup>";
                              }
                            }
                            ?>
                          </td>
                          
                          <td class="data" id="<?php echo $RegNo; ?>ca2T"><?php echo $resAnalysis['grade']; ?></td>
                          
                          <td class="data" id="<?php echo $RegNo; ?>ca2T"><?php echo $resAnalysis['remark']; ?></td>
                        </tr>

                        <?php
                      }
                      ?>
                    </tbody>
                    <tfoot></tfoot>
                  </table>

              </td>
            </tr>
          </table>
        </div>
        <!--CA Sheet Content ends-->
      </div>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->
  <!-- Bootstrap core JavaScript-->
  <script src="../dashboard/vendor/jquery/jquery.min.js"></script>
  <script src="../dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../dashboard/vendor/chart.js/Chart.min.js"></script>
  <script src="../dashboard/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../dashboard/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../dashboard/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../dashboard/js/demo/datatables-demo1.js"></script>


  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

<script src="../js/attracta.js"></script>
</body>

</html>
