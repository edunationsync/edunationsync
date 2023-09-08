<?php
include '../Module.php';
$id=$_GET['id'];

if(Position::IsExist($id))
{
	if(Position::Delete($id))
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
	echo "<hr/>Position Already Removed<hr/>";
}


?>