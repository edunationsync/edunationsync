<?php session_start();
include '../Module.php'; 
$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['classs'];
$subject=$_GET['subject'];
$level=$_GET['level'];
$shortcode=$_GET['shortcode'];


if(Module::RegisterClassSubject($subject,$shortcode,$class,$session,$term))
{
	echo "Registred Successfully";
}
else
{
	if(Module::IsClassSubjectRegisteredp($subject,$shortcode,$class,$session,$term))
	{
		echo "Already Exist";
	}
	else
	{
		echo "Failed to Register";
	}
	
}
?>
