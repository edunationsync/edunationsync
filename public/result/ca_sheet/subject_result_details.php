<?php 
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$subject=$_GET['subject'];
$reg_no=$_GET['reg_no'];
$session=$_GET['session'];
$term=$_GET['term'];

$resultData=Module::ReadStudentResultp($reg_no,$subject,$session,$term);

$Position=$resultData['position'];



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
elseif($lPos=='' || $Position=0)
{
  echo "<sup></sup>";        
}
else
{
  echo "<sup>th</sup>";
}

?>