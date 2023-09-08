<?php session_start();
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$class=$_GET['class'];
$session=$_GET['session'];
$term=$_GET['term'];
$feeAmountDetails=Finance::ReadFee_Pay_AmountTermDetails($class,$session,$term);

$id=$_GET['id'];
$reg_no=$_GET['reg_no'];
$ref=$_GET['ref'];
$fee=$feeAmountDetails['fee'];
$reg_fee=$feeAmountDetails['reg_fee'];
$book=$feeAmountDetails['book'];
$lesson=$feeAmountDetails['lesson'];
$pta=$feeAmountDetails['pta'];
$scard=$feeAmountDetails['scard'];

if(Finance::UpdateFee_Payment($id,$reg_no,$ref,$class,$session,$term,$reg_fee,$fee,$book,$pta,$scard,$lesson))
{
	echo $reg_fee.";".$fee.";".$pta.";".$lesson.";".$book.";".$scard.";"."Modified Successfully";
}
else
{
	echo "Not Modified Successfully";
}
?>