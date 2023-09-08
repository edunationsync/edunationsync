<?php
include 'Module.php';
$school_details=School::ReadSchoolDetails();
$number=$_GET['number'];
$session=$_GET['session'];
echo $session.$number;
$ses=explode("/", $session);

for ($i=$number; $i >0 ; $i--) { 
	# code...
	$last= Module::GetLastCard();
	$pin=Module::GeneratePin();
	$serial=$school_details['school_keycode'].$ses[1].$last++;
	Module::AddCard($pin,$serial);
}

echo "Session Generating";

?>