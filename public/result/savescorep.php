<?php
include '../Module.php';
$school_details=School::ReadSchoolDetails();
$student=$_GET['student'];
$ca1=$_GET['ca1'];
$ca2=$_GET['ca2'];
$ca3=$_GET['ca3'];
$catotal=$_GET['catotal'];
$total=$_GET['total'];

$session=$_GET['session'];
$term=$_GET['term'];
$subject=$_GET['subject'];
$exam=$_GET['exam'];
$class=$_GET['class'];

$GradeGetails=Grades::ReadScoreDetails($total);
$grade=$GradeGetails['grade_symbol'];
$remark=$GradeGetails['grade_remark_sub'];
/*
if($total<=39){
  $grade="F9";
  $remark="Fail";
}
elseif($total<=44){
  $grade="E8";
  $remark="Fair";
}
elseif($total<=49){
  $grade="D7";
  $remark="Pass";
}
elseif($total<=54){
  $grade="C6";
  $remark="Credit";
}
elseif($total<=59){
  $grade="C5";
  $remark="Credit";
}
elseif($total<=64){
  $grade="C4";
  $remark="Credit";
}
elseif($total<=69){
  $grade="B3";
  $remark="Very Good";
}
elseif($total<=74.99){
  $grade="B2";
  $remark="Very Good";
}
elseif($total>=75){
  $grade="A1";
  $remark="Excellent";
}
*/
$stdDetails=Module::ReadStudentDetailsp($student);

//echo "$ca1 $ca2 $ca3 $catotal $exam $total $session $term $subject  $remark student: $student<br/>";
if(Module::IsSubmitted($session,$term))
{
	echo "$session, $term Term's result have been published";
}
else
{
	echo $stdDetails['names']." $subject result was ".Module::SaveScorep($student,$subject,$session,$term,$class,$ca1,$ca2,$ca3,$catotal,$exam,$total,$grade,$remark);
}


?>