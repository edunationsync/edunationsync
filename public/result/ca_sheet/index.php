<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$d_e_d=School::DomainExpiryDay($school_details['domain_due_date']);
$h_e_d=School::HostingExpiryDay($school_details['hosting_due_date']);
//if(!(isset($Subject)))
  $Subject=$_GET['txtsubjectp'];
//if(!(isset($Class)))
  $Class=$_GET['txtclassp'];
//if(!(isset($Session)))
  $Session=$_GET['txtsessionp'];
//if(!(isset($Term)))
  $Term=$_GET['txttermp'];
  if(!isset($_SESSION['lgina']))
  {
    header("location:../../login.php");
  }


if(!($_SESSION['lgina']=="IN"))
  header("location:../../login.php");


$ded=$d_e_d['day_diff'];
$hed=$h_e_d['day_diff'];

if(($ded<=(-30))||($hed<=(-30))&&(!$_SESSION['post']=="webmaster"))
  header("location:../../");

  $ss=Module::GetClassSessionp($Class);

  $Students=Module::ReadSessionStudentsp($ss,$Class);

  $subDetails=Module::ReadSubjectDetailsp($Subject);
  $sbjt=$subDetails['subject'];


  $leasts=Analysis::ReadSubjectLeastScoreStudents($Class,$Session,$Term,$Subject);

  foreach ($leasts as $least) {
    if(!(Module::IsStudentActive($least)))
    {
      Module::RemoveResults($least,$Term,$Session);
    }
  }

  if(isset($_GET['btnSort']))
  {
      $Subject=$_GET['txtsubjectSort'];
      $Class=$_GET['txtclassSort'];
      $Session=$_GET['txtsessionSort'];
      $Term=$_GET['txttermSort'];
      
      $Students=Module::ReadResultStudentsp($Session,$Term,$Subject,$Class);
  }

      $subDetails=Module::ReadSubjectDetailsp($Subject);
      $sbjt=$subDetails['subject'];


  $current=Module::ReadCurrentSession();


  $CA1Status=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"ca_1");
  $CA2Status=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"ca_2");
  $ExamStatus=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"exam");
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

  <title>CA Sheet <?php echo $Subject.' '.$Class.' '.$Session.' '.$Term; ?></title>
  <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="../../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../dashboard/css/sb-admin.css" rel="stylesheet">

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

      button:focus
      {
        font-weight: bolder;
        background-color: pink;
        color: black;
        border-color: blue;
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
          msg.pitch=0.6;
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
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 12000);
      }

      function checkkey(event)
      {
        if(event.key=="Enter")
        {
          document.getElementById('msgContainer').innerHTML="Pressing Enter key will create a new line which is not necessary for result processing. <br/>Use Backspace key to clear every new lines to continue.";
          alert('Pressing Enter key is not allowed. \n Press Back space to clear that new line to continue ');
        }
        
      }

      function Current(rowid)
      {
        var students=[];

        students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');



        for (var i = students.length - 1; i >= 0; i--) {
            document.getElementById(students[i]).style.backgroundColor="transparent";
        }

        document.getElementById(rowid).style.backgroundColor="lightgreen";
      }



      function validateca(id)
      {
        var ca1=document.getElementById(id+"ca1").innerHTML;
        var ca2=document.getElementById(id+"ca2").innerHTML;
        var ca3=document.getElementById(id+"ca3").innerHTML;
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
          document.getElementById(id+"ca1").style.background="RED";
        }
        else
        {
          document.getElementById(id+"ca1").style.background="white";
        }

        if(ca2>10)
        {
          document.getElementById(id+"ca2").style.background="RED";
        }
        else
        {
          document.getElementById(id+"ca2").style.background="white";
        }

        if(ca3>10)
        {
          document.getElementById(id+"ca3").style.background="RED";
        }
        else
        {
          document.getElementById(id+"ca3").style.background="white";
        }

        if(exam>70)
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
        var scoreReturn="";
        var scoreDetails="";
        var ca,total,cat;
        var ca1=document.getElementById(id+"ca1").innerHTML;
        var ca2=document.getElementById(id+"ca2").innerHTML;
        var ca3=document.getElementById(id+"ca3").innerHTML;
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
        cat=(eval(ca1)+eval(ca2)+eval(ca3)).toFixed(2);
        total=eval(cat)+eval(exam);

        document.getElementById(id+"exT").innerHTML = eval(total);
        document.getElementById(id+"caT").innerHTML = eval(cat);

        
        if(total=='')
          total=0;

        ReadScoreDetails(id,total);
        //scoreDetails=scoreReturn.split(':');
        
        //grade=scoreDetails[1];
        //remark=scoreDetails[3];
        /*

        if(total<=39){
          grade="F9";
          remark="Fail";
        }
        else if(total<=44){
          grade="E8";
          remark="Fair";
        }
        else if(total<=49){
          grade="D7";
          remark="Pass";
        }
        else if(total<=54){
          grade="C6";
          remark="Credit";
        }
        else if(total<=59){
          grade="C5";
          remark="Credit";
        }
        else if(total<=64){
          grade="C4";
          remark="Credit";
        }
        else if(total<=69){
          grade="B3";
          remark="Very Good";
        }
        else if(total<=74){
          grade="B2";
          remark="Very Good";
        }
        else if(total>=75){
          grade="A1";
          remark="Excellent";
        }
        */
      }
      

      function ReadScoreDetails(id,score)
      {        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            var response=this.responseText;

            var gradeData=response.split(':');
            
            document.getElementById(id+"Re").innerHTML = gradeData[2];
            document.getElementById(id+"Gr").innerHTML = gradeData[0];
          }
          else
          {

          }
        };
        xmlhttp.open("GET", "../read_score_grade.php?score="+score, true);
        xmlhttp.send();
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
        var ca3=document.getElementById(id+"ca3").innerHTML;
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
              
            //online backup synchronizer
              // if (navigator.onLine) {
              //   savescoreonline(id,subject,session,term,classs); 
              //   UploadUpdateOnline();
              // }


             
            
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

      function savescoreonline(id,subject,session,term,classs)
      {

        var catotal=document.getElementById(id+"caT").innerHTML;
        var total=document.getElementById(id+"exT").innerHTML;
        var remark=document.getElementById(id+"Re").innerHTML;
        var grade=document.getElementById(id+"Gr").innerHTML;
        var ca1=document.getElementById(id+"ca1").innerHTML;
        var ca2=document.getElementById(id+"ca2").innerHTML;
        var ca3=document.getElementById(id+"ca3").innerHTML;
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
        if(catotal=='')
          catotal=0;
        if(total=='')
          total=0;


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            cleanresult();
            //document.getElementById("preloader").style.display="none";
            Toast(this.responseText+" Saving Backup Online");
            //document.getElementById("msgContainer").innerHTML = this.responseText;
          }
          else
          {
            //document.getElementById("preloader").style.display="block";
            //document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;
            Toast("Saving Backup ....");

          }
        };
        xmlhttp.open("GET", "https://timaku.gsdw.org.ng/result/savescorep.php?student="+id+
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

      function DeRegisterResult(id,subject,session,term,classs)
      {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            document.getElementById("preloader").style.display="none";
            Toast(this.responseText);            

            document.getElementById(id+"caT").innerHTM='';
            document.getElementById(id+"exT").innerHTM='';
            document.getElementById(id+"Re").innerHTML='';
            document.getElementById(id+"Gr").innerHTM='';
            document.getElementById(id+"ca1").innerHTM='';
            document.getElementById(id+"ca2").innerHTM='';
            document.getElementById(id+"ca3").innerHTM='';
            document.getElementById(id+"exam").innerHTM='';         

            document.getElementById(id+"caT").contentEditable=false;
            document.getElementById(id+"exT").contentEditable=false;
            document.getElementById(id+"Re").contentEditable=false;
            document.getElementById(id+"Gr").contentEditable=false;
            document.getElementById(id+"ca1").contentEditable=false;
            document.getElementById(id+"ca2").contentEditable=false;
            document.getElementById(id+"ca3").contentEditable=false;
            document.getElementById(id+"exam").contentEditable=false;
          }
          else
          {
            
            document.getElementById("preloader").style.display="block";
            document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;

          }
        };
        xmlhttp.open("GET", "../cancelstudent.php?student="+id+
          "&subject="+subject+
          "&session="+session+
          "&term="+term+
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
          document.getElementById(students[i]+"ca3").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        document.getElementById('ca1btn').style.background="RED";
        document.getElementById('ca2btn').style.background="BLUE";
        document.getElementById('ca3btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="BLUE";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA12Only()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"ca3").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        document.getElementById('ca1btn').style.background="RED";
        document.getElementById('ca2btn').style.background="RED";
        document.getElementById('ca3btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="BLUE";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA13Only()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="false";
          document.getElementById(students[i]+"ca3").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        document.getElementById('ca1btn').style.background="RED";
        document.getElementById('ca2btn').style.background="BLUE";
        document.getElementById('ca3btn').style.background="RED";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="BLUE";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA1ExOnly()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="false";
          document.getElementById(students[i]+"ca3").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        document.getElementById('ca1btn').style.background="RED";
        document.getElementById('ca2btn').style.background="BLUE";
        document.getElementById('ca3btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="RED";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA23Only()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="false";
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"ca3").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        document.getElementById('ca1btn').style.background="BLUE";
        document.getElementById('ca2btn').style.background="RED";
        document.getElementById('ca3btn').style.background="RED";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="BLUE";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA2ExOnly()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="false";
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"ca3").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        document.getElementById('ca1btn').style.background="BLUE";
        document.getElementById('ca2btn').style.background="RED";
        document.getElementById('ca3btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="RED";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA3ExOnly()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="false";
          document.getElementById(students[i]+"ca2").contentEditable="false";
          document.getElementById(students[i]+"ca3").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        document.getElementById('ca1btn').style.background="BLUE";
        document.getElementById('ca2btn').style.background="BLUE";
        document.getElementById('ca3btn').style.background="RED";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="RED";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA2Only()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"ca1").contentEditable="false";
          document.getElementById(students[i]+"ca3").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        document.getElementById('ca1btn').style.background="BLUE";
        document.getElementById('ca2btn').style.background="RED";
        document.getElementById('ca3btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="BLUE";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA3Only()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca2").contentEditable="false";
          document.getElementById(students[i]+"ca1").contentEditable="false";
          document.getElementById(students[i]+"ca3").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        document.getElementById('ca1btn').style.background="BLUE";
        document.getElementById('ca3btn').style.background="RED";
        document.getElementById('ca2btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="BLUE";
        document.getElementById('allbtn').style.background="BLUE";        
      }      

      function ExamOnly()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="false";
          document.getElementById(students[i]+"ca2").contentEditable="false";
          document.getElementById(students[i]+"ca3").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        document.getElementById('ca1btn').style.background="BLUE";
        document.getElementById('ca2btn').style.background="BLUE";
        document.getElementById('ca3btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="RED";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function BothCA()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"ca3").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="false";
        }
        document.getElementById('ca1btn').style.background="BLUE";
        document.getElementById('ca2btn').style.background="BLUE";
        document.getElementById('ca3btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="RED";
        document.getElementById('exambtn').style.background="BLUE";
        document.getElementById('allbtn').style.background="BLUE";        
      }
      
      function AllScores()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"ca3").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        document.getElementById('ca1btn').style.background="BLUE";
        document.getElementById('ca2btn').style.background="BLUE";
        document.getElementById('ca3btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="BLUE";
        document.getElementById('allbtn').style.background="RED";        
      }




      

      function CA12ExOnly()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"ca3").contentEditable="false";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        document.getElementById('ca1btn').style.background="RED";
        document.getElementById('ca2btn').style.background="RED";
        document.getElementById('ca3btn').style.background="BLUE";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="RED";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA13ExOnly()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="true";
          document.getElementById(students[i]+"ca2").contentEditable="false";
          document.getElementById(students[i]+"ca3").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        document.getElementById('ca1btn').style.background="RED";
        document.getElementById('ca2btn').style.background="BLUE";
        document.getElementById('ca3btn').style.background="RED";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="RED";
        document.getElementById('allbtn').style.background="BLUE";        
      }

      function CA23ExOnly()
      {  
        var students=[];

        students=JSON.parse('<?php echo json_encode($Students); ?>');

        for (var i = students.length - 1; i >= 0; i--) {
          document.getElementById(students[i]+"ca1").contentEditable="false";
          document.getElementById(students[i]+"ca2").contentEditable="true";
          document.getElementById(students[i]+"ca3").contentEditable="true";
          document.getElementById(students[i]+"exam").contentEditable="true";
        }
        document.getElementById('ca1btn').style.background="BLUE";
        document.getElementById('ca2btn').style.background="RED";
        document.getElementById('ca3btn').style.background="RED";
        document.getElementById('bothcabtn').style.background="BLUE";
        document.getElementById('exambtn').style.background="RED";
        document.getElementById('allbtn').style.background="BLUE";        
      }

        function FillScore(type,subject,session,term,classs,score)
        {
          //alert(type+' '+subject+' '+session+' '+term+' '+classs+' '+score);
          var students=[];
          //var reg_no='';
          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = 0; i <=students.length - 1; i++) {
            reg_no=students[i];
            document.getElementById(reg_no+type).innerHTML=score;
            validateca(reg_no);
            checkkey(reg_no);

            computeresult(reg_no);
            savescore(reg_no, subject, session, term, classs,score);
          }
        }

        function FillSpecialScore(type,token,ids,subject,session,term,classs,score)
        {
          //alert(type+' '+subject+' '+session+' '+term+' '+classs+' '+score);
          var ids_s=ids.split(';');

          for (var i = 0; i <=ids_s.length - 1; i++) {
            
            reg_no=token+ids_s[i];
            document.getElementById(reg_no+type).innerHTML=score;
            validateca(reg_no);
            computeresult(reg_no);
            checkkey(reg_no);
            savescore(reg_no, subject, session, term, classs,score);
          }

        }

        function DuplicateScore(original,subject,session,term,classs,duplicate)
        {
          //alert(type+' '+subject+' '+session+' '+term+' '+classs+' '+score);
          var students=[];
          //var reg_no='';
          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = 0; i <=students.length - 1; i++) {
            reg_no=students[i];
            document.getElementById(reg_no+duplicate).innerHTML=document.getElementById(reg_no+original).innerHTML;
            validateca(reg_no);
            computeresult(reg_no);
            checkkey(reg_no);

            savescore(reg_no, subject, session, term, classs,document.getElementById(reg_no+original).innerHTML);
            //alert('taken');
          }
        }

        function ClearPositions(subject,session,term,classs)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              UpdatePositions(subject,session,term);
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
          xmlhttp.open("GET", "generate_subject_positions.php?subject="+subject+'&session='+session+'&term='+term+'&class='+classs+'&operation=clear_position' , true);
          xmlhttp.send();
        }

        function ProcessPositions(subject,session,term,classs)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              UpdatePositions(subject,session,term);
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
          xmlhttp.open("GET", "generate_subject_positions.php?subject="+subject+'&session='+session+'&term='+term+'&class='+classs , true);
          xmlhttp.send();
        }

        function SaveBackupRecord(reg_no,subject,session,term,ca1,ca2,ca3,catotal,exam,total,remark,grade,classs)
        {
          var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200)
          {
            cleanresult();
            Toast(this.responseText+" Saving Backup Online");
          }
          else
          {
            Toast("Saving Backup ....");

          }
        };
        xmlhttp.open("GET", "https://timaku.gsdw.org.ng/result/savescorep.php?student="+reg_no+
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

        function ReadBackupDetails(id)
        {
          var backup_details=[];
          var reg_no;
          var subject;
          var session;
          var classs;
          var term;
          var ca1;
          var ca2;
          var ca3;
          var catotal;
          var total;
          var lowest_score;
          var highest_score;
          var remark;
          var grade;

          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              backup_details=this.responseText.split("|");
              
              reg_no = backup_details[0];
              subject = backup_details[1];
              session = backup_details[2];
              classs = backup_details[3];
              term = backup_details[4];
              ca1 = backup_details[5];
              ca2 = backup_details[6];
              ca3 = backup_details[7];
              catotal = backup_details[8];
              exam = backup_details[9];
              total = backup_details[10];
              lowest_score = backup_details[11];
              highest_score = backup_details[12];
              remark = backup_details[13];
              grade = backup_details[14];

              SaveBackupRecord(reg_no,subject,session,term,ca1,ca2,ca3,catotal,exam,total,remark,grade,classs);
              deletebackuprecord(id);
            }
            else
            {
              Toast('Reading Backup Details');
            }
          };
          xmlhttp.open("GET", "read_backup_details.php?id="+id , true);
          xmlhttp.send();
        }

        function deletebackuprecord(id)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              //document.getElementById("preloader").style.display="none";
              Toast("Backup Refreshed Successfully");
            }
            else
            {
              Toast("Refreshing Backup");
            }
          };
          xmlhttp.open("GET", "deletebackuprecord.php?id="+id, true);
          xmlhttp.send();
        }
        
        function UploadUpdateOnline()
        {
          var backups=[];
          var backup_details=[];
          //var reg_no='';
          backups=JSON.parse('<?php echo json_encode(Sync::ReadAllResultUpdates()); ?>');

          for (var i = 0; i <=backups.length - 1; i++) {
            id=backups[i];
            ReadBackupDetails(id);
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
</head>

<body id="page-top">


  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php"><img src="../../images/school/favicon.png" style="height: 50px"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="">
      <div class="input-group">
        <input type="text" name="src" id="src" class="form-control" value="<?php echo $_GET['src']; ?>" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <p class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa- fa-f"></i>
          <span class="badge badge-danger"><?php if(count($NewAlerts)>10){ echo "10+";}else{echo count($NewAlerts);} ?></span>
        </a>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="messages.php" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger"><?php if(count($NewMessages)>10){ echo "10+";}else{echo count($NewMessages);} ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewAlerts)>0)
            {
              foreach($NewAlerts as $Alrt)
              {
                $alrtDetails=Message::ReadDetails($Alrt);
                ?>
                <a href="messages.php?id=<?php echo $alrtDetails['id']; ?>" title="<?php echo $alrtDetails['sender']; ?>"><div><?php echo $alrtDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="messages.php">View All</a>
          <a class="dropdown-item" href="?clearer=yes&type=alert">Clear Alerts</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewMessages)>0)
            {
              foreach($NewMessages as $Msg)
              {
                $msgDetails=Message::ReadDetails($Msg);
                ?>
                <a href="messages.php?id=<?php echo $msgDetails['id']; ?>" title="Sent By: <?php echo $msgDetails['sender']; ?>"><div><?php echo $msgDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="messages.php">Show Messages</a>
          <a class="dropdown-item" href="?clearer=yes&type=message">Clear Messages</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
      <li class="nav-item dropdown no-arrow">
        
          <?php
          if($_SESSION['lgina'])
          {
            ?>
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 20px; height: 20px; border-radius: 100%;"></a><div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="../dashboard/users/changepassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="../dashboard/users/changepassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="../dashboard/users"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
            <?php
          }
          else
          {
            ?>          
            <i class="fas fa-user-circle fa-fw"></i>
            <?php
          }
          ?>
        
        
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span><u>CA Sheets</u></span>
        </a>
      </li>
      <?php
        $subcount_real=0;

        if((Module::IsClassFormMaster($_SESSION['userid'],$Session,$Term,$Class))||$_SESSION['user_type']=='Admin'||$_SESSION['post']=="webmaster")
        {
          $Subjectss=Module::ReadClassSubjectsp($Class);
        }
        elseif(Module::IsClassFormMaster($_SESSION['userid'],$Session,$Term,$Class))
        {
          $Subjectss=Module::ReadClassSubjectsp($Class);
        }
        else
        {
          $Subjectss=Module::ReadStaffSubjectAllocation($_SESSION['userid'],$Session,$Term,$Class);
        }

        
        if(count($Subjectss)>0)
        {
          foreach($Subjectss as $Subjects)
          {     
            $subcount_real++;
            $sbj=strtoupper($Subjects);
            $Subject=strtoupper($Subject);
            if($sbj==$Subject)
            {
              $current_subcount=$subcount_real;
              ?>
              <li class="nav-item" style="background: white; color: black">
                <a class="nav-link" href="./index.php?txtsessionp=<?php echo $Session; ?>&txttermp=<?php echo $Term ?>&txtclassp=<?php echo $Class; ?>&txtsubjectp=<?php echo $Subjects; ?>">
                  <i class="fas fa-fw fa-chart-sheet"><img src="../../images/open-sheet.jpg" style="width: 20px"></i>
                  <span style="background: white; color: black"><?php echo $Subjects; ?></span></a>
              </li>
              <?php
            }
            else
            {
              ?>
              <li class="nav-item" style="color: white">
                <a class="nav-link" href="./index.php?txtsessionp=<?php echo $Session; ?>&txttermp=<?php echo $Term ?>&txtclassp=<?php echo $Class; ?>&txtsubjectp=<?php echo $Subjects; ?>">
                  <i class="fas fa-fw fa-sheet"><img src="../../images/closed-sheet.jpg" style="width: 20px"></i>
                  <span style="color: white; font-weight: bolder"><?php echo $Subjects; ?></span></a>
              </li>
              <?php  
            }                            
          }
        }
        ?>
      
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()" style="background: red; color: white; padding: 4px 4px 4px 4px; border-radius: 5px">Back</a>
          </li>
          <div style="padding-left: 25px">
            <a href="../../" title="Main Dashboard"><i class="fas fa-fw fa-home"></i> Home</a> | <a href="../../dashboard/" title="Main Dashboard">Dashboard</a> <?php
        if((Module::IsClassFormMaster($_SESSION['userid'],$Session,$Term,$Class))||$_SESSION['user_type']=='Admin'||Position::IsPositionPrivilege($_SESSION['post'],"Ca_sheet_explorer")||$_SESSION['post']=="webmaster")
          {
            ?> | <a href="../../admin" title="Admin Dashboard">Admin Dashboard</a> | <a href="../../result/">Result Dashboard</a> | <a href="../result_summary.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>">Term Summary</a>
            <?php
          }

          ?>
          </div>
        </ol><!-- Breadcrumbs-->
        <?php
        if((Module::IsClassFormMaster($_SESSION['userid'],$Session,$Term,$Class))||$_SESSION['user_type']=='Admin'||$_SESSION['post']=="webmaster")
          {
            ?>

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
              <div style="padding-left: 25px">
                <a href="ca_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>">All CA Sheets</a> | <a href="ca_post_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>"> All Post CA Sheets</a> | <a href="ca_assessment_sheet.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>"> Assessment Sheet</a> | <a href="ca_score_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>" title="Print All CA Score Sheet for this class">All Score Sheets</a> | <a href="ca_blank_sheetp.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>&txtsubjectp=<?php echo $Subject; ?>" title="Open Blank CA Sheet">Blank Sheet</a> | <a href="ca_blank_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>" title="Open All Blank CA Sheets for this class.">All Blank Sheets</a> | <a href="ca_sheetp.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>&txtsubjectp=<?php echo $Subject; ?>" title="This Page Print Preview">Print Preview</a> 
              </div>
            </ol><!-- Breadcrumbs-->
            <?php
          }
          ?>

          <ol class="breadcrumb">
          <div style="padding-left: 25px; background: black; padding: 10px 10px 10px 10px; font-size: 12px;">
            <form action="./index.php">
              <input type="hidden" name="txtsubjectp" id="txtsubjectp" value="<?php echo $Subject; ?>">
              
              <table><tr>
                <td>
                  <select name="txtsessionp" id="txtsessionp" >
                    <option><?php echo $Session; ?></option>
                    <?php
                      $Sessions=Module::ReadAllSessions();

                      foreach($Sessions as $Session_s)
                      {
                        if($Session==$Session_s)
                        {
                          ?>
                          <option><?php echo $Session_s;?></option>                     
                           <?php
                        }
                        else
                        {
                          ?>
                           <option><?php echo $Session_s;?></option>
                           <?php
                        }
                      }
                      ?>
                  </select>
                </td>
                <td>
                  <select name="txttermp" id="txttermp">
                    <option><?php echo $Term; ?></option>
                    <?php
                      $Terms=array("First","Second","Third");

                      foreach($Terms as $Term_s)
                      {
                        if($Term==$Term_s)
                        {
                          ?>
                          <option><?php echo $Term_s;?></option>                     
                           <?php
                        }
                        else
                        {
                          ?>
                           <option><?php echo $Term_s;?></option>
                           <?php
                        }
                      }
                      ?>
                  </select>                
                </td>
                <td>
                  <select name="txtclassp" id="txtclassp">
                    <option><?php echo $Class; ?>
                </td>
                <td>
                  <button>Change</button>
                </td>
              </tr></table>
            </form>
          </div>
        </ol><!-- Breadcrumbs-->

        <ol class="breadcrumb">

          <div style="background: black; color: white; width: 250px; float: right; padding: 5px 5px 5px 5px;">
            <center><h5>AI ASSISTANT</h5>
            <label for="verifier">Voice Verifier</label>
            <input type="checkbox" name="verifier" id="verifier" onchange="SpeakOut('Voice Verifier Activated')">
            <label style="padding: 5px 5px 5px 5px;" for="ca1_voice">CA1</label><input type="radio" name="verifier" id="ca1_voice" onchange="SpeakOut('VA1 Voice Verifier Activated')">
            <label style="padding: 5px 5px 5px 5px;" for="ca2_voice">CA2</label><input type="radio" name="verifier" id="ca2_voice" onchange="SpeakOut('CA2 Voice Verifier Activated')">
            <label style="padding: 5px 5px 5px 5px;" for="ca3_voice">CA3</label><input type="radio" name="verifier" id="ca3_voice" onchange="SpeakOut('CA3 Voice Verifier Activated')">
            <label style="padding: 5px 5px 5px 5px;" for="exam_voice">Exam</label><input type="radio" name="verifier" id="exam_voice" onchange="SpeakOut('Exam Voice Verifier Activated')">
            <label style="padding: 5px 5px 5px 5px;" for="all_voice">All</label><input type="radio" name="verifier" id="all_voice" onchange="SpeakOut('all Voice Verifier Activated')"></center>
          </div>
          
          <div style="background: pink; width: 250px; float: left; padding: 5px 5px 5px 5px;">
            Autofill Scores
            <table>
              <tr>

                <td><select name="txtType" id="txtType" style="background: transparent; border: none"><option>ca1</option><option>ca2</option><option>ca3</option><option>exam</option></select></td>
                <td><label>Score </label></td>
                <td><input type="text" name="txtScore" id="txtScore" placeholder="Score" style="background: blue; color:white; border: 2px solid black; width: 60px"/></td>
                <td><button onclick="FillScore(document.getElementById('txtType').value,'<?php echo $Subject; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>',document.getElementById('txtScore').value);" >Update</button></td>
              </tr>
            </table>
            
                <a href="clear_subject_result.php?subject=<?php echo $Subject; ?>&class=<?php echo $Class; ?>&term=<?php echo $Term; ?>&session=<?php echo $Session; ?>" ><button style="padding: 3px 3px 3px 3px; color: white; background: red"> Clear Subject Result</button></a>
          </div>
          
          <div style="background: orange; width: 300px; float: right; padding: 5px 5px 5px 5px;">
            Double Scores
            <table>
              <tr>
                <td><label>Original </label></td>
                <td><select name="txtOriginal" id="txtOriginal" style="background: transparent; border: none"><option>ca1</option><option>ca2</option><option>ca3</option><option>exam</option></select></td>
                <td><label>Duplicate </label></td>
                <td><select name="txtDuplicate" id="txtDuplicate" style="background: transparent; border: none"><option>ca1</option><option>ca2</option><option>ca3</option><option>exam</option></select></td>
                <td><button onclick="DuplicateScore(document.getElementById('txtOriginal').value,'<?php echo $Subject; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>',document.getElementById('txtDuplicate').value);" >Process</button></td>
              </tr>
              <tr>
                <td colspan="5">
                  <center><h5>Subject Positions</h5>
                    <?php 
                    if(Module::IsNotSubjectPositionUpdated($session,$term,$class,$subject))
                    {
                      ?>
                      <button onclick="ProcessPositions('<?php echo $Subject; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')">GENERATE POSITIONS</button>
                      <?php
                    }
                    else
                    {
                      ?>
                      <button onclick="ProcessPositions('<?php echo $Subject; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')">UPDATE POSITIONS</button> 
                      <button onclick="ClearPositions('<?php echo $Subject; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')">CLEAR</button>
                      <?php
                    }

                    ?></center>
                </td>
              </tr>
            </table>
          </div>

          <div style="background: lightblue; width: 250px; float: right; padding: 5px 5px 5px 5px;">
            <center>
              Import & Export
              <table>

                <?php 
                  //csv_fileuploader
                  $upload_filename = $Session." ".$Term." ".$Class." ".$Subject." CA Sheet.csv";
                  $upload_filepath = "uploads/".str_replace( "/", "_", $upload_filename);
                  if(move_uploaded_file($_FILES['csv_file']['tmp_name'], $upload_filepath))
                  {
                    if(($handle = fopen($upload_filepath, "r")) !== FALSE){
                      while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
                        $cnt_entry = $cnt_entry + 1;
                        
                        $catotal = $data[2]+$data[3]+$data[4];
                        $total = $catotal + $data[5];

                        Module::SaveScorep($data[0],$Subject,$Session,$Term,$Class,$data[2],$data[3],$data[4],$catotal,$data[5],$total,$grade,$remark);

                      }
                    }
                    ?>

                    <tr>
                      <td><?php echo ($cnt_entry - 1); ?></td>
                      <td><button onclick="DuplicateScore(document.getElementById('txtOriginal').value,'<?php echo $Subject; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>',document.getElementById('txtOriginal').value);" style="background: orange">Validate Upload</button></td>
                    </tr>
                   <?php              
                  }
                ?>
                <br/>

                <form  enctype="multipart/form-data" method="POST" action="">
                  <input type="file" name="csv_file" style="width: 100px" /><button>Import</button>
                  
                </form>

                <button onclick="exportTableToExcel('resultDataExcel')">Download Offline Sheet</button>
             

              
              </table> 
            </center>
          </div>
        </ol>


        <ol class="breadcrumb">
          <center>
          <div style="background: black; color: white; width: auto; float: right; padding: 5px 5px 5px 5px;">
            <h5>Column Activator</h5>
            <button onclick="CA1Only()" id="ca1btn">CA1</button><button onclick="CA12Only()" id="ca12btn">CA1,2</button><button onclick="CA12ExOnly()" id="ca12Exbtn">CA1,2&Ex</button>

            <button onclick="CA13Only()" id="ca13btn">CA1,3</button><button onclick="CA1ExOnly()" id="ca1Exbtn">CA1,Ex</button><button onclick="CA13ExOnly()" id="ca13Exbtn">CA1,3&Ex</button><button onclick="CA2Only()" id="ca2btn">CA2</button><button onclick="CA23Only()" id="ca23btn">CA2,3</button><button onclick="CA2ExOnly()" id="ca2Exbtn">CA2,Ex</button>
            <button onclick="CA23ExOnly()" id="ca23Exbtn">CA2,3&Ex</button><button onclick="CA3Only()" id="ca3btn">CA3</button><button onclick="CA3ExOnly()" id="ca3Exbtn">CA3,Ex</button><button onclick="BothCA()" id="bothcabtn">All CA</button><button onclick="ExamOnly()" id="exambtn">Exam</button><button onclick="AllScores()" id="allbtn">All</button>
          </div> </center>
        </ol>

        <!-- Icon Cards-->
      <div class="row"> 
        <!--CA Sheet Content start-->
        <div class="content" id="content">
          <?php 
          if(!(Module::IsSubject4Class($Class,$Subject)))
          {
            ?>
            <h1>Select a subject to view CA Sheet</h1>
            <?php
          }
          else{
            ?>
            <table cellspacing="0" width="100%" id="tableData" border="0">
              <tr>
                <td style="border:none">
                    <table cellspacing="0" width="100%">
                      
                      <thead>
                      <tr><td  width="40px"  valign="top">REG. NO.</td><td  valign="top" style="width: 300px">NAME</td><td width="5px" valign="top">CA1</td><td  width="5px" valign="top">CA2</td><td  width="5px" valign="top">CA3</td><td  width="10px" valign="top">TCA 30%</td><td  width="10px" valign="top">EXAM 70%</td><td  width="10px" valign="top">TOT 100%</td><td  width="5px" valign="top">POS</td><td  width="70px" valign="top">GRADE</td><td  width="70px" valign="top">RMK</td></tr></thead>
                      <tbody>
                        <?php
                        $count=0;

                        if(isset($_GET['btnSort']))
                        {
                          Module::UpdateSubjectPositions($Session,$Term,$Class,$Subject);
                        }

                        foreach($Students as $RegNo)
                        {
                          $count++;

                          $studentDetails=Module::ReadStudentDetailsp($RegNo);
                          $Student=$studentDetails['names'];


                          if(strtolower($Session)==strtolower($current['session']) && strtolower($Term)==strtolower($current['term']))
                          {
                            if(Module::IsStudentRegisteredp($RegNo,$Subject,$Session,$Term,$Class))
                            {
                              $editStatus=false;
                            }
                            else
                            {
                              $editStatus=true;
                            }
                          }
                          else
                          {
                            $editStatus='false';
                          }
                          ?>

                          <tr id="<?php echo $RegNo;?>" onkeydown="Current(this.id); if(event.keyCode==9){

                            checkkey(event);validateca(this.id);

                            computeresult(this.id);

                            savescore(this.id, '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>') }" onkeyup="Current(this.id); if(event.keyCode==9){

                            checkkey(event);validateca(this.id);

                            computeresult(this.id);

                            savescore(this.id, '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>') }"  onkeypress="Current(this.id); if(event.keyCode==9){

                            checkkey(event);validateca(this.id);

                            computeresult(this.id);

                            savescore(this.id, '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>') }"  >
                                            
                            <?php 
                            if(isset($_SESSION['lgina']) && $_SESSION['post']=="assistant headmistress" ||$_SESSION['post']=="assistant headmaster"||$_SESSION['post']=="webmaster" ||$_SESSION['post']=="exams & records")
                            {
                              ?>
                              <td ondblclick="DeRegisterResult('<?php echo $RegNo;?>', '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>')" ><center><?php echo $RegNo; ?></center></td>

                              <td ondblclick="DeRegisterResult('<?php echo $RegNo;?>', '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>')"   onclick="togglePassport('<?php echo $RegNo;?>imgid')"><?php echo $Student; ?></td>
                                <?php
                              }
                              else
                              {
                                ?>
                                <td ondblclick="DeRegisterResult('<?php echo $RegNo;?>', '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>')" ><center><?php echo $RegNo; ?></center></td>

                                <td ondblclick="DeRegisterResult('<?php echo $RegNo;?>', '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>')"  onclick="togglePassport('<?php echo $RegNo;?>imgid')"><?php echo $Student; ?></td>
                                <?php
                              }

                              $resultData=Module::ReadStudentResultp($RegNo,$Subject,$Session,$Term);
                              $cA1=$resultData['ca1'];
                              $cA2=$resultData['ca2'];
                              $cA3=$resultData['ca3'];
                              $caTotal=round($cA1+$cA2+$cA3,2);
                              $exam=$resultData['exam'];
                              $Position=$resultData['position'];
                              $Grade=$resultData['grade'];
                              $Remark=$resultData['remark'];
                              $ExTotal=$caTotal+$exam;

                              //echo "$Session $Term $cA1";
                              
                              //Module::RegisterSubjectp($RegNo,$Subject,$Session,$Term,$Class);
                              ?>

                              <td class="data" contenteditable="<?php echo $editStatus ?>" ondblclick="this.contentEditable=true;" id="<?php echo $RegNo; ?>ca1" onkeyup="validateca('<?php echo $RegNo; ?>');"

                                  onkeydown="if(event.keyCode==9){ 
                                    if(document.getElementById('ca1_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca1').innerHTML)
                                    }
                                    else if(document.getElementById('ca2_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca2').innerHTML)
                                    }
                                    else if(document.getElementById('ca3_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca3').innerHTML)
                                    }
                                    else if(document.getElementById('exam_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>exam').innerHTML)
                                    }
                                    else if(document.getElementById('all_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca1').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>ca2').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>ca3').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>exam').innerHTML)
                                    }
                                   }"><?php if($cA1>0){echo $cA1;}else{}  ?></td>
                              <td class="data" contenteditable="<?php echo $editStatus ?>" ondblclick="this.contentEditable=true;" id="<?php echo $RegNo; ?>ca2" onkeyup="validateca('<?php echo $RegNo; ?>');"

                                  onkeydown="if(event.keyCode==9){ 
                                    if(document.getElementById('ca1_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca1').innerHTML)
                                    }
                                    else if(document.getElementById('ca2_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca2').innerHTML)
                                    }
                                    else if(document.getElementById('ca3_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca3').innerHTML)
                                    }
                                    else if(document.getElementById('exam_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>exam').innerHTML)
                                    }
                                    else if(document.getElementById('all_voice').checked)
                                    {
                                      SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca1').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>ca2').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>ca3').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>exam').innerHTML)
                                    }
                                   }"
                              ><?php  if($cA2>0){echo $cA2;}else{}  ?></td>
                              <td class="data" contenteditable="<?php echo $editStatus ?>" ondblclick="this.contentEditable=true;" id="<?php echo $RegNo; ?>ca3" onkeyup="validateca('<?php echo $RegNo; ?>');"

                                onkeydown="if(event.keyCode==9){ 
                                  if(document.getElementById('ca1_voice').checked)
                                  {
                                    SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca1').innerHTML)
                                  }
                                  else if(document.getElementById('ca2_voice').checked)
                                  {
                                    SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca2').innerHTML)
                                  }
                                  else if(document.getElementById('ca3_voice').checked)
                                  {
                                    SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca3').innerHTML)
                                  }
                                  else if(document.getElementById('exam_voice').checked)
                                  {
                                    SpeakOut(document.getElementById('<?php echo $RegNo; ?>exam').innerHTML)
                                  }
                                  else if(document.getElementById('all_voice').checked)
                                  {
                                    SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca1').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>ca2').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>ca3').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>exam').innerHTML)
                                  }
                                 }"

                                ><?php  if($cA3>0){echo $cA3;}else{}  ?></td>
                              <td class="data" id="<?php echo $RegNo; ?>caT"><?php echo $caTotal;  ?></td>
                              <td class="data" contenteditable="<?php echo $editStatus ?>"  ondblclick="this.contentEditable=true;" id="<?php echo $RegNo; ?>exam" onkeyup="validateca('<?php echo $RegNo; ?>');" 

                              onkeydown="if(event.keyCode==9){ 
                                if(document.getElementById('ca1_voice').checked)
                                {
                                  SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca1').innerHTML)
                                }
                                else if(document.getElementById('ca2_voice').checked)
                                {
                                  SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca2').innerHTML)
                                }
                                else if(document.getElementById('ca3_voice').checked)
                                {
                                  SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca3').innerHTML)
                                }
                                else if(document.getElementById('exam_voice').checked)
                                {
                                  SpeakOut(document.getElementById('<?php echo $RegNo; ?>exam').innerHTML)
                                }
                                else if(document.getElementById('all_voice').checked)
                                {
                                  SpeakOut(document.getElementById('<?php echo $RegNo; ?>ca1').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>ca2').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>ca3').innerHTML+' '+document.getElementById('<?php echo $RegNo; ?>exam').innerHTML)
                                }
                               }"




                               ><?php if($exam>0){echo $exam;}else{} ?></td>
                              <td class="data" id="<?php echo $RegNo; ?>exT"><?php echo $ExTotal; ?></td>
                              <td class="data" id="<?php echo $RegNo; ?>Pos"><?php if($Position>0){ echo $Position;

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
                                elseif($lPos=='' || $Position=0)
                                {
                                  echo "<sup></sup>";        
                                }
                                else
                                {
                                  echo "<sup>th</sup>";
                                }
                              }
                              ?></td>             
                            <td class="data" id="<?php echo $RegNo; ?>Gr"><?php echo $Grade;  ?></td>
                            <td class="data" id="<?php echo $RegNo; ?>Re"><?php echo $Remark;  ?></td>
                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>
                      <tfoot></tfoot>
                    </table>

                     <button onclick="DuplicateScore(document.getElementById('txtOriginal').value,'<?php echo $Subject; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>',document.getElementById('txtOriginal').value);" >Save Scores</button>
                     
                    <?php 
                    $subcount_next=0;

                    $Subjectss=Module::ReadClassSubjectsp($Class,$Session,$Term);
                    if((Module::IsClassFormMaster($_SESSION['userid'],$Session,$Term,$Class))||$_SESSION['user_type']=='Admin'||Position::IsPositionPrivilege($_SESSION['post'],"Ca_sheet_explorer")||$_SESSION['post']=="webmaster")
                    {
                      if(count($Subjectss)>0)
                      {
                        foreach($Subjectss as $Subjects)
                        {
                          $subcount_next++;

                          if($subcount_next==$current_subcount-1)
                          {
                            ?>
                            <!-- Scroll to Top Button-->
                            <center>
                              [ <a style="padding: 10px 10px 10px 10px; font-weight:bolder" href="./index.php?txtsessionp=<?php echo $Session; ?>&txttermp=<?php echo $Term ?>&txtclassp=<?php echo $Class; ?>&txtsubjectp=<?php echo $Subjects; ?>">
                                <i class="fas fa-angle-left">Prev: <?php echo $Subjects;  ?></i>
                              </a> ]
                            <?php                  
                          }  

                          if($subcount_next==$current_subcount+1)
                          {
                            ?>
                            <!-- Scroll to Top Button-->
                              [ 
                                <a style="background: black; padding: 5px 5px 5px 5px;   border-bottom-left-radius:5px; border-top-left-radius:5px" href="./index.php?txtsessionp=<?php echo $Session; ?>&txttermp=<?php echo $Term ?>&txtclassp=<?php echo $Class; ?>&txtsubjectp=<?php echo $Subjects; ?>">
                                 <b style="background: red; color: white;  border-bottom-left-radius:5px; border-top-left-radius:5px">Next</b> <b style="background: white; color: black; padding: 5px 5px 5px 5px; border-color: black;"> <?php echo $Subjects;  ?></b>
                              </a> ]
                            </center>
                            <?php                  
                          }  
                        }
                      }
                    }
                    

                    ?>

                    <br><br><br>

                    <table style="padding: 10px 10px 10px 10px; width: 100% " cellspacing="0">              
                      <?php
                      $subjectresultsummary=Analysis::ReadSubjectResultSummary($Class,$Subject,$Session,$Term);
                      ?>
                      <tr><th colspan="9" style="text-align: center">SUBJECT RESULT ANALYSIS</th></tr>
                      <tr>
                        <?php 
                        $grds=Grades::ReadAllGrades();
                        foreach($grds as $grd)
                        {
                          $grdDetails=Grades::ReadDetails($grd);
                          ?>

                          <td style="text-align: center"><?php echo $grdDetails['grade_symbol']; ?></td>

                          <?php
                        }


                        ?>
                      </tr>
                      <tr>
                        <?php 
                        $grds=Grades::ReadAllGrades();
                        foreach($grds as $grd)
                        {
                          $grdDetails=Grades::ReadDetails($grd);
                          ?>

                          <td style="text-align: center"><?php echo Analysis::CountSubjectGrade($Class,$Session,$Term,$Subject,$grdDetails['grade_symbol']); ?></td>

                          <?php
                        }
                        ?>
                      </tr>
                    </table>
                    <table style="padding: 10px 10px 10px 10px; width: 100% " cellspacing="0">
                      <tr>
                        <td colspan="2">High Score</td><td colspan="2" style="text-align: center"><?php echo $subjectresultsummary['high_score'] ?></td><td></td>
                        <td colspan="2">Least Score</td><td colspan="2" style="text-align: center"><a href="least_score.php?txtsessionp=<?php echo $Session; ?>&txttermp=<?php echo $Term; ?>&txtclassp=<?php echo $Class; ?>&txtsubjectp=<?php echo $Subjects; ?>&txtscorep=<?php echo $subjectresultsummary['least_score']; ?>"><?php echo $subjectresultsummary['least_score'] ?></a></td></tr>
                      <tr>
                        <td colspan="2">Total High Score</td><td colspan="2" style="text-align: center"><?php echo $subjectresultsummary['total_high_score'] ?></td><td></td>
                        <td colspan="2">Total Least Score</td><td colspan="2" style="text-align: center"><?php echo $subjectresultsummary['total_least_score'] ?></td></tr>
                      <tr>
                        <td colspan="2">Total Pass</td><td colspan="2" style="text-align: center"><?php echo $subjectresultsummary['total_pass'] ?></td><td></td>
                        <td colspan="2">Total Fail</td><td colspan="2" style="text-align: center"><?php echo $subjectresultsummary['total_fail'] ?></td></tr>
                    </table>



                </td>
              </tr>
            </table>

            <?php
          }

          ?>
        
    

            <table id="resultDataExcel" cellspacing="0" width="100%" style="display: none" >
              
              <thead>
              <tr><td  width="40px"  valign="top">REG. NO.</td><td  valign="top" style="width: 300px">NAME</td><td width="5px" valign="top">CA1</td><td  width="5px" valign="top">CA2</td><td  width="5px" valign="top">CA3</td><td  width="10px" valign="top">EXAM 70%</td></tr></thead>
              <tbody>
                <?php
                foreach($Students as $RegNo)
                {
                  $count++;

                  $studentDetails=Module::ReadStudentDetailsp($RegNo);
                  $Student=$studentDetails['names'];
                  ?>
                  <tr>
                    <td ondblclick="DeRegisterResult('<?php echo $RegNo;?>', '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>')" ><center><?php echo $RegNo; ?></center></td>

                    <td ondblclick="DeRegisterResult('<?php echo $RegNo;?>', '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>')"  onclick="togglePassport('<?php echo $RegNo;?>imgid')"><?php echo $Student; ?></td>

                    <td class="data" ></td>
                    <td class="data" ></td>
                    <td class="data" ></td>
                    <td class="data"></td> 
                  </tr>
                  <?php
                }
                ?>
              </tbody>
              <tfoot></tfoot>
            </table>
          <footer></footer>
        </div>
        <!--CA Sheet Content ends-->
      </div>
      <!-- /.container-fluid -->
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © GSDW</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../../dashboard/vendor/jquery/jquery.min.js"></script>
  <script src="../../dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../dashboard/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../../dashboard/vendor/chart.js/Chart.min.js"></script>
  <script src="../../dashboard/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../../dashboard/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../dashboard/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../../dashboard/js/demo/datatables-demo1.js"></script>


  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <div id="preloader" style="display: none">
    <div id="loader"></div>
  </div>

<!-- The actual snackbar -->
<div id="snackbar"></div>
<script src="../../js/attracta.js"></script>
</body>

</html>
