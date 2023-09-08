<?php session_start();
include '../Module.php'; 
$reg_no=$_GET['reg_no'];
$subject=$_GET['subject'];
$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['classs'];

if(Module::IsStudentRegisteredp($reg_no,$subject,$session,$term,$class))
{
	if(Module::CancelStudentSubjectRegistration($reg_no,$subject,$session,$term,$class))
	{
		$msg="removed";
	}
	else
	{
		echo "gsdw_013";
	}
}
else
{
	if(Module::RegisterSubjectp($reg_no,$subject,$session,$term,$class))
	{
		echo "registered";
	}
	else{
		echo "gsdw_013";
	}
}	
?>
