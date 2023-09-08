<?php session_start();
include '../Module.php'; 

$subject=$_GET['subject'];
$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['classs'];

$ss=Module::GetClassSessionp($class);
$Students=Module::ReadSessionStudentsp($ss,$class);

foreach($Students as $reg_no)
{
	if(Module::RegisterSubjectp($reg_no,$subject,$session,$term,$class))
	{
		$msg=$msg."[ ".$reg_no." registered ]";
	}
	else
	{
		if(Module::IsStudentRegisteredp($reg_no,$subject,$session,$term,$class))
		{
			if(Module::CancelStudentSubjectRegistration($reg_no,$subject,$session,$term,$class))
			{
				$msg=$msg."[ ".$reg_no." removed ]";
			}
			else
			{
				$msg=$msg."[ ".$reg_no." not removed ]";
			}
		}
		else
		{
			$msg=$msg."[ ".$reg_no." not registered ]";
		}		
	}
}

echo $msg;

?>
