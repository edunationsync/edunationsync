<?php 
include '../Module.php';  
$reg_no=$_GET['reg_no'];
$subject=$_GET['subject'];
$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['classs'];


if(Module::CancelStudentSubjectRegistration($reg_no,$subject,$session,$term,$class))
{
	echo "Removed Successfully";
}
else
{
	if(!(Module::IsStudentRegisteredp($reg_no,$subject,$session,$term,$class)))
	{
		echo "Already Removed";
	}
	else
	{
		echo "Failed to Remove";
	}
	
}
?>
