<?php
include '../Module.php';

$shortcode=$_GET['shortcode'];
$osubject=$_GET['osubject'];
$subject=$_GET['subject'];


if(Module::UpdateSubjectp($osubject,$subject,$shortcode))
{
	echo "<hr/>Modified Successfully<hr/>";
}
else
{
	echo "<hr/>Modification Failed or the refresh the page and try again<hr/>";
}


?>