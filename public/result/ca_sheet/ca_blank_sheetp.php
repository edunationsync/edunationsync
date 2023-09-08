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


  $current=Module::ReadCurrentSession();

  if(strtolower($Session)==strtolower($current['session']) && strtolower($Term)==strtolower($current['term']))
  {
    $editStatus='false';
  }
  else
  {
    $editStatus='false';
  }

  $CA1Status=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"ca_1");
  $CA2Status=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"ca_2");
  $ExamStatus=Module::IsResultTypeEntered($Subject,$Session,$Term,$Class,"exam");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >


<head> 
    <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="../styles/attracta.css">

  <style type="text/css">
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
            document.getElementById("msgContainer").innerHTML = this.responseText;
          }
          else
          {
            document.getElementById("preloader").style.display="block";
            document.getElementById("msgContainer").innerHTML = document.getElementById("loader").innerHTML;
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
        xmlhttp.open("GET", "clean_resultp.php" , true);
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
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="Aleka Academy, Ankpa, Kogi State, Nigeria" />


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <title><?php echo $Class; ?> CA Sheet for <?php echo $Subject; ?></title>

</head>

<body style="margin-right: auto; margin-left: auto;" >

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
    <table cellspacing="0" width="100%" id="tableData" border="0">
      <tr>
        <td style="border:none">
           <header>
            <b>
            <div class="bheader"><center><b ><hd><?php echo strtoupper($school_details['school_name']); ?></hd></b><br/>
              <hd1><?php echo $Session; ?> <?php echo strtoupper($Term); ?> TERM <br/> CA SHEET FOR <?php echo strtoupper("$Class");  ?> <br/><?php echo strtoupper("$Subject");  ?></hd1> <br/>
              <u>SCORE SHEET</u></center></div></b>
          </header>
            <table cellspacing="0" width="100%">
              
              <thead>
              <tr><td  width="40px"  valign="top">REG. NO.</td><td  valign="top" style="width: 300px">NAME</td><td width="5px" valign="top">CA1</td><td  width="5px" valign="top">CA2</td><td  width="5px" valign="top">CA3</td><td  width="10px" valign="top">TCA 30%</td><td  width="10px" valign="top">EXAM 70%</td><td  width="10px" valign="top">TOT 100%</td><td  width="5px" valign="top">POS</td><td  width="70px" valign="top">GRADE</td><td  width="70px" valign="top">RMK</td></tr></thead>
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

                  <tr id="<?php echo $RegNo;?>" onkeyup="if(event.keyCode==9){

                    checkkey(event);validateca(this.id);

                    computeresult(this.id);

                    savescore(this.id, '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>')
                  }"  onkeydown="if(event.keyCode==9){

                    checkkey(event);validateca(this.id);

                    computeresult(this.id);

                    savescore(this.id, '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>')
                  }"  onkeypress="if(event.keyCode==9){

                    checkkey(event);validateca(this.id);

                    computeresult(this.id);

                    savescore(this.id, '<?php echo $Subject; ?>', '<?php echo $Session; ?>', '<?php echo $Term; ?>', '<?php echo $Class; ?>')
                  }">
                                    
                    <?php 
                    if(isset($_SESSION['lgina']) && $_SESSION['post']=="assistant headmistress" ||$_SESSION['post']=="assistant headmaster"||$_SESSION['post']=="webmaster" ||$_SESSION['post']=="exams & records")
                    {
                      ?>
                      <td><center><?php echo $RegNo; ?></center></td>

                    <td  onclick="togglePassport('<?php echo $RegNo;?>imgid')"><?php echo $Student; ?></td>
                      <?php
                    }
                    else
                    {
                      ?>
                      <td><center><?php echo $RegNo; ?></center></td>

                    <td onclick="togglePassport('<?php echo $RegNo;?>imgid')"><?php echo $Student; ?></td>
                      <?php
                    }

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

                    <td class="data"id="<?php echo $RegNo; ?>ca1" ></td>
                    <td class="data" id="<?php echo $RegNo; ?>ca2"></td>
                    <td class="data" id="<?php echo $RegNo; ?>ca3"></td>
                    <td class="data" id="<?php echo $RegNo; ?>caT"></td>
                    <td class="data" id="<?php echo $RegNo; ?>exam"></td>
                    <td class="data" id="<?php echo $RegNo; ?>exT"></td>
                    <td class="data" id="<?php echo $RegNo; ?>Pos"></td>             
                    <td class="data" id="<?php echo $RegNo; ?>Gr"></td>
                    <td class="data" id="<?php echo $RegNo; ?>Re"></td>
                  </tr>

                  <?php
                }
                ?>
              </tbody>
              <tfoot></tfoot>
            </table>

            <table style="padding: 10px 10px 10px 10px; width: 100% " cellspacing="0">              
              <?php
              $subjectresultsummary=Analysis::ReadSubjectResultSummary($Class,$Subject,$Session,$Term);
              ?>
              <tr><th colspan="9">SUBJECT RESULT ANALYSIS</th></tr>
              <tr>
                <th style="text-align: center">A1</th>
                <th style="text-align: center">B2</th>
                <th style="text-align: center">B3</th>
                <th style="text-align: center">C4</th>
                <th style="text-align: center">C5</th>
                <th style="text-align: center">C6</th>
                <th style="text-align: center">D7</th>
                <th style="text-align: center">E8</th>
                <th style="text-align: center">F9</th>
              </tr>
              <tr>
                <td style="text-align: center">_</td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td></tr>
              <tr>
                <td colspan="2">High Score</td><td colspan="2" style="text-align: center"></td><td></td>
                <td colspan="2">Least Score</td><td colspan="2" style="text-align: center"></td></tr>
              <tr>
                <td colspan="2">Total High Score</td><td colspan="2" style="text-align: center"></td><td></td>
                <td colspan="2">Total Least Score</td><td colspan="2" style="text-align: center"></td></tr>
              <tr>
                <td colspan="2">Total Pass</td><td colspan="2" style="text-align: center"></td><td></td>
                <td colspan="2">Total Fail</td><td colspan="2" style="text-align: center"></td></tr>
            </table>

        </td>
      </tr>
    </table>
        
    

    <footer></footer>
  </div>


  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <div id="preloader" style="display: none">
    <div id="loader"></div>
  </div>

</body>


<script src="../js/attracta.js"></script>

</html>
