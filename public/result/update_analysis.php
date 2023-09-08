<?php 
/*
include '../Module.php';
$school_details=School::ReadSchoolDetails();

$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['class'];

$ss=Module::GetClassSessionp($class);
$students=Module::ReadSessionStudentsp($ss,$class);
foreach($students as $reg_no)
{
	echo Analysis::ProcessResultAnalysisp($reg_no,$class,$session,$term);
}*/

include '../Module.php';
$school_details=School::ReadSchoolDetails();

$reg_no=$_GET['reg_no'];
$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['class'];

$totalstudentsubject=Module::CountStudentSubjectsp($reg_no,$class,$session,$term);
echo $totalstudentsubject;
/*
if(Analysis::ProcessResultAnalysisp($reg_no,$class,$session,$term,$totalstudentsubject)){
	echo $reg_no." Successful";
}
else{	
	echo $reg_no." Update Failed";
} */
?>