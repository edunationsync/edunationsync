<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
if(!(isset($Class)))
  $Class=$_GET['txtclass'];
if(!(isset($Session)))
  $Session=$_GET['txtsession'];
if(!(isset($Term)))
  $Term=$_GET['txtterm'];


$ss=Module::GetClassSessionp($Class);


if(isset($_GET['result_src']))
{

  if(isset($_SESSION['lgina']) && $_SESSION['user_type']=="admin" || $_SESSION['post']=="webmaster")
  {
    $Students=Module::SearchStudents($_GET['result_src']);
  }
  else
  {
    $Studentssss=Module::SearchStudents($_GET['result_src']);
    $Students=array();

    foreach($Studentssss as $Sttudent)
    {
      $stdDetails=Module::ReadStudentDetailsp($Sttudent);
      if(strtoupper($stdDetails['class'])==strtoupper($Class))
      {
        array_push($Students, $Sttudent);
      }
    }
  }

}
else
{   
  if(isset($_GET['class']))
  {
    $class=$_GET['class'];
  }
  else
  {
    $class="Basic 1";
  }

  $Students=Module::ReadSessionStudentsp($ss,$Class);
}

  

//$Level=Module::GetLevel($Class);

  $current=Module::ReadCurrentSession();

  if($Session==$current['session'] && $Term==$current['term'])
  {
    $editStatus='true';
  }
  else
  {
    $editStatus='false';
  }
  
