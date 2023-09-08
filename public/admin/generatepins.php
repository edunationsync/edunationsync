<?php
include '../Module.php';
$number=$_GET['number'];
$session=$_GET['session'];
$ses=explode("/", $session);

for ($i=$number; $i >0 ; $i--) { 
	# code...
	$last= Module::GetLastCard();
	$pin=Module::GeneratePin();
	$serial="TIS".$ses[1].$last++;
	Module::AddCard($pin,$serial);
}

?>