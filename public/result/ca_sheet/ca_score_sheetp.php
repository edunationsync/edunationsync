<?php session_start();

include '../../Module.php';
$school_details=School::ReadSchoolDetails();
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

  $ss=Module::GetClassSessionp($Class);


  $Students=Module::ReadSessionStudentsp($ss,$Class);

  $subDetails=Module::ReadSubjectDetailsp($Subject);
  $sbjt=$subDetails['subject'];

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


  $CA1Status=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"ca_1");
  $CA2Status=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"ca_2");
  $ExamStatus=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"exam");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >


<head> 
    <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>

  
  <script type="text/javascript">
      function checkkey(event)
      {
        if(event.key=="Enter")
        {
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
        document.getElementById(id+"Re").innerHTML = remark;
        document.getElementById(id+"Gr").innerHTML = grade;
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
            document.getElementById("msgContainer").innerHTML = this.responseText;
          }
          else
          {
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

    </script>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Aleka Academy, Ankpa, Kogi State, Nigeria" />
<title><?php echo $Class; ?> SCORE SHEET FOR <?php echo $Subject; ?></title>

</head>

<body  >
  <center>

  <div id='msgContainer1' style="width: 100%">
    <p align="right" style="padding-right: 40px"><button onclick="toggleMenu()" id="btnMenu">Hide Menu</button></p>
    <div id="menu">
        
      <div style="float: left;  padding: 5px 5px 5px 5px; border:2px solid black; min-height: 70px">
        <p>Navigation</p>
        <a href="../index.php">Home</a> <a href="../admin">Portal</a> <a href="../dashboard/">Dashboard</a> <a href="../../logout.php">Logout</a>
      </div>
        
      <div  style="float: left; padding: 5px 5px 5px 5px; border:2px solid black; height: 70px">
        <p>Score Sheets</p>
          
        <a href="ca_sheetp.php?txtsessionp=<?php echo $Session; ?>&txttermp=<?php echo $Term; ?>&txtclassp=<?php echo $Class; ?>&txtsubjectp=<?php echo $Subject; ?>"><button>CA Sheet</button></a> <a href="ca_blank_sheetp.php?txtsessionp=<?php echo $Session; ?>&txttermp=<?php echo $Term; ?>&txtclassp=<?php echo $Class; ?>&txtsubjectp=<?php echo $Subject; ?>"><button>Blank CA Sheet</button></a> <button onclick="print('content')">Print</button> <button onclick="exportTableToExcel('tableData')">Save As Excel</button>
      </div>
    </div>
    
  </div>
  </center>

    <?php
    $cl=substr($Class, strlen($Class)-1,1);
    if($cl=="O")
    {
      $cl= substr($Class, 0,strlen($Class)-1);
    }
    else
    {
      $cl=strtoupper($Class);
    }
    ?>
    <br/><br/><br/>
<br/><br/><br/><br/><br/><br/>

  
  <div class="content" id="content">
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
        font-size: 14px;
      }
      tr:hover{
        background-color: lightgreen;
      }
      tbody{
        font-size: 14px;
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

      input[type=text]:focus
      {
        font-weight: bolder;
        background-color: lightblue;
        color: black;
        border-color: lightblue;
      }


      #msgContainer1
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

    <table cellspacing="0"  id="tableData" border="0" style="margin-left: auto; margin-right: auto;">
      <tr>
        <td style="border:none">
          <header>
            <div class="bheader"><center><b ><hd><?php echo strtoupper($school_details['school_name']); ?></hd></b><br/>
              <hd1><?php echo $Session; ?> <?php echo strtoupper($Term); ?> TERM  CONTINUOUS ASSESSMENT SHEET <br/>FOR <?php echo strtoupper("$Subject $cl");  ?></hd1> <br/>
              <u>SCORE SHEET</u></center></div>
          </header>
            <table cellspacing="0" width="100%">
                
                <thead>
                <tr><td  width="40px"  valign="top">REG. NO.</td><td  valign="top" style="width: 300px">NAME</td><td width="5px" valign="top">CA1</td><td  width="5px" valign="top">CA2</td><td  width="5px" valign="top">CA3</td><td  width="10px" valign="top">EXAM 70%</td></tr></thead>
                <tbody>
                  <?php
                  $count=0;

                  if(isset($_GET['btnSort']))
                  {
                    foreach(Module::ReadTotalsp($Session,$Term,$Class,$Subject) as $Total)
                    {
                      $Position++;
                      Module::SaveBracketPositionsp($Session,$Term,$Class,$Subject,$Total,$Position);
                      $bracketCount=Module::CountSubjectBracketStudentsp($Session,$Term,$Class,$Subject,$Total);
                      $Position=$Position+$bracketCount;
                      $Position=$Position-1;
                    }
                  }

                  foreach($Students as $RegNo)
                  {
                    $count++;

                    $studentDetails=Module::ReadStudentDetailsp($RegNo);
                    $Student=$studentDetails['names'];
                    ?>

                    <tr id="<?php echo $RegNo;?>" onkeyup="checkkey(event);validateca(this.id,'<?php echo $Subject; ?>');

                          computeresult(this.id,'<?php echo $Subject; ?>');

                           savescore(this.id,
                            '<?php echo $Subject; ?>',
                           '<?php echo $Session; ?>',
                           '<?php echo $Term; ?>',
                           '<?php echo $Class; ?>')">
                             <td><?php echo $RegNo;?></td>
                             <td width="200px"><?php echo $Student;?></td>

                    <?php

                    $resultData=Module::ReadStudentResultp($RegNo,$Subject,$Session,$Term);
                    $cA1=$resultData['ca1'];
                    $cA2=$resultData['ca2'];
                    $cA3=$resultData['ca3'];
                    $caTotal=$cA1+$cA2+$cA3;
                    $exam=$resultData['exam'];
                    $Position=$resultData['position'];
                    $Grade=$resultData['grade'];
                    $Remark=$resultData['remark'];
                    $ExTotal=$caTotal+$exam;
                    
                    Module::RegisterSubjectp($RegNo,$Subject,$Session,$Term,$Class);
                    ?>
                      <td class="data" contenteditable="<?php echo $editStatus; ?>" id="<?php echo $RegNo.$Subject; ?>ca1"  ><?php if($cA1>0){echo $cA1;}else{}  ?></td>
                      <td class="data" contenteditable="<?php echo $editStatus; ?>" id="<?php echo $RegNo.$Subject; ?>ca2"><?php  if($cA2>0){echo $cA2;}else{}  ?></td>
                      <td class="data" contenteditable="<?php echo $editStatus; ?>" id="<?php echo $RegNo.$Subject; ?>ca3"><?php  if($cA3>0){echo $cA3;}else{}  ?></td>
                      <td class="data" contenteditable="<?php echo $editStatus; ?>"  id="<?php echo $RegNo.$Subject; ?>exam"><?php if($exam>0){echo $exam;}else{} ?></td>
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
        
    

    <footer></footer>
  </div>

</body>
</html>
