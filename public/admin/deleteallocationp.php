<?php
include '../Module.php';
$id=$_GET['id'];


if(Module::IsAllocationIdExistp($id))
{
	if(Module::DeleteAllocationp($id))
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