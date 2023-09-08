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

            var tt=eval(document.getElementById(ids+subjects[s]+"subjectTotalScore").innerHTML);
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
          if(Total<=((39/100)*(subjects.length*100))){
            Grade="F9";
            Remark="Poor Result, but you can still make it";
          }
          else if(Total<=((44/100)*(subjects.length*100))){
            Grade="E8";
            Remark="Wake up before it's too late";
          }
          else if(Total<=((49/100)*(subjects.length*100))){
            Grade="D7";
            Remark="Put more effort";
          }
          else if(Total<=((54/100)*(subjects.length*100))){
            Grade="C6";
            Remark="Ride on with more effort";
          }
          else if(Total<=((59/100)*(subjects.length*100))){
            Grade="C5";
            Remark="Ride on, you can do better";
          }
          else if(Total<=((64/100)*(subjects.length*100))){
            Grade="C4";
            Remark="Ride on, its good";
          }
          else if(Total<=((69/100)*(subjects.length*100))){
            Grade="B3";
            Remark="Keep the flag flying";
          }
          else if(Total<=((74/100)*(subjects.length*100))){
            Grade="B2";
            Remark="Good to go, Keep the flag flying";
          }
          else if(Total>=((70/100)*(subjects.length*100))){
            Grade="A1";
            Remark="Keep shining, its your time";
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
          subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSessionSubjectsp($Class,$Session,$Term)); ?>');
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
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSessionSubjectsp($Class,$Session,$Term)); ?>');
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
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSessionSubjectsp($Class,$Session,$Term)); ?>');
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
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSessionSubjectsp($Class,$Session,$Term)); ?>');
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
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSessionSubjectsp($Class,$Session,$Term)); ?>');
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
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSessionSubjectsp($Class,$Session,$Term)); ?>');
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
            subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSessionSubjectsp($Class,$Session,$Term)); ?>');
            for (var s = subjects.length - 1; s >= 0; s--) {
              document.getElementById(students[i]).style.backgroundColor="transparent";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="transparent";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="transparent";
              document.getElementById(students[i]+subjects[s]+"ca3").style.backgroundColor="transparent";
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
            else if(headd==='ca3'){              
              document.getElementById(students[i]+subject+"ca3").style.backgroundColor="lightblue";
            }
            else if(headd==='exam'){
              document.getElementById(students[i]+subject+"exam").style.backgroundColor="lightblue";
            }            
          }
          
          document.getElementById(cellid).style.backgroundColor="white";
          document.getElementById(rowid).style.backgroundColor="lightblue";
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

  <div >

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px">
            <a href="../../result/psychomotorp.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>">Ratings</a> | <a href="../master_sheet/master_sheet_ca1.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">CA1 Sheet</a> | <a href="../master_sheet/master_sheet_ca2.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">CA2 Sheet</a> | <a href="../master_sheet/master_sheet_ca3.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">CA3 Sheet</a> | <a href="../master_sheet/master_sheet_exam.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">Exam Sheet</a> | <a href="../master_sheet/master_sheetp.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">Master Sheet</a> | <a href="../../portal/individual_student_resultp.php?class=<?php echo $Class; ?>&session=<?php echo $Session; ?>&term=<?php echo $Term; ?>">Individual Updater</a> | <a href="../result_summary.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>&termp=<?php echo $Term; ?>">Term Summary</a> | <a href="../session_result_summary.php?classp=<?php echo $Class; ?>&sessionp=<?php echo $Session; ?>">Session Summary</a> | <a href="../../portal/allresultsp.php?prclass=<?php echo $Class; ?>&prsession=<?php echo $Session; ?>&prterm=<?php echo $Term; ?>">Result Sheets</a>
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <div style="padding-left: 25px; background: black; padding: 10px 10px 10px 10px; font-size: 12px;">
            <?php
            $Classesss=Module::ReadAllClassesp();

            foreach($Classesss as $classes_s)
            {
              if($Class ==$classes_s)
              {
                ?>
                <a href="./master_sheet_sessionp.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $classes_s; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: white; color: black"><?php echo $classes_s; ?></a>
                <?php
              }
              else
              {
                ?>
                <a href="./master_sheet_sessionp.php?txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $classes_s; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;"><?php echo $classes_s; ?></a>
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
                <a href="./master_sheet_sessionp.php?txtsession=<?php echo $Session_s; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: white; color: black"><?php echo $Session_s; ?></a>
                <?php
              }
              else
              {
                ?>
                <a href="./master_sheet_sessionp.php?txtsession=<?php echo $Session_s; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $Class; ?>" style="padding: 4px 4px 4px 4px; margin: 4px 4px 4px 4px; background: black; color: white;"><?php echo $Session_s; ?></a>
                <?php                
              }
            }
            ?>
            
          </div>
        </ol><!-- Breadcrumbs-->

        <!-- Result Menu-->
        <ol class="breadcrumb"> 

          <a href="master_sheet_sessionp_print.php?txtsession=<?php echo $Session_s; ?>&txtterm=<?php echo $Term ?>&txtclass=<?php echo $Class; ?>" target="_blank">Print Sheet</a>           
          <div style="padding-right: 15px">
             <form method="GET" action="../ca_sheet/">
                <input type="hidden" id="txtsessionp" name="txtsessionp" value='<?php echo $Session; ?>'>
                <input type="hidden" id="txttermp" name="txttermp" value='<?php echo $Term; ?>'>
                <input type="hidden" id="txtclassp" name="txtclassp" value='<?php echo $Class; ?>'>
                <?php $Subjects=Module::ReadClassSessionSubjectsp($Class,$Session,$Term); ?>
                <select id="txtsubjectp" name="txtsubjectp" style="width: 100px">
                  <?php 
                  foreach ($Subjects as $Subjectsss) {
                    ?>
                    <option><?php echo $Subjectsss; ?></option>
                    <?php
                  }
                  ?>
                  
                </select><input type="submit" value="Open CA Sheet" title="Open CA Sheet of the selected subject">
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
                  <hd1><?php echo $Session; ?> CUMMULATIVE MASTER RESULT SHEET  FOR <?php echo strtoupper($Class);  ?></hd1> </div>
                </center>
              </header>
              <table cellspacing="0" width="100%" style="font-size: 12px">
                <thead><tr><td width="20px"  valign='top' rowspan='2'><center>REG</center></td><td width="250px" valign='top' rowspan='2'>NAME</td>
                  <?php
                  $cnt=0;
                  $cls=substr($Class, 0,9);

                    $Subjects=Module::ReadClassSessionSubjectsp($Class,$Session,$Term);
                  
                  foreach($Subjects as $subject)
                  {
                    $cnt++;
                    $subNum[$cnt]=$subject;
                    $subDetails=Module::ReadSubjectDetailsp($subject); ?>

                    <td valign='top' colspan='5'>
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

                  <td  width="70px" valign="top" rowspan='2'><center>TOTAL</center></td><td  width="70px" valign="top" rowspan='2'><center>AVER</center></td><td  width="70px" valign="top" rowspan='2'><center>POSITION</center></td></tr>
                  <?php
                  echo "<tr>";
                    foreach($Subjects as $subject)
                    { 
                      echo "<td valign='top'><center>1ST</center></td><td valign='top'><center>2ND</center></td><td valign='top'><center>3RD</center></td><td valign='top'><center>TOT</center></td><td valign='top'><center>POS</center></td>";
                    }
                   
                    ?>
                </thead>
                <tbody>
                  <?php
                  $count=0;

                  foreach($Students as $RegNo)
                  {
                    //$Subjects=Module::ReadClassSessionSubjectsp($Class,$Session,$Term);
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


                    $courseCount=Module::CountStudentSubjectsp($RegNo,$Class,$Session,$Term);

                    foreach($Subjects as $subCode)
                    {
                      $subCnt++;
                      if($subNum[$subCnt]==$subCode)
                      {
                        $subOverallResult=Module::ReadStudentSessionSubjectResultAnalysisp($RegNo,$Session,$subCode);

                        $firstTermResultData=Module::ReadStudentResultp($RegNo,$subCode,$Session,"First");

                        $secondTermResultData=Module::ReadStudentResultp($RegNo,$subCode,$Session,"Second");

                        $thirdTermResultData=Module::ReadStudentResultp($RegNo,$subCode,$Session,"Third");
                        
                        ?>
                        <td><center><?php echo round($firstTermResultData['total'],2); ?></center></td>
                        <td><center><?php echo round($secondTermResultData['total'],2); ?></center></td>
                        <td><center><?php echo round($thirdTermResultData['total'],2); ?></center></td>
                        <td><center><?php echo $subOverallResult['total']; ?></center></td>
                        <td><center><?php $Position=$subOverallResult['position'];
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
                          elseif($lPos=='' || $Position=0)
                          {
                            echo "<sup></sup>";        
                          }
                          else
                          {
                            echo "<sup>th</sup>";
                          }

                         ?></center></td>
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

                    <?php

                    $resAnalysis=Analysis::ReadSessionResultAnalysisp($RegNo,$Session,$Class);


                    $overallTotal=$resAnalysis['total'];
                    $overallAverage=$resAnalysis['average'];
                    $overallPosition=$resAnalysis['position'];

                    ?>
                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."Grade" ?>'  title="<?php echo $studentDetails['names']; ?>"><!--Position -->
                      <?php echo $overallTotal;    ?></td>

                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."Remark" ?>'  title="<?php echo $studentDetails['names']; ?>"><!--P Rmk -->
                      <?php echo $overallAverage; ?></td>


                    
                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."Position"?>'  title="<?php echo $studentDetails['names']; ?>"><!--Position -->
                       <?php 
                      if(isset($overallPosition))
                      {
                        echo $overallPosition; 
                        $lPos=substr($overallPosition, strlen($overallPosition)-1,1);      
                        if($lPos==1 && $overallPosition!=11)
                        {
                          echo "<sup>st</sup>";        
                        }
                        elseif($lPos==2  && $overallPosition!=12)
                        {
                          echo "<sup>nd</sup>";        
                        }
                        elseif($lPos==3  && $overallPosition!=13)
                        {
                          echo "<sup>rd</sup>";        
                        }
                        elseif($lPos=='' || $overallPosition=0)
                        {
                          echo "<sup></sup>";        
                        }
                        else
                        {
                          echo "<sup>th</sup>";
                        }
                      }
                      
                      ?></td>
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
