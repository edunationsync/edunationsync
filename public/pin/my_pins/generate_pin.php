<?php
include '../../Module.php';
$school_details=School::ReadSchoolDetails();

$number=$_GET['number'];
$session=Module::ReadCurrentSession();
//echo $session['session'];
$ses=explode("/", $session['session']);

for ($i=$number; $i >0 ; $i--) { 
	# code...
	$last= Card::GetLastCard();
	if(!($last>0))
	{
		$last=0;
	}

	$pin=Card::GeneratePin();
	$serial=$school_details['school_keycode']."/".$ses[1]."/".$last++;
	if(strlen($pin)<12)
	{
		$pin=Card::GeneratePin();
	}

	Card::Add($pin,$serial);
}

echo "Progress ...";
?>