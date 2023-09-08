<?php session_start();
include '../Module.php';
$id=$_GET['id'];
$session=$_GET['session'];
$startdat=$_GET['startdat'];
$enddat=$_GET['enddat'];
$term=$_GET['term'];
$status=$_GET['status'];
$tdays=$_GET['tdays'];
$next_term_begins=$_GET['next_term_begins'];


//echo "$student $session $term $subject $position<hr/>";

if(Module::UpdateSession($id,$session,$term,$startdat,$enddat,$tdays,$next_term_begins,$status))
{
	echo "<hr/>Modified Successfully<hr/>";
}
else
{
	echo "<hr/>Modification Failed<hr/>";
}


?>