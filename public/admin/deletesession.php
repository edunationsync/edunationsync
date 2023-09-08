<?php
include '../Module.php';
$id=$_GET['id'];

//echo "$student $session $term $subject $position<hr/>";

if(Module::IsSessionExist($id))
{
	if(Module::DeleteSession($id))
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
	echo "<hr/>Session Alredy Removed<hr/>";
}


?>