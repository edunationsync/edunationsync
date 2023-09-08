<?php
include '../Module.php';
$school_details=School::ReadSchoolDetails();

$reg_no=$_GET['reg_no'];
$session=$_GET['session'];
$term=$_GET['term'];

$stdDetails=Module::ReadStudentDetailsp($reg_no);

if(Module::CancelStudentTermResults($reg_no,$session,$term))
{
  echo "cancelled successfully";
}
else
{
  echo "not cancelled successfully"; 
}  
?>