<?php
include '../Module.php';
$school_details=School::ReadSchoolDetails();

$regno=$_GET['regno'];
$session=$_GET['session'];
$term=$_GET['term'];
$attendance=$_GET['attendance'];
$attentiveness=$_GET['attentiveness'];
$neatness=$_GET['neatness'];
$politeness=$_GET['politeness'];
$relationship=$_GET['relationship'];
$curiosity=$_GET['curiosity'];
$honesty=$_GET['honesty'];
$help_others=$_GET['help_others'];
$punctuality=$_GET['punctuality'];
$leadership=$_GET['leadership'];
$emotional_stability=$_GET['emotional_stability'];
$attitude_to_work=$_GET['attitude_to_work'];


if(!(Module::IsStudentDomainExistp($regno,$session,$term)))
{
	if(Module::AddDomainp($regno,$session,$term,$attendance,$attentiveness,$neatness,$politeness,$relationship,$curiosity,$honesty,$help_others,$punctuality,$leadership,$emotional_stability,$attitude_to_work))
	{
		echo "<hr/>Student Domain Added<hr/>";
	}
	else
	{
		echo "<hr/>Student Domain was not Added<hr/>";
	}
}
else
{
	if(Module::UpdateDomainp($regno,$session,$term,$attendance,$attentiveness,$neatness,$politeness,$relationship,$curiosity,$honesty,$help_others,$punctuality,$leadership,$emotional_stability,$attitude_to_work))
	{
		echo "<hr/>Student Domain Modified<hr/>";
	}
	else
	{
		echo "<hr/>Student Domain was not Modified<hr/>";
	}
}

?>