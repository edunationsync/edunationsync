<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();


$id=$_GET['id'];
$reg_fee=$_GET['reg_fee'];
$class=$_GET['classs'];
$session=$_GET['session'];
$term=$_GET['term'];
$fee=$_GET['fee'];
$book=$_GET['book'];
$lesson=$_GET['lesson'];
$pta=$_GET['pta'];
$scard=$_GET['scard'];

if(Finance::UpdateFee_Pay_Amount($id,$reg_fee,$class,$session,$term,$fee,$book,$lesson,$pta,$scard))
{
	echo "Modified Successfully";
}
else
{
	echo "Not Modified Successfully";
}
?>