if(isset($_GET['btnSort']))
{
    $Class=$_GET['txtclassSort'];
    $Session=$_GET['txtsessionSort'];
    $Term=$_GET['txttermSort'];


    $Students=Module::ReadResultAnalysisStudentsp($Session,$Term,$Class);
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

  <title>CA2 Master Sheet <?php echo $Class.' '.$Session.' '.$Term; ?></title>
  <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="../../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../../dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../dashboard/css/sb-admin.css" rel="stylesheet">

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

      /* Show the snackbar when clicking on a button (class added with JavaScript) */
      #statusbarmessage {
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

      .bheader{
        color: black;
        font-family: times new roman;
        text-align: center;
        font-size: 12px;
        font-weight: bolder;
      }
      thead{
        font-weight: bolder;
        text-align: center;
        font-size: 12px;
        background-color: white;
      }
      tr:hover{
        background-color: white; 
      }
      tbody{
        font-size: 12px;
        background-color: white;
      }
      td{
        border: 1px solid black;
      }
      .content 
      {
        background-color: white;
        height: 100%;
        page-break-after: always;
      }
      
      select
      {
        background-color: lightblue;
        color: black;
        padding: 3px 3px 3px 3px;
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
  </style>
    <script type="text/javascript">
        //New Script from CA Sheet
        function Toast(message) {
          // Get the snackbar DIV
          var x = document.getElementById("snackbar");
          x.innerHTML=message;

          // Add the "show" class to DIV
          x.className = "show";

          // After 3 seconds, remove the show class from DIV
          setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
        }

        function validateca(id)
        {
          var values=document.getElementById(id).innerHTML;

          if(values==''){
            values=0;
          }
          else if(values.substr(values.length-4)=="<br>")
          {
            values=values.substr(0,values.length-4);

            if(values=='')
            {
              values=0;
            }
          }


          values=eval(values);



          if(values>10)
          {
            document.getElementById(id).style.background="RED";
          }
          else
          {
            document.getElementById(id).style.background="white";
          } 
        }

        function validateexam(id)
        {

          var values=document.getElementById(id).innerHTML;

          if(values==''){
            values=0;
          }
          else if(values.substr(values.length-4)=="<br>")
          {
            values=values.substr(0,values.length-4);

            if(values=='')
            {
              values=0;
            }
          }


          values=eval(values);

          if(values>70)
          {
            document.getElementById(id).style.background="RED";
          }
          else
          {
            document.getElementById(id).style.background="white";
          } 
        }

        function computeresult(id,subj)
        {
          var ids=id;
          id=id+subj;
          var Grade='';
          var Remark='';
          var Average=0;
          var grade='';
          var remark='';
          
          var ca,total,cat;
          var ca1=document.getElementById(id+"ca1").innerHTML;
          var ca2=document.getElementById(id+"ca2").innerHTML;
          var ca3=document.getElementById(id+"ca3").innerHTML;
          var exam=document.getElementById(id+"exam").innerHTML;
          var Total=0;
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

          document.getElementById(id+"subjectTotalScore").innerHTML = eval(total);
          document.getElementById(id+"caT").innerHTML = eval(cat);

          if(total=='')
            total=0;

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

          //Read all the subjects and add the scores of each subject
          subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSessionSubjectsp($Class,$Session,$Term)); ?>');
          for (var s = subjects.length - 1; s >= 0; s--) {

            var tt=eval(document.getElementById(ids+subjects[s]+"ca2").innerHTML);
            if(tt==null)
            {
              tt=0;
            }
            Total=Total+tt;
          }
          //alert('<?php echo "man" ?>');
          //alert(subjects.length);

          Average=Total/subjects.length;
          if(Total=='')
            Total=0;
          if(Total<=((29/100)*(subjects.length*100))){
            Grade="F";
            Remark="Fail";
          }
          else if(Total<=((39/100)*(subjects.length*100))){
            Grade="E";
            Remark="Fair";
          }
          else if(Total<=((49/100)*(subjects.length*100))){
            Grade="D";
            Remark="Pass";
          }
          else if(Total<=((59/100)*(subjects.length*100))){
            Grade="C";
            Remark="Credit";
          }
          else if(Total<=((69/100)*(subjects.length*100))){
            Grade="B";
            Remark="Very Good";
          }
          else if(Total>=((70/100)*(subjects.length*100))){
            Grade="A";
            Remark="Excellent";
          }

          document.getElementById(ids+"Total").innerHTML = Total;
          document.getElementById(ids+"Grade").innerHTML = Grade;
          document.getElementById(ids+"Remark").innerHTML =Remark;
          document.getElementById(ids+"Average").innerHTML = Average.toFixed(2);
        }

        function testSaveScore(session,term,classs)
        {
          var subjects=[];
          var count=0;
          subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
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
          var total=document.getElementById(id+subject+"subjectTotalScore").innerHTML;
          var ca1=document.getElementById(id+subject+"ca1").innerHTML;
          var ca2=document.getElementById(id+subject+"ca2").innerHTML;
          var ca3=document.getElementById(id+subject+"ca3").innerHTML;
          var exam=document.getElementById(id+subject+"exam").innerHTML;
          var remark='';
          var grade='';


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
              document.getElementById("preloader").style.display="none";
              Toast(this.responseText);
            }
            else
            {
              document.getElementById("preloader").style.display="block";
              Toast("Loading...");
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

        function cleanresultanalysis()
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
          xmlhttp.open("GET", "../clean_result_analysisp.php" , true);
          xmlhttp.send();
        }

        function CA1Only()
        {  
          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="false";
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="false";
            }
          }
          //btnca1
          //btnca2
          //btnca1ca2
          //btnexam
          //btnallscores
          document.getElementById("entryMsg").innerHTML="Only CA1 Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="Only CA1 Mode Activated")
          {
            document.getElementById("btnca1").style.backgroundColor="lightblue";
            document.getElementById("btnca1").style.color="black";


            document.getElementById("btnca2").style.backgroundColor="blue";
            document.getElementById("btnca2").style.color="white";

            document.getElementById("btnca1ca2").style.backgroundColor="blue";
            document.getElementById("btnca1ca2").style.color="white";

            document.getElementById("btnexam").style.backgroundColor="blue";
            document.getElementById("btnexam").style.color="white";

            document.getElementById("btnallscores").style.backgroundColor="blue";
            document.getElementById("btnallscores").style.color="white";
          }
          
        }

        function CA2Only()
        {  

          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="false";
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="false";
            }
          }
          document.getElementById("entryMsg").innerHTML="Only CA2 Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="Only CA2 Mode Activated")
          {
            document.getElementById("btnca2").style.backgroundColor="lightblue";
            document.getElementById("btnca2").style.color="black";


            document.getElementById("btnca1").style.backgroundColor="blue";
            document.getElementById("btnca1").style.color="white";

            document.getElementById("btnca1ca2").style.backgroundColor="blue";
            document.getElementById("btnca1ca2").style.color="white";

            document.getElementById("btnexam").style.backgroundColor="blue";
            document.getElementById("btnexam").style.color="white";

            document.getElementById("btnallscores").style.backgroundColor="blue";
            document.getElementById("btnallscores").style.color="white";
          }
          
        }        

        function ExamOnly()
        {  

          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="false";
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="false";
            }
          }
          document.getElementById("entryMsg").innerHTML="Only Exam Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="Only Exam Mode Activated")
          {
            document.getElementById("btnexam").style.backgroundColor="lightblue";
            document.getElementById("btnexam").style.color="black";


            document.getElementById("btnca1").style.backgroundColor="blue";
            document.getElementById("btnca1").style.color="white";

            document.getElementById("btnca1ca2").style.backgroundColor="blue";
            document.getElementById("btnca1ca2").style.color="white";

            document.getElementById("btnca2").style.backgroundColor="blue";
            document.getElementById("btnca2").style.color="white";

            document.getElementById("btnallscores").style.backgroundColor="blue";
            document.getElementById("btnallscores").style.color="white";
          }
          
        }

        function BothCA()
        {  
          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="false";
              
            }
          }
          document.getElementById("entryMsg").innerHTML="Both CA Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="Both CA Mode Activated")
          {
            document.getElementById("btnca1ca2").style.backgroundColor="lightblue";
            document.getElementById("btnca1ca2").style.color="black";


            document.getElementById("btnca1").style.backgroundColor="blue";
            document.getElementById("btnca1").style.color="white";

            document.getElementById("btnexam").style.backgroundColor="blue";
            document.getElementById("btnexam").style.color="white";

            document.getElementById("btnca2").style.backgroundColor="blue";
            document.getElementById("btnca2").style.color="white";

            document.getElementById("btnallscores").style.backgroundColor="blue";
            document.getElementById("btnallscores").style.color="white";
          }
          
        }
        
        function AllScores()
        {   
          var subjects=[];
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]).style.backgroundColor="white";

              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="white";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="white";
            }
          }


          
          document.getElementById("entryMsg").innerHTML="All Score Mode Activated";
          if(document.getElementById("entryMsg").innerHTML==="All Score Mode Activated")
          {
            document.getElementById("btnallscores").style.backgroundColor="lightblue";
            document.getElementById("btnallscores").style.color="black";


            document.getElementById("btnca1").style.backgroundColor="blue";
            document.getElementById("btnca1").style.color="white";

            document.getElementById("btnexam").style.backgroundColor="blue";
            document.getElementById("btnexam").style.color="white";

            document.getElementById("btnca2").style.backgroundColor="blue";
            document.getElementById("btnca2").style.color="white";

            document.getElementById("btnca1ca2").style.backgroundColor="blue";
            document.getElementById("btnca1ca2").style.color="white";
          }

        }
        
        function Current(cellid,rowid,headd,subject)
        {
          var students=[];

          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');



          for (var i = students.length - 1; i >= 0; i--) {
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]).style.backgroundColor="transparent";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="transparent";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="transparent";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="transparent";
            }
          }

          for (var i = students.length - 1; i >= 0; i--) {
            if(headd==='ca1'){
                document.getElementById(students[i]+subject+"ca1").style.backgroundColor="lightblue";
            }
            else if(headd==='ca2'){              
              document.getElementById(students[i]+subject+"ca2").style.backgroundColor="lightblue";
            }
            else if(headd==='exam'){
              document.getElementById(students[i]+subject+"exam").style.backgroundColor="lightblue";
            }            
          }
          
          document.getElementById(cellid).style.backgroundColor="white";
          document.getElementById(rowid).style.backgroundColor="lightblue";
        }

        function ClearClassPositions(sub,session,term,classs)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              UpdatePositions(sub,session,term);
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
          xmlhttp.open("GET", "generate_positions.php?session="+session+'&term='+term+'&operation=clear_position'+'&sub='+sub+'&class='+classs , true);
          xmlhttp.send();
        }

        function ProcessPositions(sub,session,term,classs)
        {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
              UpdatePositions(sub,session,term);
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
          xmlhttp.open("GET", "generate_positions.php?sub="+sub+'&session='+session+'&term='+term+'&class='+classs , true);
          xmlhttp.send();
        }
        
        function UpdatePositions(sub,session,term)
        {
          var students=[];
          //var reg_no='';
          students=JSON.parse('<?php echo json_encode(Module::ReadSessionStudentsp($ss,$Class)); ?>');

          for (var i = 0; i <=students.length - 1; i++) {
            reg_no=students[i];

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200)
              {
                response=this.responseText;
                var reg_no=response.split(':');
                //alert(reg_no[0]);
                document.getElementById(reg_no[0]+"Position").innerHTML=reg_no[1];
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
            xmlhttp.open("GET", "result_analysis_details.php?sub="+sub+"&reg_no="+students[i]+'&session='+session+'&term='+term, true);
            xmlhttp.send();

          }
        }

        function ShowStatusBar(ids,name,student,headd,subject)
        { 
          document.getElementById('statusBar').style.display='block';
          document.getElementById('statusBarMessage').innerHTML="Name: "+name+", Reg.: "+student+", Type: "+headd+", Subject: "+subject;


          document.getElementById("total").innerHTML ="Total: "+document.getElementById(ids+"Total").innerHTML+"; ";
          document.getElementById("grade").innerHTML ="Grade: "+ document.getElementById(ids+"Grade").innerHTML+"; ";
          document.getElementById("remark").innerHTML ="Remark: "+document.getElementById(ids+"Remark").innerHTML+"; ";
          document.getElementById("average").innerHTML ="Average: "+ document.getElementById(ids+"Average").innerHTML;
          document.getElementById("position").innerHTML ="Position: "+ document.getElementById(ids+"Position").innerHTML+"; ";
        }
        
        function  print(elem)
        {
          var mywindow=window.open('','PRINT','height=auto,width=auto');
          mywindow.document.write('<html><head>'+document.title+'</title></head>');
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
      //Old Script from CA Sheet
    </script>

</head>

<body id="page-top">


  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../../index.php"><img src="../../images/school/favicon.png"></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>


    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="../../student_almanac.php">
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
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"><?php if(count($NewAlerts)>0){ echo $NewAlerts;} elseif(count($NewAlerts)>9){echo "9+";} ?></i>

        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <div class="shortmsg">
            <?php
            if(count($NewAlerts)>0)
            {
              foreach($NewAlerts as $Alerts)
              {
                $alertDetails=Message::ReadDetails($Alerts);
                ?>
                <a href="../../dashboard/messages.php?id=<?php echo $alertDetails['id']; ?>" title="Sent By: <?php echo $alertDetails['sender']; ?>"><div><?php echo $alertDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="../../dashboard/messages.php">Show Messages</a>
          <a class="dropdown-item" href="?clearer=yes&type=message">Clear Messages</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>

      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"><?php if(count($NewMessages)>0){ echo $NewMessages;} elseif(count($NewMessages)>9){echo "9+";} ?></i>
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
                <a href="../../dashboard/messages.php?id=<?php echo $msgDetails['id']; ?>" title="Sent By: <?php echo $msgDetails['sender']; ?>"><div><?php echo $msgDetails['body']; ?></div></a>
                <?php
              }
            }

            ?>
          </div>
          <a class="dropdown-item" href="../../dashboard/messages.php">Show Messages</a>
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
          <a class="dropdown-item" href="../../dashboard/users/changepassport.php"><center><img src="<?php echo 'data:image/jpeg;base64,'.$_SESSION['passport'];?>" style="width: 50px; height: 50px"></center></a>
          <a class="dropdown-item" href="../../dashboard/users/changepassport.php"><i class="fas fa-user-circle fa-fw"></i>Change Passport</a>
          <a class="dropdown-item" href="../../dashboard/users/viewstaffprofile.php"><i class="fas fa-user-circle fa-fw"></i> View Profile</a>
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

  <div >

    <div id="content-wrapper">

      <div class="container-fluid">


        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#" onclick="window.history.back()" style="background: red; color: white; padding: 4px 4px 4px 4px; border-radius: 5px">Back</a>
          </li>
            <div style="padding-left: 25px">
              <a href="../../" title="Main Dashboard"><i class="fas fa-fw fa-home"></i> Home</a> | <a href="../../dashboard/" title="Main Dashboard">Dashboard</a>

          <?php
          if(strtolower($_SESSION['post'])==strtolower("webmaster")||strtolower($_SESSION['post'])==strtolower("examinar")||strtolower($_SESSION['post'])==strtolower("Vice Principal Academics")||strtolower($_SESSION['post'])==strtolower("exams and records"))
          {
            ?> | <a href="../../admin" title="Admin Dashboard">Admin Dashboard</a> | <a href="../../result/">Result Dashboard</a> | <a href="../../admin/subject_library.php" title="Subject Library">Subjects</a> | <a href="../../dashboard/users/allstudents.php?txtclassp=<?php echo $Class; ?>" title="Students List">Students</a> | <a href="../../admin/student_subject_registration.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>" title="Subject registration for Students">Subject Registration</a> | <a href="../../admin/subject_allocation.php" title="Subject Allocation to Teachers">Subject Allocation</a> | <a href="../../admin/class_library.php" title="Class Library">Class Library</a> | <a href="../../admin/class_allocation.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>" title="Form Masters Class Allocation">Class Allocation</a>
            <?php 
          }
          ?>
            </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px">
            <a href="../ca_sheet/ca_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>">All CA Sheets</a> | <a href="../ca_sheet/ca_post_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>"> All Post CA Sheets</a> | <a href="../ca_sheet/ca_score_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>" title="Print All CA Score Sheet for this class">All Score Sheets</a> | <a href="../ca_sheet/ca_blank_sheetp.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>&txtsubjectp=<?php echo $Subject; ?>" title="Open Blank CA Sheet">Blank Sheet</a> | <a href="../ca_sheet/ca_blank_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>" title="Open All Blank CA Sheets for this class.">All Blank Sheets</a> | <a href="report.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>&txtclass=<?php echo $Class; ?>" title="Print this Sheet now">Print Master Sheet</a> 
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px">
            <a href="../../result/psychomotorp.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>">Ratings</a> | <a href="../master_sheet/master_sheet_ca1.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">CA1 Sheet</a> | <a href="../master_sheet/master_sheet_ca2.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">CA2 Sheet</a> | <a href="../master_sheet/master_sheet_ca3.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">CA3 Sheet</a> | <a href="../master_sheet/master_sheet_exam.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">Exam Sheet</a> | <a href="../master_sheet/master_sheet_total.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">Master Sheet Total</a> | <a href="../master_sheet/master_sheetp.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">Master Sheet</a> | <a href="../../portal/individual_student_resultp.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>">Individual Updater</a> | <a href="../result_summary.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>">Term Summary</a> | <a href="../session_result_summary.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>">Session Summary</a> | <a href="../../portal/allresultsp.php?prclass=<?php echo $Class; ?>&prsession=<?php echo $Session; ?>&prterm=<?php echo $Term; ?>">Result Sheets</a>
          </div>
        </ol><!-- Breadcrumbs-->
        

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px; background: black; padding: 10px 10px 10px 10px; font-size: 12px;">
            <?php
            $Classesss=Module::ReadAllClassesp();

            foreach($Classesss as $classes_s)
            {
              if((Module::IsClassFormMaster($_SESSION['userid'],$Session,$Term,$classes_s))||$_SESSION['user_type']=='Admin')
              {
                if($Class==$classes_s)
                {
                  ?>
                  <a href="./master_sheet_exam.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $classes_s; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: white; color: black"><?php echo $classes_s; ?></a>
                  <?php
                }
                else
                {
                  ?>
                  <a href="./master_sheet_exam.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $classes_s; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;"><?php echo $classes_s; ?></a>
                  <?php                
                }
              }
              elseif($_SESSION['post']=="Vice Principal Academics")
              {

                if($Class==$classes_s)
                {
                  ?>
                  <a href="./master_sheet_exam.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $classes_s; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: white; color: black"><?php echo $classes_s; ?></a>
                  <?php
                }
                else
                {
                  ?>
                  <a href="./master_sheet_exam.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $classes_s; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;"><?php echo $classes_s; ?></a>
                  <?php                
                }
              }
            }
            ?>            
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px; background: black; padding: 10px 10px 10px 10px; font-size: 12px;">
            <?php
            $Terms=array("First","Second","Third");

            foreach($Terms as $Term_s)
            {
              if($Term ==$Term_s)
              {
                ?>
                <a href="./master_sheet_ca2.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term_s ?>&txtclass=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: white; color: black"><?php echo $Term_s; ?></a>
                <?php
              }
              else
              {
                ?>
                <a href="./master_sheet_ca2.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term_s ?>&txtclass=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;"><?php echo $Term_s; ?></a>
                <?php                
              }
            }
            ?>            
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px; background: black; padding: 10px 10px 10px 10px; font-size: 12px;">
            <?php
            $Sessions=Module::ReadAllSessions();

            foreach($Sessions as $Session_s)
            {
              if($Session==$Session_s)
              {
                ?>
                <a href="./master_sheet_ca2.php?txtsession=<?php echo $Session_s; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: white; color: black"><?php echo $Session_s; ?></a>
                <?php
              }
              else
              {
                ?>
                <a href="./master_sheet_ca2.php?txtsession=<?php echo $Session_s; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;"><?php echo $Session_s; ?></a>
                <?php                
              }
            }
            ?>
            
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Result Menu-->
        <ol class="breadcrumb">
          <div style="padding-right: 15px">
            <a href="master_sheet_ca2_print.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>&txtclass=<?php echo $Class; ?>" title="Print this Sheet now" target="_blank">Print Preview</a> 
            <?php 
            if($Session==$current['session'] && $Term==$current['term'])
            {
              ?>
              <button onclick="ProcessPositions('CA2','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')">POSITIONS</button> 
              <button onclick="ClearClassPositions('CA2','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')">CLEAR</button>
              <?php
            }

            ?>
          </div>
          <div style="padding-right: 15px">
             <form method="GET" action="../ca_sheet/">
                <input type="hidden" id="txtsessionp" name="txtsessionp" value='<?php echo $Session; ?>'>
                <input type="hidden" id="txttermp" name="txttermp" value='<?php echo $Term; ?>'>
                <input type="hidden" id="txtclassp" name="txtclassp" value='<?php echo $Class; ?>'>
                <?php $Subjects=Module::ReadClassSubjectsp($Class); ?>
                <select id="txtsubjectp" name="txtsubjectp" style="width: 100px">
                  <?php 
                  foreach ($Subjects as $Subjectsss) {
                    ?>
                    <option><?php echo $Subjectsss; ?></option>
                    <?php
                  }
                  ?>
                  
                </select><input type="submit" value="Open CA Sheet" title="Open CA Sheet o the selected subject">
             </form>
          </div>
          <div style="padding-right: 15px">            
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="">
              <div class="input-group">
                <input type="hidden" id="txtsession" name="txtsession" value='<?php echo $Session; ?>'><input type="hidden" id="txtterm" name="txtterm" value='<?php echo $Term; ?>'>
                <input type="hidden" id="txtclass" name="txtclass" value='<?php echo $Class; ?>'>
                <input type="text" name="result_src" id="result_src" class="form-control" value="<?php echo $_GET['result_src']; ?>" placeholder="Search Results..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" title="Search for Specific Result">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
            <span id="entryMsg" name="entryMsg" style="font-style: italic; background: pink; color: black; padding: 5px 5px 5px 5px;">Status</span>
          </div>
        </ol><!-- Result Menu-->

        <?php
        if(isset($_GET['result_src']))
        {
          ?>
          <ol class="breadcrumb">
            <?php
            $stdCounts=count($Students);
            echo 'Searches: '.$stdCounts.' record(s) found';
            ?>
          </ol>
          <?php
        }
        ?>

        <!-- Icon Cards-->
        <!--CA Sheet Content start-->
        <table id="tableData" width="100%" style="margin-bottom: 80px;">
          <tr>
            <td style="border:none">
              <header>
                <center><div class="bheader">
                  <hd><?php echo strtoupper($school_details['school_name']); ?></hd><br/>
                  <hd1><?php echo $Session; ?> <?php echo  strtoupper($Term); ?> TERM CA 2 MASTER RESULT SHEET  FOR <?php echo strtoupper($Class);  ?></hd1> </div>
                </center>
              </header>
              <table cellspacing="0" width="100%" style="font-size: 12px">
                <thead><tr><td width="20px"  valign='top' rowspan='1'><center>REG</center></td><td width="250px" valign='top' rowspan='1'>NAME</td>
                  <?php
                  $cnt=0;
                  $cls=substr($Class, 0,9);
                  if($cls=="Primary 4" ||$cls=="Primary 5")
                  {
                    $Subjects=Module::ReadClassSubjectsp("Primary 5O");
                  }
                  else
                  {
                    $Subjects=Module::ReadClassSubjectsp($Class);
                  }
                  
                  foreach($Subjects as $subject)
                  {
                    $cnt++;
                    $subNum[$cnt]=$subject;
                    $subDetails=Module::ReadSubjectDetailsp($subject); ?>

                    <td valign='top' colspan='1'>
                      <center>
                        <a style="background: transparent; border:none" href="../ca_sheet/?txtsessionp=<?php echo $Session; ?>&txttermp=<?php echo $Term; ?>&txtclassp=<?php echo $Class; ?>&txtsubjectp=<?php echo $subject; ?>">
                          <?php
                          echo strtoupper($subDetails['short_code']);
                          ?></a>
                      </center>
                    </td> 
                    <?php   
                  }
                  ?>

                  <td  width="70px" valign="top" rowspan='1'><center>TOTAL</center></td><td  width="70px" valign="top" rowspan='1'><center>CA1 AVR</center></td><td  width="70px" valign="top" rowspan='1'><center>CA2 AVR</center></td><td  width="70px" valign="top" rowspan='1'><center>DIFF</center></td><td  width="70px" valign="top" rowspan='1'><center>GRADE</center></td><td  width="70px" valign="top" rowspan='1'><center>HM'S REMARK</center></td><!--<td  width="70px" valign="top"><center>FORM M. REMARK</center></td><td  width="70px" valign="top"><center>ATTENDANCE</center></td><td  width="70px" valign="top"><center>CONDUCT</center></td><td  width="70px" valign="top"><center>APPEARANCE</center></td>--></tr>
                  
                </thead>
                <tbody>
                  <?php
                  $count=0;

                  if(isset($_GET['btnSort']))
                  {
                    Module::UpdateTermSubPositions("CA2",$Session,$Term,$Class);
                  }

                  foreach($Students as $RegNo)
                  {
                    //$Subjects=Module::ReadClassSubjectsp($Class);
                    $count++;
                    $studentDetails=Module::ReadStudentDetailsp($RegNo);
                    $Student=$studentDetails['names'];
                    ?>
                    <tr id="<?php echo $RegNo; ?>" >
                                        
                        <?php 
                        if(isset($_SESSION['lgina']) && $_SESSION['user_type']=="admin" || $_SESSION['post']=="webmaster")
                        {
                          ?>
                          <td><a style="background:transparent; border:none;" href="../dashboard/users/editstudentprofile.php?id=<?php echo $RegNo; ?>" title="Modify Profile"><center><?php echo $RegNo; ?><img style="display: none" class="img-profile" src="<?php echo 'data:image/jpeg;base64,'.$studentDetails['passport'];?>" id="<?php echo $RegNo;?>imgid"></center></a></td>

                        <td  onclick="togglePassport('<?php echo $RegNo;?>imgid')"><center><?php echo $Student; ?></center></td>
                          <?php
                        }
                        else
                        {
                          ?>
                          <td><center><?php echo $RegNo; ?></center></td>

                        <td onclick="togglePassport('<?php echo $RegNo;?>imgid')"><center><?php echo $Student; ?></center></td>
                          <?php
                        }

                    $subCnt=0;

                    $resAnalysis=Module::ReadResultAnalysisp($RegNo,$Session,$Term);
                    $Position=$resAnalysis['ca2_position'];
                    $Appearance=$resAnalysis['appearance'];
                    $Attendance=$resAnalysis['attendance'];
                    $Conduct=$resAnalysis['conduct'];

                    $courseCount=Module::CountStudentSubjectsp($RegNo,$Class,$Session,$Term);

                    $Total=Module::GetTotalScorep($RegNo,$Session,$Term,$Class);
                    $CA1Total=Module::GetTotalCa1Scorep($RegNo,$Session,$Term,$Class);
                    $CA2Total=Module::GetTotalCa2Scorep($RegNo,$Session,$Term,$Class);
                    $CA3Total=Module::GetTotalCa3Scorep($RegNo,$Session,$Term,$Class);                   
                    $ExamTotal=Module::GetTotalExamScorep($RegNo,$Session,$Term,$Class);
                            
                   if($Total<=((44/100)*($courseCount*100)))
                   {
                    $PrincipalRemark="Poor Result, but you can still make it";
                    $Grade="F";
                   }
                   elseif($Total<=((49/100)*($courseCount*100)))
                   {
                    $PrincipalRemark="Wake up before it's too late";
                    $Grade="E";
                   }
                   elseif($Total<=((59/100)*($courseCount*100)))
                   {
                    $PrincipalRemark="Put more effort";
                    $Grade="D";
                   }
                   elseif($Total<=((69/100)*($courseCount*100)))
                   {
                    $PrincipalRemark="Ride on, you can do better";
                    $Grade="C";
                   }
                   elseif($Total<=((79/100)*($courseCount*100)))
                   {
                    $PrincipalRemark="Keep the flag flying";
                    $Grade="B";
                   }
                   else
                   {
                    $PrincipalRemark="Keep shining, its your time";
                    $Grade="A";
                   }


                   //CA1 Total  
                   if($CA1Total<=((44/100)*($courseCount*10)))
                   {
                    $CA1PrincipalRemark="Poor Result, but you can still make it";
                    $CA1Grade="F";
                   }
                   elseif($CA1Total<=((49/100)*($courseCount*10)))
                   {
                    $CA1PrincipalRemark="Wake up before it's too late";
                    $CA1Grade="E";
                   }
                   elseif($CA1Total<=((59/100)*($courseCount*10)))
                   {
                    $CA1PrincipalRemark="Put more effort";
                    $CA1Grade="D";
                   }
                   elseif($CA1Total<=((69/100)*($courseCount*10)))
                   {
                    $CA1PrincipalRemark="Ride on, you can do better";
                    $CA1Grade="C";
                   }
                   elseif($CA1Total<=((79/100)*($courseCount*10)))
                   {
                    $CA1PrincipalRemark="Keep the flag flying";
                    $CA1Grade="B";
                   }
                   else
                   {
                    $CA1PrincipalRemark="Keep shining, its your time";
                    $CA1Grade="A";
                   }


                   //CA2 Total  
                   if($CA2Total<=((44/100)*($courseCount*10)))
                   {
                    $CA2PrincipalRemark="Poor Result, but you can still make it";
                    $CA2Grade="F";
                   }
                   elseif($CA2Total<=((49/100)*($courseCount*10)))
                   {
                    $CA2PrincipalRemark="Wake up before it's too late";
                    $CA2Grade="E";
                   }
                   elseif($CA2Total<=((59/100)*($courseCount*10)))
                   {
                    $CA2PrincipalRemark="Put more effort";
                    $CA2Grade="D";
                   }
                   elseif($CA2Total<=((69/100)*($courseCount*10)))
                   {
                    $CA2PrincipalRemark="Ride on, you can do better";
                    $CA2Grade="C";
                   }
                   elseif($CA2Total<=((79/100)*($courseCount*10)))
                   {
                    $CA2PrincipalRemark="Keep the flag flying";
                    $CA2Grade="B";
                   }
                   else
                   {
                    $CA2PrincipalRemark="Keep shining, its your time";
                    $CA2Grade="A";
                   }




                   //CA3 Total  
                   if($CA3Total<=((44/100)*($courseCount*10)))
                   {
                    $CA3PrincipalRemark="Poor Result, but you can still make it";
                    $CA3Grade="F";
                   }
                   elseif($CA3Total<=((49/100)*($courseCount*10)))
                   {
                    $CA3PrincipalRemark="Wake up before it's too late";
                    $CA3Grade="E";
                   }
                   elseif($CA3Total<=((59/100)*($courseCount*10)))
                   {
                    $CA3PrincipalRemark="Put more effort";
                    $CA3Grade="D";
                   }
                   elseif($CA3Total<=((69/100)*($courseCount*10)))
                   {
                    $CA3PrincipalRemark="Ride on, you can do better";
                    $CA3Grade="C";
                   }
                   elseif($CA3Total<=((79/100)*($courseCount*10)))
                   {
                    $CA3PrincipalRemark="Keep the flag flying";
                    $CA3Grade="B";
                   }
                   else
                   {
                    $CA3PrincipalRemark="Keep shining, its your time";
                    $CA3Grade="A";
                   }

                   //Exam Total 

                   if($ExamTotal<=((44/100)*($courseCount*70)))
                   {
                    $ExamPrincipalRemark="Poor Result, but you can still make it";
                    $ExamGrade="F";
                   }
                   elseif($CA1Total<=((49/100)*($courseCount*70)))
                   {
                    $ExamPrincipalRemark="Wake up before it's too late";
                    $ExamGrade="E";
                   }
                   elseif($ExamTotal<=((59/100)*($courseCount*70)))
                   {
                    $ExamPrincipalRemark="Put more effort";
                    $ExamGrade="D";
                   }
                   elseif($ExamTotal<=((69/100)*($courseCount*70)))
                   {
                    $ExamPrincipalRemark="Ride on, you can do better";
                    $CA1Grade="C";
                   }
                   elseif($ExamTotal<=((79/100)*($courseCount*70)))
                   {
                    $ExamPrincipalRemark="Keep the flag flying";
                    $ExamGrade="B";
                   }
                   else
                   {
                    $ExamPrincipalRemark="Keep shining, its your time";
                    $ExamGrade="A";
                   }


                    $FormMasterRemark=$resAnalysis['formMasterRemark'];
                    if(strtolower($studentDetails['class'])==strtolower($Class))
                    {
                      Module::SaveCA2Analysisp($RegNo,$Session,$Term,$Class,$CA2PrincipalRemark,$CA2Total,$Position);
                    }


                    foreach($Subjects as $subCode)
                    {
                      $subCnt++;
                      if($subNum[$subCnt]==$subCode)
                      {
                        $subResult=Module::ReadSubjectResultp($RegNo,$subCode,$Session,$Term);
                        $ca1=$subResult['ca1'];
                        $ca2=$subResult['ca2'];
                        $ca3=$subResult['ca3'];
                        $exam=$subResult['exam'];
                        $subjectTotalScore=$subResult['total'];
                        
                          ?>
                          <td  style='text-align:center; display: none' 
                              title="<?php echo $RegNo.$studentDetails['names'].$subCode.'ca1'; ?>" id="<?php echo $RegNo.$subCode.'ca1'; ?>" 
                              contenteditable="<?php echo $editStatus;?>" 
                              onkeyup="if(event.keyCode==9){
                                validateca(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');
                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              };" 
                              onkeydown="if(event.keyCode==9){
                                validateca(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');
                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              };" 
                              onkeypress="if(event.keyCode==9){
                                validateca(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');
                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              }; " 
                              onfocus="Current(this.id,'<?php echo $RegNo; ?>','ca1','<?php echo $subCode;?>');validateca(this.id);ShowStatusBar('<?php echo $RegNo; ?>','<?php echo $studentDetails['names']; ?>','<?php echo $RegNo; ?>','CA1','<?php echo $subCode;?>')"><?php echo $ca1; ?>                          
                            </td>
                            <td style='text-align:center' 
                              title="<?php echo $RegNo.$studentDetails['names'].$subCode.'ca2'; ?>" id="<?php echo $RegNo.$subCode.'ca2'; ?>" 
                              
                              <?php if (Module::IsStudentRegisteredp($RegNo,$subCode,$Session,$Term,$Class)): ?>
                                contenteditable="<?php echo $editStatus;?>" 
                              <?php endif ?>

                              onkeyup="if(event.keyCode==9){
                              validateca(this.id);
                              computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');

                              savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                            };" 
                              onkeydown="if(event.keyCode==9){
                                validateca(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');
                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              }; Current(this.id,'<?php echo $RegNo; ?>','ca2','<?php echo $subCode;?>');" 
                              onkeypress="if(event.keyCode==9){
                                validateca(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');
                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              }; "
                              onfocus="Current(this.id,'<?php echo $RegNo; ?>','ca2','<?php echo $subCode;?>');validateca(this.id); ShowStatusBar('<?php echo $RegNo; ?>','<?php echo $studentDetails['names']; ?>','<?php echo $RegNo; ?>','CA2','<?php echo $subCode;?>')"><?php echo $ca2; ?></td>
                            <td style='text-align:center; display: none' 
                              title="<?php echo $RegNo.$studentDetails['names'].$subCode.'ca3'; ?>" id="<?php echo $RegNo.$subCode.'ca3'; ?>" 
                              
                              <?php if (Module::IsStudentRegisteredp($RegNo,$subCode,$Session,$Term,$Class)): ?>
                                contenteditable="<?php echo $editStatus;?>" 
                              <?php endif ?>

                              onkeyup="if(event.keyCode==9){
                              validateca(this.id);
                              computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');

                              savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                            };" 
                              onkeydown="if(event.keyCode==9){
                                validateca(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');
                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              }; Current(this.id,'<?php echo $RegNo; ?>','ca3','<?php echo $subCode;?>');" 
                              onkeypress="if(event.keyCode==9){
                                validateca(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');
                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              }; "
                              onfocus="Current(this.id,'<?php echo $RegNo; ?>','ca3','<?php echo $subCode;?>');validateca(this.id); ShowStatusBar('<?php echo $RegNo; ?>','<?php echo $studentDetails['names']; ?>','<?php echo $RegNo; ?>','CA3','<?php echo $subCode;?>')"><?php echo $ca3; ?></td>
                            <td style='text-align:center; font-weight: bolder; display: none;' title="<?php echo $RegNo.$studentDetails['names'].$subCode.'caT'; ?>" id="<?php echo $RegNo.$subCode.'caT'; ?>"><?php echo $ca1+$ca2+$ca3; ?></td>
                            <td style='text-align:center; display: none' 
                              title="<?php echo $RegNo.$studentDetails['names'].$subCode.'exam'; ?>" 
                              id="<?php echo $RegNo.$subCode.'exam'; ?>" 
                              contenteditable="<?php echo $editStatus;?>"  
                              onkeyup="if(event.keyCode==9){
                                validateexam(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');

                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              };" 
                              onkeydown="if(event.keyCode==9){
                                validateexam(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');
                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              };" 
                              onkeypress="if(event.keyCode==9){
                                validateexam(this.id);
                                computeresult('<?php echo $RegNo; ?>','<?php echo $subCode; ?>');
                                savescore('<?php echo $RegNo; ?>','<?php echo $subCode; ?>','<?php echo $Session; ?>','<?php echo $Term; ?>','<?php echo $Class; ?>')
                              }; "
                              onfocus="Current(this.id,'<?php echo $RegNo; ?>','exam','<?php echo $subCode;?>');validateexam(this.id); ShowStatusBar('<?php echo $RegNo; ?>','<?php echo $studentDetails['names']; ?>','<?php echo $RegNo; ?>','Exam','<?php echo $subCode;?>')"><?php echo $exam; ?></td>
                            <td style='text-align:center; font-weight: bolder; display: none;'  id="<?php echo $RegNo.$subCode.'subjectTotalScore'; ?>" title="<?php echo $RegNo.$studentDetails['names'].$subCode.'subjectTotalScore'; ?>" ><?php echo $subjectTotalScore; ?></td>
                          
                          </td>
                          <?php
                        
                      }
                      else
                      {
                        //The Last Subject
                        echo "<td  style='text-align:center'>.</td>";
                      }          
                    }
                    $tSub=count($Subjects);
                    $tabb=$tSub-$subCnt;
                    while($tabb>0)
                    {
                      echo "<td>.</td>";
                      $tabb--;
                    }
                    ?>
                    <td  style='text-align:center' id='<?php echo $RegNo."Total" ?>' title="<?php echo $studentDetails['names']; ?>"><?php echo Module::GetTotalCa2Scorep($RegNo,$Session,$Term,$Class); ?></td>
                      <?php 


                      if(($courseCount)>0){
                        $avr1=round((Module::GetTotalCa1Scorep($RegNo,$Session,$Term,$Class))/($courseCount),2);
                      }


                    ?>
                    <td <?php if ($avr1<5): ?>
                      style="background: red; text-align:center"
                    <?php endif ?>  style='text-align:center' id='<?php echo $RegNo."Average" ?>'  title="<?php echo $studentDetails['names']; ?>">
                      <?php 
                      echo $avr1;
                      ?>
                        
                      </td>
                      <?php 


                      if(($courseCount)>0){
                        $avr2=round((Module::GetTotalCa2Scorep($RegNo,$Session,$Term,$Class))/($courseCount),2);
                      }


                    ?>
                    <td <?php if ($avr2<5): ?>
                      style="background: red; text-align:center"
                    <?php endif ?>  style='text-align:center' id='<?php echo $RegNo."Average" ?>'  title="<?php echo $studentDetails['names']; ?>">
                      <?php 
                      echo $avr2;
                      ?>
                        
                      </td>
                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."Grade" ?>'  title="<?php echo $studentDetails['names']; ?>"><!--Position -->
                      <?php echo round($avr2-$avr1,2);    ?></td>

                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."Grade" ?>'  title="<?php echo $studentDetails['names']; ?>"><!--Position -->
                      <?php echo $CA2Grade;    ?></td>

                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."Remark" ?>'  title="<?php echo $studentDetails['names']; ?>"><!--P Rmk --><?php

                      $subjectCriterias=array("English Language","Mathematics");
                      $criteriaScore=5;
                      $report_status="";
                      
                      foreach($subjectCriterias as $subjectCriteria)
                      {
                        $subjectResult=Module::ReadSubjectResultp($RegNo,$subjectCriteria,$Session,$Term);

                        if($subjectResult['ca2']<$criteriaScore)
                        {
                          $subjectDetai=Module::ReadSubjectDetailsp($subjectCriteria);

                          $report_s=$subjectDetai['short_code']."; ";
                        }
                        else
                        {
                          $report_s="";
                        }

                        $report_status=$report_status.$report_s;
                      }
                      
                      if(!(strlen($report_status)==0))
                      {
                        echo $report_status;
                      }
                      else
                      {
                        echo "Pass";
                      }

                     ?>  
                   </td>
                    <?php
                  }
                  ?>
                </tbody>
                <tfoot></tfoot>
              </table>
            </td>
          </tr>
          
          
        </table>
        <!--CA Sheet Content ends-->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <style type="text/css">
    #statusBar{
      padding: 5px 15px 5px 5px; 
      background: black; 
      color: white; 
      opacity: 0.5; 
      bottom:10px; 
      width: 95%;
      position: fixed;
    }
    #statusBar:hover{
      opacity: 1;
    }
  </style>
  <!-- Status Bar -->
  <div id="statusBar" >
    <span style="background: red; padding: 5px 5px 5px 5px; color: white;float: right; margin-right: 60px"><button onclick="document.getElementById('statusBar').style.display='none'">X</button></span>
    <span style="background: red; padding: 5px 5px 5px 5px; color: white;">Status Bar</span>

    <span id="statusBarMessage" style="color: white; font-weight: bolder; margin-right: 10px; padding: 5px 5px 5px 5px; "></span>
    <div><span id="total"> </span> <span id="average"> </span> <span id="grade"> </span> <span id="remark"> </span> <span id="position"> </span></div>
  </div>
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



    <!-- The actual snackbar -->
    <div id="snackbar"></div>

      <script src="../js/attracta.js"></script>

      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link href="../styles/loader.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
      <!------ Include the above in your HEAD tag ---------->
    <style type="text/css">
      a{
          padding: 3px 4px 4px 4px;
          text-decoration: none; 
          color:black;
          font-weight: bolder;
          border: 1px groove green;   
        }
        a:hover{
          background: white;
          color: black;
        }
    </style>

        
      <div id="preloader" style="display: none">
        <div id="loader">Please Wait</div>
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


<script src="../../js/attracta.js"></script>
</body>

</html>
