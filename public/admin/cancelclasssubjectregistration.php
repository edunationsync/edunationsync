
<?php 
include '../Module.php'; 
$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['classs'];
$subject=$_GET['subject'];
$level=$_GET['level'];
$shortcode=$_GET['shortcode'];

if(Module::CancelClassSubjectRegistration($subject,$shortcode,$class,$session,$term))
{
	echo "Removed Successfully";
}
else
{
	if(!(Module::IsClassSubjectRegisteredp($subject,$shortcode,$class,$session,$term)))
	{
		echo "Already Removed";
	}
	else
	{
		echo "Failed to Remove";
	}
	
}
?>
