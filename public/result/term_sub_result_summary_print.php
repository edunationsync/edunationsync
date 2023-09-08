<?php session_start();
include '../Module.php';
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



  if(isset($_GET['btnSubjectSort']))
  {
    $pSubjects=Module::ReadClassSessionSubjectsp($Class,$Session,$Term);
    foreach ($pSubjects as $pSubjects) {

      foreach(Module::ReadTotalsp($Session,$Term,$Class,$pSubject) as $pTotal)
      {
        $pPosition++;
        Module::SaveBracketPositionsp($Session,$Term,$Class,$pSubject,$pTotal,$pPosition);
        $pBracketCount=Module::CountSubjectBracketStudentsp($Session,$Term,$Class,$pSubject,$pTotal);
        $pPosition=$pPosition+$pBracketCount;
        $pPosition=$pPosition-1;
      }
    }
    
  }

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

  <title>CA Sheet <?php echo $Subject.' '.$Class.' '.$Session.' '.$Term; ?></title>
  <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
  <!-- Custom fonts for this template-->
  <link href="../dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../dashboard/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../dashboard/css/sb-admin.css" rel="stylesheet">

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



          if(values>20)
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

          if(values>60)
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
          cat=eval(ca1)+eval(ca2);
          total=eval(cat)+eval(exam);

          document.getElementById(id+"subjectTotalScore").innerHTML = eval(total);
          document.getElementById(id+"caT").innerHTML = eval(cat);

          if(total=='')
            total=0;
          if(Total<=((39/100)*(subjects.length*100))){
            Grade="F";
            Remark="Fail";
          }
          else if(Total<=((44/100)*(subjects.length*100))){
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
          else if(Total<=((79/100)*(subjects.length*100))){
            Grade="A";
            Remark="Excellent";
          }
          else{
            Grade="A+";
            Remark="Excellent";
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
          xmlhttp.open("GET", "master_sheet/generate_positions.php?sub="+sub+'&session='+session+'&term='+term+'&class='+classs , true);
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
            xmlhttp.open("GET", "master_sheet/result_analysis_details.php?sub="+sub+"&reg_no="+students[i]+'&session='+session+'&term='+term, true);
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

<body>

        <!-- Icon Cards-->
        <!--CA Sheet Content start-->
        <table width="100%">
          <tr>
            <td style="border:none">
              <header>
                <center><img src="../images/school/logo.png" width="100px"><br/><div class="bheader">
                  <hd><?php echo strtoupper($school_details['school_name']); ?></hd><br/>
                  TERM SUB RESULT SUMMARY FOR <?php echo strtoupper($Class);  ?><br/>
                  <hd1><?php echo $Session; ?> <?php echo  strtoupper($Term); ?> TERM </hd1> </div>
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

                    <td valign='top' colspan='1'>
                      <center>
                        <a style="background: transparent; border:none" href="ca_sheet/?txtsessionp=<?php echo $Session; ?>&txttermp=<?php echo $Term; ?>&txtclassp=<?php echo $Class; ?>&txtsubjectp=<?php echo $subject; ?>">
                          <?php
                          echo strtoupper($subDetails['short_code']);
                          ?></a>
                      </center>
                    </td> 
                    <?php   
                  }
                  ?>

                  <td  width="70px" valign="top" rowspan='2'><center>CA1 TOT</center></td><td  width="70px" valign="top" rowspan='2'><center>CA1 AVE</center></td><td  width="70px" valign="top" rowspan='2'><center>CA1 POS</center></td>

                  <td  width="70px" valign="top" rowspan='2'><center>CA2 TOT</center></td><td  width="70px" valign="top" rowspan='2'><center>CA2 AVE</center></td><td  width="70px" valign="top" rowspan='2'><center>CA2 POS</center></td>


                  <td  width="70px" valign="top" rowspan='2'><center>EXAM TOT</center></td><td  width="70px" valign="top" rowspan='2'><center>EXAM AVE</center></td><td  width="70px" valign="top" rowspan='2'><center>EXAM POS</center></td>


                  <td  width="70px" valign="top" rowspan='2'><center>TOTAL</center></td><td  width="70px" valign="top" rowspan='2'><center>AVER</center></td><td  width="70px" valign="top" rowspan='2'><center>POSITION</center></td>

                  <td  width="70px" valign="top" rowspan='2'><center>GRADE</center></td><td  width="70px" valign="top" rowspan='2'><center>HM'S REMARK</center></td><!--<td  width="70px" valign="top"><center>FORM M. REMARK</center></td><td  width="70px" valign="top"><center>ATTENDANCE</center></td><td  width="70px" valign="top"><center>CONDUCT</center></td><td  width="70px" valign="top"><center>APPEARANCE</center></td>--></tr>
                  <?php
                  echo "<tr>";
                    foreach($Subjects as $subject)
                    { 
                      echo "<td valign='top' style='background:lightblue;'><center>100%</center></td>";
                    }
                   
                    ?>
                </thead>
                <tbody>
                  <?php
                  $count=0;

                  if(isset($_GET['btnSort']))
                  {
                    Module::UpdateTermPositions($Session,$Term,$Class);
                  }

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
                    
                    if(strtolower($studentDetails['class'])==strtolower($Class))
                    {
                      if(isset($_GET['btnTotalUpdater']) &&($_GET['btnTotalUpdater']=="true"))
                      {
                        Analysis::ProcessResultAnalysisp($RegNo,$Class,$Session,$Term);
                      }
                    }

                    foreach($Subjects as $subCode)
                    {
                      $subCnt++;
                      if($subNum[$subCnt]==$subCode)
                      {
                        $subResult=Module::ReadSubjectResultp($RegNo,$subCode,$Session,$Term);
                        $ca1=$subResult['ca1'];
                        $ca2=$subResult['ca2'];
                        //$ca3=$subResult['ca3'];
                        $exam=$subResult['exam'];
                        $subjectTotalScore=$subResult['total'];
                        
                          ?>
                            <td style='text-align:center; font-weight: bolder;'  id="<?php echo $RegNo.$subCode.'subjectTotalScore'; ?>" title="<?php echo $RegNo.$studentDetails['names'].$subCode.'subjectTotalScore'; ?>" ><?php echo $subjectTotalScore; ?></td>
                          
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


                    $resAnalysis=Analysis::ReadResultAnalysisp($RegNo,$Session,$Term);
                    ?>
                    <td  style='text-align:center' id='<?php echo $RegNo."ca1_Total" ?>' title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['ca1_total']; ?></td>
                    
                    <td  style='text-align:center' id='<?php echo $RegNo."ca1_Average" ?>'  title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['ca1_average']; ?></td>
                    
                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."ca1_Position"?>'  title="<?php echo $studentDetails['names']; ?>"><!--Position -->
                       <?php 
                      if(isset($resAnalysis['ca1_position']))
                      {
                        echo $resAnalysis['ca1_position']; 
                        $lPos=substr($resAnalysis['ca1_position'], strlen($resAnalysis['ca1_position'])-1,1);      
                        if($lPos==1 && $resAnalysis['ca1_position']!=11)
                        {
                          echo "<sup>st</sup>";        
                        }
                        elseif($lPos==2  && $resAnalysis['ca1_position']!=12)
                        {
                          echo "<sup>nd</sup>";        
                        }
                        elseif($lPos==3  && $resAnalysis['ca1_position']!=13)
                        {
                          echo "<sup>rd</sup>";        
                        }
                        elseif($lPos=='' || $resAnalysis['ca1_position']=0)
                        {
                          echo "<sup></sup>";        
                        }
                        else
                        {
                          echo "<sup>th</sup>";
                        }
                      }
                      
                      ?></td>





                    <td  style='text-align:center' id='<?php echo $RegNo."ca2_Total" ?>' title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['ca2_total']; ?></td>
                    
                    <td  style='text-align:center' id='<?php echo $RegNo."ca2_Average" ?>'  title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['ca2_average']; ?></td>
                    
                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."ca2_Position"?>'  title="<?php echo $studentDetails['names']; ?>"><!--Position -->
                       <?php 
                      if(isset($resAnalysis['ca2_position']))
                      {
                        echo $resAnalysis['ca2_position']; 
                        $lPos=substr($resAnalysis['ca2_position'], strlen($resAnalysis['ca2_position'])-1,1);      
                        if($lPos==1 && $resAnalysis['ca2_position']!=11)
                        {
                          echo "<sup>st</sup>";        
                        }
                        elseif($lPos==2  && $resAnalysis['ca2_position']!=12)
                        {
                          echo "<sup>nd</sup>";        
                        }
                        elseif($lPos==3  && $resAnalysis['ca2_position']!=13)
                        {
                          echo "<sup>rd</sup>";        
                        }
                        elseif($lPos=='' || $resAnalysis['ca2_position']=0)
                        {
                          echo "<sup></sup>";        
                        }
                        else
                        {
                          echo "<sup>th</sup>";
                        }
                      }
                      
                      ?></td>



                    <td  style='text-align:center' id='<?php echo $RegNo."exam_Total" ?>' title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['exam_total']; ?></td>
                    
                    <td  style='text-align:center' id='<?php echo $RegNo."exam_Average" ?>'  title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['exam_average']; ?></td>
                    
                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."exam_Position"?>'  title="<?php echo $studentDetails['names']; ?>"><!--Position -->
                       <?php 
                      if(isset($resAnalysis['exam_position']))
                      {
                        echo $resAnalysis['exam_position']; 
                        $lPos=substr($resAnalysis['exam_position'], strlen($resAnalysis['exam_position'])-1,1);      
                        if($lPos==1 && $resAnalysis['exam_position']!=11)
                        {
                          echo "<sup>st</sup>";        
                        }
                        elseif($lPos==2  && $resAnalysis['exam_position']!=12)
                        {
                          echo "<sup>nd</sup>";        
                        }
                        elseif($lPos==3  && $resAnalysis['exam_position']!=13)
                        {
                          echo "<sup>rd</sup>";        
                        }
                        elseif($lPos=='' || $resAnalysis['exam_position']=0)
                        {
                          echo "<sup></sup>";        
                        }
                        else
                        {
                          echo "<sup>th</sup>";
                        }
                      }
                      
                      ?></td>





                    <td  style='text-align:center' id='<?php echo $RegNo."Total" ?>' title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['total']; ?></td>
                    
                    <td  style='text-align:center' id='<?php echo $RegNo."Average" ?>'  title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['average']; ?></td>
                    
                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."Position"?>'  title="<?php echo $studentDetails['names']; ?>"><!--Position -->
                       <?php 
                      if(isset($resAnalysis['position']))
                      {
                        echo $resAnalysis['position']; 
                        $lPos=substr($resAnalysis['position'], strlen($resAnalysis['position'])-1,1);      
                        if($lPos==1 && $resAnalysis['position']!=11)
                        {
                          echo "<sup>st</sup>";        
                        }
                        elseif($lPos==2  && $resAnalysis['position']!=12)
                        {
                          echo "<sup>nd</sup>";        
                        }
                        elseif($lPos==3  && $resAnalysis['position']!=13)
                        {
                          echo "<sup>rd</sup>";        
                        }
                        elseif($lPos=='' || $resAnalysis['position']=0)
                        {
                          echo "<sup></sup>";        
                        }
                        else
                        {
                          echo "<sup>th</sup>";
                        }
                      }
                      
                      ?></td>
                    
                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."Grade" ?>'  title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['grade']; ?></td>

                    <td  style='text-align:center; padding-right: 10px' id='<?php echo $RegNo."Remark" ?>'  title="<?php echo $studentDetails['names']; ?>"><?php echo $resAnalysis['remark']; ?></td>
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
