<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$id=$_GET['id'];

//echo "$student $session $term $subject $position<hr/>";

	if(Module::DeleteCard($id))
	{
		echo "<hr/>Deleted Successfully<hr/>";
	}
	else
	{
		echo "<hr/>Deletion Failed<hr/>";
	}


?>