<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$id=$_GET['id'];
$serial=$_GET['serial'];
$pin=$_GET['pin'];
$status=$_GET['status'];
$user=$_GET['user'];
$session=$_GET['session'];
$term=$_GET['term'];



if(Module::UpdateCard($id,$serial,$pin,$status,$user,$session,$term))
{
	echo "<hr/>Modified Successfully<hr/>";
}
else
{
	echo "<hr/>Modification Failed<hr/>";
}


?>