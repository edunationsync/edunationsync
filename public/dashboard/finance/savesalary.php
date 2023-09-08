<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$id=$_GET['id'];
$month=$_GET['month'];
$year=$_GET['year'];
$amount=$_GET['amount'];
$sgl_increase=$_GET['sgl_increase'];

if(Finance::UpdateSalaryData($id,$month,$year,$amount,$sgl_increase))
{
	echo "Modified Successfully";
}
else
{
	echo "Not Modified Successfully";
}
?>