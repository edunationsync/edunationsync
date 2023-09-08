<?php
include '../Module.php';
$id=$_GET['id'];

//echo "$student $session $term $subject $position<hr/>";

if(Module::IsClassIdExistp($id))
{
	if(Module::DeleteIdClassp($id))
	{
		echo "Deleted Successfully";
	}
	else
	{
		echo "Deletion Failed";
	}
}
else
{
	echo "Class Alredy Removed";
}


?>