<?php 
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$subject=$_GET['subject'];
$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['class'];
$operation=$_GET['operation'];


Module::UpdateSubjectPositions($session,$term,$class,$subject,$operation);
echo "$subject Positions for $class Processed for $term Term $session";

?>