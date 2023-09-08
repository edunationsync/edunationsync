<?php
include '../Module.php';

$oclass=$_GET['oclass'];
$classs=$_GET['classs'];
$yc=$_GET['yc'];
$level=$_GET['level'];


if(Module::UpdateClassp($oclass,$classs,$yc,$level))
{
	echo "Modified Successfully";
}
else
{
	//echo "<hr/>Modification Failed or the refresh the page and try again<hr/>";
}

?>