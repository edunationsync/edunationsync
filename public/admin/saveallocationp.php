<?php session_start();
include '../Module.php';


$id=$_GET['id'];
$teacher=$_GET['teacher'];
$classs=$_GET['classs'];
$session=$_GET['session'];
$term=$_GET['term'];

//echo "ID: ".$id." Techer: ".$teacher." Class: ".$classs." Session: ".$session." Term: ".$term;
if(Module::UpdateAllocationp($id,$teacher,$classs,$session,$term))
{
	echo "<hr/>Modified Successfully<hr/>";
}
else
{
	echo "<hr/>Modification Failed<hr/>";
}


?>