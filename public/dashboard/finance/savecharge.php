<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$id=$_GET['id'];
$month=$_GET['month'];
$year=$_GET['year'];
$lateness=$_GET['lateness'];
$duty=$_GET['duty'];
$lesson_plan_note=$_GET['lesson_plan_note'];
$absenteesm=$_GET['absenteesm'];

if(PunnishmentCharges::UpdatePunnishmentCharge($id,$month,$year,$lateness,$duty,$lesson_plan_note,$absenteesm))
{
	echo "Modified Successfully";
}
else
{
	echo "Not Modified Successfully";
}
?>