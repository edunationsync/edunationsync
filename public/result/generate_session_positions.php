<?php 
include '../Module.php';
$school_details=School::ReadSchoolDetails();
$session=$_GET['session'];
$class=$_GET['class'];
$operation=$_GET['operation'];

	
Module::UpdateSessionPositions($session,$class,$operation);

echo $session." Positions for ".$class." Updated Successfully";


?>