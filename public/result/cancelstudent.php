<?php
include '../Module.php';
$school_details=School::ReadSchoolDetails();

$student=$_GET['student'];
$session=$_GET['session'];
$term=$_GET['term'];
$subject=$_GET['subject'];
$exam=$_GET['exam'];
$class=$_GET['class'];

$stdDetails=Module::ReadStudentDetailsp($student);

if(Module::IsSubmitted($session,$term))
{
  echo "$session, $term Term's result have been published";
}
else
{
  echo $stdDetails['names']." $subject result was ";
  if(Module::IsStudentRegisteredp($student,$subject,$session,$term,$class))
  {
    if(Module::CancelStudentSubjectRegistration($student,$subject,$session,$term,$class))
    {
      echo "cancelled successfully";
    }
    else
    {
      echo "not cancelled successfully"; 
    }    
  }
  else
  {
    echo " Already Cancelled"; 
  }
}
?>