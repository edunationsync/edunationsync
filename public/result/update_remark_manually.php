<?php 
include '../Module.php';
$school_details=School::ReadSchoolDetails();

$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['class'];
$reg_no=$_GET['reg_no'];
$remark=$_GET['remark'];

if(Analysis::UpdateRemarkManuallyp($reg_no,$class,$session,$term,$remark))
{
	echo "$reg_no Remark was updated [$remark] ";
}
else
{
	echo "$reg_no Remark was not updated successfully";
}

?>