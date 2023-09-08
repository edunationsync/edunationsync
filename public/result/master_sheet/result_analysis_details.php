<?php 
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$sub=$_GET['sub'];
$reg_no=$_GET['reg_no'];
$session=$_GET['session'];
$term=$_GET['term'];

$resAnalysis=Module::ReadResultAnalysisp($reg_no,$session,$term);

if($sub=="CA1")
{
	$Position=$resAnalysis['ca1_position'];
}
elseif($sub=="CA2")
{
	$Position=$resAnalysis['ca2_position'];
}
elseif($sub=="CA3")
{
	$Position=$resAnalysis['ca3_position'];
}
elseif($sub=="Exam")
{
	$Position=$resAnalysis['exam_position'];
}
else
{
	$Position=$resAnalysis['position'];
}

if($Position==0)
{
	$Position='';
}


echo  "$reg_no:".$Position; 
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
elseif($lPos=='' || $Position==0)
{
  echo "<sup></sup>";        
}
else
{
  echo "<sup>th</sup>";
}
?>