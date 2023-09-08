<?php session_start();
include '../Module.php';

$shortcode=$_GET['shortcode'];
$subject=$_GET['subject'];
$osubject=$_GET['osubject'];
$id=$_GET['id'];
$level=$_GET['level'];


if(Module::UpdateSubject($id,$osubject,$subject,$shortcode,$level))
{
	echo "<hr/>Modified Successfully<hr/>";
}
else
{
	echo "<hr/>Modification Failed<hr/>";
}


?>