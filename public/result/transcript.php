<?php session_start();
include '../Module.php';
$school_details=School::ReadSchoolDetails();

  $regno=$_GET['regno'];
  
  $studentDetails=Module::ReadStudentDetailsp($regno);
  $Student=$studentDetails['names'];


$ss=Module::GetClassSessionp($Class);

  $Students=Module::ReadSessionStudentsp($ss,$Class);

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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >


<head>
    <link rel="icon" type="image/png" href="../images/school/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="../styles/attracta.css">
    <script type="text/javascript">
      //New Script from CA Sheet

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

          //Read all the subjects and add the scores of each subject
          subjects=JSON.parse('<?php echo json_encode(Module::ReadClassSubjectsp($Class)); ?>');
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
              document.getElementById("msgContainer").innerHTML = this.responseText;
            }
            else
            {   

              document.getElementById("preloader").style.display="block";           
              document.getElementById("msgContainer").innerHTML = "Loading...";
            }
          };
          xmlhttp.open("GET", "savescorep.php?student="+id+
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
          xmlhttp.open("GET", "clean_result_analysisp.php" , true);
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
              document.getElementById(students[i]+subjects[s]+"ca1").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca2").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"exam").contentEditable="true";
              document.getElementById(students[i]+subjects[s]+"ca1").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"ca2").style.backgroundColor="lightblue";
              document.getElementById(students[i]+subjects[s]+"exam").style.backgroundColor="lightblue";
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
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Aleka Academy, Ankpa, Kogi State, Nigeria" />
    <title>Master Sheet for <?php echo $Class; ?></title>

    <style type="text/css">
      hd{
        font-size: 24px;
      }
      hd1{
        font-size: 19px;
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

      

      .msgContainer1{
        background: #4F3611;
      }

      a{
          background: lightgreen;
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
</head>

<body  >
  <center>
    <div id='msgContainer1' class="msgContainer1" style="width: 100%">
      <p align="right" style="padding-right: 40px"><button onclick="toggleMenu(this.id,'menu')" id="btnMenu" title="Toggle Menu bar Display">Hide Menu</button><button onclick="document.getElementById('msgContainer1').style.display='none'" title="Close the menu bar">X</button></p>
      <div id="menu" class="msgContainer1" style="color: white">
        


        <div style="float: left;  padding: 5px 5px 5px 5px; border:2px solid black; height: 70px;">
            
          <button href="#" onclick="window.history.back()" style="float: left">Back</button>
          <button onclick="toggleMenu(this.id,'navmenu')" id="btnNavMenu"> Show Menu</button>
          <div id="navmenu" class="navmenu" style="width: 100%; display: none; background: white">
            <p><a href="../index.php">Home</a><a href="../dashboard/" title="Return to Dashbaord">Dashboard</a><a href="../dashboard/users/allstudents.php?txtclassp=<?php echo $Class; ?>">Students</a><a href="../result/psychomotorp.php?sessionp=<?php echo $Session;?>&classp=<?php echo $Class;?>&termp=<?php echo $Term;?>" title="Manipulate the Psychomotor Ratings of all the Students">Ratings</a><a href="../portal/student_resultp.php?session=<?php echo $Session;?>&class=<?php echo $Class;?>&term=<?php echo $Term;?>" title="Verify Result of each students in a clearer context">Personal Entrance</a><a href="../portal/allresultsp.php?prsession=<?php echo $Session;?>&prclass=<?php echo $Class;?>&prterm=<?php echo $Term;?>" title="Print the Result Sheet of all the students">Result Sheets</a><a href="ca_sheetall.php?txtsessionp=<?php echo $Session; ?>&txtclassp=<?php echo $Class; ?>&txttermp=<?php echo $Term; ?>">All CA Sheets</a><a href="../result/ca_sheetall.php?txtsessionp=<?php echo $Session;?>&txtclassp=<?php echo $Class;?>&txttermp=<?php echo $Term;?>" title="Print all the CA Sheets ">All Score Sheets</a><a href="../result/ca1_master_sheet.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>" title="CA 1 Master Master Sheet">CA 1 Master Sheet</a><a href="../result/ca2_master_sheet.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>" title="CA 2 Master Master Sheet">CA 2 Master Sheet</a><a href="../result/exam_master_sheet.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>" title="Exam Master Master Sheet">Exam Master Sheet</a><a href="../result/master_summary_form.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>" title="Master Result Summary Form">Master Summary Form</a><a href="../result/master_summary_sheet.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>" title="Master Result Summary Sheet">Master Summary Sheet</a></p>
          </div>                   
        </div>
      </div>
      <div id="msgContainer"><?php if(isset($_GET['btnSort'])){
        echo "Position Processing Mode. Click here to return to normal mode <br/>";
        ?><a href="../result/master_sheetp.php?txtclass=<?php echo $Class; ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>" title="Normal Mode">Normal Mode</a>
        <?php
      }?></div>
    </div>
  </center>
<div class="content">

  <?php
  $cl=substr($Class, strlen($Class)-1,1);
  if($cl=="O")
  {
    $cl= substr($Class, 0,strlen($Class)-1);
  }
  else
  {
    $cl=strtoupper($Class);
  } ?>


  <div id="content1">

  <style>
    body 
    {
      
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
      background-color: lightgreen; 
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
    input[type=text]
    {
      margin: 0px 0px 0px 0px;
      border: 1px solid white;
      width: 10px;
      height: 100%;
      text-align: center;
      font-size: 9px;
    }
    form{
      float: left;
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

    #msgContainer1
    {      
      padding: 15px 15px 15px 15px;
      color: yellow;
      font-weight: bolder;
      text-align: center;
      font-size: 12px;
      overflow: left;
      background: #4F3611;
      min-height: 230px
    }

</style>
    <table id="tableData" width="100%">
      <tr>
        <td style="border:none">
          <header>
            <center><div class="bheader">
              <hd><?php echo strtoupper($school_details['school_name']); ?></hd><br/>
              <hd1>RESULT TRANSCRIPT FOR <?php echo $regno;  ?></hd1> </div>
            </center>
          </header>
          <table cellspacing="0" width="100%" style="font-size: 12px">
            <thead><tr><td width="20px"  valign='top' rowspan='2'><center>S/N</center></td>
                <td valign='top' rowspan='2'>SUBJECT</td>
              <?php
              $cnt=0;
              $Sessions=Module::ReadStudentSessionsp($regno);
              
              foreach($Sessions as $session)
              {
                $cnt++; ?>
                <td valign='top' colspan='7'>
                  <center>                    
                      <?php
                      echo strtoupper($session);
                      ?></a>
                  </center>
                </td> 
                <?php   
              }
              echo "<tr>";
                foreach($Sessions as $Session)
                { 
                  echo "<td valign='top'><center>TERM1</center></td><td valign='top'><center>TERM2</center></td><td valign='top'><center>TERM3</center></td><td valign='top'><center>TOT</center></td><td valign='top'><center>AVR</center></td><td valign='top'><center>GR</center></td><td valign='top'><center>REM</center></td>";
                }               
                ?>
            </thead>
            <tbody>
              <?php
              $count=0;
                $Subjects =Module::ReadStudentSessionSubjects($regno, $session);
                foreach($Subjects as $Subject)
                {
                  $count++;
                  ?>
                  <tr id="<?php echo $RegNo.$Session.$Subject; ?>" >
                      <td><?php echo $count; ?></td>
                      <td><?php echo $Subject; ?></td>
                    <?php 
                    $subCnt=0;
                    foreach($Sessions as $session)
                    {
                        $Term1="First";
                        $Term2="Second";
                        $Term3="Third";
                        
                        $term1= Module::ReadSubjectResultp($regno,$Subject,$session,$Term1);
                        $term2=Module::ReadSubjectResultp($regno,$Subject,$session,$Term2);
                        $term3=Module::ReadSubjectResultp($regno,$Subject,$session,$Term3);
                        $total=$term1['total']+$term2['total']+$term3['total'];
                        $average=round($total/3,2);
                        
                        if($total<=((49/100)*300))
                        {
                         $Remark="Fail";
                         $Grade="F";
                        }
                        elseif($total<=((59/100)*300))
                        {
                         $Remark="Fair";
                         $Grade="D";
                        }
                        elseif($total<=((69/100)*300))
                        {
                         $Remark="Pass";
                         $Grade="D";
                        }
                        elseif($total<=((78/100)*300))
                        {
                         $Remark="Credit";
                         $Grade="C";
                        }
                        elseif($total<=((89/100)*300))
                        {
                         $Remark="Very Good";
                         $Grade="B";
                        }
                        else
                        {
                         $Remark="Excellent";
                         $Grade="A";
                        }
                        
                      ?>
                      <td  style='text-align:center'><?php echo $term1['total']; ?></td>
                      <td  style='text-align:center'><?php echo $term2['total']; ?></td>
                      <td  style='text-align:center'><?php echo $term3['total']; ?></td>
                      <td  style='text-align:center'><?php echo $total; ?></td>
                      <td  style='text-align:center'><?php echo $average; ?></td>
                      <td  style='text-align:center'><?php echo $Grade; ?></td>
                      <td  style='text-align:center'><?php echo $Remark; ?></td>
                      <?php                      
                    }                  
                  }
                  ?>
                  </tr>
                  <?php
                         
              ?>
            </tbody>
            <tfoot></tfoot>
          </table>
        </td>
      </tr>
      
      
    </table>

  </div>
  

  <footer></footer>
</div>

  <script src="../js/attracta.js"></script>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->
<style type="text/css">
  a{
      background: lightgreen;
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
</body>
</html>
