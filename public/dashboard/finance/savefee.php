<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$id=$_GET['id'];
$reg_no=$_GET['reg_no'];
$ref=$_GET['ref'];
$reg_fee=$_GET['reg_fee'];
$class=$_GET['class'];
$session=$_GET['session'];
$term=$_GET['term'];
$fee=$_GET['fee'];
$book=$_GET['book'];
$lesson=$_GET['lesson'];
$pta=$_GET['pta'];
$scard=$_GET['scard'];

if(Finance::UpdateFee_Payment($id,$reg_no,$ref,$class,$session,$term,$reg_fee,$fee,$book,$pta,$scard,$lesson))
{
	echo "Modified Successfully";
}
else
{
	echo "Not Modified Successfully";
}
?>