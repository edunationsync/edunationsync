<?php 
include '../../Module.php';
$school_details=School::ReadSchoolDetails();
$id=$_GET['id'];

if(Sync::Delete($id))
{
	echo "Backup was refreshed successfully";
}
else
{
	echo "Backup refresh request failed";
}
?>