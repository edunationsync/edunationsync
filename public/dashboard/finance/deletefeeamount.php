<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$id=$_GET['id'];

if(Finance::DeleteFee_Pay_Amount($id))
{
	echo "Fee Amount Deleted";
}
else
{
	echo "Fee Amount Not Deleted";
}

?>