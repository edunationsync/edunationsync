<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$id=$_GET['id'];
$regid=$_GET['regid'];
$regno=$_GET['regno'];

if(Module::UpdateStudentp_kernel_id($id,$regid,$regno))
{
	echo " Updated Successfully";
}
else
{
	echo " Updated Failed";
}


?>