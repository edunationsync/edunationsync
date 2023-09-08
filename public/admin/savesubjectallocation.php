<?php session_start();
include '../Module.php';


$id=$_GET['id'];
$teacher=$_GET['teacher'];
$class=$_GET['classs'];
$subject=$_GET['subject'];
$session=$_GET['session'];
$term=$_GET['term'];
$level=$_GET['level'];

//echo "ID: ".$id." Techer: ".$teacher." Class: ".$classs." Session: ".$session." Term: ".$term;
if(Module::UpdateAllocation($id,$teacher,$subject,$class,$session,$term,$level))
{
	echo "<hr/>Modified Successfully<hr/>";
}
else
{
	echo "<hr/>Modification Failed<hr/>";
}


?>