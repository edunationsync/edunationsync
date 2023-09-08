<?php
include '../Module.php';
$id=$_GET['id'];


if(Module::IsSubjectAllocationIdExistp($id))
{
	if(Module::DeleteSubjectAllocation($id))
	{
		echo "success";
	}
	else
	{
		echo "failed";
	}
}
else
{
	echo "not exist";
}


?>