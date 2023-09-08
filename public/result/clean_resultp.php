<?php
include '../Module.php';
$school_details=School::ReadSchoolDetails();

echo Module::CleanResultp();
?>