<?php session_start();
include '../Module.php';
$value=$_GET['value'];



if(Module::UpdateNextTerm($value))
{
	echo "$value Modified Successfully";
}
else
{
	echo "Modification Failed";
}


?>