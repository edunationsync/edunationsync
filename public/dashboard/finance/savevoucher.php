<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$id=$_GET['id'];
$ref=$_GET['ref'];
$staffid=$_GET['staffid'];
$date=$_GET['date'];
$month=$_GET['month'];
$year=$_GET['year'];
$sgl=$_GET['sgl'];
$lateness=$_GET['lateness'];
$duty=$_GET['duty'];
$lesson_plan_note=$_GET['lesson_plan_note'];
$absenteesm=$_GET['absenteesm'];
$scheme=$_GET['scheme'];
$savings=$_GET['savings'];
$staff_welfare=$_GET['staff_welfare'];
$amount=$_GET['pay_amount'];
$balance=$_GET['balance'];

if(Finance::UpdateVoucher($id,$ref,$staffid,$date,$month,$year,$sgl,$lateness,$duty,$lesson_plan_note,$absenteesm,$scheme,$savings,$staff_welfare,$amount,$balance))
{
	echo "Modified Successfully";
}
else
{
	echo "Not Modified Successfully";
}
?>