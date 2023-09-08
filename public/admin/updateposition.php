<?php
include '../Module.php';

$id=$_GET['id'];
$post=$_GET['post'];
$type=$_GET['type'];
$description=$_GET['description'];
$privileges=$_GET['privileges'];

if(Position::Update($id,$post,$type,$description,$privileges))
{
	echo "Modified Successfully";
}
else
{
	echo "Error Occured, Train again later";
}


?>