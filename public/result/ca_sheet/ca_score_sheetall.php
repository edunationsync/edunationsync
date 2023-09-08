<?php session_start();

set_time_limit(4800);

include '../../Module.php';
$school_details=School::ReadSchoolDetails();

//if(!(isset($Class)))
  $Class=$_GET['txtclassp'];
//if(!(isset($Session)))
  $Session=$_GET['txtsessionp'];
  $Term=$_GET['txttermp'];
  if(!isset($_SESSION['lgina']))
  {
    header("location:../../login.php");
  }
  $ss=Module::GetClassSessionp($Class);

  $Students=Module::ReadSessionStudentsp($ss,$Class);
  //$level=Module::GetLevel($class);


  $current=Module::ReadCurrentSession();

  if(strtolower($Session)==strtolower($current['session']) && strtolower($Term)==strtolower($current['term']))
  {
    $editStatus='true';
  }
  else
  {
    $editStatus='false';
  }

$Subjects=Module::ReadClassSubjectsp($Class);
foreach($Subjects as $Subject)
{

  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >


  <head> 
    <link rel="icon" type="image/png" href="../../images/school/favicon.png"/>
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
        cat=eval(ca1)+eval(ca2);
        total=eval(cat)+eval(exam);

        document.getElementById(id+subject+"exT").innerHTML = eval(total);
        document.getElementById(id+subject+"caT").innerHTML = eval(cat);

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
            document.getElementById("msgContainer").innerHTML = "Saving Changes";
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

  <title> <?php echo $Class; ?> <?php echo $Session; ?> <?php echo $Term; ?> Term CA Sheet</title>

  </head>

  <body>
  <?php
  $Subjects=Module::ReadClassSubjectsp($Class);?>
  
<nav id="menu" style="position: absolute; display: none" title="menu" onclick="closemenu()">
  <form method="get" action="../result/ca_sheetp.php">
    <input type="hidden" name="txtsessionp" value="<?php echo $Session; ?>">
    <input type="hidden" name="txttermp" value="<?php echo $Term; ?>">
    <input type="hidden" name="txtclassp" value="<?php echo $Class; ?>">
    <table>
      <tr><td>Subject</td>
        <td>
          <select name="txtsubjectp" style="max-width: 60px" required="true">
            <?php
            foreach($Subjects as $Subj)
            {
              ?>
              <option><?php echo $Subj; ?></option>
              <?php
            }
            ?>
          </select>
        </td>
      </tr>
      <tr><td colspan="2"><input type="submit" name="Open" value="Open CA Sheet" style="width: 99%"></td></tr>
    </table>
  </form>


  <div style="color: white; background-color: lightblue; color:black; position: absolute;" id='msgContainer' onclick="this.style.display='none'"></div>
    <div style="color: white; background-color: lightblue; color:black; position: static; width: 100px" id='menu'><a href="../dashboard">Dashboard</a> <a href="../result/master_sheetp.php?txtclass=<?php echo $Class ?>&txtsession=<?php echo $Session; ?>&txtterm=<?php echo $Term; ?>">Master Sheet</a> <button class="menuBtn" title="Click to save all changes made"  onclick="testSaveScore('<?php echo $Session; ?>','<?php echo $Term;?>','<?php echo $Classs;?>')">Save All</button>
      <form method="get" action="../result/ca_sheetp.php">
        <input type="hidden" name="txtsessionp" value="<?php echo $session; ?>">
        <input type="hidden" name="txttermp" value="<?php echo $Term; ?>">
        <input type="hidden" name="txtclassp" value="<?php echo $Class; ?>">
        <table>
          <tr><td>Subject</td>
            <td>
              <select name="txtsubjectp" style="max-width: 60px" required="true">
                <?php

                $Subjects=Module::ReadClassSubjectsp($class);
                foreach($Subjects as $Subj)
                {
                  ?>
                  <option><?php echo $Subj; ?></option>
                  <?php
                }
                ?>
              </select>
            </td>
          </tr>
          <tr><td colspan="2"><input type="submit" name="Open" value="Open CA Sheet"></td></tr>
        </table>
      </form>
  </div>
 
</nav>
    <center><div style="color: white; background-color: lightblue; color:black;" id='rst'></div></center>
    <div class="content" style="background: white;">
      <table cellspacing="0" width="100%" id="tableData" border="0">
        <tr>
          <td style="border:none">
            <header>
              <b>
              <div class="bheader"><center><b ><hd><?php echo strtoupper($school_details['school_name']); ?></hd></b><br/>
                <hd1><?php echo $Session; ?> <?php echo strtoupper($Term); ?> TERM  CONTINUOUS ASSESSMENT SHEET <br/>FOR <?php echo strtoupper("$Subject $Class");  ?></hd1> <br/>
                <u>SCORE SHEET</u></center></div></b>
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

                    <tr id="<?php echo $RegNo;?>" >
                             <td><?php echo $RegNo;?></td>
                             <td width="200px"><?php echo $Student;?></td>

                      <td class="data" id="<?php echo $RegNo.$Subject; ?>ca1"  ></td>
                      <td class="data"  id="<?php echo $RegNo.$Subject; ?>ca2"></td>
                      <td class="data"  id="<?php echo $RegNo.$Subject; ?>ca3"></td>
                      <td class="data" id="<?php echo $RegNo.$Subject; ?>exam"></td>
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
  </body>
  </html>
  <?php 

}
?>



  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../styles/loader.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <div id="preloader" style="display: none">
    <div id="loader"><b style="color: white; background: red; padding: 5px 5px 5px 5px">Please Wait</b></div>
  </div>