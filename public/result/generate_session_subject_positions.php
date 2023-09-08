<?php 
include '../Module.php';
$school_details=School::ReadSchoolDetails();
$session=$_GET['session'];
$sub=$_GET['sub'];
$class=$_GET['class'];
$subject=$_GET['subject'];
$operation=$_GET['operation'];



if($sub=="CA1")
{
	Module::UpdateSessionSubPositions($sub,$session,$class,$subject,$operation);
}
elseif($sub=="CA2")
{
	Module::UpdateSessionSubPositions($sub,$session,$class,$subject,$operation);
}
elseif($sub=="CA3")
{
	Module::UpdateSessionSubPositions($sub,$session,$class,$subject,$operation);
}
elseif($sub=="Exam")
{
	Module::UpdateSessionSubPositions($sub,$session,$class,$subject,$operation);
}
else
{
	$subs=array("CA1","CA2","CA3","Exam");
	foreach($subs as $sub)
	{
		Module::UpdateSessionSubPositions($sub,$session,$class,$subject,$operation);
	}
	
	Module::UpdateSessionSubjectPositions($session,$class,$subject,$operation);
}

echo $class." ".$sub." Positions for ".$session." $subject "." Updated Successfully";
?>