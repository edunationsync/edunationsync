<?php
include '../Module.php';
$id=$_GET['id'];

//echo "$student $session $term $subject $position<hr/>";

if(Module::IsSubjectIdExist($id))
{
	if(Module::DeleteSubject($id))
	{
		echo "<hr/>Deleted Successfully<hr/>";
	}
	else
	{
		echo "<hr/>Deletion Failed<hr/>";
	}
}
else
{
	echo "<hr/>Subject Alredy Removed<hr/>";
}


?>