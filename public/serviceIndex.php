<?php session_start();

include 'Module.php';
$school_details=School::ReadSchoolDetails();
$RegNo="TIS/2020/A/1";
$Class="JSS 2A";
$Session="2021/2022";
$Term="First";
$courseCount=3;

echo Module::SaveTermSubAnalysisPositionsp('CA1',$Session,$Term,$Class,10,1);
?>