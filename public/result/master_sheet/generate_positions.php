<?php 
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$sub=$_GET['sub'];
$session=$_GET['session'];
$term=$_GET['term'];
$class=$_GET['class'];
$operation=$_GET['operation'];

if($sub=="CA1")
{
	Module::UpdateTermSubPositions($sub,$session,$term,$class,$operation);
}
elseif($sub=="CA2")
{
	Module::UpdateTermSubPositions($sub,$session,$term,$class,$operation);
}
elseif($sub=="CA3")
{
	Module::UpdateTermSubPositions($sub,$session,$term,$class,$operation);
}
elseif($sub=="Exam")
{
	Module::UpdateTermSubPositions($sub,$session,$term,$class,$operation);
}
else
{
	Module::UpdateTermPositions($session,$term,$class,$operation);
}

echo $term." Term ".$session." ".$sub." Positions for ".$class." Updated Successfully";


?>