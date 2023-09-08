<?php 
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$id=$_GET['id'];

$resultData=Module::Sync_ReadSubjectResultp($id);

//echo Sync::LaunchExternalScript("https://google.com");

echo $resultData['regno']."|".$resultData['subject']."|".$resultData['session']."|".$resultData['class']."|".$resultData['term']."|".$resultData['ca1']."|".$resultData['ca2']."|".$resultData['ca3']."|".$resultData['catotal']."|".$resultData['exam']."|".$resultData['total']."|".$resultData['lowest_score']."|".$resultData['highest_score']."|".$resultData['remark']."|".$resultData['grade']."|".$resultData['teacherRemark']."|".$resultData['position']."|".$resultData['comment'];
?>